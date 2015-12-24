<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Chencha\Share\ShareFacade as Share;

use App\User;
use App\UserFactory;
use App\Proposition;
use App\PropositionFactory;
use App\Votes;
use App\Comments;
use App\CommentFactory;
use App\Flags;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PropositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();
    	$viewUser = [
    			'fullName' => $user->firstName() . " " . $user->lastName(),
    			'firstName' => $user->firstName(),
    			'lastName' => $user->lastName(),
    			'contactEmail' => $user->contactEmail(),
    			'email' => $user->email(),
    			'avatar' => $user->avatar(),
    			'belongsToSchool' => $user->belongsToSchool(),
    			'belongsToSchool' => $user->belongsToSchool(),
    			'schoolEmail' => $user->googleEmail(),
    			'role' => $user->role(),
    	];
    	
    	$propositionFactory = new PropositionFactory();
    	$viewPropositions = array();
    	$expiredPropositions = array();
    	$endingSoonPropositions = array();
    	$votedPropositions = array();
    	
    	foreach ($propositionFactory->getAcceptedPropositions() as $proposition) {
    		
    		$userHasVoted = $propositionFactory->getUserVoteStatus($proposition->propositionId(), $user->userId());
    		$daysLeft = Carbon::now()->diffInDays(Carbon::createFromTimestamp(strtotime($proposition->deadline())), false);
    		
    		if ($daysLeft <= 0) {
    			//Expired propositions
    			$expiredPropositions[$proposition->propositionId()] = [
    					'id' => $proposition->propositionId(),
    					'propositionSort' => $proposition->propositionSort(),
    					'proposer' => $proposition->proposerId(),
    					'propositionCreationDate' => $proposition->date_created(),
    					'userHasVoted' => $userHasVoted,
    					'deadline' => $proposition->deadline(),
    					'statusId' => $proposition->status(),
    					'ending_in' => $daysLeft,
    					'upvotes' => $propositionFactory->getUpvotes($proposition->propositionId()),
    					'downvotes' => $propositionFactory->getDownvotes($proposition->propositionId()),
    					'comments' => $propositionFactory->getCommentsCount($proposition->propositionId()),
    			];
    			
    		} elseif (($daysLeft <= 5) AND ($daysLeft >= 0)) {
    			//Ending soon (5 days left)
    			$endingSoonPropositions[$proposition->propositionId()] = [
    					'id' => $proposition->propositionId(),
    					'propositionSort' => $proposition->propositionSort(),
    					'proposer' => $proposition->proposerId(),
    					'propositionCreationDate' => $proposition->date_created(),
    					'userHasVoted' => $userHasVoted,
    					'deadline' => $proposition->deadline(),
    					'statusId' => $proposition->status(),
    					'ending_in' => $daysLeft,
    					'upvotes' => $propositionFactory->getUpvotes($proposition->propositionId()),
    					'downvotes' => $propositionFactory->getDownvotes($proposition->propositionId()),
    					'comments' => $propositionFactory->getCommentsCount($proposition->propositionId()),
    			];
    			
    		} elseif (($userHasVoted == true) AND ($daysLeft > 0)) {
    			//Voted propositions
    			$votedPropositions[$proposition->propositionId()] = [
    					'id' => $proposition->propositionId(),
    					'propositionSort' => $proposition->propositionSort(),
    					'proposer' => $proposition->proposerId(),
    					'propositionCreationDate' => $proposition->date_created(),
    					'userHasVoted' => $userHasVoted,
    					'deadline' => $proposition->deadline(),
    					'statusId' => $proposition->status(),
    					'ending_in' => $daysLeft,
    					'upvotes' => $propositionFactory->getUpvotes($proposition->propositionId()),
    					'downvotes' => $propositionFactory->getDownvotes($proposition->propositionId()),
    					'comments' => $propositionFactory->getCommentsCount($proposition->propositionId()),
    			];
    			 
    		} else {
    			$viewPropositions[$proposition->propositionId()] = [
    					'id' => $proposition->propositionId(),
    					'propositionSort' => $proposition->propositionSort(),
    					'proposer' => $proposition->proposerId(),
    					'propositionCreationDate' => $proposition->date_created(),
    					'userHasVoted' => $userHasVoted,
    					'deadline' => $proposition->deadline(),
    					'statusId' => $proposition->status(),
    					'ending_in' => $daysLeft,
    					'upvotes' => $propositionFactory->getUpvotes($proposition->propositionId()),
    					'downvotes' => $propositionFactory->getDownvotes($proposition->propositionId()),
    					'comments' => $propositionFactory->getCommentsCount($proposition->propositionId()),
    			];
    		}
    		
    		
    		
    		$expiredPropositions = array_slice($expiredPropositions, 0, 5); //keep only 5 expired propositions
    		
    	}
    	
    	return view('propositions_new', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser, 'propositions' => $viewPropositions, 'expiredPropositions' => $expiredPropositions, 'endingSoonPropositions' => $endingSoonPropositions, 'votedPropositions' => $votedPropositions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	
    	$user = Auth::user();
    	$viewUser = [
    			'fullName' => $user->firstName() . " " . $user->lastName(),
    			'firstName' => $user->firstName(),
    			'lastName' => $user->lastName(),
    			'contactEmail' => $user->contactEmail(),
    			'email' => $user->email(),
    			'avatar' => $user->avatar(),
    			'belongsToSchool' => $user->belongsToSchool(),
    			'belongsToSchool' => $user->belongsToSchool(),
    			'schoolEmail' => $user->googleEmail(),
    			'role' => $user->role(), 
    	];
    	return view('create_proposition_new', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$user = Auth::user();
    	 
    	$validator = Validator::make($request->all(), [
    			'proposition_sort' => 'required||max:140',
    			'proposition_long' => 'min:10',
    			'deadline' => 'required|between:1,3',
    	]);
    	
    	if ($validator->fails()) {
    	
    		return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
    		 
    	} else {
    		 
    		if ($user->belongsToSchool() == true) {
    			
    			$deadlineId = $request->input('deadline');	// Deadlines: 1=2weeks, 2=1month, 3=2months
    			
    			switch ($deadlineId) {
    				case 1:
    					$deadline = Carbon::now()->addWeeks(2)->toDateTimeString();
    					break;
    				case 2:
    					$deadline = Carbon::now()->addMonth()->toDateTimeString();
    					break;
    				case 3:
    					$deadline = Carbon::now()->addMonths(2)->toDateTimeString();
    					break;
    			}
    			
    			Proposition::create([
    					"proposer_id" => $user->userId(),
    					"propositionSort" => $request->input('proposition_sort'),
    					"propositionLong" => $request->input('proposition_long'),
    					"deadline" => $deadline,
    			]);
    			 
    			return redirect()->route('profile.propositions');
    			
    		} else {
    			abort(403, trans('messages.unauthorized'));
    		}
    		 
    	}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$user = Auth::user();
    	$propositionFactory = new PropositionFactory();
    	$userFactory = new UserFactory();
    	
    	$proposition = $propositionFactory->getProposition($id);
    	
    	if ($proposition->status() !== Proposition::ACCEPTED) {
    		abort(404);
    	}
    	
    	$proposer = $userFactory->getUser($proposition->proposerId());
    	
    	$viewProposition = [
    			'propositionId' => $proposition->propositionId(),
    			'proposer' => [
    					'id' => $proposition->proposerId(),
    					'fullName' => $proposer->firstName() . " " . $proposer->lastName(),
    					'avatar' => $proposer->avatar(),
    			],
    			'propositionSort' => $proposition->propositionSort(),
    			'propositionLong' => $proposition->propositionLong(),
    			'date_created' => Carbon::createFromTimestamp(strtotime($proposition->date_created()))->diffForHumans(),
    			'deadline' => $proposition->deadline(),
    			'ending_in' => Carbon::now()->diffInDays(Carbon::createFromTimestamp(strtotime($proposition->deadline())), false),
    	];
    	
    	$viewVotes = [
    			'upvotes' => $propositionFactory->getUpvotes($id),
    			'downvotes' => $propositionFactory->getDownvotes($id),
    			'userHasVoted' => $propositionFactory->getUserVoteStatus($id, $user->userId()),
    	];
    	
    	$viewComments = array();
    	
    	foreach ($propositionFactory->getComments($id) as $comment) {
    		
    		$commentUser = $userFactory->getUser($comment->commenterId());
    		
    		$viewComments[$comment->commentId()] = [
    				'commentId' => $comment->commentId(),
    				'commentBody' => $comment->body(),
    				'commenter' => [
    						'id' => $commentUser->userId(),
    						'fullName' => $commentUser->firstName() . " " . $commentUser->lastName(),
    						'avatar' => $commentUser->avatar(),
    				],
    				'date_created' => Carbon::createFromTimestamp(strtotime($comment->created_at()))->diffForHumans(),
    		];

    	}
    	
    	$viewProposition['commentsCount'] = count($viewComments);
    	
    	$viewShareLinks = [
    			'facebook' => Share::load(route('proposition', [$viewProposition['propositionId']]), $viewProposition['propositionSort'])->facebook(),
    			'twitter' => Share::load(route('proposition', [$viewProposition['propositionId']]), $viewProposition['propositionSort'])->twitter(),
    			'plus' => Share::load(route('proposition', [$viewProposition['propositionId']]), $viewProposition['propositionSort'])->gplus(),
    			'pinterest' => Share::load(route('proposition', [$viewProposition['propositionId']]), $viewProposition['propositionSort'])->pinterest(),
    	];
    	
    	$viewUser = ['userId' => $user->userId(), 'fullName' => $user->firstName() . " " . $user->lastName(),'firstName' => $user->firstName(),'lastName' => $user->lastName(),'contactEmail' => $user->contactEmail(),'email' => $user->email(),'avatar' => $user->avatar(),'belongsToSchool' => $user->belongsToSchool(),'schoolEmail' => $user->googleEmail(),'role' => $user->role(),];
        return view('proposition_new', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser, 'proposition' => $viewProposition, 'votes' => $viewVotes, 'comments' => $viewComments,'shareLinks' => $viewShareLinks]);
    }
    
    public function comment(Request $request) {
    	$user = Auth::user();
    	
    	$validator = Validator::make($request->all(), [
    			'commentBody' => 'required',
    			'propositionId' => 'required',
    	]);
    	 
    	if ($validator->fails()) {
    		
    		abort(403, $validator->errors()->first('commentBody'));
    	
    	} else {
    	
	    	if ($user->belongsToSchool() == true) {
	    		
	    		Comments::create([
	    				"commenter_id" => $user->userId(),
	    				"proposition_id" => $request->input('propositionId'),
	    				"body" => $request->input('commentBody'),
	    		]);
	    		
	    		return redirect()->route('proposition', $request->input('propositionId'));
	    	} else {
	    		abort(403, trans('messages.unauthorized'));
	    	}
    	
    	}
    }
    
    public function delete_comment($commentId) {
    	$user = Auth::user();
    	
    	$commentsFactory = new commentFactory();
    	$comment = $commentsFactory->getComment($commentId);
    	
    	if ($comment->commenterId() == $user->userId()) {
    		$commentsFactory->deleteComment($commentId);
    		return redirect()->back();
    	} else {
    		abort(403, trans('messages.unauthorized'));
    	}
    }
    
    public function upvote($id) {
    	$user = Auth::user();
    	
    	if ($user->belongsToSchool() == true) {
	    	$propositionFactory = new PropositionFactory();
	    	
	    	if (Carbon::now()->diffInDays(Carbon::createFromTimestamp(strtotime($propositionFactory->getProposition($id)->deadline())), false) <= 0) {
	    		abort(403, trans('messages.unauthorized'));
	    	}
	    		
	    	
	    	if ($propositionFactory->getUserVoteStatus($id, $user->userId()) == false) {
	    		Votes::create([
	    				"proposition_id" => $id,
	    				"vote_user" => $user->userId(),
	    				"vote_value" => 1,
	    				"vote_school_email" => $user->googleEmail(),
	    		]);
	    		return redirect()->route('proposition', $id);
	    	} else {
	    		abort(403, trans('messages.unauthorized'));
	    	}
    	} else {
    		abort(403, trans('messages.unauthorized'));
    	}
    }
    
    public function downvote($id) {
    	$user = Auth::user();
    	$propositionFactory = new PropositionFactory();
    	
    	if (Carbon::now()->diffInDays(Carbon::createFromTimestamp(strtotime($propositionFactory->getProposition($id)->deadline())), false) <= 0) {
    		abort(403, trans('messages.unauthorized'));
    	}
    	 
    	if ($propositionFactory->getUserVoteStatus($id, $user->userId()) == false) {
    		Votes::create([
    				"proposition_id" => $id,
    				"vote_user" => $user->userId(),
    				"vote_value" => 0,
	    			"vote_school_email" => $user->googleEmail(),
    		]);
    		return redirect()->route('proposition', $id);
    	} else {
    		abort(403, trans('messages.unauthorized'));
    	}
    }
    
    /**
     * Flag a proposition as offensive/inappropriate/incomprehensible.
     *
     * @param  int  $id
     * @param  int  $flag_type
     * @return \Illuminate\Http\Response
     */
    public function flag($id, $flag_type)
    {
        if ($flag_type == 1 OR $flag_type == 2 OR $flag_type == 3) {
        	Flags::create([
        			"type" => $flag_type,
        			"proposition" => $id,
        	]);
        	return redirect()->back()->with('status', trans('messages.proposition.flagged'));
        } else {
        	abort(404);
        }
    }
}

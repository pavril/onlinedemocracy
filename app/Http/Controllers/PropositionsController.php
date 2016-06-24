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
use App\TagsFactory;
use App\Votes;
use App\Comments;
use App\CommentFactory;
use App\Flags;
use App\Marker;
use App\Tags;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\DB;
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
		\App::setLocale(Auth::user()->language());
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
    	$endingSoonPropositions = array();
    	$votedPropositions = array();
    	
    	
    	foreach ($propositionFactory->getAcceptedPropositionsExeptExpired() as $proposition) {
    		
    		$userHasVoted = $propositionFactory->getUserVoteStatus($proposition->propositionId(), $user->userId());
    		$daysLeft = Carbon::now()->diffInDays(Carbon::createFromTimestamp(strtotime($proposition->deadline())), false);
    		
    		if (($daysLeft <= 5) AND ($daysLeft >= 0)) {
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
    					'marker' => $propositionFactory->getMarker($proposition->propositionId()),
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
    					'marker' => $propositionFactory->getMarker($proposition->propositionId()),
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
    					'marker' => $propositionFactory->getMarker($proposition->propositionId()),
    			];
    		}
    		
    		
    		
    		
    	}
    	
    	return view('propositions_new', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser, 'propositions' => $viewPropositions, 'endingSoonPropositions' => $endingSoonPropositions, 'votedPropositions' => $votedPropositions]);
    }
    
    public function archived()
    {
    	\App::setLocale(Auth::user()->language());
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
    	$expiredPropositions = array();
    	
    	foreach ($propositionFactory->getAcceptedPropositionsOnlyExpired() as $proposition) {
    	
    		$expiredPropositions[$proposition->propositionId()] = [
    				'id' => $proposition->propositionId(),
    				'propositionSort' => $proposition->propositionSort(),
    				'proposer' => $proposition->proposerId(),
    				'propositionCreationDate' => $proposition->date_created(),
    				'deadline' => $proposition->deadline(),
    				'statusId' => $proposition->status(),
    				'ending_in' => Carbon::now()->diffInDays(Carbon::createFromTimestamp(strtotime($proposition->deadline())), false),
    				'upvotes' => $propositionFactory->getUpvotes($proposition->propositionId()),
    				'downvotes' => $propositionFactory->getDownvotes($proposition->propositionId()),
    				'comments' => $propositionFactory->getCommentsCount($proposition->propositionId()),
    				'marker' => $propositionFactory->getMarker($proposition->propositionId()),
    		];
    		
    	}
    	
    	return view('archived', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser, 'expiredPropositions' => $expiredPropositions]);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    	\App::setLocale(Auth::user()->language());
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
		\App::setLocale(Auth::user()->language());
    	$user = Auth::user();
    	 
    	$validator = Validator::make($request->all(), [
    			'proposition' => 'required|max:140',
    			'proposition_description' => 'min:10',
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
    			
    			$proposition = Proposition::create([
    					"proposer_id" => $user->userId(),
    					"propositionSort" => $request->input('proposition'),
    					"propositionLong" => $request->input('proposition_description'),
    					"deadline" => $deadline,
    			]);
    			
    			// Register new tags
    			preg_match_all("/#([a-zA-Z0-9_]+)/", $request->input('proposition') . " " . $request->input('proposition_description'), $matches);
    			foreach(array_unique($matches[1]) as $tagString)
    			{
    				$tag = with(new TagsFactory())->findOrCreate($tagString);
    				$proposition->addTag($tag);
    			}
    			 
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
    			'marker' => $propositionFactory->getMarker($proposition->propositionId()),
    	];
    	
    	$viewVotes = [
    			'upvotes' => $propositionFactory->getUpvotes($id),
    			'downvotes' => $propositionFactory->getDownvotes($id),
    	];
    	
    	$viewShareLinks = [
    			'facebook' => Share::load(route('proposition', [$viewProposition['propositionId']]), $viewProposition['propositionSort'])->facebook(),
    			'twitter' => Share::load(route('proposition', [$viewProposition['propositionId']]), $viewProposition['propositionSort'])->twitter(),
    			'plus' => Share::load(route('proposition', [$viewProposition['propositionId']]), $viewProposition['propositionSort'])->gplus(),
    			'pinterest' => Share::load(route('proposition', [$viewProposition['propositionId']]), $viewProposition['propositionSort'])->pinterest(),
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
    	
    	
    	$viewTags = array();
    	foreach (with(new TagsFactory())->getTagsByPropositionId($proposition->propositionId()) as $tag) {
    		$viewTags[$tag->id()] = $tag->content();
    	}
    	
    	if (Auth::check()) {
			\App::setLocale(Auth::user()->language());
	    	$user = Auth::user();
	    	$viewUser = ['userId' => $user->userId(), 'fullName' => $user->firstName() . " " . $user->lastName(),'firstName' => $user->firstName(),'lastName' => $user->lastName(),'contactEmail' => $user->contactEmail(),'email' => $user->email(),'avatar' => $user->avatar(),'belongsToSchool' => $user->belongsToSchool(),'schoolEmail' => $user->googleEmail(),'role' => $user->role(),];
	        
	    	$viewVotes = [
	    			'upvotes' => $propositionFactory->getUpvotes($id),
	    			'downvotes' => $propositionFactory->getDownvotes($id),
	    			'userHasVoted' => $propositionFactory->getUserVoteStatus($id, $user->userId()),
	    	];
	    	
	    	return view('proposition_new', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser, 'proposition' => $viewProposition, 'votes' => $viewVotes, 'comments' => $viewComments,'shareLinks' => $viewShareLinks, 'tags' => $viewTags]);
    	} else {
    		return view('proposition_public', ['proposition' => $viewProposition, 'votes' => $viewVotes, 'comments' => $viewComments,'shareLinks' => $viewShareLinks]);
    	}
    }
    
    public function comment(Request $request) {
		\App::setLocale(Auth::user()->language());
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
		\App::setLocale(Auth::user()->language());
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
		\App::setLocale(Auth::user()->language());
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
		\App::setLocale(Auth::user()->language());
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
     * Flag a proposition as offensive/incomprehensible.
     *
     * @param  int  $id
     * @param  int  $flag_type
     * @return \Illuminate\Http\Response
     */
    public function flag($id, $flag_type) {
		\App::setLocale(Auth::user()->language());
        if ($flag_type == 1 OR $flag_type == 3) {
        	Flags::create([
        			"type" => $flag_type,
        			"proposition" => $id,
        	]);
        	return redirect()->back()->with('status', trans('messages.proposition.flagged'));
        } else {
        	abort(404);
        }
    }
    
    /**
     * Create mark for proposition.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_marker($id, Request $request) {
    	
    	\App::setLocale(Auth::user()->language());
    	$user = Auth::user();
    	
    	if ($user->role() === 2) {
	    	$validator = Validator::make($request->all(), [
	    			'type' => 'required|min:1|max:3',
	    			'message' => 'max:240',
	    	]);
	    	
	    	if ($validator->fails()) {
	    	
				return $validator->errors();
	    		 
	    	} else {
	
	    		Marker::create([
	    				"marker_id" => $request->input('type'),
	    				"marker_text" => $request->input('message'),
	    				"proposition_id" => $id,
	    		]);
	    		
				return 'success';
	    		 
	    	}
    	} else {
    		return trans('messages.unauthorized');
    	}
    	
    }
    
    public function edit_marker($id, Request $request) {
    	 
    	\App::setLocale(Auth::user()->language());
    	$user = Auth::user();
    	 
    	if ($user->role() === 2) {
	    	$validator = Validator::make($request->all(), [
	    			'type' => 'required|min:1|max:3',
	    			'message' => 'max:240',
	    	]);
	    	 
	    	if ($validator->fails()) {
	    		 
	    		return $validator->errors();
	    		 
	    	} else {
	    		
	    		$marker = with(new PropositionFactory)->getMarker($id);
	    		$marker->setRelationMarkerId($request->input('type'));
	    		$marker->setMarkerText($request->input('message'));
	    		$marker->save();
	    
	    		return 'success';
	    		
	    	}
	    } else {
	   		return trans('messages.unauthorized');
	   	}
    	 
    }
    
    public function delete_marker($id) {
    	
    	\App::setLocale(Auth::user()->language());
    	$user = Auth::user();
    	
    	if ($user->role() === 2) {
    		
	    	$marker = with(new PropositionFactory)->getMarker($id);
	    	$marker->delete();
	    	
	    	return redirect()->back();
	    	
	    } else {
	    	abort(403, trans('messages.unauthorized'));
	    }
    }
    
    public function search(Request $request)
    {
    	\App::setLocale(Auth::user()->language());
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
    	
    	$results = array();
    	$pages = null;
    	
    	if (empty($request->input('q')) == false) {
    		$term = $request->input('q');
    		
    		$proposition_results = Proposition::join('users', 'users.id', '=', 'propositions.proposer_id')
    			->where('propositions.status', '=', 1)
				->where('propositions.propositionSort', 'LIKE', "%$term%")
    			->orwhere('propositions.propositionLong', 'LIKE', "%$term%")
    			->orWhere(DB::raw("CONCAT(`users`.`firstName`, ' ', `users`.`lastName`)"), 'LIKE', "%$term%")
    			->orderBy('propositions.created_at', 'desc')
    			->paginate(5);
    		
    		$pages = $proposition_results->lastPage();
    		
    		$propositionFactory = new PropositionFactory();
    		
    		foreach ($proposition_results->items() as $proposition) {
    			$results[$proposition->propositionId()] = [
    					'id' => $proposition->propositionId(),
    					'propositionSort' => $proposition->propositionSort(),
    					'proposer' => $proposition->proposerId(),
    					'propositionCreationDate' => $proposition->date_created(),
    					'deadline' => $proposition->deadline(),
    					'statusId' => $proposition->status(),
    					'ending_in' => Carbon::now()->diffInDays(Carbon::createFromTimestamp(strtotime($proposition->deadline())), false),
    					'upvotes' => $propositionFactory->getUpvotes($proposition->propositionId()),
    					'downvotes' => $propositionFactory->getDownvotes($proposition->propositionId()),
    					'comments' => $propositionFactory->getCommentsCount($proposition->propositionId()),
    					'marker' => $propositionFactory->getMarker($proposition->propositionId()),
    			];
    		}
    	}
    	
    	return view('search', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser, 'results' => $results, 'pages' => $pages]);
    }
    
}

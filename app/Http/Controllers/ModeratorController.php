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

use Mail;

use App\User;
use App\UserFactory;
use App\Proposition;
use App\PropositionFactory;
use App\Votes;
use App\Comments;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ModeratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	
	public function __construct () {
		\App::setLocale(Auth::user()->language());
	}
	
    public function index()
    {
    	$user = Auth::user();
    	if ($user->role() !== User::ROLE_MODERATOR) {
    		abort(404);
    	}
    	
    	$propositionsFactory = new PropositionFactory();
    	$viewUser = [
    			'fullName' => $user->firstName() . " " . $user->lastName(),
    			'firstName' => $user->firstName(),
    			'lastName' => $user->lastName(),
    			'contactEmail' => $user->contactEmail(),
    			'email' => $user->email(),
    			'avatar' => $user->avatar(),
    			'belongsToSchool' => $user->belongsToSchool(),
    			'schoolEmail' => $user->googleEmail(),
    			'role' => $user->role(),
    			'propositionsCount' =>  $propositionsFactory->getPropositionsCountByUser($user->userId()),
    	];

    	
    	$viewPropositions = array();
    	foreach ($propositionsFactory->getQueuedPropositionsExeptUsers($user->userId()) as $proposition) {
    		$viewPropositions[$proposition->propositionId()] = [
    				'id' => $proposition->propositionId(),
    				'propositionSort' => $proposition->propositionSort(),
    				'propositionLong' => $proposition->propositionLong(),
    				'proposer' => $proposition->proposerId(),
    				'propositionCreationDate' => Carbon::createFromTimestamp(strtotime($proposition->date_created()))->diffForHumans(),
    				'userHasVoted' => $propositionsFactory->getUserVoteStatus($proposition->propositionId(), $user->userId()),
    				'deadline' => $proposition->deadline(),
    				'statusId' => $proposition->status(),
    				'ending_in' => Carbon::now()->diffInDays(Carbon::createFromTimestamp(strtotime($proposition->deadline())), false),
    		];
    	}
    	
    	return view('moderator.approval_new', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser, 'propositions' => $viewPropositions]);
    }

    
    public function approve($id)
    {
    	$user = Auth::user();
    	if ($user->role() !== User::ROLE_MODERATOR) {
    		abort(403, 'Unothorized action.');
    	}
        
    	$propositionsFactory = new PropositionFactory();
    	$proposition = $propositionsFactory->getProposition($id);
    	
    	$proposition->setStatus(Proposition::ACCEPTED);
    	$proposition->save();
    	
    	\App::setLocale($proposition->proposer()->language());
    	Mail::send('emails.approved', ['proposition' => $proposition, 'shareLinks' => Share::load(route('proposition', [$proposition->propositionId()]), $proposition->propositionSort())->services()], function($message) use ($proposition)
    	{
    		$message->from('no-reply@directdemocracy.online', 'DirectDemocracy')->subject(trans('messages.emails.approved-proposition.subject'));
    		$message->to($proposition->proposer()->email());
    	});
    	
    	return redirect()->back();
    }
    
    public function block(Request $request)
    {
    	$user = Auth::user();
    	if ($user->role() !== User::ROLE_MODERATOR) {
    		abort(403, 'Unothorized action.');
    	}
    	
    	$validator = Validator::make($request->all(), [
    			'reason' => 'required|max:120',
    			'propositionId' => 'required',
    	]);
    	
    	if ($validator->fails()) {
    		abort(403, $validator->errors()->first('reason'));
    	} else {
    		$id = $request->input('propositionId');
    		$reason = $request->input('reason');
    		
    		$propositionsFactory = new PropositionFactory();
    		$proposition = $propositionsFactory->getProposition($id);
    		
    		$proposition->setStatus(Proposition::BLOCKED);
    		$proposition->setBlockReason($reason);
    		$proposition->save();
    		
    		return redirect()->back();
    	}
    	
    }
    
    public function handle_flags()
    {
    	$user = Auth::user();
    	if ($user->role() !== User::ROLE_MODERATOR) {
    		abort(404);
    	}
    	 
    	$propositionsFactory = new PropositionFactory();
    	$viewUser = [
    			'fullName' => $user->firstName() . " " . $user->lastName(),
    			'firstName' => $user->firstName(),
    			'lastName' => $user->lastName(),
    			'contactEmail' => $user->contactEmail(),
    			'email' => $user->email(),
    			'avatar' => $user->avatar(),
    			'belongsToSchool' => $user->belongsToSchool(),
    			'schoolEmail' => $user->googleEmail(),
    			'role' => $user->role(),
    			'propositionsCount' =>  $propositionsFactory->getPropositionsCountByUser($user->userId()),
    	];
    
    	$viewPropositions = array();
    	foreach ($propositionsFactory->getFlaggedPropositionsExeptUsers($user->userId()) as $flag) {
    		
    		$proposition = $propositionsFactory->getProposition($flag->propositionId());
    		
    		$viewPropositions[$proposition->propositionId()] = [
    				'id' => $proposition->propositionId(),
    				'propositionSort' => $proposition->propositionSort(),
    				'propositionLong' => $proposition->propositionLong(),
    				'proposer' => $proposition->proposerId(),
    				'propositionCreationDate' => Carbon::createFromTimestamp(strtotime($proposition->date_created()))->diffForHumans(),
    				'userHasVoted' => $propositionsFactory->getUserVoteStatus($proposition->propositionId(), $user->userId()),
    				'deadline' => $proposition->deadline(),
    				'statusId' => $proposition->status(),
    				'ending_in' => Carbon::now()->diffInDays(Carbon::createFromTimestamp(strtotime($proposition->deadline())), false),
    				
    				'flagsCount' => $propositionsFactory->getFlagCount($proposition->propositionId()),
    				'offensiveCount' => $propositionsFactory->getFlagTypeCount($proposition->propositionId(), 1),
    				'inappropriateCount' => $propositionsFactory->getFlagTypeCount($proposition->propositionId(), 2),
    				'incomprehensibleCount' => $propositionsFactory->getFlagTypeCount($proposition->propositionId(), 3),
    		];
    	}
    	 
    	return view('moderator.flags', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser, 'propositions' => $viewPropositions]);
    }
}

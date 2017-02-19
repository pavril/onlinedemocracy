<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Illuminate\Mail\Message;

use App\User;
use App\UserFactory;
use App\Proposition;
use App\PropositionFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProfileController extends Controller
{
	
	public function __construct(Socialite $socialite){
		$this->socialite = $socialite;
		\App::setLocale(Auth::user()->language());
	}
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();
    	$propositionFactory = new PropositionFactory();
    	$propositionsCount = $propositionFactory->getPropositionsCountByUser($user->userId());
    	
    	$viewUser = [
    			'fullName' => $user->firstName() . " " . $user->lastName(),
    			'firstName' => $user->firstName(),
    			'lastName' => $user->lastName(),
    			'contactEmail' => $user->contactEmail(),
    			'email' => $user->email(),
    			'avatar' => $user->avatar(),
    			'belongsToSchool' => $user->belongsToSchool(),
    			'schoolEmail' => $user->googleEmail(),
                'msgraphDisplayName' => $user->msgraphDisplayName(),
    			'role' => $user->role(),
    			'lang' => $user->language(),
    			'propositionsCount' => $propositionsCount,
    	];

		$highlight = array();
		$highlight[session('highlight')] = true;
    	
    	return view('account_new.profile', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser, 'highlight' => $highlight]);
    }

    public function language()
    {
    	return redirect()->route('profile.main')->with('highlight', 'lang');
    }
    
    public function setLanguage($code) 
    {
    	$user = Auth::user();
    	$user->setLanguage($code);
    	$user->save();
    	
    	return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    			'first' => 'required',
    			'last' => 'required',
    			'contact' => 'email',
    			'lang' => 'required',
    	]);
    	 
    	if ($validator->fails()) {
    		 
    		return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
    		 
    	} else {
    		 
    		$firstName = $request->input('first');
    		$lastName = $request->input('last');
    		$contactemail = $request->input('contact');
    		$lang = $request->input('lang');
    	
    		$user = Auth::user();
    	
    		$user->setFirstName($firstName);
    		$user->setLastName($lastName);
    		$user->setContactEmail($contactemail);
    		$user->setLanguage($lang);
    	
    		$user->save();
    	
    		return redirect()->back();
    		 
    	}
    }
    
    public function propositions() {
    	$user = Auth::user();
    	$propositionFactory = new PropositionFactory();
    	$propositionsCount = $propositionFactory->getPropositionsCountByUser($user->userId());
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
    			'propositionsCount' => $propositionsCount,
    	];
    	
    	$propositionFactory = new PropositionFactory();
    	$userPropositions = $propositionFactory->getPropositionsByUser($user->userId());
    	
    	$viewPropositions = array();
    	
    	foreach ($userPropositions as $proposition) {
    	
    		$viewPropositions[$proposition->propositionId()] = [
    				'id' => $proposition->propositionId(),
    				'propositionSort' => $proposition->propositionSort(),
    				'propositionLong' => $proposition->propositionLong(),
    				'propositionCreationDate' => Carbon::createFromTimestamp(strtotime($proposition->date_created()))->diffForHumans(),
    				'userHasVoted' => $propositionFactory->getUserVoteStatus($proposition->propositionId(), $user->userId()),
    				'upvotes' => $propositionFactory->getUpvotes($proposition->propositionId()),
    				'downvotes' => $propositionFactory->getDownvotes($proposition->propositionId()),
    				'commentsCount' => $propositionFactory->getCommentsCount($proposition->propositionId()),
    				'deadline' => $proposition->deadline(),
    				'statusId' => $proposition->status(),
    				'blockReason' => $proposition->blockReason(),
    				'ending_in' => Carbon::now()->diffInDays(Carbon::createFromTimestamp(strtotime($proposition->deadline())), false),
    				'marker' => $propositionFactory->getMarker($proposition->propositionId()),
    		];
    	}
    	
    	return view('account_new.propositions', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser, 'propositions' => $viewPropositions]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getLinkAuthMsgraph()
    {
        return $this->socialite->with('graph')->scopes(['User.Read', 'Mail.Send'])->redirect();
    }

    public function getLinkAuthCallbackMsgraph()
    {
        if($socialUser = $this->socialite->with('graph')->user()){

            $client = new Client();

            $response = $client->request('GET', 'https://graph.microsoft.com/v1.0/me/', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $socialUser->token,
                    'Content-Type' => 'application/json;odata.metadata=minimal;odata.streaming=true'
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $body = json_decode($response->getBody());
                $school_regex = '/.+\(MAM-S[1-7][A-Z]+\)/';

                $id = $body->id;
                $displayName = $body->displayName;

                if (preg_match($school_regex, $displayName)) {
                    $userFactory = new UserFactory();

                    if($userFactory->msgraphIdIsTaken($id)) {
                        return redirect()->route('profile.main')->withErrors(['linkState' => trans('messages.profile.account.school_link_messages.already_linked')]);
                    } else {
                        $user = Auth::user();

                        $user->setGoogleId(null);
                        $user->setGoogleEmail(null);
                        $user->setMsgraphId($id);
                        $user->setMsgraphDisplayName($displayName);
                        $user->setBelongsToSchool(true);

                        $user->save();

                        return redirect()->route('profile.main');
                    }
                } else {
                    return redirect()->route('profile.main')->withErrors(['linkState' => trans('messages.profile.account.school_link_messages.not_valid_name')]);
                }
            }

        } else {
            return redirect()->route('profile.main')->withErrors(['linkState' => trans('messages.profile.account.school_link_messages.error')]);
        }
    }

    public function unlinkMsgraph()
    {
        $user = Auth::user();
        $userFactory = new UserFactory();

        $userFactory->unlinkGoogleAccount($user->userId());

        return redirect()->route('profile.main')->withErrors(['linkState' => trans('messages.profile.account.school_link_messages.unlinked')]);
    }

    public function relink()
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
            'schoolEmail' => $user->googleEmail(),
            'msgraphDisplayName' => $user->msgraphDisplayName(),
            'role' => $user->role(),
            'lang' => $user->language(),
        ];

        return view('account_new.relink', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser]);
    }
    
    public function password()
    {
    	$user = Auth::user();
    	$propositionFactory = new PropositionFactory();
    	$propositionsCount = $propositionFactory->getPropositionsCountByUser($user->userId());
    	 
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
    			'propositionsCount' => $propositionsCount,
    	];
    	 
    	return view('account_new.password', ['fullName' => $user->firstName() . " " . $user->lastName(), 'user' => $viewUser]);
    }
    
    public function password_update(Request $request)
    {
    	$user = Auth::user();
    	$propositionFactory = new PropositionFactory();
    	
    	$validator = Validator::make($request->all(), [
    			'old_password' => 'required',
    			'new_password' => 'required|confirmed|min:5',
    	]);
    	
    	if ($validator->fails()) {
    		 
    		return redirect()->back()->withErrors($validator->errors());
    		 
    	} else {
    	
    		$user = Auth::user();
    		
    		$old_password = $request->input('old_password');
    		$new_password = $request->input('new_password');
    		if (Auth::attempt(['email' => $user->email(), 'password' => $old_password])) {
    			
    			$user->setPassword(\Hash::make($new_password));
    			$user->save();
    			 
    			
    		} else {
    			return redirect()->back()->withErrors([
    					'old_password' => trans('messages.profile.password.wrong'),
    			]);
    		}
    		
    		return redirect()->back()->with('status', trans('messages.profile.password.updated'));
    		 
    	}
    
    }
    
}

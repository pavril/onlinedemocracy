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

use App\User;
use App\UserFactory;
use Illuminate\Database\Eloquent\Model;

class SessionController extends Controller
{
	
	public function __construct(Socialite $socialite){
		$this->socialite = $socialite;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Show login screen
    	return view('session_new.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Show sigup screen
    	return view('session_new.register');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $userFactory = new UserFactory();
        $user = $userFactory->getUser($userId);
        

        $userFactory = new UserFactory();
        return $userFactory->getUser(1);
    }
    
    public function registrate(Request $request) {
    	
    	$validator = Validator::make($request->all(), [
    			'first_name' => 'required',
    			'last_name' => 'required',
    			'email' => 'required|email|unique:users,email',
    			'password' => 'required|min:5|confirmed',
    	]);
    	
    	if ($validator->fails()) {
    		return redirect()->back()->withInput($request->except('password', 'password_confirm'))->withErrors($validator->errors());
    	} else {
    		
    		User::create([
    				"firstName" => $request->input("first_name"),
    				"lastName" => $request->input("last_name"),
    				"avatar" => null,
    				"email" => $request->input("email"),
    				"password" => \Hash::make($request->input("password")),
    		]);
    		
    		return redirect()->route('login');
    	}
    	
    }
    
    public function login(Request $request) {
    	
    	$validator = Validator::make($request->all(), [
	        'email' => 'required|email',
	        'password' => 'required|min:5',
		]);
    	
    	if ($validator->fails()) {
    		
    		return redirect()->back()->withInput($request->except('password'))->withErrors($validator->errors());
    		
    	} else {
    		
    		$email = $request->input('email');
    		$password = $request->input('password');
    		$remember = ($request->input('remember')) ? true : false;
    		
    		if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
			    
    			$user = Auth::user();
    			return redirect()->intended('/');

			} else {
				return redirect()->back()->withInput($request->except('password'))->withErrors([
    				'password' => trans('messages.session.login.wrong_pass'),
    			]);
			}
    		
    	}
    }
    
    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }


    public function getSocialAuth($provider=null)
    {
    	if(!config("services.$provider")) abort('404'); //just to handle providers that doesn't exist
    
    	return $this->socialite->with($provider)->redirect();
    }
    
    public function getSocialAuthCallback($provider=null)
    {

	    switch ($provider) {
		    case 'facebook':
		       	
		    	if($socialUser = $this->socialite->with($provider)->user()){
		    	
		    		$oAuthUser = User::firstOrCreate([
		    				'email' => $socialUser->email,
		    		]);
		    		
		    		Auth::login($oAuthUser, true);
		    		
					$user = Auth::user();
					
		    		$user->setfirstName($socialUser->user['first_name']);
		    		$user->setlastName($socialUser->user['last_name']);
		    		 
		    		$user->setAvatar($socialUser->avatar_original);
		    		
		    		$user->setFacebookId($socialUser->id);
		    		
		    		$user->save();
		    
		    		return redirect()->intended('/');
		    	
		    	} else {
		    		return redirect()->route('login')->withErrors([
		    				'social' => trans('messages.session.login.facebook_connection_error'),
		    		]);
		    	}
		    	
		        break;
		        
		    default:
		    	return redirect()->route('login')->withErrors([
		    			'social' => trans('messages.session.login.error'),
		    	]);
		}
    		
    	
    }
    
    public function landing()
    {
    	if (Auth::check()) {
    		return redirect()->route('propositions');
    	} else {
    		return redirect()->route('login');
    	}
    }
    
}

<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

use App\User;

class UserFactory extends Model {
	
	public function getUser($userId) {
		$user = User::find($userId);
		return $user;
	}
	
	public function findUserByEmailOrFail($userEmail) {
		if (User::where('email', '=', $userEmail)->count() == 1) {
			return User::whereRaw('email = ?', [$userEmail])->get();
		} else {
			return false;
		}
	}
	
	public function schoolEmailIsTaken($email) {
		if (User::where('googleEmail', '=', $email)->count() == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	public function unlinkGoogleAccount($userId) {
		$user = User::find($userId);
		
		$user->setGoogleId(null);
		$user->setGoogleEmail(null);
    					
		$user->setBelongsToSchool(false);
    				
    	$user->save();
    	
    	return true;
	}
	
	public function createUser($firstName, $lastName, $email, $avatar_url, $password) {
		return User::create([
				"firstName" => $firstName,
				"lastName" => $lastName,
				"avatar" => $avatar_url,
				"email" => $email,
				"password" => \Hash::make($password),
		]);
	}
	
}
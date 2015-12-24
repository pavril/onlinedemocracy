<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

use \App\User;
use \App\Comments;

class CommentFactory extends Model {
	
	public function getComment($id) {
		return Comments::find($id);
	}
	
	public function deleteComment($id) {
		return Comments::destroy($id);
	}
	
}
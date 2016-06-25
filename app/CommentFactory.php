<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

use \App\User;
use \App\Comments;
use PhpParser\Comment;

class CommentFactory extends Model {
	
	public function getComment($id) {
		return Comments::find($id);
	}
	
	public function deleteComment($id) {
		return Comments::destroy($id);
	}
	
	public function createComment($userId, $propositionId, $body) {
		
		return Comments::create([
				"commenter_id" => $userId,
				"proposition_id" => $propositionId,
				"body" => $body,
		]);
	}
	
}
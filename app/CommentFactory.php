<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

use \App\User;
use \App\Comments;
use \App\Likes;
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
	
	// Like comment
	public function likeComment(User $user, Comments $comment) {
		return Like::create([
				"user_id" => $user->id(),
				"comment_id" => $comment->commentId(),
		]);
	}
	
	// Remove like
	public function removeLike(Like $like) {
		return Like::destroy($like->id());
	}
	
}
<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

use \App\User;
use \App\Comments;
use \App\Like;
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
	
	public function findLikeById($likeId) {
		return Like::find($likeId);
	}
	
	public function getLikesByComment(Comments $comment) {
		return Like::where('comment_id','=',$comment->commentId())->orderBy('updated_at', 'DESC')->get();
	}
	
	public function findLikeByUserAndComment(User $user, Comments $comment) {
		return Like::where('comment_id','=',$comment->commentId())->where('user_id','=',$user->userId())->get()->first();
	}
	
	public function getNumberOfLikes(Comments $comment) {
		return Like::where('comment_id','=',$comment->commentId())->count();
	}
	
	public function userHasLiked(Comments $comment, User $user) {
		return Like::where('comment_id','=',$comment->commentId())->where('user_id','=',$user->userId())->count();
	}
	
	// Like comment
	public function likeComment(User $user, Comments $comment) {
		return Like::firstOrCreate([
				"user_id" => $user->userId(),
				"comment_id" => $comment->commentId(),
		]);
	}
	
	// Remove like
	public function removeLike(Like $like) {
		return Like::destroy($like->likeId());
	}
	
}
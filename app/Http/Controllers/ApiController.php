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

class ApiController extends Controller
{
	
    public function tag_search(Request $request) {
    	$results = array();
    	foreach (with(new TagsFactory())->searchTag($request->get("q"))->toArray() as $tag) {
    		$results[$tag['id']] = $tag['content'];
    	}
    	return response()->json($results);
    }
    
    public function proposition(Request $request) {
    	
    	$results = array();
    	
    	$propositionFactory = new PropositionFactory();
    	$userFactory = new UserFactory();
    	
    	$id = $request->get('id');
    	
    	$proposition = $propositionFactory->getProposition($id);
    		 
    	if ($proposition == null) {
    		return response()->json([404,"Not found"]);
    	}
    	if ($proposition->status() == Proposition::BLOCKED) {
    		return response()->json([404,"Not found"]);
    	}
    	
    	$proposer = $userFactory->getUser($proposition->proposerId());
    		 
    	$result = [
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
    			'votes' => [
    					'upvotes' => $propositionFactory->getUpvotes($id),
    					'downvotes' => $propositionFactory->getDownvotes($id),
    			],
   		];
    	
    	foreach ($propositionFactory->getComments($id) as $comment) {
    			 
    		$commentUser = $userFactory->getUser($comment->commenterId());
    			 
    		$result['comments'][$comment->commentId()] = [
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
    	
    	foreach (with(new TagsFactory())->getTagsByPropositionId($proposition->propositionId()) as $tag) {
    		$result['tags'][$tag->id()] = $tag->content();
    	}
    	
    	return response()->json($result);
    	
    }
    
}

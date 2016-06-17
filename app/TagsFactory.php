<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

use App\Proposition;
use \App\Votes;
use \App\User;
use \App\Comments;
use \App\Flags;
use \App\Marker;
use \App\Tags;

class TagsFactory {
	
	public function findOrCreate($tagString) {
		return Tags::firstOrCreate(['content' => $tagString]);
	}
	
	
	public function getTagByString($tagString) {
		return Tags::where('content', '=', $tagString)->first();
	}
	
	public function getAllTags() {
		return Tags::orderBy('created_at', 'desc')->get();
	}
	
	public function searchTag($term) {
		if (isset($term)) {
			$results = Tags::where('content', 'LIKE', "%$term%")->get();
		} else {
			$results = $this->getAllTags();
		}
		return $results;
	}
	
	public function getTagsByPropositionId($propositionId) {	
		 return Tags::join('propositions_tags', 'propositions_tags.tag_id', '=', 'tags.id')
		 	->join('propositions', 'propositions.propositionId', '=', 'propositions_tags.proposition_id')
			->where('propositions.propositionId', '=', $propositionId)->get();
	}
	
	public function getPropositionsByTagId($tagId) {
		return Proposition::join('propositions_tags', 'propositions_tags.proposition_id', '=', 'propositions.propositionId')
		->join('tags', 'tags.id', '=', 'propositions_tags.tag_id')
		->where('tags.id', '=', $tagId)->get();
	}
	
	public function getAproovedPropositionsByTagId($tagId) {
		return Proposition::join('propositions_tags', 'propositions_tags.proposition_id', '=', 'propositions.propositionId')
		->join('tags', 'tags.id', '=', 'propositions_tags.tag_id')
		->where('tags.id', '=', $tagId)->where('propositions.status', '=', 1)->get();
	}
	
	public function getFlaggedPropositionsExeptUsers($id) {
		return Flags::where('status', '<', 3)->whereNotIn('proposer_id', [$id])->groupBy('proposition')->join('propositions', 'flags.proposition', '=', 'propositions.propositionId')->get();
	}
	public function getFlagCount($id) {
		return Flags::where('proposition', [$id])->count();
	}
	public function getFlagTypeCount($id, $type) {
		return Flags::where('proposition', [$id])->where('type', $type)->count();
	}
	
	
	public function getPropositionsByUser($userId) {
		return Proposition::whereProposerId($userId)->orderBy('created_at', 'desc')->get();
	}
	
	public function getPropositionsCountByUser($userId) {
		return Proposition::whereProposerId($userId)->count();
	}
	
	//Shouldn't be here move to PropositionFactory
	public function getProposition($id) {
		return Proposition::find($id);
	}
	
	public function getUserVoteStatus($id, $userId) {
		$proposition = Proposition::find($id);
		$user = User::find($userId);
		
		$userHasVoted = false;
		
		if ($user->belongsToSchool() == true) {
			if (Votes::wherePropositionIdAndVoteSchoolEmail($proposition->propositionId(), $user->googleEmail())->count() == 1) {
				$userHasVoted = true;
			}
		}
		
		return $userHasVoted;
	}
	
	public function getUpvotes($id) {
		$proposition = Proposition::find($id);
		$upvotes = 0;
	
		$upvotes = Votes::wherePropositionIdAndVoteValue($proposition->propositionId(), 1)->get();
	
		$upvotesSum = 0;
	
		foreach ($upvotes as $upvote) {
			$upvotesSum ++;
		}
	
		return $upvotesSum;
	}
	
	public function getDownvotes($id) {
		$proposition = Proposition::find($id);
		$downvotes = 0;
		
		$downvotes = Votes::wherePropositionIdAndVoteValue($proposition->propositionId(), 0)->get();
		
		$downvotesSum = 0;
		
		foreach ($downvotes as $downvote) {
			$downvotesSum ++;
		}
		
		return $downvotesSum;
	}
	
	public function getComments($id) {
		return Comments::wherePropositionId($id)->orderBy('created_at', 'desc')->get();
	}
	
	public function getCommentsCount($id) {
		return Comments::wherePropositionId($id)->count();
	}
	
	public function getMarker($id) {
		return Marker::wherePropositionId($id)->get()->first();
	}
	
}
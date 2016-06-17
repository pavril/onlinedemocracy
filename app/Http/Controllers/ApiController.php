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
    
}

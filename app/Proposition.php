<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Proposition extends Model implements AuthenticatableContract
{
    use Authenticatable;
    const ACCEPTED = 1;
    const PENDING = 2;
    const BLOCKED = 3;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'propositions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['propositionId', 'proposer_id', 'propositionSort', 'propositionLong', 'deadline', 'status', 'block_reason', 'created_at', 'updated_at'];
    protected $primaryKey = 'propositionId';

    
    public function propositionId () {
    	return $this->attributes['propositionId'];
    }
    
    public function proposerId () {
    	return $this->attributes['proposer_id'];
    }
    
    public function proposer () {
    	return with(new UserFactory())->getUser($this->proposerId());
    }
    
    public function propositionSort () {
    	return $this->attributes['propositionSort'];
    }
    
    public function setPropositionSort ($value) {
    	return $this->attributes['propositionSort'] = $value;
    }
    
    public function propositionLong () {
    	return $this->attributes['propositionLong'];
    }
    
    public function setPropositionLong ($value) {
    	return $this->attributes['propositionLong'] = $value;
    }
    
    public function deadline () {
    	return $this->attributes['deadline'];
    }
    
    public function setDeadline ($value) {
    	return $this->attributes['deadline'] = $value;
    }
    
    public function status () {
    	return $this->attributes['status'];
    }
    
    public function setStatus ($value) {
    	return $this->attributes['status'] = $value;
    }
    
    public function blockReason () {
    	return $this->attributes['block_reason'];
    }
    
    public function setBlockReason ($value) {
    	return $this->attributes['block_reason'] = $value;
    }
    
    public function addTag(Tags $tag) {
    	with(new PropositionFactory)->addTagtoProposition($tag, $this);
    }
    
    public function date_created () {
    	return $this->attributes['created_at'];
    }

    public function date_updated () {
    	return $this->attributes['updated_at'];
    }
    
}

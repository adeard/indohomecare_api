<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class therapist_contract extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'therapist_contracts';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'therapist_id', 'therapist_session_id', 'contract_id'
    ];

    public function contracts(){
        return $this->hasOne('App\contract', 'id', 'contract_id');
    }

    public function therapists(){
        return $this->hasOne('App\therapist', 'id', 'therapist_id');
    }

    public function therapist_sessions(){
        return $this->hasOne('App\therapist_session', 'id', 'therapist_session_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contract extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'contracts';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'pj_id', 'patient_id', 'created_by', 'contract_no', 'status'
    ];

    public function users(){
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function pjs(){
        return $this->hasOne('App\pj', 'id', 'pj_id');
    }

    public function medic_tool_contracts(){
        return $this->hasMany('App\medic_tool_contract', 'contract_id', 'id');
    }

    public function contract_histories(){
        return $this->hasMany('App\contract_history', 'contract_id', 'id');
    }

    public function therapist_contracts(){
        return $this->hasMany('App\therapist_contract', 'contract_id', 'id');
    }

    public function nurse_contracts(){
        return $this->hasMany('App\nurse_contract', 'contract_id', 'id');
    }

    public function transport_contracts(){
        return $this->hasMany('App\transport_contract', 'contract_id', 'id');
    }

    public function event_contracts(){
        return $this->hasMany('App\event_contract', 'contract_id', 'id');
    }
}

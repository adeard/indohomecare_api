<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contract_request extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'contract_requests';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'request_no','created_by', 'name', 'phone_no', 'contract_status_id', 'description'
    ];

    public function contract_statuses(){
        return $this->hasOne('App\contract_status', 'id', 'contract_status_id');
    }

    public function transport_contract_requests(){
        return $this->hasMany('App\transport_contract_request', 'contract_request_id', 'id');
    }

    public function therapist_contract_requests(){
        return $this->hasMany('App\therapist_contract_request', 'contract_request_id', 'id');
    }

    public function nurse_contract_requests(){
        return $this->hasMany('App\nurse_contract_request', 'contract_request_id', 'id');
    }

    public function medic_tool_contract_requests(){
        return $this->hasMany('App\medic_tool_contract_request', 'contract_request_id', 'id');
    }

    public function event_contract_requests(){
        return $this->hasMany('App\event_contract_request', 'contract_request_id', 'id');
    }
}

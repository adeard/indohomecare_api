<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class therapist_contract_request extends Model
{
    use SoftDeletes;

    public $incrementing = true;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'therapist_contract_requests';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'contract_request_id', 'therapist_type_id', 'quantity'
    ];

    public function contract_requests(){
        return $this->hasOne('App\contract_request', 'id', 'contract_request_id');
    }

    public function therapist_types(){
        return $this->hasOne('App\therapist_type', 'id', 'therapist_type_id');
    }
}

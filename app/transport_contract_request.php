<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transport_contract_request extends Model
{
    use SoftDeletes;

    public $incrementing = true;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'transport_contract_requests';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'contract_request_id', 'transport_time_id', 'quantity'
    ];

    public function contract_requests(){
        return $this->hasOne('App\contract_request', 'id', 'contract_request_id');
    }

    public function transport_times(){
        return $this->hasOne('App\transport_time', 'id', 'transport_time_id');
    }
}

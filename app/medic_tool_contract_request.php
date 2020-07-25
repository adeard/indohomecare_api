<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class medic_tool_contract_request extends Model
{
    use SoftDeletes;

    public $incrementing = true;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'medic_tool_contract_requests';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'contract_request_id', 'medic_tool_name', 'quantity'
    ];

    public function contract_requests(){
        return $this->hasOne('App\contract_request', 'id', 'contract_request_id');
    }
}
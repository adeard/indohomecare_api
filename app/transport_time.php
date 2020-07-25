<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transport_time extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'transport_times';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'name', 'price'
    ];

    public function transport_contracts(){
        return $this->hasMany('App\transport_contract', 'transport_time_id', 'id');
    }

    public function transport_contract_requests(){
        return $this->hasMany('App\transport_contract_request', 'transport_time_id', 'id');
    }
}

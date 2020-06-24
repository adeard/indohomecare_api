<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transport_contract extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'transport_contracts';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'transport_time_id', 'distance', 'contract_id'
    ];

    public function contracts(){
        return $this->hasOne('App\contract', 'id', 'contract_id');
    }

    public function transport_times(){
        return $this->hasOne('App\transport_time', 'id', 'transport_time_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contract_history extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'contract_histories';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'contract_id', 'description'
    ];

    public function contracts(){
        return $this->hasOne('App\contract', 'id', 'contract_id');
    }
}

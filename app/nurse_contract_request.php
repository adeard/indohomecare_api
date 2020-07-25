<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nurse_contract_request extends Model
{
    use SoftDeletes;

    public $incrementing = true;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'nurse_contract_requests';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'contract_request_id', 'nurse_category_id', 'quantity'
    ];

    public function contract_requests(){
        return $this->hasOne('App\contract_request', 'id', 'contract_request_id');
    }

    public function nurse_categories(){
        return $this->hasOne('App\nurse_category', 'id', 'nurse_category_id');
    }
}

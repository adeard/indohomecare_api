<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nurse_category extends Model
{
    use SoftDeletes;

    public $incrementing = true;
    public $primaryKey   = 'id';

    protected $table = 'nurse_categories';
    protected $guarded = ['id'];

    protected $fillable = [
        'name'
    ];

    public function nurses(){
        return $this->hasMany('App\nurse', 'nurse_category_id', 'id');
    }

    public function nurse_sessions(){
        return $this->hasMany('App\nurse_session', 'nurse_category_id', 'id');
    }

    public function nurse_contract_requests(){
        return $this->hasMany('App\nurse_contract_request', 'nurse_category_id', 'id');
    }
}

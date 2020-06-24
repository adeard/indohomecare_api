<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nurse extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    public $keyType      = 'string';
    public $primaryKey   = 'id';

    protected $table = 'nurses';
    protected $guarded = ['id'];
    protected $dates =['deleted_at'];
    protected $fillable = [
        'fullname', 'nurse_category_id'
    ];

    public function nurse_categories(){
        return $this->hasOne('App\nurse_category', 'id', 'nurse_category_id');
    }

    public function nurse_contracts(){
        return $this->hasMany('App\nurse_contract', 'nurse_id', 'id');
    }
}

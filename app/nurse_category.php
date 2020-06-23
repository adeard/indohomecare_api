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

    // public function users(){
    //     return $this->hasMany('App\Users', 'role_id', 'id');
    // }
}

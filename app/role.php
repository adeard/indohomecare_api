<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    public $incrementing = true;
    public $primaryKey   = 'id';

    protected $table = 'roles';
    protected $guarded = ['id'];

    public function users(){
        return $this->hasMany('App\Users', 'role_id', 'id');
    }
}

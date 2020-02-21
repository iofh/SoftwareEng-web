<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{

    protected $table = 'group_users';
    public $timestamps = true;
    protected $fillable = [
        'user_id','group_id',

    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    /**
     * Table for this Model.
     * 
     * @var string
     */
    protected $table = 'bans'; // table for this model
    /**
     * Disable created_at and updated_at timestamp
     * columns.
     * 
     * @var boolean
     */
    public $timestamps = true;
    /**
     * Properties that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'id', 'user_id','ban_user_id',
    ];
}

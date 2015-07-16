<?php

namespace App;

use Jenssegers\Mongodb\Model;

class Node extends Model
{

    /**
     * The database collection used by the model.
     *
     * @var string
     */
    protected $collection = 'nodes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function reviews()
    {
        return $this->hasMany('Review', 'node');
    }
}

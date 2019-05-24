<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model {

    protected $table = 'menu_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

}

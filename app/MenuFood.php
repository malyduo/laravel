<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuFood extends Model
{
    protected $table = 'menu_foods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'kcal', 'id_allergens', 'description', 'id_client',
    ];
}

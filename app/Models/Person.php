<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_original',
        'slug',
        'birthday',
        'biography',
        'inst',
        'twitter',
        'picture',
        'status',
        'author_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'author_id' => 'integer',
    ];


    public function movies()
    {
        return $this->belongsToMany(\App\Models\Movie::class);
    }

    public function series()
    {
        return $this->belongsToMany(\App\Models\Serie::class);
    }

    public function author()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

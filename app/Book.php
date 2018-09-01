<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'author_id'
    ];


    public function users(){
        return $this->hasOne(App\User);
    }
}

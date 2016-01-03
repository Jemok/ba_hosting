<?php

namespace Md;

use Illuminate\Database\Eloquent\Model;

class Profpic extends Model
{
    protected $fillable = [

        'image'
    ];

    public function user()
    {
        return $this->hasOne('Md\User');
    }
}

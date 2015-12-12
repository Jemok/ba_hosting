<?php

namespace Md;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Category extends Model
{
    /**
     * The elements that can be mass assigned
     *
     * @var array
     */
    protected $fillable = ['name'];


    /**
     * A category can have multiple innovations under its name.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function innovations()
    {
        return $this->belongsTo('Md\Innovation');
    }
}

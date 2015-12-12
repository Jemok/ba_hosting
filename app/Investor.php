<?php

namespace Md;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $fillable = [''];

    /**
     * Links to the user the model belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Md\User');
    }
}

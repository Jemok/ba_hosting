<?php

namespace Md;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    /**
     * Fillable elements for the table chats
     *
     * @var array
     */
    protected $fillable = [
        'investor_id',
        'innovation_id',
        'innovator_id'
    ];


    /**
     * A single chat can have multiple comments in it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('Md\Message');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function innovation()
    {
        return $this->belongsTo('Md\Innovation');
    }
}

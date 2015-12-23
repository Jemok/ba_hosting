<?php

namespace Md;

use Illuminate\Database\Eloquent\Model;

class Innovation extends Model
{

    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [

        'innovationTitle',
        'innovationShortDescription',
        'innovationDescription',
        'tradeMarkName',
        'tradeMarkNumber',
        'innovationFund',
        'category_id',
        'fund_id',
        'user_id',
        'fundingStatus',
        'justifyFund',

    ];

    /**
     * An innovation belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Md\Category', 'category_id');
    }

    /**
     * An innovation belongs to a specific user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Md\User');
    }

    /**
     * An innovation can have multiple chats
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chats()
    {
        return $this->hasMany('Md\Chat');
    }

    public function fund()
    {
        return $this->hasOne('Md\Fund');
    }

    public function thread()
    {
        return $this->hasMany('Cmgmyr\Messenger\Models\Thread');
    }

    public function progress()
    {
        return $this->hasMany('Md\Progress');
    }
}

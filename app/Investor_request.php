<?php

namespace Md;

use Illuminate\Database\Eloquent\Model;

class Investor_request extends Model
{
    /**
     * The table to be used by this model
     * @var string
     */
    protected  $table = 'investor_requests';

    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [
        'investor_email',
        'request_status',
        'request_link',
        'job_title',
        'company'
    ];
}

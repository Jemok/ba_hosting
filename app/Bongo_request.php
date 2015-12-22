<?php

namespace Md;

use Illuminate\Database\Eloquent\Model;

class Bongo_request extends Model
{
    /**
     * The table to be used by this model
     * @var string
     */
    protected  $table = 'bongo_requests';

    /**
     * The fields that can be mass assigned
     * @var array
     */
    protected $fillable = [
        'bongo_email',
        'first_name',
        'last_name',
        'request_status',
        'request_link',
        'company',
        'job_title',
        'field'
    ];

    public function user(){

        return $this->hasOne('Md\User');
    }
}

<?php

namespace Md;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress';

    protected $fillable = [

        'investor_id',
        'innovation_id',
        'progress_status'

    ];

    public function innovation()
    {
        return $this->belongsTo('Md\Innovation');
    }
}

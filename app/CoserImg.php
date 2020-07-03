<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoserImg extends Model
{
    protected $table = 'coser_imgs';

    public function topic()
    {
        return $this->belongsTo('App\CoserTopic', 'coser_topic_id');
    }
}

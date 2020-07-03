<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoserTopic extends Model
{
    protected $table = 'coser_topics';

    public function imgs()
    {
        return $this->hasMany('App\CoserImg', 'coser_topic_id');
    }

    public function category()
    {
        return $this->belongsTo('App\CoserCategory', 'coser_category_id');
    }
}

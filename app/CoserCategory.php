<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoserCategory extends Model
{
    protected $table = 'coser_categories';

    public function topics()
    {
        return $this->hasMany('App\CoserTopic', 'coser_category_id');
    }
}

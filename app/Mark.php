<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    public function fromScene()
    {
        return $this->belongsTo('App\Scene', 'from_scene');
    }

    public function toScene()
    {
        return $this->belongsTo('App\Scene', 'to_scene');
    }

    public function getFromSceneNameAttribute()
    {
        return $this->fromScene->name;
    }

    public function getToSceneNameAttribute()
    {
        return $this->toScene->name;
    }

    public function object()
    {
        return $this->belongsTo('App\ObjectNew');
    }
}

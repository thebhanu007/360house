<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Scene extends Model
{
    public function getImageUrlAttribute()
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            return url('/scenes/'.$this->object_new_id.'/'.$this->id.'_mobile.'.$this->extension).'?'.rand(1000000, 9999999);
        }
        return url('/scenes/'.$this->object_new_id.'/'.$this->id.'.'.$this->extension).'?'.rand(1000000, 9999999);
    }

    public function getThumbUrlAttribute()
    {
        return url('scenes/'.$this->object_new_id.'/'.$this->id.'_thumb.'.$this->extension).'?'.rand(1000000, 9999999);
    }

    public function getImageWidthAttribute()
    {
        return getimagesize($this->image_url)[0];
    }

    public function getImageHeightAttribute()
    {
        return getimagesize($this->image_url)[1];
    }

    public function fromMarks()
    {
        return $this->hasMany('App\Mark', 'from_scene');
    }

    public function toMarks()
    {
        return $this->hasMany('App\Mark', 'to_scene');
    }

    public function object()
    {
        return $this->belongsTo('App\Object');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
	protected $fillable = ['name', 'value'];

    static function set($name, $value)
    {
    	$option = self::firstOrCreate(['name' => $name]);
    	$option->value = $value;
    	$option->save();
    }

    static function get($name, $default = null)
    {
    	$option = self::where('name', $name)->first();
    	if ($option) return $option->value;
    	elseif ($default) return $default;
    	return false;
    }
}

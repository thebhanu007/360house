<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class ObjectNew extends Model
{
    protected $table = 'objects';
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function getTypeNameAttribute()
    {
        return self::getTypes()[$this->type];
    }

    public function scopeActive($query)
    {
        return $this->where(function($query) {
        	return $query->where('expired', 0)->when(Auth::check(), function($query) {
        		return $query->orWhere('user_id', Auth::user()->id);
        	});
        })->where('active', 1)->where(function($query) {
            return $query->where('type', '<>', null)->orWhere('action', 3);
        });
    }

    public function scopeFinished($query)
    {
        return $query->where('type', '<>', null)->orWhere('action', 3);
    }

    static function getTypes()
    {
        return [
        '1' => 'Квартира',
        '2' => 'Комната',
        '3' => 'Дом',
        '4' => 'Коммерческая',
        '5' => 'Новостройка',
        '6' => 'Объект'
        ];
    }

    static function getRooms()
    {
        return [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4+',
        ];
    }

    static function getDuration()
    {
        return [
        '1' => 'На длительный срок',
        '2' => 'Посуточно',
        ];
    }

    static function getMaterials()
    {
        return [
        '1' => 'Кирпич',
        '2' => 'Блоки',
        '3' => 'Монолит',
        '4' => 'Панель',
        '5' => 'Дерево',
        ];
    }

    public function getMaterialNameAttribute()
    {
        return self::getMaterials()[$this->material];
    }

    public function getActionNameAttribute()
    {
        switch ($this->action) {
            case 1: return 'на продажу';
            case 2: return 'в аренду';
        }
    }

    public function getActionCodeAttribute()
    {
        switch ($this->action) {
            case 1: return 'sale';
            case 2: return 'rent';
            case 3: return 'pano';
        }
    }

    public function getUrlAttribute()
    {
        return route($this->action_code.'.show', ['id' => $this->id]);
    }

    public function getPrintPriceAttribute()
    {
        return number_format($this->price, 0, '.', ' ').' руб.';
    }

    public function getPrintDepositAttribute()
    {
        return number_format($this->deposit, 0, '.', ' ').' руб.';
    }

    public function getThumbAttribute()
    {
        $firstScene = $this->scenes->first();
        if ($firstScene)
            return $firstScene->thumb_url;
        return url('images/placeholder.png');
    }

    public function scopeFilter($query)
    {
        if (Request::route()->getName() == 'sale') {
            $query->where('action', 1);
        } else {
            $query->where('action', 2);
            if (Request::input('duration')) $query->where('duration', Request::input('duration'));
        }
        if (Request::input('type')) $query->where('type', Request::input('type'));
        $query->when(Request::input('city'), function($query) {
            return $query->select('objects.*')->leftJoin('cities', 'cities.id', '=', 'objects.city_id')->where('cities.name', Request::input('city'));
        });
        $query->when(Request::input('rooms') && Request::input('type') != 2, function($query) {
            $query->where(function($query) {
                $query->whereIn('rooms', Request::input('rooms'));
                if (in_array('4', Request::input('rooms'))) {
                    $query->orWhere('rooms', '>', 3);
                }
            });
            return $query;
        });
        $query->when(Request::input('material'), function($query) {
            return $query->where('material', Request::input('material'));
        });
        $query->when(Request::input('price.from'), function($query) {
            return $query->where('price', '>=', Request::input('price.from'));
        });
        $query->when(Request::input('price.to'), function($query) {
            return $query->where('price', '<=', Request::input('price.to'));
        });
        $query->when(Request::input('floor.from'), function($query) {
            return $query->where('floor', '>=', Request::input('floor.from'));
        });
        $query->when(Request::input('floor.to'), function($query) {
            return $query->where('floor', '<=', Request::input('floor.to'));
        });
        $query->when(Request::input('floors.from'), function($query) {
            return $query->where('floors', '>=', Request::input('floors.from'));
        });
        $query->when(Request::input('floors.to'), function($query) {
            return $query->where('floors', '<=', Request::input('floors.to'));
        });
        $query->when(Request::input('size.from'), function($query) {
            return $query->where('size', '>=', Request::input('size.from'));
        });
        $query->when(Request::input('size.to'), function($query) {
            return $query->where('size', '<=', Request::input('size.to'));
        });
        $query->when(Request::input('not_last'), function($query) {
            return $query->whereColumn('floor', '<>', 'floors');
        });
        $query->when(Request::input('no_deposit'), function($query) {
            return $query->where(function($query) { 
                return $query->whereNull('deposit')->orWhere('deposit', 0);
            });
        });
        $query->when(Request::input('no_commission'), function($query) {
            return $query->where(function($query) { 
                return $query->whereNull('commission')->orWhere('commission', 0);
            });
        });
        return $query;
    }

    public function scopeAdminFilter($query)
    {
        $query->when(Request::input('city'), function($query) {
            return $query->select('objects.*')->leftJoin('cities', 'cities.id', '=', 'objects.city_id')->where('cities.id', Request::input('city'));
        });
        $query->when(Request::input('id'), function($query) {
            return $query->where('objects.id', Request::input('id'));
        });
        return $query;
    }

    public function scopeSort($query)
    {
        if (Request::input('sort')) list($sort, $order) = explode('|', Request::input('sort'));
        else $sort = $order = '';
        return $query->orderBy(Request::input('sort') ? $sort : 'created_at', Request::input('sort') ? $order : 'desc');
    }

    public function getFullNameAttribute()
    {
        $output = '';
        if ($this->type == 1) $output .= $this->rooms.'-комнатная квартира';
        else $output .= $this->type_name;
        $output .= ' '.$this->action_name;

        return $output;
    }

    public function getFullAddressAttribute()
    {
        return $this->city->name.', '.$this->address;
    }

    public function getPrintSizeAttribute()
    {
        return $this->size.' м<sup>2</sup>';
    }

    public function scopeFilterCoords($query)
    {
        $latitude = explode(';', Request::input('latitude'));
        $longitude = explode(';', Request::input('longitude'));

        return $query->whereBetween('latitude', $latitude)->whereBetween('longitude', $longitude);
    }

    public function scenes()
    {
        return $this->hasMany('App\Scene');
    }

    public function marks()
    {
        return $this->hasMany('App\Mark');
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'entity_id');
    }

    public function getPaidScenesAttribute()
    {
        $totalSumPaid = 0;
        foreach ($this->orders->where('status', 2)->where('type', 1) as $order) $totalSumPaid += $order->sum;
        $paid_scenes = $totalSumPaid / ENV('SCENE_COST');

        return $this->scenes->where('paid', 1)->count() + $paid_scenes + 2;
    }

    public function getUnpaidScenesAttribute()
    {
        return 0;
        return $this->scenes->count() - $this->paid_scenes;
    }

    public function getExpiresInAttribute()
    {
        return 1000;
        $days = $difference = $this->scenes->count() > 2 ? 90 : 30;

        $lastDate = $this->created_at;
        foreach ($this->orders()->where('type', 4)->where('status', 2)->orderBy('paid_at', 'asc')->get() as $order) {
            if ($order->paid_at->diffInDays($lastDate, false) > $difference) $days += $order->paid_at->diffInDays($lastDate, false) - $difference;
            $days += 30;
            $lastDate = $order->paid_at;
            $difference = 30;
        }
        return \Carbon\Carbon::now()->diffInDays($this->created_at->addDays($days), false);
    }

    public function getExpiresInStringAttribute()
    {
        if (in_array($this->expires_in, [11, 12, 13, 14])) return $this->expires_in.' дней';
        $lastDigit = substr($this->expires_in, -1);
        switch ($lastDigit) {
            case '1': 
                return $this->expires_in.' день';
            case '2': 
            case '3': 
            case '4': 
                return $this->expires_in.' дня';
            case '5': 
            case '6': 
            case '7': 
            case '8': 
            case '9': 
            case '0': 
                return $this->expires_in.' дней';
        }
    }

    public function getDeletedInAttribute()
    {
        return $this->expires_in + 30;
    }

    public function getDeletedInStringAttribute()
    {
        $deletedIn = $this->deleted_in;
        if (in_array($deletedIn, [11, 12, 13, 14])) return $deletedIn.' дней';
        $lastDigit = substr($deletedIn, -1);
        switch ($lastDigit) {
            case '1': 
                return $deletedIn.' день';
            case '2': 
            case '3': 
            case '4': 
                return $deletedIn.' дня';
            case '5': 
            case '6': 
            case '7': 
            case '8': 
            case '9': 
            case '0': 
                return $deletedIn.' дней';
        }
    }

    public function getExpiresSoonAttribute()
    {
        return $this->expires_in <= 7;
    }

    public function getDocuments()
    {
        return '';
    }
	
	
}

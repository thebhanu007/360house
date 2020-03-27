<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dates = ['paid_at'];
    
    public function entity()
    {
        switch ($this->type) {
            case 1: return $this->belongsTo('App\Order', 'id', 'entity_id');
            case 2: return $this->belongsTo('App\Pack', 'entity_id', 'id');
        }
    }

    public function getEntityUrlAttribute()
    {
        switch ($this->type) {
            case 1: 
            case 3:
            case 4:
                $object = \App\ObjectNew::findOrFail($this->entity_id);
                return route($object->action_code.'.show', ['id' => $object->id]);
            case 2: return route('packs');
        }
    }

    public function createPayment()
    {
        $data = json_encode([
                'TerminalKey' => ENV('BANK_TERMINAL_ID'),
                'Amount' => $this->sum * 100,
                'OrderId' => $this->id,
                'Description' => 'Оплата тура №'.$this->id.' на сайте krugomdom.com.'
            ]
        );
        $opts = ['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $data
            ]
        ];
        $context  = stream_context_create($opts);
        $result = file_get_contents(ENV('BANK_URL').'/Init', false, $context);

        $info = json_decode($result);

        return $info;
    }

    public function confirm()
    {
        if ($this->external_id) {
            $data = json_encode([
                    'TerminalKey' => ENV('BANK_TERMINAL_ID'),
                    'PaymentId' => $this->external_id,
                    'Token' => hash('sha256', ENV('BANK_PASSWORD').$this->external_id.ENV('BANK_TERMINAL_ID'))
                ]
            );
            $opts = ['http' => [
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $data
                ]
            ];
            $context  = stream_context_create($opts);
            $result = file_get_contents(ENV('BANK_URL').'/GetState', false, $context);

            $info = json_decode($result);

            if ($info->Status == 'CONFIRMED' && $this->status == 1) {
                switch ($this->type) {
                    case 2:
                        $pack = \App\Pack::find($this->entity_id);
                        $this->user->paid_scenes += $pack->amount;
                        $this->user->save();
                        break;
                    case 3:
                        $pack = \App\Pack::where('price', $this->sum)->first();

                        $this->user->paid_scenes += $pack->amount;

                        $object = \App\ObjectNew::find($this->entity_id);

                        $this->user->paid_scenes -= $object->unpaid_scenes;

                        if ($this->user->paid_scenes >= 0) {
                            $freeScenes = $object->scenes->sortBy('id')->slice($object->paid_scenes);
                            foreach ($freeScenes as $freeScene) {
                                $freeScene->paid = 1;
                                $freeScene->save();
                            }
                        }
                        $this->user->save();
                        break;
                    case 4: 
                        $object = \App\ObjectNew::find($this->entity_id);
                        $object->expired = 0;
                        $object->save();
                        break;
                }

                $this->paid_at = date('Y-m-d H:i:s');
                $this->status = 2;
                $this->save();
            } elseif ($info->Status != 'CONFIRMED' && $this->status == 1) {
                $this->status = 3;
                $this->paid_at = date('Y-m-d H:i:s');
                $this->save();
            }
        }
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

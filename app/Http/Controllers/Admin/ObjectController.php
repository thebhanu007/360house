<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ObjectController extends Controller
{
    private function getRules()
    {
        return [
        'description' => 'required|max:2000',
        'price' => 'required|numeric',
        'size' => 'nullable|numeric',
        'tour' => 'mimes:zip',
        'city' => 'required',
        'address' => 'required',
        'longitude' => 'required',
        'action' => 'required',
        ];
    }

    private function getMessages()
    {
        return [
            'description.required' => 'Поле описание должно быть заполнено.',
            'description.max' => 'Описание не может содержать более 2000 символов.',
            'price.required' => 'Поле цена должно быть заполнено.',
            'price.numeric' => 'Неверный формат цены.',
            'size.numeric' => 'Неверный формат площади.',
            'tour.mimes' => 'Неверный формат тура.',
            'tour.required' => 'Поле 3D тур должно быть заполнено.',
            'address.required' => 'Поле адрес должно быть заполнено.',
            'longitude.required' => 'Необходимо выбрать расположение объекта на карте.',
            'city.required' => 'Поле город должно быть заполнено.',
            'action.required' => 'Необходимо выбрать тип объявления.',
            ];
    }

    public function index()
    {
        $objects = \App\ObjectNew::paginate(50);

        return view('admin.objects', ['objects' => $objects]);
    }

    public function create()
    {
        $cities = \App\City::all();
        return view('admin.objects_form', ['cities' => $cities]);
    }

    public function store(Request $request)
    {
        $this->validate(
            $request, 
            $this->getRules() + [
                'tour' => 'mimes:zip|required',
            ], 
            $this->getMessages());

        $object = new \App\Object();
        $object->description = $request->description;
        $object->price = $request->price;
        $object->size = $request->size;
        $object->address = $request->address;
        $object->rooms = $request->rooms;
        $object->city_id = $request->city;
        $object->type = $request->type;
        $object->action = $request->action;
        $object->duration = $request->duration;
        $object->active = (int) $request->has('active');
        $object->latitude = $request->latitude;
        $object->longitude = $request->longitude;
        $object->floor = $request->floor;
        $object->commission = $request->commission;
        $object->deposit = $request->deposit;
        /*$address = file_get_contents('https://geocode-maps.yandex.ru/1.x/?sco=latlong&format=json&geocode='.$object->latitude.','.$object->longitude);
        $address = json_decode($address);
        foreach ($address->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->Address->Component as $component) {
            switch ($component->kind == 'street') {

            }
        }*/

        $object->save();

        /*if ($request->hasFile('image')) {
            if ($object->image) Storage::delete('public/images/objects/'.$object->image);
            $newName = $object->id.'.'.$request->image->extension();
            $request->image->storeAs('public/images/objects', $newName);
            $object->image = $newName;

            $object->save();
        }*/

        if ($request->hasFile('tour')) {
            $newName = $object->id.'.zip';
            $request->tour->storeAs('public/tours', $newName);
            $zip = new \ZipArchive;
            if ($zip->open(Storage::url('tours/'.$newName))) {
                $zip->extractTo(Storage::url('tours/'.$object->id));
                $zip->close();
            }
            Storage::delete('public/tours/'.$newName);
        }

        return redirect()->route('admin.objects.index')->with(['message' => 'Объект успешно создан']);
    }

    public function edit($id)
    {
        $cities = \App\City::all();
        $object = \App\ObjectNew::find($id);
        return view('create_object', ['cities' => $cities, 'object' => $object]);
    }

    public function update(Request $request, $id)
    {
		exit;
        $this->validate($request, $this->getRules(), $this->getMessages());

        $object = \App\ObjectNew::find($id);
        $object->description = $request->description;
        $object->price = $request->price;
        $object->size = $request->size;
        $object->address = $request->address;
        $object->rooms = $request->rooms;
        $object->city_id = $request->city;
        $object->type = $request->type;
        $object->action = $request->action;
        $object->duration = $request->duration;
        $object->active = (int) $request->has('active');
        $object->latitude = $request->latitude;
        $object->longitude = $request->longitude;
        $object->floor = $request->floor;
        $object->commission = $request->commission;
        $object->deposit = $request->deposit;

        $object->save();

        if ($request->hasFile('tour')) {
            Storage::deleteDirectory('public/tours/'.$object->id);
            $newName = $object->id.'.zip';
            $request->tour->storeAs('public/tours', $newName);
            $zip = new \ZipArchive;
            if ($zip->open(Storage::url('tours/'.$newName))) {
                $zip->extractTo(Storage::url('tours/'.$object->id));
                $zip->close();
            }
            Storage::delete('public/tours/'.$newName);
        }

        return redirect()->route('admin.objects.index')->with(['message' => 'Объект успешно сохранен.']);
    }

    public function show($id)
    {
        return redirect()->route('admin.objects.index');
    }
}

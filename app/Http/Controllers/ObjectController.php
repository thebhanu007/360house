<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

error_reporting(E_ALL & ~E_NOTICE);

class ObjectController extends Controller
{
    private function getRules()
    {
        return [
        'description' => 'required|max:2000',
        'price' => 'required|numeric',
        'phone' => 'required',
        'size' => 'nullable|numeric',
        'longitude' => 'required',
        'action' => 'required',
        'type' => 'required',
        'commission' => 'nullable|numeric',
        'deposit' => 'nullable|numeric',
        'rooms' => 'required|numeric',
        'floor' => 'nullable|numeric',
        'floors' => 'nullable|numeric',
        ];
    }

    private function getMessages()
    {
        return [
            'description.required' => 'Поле описание должно быть заполнено.',
            'description.max' => 'Описание не может содержать более 2000 символов.',
            'price.required' => 'Поле цена должно быть заполнено.',
            'price.numeric' => 'Неверный формат цены.',
            'phone.required' => 'Поле телефон должно быть заполнено.',
            'size.numeric' => 'Неверный формат площади.',
            'longitude.required' => 'Необходимо выбрать расположение объекта на карте.',
            'action.required' => 'Необходимо выбрать тип объявления.',
            'commission.numeric' => 'Неверный формат комисиии.',
            'floor.numeric' => 'Неверный формат этажа.',
            'floors.numeric' => 'Неверный формат поля этажность.',
            'deposit.numeric' => 'Неверный формат залога.',
            'rooms.required' => 'Поле кол-во комнат должно быть заполнено.',
            'rooms.required' => 'Неверный формат кол-ва комнат.',
            'type.required' => 'Необходимо выбрать тип объекта.',
            ];
    }

    public function index()
    {
    	$objects = \App\ObjectNew::active()->whereIn('objects.action', [1, 2])->filter()->sort()->paginate(30);
    	$regions = \App\Region::orderBy('name')->get();

    	return view('catalog.list', ['objects' => $objects, 'regions' => $regions]);
    }

    public function show(Request $request, $id)
    {
        $action = explode('.', $request->route()->getName());
        switch ($action[0]) {
            case 'sale': $action = 1; break;
            case 'rent': $action = 2; break;
            case 'pano': $action = 3; break;
        }
    	$object = \App\ObjectNew::active()->where('id', $id)->where('action', $action)->firstOrFail();
        $objects = \App\ObjectNew::active()->with('city')->where('active', 1)->whereIn('action', [1, 2])->take(10)->orderBy('created_at', 'desc')->get();
		
		$images = explode(',', $object->image);
		$img_src = "";
		foreach($images as $key => $image){
			if($key != 0){
				$img_src .= '<div class="product-images" id="image" style="float:left;">';
				$img_src .= '<img src="http://360house.ru/documents/'.$image.'" class="popupimage popimage img-thumbnail" height="70" width="70" style="margin-right:10px; border:1px solid #ccc;">';
				$img_src .= '</div>';
			}
		}
		$img_src .= '<div id="myImageModal" class="modal">';
		$img_src .= '<span class="close">&times;</span>';
        $img_src .= '<div class="modal-dialog">';
		$img_src .= '<img class="modal-content" id="img01">';
        $img_src .= '</div>';
        $img_src .= '</div>';

    	if ($object) return view('catalog.detail', ['object' => $object, 'objects' => $objects, 'img' => $img_src]);
    }

    public function phone(Request $request)
    {
        $phone = \App\ObjectNew::where('id', $request->id)->select('phone')->pluck('phone')[0];

        return $phone;
    }

    public function mapObjects(Request $request)
    {
        $mapObjects = \App\ObjectNew::select('latitude', 'longitude', 'price', 'id', 'type', 'rooms', 'action', 'address', 'city_id')->filterCoords()->take(100)->get();
        foreach ($mapObjects as &$object) {
            $object->city = $object->city;
            $object->thumb = $object->thumb;
            $object->full_name = $object->full_name;
            $object->full_address = $object->full_address;
            $object->print_price = $object->print_price;
            $object->url = $object->url;
        }

        return $mapObjects;
    }

    public function create()
    {
        $object = null;
        if (old('object_id')) {
            $object = \App\ObjectNew::find(old('object_id'));
        }

        return view('objects.object_form', ['object' => $object]);
    }

	public function upload_documents(Request $request)
	{
		$total_file = "";
		for($i = 0; $i < $request->total_image; $i++){
			$file = "file".$i;
			if($request->$file){
				$file = $request->$file;
				$filename = time().$file->getClientOriginalName();
				$file->move(public_path().'/../public_html/documents/', $filename);
				$total_file .= ",".$filename;
			}
		}
		echo $total_file;

	}
	
    public function store(Request $request, $message = 'Объявление успешно создано.')
    {
        $this->validate($request, [
            'scene_id' => 'required',
            'action' => 'required',
            ], [
            'scene_id.required' => 'Нужно загрузить хотя бы одну панораму.',
            'action.required' => 'Нужно выбрать тип объявления.'
            ]);
		//$street = '';
		//$house = '';
        foreach ($request->scene_id as $i => $sceneId) {
            $scene = \App\Scene::find($sceneId);
            $scene->name = $request->name[$i];
            $scene->save();
        }

        if ($request->has('from')) {
            foreach ($request->from as $i => $fromScene) {
                if ($fromScene && isset($request->to[$i])) {
                    if (isset($request->mark_id[$i])) $mark = \App\Mark::find($request->mark_id[$i]);
                    else $mark = new \App\Mark();
                    $mark->object_id = $request->object_id;
                    $mark->from_scene = $fromScene;
                    $mark->to_scene = $request->to[$i];
                    $mark->from_pitch = $request->from_pitch[$i];
                    $mark->from_yaw = $request->from_yaw[$i];
                    $mark->from_offset = $request->from_offset[$i];
                    $mark->to_pitch = $request->to_pitch[$i];
                    $mark->to_yaw = $request->to_yaw[$i];
                    $mark->to_offset = $request->to_offset[$i];
                    $mark->save();
                }
            }
        }

        if ($request->action != 3)
            $this->validate($request, $this->getRules(), $this->getMessages());

        if ($request->action != 3) {

            $address = json_decode(file_get_contents('https://geocode-maps.yandex.ru/1.x/?apikey=2fa495ca-d3b3-46cd-aecc-11ef7ac41e3e&format=json&geocode='.$request->longitude.','.$request->latitude));
            foreach ($address->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->Address->Components as $component) {
                switch ($component->kind) {
                    case 'locality': $cityName = $component->name; break;
                    case 'street': $street = $component->name; break;
                    case 'house': $house = $component->name; break;
                    //case 'province': if (!isset($regionName)) $regionName = $component->name; break;
                    case 'province': $regionName = $component->name; break;
                }
            }
            if (isset($cityName) && $cityName && isset($regionName) && $regionName) {
                $region = \App\Region::where('name', $regionName)->first();
                if (!$region) {
                    $region = new \App\Region();
                    $region->name = $regionName;
                    $region->save();
                }
                $city = \App\City::where('name', $cityName)->first();
                if (!$city) {
                    $city = new \App\City();
                    $city->name = $cityName;
                    $city->region_id = $region->id;
                    $city->save();
                }
            } else return redirect()->back()->withInput($request->all())->withErrors(['error' => 'Не удалось определить местоположение объекта.']);
        } else {
            $street = $house = '';
        }
		
        $object = \App\ObjectNew::find($request->object_id);
        $object->description = $request->description;
        $object->price = $request->price;
        $object->size = $request->has('size') ? $request->size : 0;
        $object->address = $street.', '.$house;
        $object->rooms = $request->rooms;
        $object->city_id = $request->action == 3 ? null : $city->id;
        $object->type = $request->type;
        $object->action = $request->action;
        $object->duration = $request->duration;
        $object->latitude = $request->latitude;
        $object->longitude = $request->longitude;
        $object->floor = $request->floor;
        $object->commission = $request->commission;
        $object->deposit = $request->deposit;
        $object->phone = $request->phone;
        $object->active = 1;
        $object->scene_type = $request->scene_type;
		$object->image = $request->image;
		
		
		//if(Auth::user()->id != $object->user_id){
		//	
		//}
		//$object->user_id = Auth::user()->id;
        $object->material = $request->has('material') ? $request->material : 1;
        $object->save();

        $firstScene = $object->scenes->first();
        $img = Image::make(file_get_contents(Storage::url('/scenes/'.$firstScene->object_id.'/'.$firstScene->id.'.'.$firstScene->extension)))->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->save(Storage::url('/scenes/'.$firstScene->object_id.'/'.$firstScene->id.'_thumb.'.$firstScene->extension));

        if ($object->unpaid_scenes > 0) {
            if (Auth::user()->paid_scenes > 0) {
                Auth::user()->paid_scenes -= $object->unpaid_scenes;

                $freeScenes = $object->scenes->sortBy('id')->slice($object->paid_scenes);
                foreach ($freeScenes as $freeScene) {
                    $freeScene->paid = 1;
                    $freeScene->save();
                }
                Auth::user()->save();

                if (Auth::user()->paid_scenes < 0) {
                    Auth::user()->paid_scenes = 0;
                    Auth::user()->save();
                    return redirect()->route('pay.choose', ['id' => $object->id]);
                }
            } else {
                return redirect()->route('pay.choose', ['id' => $object->id]);
            }
        }

        return redirect($object->url)->with(['message' => $message]);
    }

    public function edit($id)
    {
        if (!\App\ObjectNew::where('user_id', Auth::user()->id)->where('id', $id)->first() && !Auth::user()->isAdmin()) return abort(403);

        $cities = \App\City::all();
        $object = \App\ObjectNew::find($id);
        $img_src = "";
        $img_count = 0;
        if(!empty($object->image)){
            $images = explode(",", $object->image);
            foreach($images as $key => $image){
                if($key != 0){
                    $img_src .= '<div class="product-images" id="image-'.$key.'" style="float:left;">';
                    $img_src .= '<img src="http://360house.ru/documents/'.$image.'" class="img-thumbnail" height="70" width="70" style="margin-right:10px; border:1px solid #ccc;">';
                    $img_src .= '<button class="btn-remove btn-success" type="button" value="'.$image.'" data-id="image-'.$key.'">X</button>';
                    $img_src .= '</div>';
                    $img_count++;
                }
            }
        }
                

        return view('objects.object_form', ['cities' => $cities, 'object' => $object, 'img_src' => $img_src, 'img_count' => $img_count]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'scene_id' => 'required',
            'action' => 'required',
            ], [
            'scene_id.required' => 'Нужно загрузить хотя бы одну панораму.',
            'action.required' => 'Нужно выбрать тип объявления.'
            ]);

        if (!\App\ObjectNew::where('user_id', Auth::user()->id)->where('id', $id)->first() && !Auth::user()->isAdmin()) return abort(403);

        return $this->store($request, 'Объявление успешно обновлено.');
    }

    public function addScene(Request $request)
    {
        if ($request->hasFile('scene')) {
            if ($request->has('scene_id')) $scene = \App\Scene::find($request->scene_id);
            else $scene = new \App\Scene();
            $scene->extension = $request->scene->extension();
            $scene->name = $request->name;
            if ($request->has('object_id')) {
                $object = \App\ObjectNew::find($request->object_id);
                if ($object->user_id != Auth::user()->id && !Auth::user()->isAdmin()) return abort(403);
                $object->scene_type = $request->scene_type;
                $object->save();
                $scene->object_id = $request->object_id;
            } else {
                $object = new \App\ObjectNew();
                $object->scene_type = $request->scene_type;
                $object->user_id = Auth::user()->id;
                $object->save();
                $scene->object_id = $object->id;
            }		
            $scene->save();			
            $newName = $scene->id.'.'.$scene->extension;
            $request->scene->storeAs('public/scenes/'.$scene->object_id, $newName);
            //if fisheye
            if ($object->scene_type == 3) {
                $output = '';
                $scene->extension = 'jpg';
                $scene->save();
                exec('bash '.base_path().'/convert/gear360pano.cmd -a '.Storage::url('scenes/'.$scene->object_id.'/'.$newName).' 2>&1', $output);
                unlink(Storage::url('scenes/'.$scene->object_id.'/'.$newName));
                rename(base_path().'/convert/done/'.$scene->id.'.jpg', Storage::url('scenes/'.$scene->object_id.'/'.$scene->id.'.jpg'));
            }
			
            //mobile image
            $mobileImage = Image::make(Storage::url('/scenes/'.$scene->object_id.'/'.$scene->id.'.'.$scene->extension))->resize(4000, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $mobileImage->save(Storage::url('/scenes/'.$scene->object_id.'/'.$scene->id.'_mobile.'.$scene->extension));
			//echo $scene->image_width;
			//exit;
            $scene->image_url = $scene->image_url;
            $scene->image_width = $scene->image_width;
            $scene->image_height = $scene->image_height;

            return $scene;
        }
    }

    public function sceneImage($id, $file_name)
    {
		$file = '../storage/app/public/scenes/'.$id.'/'.$file_name;
		if (file_exists($file)) {
			header('Content-Type: image/'.pathinfo($file)['extension']);
			readfile($file);
			exit;
		}
		exit;
    }
	
    public function panoramaJs($id)
    {
        $object = \App\ObjectNew::find($id);

        return response()->view('catalog.pano_js', ['object' => $object])->header('Content-Type', 'application/javascript');
    }

    public function deleteScene($id)
    {
        $scene = \App\Scene::find($id);
        if ($scene->object->user_id != Auth::user()->id && !Auth::user()->isAdmin()) return abort(403);
        Storage::delete('public/scenes/'.$scene->object_id.'/'.$scene->id.'.'.$scene->extension);
        Storage::delete('public/scenes/'.$scene->object_id.'/'.$scene->id.'_mobile.'.$scene->extension);
        $scene->delete();
    }

    public function deleteMark($id)
    {
        $mark = \App\Mark::find($id);
        if ($mark->object->user_id != Auth::user()->id && !Auth::user()->isAdmin()) return abort(403);
        \App\Mark::destroy($id);
    }

    public function userObjects()
    {
        if (Auth::user()->isAdmin()) $objects = \App\ObjectNew::finished()->with('scenes')->adminFilter()->paginate(30);
        else $objects = Auth::user()->objects()->with('scenes')->finished()->paginate(30);
        $cities = \App\City::orderBy('name', 'asc')->get();

        return view('objects.objects', ['objects' => $objects, 'cities' => $cities]);
    }

    public function destroy($id)
    {
        if (!\App\ObjectNew::where('user_id', Auth::user()->id)->where('id', $id)->first() && !Auth::user()->isAdmin()) return abort(403);

        \App\ObjectNew::destroy($id);
        \App\Scene::where('object_id', $id)->delete();
        \App\Mark::where('object_id', $id)->delete();
        Storage::deleteDirectory('public/scenes/'.$id);

        return redirect()->route('objects')->with(['message' => 'Объект удалён.']);
    }

    public function ajaxCity(Request $request)
    {
        $result = \App\City::where('name', 'LIKE', $request->string.'%')->where('region_id', $request->region)->get();

        $cities = [];

        foreach ($result as $city) {
            $cities[$city->name] = null;
        }

        return $cities;
    }

    public function download($id)
    {
        $object = \App\ObjectNew::findOrFail($id);
        $object->scenes;

        $view = view('catalog.download', ['object' => $object])->render();

        Storage::disk('temp')->deleteDirectory($object->id);
        Storage::disk('temp')->makeDirectory($object->id.'/css');
        Storage::disk('temp')->makeDirectory($object->id.'/js');
        Storage::disk('root')->copy('public/css/materialize.min.css', 'storage/temp/'.$object->id.'/css/materialize.min.css');
        Storage::disk('root')->copy('public/css/pannellum.css', 'storage/temp/'.$object->id.'/css/pannellum.css');
        Storage::disk('root')->copy('public/js/jquery-3.2.1.min.js', 'storage/temp/'.$object->id.'/js/jquery-3.2.1.min.js');
        Storage::disk('root')->copy('public/js/jquery.pano.js', 'storage/temp/'.$object->id.'/js/jquery.pano.js');
        Storage::disk('root')->copy('public/js/pannellum.js', 'storage/temp/'.$object->id.'/js/pannellum.js');
        foreach (Storage::disk('root')->allFiles('storage/app/public/scenes/'.$object->id) as $file) {
            $fileName = pathinfo($file)['basename'];
            Storage::disk('root')->copy($file, 'storage/temp/'.$object->id.'/scenes/'.$object->id.'/'.$fileName);
        }
        file_put_contents(Storage::disk('temp')->url($object->id).'/index.html', $view);

        $base = Storage::disk('temp')->url($object->id);
        $files = Storage::disk('temp')->allFiles($object->id);
        $zipname = Storage::disk('temp')->url($object->id.'/pano.zip');
		$zip = new \ZipArchive;
		$zip->open($zipname, \ZipArchive::CREATE);
		foreach ($files as $file) {
			$fullPath = Storage::disk('temp')->url($file);
			$localPath = str_replace($base, '', $fullPath);
			$zip->addFile($fullPath, $localPath);
		}
		$zip->close();

        return response()->download($zipname);
    }

    public function embed($id)
    {
        $object = \App\ObjectNew::active()->findOrFail($id);
        if ($object->unpaid_scenes > 0) return abort(403);
        $object->scenes;

        return view('catalog.download', ['object' => $object]);
    }

    public function cost($id)
    {
        $object = \App\ObjectNew::find($id);
        $unpaid_scenes = $object->unpaid_scenes;

        if (Auth::user()->paid_scenes > $unpaid_scenes) return 'бесплатно';

        if ($unpaid_scenes) return $unpaid_scenes * ENV('SCENE_COST').' руб.';
        return 'бесплатно';
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use Auth;
use Illuminate\Support\Facades\Hash;

class WebsiteController extends Controller
{
    public function getRules($id = null)
    {
        return [
            'login' => 'required|regex:/[a-z0-9]/i|unique:users,login,'.$id,
            'email' => 'required|email',
            'phone' => 'required',
            'name' => 'required',
			'personal' => 'required',
            'password' => ($id ? 'nullable' : 'required').'|same:password_repeat|min:6',
        ];
    }
    public function getMessages()
    {
        return [
            'login.required' => 'Поле "Логин" не может быть пустым.',
            'login.regex' => 'Логин может содержать только символы латинского алфавита и цифры.',
            'login.unique' => 'Логин уже используется другим пользователем.',
            'email.required' => 'Поле "E-mail" не может быть пустым.',
            'email.email' => 'Поле "E-mail" имеет неверный формат.',
            'phone.required' => 'Поле "Телефон" не может быть пустым.',
            'name.required' => 'Поле "Имя" не может быть пустым.',
			'personal.required' => 'Необходимо дать согласие на обработку персональных данных.',
            'password.required' => 'Поле "Пароль" не может быть короче 6 символов.',
            'password.min' => 'Поле "Пароль" не может быть короче 6 символов.',
            'password.same' => 'Поле "Пароль" и "Повторите пароль" не совпадают.',
        ];
    }
    public function loginForm()
    {
        return view('new.login_form');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            return redirect()->intended('/');
        } elseif (Auth::attempt(['email' => $request->login, 'password' => $request->password])) {
            return redirect()->intended('/');
        } else {
            return redirect()->back()->withErrors(['message' => 'Пользователь с таким логином и паролем не найден.']);
        }
    }

    public function index()
    {
    	$newobject = \App\ObjectNew::active()->where('image', '<>', null)->where('action', 1)->first();
		
		$images = explode(',', $newobject->image);
		$img_src = [];
		foreach($images as $key => $image){
			if($key != 0){
                array_push($img_src, $image);
			}
		}

        $regions = \App\Region::orderBy('name')->get();
        $objects = \App\ObjectNew::with('city')->active()->whereIn('action', [1, 2])->take(10)->orderBy('created_at', 'desc')->get();
        $news = collect([]);

        $newsRss = file_get_contents('http://www.pro-n.ru/rss/analytics.xml');
        if ($newsRss) {
            $newsRss = simplexml_load_string($newsRss);
            foreach ($newsRss->channel->item as $item) $news->push((object) $item);
        }

        return view('new.index', ['regions' => $regions, 'objects' => $objects, 'news' => $news, 'img_src' => $img_src, 'newobject' => $newobject]);
    }
    public function sale()
    {
    	$objects = \App\ObjectNew::active()->whereIn('objects.action', [1, 2])->filter()->sort()->paginate(30);
    	$regions = \App\Region::orderBy('name')->get();

    	return view('new.sale', ['objects' => $objects, 'regions' => $regions]);
    }
    public function help()
    {
    	return view('new.help');
    }
    public function page_ads(Request $request, $id)
    {
        $action = explode('/', Route::current()->uri);
        switch ($action[1]) {
            case 'sale': $action = 1; break;
            case 'rent': $action = 2; break;
            case 'pano': $action = 3; break;
        }
    	$newobject = \App\ObjectNew::active()->where('image', '<>', null)->where('action', 1)->first();
		
		$images = explode(',', $newobject->image);
		$img_src = [];
		foreach($images as $key => $image){
			if($key != 0){
                array_push($img_src, $image);
			}
		}
        $objects = \App\ObjectNew::active()->with('city')->where('active', 1)->whereIn('action', [1, 2])->take(10)->orderBy('created_at', 'desc')->get();
		
    	return view('new.page-ads', ['newobject' => $newobject, 'objects' => $objects, 'img_src' => $img_src]);
    }
    public function userObjects()
    {
        if (Auth::user()->isAdmin()) $objects = \App\ObjectNew::finished()->with('scenes')->adminFilter()->paginate(30);
        else $objects = Auth::user()->objects()->with('scenes')->finished()->paginate(30);
        $cities = \App\City::orderBy('name', 'asc')->get();

        return view('new.objects', ['objects' => $objects, 'cities' => $cities]);
    }
    public function tariffs()
    {
    	return view('new.tariffs');
    }
    public function registerForm()
    {
        return view('new.register_form');
    }

    public function register(Request $request)
    {
        $this->validate($request, $this->getRules(), $this->getMessages());

/*         $data = http_build_query([
            'secret' => '6LeVQDIUAAAAAIjw411keJx-kN8DV0PTcE8sGUHw⁠⁠⁠⁠',
            'response' => $request->input('g-recaptcha-response'),
        ]);
        $opts = array('http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $data
            ]
        );
        $context  = stream_context_create($opts);
        $result = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context));
        if (!$result->success) return redirect()->back()->withInput(Input::all())->withErrors(['error' => 'Ошибка проверки Captcha. Попробуйте снова.']); */

        $user = new \App\User();
        $user->login = $request->login;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = 1;

        $user->save();

        return redirect()->route('new-site/login')->with(['message' => 'Вы были успешно зарегистрированы и теперь можете войти в систему.']);
    }


}

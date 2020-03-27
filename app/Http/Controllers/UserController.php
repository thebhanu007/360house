<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
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
        return view('login_form');
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

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function registerForm()
    {
        return view('register_form');
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

        return redirect()->route('login')->with(['message' => 'Вы были успешно зарегистрированы и теперь можете войти в систему.']);
    }

    public function profile()
    {
        $user = Auth::user();

        return view('user.profile', ['user' => $user]);
    }

    public function profileSave(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, $this->getRules($user->id), $this->getMessages());

        $user->login = $request->login;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($request->has('password')) $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('profile')->with(['message' => 'Ваши данные успешно обновлены.']);
    }

    public function restoreForm()
    {
        return view('restore_form');
    }

    public function restore(Request $request)
    {
        $this->validate($request, ['email' => 'email'], ['email.email' => 'Неверный формат E-mail.']);

        $user = \App\User::where('email', $request->email)->first();
        if ($user) {
            $user->restore_token = Hash::make(rand(1000000, 9999999));
            $user->save();

            Mail::to($user->email)->send(new \App\Mail\Restore($user));
        }

        return redirect()->route('restore')->with(['message' => 'На указанный адрес было отправлено письмо с дальнейшими инструкциями.']);
    }

    public function passwordForm()
    {
        return view('password_form');
    }

    public function password(Request $request)
    {
        $this->validate($request, [
            'password' => 'min:6|same:password_repeat'
        ], [
            'password.min' => 'Поле "Пароль" не может быть короче 6 символов.',
            'password.same' => 'Поле "Пароль" и "Повторите пароль" не совпадают.',
        ]);

        $user = \App\User::where('restore_token', $request->token)->where('id', $request->id)->first();
        if ($user) {
            $user->restore_token = '';
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('/')->with(['message' => 'Ваш пароль обновлен. Вы можете войти в систему используя новые данные.']);
        } else {
            return redirect()->back()->withErrors(['error' => 'Пользователь не найден.']);
        }
    }
}

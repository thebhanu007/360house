<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getRules($id = null)
    {
        return [
            'login' => 'required|regex:/[a-z0-9]/i|unique:users,login,'.$id,
            'email' => 'required|email',
            'phone' => 'required',
            'name' => 'required',
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
            'password.required' => 'Поле "Пароль" не может быть короче 6 символов.',
            'password.min' => 'Поле "Пароль" не может быть короче 6 символов.',
            'password.same' => 'Поле "Пароль" и "Повторите пароль" не совпадают.',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::paginate(20);

        return view('admin.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.profile', ['admin' => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new \App\User();

        $this->validate($request, $this->getRules(), $this->getMessages());

        $user->login = $request->login;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('admin.users.index')->with(['message' => 'Пользователь создан.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::findOrFail($id);

        return view('user.profile', ['user' => $user, 'admin' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = \App\User::findOrFail($id);

        $this->validate($request, $this->getRules($user->id), $this->getMessages());

        $user->login = $request->login;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($request->has('password')) $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('admin.users.index')->with(['message' => 'Данные пользователя обновлены.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\User::destroy($id);

        return redirect()->route('admin.users.index')->with(['message' => 'Пользователь удалён.']);
    }
}

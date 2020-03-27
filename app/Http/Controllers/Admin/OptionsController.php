<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OptionsController extends Controller
{
    public function edit()
    {
        return view('admin.options');
    }

    public function update(Request $request)
    {
        foreach ($request->all() as $field => $value) {
            if ($field != '_token') {
                \App\Option::set($field, $value);
            }
        }

        return redirect()->route('admin.options');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ConvertController extends Controller
{
    public function form()
    {
    	return view('convert_form');
    }

    public function convert(Request $request)
    {
    	$output = '1';
    	$fileName = str_replace(' ', '', microtime()).'.jpg';
    	$path = $request->file('image')->storeAs('public/convert', $fileName);
		exec('bash '.base_path().'/convert/gear360pano.cmd -a '.base_path().'/storage/app/'.$path.' 2>&1', $output);

		if (file_exists(base_path().'/convert/done/'.$fileName))
			return response()->download(base_path().'/convert/done/'.$fileName);
		else 
			return redirect()->route('convert')->with(['message' => 'Произошла неизвестная ошибка. Попробуйте позже.']);
    }
}

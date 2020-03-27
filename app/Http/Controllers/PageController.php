<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function index()
    {
        $regions = \App\Region::orderBy('name')->get();
        $objects = \App\ObjectNew::with('city')->active()->whereIn('action', [1, 2])->take(10)->orderBy('created_at', 'desc')->get();
        $news = collect([]);

        $newsRss = file_get_contents('http://www.pro-n.ru/rss/analytics.xml');
        if ($newsRss) {
            $newsRss = simplexml_load_string($newsRss);
            foreach ($newsRss->channel->item as $item) $news->push((object) $item);
        }

        return view('pages.index', ['regions' => $regions, 'objects' => $objects, 'news' => $news]);
    }

    public function contacts()
    {
    	return view('pages.contacts');
    }

    public function help()
    {
    	return view('pages.help');
    }

    public function feedback()
    {
        return view('pages.feedback');
    }

    public function feedbackSend(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Поле "Имя" не может быть пустым.',
            'city.required' => 'Поле "Город" не может быть пустым.',
            'phone.required' => 'Поле "Номер телефона" не может быть пустым.',
        ]);
        debug($request);

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
        if (!$result->success) {
            if ($request->has('ajax')) return ['success' => false, 'message' => 'Ошибка проверки Captcha. Попробуйте снова.'];
            return redirect()->back()->withInput(Input::all())->withErrors(['error' => 'Ошибка проверки Captcha. Попробуйте снова.']);
        } */

        Mail::to('admin@krugomdom.com')->send(new \App\Mail\Feedback($request->all()));

        if ($request->has('ajax')) return ['success' => true, 'message' => 'Сообщение успешно отправлено. Наши специалисты свяжутся с Вами в ближайшее время.'];

        return redirect()->route('feedback')->with(['message' => 'Сообщение успешно отправлено. Наши специалисты свяжутся с Вами в ближайшее время.']);
    }

    public function reportSend(Request $request)
    {
        $this->validate($request, [
            'report' => 'required',
        ], [
            'report.required' => 'Поле "Сообщение" не может быть пустым.',
        ]);
        debug($request);

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
        if (!$result->success) {
            if ($request->has('ajax')) return ['success' => false, 'message' => 'Ошибка проверки Captcha. Попробуйте снова.'];
            return redirect()->back()->withInput(Input::all())->withErrors(['error' => 'Ошибка проверки Captcha. Попробуйте снова.']);
        } */

        Mail::to('staksor@gmail.com')->send(new \App\Mail\Report($request->all()));

        if ($request->has('ajax')) return ['success' => true, 'message' => 'Жалоба успешно отправлено.'];

        return redirect()->route('feedback')->with(['message' => 'Жалоба успешно отправлено.']);
    }
	
    public function about()
    {
    	return view('pages.about');
    }

    public function education()
    {
    	return view('pages.education');
    }
	

    public function contactSend(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'question' => 'required',
        ], [
            'name.required' => 'Поле "Имя" не может быть пустым.',
            'question.required' => 'Поле "Вопрос" не может быть пустым.',
            'phone.required' => 'Поле "Номер телефона" не может быть пустым.',
        ]);
        debug($request);

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
        if (!$result->success) {
            if ($request->has('ajax')) return ['success' => false, 'message' => 'Ошибка проверки Captcha. Попробуйте снова.'];
            return redirect()->back()->withInput(Input::all())->withErrors(['error' => 'Ошибка проверки Captcha. Попробуйте снова.']);
        } */

        Mail::to('admin@krugomdom.com')->send(new \App\Mail\Contact($request->all()));
		//Mail::to('dvbakaev@gmail.com')->send(new \App\Mail\Contact($request->all()));

        if ($request->has('ajax')) return ['success' => true, 'message' => 'Сообщение успешно отправлено. Наши специалисты свяжутся с Вами в ближайшее время.'];

        return redirect()->route('feedback')->with(['message' => 'Сообщение успешно отправлено. Наши специалисты свяжутся с Вами в ближайшее время.']);
    }
	
}

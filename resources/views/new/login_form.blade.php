@extends('new/layout/app')
@section('styles')
<link rel="stylesheet" href="{{asset('new/css/bootstrap-grid.min.css')}}">
	<link rel="stylesheet" href="{{asset('new/scripts/slick/slick.css')}}">
	<link rel="stylesheet" href="{{asset('new/scripts/fancybox/jquery.fancybox.min.css')}}">
	<link rel="stylesheet" href="{{asset('new/scripts/magnific/magnific-popup.css')}}">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700&display=swap&subset=cyrillic" rel="stylesheet">

	<link rel="stylesheet" href="{{asset('new/css/main.css')}}">
	<link rel="stylesheet" href="{{asset('new/scripts/jQueryFormStyler/jquery.formstyler.css')}}">
	<link rel="stylesheet" href="{{asset('new/css/add_style.css')}}">
    <style>
        .error_text{
            color:red;
        }
    </style>
@endsection

@section('title')
    360 Houses
@endsection
@section('content')
<main>
		<section id="section-registration" class="section-registration">
        <img src="{{asset('new/img/section_img10.svg')}}" alt="img" class="section_img section_img1">
			<img src="{{asset('new/img/section_img7.svg')}}" alt="img" class="section_img section_img2">
			<div class="bg-text">360 HOUSE</div>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h2 class="title2">Войти в систему</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                        <span class="error_text"> {{$error}}</span>
                        @endforeach
                    @endif
						<form class="registration" method="post">
						{{csrf_field()}}
							<div class="formgroup">
								<input type="text" name="login" id="login" placeholder="Логин">
							</div>
                            <div class="formgroup">
								<input type="text" name="password" id="password" placeholder="Пароль">
				            </div>
				            <button class="main-btn">Войти</button>
                            <div class="row formlink">
					           <div class="col-7">
                                   <a href="javascript:;">Восстановить пароль</a>
                                </div>
                                <div class="col-5 right">
                                   <a href="{{url('new-site/register')}}">Регистрация</a>
                                </div>
				            </div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>

@endsection

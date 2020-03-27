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
						<h2 class="title2">Регистрация</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
						<form class="registration" method="post" action="{{url('new-site/register')}}">
						{{csrf_field()}}
							<div class="formgroup {{ $errors->has('login') ? ' error' : '' }}">
								<input type="text" placeholder="Логин" name="login" value="{{ old('login') or ''}}">
								@if ($errors->has('login'))
										<span class="error_text">{{ $errors->first('login') }}</span>
								@endif

							</div>
							<div class="formgroup {{ $errors->has('email') ? ' error' : '' }}">
								<input type="text" placeholder="E-mail" name="email" value="{{ old('email') or ''}}">
								@if ($errors->has('email'))
										<span class="error_text">{{ $errors->first('email') }}</span>
								@endif
							</div>
							<div class="formgroup {{ $errors->has('phone') ? ' error' : '' }}">
								<input type="text" placeholder="Телефон" name="phone" value="{{ old('phone') or ''}}">
								@if ($errors->has('phone'))
										<span class="error_text">{{ $errors->first('phone') }}</span>
								@endif
							</div>
							<div class="formgroup {{ $errors->has('name') ? ' error' : '' }}">
								<input type="text" placeholder="Имя" name="name" value="{{ old('name') or ''}}">
								@if ($errors->has('name'))
										<span class="error_text">{{ $errors->first('name') }}</span>
								@endif
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="formgroup {{ $errors->has('password') ? ' error' : '' }}">
										<input type="text" placeholder="Пароль" name="password">
										@if ($errors->has('password'))
												<span class="error_text">{{ $errors->first('password') }}</span>
										@endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="formgroup {{ $errors->has('password_repeat') ? ' error' : '' }}">
										<input type="text" placeholder="Повторите пароль" name="password_repeat">

										@if ($errors->has('password_repeat'))
												<span class="error_text">{{ $errors->first('password_repeat') }}</span>
										@endif
									{{--	<span class="error_text">Пароль введен не верно</span>--}}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<label class="checkbox person-data">
				                        <input type="checkbox" class=""  name="personal" value="on" checked="{{Request::has('personal')}}">
				                        <span class="checkbox__text">Я даю согласие на обработку персональных данных</span>
				                    </label>

				                    <button class="main-btn">Сохранить</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>
@endsection

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
		<section id="announcement">
			<img src="{{asset('new/img/section_img9.svg')}}" alt="img" class="section_img section_img1">
			<img src="{{asset('new/img/section_img9.svg')}}" alt="img" class="section_img section_img2">
			<div class="container">
				<div class="announcement">
					<div class="row">
						<div class="col-lg-8">
							<div class="announcement__title">
								<h3 class="title3">
									@if ($newobject->action != 3)
											{{$newobject->full_name}}
									@else
										'Объект №'{{$newobject->id}}
									@endif
								</h3>
								<div class="announcement__subtitle">{{$newobject->full_address}}</div>
								<div class="announcement__headInfo">{!!$newobject->print_size!!}, {{$newobject->floor}} эт</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="announcement__price">{{$newobject->print_price}}</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-8">
							<!-- <div class="announcement__panorama">
								<img src="img/image17.jpg" alt="img">
							</div> -->
							<div class="announcement__slider">
							@foreach($img_src as $img)
								<div class="slide">
									<img src="{{asset('documents/')}}/{{$img}}" alt="img">
								</div>
							@endforeach
							</div>
						</div>
						<div class="col-lg-4">
							<div class="announcement__info">
								<h3 class="title3">Информация</h3>

								<ul>
									<li>Тип: <span>{{$newobject->type_name}}</span></li>
									@if ($newobject->type != 2)
										<li>Комнаты: <span>{{$newobject->rooms}}</span></li>
									@endif
									@if($newobject->floor)
										<li>Этаж: <span>{{$newobject->floor = $newobject->floors ? '/'.$newobject->floors : ''}}</span></li>
									@endif
									@if($newobject->material)
										<li>Материал здания: <span>{{$newobject->material_name}}</span></li>
									@endif
									<li>Площадь: <span>{!!$newobject->print_size!!}</span></li>
									<li>Дата публикации объявления: <span>{{$newobject->created_at->format('d.m.Y')}}</span></li>
								</ul>

								<div class="announcement__btn">
									<a href="javascript:;" class="main-btn phone-btn">Показать номер</a>
								</div>
								
							</div>
						</div>
						<div class="col-lg-8">
							<div class="announcement__navSlider zoom-gallery">
								@foreach($img_src as $img)
									<a class="slide" href="{{asset('documents/')}}/{{$img}}">
										<img src="{{asset('documents/')}}/{{$img}}" alt="img">
									</a>
								@endforeach
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="announcement__discr">
								<h3 class="title3">Описание</h3>
								<p>{{$newobject->description}}</p>
							</div>

							<div class="announcement__location">
								<h3 class="title3">Расположение</h3>

								<div class="map">
									<img src="{{asset('new/img/map2.jpg')}}" alt="map">
								</div>

								<div class="announcement__btns">
									<div class="share">
										<span>Поделиться:</span>

										<div class="share__btn">
											<a href="#">
												<img src="{{asset('new/img/vk-color.svg')}}" alt="icon">
											</a>
											<a href="#">
												<img src="{{asset('new/img/od-color.svg')}}" alt="icon">
											</a>
											<a href="#">
												<img src="{{asset('new/img/facebook-color.svg')}}" alt="icon">
											</a>
											<a href="#">
												<img src="{{asset('new/img/youtube-color.svg')}}" alt="icon">
											</a>
											<a href="#">
												<img src="{{asset('new/img/twitter-color.svg')}}" alt="icon">
											</a>
											<a href="#">
												<img src="{{asset('new/img/insta-color.svg')}}" alt="icon">
											</a>
										</div>
									</div>
									<a href="#" class="complain-btn">Пожаловаться</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="other-ad">
			<img src="{{asset('new/img/section_img1.svg')}}" alt="img" class="section_img section_img1">
			<img src="{{asset('new/img/section_img2.svg')}} " alt="img" class="section_img section_img2">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h2 class="title2">Другие <span class="red">объявления</span></h2>

						<div class="card-slider flex-slider">
							@foreach($objects as $object)
								<a href="{{$object->url}}" class="card">
									<div class="card__img">
										<img src="{{$object->thumb}}" alt="img">
									</div>
									<div class="card__info">
										<p>
											@if ($object->action != 3)
												{{$object->full_name}}
											@else
												'Объект №'{{$object->id}}
											@endif
										</p>
										<p>{{$object->full_address}}</p>
										<p>{!!$object->print_size!!}, {{$object->floor}} эт</p>
										<div class="card__price">{{$object->print_price}}</div>
									</div>
								</a>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
@endsection
@section('scripts')
<script>
	$(".phone-btn").click(function(){
		$(this).html('{{$newobject->phone}}');
	})
</script>

@endsection
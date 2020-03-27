@extends('new/layout/app')
@section('header-type')
	header-main
@endsection
@section('styles')
	<link rel="stylesheet" href="{{asset('new/css/bootstrap-grid.min.css')}}">
	<link rel="stylesheet" href="{{asset('new/scripts/slick/slick.css')}}">
	<link rel="stylesheet" href="{{asset('new/scripts/fancybox/jquery.fancybox.min.css')}}">
	<link rel="stylesheet" href="{{asset('new/scripts/magnific/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('new/scripts/jQueryFormStyler/jquery.formstyler.css')}}">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700&display=swap&subset=cyrillic" rel="stylesheet">

	<link rel="stylesheet" href="{{asset('new/css/main.css')}}">
	<link rel="stylesheet" href="{{asset('new/css/add_style.css')}}">
@endsection
@section('title')
    360 Houses
@endsection
@section('content')
<main>
		<section id="main-section">
			<ul class="animate-slider">
			    <li><img src="{{asset('new/img/bg_main.jpg')}}"/></li> 
			    <li><img src="{{asset('new/img/222.jpg')}}"/></li> 
			</ul>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h2 class="title2">Объемные 3D панорамы квартир для риелторов и покупателей недвижимости</h3>
						<div class="text">Создавайте объявления и находите подходящие квартиры в нашей базе объявлений</div>
						<a href="{{url('/new-site/help')}}" class="main-btn">Создать ЗD-тур бесплатно за 1 минуту!</a>
					</div>
				</div>
			</div>
		</section>

		<section id="announcement-mainPage">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h2 class="title2"><span class="red">Новый</span> добавленный <span class="orange">тур</span></h2>
					</div>
				</div>
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
								<img src="{{asset('new/img/image17.jpg')}}" alt="img">
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
				</div>
			</div>
		</section>

		<div class="semicircle_bg">
			<img src="{{asset('new/img/section_img1.svg')}}" alt="img" class=" section_img section_img1">
			<img src="{{asset('new/img/section_img4.svg')}}" alt="img" class=" section_img section_img2">
			<img src="{{asset('new/img/section_img7.svg')}}" alt="img" class=" section_img section_img3">
			<img src="{{asset('new/img/section_img2.svg')}}" alt="img" class=" section_img section_img4">

			<section id="how-create">
				<div class="container">
					<div class="row">
						<div class="col-lg-10 offset-lg-1">
							<h2 class="title2">Как создать <span class="green">ЗD-тур</span></h2>

							<div class="video">
								<iframe width="100%" height="315" src="https://www.youtube.com/embed/W3q8Od5qJio" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
						</div>
					</div>
				</div>
			</section>

			<div id="new_ad">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h2 class="title2"><span class="blue">Новые</span> объявления</h2>

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

							<div class="center">
								<a href="{{url('new-site/help')}}" class="main-btn">Добавить объявление с ЗD-туром квартиры</a>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div id="find-ad">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<img src="{{asset('new/img/map.jpg')}}" alt="img" class="map">
						</div>
						<div class="col-lg-6">
							<div class="content">
								<h2 class="title2"><span class="green">Найдите</span> объявление <span class="red">на карте</span></h2>
								<a href="{{url('/new-site/sale')}}" class="main-btn">Перейти к карте</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="our-realtors">
				<img src="{{asset('new/img/section_img4.svg')}}" alt="img" class="section_img section_img1">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h2 class="title2">Наши <span class="green">партнёры</span></h2>

							<div class="card-slider">
								<a href="#" class="realtor-card">
									<div class="realtor-card__img">
										<img src="{{asset('new/img/logo.svg')}}" alt="logo">
									</div>
									<div class="realtor-card__company">Название компании</div>
								</a>
								<a href="#" class="realtor-card">
									<div class="realtor-card__img">
										<img src="{{asset('new/img/logo.svg')}}" alt="logo">
									</div>
									<div class="realtor-card__company">Название компании</div>
								</a>
								<a href="#" class="realtor-card">
									<div class="realtor-card__img">
										<img src="{{asset('new/img/logo.svg')}}" alt="logo">
									</div>
									<div class="realtor-card__company">Название компании</div>
								</a>
								<a href="#" class="realtor-card">
									<div class="realtor-card__img">
										<img src="{{asset('new/img/logo.svg')}}" alt="logo">
									</div>
									<div class="realtor-card__company">Название компании</div>
								</a>
								<a href="#" class="realtor-card">
									<div class="realtor-card__img">
										<img src="{{asset('new/img/logo.svg')}}" alt="logo">
									</div>
									<div class="realtor-card__company">Название компании</div>
								</a>
								<a href="#" class="realtor-card">
									<div class="realtor-card__img">
										<img src="{{asset('new/img/logo.svg')}}" alt="logo">
									</div>
									<div class="realtor-card__company">Название компании</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<section id="creation-order">
			<img src="{{asset('new/img/section_img5.svg')}}" alt="img" class="section_img">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h2 class="title2">Порядок <span class="orange">создания</span> объявлений</h2>

						<div class="creation-order _scroll">
							<div class="creation-order__item">
								<img src="{{asset('new/img/camera.png')}}" alt="img">

								<div class="creation-order__text">
									<div class="creation-order__title">1. <br>Съемка</div>
									<!-- <div class="creation-order__discr">С помощью любой камеры сделайте панораму</div> -->
								</div>
							</div>
							<div class="creation-order__item">
								<img src="{{asset('new/img/phone.png')}}" alt="img">

								<div class="creation-order__text">
									<div class="creation-order__title">2. <br> Сборка</div>
									<!-- <div class="creation-order__discr">Создайте виртуальный тур и заполните поля</div> -->
								</div>
							</div>
							<div class="creation-order__item">
								<img src="{{asset('new/img/comp.png')}}" alt="img">

								<div class="creation-order__text">
									<div class="creation-order__title">3. <br> Ваш тур готов</div>
									<!-- <div class="creation-order__discr">Разместите объявление</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="our-advantages">
			<div class="bg-text v">360 <br>HOUSE</div>
			<img src="{{asset('new/img/section_img8.svg')}}" alt="img" class="section_img">

			<img src="{{asset('new/img/line.svg')}}" alt="line" class="line_img">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h2 class="title2">Наши <span class="red">преимущества</span></h2>
						<div class="advantages">
							<div class="advantages__item advantages__item1">
								<div class="advantages__img">
									<img src="{{asset('new/img/advantage1.png')}}" alt="img">
								</div>
								<div class="advantages__text">Отличные цены</div>
							</div>
							<div class="advantages__item advantages__item2">
								<div class="advantages__img">
									<img src="{{asset('new/img/advantage2.png')}}" alt="img">
								</div>
								<div class="advantages__text">По всей России и СНГ</div>
							</div>
							<div class="advantages__item advantages__item3">
								<div class="advantages__img">
									<img src="{{asset('new/img/advantage3.png')}}" alt="img">
								</div>
								<div class="advantages__text">Обслуживание 24/7</div>
							</div>
							<div class="advantages__item advantages__item4">
								<div class="advantages__img">
									<img src="{{asset('new/img/advantage4.png')}}" alt="img">
								</div>
								<div class="advantages__text">Делитесь турами в сети</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="reviews">
			<img src="{{asset('new/img/section_img4.svg')}}" alt="img" class="section_img section_img1">
			<img src="{{asset('new/img/section_img6.svg')}}" alt="img" class="section_img section_img2">
			<img src="{{asset('new/img/section_img7.svg')}}" alt="img" class="section_img section_img3">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h2 class="title2">Отзывы</h2>

						<div class="reviews-slider">
							<div class="reviews-slider__slide">
								<div class="reviews-slider__head">
									<div class="reviews-slider__photo">
										<img src="{{asset('new/img/photo1.jpg')}}" alt="photo">
									</div>
									<div class="reviews-slider__info">
										<div class="reviews-slider__name">Марина</div>
										<div class="reviews-slider__date">25.06.2019</div>
									</div>
								</div>
								<div class="reviews-slider__body dotted">
									<div class="dotted__hidden">
										<p>Конкурент, конечно, притягивает принцип восприятия. Воздействие на потребителя как всегда непредсказуемо. В соответствии с законом Ципфа, клиентский спрос создает культурный медиамикс. Рейт-карта недостаточно отталкивает коллективный принцип восприятия, оптимизируя бюджеты.</p>
									</div>
									
									<div class="dotted__read">Читать полностью >></div>
								</div>
							</div>
							<div class="reviews-slider__slide">
								<div class="reviews-slider__head">
									<div class="reviews-slider__photo">
										<img src="{{asset('new/img/photo1.jpg')}}" alt="photo">
									</div>
									<div class="reviews-slider__info">
										<div class="reviews-slider__name">Марина</div>
										<div class="reviews-slider__date">25.06.2019</div>
									</div>
								</div>
								<div class="reviews-slider__body dotted">
									<div class="dotted__hidden">
										<p>Конкурент, конечно, притягивает принцип восприятия. Воздействие на потребителя как всегда непредсказуемо. В соответствии с законом Ципфа, клиентский спрос создает культурный медиамикс. Рейт-карта недостаточно отталкивает коллективный принцип восприятия, оптимизируя бюджеты.</p>
									</div>
									
									<div class="dotted__read">Читать полностью >></div>
								</div>
							</div>
							<div class="reviews-slider__slide">
								<div class="reviews-slider__head">
									<div class="reviews-slider__photo">
										<img src="{{asset('new/img/photo1.jpg')}}" alt="photo">
									</div>
									<div class="reviews-slider__info">
										<div class="reviews-slider__name">Марина</div>
										<div class="reviews-slider__date">25.06.2019</div>
									</div>
								</div>
								<div class="reviews-slider__body dotted">
									<div class="dotted__hidden">
										<p>Конкурент, конечно, притягивает принцип восприятия. Воздействие на потребителя как всегда непредсказуемо. В соответствии с законом Ципфа, клиентский спрос создает культурный медиамикс. Рейт-карта недостаточно отталкивает коллективный принцип восприятия, оптимизируя бюджеты.</p>
									</div>
									
									<div class="dotted__read">Читать полностью >></div>
								</div>
							</div>
							<div class="reviews-slider__slide">
								<div class="reviews-slider__head">
									<div class="reviews-slider__photo">
										<img src="{{asset('new/img/photo1.jpg')}}" alt="photo">
									</div>
									<div class="reviews-slider__info">
										<div class="reviews-slider__name">Марина</div>
										<div class="reviews-slider__date">25.06.2019</div>
									</div>
								</div>
								<div class="reviews-slider__body dotted">
									<div class="dotted__hidden">
										<p>Конкурент, конечно, притягивает принцип восприятия. Воздействие на потребителя как всегда непредсказуемо. В соответствии с законом Ципфа, клиентский спрос создает культурный медиамикс. Рейт-карта недостаточно отталкивает коллективный принцип восприятия, оптимизируя бюджеты.</p>
									</div>
									
									<div class="dotted__read">Читать полностью >></div>
								</div>
							</div>
							<div class="reviews-slider__slide">
								<div class="reviews-slider__head">
									<div class="reviews-slider__photo">
										<img src="{{asset('new/img/photo1.jpg')}}" alt="photo">
									</div>
									<div class="reviews-slider__info">
										<div class="reviews-slider__name">Марина</div>
										<div class="reviews-slider__date">25.06.2019</div>
									</div>
								</div>
								<div class="reviews-slider__body dotted">
									<div class="dotted__hidden">
										<p>Конкурент, конечно, притягивает принцип восприятия. Воздействие на потребителя как всегда непредсказуемо. В соответствии с законом Ципфа, клиентский спрос создает культурный медиамикс. Рейт-карта недостаточно отталкивает коллективный принцип восприятия, оптимизируя бюджеты.</p>
									</div>
									
									<div class="dotted__read">Читать полностью >></div>
								</div>
							</div>
						</div>

						<div class="center">
							<a href="#" class="main-btn">Присоединиться к сотрудничеству успешных риелторов</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div class="article gray-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-2">
						<div class="article__navWrap">
							<div class="article__sliderNav">
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="article__slider">
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
							</div>
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
							</div>
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
							</div>
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="article__item">
							<h3 class="title3">Открытие МЦД может повысить цены в близлежащих загородных поселках на 15%, а спрос - на 20%</h3>

							<div class="dotted">
								<div class="dotted__hidden">
									<p>В Департаменте загородной недвижимости ИНКОМ-Недвижимость дали прогноз, как открытие Московских центральных диаметров (МЦД) может повлиять на популярность расположенных рядом поселков. Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией МЦД способно увеличить ценник в успешных проектах на 15%, а спрос - в диапазоне до 20%.</p>
									<p>В Департаменте загородной недвижимости ИНКОМ-Недвижимость дали прогноз, как открытие Московских центральных диаметров (МЦД) может повлиять на популярность расположенных рядом поселков. Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией МЦД способно увеличить ценник в успешных проектах на 15%, а спрос - в диапазоне до 20%.</p>
								</div>

								<div class="dotted__read">Читать полностью >></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="article gray-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 order-lg-1 order-xl-1 order-2">
						<div class="article__item">
							<h3 class="title3">Открытие МЦД может повысить цены в близлежащих загородных поселках на 15%, а спрос - на 20%</h3>

							<div class="dotted">
								<div class="dotted__hidden">
									<p>В Департаменте загородной недвижимости ИНКОМ-Недвижимость дали прогноз, как открытие Московских центральных диаметров (МЦД) может повлиять на популярность расположенных рядом поселков. Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией МЦД способно увеличить ценник в успешных проектах на 15%, а спрос - в диапазоне до 20%.</p>
									<p>В Департаменте загородной недвижимости ИНКОМ-Недвижимость дали прогноз, как открытие Московских центральных диаметров (МЦД) может повлиять на популярность расположенных рядом поселков. Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией МЦД способно увеличить ценник в успешных проектах на 15%, а спрос - в диапазоне до 20%.</p>
								</div>

								<div class="dotted__read">Читать полностью >></div>
							</div>
						</div>
					</div>
					<div class="col-lg-2 order-lg-3 order-xl-3 order-2">
						<div class="article__navWrap">
							<div class="article__sliderNav">
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-5 order-1 order-lg-3 order-xl-3">
						<div class="article__slider">
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
								<a class="popup-youtube play" href="https://www.youtube.com/watch?v=LIPc1cfS-oQ"></a>
							</div>
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
								<a class="popup-youtube play" href="https://www.youtube.com/watch?v=LIPc1cfS-oQ"></a>
							</div>
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
								<a class="popup-youtube play" href="https://www.youtube.com/watch?v=LIPc1cfS-oQ"></a>
							</div>
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
								<a class="popup-youtube play" href="https://www.youtube.com/watch?v=LIPc1cfS-oQ"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="article gray-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-2">
						<div class="article__navWrap">
							<div class="article__sliderNav">
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
								<div class="slide">
									<img src="{{asset('new/img/aticleNav.jpg')}}" alt="img">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="article__slider">
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
							</div>
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
							</div>
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
							</div>
							<div class="slide">
								<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="article__item">
							<h3 class="title3">Открытие МЦД может повысить цены в близлежащих загородных поселках на 15%, а спрос - на 20%</h3>

							<div class="dotted">
								<div class="dotted__hidden">
									<p>В Департаменте загородной недвижимости ИНКОМ-Недвижимость дали прогноз, как открытие Московских центральных диаметров (МЦД) может повлиять на популярность расположенных рядом поселков. Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией МЦД способно увеличить ценник в успешных проектах на 15%, а спрос - в диапазоне до 20%.</p>
									<p>В Департаменте загородной недвижимости ИНКОМ-Недвижимость дали прогноз, как открытие Московских центральных диаметров (МЦД) может повлиять на популярность расположенных рядом поселков. Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией МЦД способно увеличить ценник в успешных проектах на 15%, а спрос - в диапазоне до 20%.</p>
								</div>

								<div class="dotted__read">Читать полностью >></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<section id="section-contact" class="contact">
			<div class="container">
				<div class="row">
					<div class="col-12">
						
						<a href="{{url('new-site/help')}}" class="main-btn">Связаться с нами</a>

						<div class="contact__nav">
							<a href="#">Контакты</a>
							<a href="#">О нас</a>
						</div>

						<div class="social">
							<a href="#">
								<img src="{{asset('new/img/twitter.svg')}}" alt="twitter">
							</a>
							<a href="#">
								<img src="{{asset('new/img/viber.svg')}}" alt="viber">
							</a>
							<a href="#">
								<img src="{{asset('new/img/fb.svg')}}" alt="fb">
							</a>
							<a href="#">
								<img src="{{asset('new/img/telega.svg')}}" alt="telega">
							</a>
							<a href="#">
								<img src="{{asset('new/img/vk.svg')}}" alt="vk">
							</a>
						</div>

						<div class="contact__links">
							<a href="#">Лицензионное соглашение</a>
							<a href="#">Политика конфиденциальности</a>
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
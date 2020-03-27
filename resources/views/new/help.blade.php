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
		<section id="training-section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h2 class="title2">Помощь</h2>
					</div>
				</div>
			</div>

			<div class="training">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="training__item">
								<img src="{{asset('new/img/section_img7.svg')}}" alt="img" class="section_img section_img1">
								<h3 class="title3">Как снимать 3D-тур</h3>
								<p>Если вы агентство недвижимости и собираетесь создавать много виртуальных туров и вам важно качество съемки, то необходимо приобрести специализированные и в тоже время простые по использованию камеры, которые могут снимать 360 градусов, а также штатив.</p>
								<p>Если вам не особо важно качество, то можно с помощью любого смартфона с камерой снять панорамы (возможно вам понадобиться установка дополнительного ПО ... </p>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="video">
								<img src="{{asset('new/img/tube.jpg')}}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="training bg-gray">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 order-lg-2">
							<img src="{{asset('new/img/section_img1.svg')}}" alt="img" class="section_img section_img2">
							<div class="training__item">
								<h3 class="title3">Как снимать 3D-тур</h3>
								<p>Если вы агентство недвижимости и собираетесь создавать много виртуальных туров и вам важно качество съемки, то необходимо приобрести специализированные и в тоже время простые по использованию камеры, которые могут снимать 360 градусов, а также штатив.</p>
								<p>Если вам не особо важно качество, то можно с помощью любого смартфона с камерой снять панорамы (возможно вам понадобиться установка дополнительного ПО ... </p>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="video">
								<img src="{{asset('new/img/tube.jpg')}}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="training">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="training__item">
								<h3 class="title3">Как снимать 3D-тур</h3>
								<p>Если вы агентство недвижимости и собираетесь создавать много виртуальных туров и вам важно качество съемки, то необходимо приобрести специализированные и в тоже время простые по использованию камеры, которые могут снимать 360 градусов, а также штатив.</p>
								<p>Если вам не особо важно качество, то можно с помощью любого смартфона с камерой снять панорамы (возможно вам понадобиться установка дополнительного ПО ... </p>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="video">
								<img src="{{asset('new/img/tube.jpg')}}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="section-faq" class="faq">
			<div class="bg-text v">360 <br>HOUSE</div>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h2 class="title2">Часто задаваемые <span class="orange">вопросы</span></h2>
						<div class="vertical-tabs">
							<div class="vertical-tabs__item">
								<div class="vertical-tabs__title">Что такое 360 HOUSE?</div>
								<div class="vertical-tabs__body">
									<p>Если вы агентство недвижимости и собираетесь создавать много виртуальных туров и вам важно качество съемки, то необходимо приобрести специализированные и в тоже время простые по использованию камеры, которые могут снимать 360 градусов, а также штатив. Если вам не особо важно качество, то можно с помощью любого смартфона с камерой снять панорамы (возможно вам понадобиться установка дополнительного ПО на свой смартфон) и уже с помощью нашего сайта создать виртуальный тур.</p>
									<p>Если вы агентство недвижимости и собираетесь создавать много виртуальных туров и вам важно качество съемки, то необходимо приобрести специализированные и в тоже время простые по использованию камеры, которые могут снимать 360 градусов, а также штатив. Если вам не особо важно качество, то можно с помощью любого смартфона с камерой снять панорамы (возможно вам понадобиться установка дополнительного ПО на свой смартфон) и уже с помощью нашего сайта создать виртуальный тур.</p>
								</div>
							</div>
							<div class="vertical-tabs__item">
								<div class="vertical-tabs__title">Что мне нужно для создания виртуального тура?</div>
								<div class="vertical-tabs__body">
									<p>Если вы агентство недвижимости и собираетесь создавать много виртуальных туров и вам важно качество съемки, то необходимо приобрести специализированные и в тоже время простые по использованию камеры, которые могут снимать 360 градусов, а также штатив. Если вам не особо важно качество, то можно с помощью любого смартфона с камерой снять панорамы (возможно вам понадобиться установка дополнительного ПО на свой смартфон) и уже с помощью нашего сайта создать виртуальный тур.</p>
								</div>
							</div>
							<div class="vertical-tabs__item">
								<div class="vertical-tabs__title">Как снимать камерой 360?</div>
								<div class="vertical-tabs__body">
									<p>Если вы агентство недвижимости и собираетесь создавать много виртуальных туров и вам важно качество съемки, то необходимо приобрести специализированные и в тоже время простые по использованию камеры, которые могут снимать 360 градусов, а также штатив. Если вам не особо важно качество, то можно с помощью любого смартфона с камерой снять панорамы (возможно вам понадобиться установка дополнительного ПО на свой смартфон) и уже с помощью нашего сайта создать виртуальный тур.</p>
								</div>
							</div>
							<div class="vertical-tabs__item">
								<div class="vertical-tabs__title">Какую камеру лучше использовать для 3D - съемки? </div>
								<div class="vertical-tabs__body">
									<p>Если вы агентство недвижимости и собираетесь создавать много виртуальных туров и вам важно качество съемки, то необходимо приобрести специализированные и в тоже время простые по использованию камеры, которые могут снимать 360 градусов, а также штатив. Если вам не особо важно качество, то можно с помощью любого смартфона с камерой снять панорамы (возможно вам понадобиться установка дополнительного ПО на свой смартфон) и уже с помощью нашего сайта создать виртуальный тур.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="section-contact" class="contact">
			<div class="container">
				<div class="row">
					<div class="col-12">
						
						<a href="#" class="main-btn">Связаться с нами</a>

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
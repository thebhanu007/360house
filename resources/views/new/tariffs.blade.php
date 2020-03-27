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
		<section id="select-tarrifs">
			<img src="{{asset('new/img/section_img1.svg')}}" alt="img" class="section_img section_img1">
			<img src="{{asset('new/img/section_img7.svg')}}" alt="img" class="section_img section_img2">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h2 class="title2">Выбери свой <span class="red">тариф</span></h2>

						<div class="tabs">
							<ul class="tabs__caption">
								<li>месяц</li>
								<li class="active banner-trigger active">год</li>
								<div class="banner show">Скидка <b>25%</b></div>
							</ul>
							<div class="tabs__content">
								<div class="row">
									<div class="col-lg-3 col-md-6 col-sm-6">
										<div class="tariff-item">
											<div class="tariff-item__discount">-50 % только сегодня </div>
											<h3 class="title3">Название1</h3>
											<hr>
											<div class="tariff-item__description">Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией</div>
											<div class="tariff-item__oldPrice">
												старая цена <span>60 000 руб.</span>
											</div>
											<div class="tariff-item__newPrice">50 000 руб.</div>
										</div>
									</div>

									<div class="col-lg-3 col-md-6 col-sm-6">
										<div class="tariff-item">
											<div class="tariff-item__discount">-50 % только сегодня </div>
											<h3 class="title3">Название1</h3>
											<hr>
											<div class="tariff-item__description">Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией</div>
											<div class="tariff-item__oldPrice">
												старая цена <span>60 000 руб.</span>
											</div>
											<div class="tariff-item__newPrice">50 000 руб.</div>
										</div>
									</div>

									<div class="col-lg-3 col-md-6 col-sm-6">
										<div class="tariff-item">
											<div class="tariff-item__discount">-50 % только сегодня </div>
											<h3 class="title3">Название</h3>
											<hr>
											<div class="tariff-item__description">Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией</div>
											<div class="tariff-item__oldPrice">
												старая цена <span>60 000 руб.</span>
											</div>
											<div class="tariff-item__newPrice">50 000 руб.</div>
										</div>
									</div>

									<div class="col-lg-3 col-md-6 col-sm-6">
										<div class="tariff-item">
											<div class="tariff-item__discount">-50 % только сегодня </div>
											<h3 class="title3">Название</h3>
											<hr>
											<div class="tariff-item__description">Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией</div>

											<!-- <div class="center">
												<a href="#" class="main-btn">Связаться с нами</a>
											</div> -->
											<div class="tariff-item__oldPrice">
												старая цена <span>60 000 руб.</span>
											</div>
											<div class="tariff-item__newPrice">50 000 руб.</div>
										</div>
									</div>
								</div>
							</div>

							<div class="tabs__content active">
								<div class="row">
									<div class="col-lg-3 col-md-6 col-sm-6">
										<div class="tariff-item">
											<div class="tariff-item__discount">-50 % только сегодня </div>
											<h3 class="title3">Название</h3>
											<hr>
											<div class="tariff-item__description">Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией</div>
											<div class="tariff-item__oldPrice">
												старая цена <span>60 000 руб.</span>
											</div>
											<div class="tariff-item__newPrice">50 000 руб.</div>
										</div>
									</div>

									<div class="col-lg-3 col-md-6 col-sm-6">
										<div class="tariff-item">
											<div class="tariff-item__discount">-50 % только сегодня </div>
											<h3 class="title3">Название</h3>
											<hr>
											<div class="tariff-item__description">Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией</div>
											<div class="tariff-item__oldPrice">
												старая цена <span>60 000 руб.</span>
											</div>
											<div class="tariff-item__newPrice">50 000 руб.</div>
										</div>
									</div>
									
									<div class="col-lg-3 col-md-6 col-sm-6">
										<div class="tariff-item">
											<div class="tariff-item__discount">-50 % только сегодня </div>
											<h3 class="title3">Название</h3>
											<hr>
											<div class="tariff-item__description">Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией</div>
											<div class="tariff-item__oldPrice">
												старая цена <span>60 000 руб.</span>
											</div>
											<div class="tariff-item__newPrice">50 000 руб.</div>
										</div>
									</div>

									<div class="col-lg-3 col-md-6 col-sm-6">
										<div class="tariff-item">
											<div class="tariff-item__discount">-50 % только сегодня </div>
											<h3 class="title3">Название</h3>
											<hr>
											<div class="tariff-item__description">Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией</div>

											<!-- <div class="center">
												<a href="#" class="main-btn">Связаться с нами</a>
											</div> -->
											<div class="tariff-item__oldPrice">
												старая цена <span>60 000 руб.</span>
											</div>
											<div class="tariff-item__newPrice">50 000 руб.</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="center">
							<a href="#" class="main-btn">Индивидуальные условия!</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="goods">
			<img src="{{asset('new/img/section_img4.svg')}}" alt="img" class="section_img section_img1">
			<img src="{{asset('new/img/section_img5.svg')}}" alt="img" class="section_img section_img2">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="subtitle">Для работы с нашим сервисом вам неоходимо иметь камеру Ricoh Theta 360 и штатив (монопод).</div>
					</div>
				</div>
				<div class="must-have">
					<div class="row">
						<div class="bg-text g">360<br>HOUSE</div>
						<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
							<div class="must-have__item">
								<div class="must-have__img">
									<img src="{{asset('new/img/mh1.png')}}" alt="img">
								</div>
								<div class="must-have__info">
									<div class="must-have__text">-Камеры семейства Ricoh Theta</div>
									<div class="must-have__text">Модели: SC2, V, Z</div>
								</div>
							</div>

							<div class="must-have__item">
								<div class="must-have__img">
									<img src="{{asset('new/img/mh2.png')}}" alt="img">
								</div>
								<div class="must-have__info">
									<div class="must-have__text">-Камеры семейства Ricoh Theta</div>
									<div class="must-have__text">Модели: SC2, V, Z</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="goods-kit">
					<div class="row">
						<div class="col-12">
							<h2 class="title2"><span class="blue">Готовые</span> комплекты</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 offset-lg-3 col-md-6 col-sm-6 mb">
							<div class="goods-item">
								<img src="{{asset('new/img/goods1.jpg')}}" alt="">
								<div class="goods-item__title">Pentax.ru</div>
								<a href="#" class="main-btn">Перейти</a>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 mb">
							<div class="goods-item">
								<img src="{{asset('new/img/goods1.jpg')}}" alt="">
								<div class="goods-item__title">Pentax.ru</div>
								<a href="#" class="main-btn">Перейти</a>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<h2 class="title2">Собрать комплект <span class="red">самостоятельно</span></h2>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6 mb">
						<div class="goods-item">
							<img src="{{asset('new/img/goods1.jpg')}}" alt="">
							<div class="goods-item__title">Камера <br> Ricoh Theta SC</div>
							<!-- <div class="goods-item__oldPrice">
								старая цена <span>60 000 руб.</span>
							</div>
							<div class="goods-item__newPrice">50 000 руб.</div> -->
							<a href="#" class="main-btn">Перейти</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 mb">
						<div class="goods-item">
							<img src="{{asset('new/img/goods2.jpg')}}" alt="">
							<div class="goods-item__title">Камера <br> Ricoh Theta V</div>
							<!-- <div class="goods-item__oldPrice">
								старая цена <span>60 000 руб.</span>
							</div>
							<div class="goods-item__newPrice">50 000 руб.</div> -->
							<a href="#" class="main-btn">Перейти</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 mb">
						<div class="goods-item">
							<img src="{{asset('new/img/goods3.jpg')}}" alt="">
							<div class="goods-item__title">Камера <br> Ricoh Theta Z</div>
							<!-- <div class="goods-item__oldPrice">
								старая цена <span>60 000 руб.</span>
							</div>
							<div class="goods-item__newPrice">50 000 руб.</div> -->
							<a href="#" class="main-btn">Перейти</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 mb">
						<div class="goods-item">
							<img src="{{asset('new/img/goods4.jpg')}}" alt="">
							<div class="goods-item__title">Штатив монопод</div>
							<!-- <div class="goods-item__oldPrice">
								старая цена <span>60 000 руб.</span>
							</div>
							<div class="goods-item__newPrice">50 000 руб.</div> -->
							<a href="#" class="main-btn">Перейти</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="tariff-comparison">
			<!-- <img src="img/section_img5.svg" alt="img" class="section_img section_img1"> -->
			<img src="{{asset('new/img/section_img7.svg')}}" alt="img" class="section_img section_img2">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h2 class="title2"><span class="blue">Сравнение</span> тарифов</h2>

						<div class="table">
							<table>
								<tr>
									<th>Наименование тарифа</th>
									<th>1 категория</th>
									<th>2 категория</th>
									<th>3 категория</th>
								</tr>
								<tr>
									<td>Тариф № 1</td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
								</tr>
								<tr>
									<td>Тариф № 2</td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
								</tr>
								<tr>
									<td>Тариф № 3</td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
								</tr>
								<tr>
									<td>Тариф № 4</td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
									<td><img src="{{asset('new/img/yes.svg')}}" alt="img"></td>
								</tr>
							</table>
						</div>

						<div class="horizontal-swipe">
							<img src="{{asset('new/img/horizontal-scroll.svg')}}" alt="scroll">
							Для просмотра таблицы прокрутите страницу вправо
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="FAQ">
			<img src="{{asset('new/img/section_img4.svg')}}" alt="img" class="section_img">
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

		<div class="article gray-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-5">
						<img src="{{asset('new/img/aticle.jpg')}}" alt="img">
					</div>
					<div class="col-lg-7">
						<div class="article__item">
							<h3 class="title3">Открытие МЦД может повысить цены в близлежащих загородных поселках на 15%, а спрос - на 20%</h3>

							<p>В Департаменте загородной недвижимости ИНКОМ-Недвижимость дали прогноз, как открытие Московских центральных диаметров (МЦД) может повлиять на популярность расположенных рядом поселков. Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией МЦД способно увеличить ценник в успешных проектах на 15%, а спрос - в диапазоне до 20%.</p>
							<p>В Департаменте загородной недвижимости ИНКОМ-Недвижимость дали прогноз, как открытие Московских центральных диаметров (МЦД) может повлиять на популярность расположенных рядом поселков. Эксперты компании полагают, что в перспективе 3-4 лет соседство со станцией МЦД способно увеличить ценник в успешных проектах на 15%, а спрос - в диапазоне до 20%.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection
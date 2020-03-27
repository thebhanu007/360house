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
		<section id="search">
			<div class="tabs">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="tabs__head">
								<ul class="tabs__caption">
									<li class="active">Продажа</li>
									<li>Аренда</li>
								</ul>
								<div class="type-property">
									<a href="#" class="switch-btn active">Жилая</a>
									<a href="#" class="switch-btn">Коммерческая</a>
								</div>
								<div class="filter-btn">Показать фильтры</div>
							</div>
						</div>
					</div>
				</div>

				<form class="search-filter">
					<div class="container">
						<div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="formgroup">
									<select>
										<option disabled selected hidden>Выбрать регион</option>
										<option>1</option>
										<option>2</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formgroup">
									<select>
										<option disabled selected hidden>Выбрать город</option>
										<option>1</option>
										<option>2</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="formgroup">
									<select>
										<option disabled selected hidden>Тип недвижимости</option>
										<option>Квартира</option>
										<option>Комната</option>
										<option>Дом</option>
										<option>Коммерческая</option>
										<option>Новостройка</option>
										<option>Объект</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formgroup">
									<select>
										<option disabled selected hidden>Количество комнат</option>
										<option>1</option>
										<option>2</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formgroup">
									<select>
										<option disabled selected hidden>Материал здания</option>
										<option>1</option>
										<option>2</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="formgroup">
									<input type="text" placeholder="Цена от">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="formgroup">
									<input type="text" placeholder="Цена до">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="formgroup">
									<input type="text" placeholder="Площадь от (м2)">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="formgroup">
									<input type="text" placeholder="Площадь до (м2)">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="formgroup">
									<input type="text" placeholder="Этаж от">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="formgroup">
									<input type="text" placeholder="Этаж до">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="formgroup">
									<input type="text" placeholder="Этажность здания от">
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="formgroup">
									<input type="text" placeholder="Этажность здания до">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3 col-md-4">
								<div class="formgroup">
									<label class="checkbox">
				                        <input type="checkbox" class="">
				                        <span class="checkbox__text">Не последний этаж</span>
				                    </label>
								</div>
							</div>
							<div class="col-lg-3 col-md-4">
								<div class="formgroup">
									 <label class="checkbox">
				                        <input type="checkbox" class="">
				                        <span class="checkbox__text">Без залога</span>
				                    </label>
			                    </div>
							</div>
							<div class="col-lg-3 col-md-4">
								<div class="formgroup">
									 <label class="checkbox">
				                        <input type="checkbox" class="">
				                        <span class="checkbox__text">Без комиссии</span>
				                    </label>
			                    </div>
							</div>
							<div class="col-lg-3">
								<div class="search-filter__btn">
									<button class="main-btn">Найти</button>
								</div>
							</div>
						</div>
					</div>
				</form>		
							
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="tabs__content active">
							<div class="map">
								<img src="{{asset('new/img/map2.jpg')}}" alt="img">
							</div>

							<div class="page-filter">
								<div class="page-filter__item">
									<div class="page-filter__text">Сортировать:</div>
									<select class="page-filter__sort">
										<option>по умолчанию</option>
										<option>дешевле</option>
										<option>дороже</option>
										<option>по дате</option>
									</select>
								</div>
								<div class="page-filter__item">
									<div class="page-filter__text">Показывать на странице:</div>
									<select class="page-filter__num">
										<option>5</option>
										<option selected>10</option>
										<option>20</option>
									</select>
								</div>
							</div>

							<a href="#" class="search-card">
								<div class="row">
									<div class="col-lg-7">
										<div class="search-card__img">
											<img src="{{asset('new/img/search-card.jpg')}}" alt="img">
										</div>
									</div>
									<div class="col-lg-5">
										<div class="search-card__info">
											<div class="search-card__head">
												<div class="search-card__price">4 555 000 руб.</div>
												<img src="{{asset('new/img/logo.svg')}}" alt="logo" class="search-card__logo">
											</div>
											<div class="search-card__title">2-комнатная квартира на продажу</div>	
											<div class="search-card__text">Россия, Хабаровск, ул. Ленина, 2</div>

											<div class="search-card__list">
												<ul>
													<li>Площадь: 56 м2</li>
													<li>Этаж: 5</li>
												</ul>
											</div>

											<div class="search-card__discr">
												<div class="search-card__title">2-комнатная квартира на продажу</div>
												<p>Если вы агентство недвижимости и собираетесь создавать много виртуальных туров и вам важно качество съемки, то необходимо приобрести специализированные и в тоже время простые по использованию камеры, которые могут снимать 360 градусов, а также штатив. Если вам не особо важно качество, то можно с помощью любого смартфона с камерой снять панорамы (возможно вам понадобиться установка дополнительного ПО ... </p>
											</div>
										</div>
									</div>
								</div>
							</a>
							<a href="#" class="search-card">
								<div class="row">
									<div class="col-lg-7">
										<div class="search-card__img">
											<img src="{{asset('new/img/search-card.jpg')}}" alt="img">
										</div>
									</div>
									<div class="col-lg-5">
										<div class="search-card__info">
											<div class="search-card__head">
												<div class="search-card__price">4 555 000 руб.</div>
												<img src="{{asset('new/img/logo.svg')}}" alt="logo" class="search-card__logo">
											</div>
											<div class="search-card__title">2-комнатная квартира на продажу</div>	
											<div class="search-card__text">Россия, Хабаровск, ул. Ленина, 2</div>

											<div class="search-card__list">
												<ul>
													<li>Площадь: 56 м2</li>
													<li>Этаж: 5</li>
												</ul>
											</div>

											<div class="search-card__discr">
												<div class="search-card__title">2-комнатная квартира на продажу</div>
												<p>Если вы агентство недвижимости и собираетесь создавать много виртуальных туров и вам важно качество съемки, то необходимо приобрести специализированные и в тоже время простые по использованию камеры, которые могут снимать 360 градусов, а также штатив. Если вам не особо важно качество, то можно с помощью любого смартфона с камерой снять панорамы (возможно вам понадобиться установка дополнительного ПО ... </p>
											</div>
										</div>
									</div>
								</div>
							</a>
							<a href="#" class="search-card">
								<div class="row">
									<div class="col-lg-7">
										<div class="search-card__img">
											<img src="{{asset('new/img/search-card.jpg')}}" alt="img">
										</div>
									</div>
									<div class="col-lg-5">
										<div class="search-card__info">
											<div class="search-card__head">
												<div class="search-card__price">4 555 000 руб.</div>
												<img src="{{asset('new/img/logo.svg')}}" alt="logo" class="search-card__logo">
											</div>
											<div class="search-card__title">2-комнатная квартира на продажу</div>	
											<div class="search-card__text">Россия, Хабаровск, ул. Ленина, 2</div>

											<div class="search-card__list">
												<ul>
													<li>Площадь: 56 м2</li>
													<li>Этаж: 5</li>
												</ul>
											</div>

											<div class="search-card__discr">
												<div class="search-card__title">2-комнатная квартира на продажу</div>
												<p>Если вы агентство недвижимости и собираетесь создавать много виртуальных туров и вам важно качество съемки, то необходимо приобрести специализированные и в тоже время простые по использованию камеры, которые могут снимать 360 градусов, а также штатив. Если вам не особо важно качество, то можно с помощью любого смартфона с камерой снять панорамы (возможно вам понадобиться установка дополнительного ПО ... </p>
											</div>
										</div>
									</div>
								</div>
							</a>

							<nav class="page-nav">
								<a href="#"><< <span>Предыдущая</span></a>
								<a href="#">...</a>
								<a href="#">5</a>
								<a href="#">6</a>
								<a href="#" class="active">7</a>
								<a href="#">8</a>
								<a href="#">9</a>
								<a href="#">...</a>
								<a href="#"><span>Следующая</span> >></a>
							</nav>
						</div>
						<div class="tabs__content">
							222
						</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
@endsection
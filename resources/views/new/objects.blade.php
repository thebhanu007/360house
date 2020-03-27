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
		<section id="person-area" class="person-area">
			<img src="img/section_img4.svg" alt="img" class="section_img section_img1">
			<img src="img/section_img1.svg" alt="img" class="section_img section_img2">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="person-area__head">
							<div class="person-area__photo">
								<img src="img/avatar.jpg" alt="">
							</div>
							<div class="person-area__rBlock">
								<h3 class="title3">Здравствуйте, Иван!</h3>
								<div class="person-area__info">
									<div class="item">Ваш тариф: <span>Старт</span></div>
									<div class="item">Списание: <span>24. 12. 19</span></div>
									<div class="item">Панорамы: <span>14/50</span></div>
								</div>

								<div class="person-area__search d-none d-sm-block">
									<form>
										<input type="text" placeholder="ID тура или адрес">
										<button class="main-btn">Найти</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xl-2 col-lg-3">
						<div class="sidebar">
							<div class="close-btn"></div>
							<nav class="sidebar__nav">
								<li><a href="#">Создать объявление</a></li>
								<li><a href="#">Сообщения</a></li>
								<li><a href="#">Финансы</a></li>
								<li><a href="{{url('/new-site/tariffs')}}">Сменить тариф</a></li>
								<li><a href="#">Обучение</a></li>
								<li><a href="{{url('/new-site/help')}}">Помощь</a></li>
							</nav>
						</div>
					</div>
					<div class="col-xl-10 col-lg-9">
						<div class="person-area__search d-block d-sm-none">
							<form>
								<input type="text" placeholder="ID тура или адрес">
								<button class="main-btn"></button>
							</form>
						</div>
						<div class="table">
							<table>
								<tr>
									<th>ID</th>
									<th>Адрес</th>
									<th>Дата создания</th>
									<th>Активно до</th>
									<th></th>
								</tr>
								<tr>
									<td>1</td>
									<td>Хабаровск, улица Гоголя, 14</td>
									<td>11. 12. 2019</td>
									<td>11. 12. 2019</td>
									<td>
										<a href="#">
											<img src="img/code-signs.svg" alt="icon">
										</a>
										<a href="#">
											<img src="img/edit.svg" alt="icon">
										</a>
										<a href="#">
											<img src="img/trash.svg" alt="icon">
										</a>
									</td>
								</tr>
								<tr>
									<td>1</td>
									<td>Хабаровск, улица Гоголя, 14</td>
									<td>11. 12. 2019</td>
									<td>11. 12. 2019</td>
									<td>
										<a href="#">
											<img src="img/code-signs.svg" alt="icon">
										</a>
										<a href="#">
											<img src="img/edit.svg" alt="icon">
										</a>
										<a href="#">
											<img src="img/trash.svg" alt="icon">
										</a>
									</td>
								</tr>
								<tr>
									<td>1</td>
									<td>Хабаровск, улица Гоголя, 14</td>
									<td>11. 12. 2019</td>
									<td>11. 12. 2019</td>
									<td>
										<a href="#">
											<img src="img/code-signs.svg" alt="icon">
										</a>
										<a href="#">
											<img src="img/edit.svg" alt="icon">
										</a>
										<a href="#">
											<img src="img/trash.svg" alt="icon">
										</a>
									</td>
								</tr>
								<tr>
									<td>1</td>
									<td>Хабаровск, улица Гоголя, 14</td>
									<td>11. 12. 2019</td>
									<td>11. 12. 2019</td>
									<td>
										<a href="#">
											<img src="img/code-signs.svg" alt="icon">
										</a>
										<a href="#">
											<img src="img/edit.svg" alt="icon">
										</a>
										<a href="#">
											<img src="img/trash.svg" alt="icon">
										</a>
									</td>
								</tr>
								<tr>
									<td>1</td>
									<td>Хабаровск, улица Гоголя, 14</td>
									<td>11. 12. 2019</td>
									<td>11. 12. 2019</td>
									<td>
										<a href="#">
											<img src="img/code-signs.svg" alt="icon">
										</a>
										<a href="#">
											<img src="img/edit.svg" alt="icon">
										</a>
										<a href="#">
											<img src="img/trash.svg" alt="icon">
										</a>
									</td>
								</tr>
							</table>
							<div class="horizontal-swipe">
								<img src="img/horizontal-scroll.svg" alt="scroll">
								Для просмотра таблицы прокрутите страницу вправо
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
@endsection
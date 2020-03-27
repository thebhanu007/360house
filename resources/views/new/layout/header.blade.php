<header class="header @yield('header-type')">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="header_content">
						<a href="{{url('/new-site/')}}" class="logo">
							<img src="{{asset('new/img/logo.jpg')}}" alt="logo">
						</a>

						<nav class="header-nav">
							<a href="{{url('/contacts')}}">Контакты</a>
							<a href="{{url('/new-site/tariffs')}}" @if(url()->current() == url('/new-site/tariffs'))  class="active" @endif>Тарифы</a>
							<a href="{{url('/new-site/help')}}" @if(url()->current() == url('/new-site/help'))  class="active" @endif>Помощь</a>
							<a href="{{url('/new-site/login')}}" @if(url()->current() == url('/new-site/login'))  class="active" @endif>Личный кабинет</a>
						</nav>

						<div class="mobMenu-btn">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="mob-menu">
		<div class="mobMenu-btn open">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
		<nav class="header-nav">
			<a href="{{url('/contacts')}}">Контакты</a>
			<a href="{{url('/new-site/tariffs')}}" @if(url()->current() == url('/new-site/tariffs'))  class="active" @endif>Тарифы</a>
			<a href="{{url('/new-site/help')}}" @if(url()->current() == url('/new-site/help'))  class="active" @endif>Помощь</a>
			<a href="{{url('/new-site/login')}}" @if(url()->current() == url('/new-site/login'))  class="active" @endif>Личный кабинет</a>
		</nav>
		<div class="btn-wrap">
			<a href="#" class="main-btn">Регистрация</a>
		</div>
	</div>

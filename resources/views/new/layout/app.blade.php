<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title> @yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('styles')
</head>
<body>
	
@include('new.layout.header')

    @yield('content')

@include('new.layout.footer')

@yield('scripts')

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>@lang('register.titleEmail')</title>
</head>
<body>
	<p>
		@lang('register.contentEmail')
		</br>
		<a href="{{ $account->activation_link }}">{{ $account->activation_link }}</a>
	</p>
</body>
</html>

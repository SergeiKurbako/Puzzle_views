<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'webwidgets.ru') }}</title>
</head>
<body style="background-color: #444">
    <table style="border: 10px solid #0178BF; width: 100%; background-color: #ffffff;" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width: 250px;">
                <p style="text-align: center;">
                    <img style="width: 250px;" src="http://admin.webwidgets.ru/img/icon/logo_email.png" alt="">
                </p>
            </td>
        </tr>
        <tr>
            <td><p style="font-size: 25px; text-align: center;">{{$messages}}</p></td>
        </tr>
        <tr>
            <td>
                <p style="text-align: center;  margin: 100px;">
                    <a style="text-align: center; font-size: 25px; color:#ffffff; background-color: #0c83e2; border: 30px solid #0c83e2; text-decoration: none;" href="http://partycamera.org">Перейти</a>
                </p>
            </td>
        </tr>
    </table>
</body>
</html>


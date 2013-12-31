<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<h2>Hello {{ $user->name }}, Please follow the following instructions to change your password.</h2>

If you haven't request any password change. Then please ignore this message.<br /><Br />

If you forgot your password and want to change it please follow the following link: <br />
<a href="{{ $url }}">
    {{ $url }}
</a>
<br /><br />
For your security, don't share this url with anyone.
<br />
AmerGroup2 Administrators

</body>
</html>
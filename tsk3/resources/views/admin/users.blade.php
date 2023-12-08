<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf8">
    <title>Пользователи</title>
</head>
<body>
@foreach ($users as $user)
    <pre>{{ $user->name }} - {{ $user->email }}</pre>
@endforeach
</body>
</html>



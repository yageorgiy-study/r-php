<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>Генератор пароля</title>
</head>
<body>
<form>
    @foreach ($notifications as $notification)
{{--        @dump($notification)--}}
{{--        @if($notification instanceof \App\Notifications\UserRegisteredNotification)--}}
        @if(isset($notification->data["id"]) && isset($notification->data["name"]))
        <div class="notification">
            User #{{ $notification->data["id"] }} with name {{ $notification->data["name"] }} has registered at {{ $notification->created_at }}.
        </div>
        @endif
    @endforeach
</form>

</body>
</html>

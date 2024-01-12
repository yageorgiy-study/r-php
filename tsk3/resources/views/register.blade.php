<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>Регистрация</title>
</head>
<body>
<form>
    <div>
        <label for="login">E-mail:</label>
        <input id="login" type="email">
    </div>

    <div>
        <label for="name">Имя пользователя:</label>
        <input id="name">
    </div>

    <div>
        <label for="password">Пароль:</label>
        <input id="password" type="password">
    </div>



    <button id="generate">Зарегистрироваться</button>
</form>

<script>
    // Ссылка на API метод
    const url = `{{ route("api.auth.register") }}`;
</script>

<!-- TODO: в отдельный js файл -->
<script>

    // По завершению работы документа
    document.addEventListener("DOMContentLoaded", function(event) {
        let button = document.getElementById("generate");

        let login = document.getElementById("login");
        let name = document.getElementById("name");
        let password = document.getElementById("password");


        // По клику на кнопку выполняем
        button.addEventListener("click",function(e){
            // Отключаем действие кнопки отправки сообщения у формы по умолчанию,
            // чтобы выполнить свои действия
            e.preventDefault();
            // Блокируем кнопку
            button.disabled = "true";

            // Составляем ссылку на страницу
            let urlObject = new URL(url);
            // urlObject.searchParams.set('password_length', maxDigits.value);

            // Инициализируем запрос
            let xhr = new XMLHttpRequest();

            // Если успешно
            xhr.onload = function() {
                button.disabled = "";
                // password.value = ;
                try {
                    const json = JSON.parse(xhr.response);
                    if(json.error !== undefined){
                        alert(`Ошибка регистрации: ${json.error}`);
                    } else {
                        alert(`Регистрация успешна.`);
                    }
                } catch(e){
                    alert(`Ответ от сервера: ${xhr.response}`);
                }

            };
            // Если ошибка
            xhr.onerror = function() {
                button.disabled = "";
                password.value = "?";
                alert(`Ошибка соединения`);
            };

            // Настройка ссылки
            xhr.open('POST', urlObject);

            const data = new FormData();
            data.append('email', login.value);
            data.append('name', name.value);
            data.append('password', password.value);

            // Выполняем запрос
            xhr.send(data);
        }, false);
    });

</script>
</body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8">
        <title>Генератор пароля</title>
    </head>
    <body>
        <form>
            <div>
                <label for="maxDigits">Количество знаков пароля:</label>
                <input type="number" min="1" max="32" id="maxDigits" value="10">
            </div>

            <div>
                <label for="password">Сгенерированный пароль:</label>
                <input readonly id="password">
            </div>

            <button id="generate">Сгенерировать</button>
        </form>

        <script>
            // Ссылка на API метод
            const url = `{{ route("api.getRandomPassword") }}`;
        </script>

        <!-- TODO: в отдельный js файл -->
        <script>

            // По завершению работы документа
            document.addEventListener("DOMContentLoaded", function(event) {
                let button = document.getElementById("generate");
                let maxDigits = document.getElementById("maxDigits");
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
                    urlObject.searchParams.set('password_length', maxDigits.value);

                    // Инициализируем запрос
                    let xhr = new XMLHttpRequest();

                    // Если успешно
                    xhr.onload = function() {
                        button.disabled = "";
                        password.value = xhr.response;
                    };
                    // Если ошибка
                    xhr.onerror = function() {
                        button.disabled = "";
                        password.value = "?";
                        alert(`Ошибка соединения`);
                    };

                    // Настройка ссылки
                    xhr.open('GET', urlObject);
                    // Выполняем запрос
                    xhr.send();
                }, false);
            });

        </script>
    </body>
</html>

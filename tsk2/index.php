<?php

/**
 * Функция генерации псевдослучайной строки заданной длины
 * @param int $length
 * @return string
 * @throws Exception
 */
function generateRandomString(int $length): string {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Если есть get параметр password_length, то выполняем генерацию пароля
if(isset($_GET["password_length"])){
    try {
        $password_length = $_GET["password_length"];

        // Если строка - это неотрицательное число (состоит только из цифр)
        if(!ctype_digit($password_length))
            // то выкидываем исключение для завершения обработки
            throw new Exception("Password length is not an int type");

        $password_length = (int)$password_length;

        // Если длина пароля меньше нуля или больше 32 (выходит за границы)
        if($password_length <= 0 || $password_length > 32)
            // то выкидываем исключение для завершения обработки
            throw new Exception("Bad password length");

        die(generateRandomString($password_length));
    } catch(Exception $e) {
        // Выводим "?" если поймано исключение
        die("?");
    }
}
?>
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
                    let url = new URL(window.location.href);
                    url.searchParams.set('password_length', maxDigits.value);

                    console.log(url);

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
                    xhr.open('GET', url);
                    // Выполняем запрос
                    xhr.send();
                }, false);
            });

        </script>
    </body>
</html>

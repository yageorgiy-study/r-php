<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Функция генерации псевдослучайной строки заданной длины
     * @param int $length
     * @return string
     * @throws Exception
     */
    private  function generateRandomString(int $length): string {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     *
     * @param Request $request
     * @return ContractApplication|ResponseFactory|Application|Response
     */
    public function getRandomNumber(Request $request)
    {
        try {
            $password_length = $request->get("password_length");

            $validator = Validator::make($request->all(), [
                'password_length' => 'required|numeric|min:1|max:32'
            ]);

            if($validator->fails())
                throw new Exception("Bad request");

            return response($this->generateRandomString($password_length), 200);
        } catch(Exception $e) {
            // Выводим "?" если поймано исключение
            return response("?", 200);
        }
    }
}

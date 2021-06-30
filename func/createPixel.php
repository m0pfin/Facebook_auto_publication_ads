<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 20.06.2020
 * Time: 03:55
 */


/**
 * Создание пикселя - FB
 * @param $ad_id - рекламного акка
 * @param $token - из Ads Manager
 * @param $curl - класс php-curl
 * @return $pixel_id
 */

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;
$curl = new Curl();

function createPixel ($ad_id, $curl, $proxy, $token){

    /**
     * Прокси
     */

    $row = explode(':', $proxy);

    $ip = $row[0]; // ip
    $port = $row[1]; // port
    $login = $row[2]; //login
    $pass = $row[3]; //pass


    /**
     * Привязываем карту
     */


    $curl = new Curl();

    // Прокси
    $curl->setProxy($ip, $port, $login, $pass);
    $curl->setProxyTunnel();



    $curl->setHeader('Content-Type', 'application/json');
    $curl->post('https://graph.facebook.com/v7.0/' . $ad_id . '/adspixels/',  array(
        'name' => 'MyPixel',
        'access_token' => $token
    ));
    $result = $curl->response;

    if (isset($result->error->message)){ // Проверяем есть ли ошибка
        return "<font color='red'>Ошибка создания пикселя!</font> " . $result->error->message;
    }
    else{
        //Получаем ID
        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $pixel_id = $response; //['id'];
        return $pixel_id;
    }
}
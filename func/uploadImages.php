<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 24.06.2020
 * Time: 07:07
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;
$curl = new Curl();


/**
 * @param $curl
 * @param $id - Рекламного аккаунта
 * @param $file - Путь до файла
 * @param $token - Токен
 * @return mixed - IMAGE_HASH
 * @throws ErrorException
 */
function uploadImage ($curl, $id, $file_name, $file_url, $token){

//    $uploaddir = PATH . 'tmp/'; // укажите папку для загрузки, в которую у сервера есть права записи!
//    $uploadfile = $uploaddir . basename($_FILES['file']['name']);
//    move_uploaded_file($file['file']['tmp_name'], $uploadfile);

    $curl = new Curl();

    $curl->setHeader('Content-Type', 'multipart/form-data');
    $curl->post('https://graph.facebook.com/v7.0/'.$id.'/adimages', array(
        //'filename' => new CURLFile(PATH . 'tmp/' . $file['file']['name']),
        'filename' => new CURLFile($file_url),
        'access_token' => $token
    ));

    $result = $curl->response;
    if (isset($result->error->message)){ // Проверяем есть ли ошибка
        return "<font color='red'>Ошибка загрузки креатива: </font>" . $result->error->message; // . ' ' . $result->error->error_user_title . ' ' . $result->error->error_user_msg;
    } elseif ($curl->error) {
        return 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $image_hash = $response['images'][''.$file_name.'']['hash']; // получаем IMAGE_HASH
        return $image_hash; // Получаем ID созданного AdCreative для залива объявления
    }
}

//$id = 'act_582227366058867';
//$token = 'EAABsbCS1iHgBAK8aDxL5HAes8tsCnRHYZAw4Qyt5LRptg6EQc7CKIXyOlZA7jSWrnsKHzcfYmHwjh3zQmnpEvmuk3y7voCDOltOrtyWEZBFSnwDciGKVuVZBsd71yZAAb0Djf1Gv4eSfAHTbGBq6nCpqR3WG4nisZB2kK3Kn8UNQZDZD';
//$file_url = '../creative/server/php/files/teaser_23844512802400301_images_0.jpg';
//$file_name = 'teaser_23844512802400301_images_0.jpg';
//
//echo uploadImage($curl, $id, $file_name, $file_url, $token);

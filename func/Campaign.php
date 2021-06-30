<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 11.06.2020
 * Time: 06:39
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;

/**
 * @param $id - рекламного акка
 * @param $token - из Ads Manager
 * @param $curl - класс php-curl
 */
function createCampgain($id, $name_campaign, $status_campaign, $objective,  $token, $curl) {
    $curl->setHeader('Content-Type', 'application/json');
    $curl->post('https://graph.facebook.com/v7.0/'.$id.'/campaigns', array(
        'name' => $name_campaign,
        'objective' => $objective,
        'status' => $status_campaign,
        'special_ad_categories' => 'NONE',
        'access_token' => $token,
    ));


    $result = $curl->response;

    if (isset($result->error->message)){ // Проверяем есть ли ошибка
        return "<font color='red'>Ошибка создания кампании: </font> " . $result->error->message . '<br>' . $result->error->error_user_msg;
    } elseif ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        //var_dump($curl->response);

        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $campaign_id = $response; //['id'];
        return $campaign_id; // Получаем ID созданной кампании
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 13.06.2020
 * Time: 15:41
 */


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;


/**
 * @param $id - Рекламного аккаунта
 * @param $adset_id - Адсет ID
 * @param $name_ad - Название объявления
 * @param $creative_id
 * @param $token
 * @param $curl
 * @return mixed
 */
function createAd($id, $adset_id, $name_ad, $creative_id, $token, $curl) {

    $data = array(

        'name' => $name_ad,
        'adset_id' => $adset_id,
        'creative' => array(
            'creative_id' => $creative_id,
            'title' => 'My Test Creative',
            'body' => 'My Test Ad Creative Body',
        ),
        'page_id' => '100441328389829',
        'status' => 'ACTIVE',
        'access_token' => $token,
    );

    $curl->setDefaultJsonDecoder($assoc = true);
    $curl->setHeader('Content-Type', 'application/json');
    $curl->post('https://graph.facebook.com/v7.0/'.$id.'/ads', $data);


    $result = $curl->response;

    if (isset($result['error']['message'])){ // Проверяем есть ли ошибка
        return "<font color='red'>Ошибка создания Объявления: </font> " . $result['error']['message'] . '<br>' . $result['error']['error_user_msg'];
    } elseif ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {

        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $ad_id = $response; //['id']; // получаем баланс
        return $ad_id; // Получаем ID созданной кампании
    }
}

//$curl = new Curl();
//
//$id = 'act_569062560412369'; // ID рекламного акка
//$adset_id = '23844820125710670';
//$token = 'EAABsbCS1iHgBAGZBxxF1I9EVX5eG7mX4sKwUwZBYAu3YZBsDWM8xtoA7DBlT3sTCDqYfZBp0CtTxoNVumy34gt8Rh1pV9mmxgmSOFvHCABQZAKSHde7zh2aiAXnHsukYou9fZCc6ZCZALr9iht2CEL1LI1AIBLs4b188ugQJdKGrIAZDZD';
//
//echo createAd($id, $adset_id, $token, $curl);

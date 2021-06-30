<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 13.06.2020
 * Time: 15:41
 * Отдельное спасибо за подсказку instagram_actor_id - @Rinkatoto
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;

function createAdCreativeImages($id,$image_hash,$page_id, $name_ad, $body_ad, $link, $actor_id, $token, $curl) {

    $data = array(

        'name' => 'AdCreative',
        'object_story_spec' => array(
            'link_data' => array(
                'image_hash' => $image_hash,
                'call_to_action' => [
                    'type' => 'LEARN_MORE'
                ],
                'link' => $link,
                'name' => $name_ad,
                'message' => $body_ad
            ),
            'instagram_actor_id' => $actor_id,
            'page_id' => $page_id
        ),
        'access_token' => $token,
    );

    $curl->setDefaultJsonDecoder($assoc = true);
    $curl->setHeader('Content-Type', 'application/json');
    $curl->post('https://graph.facebook.com/v7.0/'.$id.'/adcreatives', $data);

    $result = $curl->response;

    if (isset($result['error']['message'])){ // Проверяем есть ли ошибка
        return "<font color='red'>Ошибка создания AdCreative: </font>" . $result['error']['message']  . '<br>' . $result['error']['error_user_msg'];
//        echo "<font color='red'>Ошибка создания Креатива! </font>";
//        echo $result['error']['message'].'<br>';
//        echo $result['error']['error_user_title'].'<br>';
//        echo $result['error']['error_user_msg']; // Сообщение с ошибкой

    } elseif ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $adCreative_id = $response; //['id']; // получаем баланс
        return $adCreative_id; // Получаем ID созданного Креатива
    }
}

//$curl = new Curl();
//$id = 'act_253639299147852'; // ID рекламного акка
//$page_id = '104157224703381';
//$image_hash = 'e7a0056295c4df776ce8ef68b8bb9afa';
//$name_ad = 'Телепузик';
//$body_ad = 'Текст текст текст';
//$actor_id = '4004638236278100';
//$link = 'https://chance2.ru/catalog/nashi-kotyata';
//$token = 'EAABsbCS1iHgBABQcahdC3cJ4KeUZBr9qjUooLkFzyDFjZBTjcHIstDPh7WxG9VcDnnZBx90xBv1ZCdKT5TcPb9jTKDqJuCqfEXbaSwesgCIUZCcx20sjPbRHWbhv50gfYBameSUzlzeZBnqhH4MuMNHs0imGYRhKaPP9zZCHHXpXQZDZD';
//
//$creo = createAdCreativeImages($id,$image_hash,$page_id, $name_ad, $body_ad, $link, $actor_id, $token, $curl);
//
//var_dump($creo);
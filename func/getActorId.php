<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 25.06.2020
 * Time: 08:11
 */

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;
$curl = new Curl();

/**
 * Получаем ID для рекламы в Instagram от имени ФП
 * @param $curl - CURL класс
 * @param $proxy - данные с прокси
 * @param $token - Токен Ads Manager
 * @return $user_id - Возвращает ID юзера
 */

function getActorId($curl, $proxy,$page_id, $token){

    /**
     * Прокси
     */

    $row = explode(':', $proxy);

    $ip = $row[0]; // ip
    $port = $row[1]; // port
    $login = $row[2]; //login
    $pass = $row[3]; //pass


    $curl->setProxy($ip, $port, $login, $pass);
    $curl->setProxyTunnel();

    /**
     * Получаем ID для рекламы в Instagram от имени ФП
     */

    $curl->post('https://graph.facebook.com/v7.0/' . $page_id . '/page_backed_instagram_accounts', array(
        'access_token' => $token,
    ));

    $result = $curl->response;
    if (isset($result->error->message)) { // Проверяем есть ли ошибка
       return "<font color='red'>Ошибка ID для продвижения в инстаграмм instagram_actor_id: </font> " . $result->error->message;
//        echo $result->error->message . '<br>'
//        echo $result->error->error_user_title . '<br>';
//        echo $result->error->error_user_msg; // Сообщение с ошибкой

    } elseif ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $actorId = $response['id']; // id для продвижения в инстаграмм instagram_actor_id

        return $actorId;
    }
}

//$proxy = '37.77.133.142:8062:arbteam:roipizdec';
//$page_id = '104157224703381';
//$token = 'EAABsbCS1iHgBABkOkZBnMclSsPwJzj2RdQccZAjBnGoZApDvQKAPfsLCC8btAllkLpcAQHDlJKZBXDZAQbHk30sZBx7HnYLO4HpQBUZBOh492PNe70zyZAq4H75kGN1Slm7eWfaVfzxZBWrwut6B6CHEOy6GTMfnoeb9L1SbUhzBWngZDZD';
//
//echo getActorId($curl, $proxy, $page_id, $token);
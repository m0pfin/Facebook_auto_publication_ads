<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 03.07.2020
 * Time: 04:07
 */


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;
$curl = new Curl();

/**
 * Получаем инфу соц аккаунта
 * @param $curl - CURL класс
 * @param $proxy - данные с прокси
 * @param $token - Токен Ads Manager
 * @return $user_id - Возвращает ID юзера
 */

function getStatusToken($curl, $proxy, $token){

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
     * Получаем User ID
     */

    $curl->get('https://graph.facebook.com/v5.0/me?fields=id,name', array(
        'access_token' => $token,
    ));

    $result = $curl->response;

    if (isset($result->error->message)) { // Проверяем есть ли ошибка
        echo "<font color='red'>Ошибка аккаунта: </font> ";
        return $result->error->message . '<br>';

    }
    elseif ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        //  var_dump($curl->response);
        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $user_info = $response['id']; // id соц.акка
        return $user_info;
    }
}

//$proxy = '37.77.133.142:8062:arbteam:roipizdec';
//$token = 'EAABsbCS1iHgBANhx0skQBYfE45sOXEhfvdB7UaFwQ9eW61ruZAxW444GZAW71JMzxgE2SB2qf5xVCk9fIH5zpNqjFdKKGd2ZC10kefpfp9g2YBPRdUsRp4tcLXBqXbvA5LG9d9RSTlPzJQcZCIiGCMUyiiVbHvfpOmisNmxwEgZDZD';

//$getStatusToken = getStatusToken($curl, $proxy, $token);
//echo $getStatusToken;
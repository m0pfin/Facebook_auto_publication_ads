<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 19.06.2020
 * Time: 20:56
 */

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;
$curl = new Curl();

/**
 * Получаем ID соц аккаунта
 * @param $curl - CURL класс
 * @param $proxy - данные с прокси
 * @param $token - Токен Ads Manager
 * @return $user_id - Возвращает ID юзера
 */

function getIdUser($curl, $proxy, $token){

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

    $curl->get('https://graph.facebook.com/v5.0/me?fields=id', array(
        'access_token' => $token,
    ));

    if ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        //  var_dump($curl->response);
        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $user_id = $response['id']; // id соц.акка
        return $user_id;
    }
}

/**
 * Получаем список Фан пейдж
 * @param $curl
 * @param $proxy
 * @param $token
 * @return mixed
 * @throws ErrorException
 */
function getPages ($curl,$user_id, $proxy, $token)
{
    /**
     * Прокси
     */

    $row = explode(':', $proxy);

    $ip = $row[0]; // ip
    $port = $row[1]; // port
    $login = $row[2]; //login
    $pass = $row[3]; //pass


    /**
     * Получаем список всех рекламных акков🧔
     */

    $curl = new Curl();


// Прокси

    $curl->setProxy($ip, $port, $login, $pass);
    $curl->setProxyTunnel();

    $curl->get('https://graph.facebook.com/v7.0/' . $user_id . '/accounts?fields=name', array(
        'access_token' => $token,
    ));

    $result = $curl->response;

    if (isset($result->error->message)) { // Проверяем есть ли ошибка
        return "<font color='red'>Ошибка получения страницы: </font>" . $result->error->message;

    }
    elseif ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    }else {

        $response = json_decode(json_encode($curl->response), true); // преобразование строки в формате json в ассоциативный массив
        $idPage = $response['data']; //[0]['id']; // id фанпейджа
        return $idPage;
    }
}

//$proxy = '37.77.133.142:8071:arbteam:roipizdec';
//$token = 'EAABsbCS1iHgBAD5JzISRAYoCmTDb4tc1ZBAKGLN5yyGUldFwcnZBQLbZCDd9ZC0lvP7532bifIUQRXbzTgI9vbae81ikJcwwnMhHzStZBEefb8SZBeVj52Li5OeIyfsNiZBl7YrSCSURMtHXgdnkOPMNR91Am5jfhA6ynucg5PHEQZDZD';

//$token = $_POST['token']; // Token
//$proxy = $_POST['proxy']; // Proxy
//
//$user_id = getIdUser($curl, $proxy, $token);
//$idPage = getPages($curl, $user_id, $proxy, $token);
//
//
//echo '<label>Страница</label><select class="custom-select" name="page_id">';
//foreach ($idPage as $idPages){
//    echo "<option value='".$idPages['id']."'>".$idPages['name']."  (".$idPages['id'].") </option>" ;
//}
//echo '</select>';
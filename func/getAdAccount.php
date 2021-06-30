<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 24.06.2020
 * Time: 05:57
 */

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;
$curl = new Curl();


/**
 * Функция получения ID личного рекламного акка
 * @param $curl - CURL класс
 * @param $proxy - Прокси IP:PORT:LOGIN:PASS
 * @param $token - AdsManager
 * @return mixed - ID AdAccount User
 * @throws ErrorException
 */
function getAdAccountUser($curl, $proxy, $token){

    /**
     * Прокси
     */

    $row = explode(':', $proxy);

    $ip = $row[0]; // ip
    $port = $row[1]; // port
    $login = $row[2]; //login
    $pass = $row[3]; //pass


    /**
     * Получаем USER_ID🧔
     */

    $curl = new Curl();


// Прокси

    $curl->setProxy($ip, $port, $login, $pass);
    $curl->setProxyTunnel();

    $curl->get('https://graph.facebook.com/v7.0/me/adaccounts?fields=amount_spent,name,business_name', array(
        'access_token' => $token,
    ));

    $result = $curl->response;
    if(isset($result->error->message)) { // Проверяем есть ли ошибка
        echo "<font color='red'>Ошибка: </font> ";
        echo $result->error->message . '<br>';
    }
    elseif ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    }else {
        //var_dump($result);
        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $adAccountUserId = $response['data'][0]['account_id']; // id соц.акка
        return $adAccountUserId;
    }

}


/**
 *  Получаем список всех рекламных аккаунтов в соце
 * @param $curl - CURL класс
 * @param $proxy - Прокси
 * @param $token - Ads Manager
 * @return mixed - Возвращает массив с акками
 * @throws ErrorException
 */
function getAllAdAccounts ($curl, $proxy, $token){
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


    $curl->get('https://graph.facebook.com/v7.0/me/adaccounts?fields=business,name', array(
        'access_token' => $token,
    ));

    $result = $curl->response;

    if(isset($result->error->message)){ // Проверяем есть ли ошибка
        echo "<font color='red'>Ошибка: </font> ";
        echo $result->error->message . '<br>';
    }
    elseif ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    }else {

//        var_dump($curl->response);
        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $getAllAdAccounts = $response['data']; // id соц.акка
        return $getAllAdAccounts;
    }
}

//$proxy = '37.77.133.142:8071:arbteam:roipizdec';
//$token = 'EAABsbCS1iHgBAGZCkdsRCZAA6lPkdBsDu12z21fMcOxf8HtBM5IMJKE7VZCWLF1M1h9rNV1Ki2XOOSkZCQMjuFzL1fjGn5JX0BTjG3KU10b4iWhi1Omv6ctRivM7IbSXEk7igX6ssteTUO98ZBXpssZAHoyFHELcNis6ygLStNkAZDZD';




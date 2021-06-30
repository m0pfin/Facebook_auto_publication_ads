<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 04.07.2020
 * Time: 09:51
 */


require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;
$curl = new Curl();


/**
 * @param $curl
 * @param $adaccount_id - ID рекламного аккаунта
 * @param $proxy - Прокси
 * @param $token - Токен ADS
 * @return mixed
 * @throws ErrorException
 */
function getPixel($curl, $adaccount_id, $proxy, $token)
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
     * Получаем список всех  рекламных акков🧔
     */

    $curl = new Curl();


// Прокси

    $curl->setProxy($ip, $port, $login, $pass);
    $curl->setProxyTunnel();

    $curl->get('https://graph.facebook.com/v7.0/' . $adaccount_id . '/adspixels', array(
        'access_token' => $token,
    ));

    $result = $curl->response;

    if (isset($result->error->message)) { // Проверяем есть ли ошибка
        echo "<font color='red'>Ошибка получения ID пикселя: </font> ";
        echo $result->error->message . '<br>';

    } elseif ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {

        $response = json_decode(json_encode($curl->response), true); // преобразование строки в формате json в ассоциативный массив
        $idPixel = $response['data']; //[0]['id']; // id фанпейджа
        return $idPixel;
    }
}

//$proxy = '37.77.133.142:8071:arbteam:roipizdec';
//$token = 'EAABsbCS1iHgBAD5JzISRAYoCmTDb4tc1ZBAKGLN5yyGUldFwcnZBQLbZCDd9ZC0lvP7532bifIUQRXbzTgI9vbae81ikJcwwnMhHzStZBEefb8SZBeVj52Li5OeIyfsNiZBl7YrSCSURMtHXgdnkOPMNR91Am5jfhA6ynucg5PHEQZDZD';

//$token = $_POST['token']; // Token
//$proxy = $_POST['proxy']; // Proxy
//$adaccount_id = $_POST['proxy']; // ID рекламного аккаунта
//
//$idPixel = getPixel($curl, $adaccount_id, $proxy, $token);
//
//echo '<label>Пиксель</label><select class="custom-select" name="pixel">';
//if (isset($idPixel['id'])){
//    foreach ($idPixel as $idPixels){
//        echo "<option value='" . $idPixels['id'] . "'>" . $idPixels['id'] . "</option>";
//    }
//}else {
//    echo "<option value='error'>Пиксель не найден</option>";
//}
//echo '</select>';

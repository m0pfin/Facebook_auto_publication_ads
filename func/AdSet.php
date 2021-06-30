<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 11.06.2020
 * Time: 08:24
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;
$curl = new Curl();

/**
 * @param $id - рекламного акка
 * @param $campaign_id - id кампании
 * @param $token - из Ads Manager
 * @param $curl - класс php-curl
 */


function createAdSetConversion($id,$campaign_id, $name_adset, $daily_budget_adset, $start_time, $end_time, $bid_strategy, $billing_event, $optimization_goal, $targeting_geo_countries, $custom_event_type, $status_adset, $pixel_id, $age_min, $age_max, $gender, $device_platforms, $token, $curl) {

    $data = array(
        'name' => $name_adset,
        'daily_budget' => $daily_budget_adset,
        'start_time' => $start_time,
        'end_time' => $end_time,
        'bid_strategy' => $bid_strategy,
        'billing_event' => $billing_event,
        'optimization_goal' => $optimization_goal,
        'campaign_id' => $campaign_id,
        'targeting' => array(
            'geo_locations' => array(
                'countries' => array(
                    $targeting_geo_countries
                ),
            ),
            'age_min' => $age_min,
            'age_max' => $age_max,
            'genders' => array(
                $gender
            ),
//            'device_platforms' => array(
//                $device_platforms
//            ),
            'publisher_platforms' => array(
                'facebook',
                'instagram',
                'messenger',
                'audience_network'
            ),
        ),
        'promoted_object' => array(
            'custom_event_type' => $custom_event_type,
            'pixel_id' => $pixel_id
        ),
        'status' => $status_adset,
        'access_token' => $token,
    );

    $curl->setDefaultJsonDecoder($assoc = true);
    $curl->setHeader('Content-Type', 'application/json');
    $curl->post('https://graph.facebook.com/v7.0/'.$id.'/adsets', $data);


    //var_dump($curl->response);
    $result = $curl->response;

    if (isset($result['error']['message'])){ // Проверяем есть ли ошибка
        return "<font color='red'>Ошибка создания Адсета: </font> " . $result['error']['message'] . ' ' . $result['error']['error_user_msg']; //
    } elseif ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {

        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $adset_id = $response; //['id']; // получаем баланс
        return $adset_id; // Получаем ID созданного AdSet
    }
}

function createAdSetCliks($id,$campaign_id, $token, $curl) {

    $data = array(
        'name' => 'AdSet_ТЫБЛЯТЬ_ЗАРАБОТАЕШЬ',
        'daily_budget' => '50000',
        'start_time' => '2020-04-17T22:23:07-0700',
        'end_time' => '0',
        'bid_strategy' => 'LOWEST_COST_WITHOUT_CAP',
        'billing_event' => 'IMPRESSIONS',
        'optimization_goal' => 'LINK_CLICKS',
        'campaign_id' => $campaign_id,
        'targeting' => array(
            'geo_locations' => array(
                'countries' => array(
                    'FR'
                ),
            ),
        ),
        'promoted_object' => array(
            'custom_event_type' => 'LEAD',
            'pixel_id' => '2656807074586628'
        ),
        'status' => 'PAUSED',
        'access_token' => $token,
    );

    $curl->setDefaultJsonDecoder($assoc = true);
    $curl->setHeader('Content-Type', 'application/json');
    $curl->post('https://graph.facebook.com/v7.0/'.$id.'/adsets', $data);

    $result = $curl->response;
    if (isset($result->error->message)){ // Проверяем есть ли ошибка
        echo "<font color='red'>Ошибка создания адсета: </font> ";
        echo $result->error->message.'<br>';
        echo $result->error->error_user_title.'<br>';
        echo $result->error->error_user_msg; // Сообщение с ошибкой
    } elseif ($curl->error) {
        echo 'Error: '
            . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {

        //var_dump($curl->response);
        $response = json_decode(json_encode($curl->response),true); // преобразование строки в формате json в ассоциативный массив
        $adset_id = $response['id']; // получаем баланс
        return $adset_id; // Получаем ID созданного адсета
    }
}
//
//$id = 'act_253639299147852'; // ID рекламного акка
//$campaign_id = '23845623583330302';
//$pixel_id = '1559128680926125';
//$token = 'EAABsbCS1iHgBABrimkjhev2ThfwKTXFJZCaL6yYK04guLm0YaePoYL8ODFifEZAzSn1cvpzsO9ZAXnP7exBZBKWgMUbdT2RthifHk51X79mEWQi5ZCDzD5MCFyCp7BUAJsdt5VbUIvMiHxRx3EcPj9HqLfDvAaGSXNZB32TysfugZDZD';
//
//$name_adset = 'desktop_test';
//$daily_budget_adset = '50' * 100;
//$start_time = '2020-04-17T22:23:07+0300';
//$end_time = '0';
//$bid_strategy = 'LOWEST_COST_WITHOUT_CAP';
//$billing_event = 'IMPRESSIONS';
//$optimization_goal = 'OFFSITE_CONVERSIONS';
//$custom_event_type = 'LEAD';
//$targeting_geo_countries = 'FR';
////$publisher_platforms = 'facebook, instagram, messenger, audience_network';
//$device_platforms = '';
//$age_min = '24';
//$age_max = '34';
//$gender = '1';
//$status_adset = 'PAUSED';
//
//
//$adset =  createAdSetConversion($id,$campaign_id, $name_adset, $daily_budget_adset, $start_time, $end_time, $bid_strategy, $billing_event, $optimization_goal, $targeting_geo_countries, $custom_event_type, $status_adset, $pixel_id, $age_min, $age_max, $gender, $device_platforms, $token, $curl);
//var_dump($adset);
//
////echo $adset['id'];
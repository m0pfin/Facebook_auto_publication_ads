<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$start = microtime(true);

require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;
use \Curl\MultiCurl;

$multi_curl = new MultiCurl();

$tokens = [
    'EAABsbCS1iHgBAK8aDxL5HAes8tsCnRHYZAw4Qyt5LRptg6EQc7CKIXyOlZA7jSWrnsKHzcfYmHwjh3zQmnpEvmuk3y7voCDOltOrtyWEZBFSnwDciGKVuVZBsd71yZAAb0Djf1Gv4eSfAHTbGBq6nCpqR3WG4nisZB2kK3Kn8UNQZDZD',
    'EAABsbCS1iHgBAAqZAPFrjvAqClsdN4QW0Hi3XSAjqjZAiJPEp8oxWiKyIeyWBSlZBLiZBZA0MaSzBVRAO9O1ivmbovUocfocMIZBNUZCNwsZBDiE47HeNiXX1FNk6a8Oikh5hpjejUjThKI6762ZCHmMSWZATjCiZAQq6ZBejiRHubA8xQZDZD',
    'EAABsbCS1iHgBAJtIJfadTLYA9ExQZBRt2NbE9ZCerWp3eZCQ5TTVZABZBqapQKzb0xDz6DchtvfhZB0keB2PRHatjNFD7edaj5Q852rZAVlgCsdgM6MaEGHZAoxxctEFsZAr3V6zhD70GxrP9ZBeH8eNcxUg9jqlmchg5Dm7lv0oPKjM2LCZCZCCKfDi',
    'EAABsbCS1iHgBAKh6POZAsmjbOcdEaxWeu2Ksy7zifeBtxQgvxsZCFZCKSnyJ3h7IS2bbtBXkianjhvZBiOXMb8Uzs44PynKMmZBUL88iyStTlWGWhm8Vj7RBOjBPujdKFLfAI2gaIF95mJSbGD0X9c8R2Nz0wECRflpKsvgR3wAZDZD',
];

$count = count($tokens) - 1;

for($i = 0; $i <= $count; $i++){

    //37.77.133.142	8062	arbteam	roipizdec

    $multi_curl->setProxy('37.77.133.142', '8062', 'arbteam', 'roipizdec');
    $multi_curl->setProxyTunnel();

    $name = 'curl_'.$i;
    $$name=$i;


    $multi_curl->addGet('https://graph.facebook.com/v7.0/me?fields=id,name', array(
        'access_token' => $tokens[''.$i.''],
    ));
}


$multi_curl->success(function($instance) {
    $response = json_decode(json_encode($instance->response),true); // преобразование строки в формате json в ассоциативный массив

    if(isset($response['id'])){
        echo $user_info = $response['id'] . '<br>'; // id соц.акка
    }
    else{
        echo $instance->response->error->message;
    }


});

$multi_curl->error(function($instance) {
    echo 'error message: ' . $instance->response->error->message . "<br>";
});

$multi_curl->complete(function($instance) {
    echo 'Запрос выполнен' . "<br><br><br>";
});

$multi_curl->start();


$finish = microtime(true);

$delta = $finish - $start;

echo $delta . ' сек.';
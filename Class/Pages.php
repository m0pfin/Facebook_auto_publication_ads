<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 06.07.2020
 * Time: 12:33
 */

class Pages extends Database
{
    protected $curl;
    public $name;
    public $user_id;
    public $token;
    public $proxy;

    public function __construct(\Curl\Curl $curl) {
        $this->curl = $curl;
        parent::__construct();
    }

    public function createFanpage(){
        /**
         * Прокси
         */

        $row = explode(':', $this->proxy);

        $ip = $row[0]; // ip
        $port = $row[1]; // port
        $login = $row[2]; //login
        $pass = $row[3]; //pass

        // Прокси
        $this->curl->setProxy($ip, $port, $login, $pass);
        $this->curl->setProxyTunnel();

        /**
         * Тело запроса
         */

        $data = array(
            'oss_response_format' => 'true',
            'access_token' => $this->token,
            'oss_request_format' => 'true',
            'query_id' => '1505614726115470',
            'locale' => 'en_US',
            'strip_nulls' => 'true',
            'strip_defaults' => 'true',
            'query_params' => '{"input":{"name":"'.$this->name.'","category":"2201","client_mutation_id":"fa8bd181-fe2c-4699-b09d-6ad5b75d426d","actor_id":"'.$this->user_id.'}"}}'
        );

        /**
         * Создаём ФП
         */

        $this->curl->setDefaultJsonDecoder($assoc = true);
        $this->curl->setHeader('Content-Type', 'application/json');
        $this->curl->post('https://graph.facebook.com/graphql', $data);

        $result = $this->curl->response;

        if (isset($result['error']['message'])){ // Проверяем есть ли ошибка
            return "<font color='red'>Ошибка создания ФП!</font> " . $result['error']['message'].'<br>';
        }
        else{
            $response = json_decode(json_encode($this->curl->response),true); // преобразование строки в формате json в ассоциативный массив
            $page_id = $response['data']['page_create']['page']; //['id'];
            return (object)$page_id; // получаем ID ФП

        }
    }

}
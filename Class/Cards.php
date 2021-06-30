<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 06.07.2020
 * Time: 08:53
 */

require __DIR__ . '/../vendor/autoload.php';

class Cards extends Database
{
    public  $id; // ID в БД карты
    public $user_id; // ID соца
    public  $token; // Token
    public  $proxy; // Proxy
    public  $adAccId; // ID рекламного аккаунта

    public function __construct(\Curl\Curl $curl) {
        $this->curl = $curl;
        parent::__construct();
    }

    /** Получаем данные карты
     * @return object
     */
    public function getCardsDb()
    {
        $getCardsDb = $this->fetch("SELECT * FROM preset WHERE id='$this->id'");
        return (object)$getCardsDb;
    }

    public function addCardAdAccount (){

        $row = explode(':', $this->proxy);

        $ip = $row[0]; // ip
        $port = $row[1]; // port
        $login = $row[2]; //login
        $pass = $row[3]; //pass

        // Прокси
        $this->curl->setProxy($ip, $port, $login, $pass);
        $this->curl->setProxyTunnel();

        $this->curl->setDefaultJsonDecoder($assoc = true);

        $this->curl->setHeader('Authorization', 'OAuth ' . $this->token);
        $this->curl->setHeader('X-Fb-Connection-Type', 'wifi');
        $this->curl->setHeader('X-Fb-Sim-Hni', '25001');
        $this->curl->setHeader('Content-Type', 'application/x-www-form-urlencoded');
        $this->curl->setHeader('Content-Encoding', 'gzip, deflate');
        $this->curl->setHeader('User-Agent', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A356 Safari/604.1');


        $this->curl->post('https://graph.secure.facebook.com/ajax/payment/token_proxy.php?tpe=/'. $this->user_id .'/creditcards',  array(
            'make_ads_primaty_funding_source' => '1',
            'app_version' => '22916291',
            'payment_type' => 'ads_invoice',
            'locale' => 'ru_RU',
            'billing_address' => '{"country_code":"UA"}',
            'sdk' => 'ios',
            'sdk_version' => '3',
            'risk_features' => '{"CreditCardFormType":"mobile","MobilePlatform":"iOS"}',
            'pretty' => '0',
            'creditCardNumber' => $this->getCardsDb()->card,
            'expiry_year' => $this->getCardsDb()->year,
            'expiry_month' => $this->getCardsDb()->moth,
            'csc' => $this->getCardsDb()->cvv,
            'account_id' => $this->adAccId,
            'format' => 'json',
            'fb_api_req_friendly_name' => 'add_credit_card',
            'fb_api_caller_class' => 'com.facebook.payments.common.PaymentNetworkOperationHelper'
        ));
        $result = $this->curl->response;

        if (isset($result['error']['message'])){ // Проверяем есть ли ошибка
            return "<font color='red'>Ошибка привязки карты!</font> " . $result['error']['error_user_msg']; // Сообщение с ошибкой
        }
        else{
            //Получаем ID
            $response = json_decode(json_encode($this->curl->response),true); // преобразование строки в формате json в ассоциативный массив
            $res = $response['card_type'];
            return 'Карта привязана (ID): '.$res;
        }
    }
}
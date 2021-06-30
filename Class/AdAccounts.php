<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 05.07.2020
 * Time: 04:20
 */

require __DIR__ . '/../vendor/autoload.php';


class AdAccounts extends Database
{
    protected $curl;
    public $proxy; // Прокси
    public $token; // Token из ADS
    public $accountData; // Массив с данными аккаунта из API
    public $accounts_id; // ID в БД социального аккаунта
    public $adaccount_id; // ID в БД рекламного кабинета

    public function __construct(\Curl\Curl $curl) {
        $this->curl = $curl;
        parent::__construct();
    }

    /**
     * Получаем список всех рекламных аккаунтов соца по API
     * @return mixed
     */
    public function getAdAccounts (){

        /**
         * Прокси
         */

        $row = explode(':', $this->proxy);

        $ip = $row[0]; // ip
        $port = $row[1]; // port
        $login = $row[2]; //login
        $pass = $row[3]; //pass


        /**
         * Получаем список всех рекламных акков🧔
         */


        $this->curl->setProxy($ip, $port, $login, $pass);
        $this->curl->setProxyTunnel();

        $this->curl->get('https://graph.facebook.com/v11.0/me/adaccounts?fields=business_name,name,amount_spent,adspixels{id},account_status,disable_reason,adtrust_dsl,adspaymentcycle{threshold_amount}', array(
            'access_token' => $this->token,
        ));

        $result = $this->curl->response;

        if(isset($result->error->message)){ // Проверяем есть ли ошибка
            echo "<font color='red'>Ошибка: </font> ";
            echo $result->error->message . '<br>';
        }
        elseif ($this->curl->error) {
            echo 'Error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n";
        }else {
            $response = json_decode(json_encode($this->curl->response),true); // преобразование строки в формате json в ассоциативный массив
            return $response['data'];
        }
    }

    /**
     * Добавляем полученные данные в БД
     */
    public function addAdAccountDb (){
        // Записываем в БД рекламные аккаунты
        foreach ($this->accountData as $accountDatas){
            $name =             $accountDatas['name']; // Имя аккаунта
            $pixel_id =         ($accountDatas['adspixels']['data'][0]['id'] != 0) ? $accountDatas['adspixels']['data'][0]['id'] : '0'; // ID Pixel
            $adtrust_dsl =      $accountDatas['adtrust_dsl']; // Лимит дневной
            $billing =          $accountDatas['adspaymentcycle']['data'][0]['threshold_amount'] / 100; // Порог биллинга
            $amount =           $accountDatas['amount_spent'] / 100; // Потрачено всего
            $adaccount_id =     $accountDatas['id']; // act_8324999324
            $account_status =   $accountDatas['account_status']; // act_8324999324
            $disable_reason =   $accountDatas['disable_reason']; // act_8324999324


            $count = $this->countWhere('ad_account', 'adaccount_id', $adaccount_id);
            if ($count == 0){
                $this->execute("INSERT INTO `ad_account`(`accounts_id`, `name`, `pixel_id`, `adtrust_dsl`, `billing`, `amount`, `adaccount_id`, `account_status`, `disable_reason`) VALUES ('$this->accounts_id', '$name', '$pixel_id', '$adtrust_dsl', '$billing', '$amount', '$adaccount_id', '$account_status', '$disable_reason')");
            }
        }
    }

    public function updateAdAccountDb (){
        // Обновляем статусы рекламных кабинетов
    }

    /**
     * Достаём данные рекламного кабинета из бд
     * @return object
     */
    public function getAdAccountDb()
    {
        $getAdAccountDb = $this->fetch("SELECT * FROM ad_account WHERE id='" . $this->adaccount_id . "'");
        return (object)$getAdAccountDb;
    }
}



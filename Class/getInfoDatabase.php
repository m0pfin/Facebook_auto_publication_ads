<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 04.07.2020
 * Time: 12:44
 */


Class AccountInfo extends Database
{

    public $id;
    public $pages = 0;
    public $status = 0;
    public $user_id = 0;
    public $user_name = 0;
    protected $curl;

    public function __construct(\Curl\Curl $curl) {
        $this->curl = $curl;
        parent::__construct();
    }

    /**
     * Получаем все активные аккаунты из БД
     * @return object
     */
    public function getAccountAllActive()
    {
        $getAccountAll = $this->query("SELECT * FROM `accounts` WHERE status='0'  ORDER BY id DESC");
        return (object)$getAccountAll;
    }

    /**
     * Получаем все активные аккаунты из БД
     * @return object
     */
    public function getAccountAll()
    {
        $getAccountAll = $this->query("SELECT * FROM `accounts` WHERE `id` ORDER BY `id` DESC");
        return (object)$getAccountAll;
    }

    /**
     * Получаем всю инфу об аккаунте из БД
     * @return object
     */
    public function accountInformation()
    {
        $getInfo = $this->fetch("SELECT * FROM accounts WHERE id='" . $this->id . "'");
        return (object)$getInfo;
    }

    /**
     * Получаем прокси из БД закрепленные за аккаунтом
     * @return object
     */
    public function getProxy()
    {
        $getProxy = $this->fetch("SELECT * FROM proxy WHERE id='" . $this->accountInformation()->proxy_id . "'");
        return $getProxy['ip'] .':'.$getProxy['port'].':'.$getProxy['login'].':'.$getProxy['pass'];
    }

    /**
     * Достаём ФП из БД принадлежащие соц.акку
     * @return object
     */
    public function getPages()
    {
        $getProxy = $this->fetch("SELECT * FROM pages WHERE id='" . $this->id . "'");
        return (object)$getProxy;
    }

    /**
     * Обновляем статус соц.аккаунтов
     */
    public function updateAccountInfo (){
        $this->execute("UPDATE `accounts` SET `pages`='$this->pages',`status`='$this->status',`user_id`='$this->user_id',`user_name`='$this->user_name' WHERE id='$this->id'");
    }
}

//$accInfo = new AccountInfo();
//
//$accInfo->id = '10';
//
//echo $proxy = $accInfo->getProxy();
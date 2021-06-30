<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 04.07.2020
 * Time: 12:33
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// БД / Функции
include __DIR__ . '/../includes/db.php';
include __DIR__ . '/../includes/connect.php';
include __DIR__ . '/../includes/handler.php';
require __DIR__ . '/../vendor/autoload.php';

// Классы
include __DIR__ . '/../Class/getInfoDatabase.php';
include __DIR__ . '/../Class/AdAccounts.php';
include __DIR__ . '/../Class/Preset.php';
include __DIR__ . '/../Class/Cards.php';
include __DIR__ . '/../Class/Creative.php';
include __DIR__ . '/../Class/Pages.php';

// Функции
include __DIR__ . '/../func/getAdAccount.php';
include __DIR__ . '/../func/getPages.php';
include __DIR__ . '/../func/getPixel.php';
include __DIR__ . '/../func/getInfo.php';
include __DIR__ . '/../func/createPixel.php';
include __DIR__ . '/../func/getActorId.php';


// Залив
include __DIR__ . '/../func/Campaign.php';
include __DIR__ . '/../func/AdSet.php';
include __DIR__ . '/../func/AdCreative.php';
include __DIR__ . '/../func/Ads.php';
include __DIR__ . '/../func/uploadImages.php';
include __DIR__ . '/../func/uploadVideo.php';


use \Curl\Curl;
$curl = new Curl();

/**
 * Обновляем данные о рекламных аккаунтах
 */
if (isset($_GET['reload_ad'])){


    // Получаем все активные аккаунты и перебираем в цикле для добавления в БД рекламных акков
    $accInfo = new AccountInfo($curl);
    $getAccountAll = $accInfo->getAccountAllActive();

    foreach ($getAccountAll as $getAccountAlls){
        $token = $getAccountAlls['token']; // Токен Ads из БД

        // Объявляем класс AdAccounts для получения рекламных акков
        $AdAccounts = new AdAccounts($curl);
        $AdAccounts->token = $token; // Присваеваем токен
        $result = $AdAccounts->getAdAccounts(); // Результат запроса к API FB

        if (isset($result[0])){ // При наличии рекламного аккаунта добавляем в БД

             // Записываем в БД рекламные аккаунты
            $AdAccounts->accountData = $result; // Массив с данными рекламных кабинетов
            $AdAccounts->accounts_id = $getAccountAlls['id']; // ID соц.аккаунта из БД

            $AdAccounts->addAdAccountDb(); // Добавляем полученные данные и кабинеты которых нет в БД - `ad_account`
        }

    }
    header("Location: ../ad_account.php?status=reload");

}


/**
 * Обновляем данные о рекламных аккаунтах
 */
if (isset($_GET['createPixel'])){


    // Берем ID рекламного кабинета из БД
    $AdAccounts = new AdAccounts($curl);
    $accInfo = new AccountInfo($curl);

        $AdAccounts->adaccount_id = $_GET['createPixel'];
        $accInfo->id = $AdAccounts->getAdAccountDb()->accounts_id;
        $ad_id = $AdAccounts->getAdAccountDb()->adaccount_id;
        $token = $accInfo->accountInformation()->token; // Токен Ads из БД
        $proxy = $accInfo->getProxy();



    $pixel = createPixel ($ad_id, $curl, $proxy, $token);
        if (isset($pixel['id'])){ // При наличии рекламного аккаунта добавляем в БД
            header("Location: ../ad_account.php?status=createPixel_success");
        }else{
            header("Location: ../ad_account.php?status=createPixel_error&error=$pixel");
        }
}

/**
 * Обновляем данные о Соц.аккаунтах
 */
if (isset($_GET['reload_social'])){
    // Получаем все аккаунты из БД и перебираем в цикле для обновления статусов
    $accInfo = new AccountInfo($curl);
    $getAccountAll = $accInfo->getAccountAll();

    // В случае изменения обновляем данные
    foreach ($getAccountAll as $getAccountAlls){
        $accInfo = new AccountInfo($curl);
        $accInfo->id = $getAccountAlls['id'];
        $proxy = $accInfo->getProxy();
        $token = $getAccountAlls['token']; // Токен Ads из БД


        $getUserInfo = getUserInfo($curl, $proxy, $token); // Если ID соц.акка вернет ошибку - то значит токену пизда)
        $idPage = getPages($curl, $getUserInfo['id'], $proxy, $token); // Получаем ID - первой ФП (не стал пока делать получение всех ФП аккаунта)


        if (isset($getUserInfo['id'])){

            $accInfo->status = 0;
            $accInfo->user_id = $getUserInfo['id'];
            $accInfo->user_name = $getUserInfo['name'];
            $accInfo->pages = (isset($idPage[0]['id'])) ? $idPage[0]['id'] : '0';

            $accInfo->updateAccountInfo();
        }else{
            $accInfo->status = 1;
            $accInfo->updateAccountInfo();
        }
    }
    header("Location: ../accounts.php?status=reload");
}

/**
 * Создание ФП
 */
if(isset($_GET['createFanpage'])){
    $accInfo = new AccountInfo($curl);
    $Pages = new Pages($curl);

    $accInfo->id = $_GET['createFanpage'];
    $Pages->token = $accInfo->accountInformation()->token;
    $Pages->proxy = $accInfo->getProxy();
    $Pages->user_id = $accInfo->accountInformation()->user_id;

    $data_name = [
        "Chiffonic Store",
        "Origin Realty",
        "ShopSell",
        "Whellseten",
        "Navell",
        "Labrings",
        "Jumpa",
        "Watchfiree",
        "Pakatech",
        "Onesmarts",
        "Woldler",
        "Rockerfish",
        "Uitax",
        "Red Lines",
        "Nuvaels",
        "Wiresmith",
        "Jungate",
        "Cvick",
        "Right Of It",
        "Wurl"
    ];
    $rand_name = array_rand($data_name);
    $Pages->name = $data_name[$rand_name];


    $page_id = $Pages->createFanpage();
    if(isset($page_id->id)){
       header("Location: ../accounts.php?status=page_create_success");
    }
    else{
        header("Location: ../accounts.php?status=page_create_canceled");
    }

}

/**
 * Автозалив
 */

if(isset($_POST['adaccount_id'])){

// Принимаем $POST - данные из модального окна автозалива
$adaccount_id = $_POST['adaccount_id']; // ID рекламного аккаунта в БД
$preset_id = $_POST['preset']; // ID пресета в БД
$cards_id = $_POST['cards']; // ID карты  в БД
$link = $_POST['link']; // Ссылка для рекламы
$creative_id = $_POST['creative']; // ID креатива в БД

    /**
     * Получаем все необходимые данные перед заливом
     */

    // Объявляем класс AdAccounts для получения рекламных акков
    $accInfo = new AccountInfo($curl);
    $AdAccounts = new AdAccounts($curl);
    $Preset = new Preset();
    $Creative = new Creative();

    $AdAccounts->adaccount_id = $adaccount_id;
    $adAccountsData = $AdAccounts->getAdAccountDb(); // Получаем данные из БД по этому рекламному кабинету
    $accInfo->id = $adAccountsData->accounts_id; // Получаем ID соц акка из БД владеющий этим кабинетом
    $Preset->id = $preset_id; // Присваеваем ID для поиска данных о пресете в БД
    $Creative->id = $creative_id; // Присваеваем ID для поиска данных о креативе в БД

    $file_name = $Creative->getCreativeDb()->name;
    $file_url = __DIR__ . '/../creative/server/php/files/' . $file_name;
    $file_types = explode('.', $file_name); // узнаём тип файла
    $file_type = $file_types[1]; // расширение файла mp4 / jpeg / jpg / png

    $act_adaccount = $adAccountsData->adaccount_id;
    $pixel = $adAccountsData->pixel_id; // ID Pixel
    $page_id = $accInfo->accountInformation()->pages; // ID ФП
    $token = $accInfo->accountInformation()->token; // Токен ADS
    $proxy = $accInfo->getProxy(); // Получаем прокси

    // получаем ID для рекламы в Instagram
    $actor_id = getActorId($curl, $proxy, $page_id, $token);


    /**
     * Кампания
     */
    $name_campaign = $Preset->getPresetDb()->name_campaign;
    $status_campaign = status($Preset->getPresetDb()->status_campaign);
    $objective = objective($Preset->getPresetDb()->objective);


    /**
     * Адсет
     */
    $name_adset = $Preset->getPresetDb()->name_adset;
    $daily_budget_adset = $Preset->getPresetDb()->daily_budget_adset * 100;
    $start_time = $Preset->getPresetDb()->start_time;
    $end_time = $Preset->getPresetDb()->end_time;
    $bid_strategy = bid_strategy($Preset->getPresetDb()->bid_strategy);
    $billing_event = billing_event($Preset->getPresetDb()->billing_event);
    $optimization_goal = optimization_goal($Preset->getPresetDb()->optimization_goal);
    $custom_event_type = custom_event_type($Preset->getPresetDb()->custom_event_type);
    $targeting_geo_countries = $Preset->getPresetDb()->targeting_geo_countries;
    $publisher_platforms = $Preset->getPresetDb()->publisher_platforms;
    $device_platforms = device_platforms($Preset->getPresetDb()->device_platforms);
    $age_min = $Preset->getPresetDb()->age_min;
    $age_max = $Preset->getPresetDb()->age_max;
    $gender = $Preset->getPresetDb()->gender;
    $status_adset = status($Preset->getPresetDb()->status_adset);

    /**
     * Объявление
     */
    $name_ad = $Preset->getPresetDb()->name_ad;
    $body_ad = $Preset->getPresetDb()->body_ad;

    if ($file_type != 'mp4'){
        $image_hash = uploadImage($curl, $act_adaccount, $file_name, $file_url, $token);

        $campaign_id = createCampgain($act_adaccount, $name_campaign, $status_campaign, $objective,  $token, $curl);
    if(isset($campaign_id['id'])){
        $campaign_id = $campaign_id['id'];

        $adset_id = createAdSetConversion($act_adaccount,$campaign_id, $name_adset, $daily_budget_adset, $start_time, $end_time, $bid_strategy, $billing_event, $optimization_goal, $targeting_geo_countries, $custom_event_type, $status_adset, $pixel, $age_min, $age_max, $gender, $device_platforms, $token, $curl);
        if (isset($adset_id['id'])){
            $adset_id = $adset_id['id'];

                $creative_id = createAdCreativeImages($act_adaccount,$image_hash,$page_id, $name_ad, $body_ad, $link, $actor_id, $token, $curl);
            if(isset($creative_id['id'])){
                $creative_id = $creative_id['id'];

                $ads = createAd($act_adaccount, $adset_id, $name_ad, $creative_id, $token, $curl);
                if(isset($ads['id'])){
                    echo '<script type="text/javascript">toastr.success("Рекламная кампания создана - ' . $ads['id'] . '", "УВЕДОМЛЕНИЕ")</script>';
                }else{
                    echo '<script type="text/javascript">toastr.warning("Ошибка создания Объявления - ' . $ads . '", "УВЕДОМЛЕНИЕ")</script>';
                    exit;
                }
            }else{
                echo '<script type="text/javascript">toastr.warning("' . $creative_id . '", "УВЕДОМЛЕНИЕ")</script>';
                exit;
            }

        }else{
            echo '<script type="text/javascript">toastr.warning("Ошибка создания Адсета - ' . $adset_id . '", "УВЕДОМЛЕНИЕ")</script>';
            exit;
        }
    }else{
        echo '<script type="text/javascript">toastr.warning("Ошибка создания Кампании - ' . $campaign_id . '", "УВЕДОМЛЕНИЕ")</script>';
        exit;
        }
    } else{
        echo '<script type="text/javascript">toastr.warning("Видео-креатив пока не поддерживается...", "УВЕДОМЛЕНИЕ")</script>';
    }

//    echo 'Хэш крео: '.$image_hash . '<br>ID Кампании: ' . $campaign_id . '<br> ID Адсета: ' . $adset_id . '<br>ID креатива ' . $creative_id . '<br>ID объявления ' . $ads;

}

<?php

/**
 * Статус социального аккаунта
 * @param $status - статус соц.акка
 * @return string
 */
function statusSocial ($status){
    if ($status == 0){
        return '<span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">Активен</span>';
    }
    else{
        return '<span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">Ошибка токена</span>';
    }
}

/**
 * СТатус рекламного кабинета
 * @param $status
 * @return string
 */
function statusAdAccount($status){
    if ($status == 1){
        return '<span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">ACTIVE</span>';
    }
    elseif ($status == 2){
        return '<span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">DISABLED</span>';
    }elseif ($status == 3){
        return '<span class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">UNSETTLED</span>';
    }elseif ($status == 7){
        return '<span class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">PENDING_RISK_REVIEW</span>';
    }elseif ($status == 8){
        return '<span class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">PENDING_SETTLEMENT</span>';
    }elseif ($status == 9){
        return '<span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">IN_GRACE_PERIOD</span>';
    }elseif ($status == 100){
        return '<span class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">PENDING_CLOSURE</span>';
    }elseif ($status == 101){
        return '<span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">CLOSED</span>';
    }elseif ($status == 201){
        return '<span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">ANY_ACTIVE</span>';
    }elseif ($status == 202){
        return '<span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Обновляется раз в 5 минут">ANY_CLOSED</span>';
    }
}

function disable_reason($status){
    if ($status == 0){
        return '';
    }
    elseif ($status == 1){
        return '<span class="badge badge-danger">ADS_INTEGRITY_POLICY</span>';
    }elseif ($status == 2){
        return '<span class="badge badge-warning">ADS_IP_REVIEW</span>';
    }elseif ($status == 3){
        return '<span class="badge badge-warning">RISK_PAYMENT</span>';
    }elseif ($status == 4){
        return '<span class="badge badge-warning">GRAY_ACCOUNT_SHUT_DOWN</span>';
    }elseif ($status == 5){
        return '<span class="badge badge-info">ADS_AFC_REVIEW</span>';
    }elseif ($status == 6){
        return '<span class="badge badge-warning">BUSINESS_INTEGRITY_RAR</span>';
    }elseif ($status == 7){
        return '<span class="badge badge-danger">PERMANENT_CLOSE</span>';
    }elseif ($status == 8){
        return '<span class="badge badge-success">UNUSED_RESELLER_ACCOUNT</span>';
    }elseif ($status == 9){
        return '<span class="badge badge-danger">UNUSED_ACCOUNT</span>';
    }
}

function status_h ($status){
    if ($status == 0){
        echo 'Пауза';
    }
    else{
        echo 'Активно';
    }
}
/**
 * Стратегия запуска Конверсии/Клики/Установки
 * @param $objective - стратегия
 */
function objective_h ($objective){
    if ($objective == 0){
        echo 'Конверсии'; // Конверсии
    }
    else{
        echo '0';
    }
}

/**
 * Событие - Лид
 * @param $lead - значение
 */
function lead_h ($lead){
    if ($lead == 0){
        echo 'Лид'; // событие Лид
    }
    else{
        echo '0';
    }
}

/**
 * Призыв к действию
 * @param $callToAction
 */
function callToAction_h ($callToAction){
    if ($callToAction == 0){
        echo 'Подробнее'; // подробнее
    }
    else{
        echo '0';
    }
}

/**
 * Стратегия лидов / минимальная стоимость лида
 * @param $bid_strategy
 */
function bid_strategy_h ($bid_strategy){
    if ($bid_strategy == 0){
        echo 'Минимальная цена за лид'; // Минимальная цена за лид
    }
    else{
        echo '0';
    }
}

/**
 *
 * @param $billing_event
 */
function billing_event_h ($billing_event){
    if ($billing_event == 0){
        echo 'За показы'; // за показы
    }
    else{
        echo '0';
    }
}

/**
 * Оптимизация показа объявления
 * @param $optimization_goal
 */
function optimization_goal_h ($optimization_goal){
    if ($optimization_goal == 0){
        echo 'Конверсии'; // конверсии на сайте
    }
    else{
        echo '0';
    }
}


/**
 * Событие ЛИД / Установки
 * @param $custom_event_type
 */
function custom_event_type_h ($custom_event_type){
    if ($custom_event_type == 0){
        echo 'Лид'; // Событие ЛИД
    }
    else{
        echo '0';
    }
}

/**
 * Пол
 * @param $gender
 */
function gender_h ($gender){
    if ($gender == 0){
        echo '<span class="badge badge-danger"><i class="fas fa-venus-mars"></i></span>'; // Все
    }
    elseif ($gender == 1){
        echo '<span class="badge badge-primary"><i class="fas fa-mars"></i></span>'; // Мужчины
    }else{
        echo '<span class="badge badge-danger"><i class="fas fa-venus"></i></span>'; // Женщины
    }
}

/**
 * Таргетинг - платформа мобила/комп
 * @param $device_platforms
 */
function device_platforms_h ($device_platforms){
    if ($device_platforms == 0){
        echo '<i class="fas fa-desktop"></i> <i class="fas fa-mobile-alt"></i>'; // Все
    }
    elseif ($device_platforms == 1){
        echo '<i class="fas fa-mobile-alt"></i>'; // Мобайл
    }else{
        echo '<i class="fas fa-desktop"></i>'; // Десктоп
    }
}

function countrys ($country){
   $countr = array (
        'AU' => 'Австралия',
        'AT' => 'Австрия',
        'AZ' => 'Азербайджан',
        'AX' => 'Аландские о-ва',
        'AL' => 'Албания',
        'DZ' => 'Алжир',
        'AS' => 'Американское Самоа',
        'AI' => 'Ангилья',
        'AO' => 'Ангола',
        'AD' => 'Андорра',
        'AQ' => 'Антарктида',
        'AG' => 'Антигуа и Барбуда',
        'AR' => 'Аргентина',
        'AM' => 'Армения',
        'AW' => 'Аруба',
        'AF' => 'Афганистан',
        'BS' => 'Багамы',
        'BD' => 'Бангладеш',
        'BB' => 'Барбадос',
        'BH' => 'Бахрейн',
        'BY' => 'Беларусь',
        'BZ' => 'Белиз',
        'BE' => 'Бельгия',
        'BJ' => 'Бенин',
        'BM' => 'Бермудские о-ва',
        'BG' => 'Болгария',
        'BO' => 'Боливия',
        'BQ' => 'Бонэйр, Синт-Эстатиус и Саба',
        'BA' => 'Босния и Герцеговина',
        'BW' => 'Ботсвана',
        'BR' => 'Бразилия',
        'IO' => 'Британская территория в Индийском океане',
        'BN' => 'Бруней-Даруссалам',
        'BF' => 'Буркина-Фасо',
        'BI' => 'Бурунди',
        'BT' => 'Бутан',
        'VU' => 'Вануату',
        'VA' => 'Ватикан',
        'GB' => 'Великобритания',
        'HU' => 'Венгрия',
        'VE' => 'Венесуэла',
        'VG' => 'Виргинские о-ва (Великобритания)',
        'VI' => 'Виргинские о-ва (США)',
        'UM' => 'Внешние малые о-ва (США)',
        'TL' => 'Восточный Тимор',
        'VN' => 'Вьетнам',
        'GA' => 'Габон',
        'HT' => 'Гаити',
        'GY' => 'Гайана',
        'GM' => 'Гамбия',
        'GH' => 'Гана',
        'GP' => 'Гваделупа',
        'GT' => 'Гватемала',
        'GN' => 'Гвинея',
        'GW' => 'Гвинея-Бисау',
        'DE' => 'Германия',
        'GG' => 'Гернси',
        'GI' => 'Гибралтар',
        'HN' => 'Гондурас',
        'HK' => 'Гонконг (САР)',
        'GD' => 'Гренада',
        'GL' => 'Гренландия',
        'GR' => 'Греция',
        'GE' => 'Грузия',
        'GU' => 'Гуам',
        'DK' => 'Дания',
        'JE' => 'Джерси',
        'DJ' => 'Джибути',
        'DM' => 'Доминика',
        'DO' => 'Доминиканская Республика',
        'EG' => 'Египет',
        'ZM' => 'Замбия',
        'EH' => 'Западная Сахара',
        'ZW' => 'Зимбабве',
        'IL' => 'Израиль',
        'IN' => 'Индия',
        'ID' => 'Индонезия',
        'JO' => 'Иордания',
        'IQ' => 'Ирак',
        'IR' => 'Иран',
        'IE' => 'Ирландия',
        'IS' => 'Исландия',
        'ES' => 'Испания',
        'IT' => 'Италия',
        'YE' => 'Йемен',
        'CV' => 'Кабо-Верде',
        'KZ' => 'Казахстан',
        'KH' => 'Камбоджа',
        'CM' => 'Камерун',
        'CA' => 'Канада',
        'QA' => 'Катар',
        'KE' => 'Кения',
        'CY' => 'Кипр',
        'KG' => 'Киргизия',
        'KI' => 'Кирибати',
        'CN' => 'Китай',
        'KP' => 'КНДР',
        'CC' => 'Кокосовые о-ва',
        'CO' => 'Колумбия',
        'KM' => 'Коморы',
        'CG' => 'Конго - Браззавиль',
        'CD' => 'Конго - Киншаса',
        'CR' => 'Коста-Рика',
        'CI' => 'Кот-д’Ивуар',
        'CU' => 'Куба',
        'KW' => 'Кувейт',
        'CW' => 'Кюрасао',
        'LA' => 'Лаос',
        'LV' => 'Латвия',
        'LS' => 'Лесото',
        'LR' => 'Либерия',
        'LB' => 'Ливан',
        'LY' => 'Ливия',
        'LT' => 'Литва',
        'LI' => 'Лихтенштейн',
        'LU' => 'Люксембург',
        'MU' => 'Маврикий',
        'MR' => 'Мавритания',
        'MG' => 'Мадагаскар',
        'YT' => 'Майотта',
        'MO' => 'Макао (САР)',
        'MW' => 'Малави',
        'MY' => 'Малайзия',
        'ML' => 'Мали',
        'MV' => 'Мальдивы',
        'MT' => 'Мальта',
        'MA' => 'Марокко',
        'MQ' => 'Мартиника',
        'MH' => 'Маршалловы Острова',
        'MX' => 'Мексика',
        'MZ' => 'Мозамбик',
        'MD' => 'Молдова',
        'MC' => 'Монако',
        'MN' => 'Монголия',
        'MS' => 'Монтсеррат',
        'MM' => 'Мьянма (Бирма)',
        'NA' => 'Намибия',
        'NR' => 'Науру',
        'NP' => 'Непал',
        'NE' => 'Нигер',
        'NG' => 'Нигерия',
        'NL' => 'Нидерланды',
        'NI' => 'Никарагуа',
        'NU' => 'Ниуэ',
        'NZ' => 'Новая Зеландия',
        'NC' => 'Новая Каледония',
        'NO' => 'Норвегия',
        'BV' => 'о-в Буве',
        'IM' => 'о-в Мэн',
        'NF' => 'о-в Норфолк',
        'CX' => 'о-в Рождества',
        'SH' => 'о-в Св. Елены',
        'PN' => 'о-ва Питкэрн',
        'TC' => 'о-ва Тёркс и Кайкос',
        'HM' => 'о-ва Херд и Макдональд',
        'AE' => 'ОАЭ',
        'OM' => 'Оман',
        'KY' => 'Острова Кайман',
        'CK' => 'Острова Кука',
        'PK' => 'Пакистан',
        'PW' => 'Палау',
        'PS' => 'Палестинские территории',
        'PA' => 'Панама',
        'PG' => 'Папуа — Новая Гвинея',
        'PY' => 'Парагвай',
        'PE' => 'Перу',
        'PL' => 'Польша',
        'PT' => 'Португалия',
        'PR' => 'Пуэрто-Рико',
        'KR' => 'Республика Корея',
        'RE' => 'Реюньон',
        'RU' => 'Россия',
        'RW' => 'Руанда',
        'RO' => 'Румыния',
        'SV' => 'Сальвадор',
        'WS' => 'Самоа',
        'SM' => 'Сан-Марино',
        'ST' => 'Сан-Томе и Принсипи',
        'SA' => 'Саудовская Аравия',
        'MK' => 'Северная Македония',
        'MP' => 'Северные Марианские о-ва',
        'SC' => 'Сейшельские Острова',
        'BL' => 'Сен-Бартелеми',
        'MF' => 'Сен-Мартен',
        'PM' => 'Сен-Пьер и Микелон',
        'SN' => 'Сенегал',
        'VC' => 'Сент-Винсент и Гренадины',
        'KN' => 'Сент-Китс и Невис',
        'LC' => 'Сент-Люсия',
        'RS' => 'Сербия',
        'SG' => 'Сингапур',
        'SX' => 'Синт-Мартен',
        'SY' => 'Сирия',
        'SK' => 'Словакия',
        'SI' => 'Словения',
        'US' => 'Соединенные Штаты',
        'SB' => 'Соломоновы Острова',
        'SO' => 'Сомали',
        'SD' => 'Судан',
        'SR' => 'Суринам',
        'SL' => 'Сьерра-Леоне',
        'TJ' => 'Таджикистан',
        'TH' => 'Таиланд',
        'TW' => 'Тайвань',
        'TZ' => 'Танзания',
        'TG' => 'Того',
        'TK' => 'Токелау',
        'TO' => 'Тонга',
        'TT' => 'Тринидад и Тобаго',
        'TV' => 'Тувалу',
        'TN' => 'Тунис',
        'TM' => 'Туркменистан',
        'TR' => 'Турция',
        'UG' => 'Уганда',
        'UZ' => 'Узбекистан',
        'UA' => 'Украина',
        'WF' => 'Уоллис и Футуна',
        'UY' => 'Уругвай',
        'FO' => 'Фарерские о-ва',
        'FM' => 'Федеративные Штаты Микронезии',
        'FJ' => 'Фиджи',
        'PH' => 'Филиппины',
        'FI' => 'Финляндия',
        'FK' => 'Фолклендские о-ва',
        'FR' => 'Франция',
        'GF' => 'Французская Гвиана',
        'PF' => 'Французская Полинезия',
        'TF' => 'Французские Южные территории',
        'HR' => 'Хорватия',
        'CF' => 'Центрально-Африканская Республика',
        'TD' => 'Чад',
        'ME' => 'Черногория',
        'CZ' => 'Чехия',
        'CL' => 'Чили',
        'CH' => 'Швейцария',
        'SE' => 'Швеция',
        'SJ' => 'Шпицберген и Ян-Майен',
        'LK' => 'Шри-Ланка',
        'EC' => 'Эквадор',
        'GQ' => 'Экваториальная Гвинея',
        'ER' => 'Эритрея',
        'SZ' => 'Эсватини',
        'EE' => 'Эстония',
        'ET' => 'Эфиопия',
        'GS' => 'Южная Георгия и Южные Сандвичевы о-ва',
        'ZA' => 'Южно-Африканская Республика',
        'SS' => 'Южный Судан',
        'JM' => 'Ямайка',
        'JP' => 'Япония',
    );

       echo $countr[''.$country.''];

}

/**
 * Плейсмент - платформа
 * @param $device_platforms
 * @return string
 */
function publisher_platforms($publisher_platforms){
    if ($publisher_platforms == 0){
        return 'Авто плейсмент'; // Все
    }
    elseif ($publisher_platforms == 1){
        return 'mobile'; // Мобилки
    }else{
        return 'desktop'; // Компы
    }
}
//$device_platforms = 0;
//$device= device_platforms($device_platforms);
//
//echo 'ТЕКСТ '.$device;
?>
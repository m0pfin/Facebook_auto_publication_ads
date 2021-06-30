<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 24.06.2020
 * Time: 14:04
 */

/**
 * Статус запущенных кампаний
 * @param $status - статус кампании/адсета/объявления
 * @return string
 */
function status ($status){
    if ($status == 0){
        return 'PAUSED';
    }
    else{
        return 'ACTIVE';
    }
}
/**
 * Стратегия запуска Конверсии/Клики/Установки
 * @param $objective - стратегия
 * @return string
 */
function objective ($objective){
    if ($objective == 0){
        return 'CONVERSIONS'; // Конверсии
    }
    else{
        return '0';
    }
}

/**
 * Событие - Лид
 * @param $lead - значение
 * @return
 */
function lead ($lead){
    if ($lead == 0){
        return 'LEAD'; // событие Лид
    }
    else{
        return '0';
    }
}

/**
 * Призыв к действию
 * @param $callToAction
 * @return string
 */
function callToAction ($callToAction){
    if ($callToAction == 0){
        return 'LEARN_MORE'; // подробнее
    }
    else{
        return '0';
    }
}

/**
 * Стратегия лидов / минимальная стоимость лида
 * @param $bid_strategy
 * @return string
 */
function bid_strategy($bid_strategy){
    if ($bid_strategy == 0){
        return 'LOWEST_COST_WITHOUT_CAP'; // Минимальная цена за лид
    }
    else{
        return '0';
    }
}

/**
 *
 * @param $billing_event
 * @return string
 */
function billing_event($billing_event){
    if ($billing_event == 0){
        return 'IMPRESSIONS'; // за показы
    }
    else{
        return '0';
    }
}

/**
 * Оптимизация показа объявления
 * @param $optimization_goal
 * @return string
 */
function optimization_goal($optimization_goal){
    if ($optimization_goal == 0){
        return 'OFFSITE_CONVERSIONS'; // конверсии на сайте
    }
    else{
        return '0';
    }
}


/**
 * Событие ЛИД / Установки
 * @param $custom_event_type
 * @return string
 */
function custom_event_type($custom_event_type){
    if ($custom_event_type == 0){
        return 'LEAD'; // Событие ЛИД
    }
    else{
        return '0';
    }
}

/**
 * Пол
 * @param $gender
 * @return string
 */
function gender($gender){
    if ($gender == 0){
        return 'All'; // Все
    }
    elseif ($gender == 1){
        return 'Men'; // Мужчины
    }else{
        return 'Woman'; // Женщины
    }
}

/**
 * Таргетинг - платформа мобила/комп
 * @param $device_platforms
 * @return string
 */
function device_platforms($device_platforms){
    if ($device_platforms == 0){
        return 'All'; // Все
    }
    elseif ($device_platforms == 1){
        return 'mobile'; // Мобилки
    }else{
        return 'desktop'; // Компы
    }
}






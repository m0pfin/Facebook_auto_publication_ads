<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 13.06.2020
 * Time: 08:35
 */

$data = array(
    'name' => 'AdSet_HUY',
    'daily_budget' => '50000',
    'start_time' => '2020-04-17T22:23:07-0700',
    'end_time' => '0',
    'bid_strategy' => 'LOWEST_COST_WITHOUT_CAP',
    'billing_event' => 'IMPRESSIONS',
    'optimization_goal' => 'LINK_CLICKS',
    'campaign_id' => $campaign_id,
    'targeting' => array(
        'geo_locations' => array(
            'countries' => 'FR'
        ),
    ),
    'promoted_object ' => array(
        'custom_event_type' => 'LEAD',
        'pixel_id' => '2656807074586628'
    ),
    'status' => 'PAUSED',
    'access_token' => $token,
);

echo "<pre>";
var_dump($data);
echo "</pre>";
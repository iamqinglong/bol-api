<?php

/**
 * Plugin Name: BOL API
 */

$_SESSION['token'] = '';

function get_orders_handler()
{
  $_SESSION['token'] = retrieve_token();
  $orders =  get_orders();

  foreach ($orders as $order) {
    $time = time();
    $slug = "{$order->orderId}-{$time}";
    $inserted = wp_insert_post([
      'post_name' => $slug,
      'post_title' => $slug,
      'post_type' => 'test',
      'post_status' => 'publish'
    ]);


    if (is_wp_error($inserted)) {
      continue;
    }

    $fillables = [
      'field_60ba233acdb6e' => 'orderId',
      'field_60ba2344cdb6f' => 'orderPlacedDateTime',
    ];

    foreach ($fillables as $key => $name) {
      update_field($key, $order->$name, $inserted);
    }
  }
  return $orders;
}

function bol_orders()
{
  $_SESSION['token'] = retrieve_token();
  return get_orders();
}

function get_orders()
{
  if (!isset($_SESSION['token'])) {
    return [];
  }
  $curl = curl_init();
  $url = 'https://api.bol.com';
  $page = 1;
  $fulfilmentMethod = 'FBR';
  $status = 'ALL';
  curl_setopt_array($curl, array(
    CURLOPT_URL => "{$url}/retailer/orders?page={$page}&fulfilment-method={$fulfilmentMethod}&status={$status}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'Accept: application/vnd.retailer.v5+json',
      'Content-Type: application/vnd.retailer.v5+json',
      "Authorization: Bearer {$_SESSION['token']}"
    ),
  ));

  $response = curl_exec($curl);
  $result = json_decode($response);
  curl_close($curl);
  return $result->orders;
}

function retrieve_token()
{
  $curl = curl_init();
  $url = "https://login.bol.com/token?";
  $key = "ccd241b1-4d24-415e-a418-6b0331a8fe20";
  $secret = "AKnJaSA7tOuHdIR92_biy3porqnJCccn_AYZ9J7uhU84dhtjA85pF1BUnXp_KlW4ZRjwhKIEVLpc_S-AnVapjgk";
  curl_setopt_array($curl, array(
    CURLOPT_URL => "{$url}grant_type=client_credentials&client_id={$key}&client_secret={$secret}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
      'Cookie: JSESSIONID=9F8D6660FB60072445EC4AD7FCA10191.sso101'
    ),
  ));

  $response = curl_exec($curl);
  $result = json_decode($response);

  curl_close($curl);
  return $result->access_token;
}

add_action('wp_ajax_nopriv_get_orders_handler', 'get_orders_handler');
add_action('wp_ajax_get_orders_handler', 'get_orders_handler');

add_action('rest_api_init', function () {
  register_rest_route('bol/v1', 'orders', [
    'methods' => 'GET',
    'callback' => 'bol_orders'
  ]);
});

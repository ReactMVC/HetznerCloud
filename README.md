# HetznerCloud Api
 A PHP library for interacting with Hetzner Cloud API

## get from composer 
 ```
 composer require hetznercloud/api
 ```
 
 ## example
 ```php
 <?php

require_once 'vendor/autoload.php';

use HetznerCloud\Api;

$token = 'your_api_token_here';
$hc = new Api($token);


// create a new server
$data = [
    'name' => 'my-server',
    'server_type' => 'cx11',
    'image' => 'ubuntu-18.04',
    'location' => 'nbg1',
    'start_after_create' => true,
    'ssh_keys' => [
        1234,
        7456,
    ],
];
$response = $hc->createServer($data);
echo $response->getBody();


// delete an existing server
$id = 123456;
$response = $hc->deleteServer($id);
echo $response->getBody();


// get data for an existing server
$id = 123456;
$response = $hc->getServerData($id);
echo $response->getBody();


// edit an existing server
$id = 123456;
$data = [
    'name' => 'my-new-server-name',
];
$response = $hc->editServer($id, $data);
echo $response->getBody();


// update an existing server
$id = 123456;
$data = [
    'labels' => [
        'environment' => 'production',
    ],
];
$response = $hc->updateServer($id, $data);
echo $response->getBody();
 ```

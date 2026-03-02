<?php
/* Root */
define('ROOT', __DIR__);

/* Timezone */
date_default_timezone_set('Asia/Ho_Chi_Minh');

/* Cấu hình chung */
$config = array(
    'database' => array(
        'server-name' => $_SERVER["SERVER_NAME"],
        'url' => '/',
        'type' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'your_database_name', // Thay bằng tên database của bạn
        'port' => 3306,
        'prefix' => 'table_',
        'charset' => 'utf8'
    ),
    'website' => array(
        'secret' => '$tts@',
        'salt' => 'random_salt_string',
        'debug-developer' => false,
    ),
    /* Cấu hình API cho Tool Automation */
    'api' => array(
        'allowlist' => array(
            '127.0.0.1', 
            '::1'
            // Thêm IP máy tính chạy Tool của bạn vào đây
        ),
        'secret_key' => 'YOUR_SECRET_KEY_HERE' // Mã bí mật để kết nối API
    ),
    // ... Các cấu hình khác giữ nguyên cấu trúc nhưng để trống giá trị thật
);

/* Cấu hình base */
$http = 'http://';
$config_url = $config['database']['server-name'] . $config['database']['url'];
$config_base = $http . $config_url;
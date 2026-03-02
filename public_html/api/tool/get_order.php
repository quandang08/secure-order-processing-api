<?php
/**
 * API: Lấy đơn hàng xử lý tự động (get-order)
 */

header('Content-Type: application/json; charset=utf-8');

// Cấu hình đường dẫn
$lib_dir = dirname(__FILE__, 3) . '/libraries/';
if (!defined('LIBRARIES')) define('LIBRARIES', $lib_dir);

try {
    // Nạp Config
    if (!file_exists(LIBRARIES . 'config.php')) throw new Exception("Config missing");
    require_once LIBRARIES . 'config.php';

    // NẠP CLASS DATABASE THỦ CÔNG
    $db_file = LIBRARIES . "class/class.PDODb.php";
    if (file_exists($db_file)) {
        require_once $db_file;
    } else {
        throw new Exception("File class.PDODb.php không tồn tại tại: " . $db_file);
    }

    // Nạp autoload nếu cần
    if (file_exists(LIBRARIES . 'autoload.php')) require_once LIBRARIES . 'autoload.php';

    // Khởi tạo 
    if (!class_exists('PDODb')) throw new Exception("Class PDODb van khong tim thay!");
    $d = new PDODb($config['database']);

    // SECURITY CHECK
    $client_ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $headers = getallheaders();
    $api_key = $headers['X-API-KEY'] ?? $headers['x-api-key'] ?? '';

    if ($api_key !== $config['api']['secret_key'] || !in_array($client_ip, $config['api']['allowlist'])) {
        http_response_code(401);
        echo json_encode(["status" => "unauthorized"]);
        exit;
    }

    // ATOMIC LOCK (Tìm đơn hàng hợp lệ - Chống Race Condition)
    $sql_find = "SELECT id FROM table_order_automation 
                 WHERE status = 'pending' 
                 OR (status = 'processing' AND locked_at < NOW() - INTERVAL 30 MINUTE)
                 ORDER BY id ASC LIMIT 1";
    $row = $d->rawQueryOne($sql_find);

    if (!$row || !isset($row['id'])) {
        http_response_code(200);
        echo json_encode(["status" => "empty", "message" => "No jobs available"]);
        exit;
    }

    $order_id = $row['id'];

    // Khóa đơn hàng ngay lập tức để tránh bị lấy bởi các request khác
    $d->where('id', $order_id);
    if (!$d->update('order_automation', ['status' => 'processing', 'locked_at' => $d->now()])) {
        throw new Exception("Lock failed");
    }

    // LẤY DỮ LIỆU & GHI LOG
    $order = $d->rawQueryOne("SELECT * FROM table_order_automation WHERE id = ?", [$order_id]);

    // Ghi log (Dùng @ để nếu bảng log lỗi vẫn không làm hỏng JSON trả về)
    @$d->insert('api_logs', [
        'endpoint'     => 'get-order',
        'ip_address'   => $client_ip,
        'request_hash' => md5($order_id . time()),
        'order_id'     => $order_id,
        'status_code'  => 200,
        'created_at'   => $d->now()
    ]);

    // RESPONSE THÀNH CÔNG
    echo json_encode([
        "status" => "success",
        "data" => [
            "id"        => (int)$order_id,
            "account"   => $order['account'] ?? '',
            "password"  => $order['old_password'] ?? '',
            "twofa"     => $order['twofa_code'] ?? '',
            "email_new" => $order['new_email'] ?? ''
        ]
    ]);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage() 
    ]);
}
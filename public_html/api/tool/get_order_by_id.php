<?php
/**
 * API: Lấy thông tin chi tiết đơn hàng cho Robot
 */
header('Content-Type: application/json; charset=utf-8');

$lib_dir = dirname(__FILE__, 3) . '/libraries/';
if (!defined('LIBRARIES')) define('LIBRARIES', $lib_dir);

try {
    require_once LIBRARIES . 'config.php';
    require_once LIBRARIES . "class/class.PDODb.php";
    $d = new PDODb($config['database']);

    // Kiểm tra bảo mật (API KEY)
    $headers = getallheaders();
    $api_key = $headers['X-API-KEY'] ?? $headers['x-api-key'] ?? '';
    if ($api_key !== $config['api']['secret_key']) {
        throw new Exception("Unauthorized", 401);
    }

    // Nhận ID đơn hàng từ Robot
    $id = (int)($_GET['id'] ?? 0);
    if ($id <= 0) throw new Exception("ID đơn hàng không hợp lệ");

    // Truy vấn lấy thông tin acc/pass
    $order = $d->rawQueryOne("SELECT id, account, old_password AS password, twofa_code FROM table_order_automation WHERE id = ? LIMIT 1", [$id]);

    if ($order) {
        echo json_encode(["status" => "success", "data" => $order]);
    } else {
        throw new Exception("Không tìm thấy đơn hàng #".$id);
    }

} catch (Throwable $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
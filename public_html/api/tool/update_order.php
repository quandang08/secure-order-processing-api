<?php

/**
 * API: Cập nhật kết quả xử lý đơn hàng (update-order)
 */
header('Content-Type: application/json; charset=utf-8');

$lib_dir = dirname(__FILE__, 3) . '/libraries/';
if (!defined('LIBRARIES')) define('LIBRARIES', $lib_dir);

try {
    require_once LIBRARIES . 'config.php';
    require_once LIBRARIES . 'class/class.PDODb.php';

    $d = new PDODb($config['database']);

    // SECURITY CHECK (Dùng lại cấu hình từ file config)
    $headers = getallheaders();
    $api_key = $headers['X-API-KEY'] ?? $headers['x-api-key'] ?? '';
    if ($api_key !== $config['api']['secret_key']) {
        http_response_code(401);
        die(json_encode(["status" => "unauthorized"]));
    }

    // NHẬN DỮ LIỆU TỪ TOOL (Dạng JSON Body)
    $input = json_decode(file_get_contents('php://input'), true);
    $order_id = (int)($input['id'] ?? 0);
    $status = $input['status'] ?? ''; // 'completed' hoặc 'failed'
    $new_pass = $input['new_password'] ?? '';

    if ($order_id <= 0 || !in_array($status, ['completed', 'failed'])) {
        throw new Exception("Dữ liệu gửi về không hợp lệ");
    }

    // CẬP NHẬT DATABASE
    $d->where('id', $order_id);
    $d->where('status', 'processing');
    $updateData = [
        'status' => $status,
        'new_password' => $new_pass,
        'updated_at' => $d->now()
    ];

    $d->update('order_automation', $updateData);

    // KIỂM TRA: Nếu số dòng bị ảnh hưởng (count) > 0 thì mới là thành công thực sự
    if ($d -> getRowCount() > 0) {
        echo json_encode([
            "status" => "success",
            "message" => "Đơn hàng #$order_id đã được cập nhật thành $status"
        ]);
    } else {
        // Nếu count = 0, nghĩa là ID không tồn tại hoặc dữ liệu gửi lên y hệt dữ liệu cũ
        http_response_code(404);
        echo json_encode([
            "status" => "error",
            "message" => "Không tìm thấy đơn hàng #$order_id hoặc không có thay đổi nào"
        ]);
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

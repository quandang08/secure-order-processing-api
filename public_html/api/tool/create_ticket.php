<?php

/**
 * API: Khởi tạo Ticket khiếu nại (create-ticket)
 */

header('Content-Type: application/json; charset=utf-8');

$lib_dir = dirname(__FILE__, 3) . '/libraries/';
if (!defined('LIBRARIES')) define('LIBRARIES', $lib_dir);

try {
    if (!file_exists(LIBRARIES . 'config.php')) throw new Exception("Config missing");
    require_once LIBRARIES . 'config.php';
    require_once LIBRARIES . "class/class.PDODb.php";
    $d = new PDODb($config['database']);

    // Kiểm tra bảo mật (Security Check)
    $client_ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $headers = getallheaders();
    $api_key = $headers['X-API-KEY'] ?? $headers['x-api-key'] ?? '';

    if ($api_key !== $config['api']['secret_key'] || !in_array($client_ip, $config['api']['allowlist'])) {
        http_response_code(401);
        echo json_encode(["status" => "unauthorized"]);
        exit;
    }

    // Nhận dữ liệu từ Web Client
    $order_id = (int)($_POST['order_id'] ?? 0);
    $reason = trim($_POST['reason'] ?? 'Khiếu nại đơn hàng');

    if ($order_id <= 0) throw new Exception("Mã đơn hàng không hợp lệ");

    // Lấy thông tin Customer và Seller từ đơn hàng
    $order = $d->rawQueryOne("SELECT id, id_customer, id_seller FROM table_order_automation WHERE id = ? LIMIT 1", [$order_id]);

    if (!$order) throw new Exception("Không tìm thấy đơn hàng này");

    // Kiểm tra xem Ticket đã tồn tại chưa để tránh tạo trùng
    $check_ticket = $d->rawQueryOne("SELECT id FROM table_ticket WHERE order_id = ? AND status != 'closed'", [$order_id]);

    if ($check_ticket) {
        echo json_encode(["status" => "exists", "ticket_id" => $check_ticket['id']]);
        exit;
    }

    // Tạo Ticket mới
    $data_ticket = [
        'order_id' => $order_id,
        'id_customer' => $order['id_customer'],
        'id_seller' => $order['id_seller'],
        'status' => 'open',
        'created_at' => $d->now()
    ];
    $ticket_id = $d->insert('ticket', $data_ticket);

    if ($ticket_id) {
        // Gửi tin nhắn tự động đầu tiên (System Message)
        $d->insert('ticket_messages', [
            'id_ticket' => $ticket_id,
            'sender_id' => 0, // 0 đại diện cho Hệ thống/Robot
            'sender_role' => 'admin',
            'message' => "Hệ thống: Khiếu nại đã được mở với lý do: $reason. Vui lòng chờ Người bán phản hồi.",
            'created_at' => $d->now()
        ]);

        // --- Cổng chờ Webhook cho Robot ---
        $robot_webhook_url = "http://localhost:3000/trigger-robot"; // URL mà Robot của bạn đang lắng nghe

        $data_to_robot = [
            'action'    => 'check_order_complaint',
            'ticket_id' => $ticket_id,
            'order_id'  => $order_id,
            'reason'    => $reason
        ];

        // Sử dụng cURL để gọi Robot (Non-blocking hoặc timeout ngắn để không làm chậm trải nghiệm khách)
        $ch = curl_init($robot_webhook_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_to_robot));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2); // Chỉ chờ 2 giây rồi chạy tiếp
        curl_exec($ch);
        curl_close($ch);

        echo json_encode(["status" => "success", "ticket_id" => $ticket_id]);
    } else {
        throw new Exception("Không thể khởi tạo Ticket");
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

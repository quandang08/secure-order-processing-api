<?php
// Ghi nhật ký để kiểm tra Robot
file_put_contents('robot_debug.txt', "Time: ".date('H:i:s')."\nData: ".print_r($_POST, true)."\nFiles: ".print_r($_FILES, true)."\n\n", FILE_APPEND);

ob_start(); // Lớp 1: Mở "xô" hứng mọi dữ liệu in ra vô tội vạ
header('Content-Type: application/json; charset=utf-8');

try {
    require_once "../../libraries/config.php";
    require_once "../../libraries/class/class.PDODb.php";
    $d = new PDODb($config['database']);

    // Check API KEY
    $headers = getallheaders();
    $api_key = $headers['X-API-KEY'] ?? $headers['x-api-key'] ?? '';
    if ($api_key !== $config['api']['secret_key']) {
        throw new Exception("Unauthorized", 401);
    }

    $ticket_id   = (int)($_POST['ticket_id'] ?? 0);
    $sender_id   = (int)($_POST['sender_id'] ?? 0);
    $sender_role = $_POST['sender_role'] ?? ''; 
    $message     = trim($_POST['message'] ?? '');

    if ($ticket_id <= 0 || empty($message)) {
        throw new Exception("Data invalid", 400);
    }

    $photo_name = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../upload/ticket/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photo_name = "msg_" . time() . "_" . rand(1000, 9999) . "." . $ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir . $photo_name);
    }

    $data = [
        'id_ticket'   => $ticket_id,
        'sender_id'   => $sender_id,
        'sender_role' => $sender_role,
        'message'     => $message,
        'photo'       => $photo_name,
        'created_at'  => $d->now()
    ];

    // Lớp 2: Thực hiện insert nhưng không cho phép in kết quả ra màn hình
    $result = $d->insert('ticket_messages', $data);

    if ($result) {
        $d->where('id', $ticket_id)->update('ticket', ['last_message_at' => $d->now()]);
        
        // Lớp 3: Đổ sạch "rác" (số 1, khoảng trắng) trong xô đi trước khi in JSON thật
        ob_end_clean(); 
        echo json_encode(["status" => "success", "msg_id" => $result]);
        exit;
    } else {
        throw new Exception("Insert failed");
    }

} catch (Exception $e) {
    ob_end_clean(); // Xóa sạch rác nếu có lỗi xảy ra
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
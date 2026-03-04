<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../../libraries/config.php";
require_once "../../libraries/class/class.PDODb.php";
$d = new PDODb($config['database']);

// Kiểm tra Ticket ID
$ticket_id = (int)($_GET['ticket_id'] ?? 0);
if ($ticket_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Ticket ID missing"]);
    exit;
}

// Lấy danh sách tin nhắn
$messages = $d->rawQuery("SELECT sender_role, message, photo, created_at 
                          FROM table_ticket_messages 
                          WHERE id_ticket = ? 
                          ORDER BY id ASC", [$ticket_id]);

echo json_encode(["status" => "success", "data" => $messages]);
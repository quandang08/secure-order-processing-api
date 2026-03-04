<?php
if(!defined('SOURCES')) die("Error");

$act = (isset($_GET['act'])) ? htmlspecialchars($_GET['act']) : "";
$id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;

switch($act) {
    case "man":
        get_items();
        $template = "ticket/man/items";
        break;
    case "edit":
        get_item();
        $template = "ticket/man/item_add";
        break;
    case "save":
        save_item(); // Xử lý lưu tin nhắn Admin
        break;
    default:
        $template = "404";
}

function save_item() {
    global $d, $id, $func;

    if(isset($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);

        $data = array();
        $data['id_ticket'] = $id;
        $data['sender_id'] = 0; // 0 đại diện cho Admin/Hệ thống
        $data['sender_role'] = 'admin';
        $data['message'] = $message;
        $data['created_at'] = $d->now();

        if($d->insert('ticket_messages', $data)) {
            // Cập nhật thời gian hoạt động mới nhất cho Ticket
            $d->where('id', $id)->update('ticket', array('last_message_at' => $d->now()));
            $func->transfer("Gửi tin nhắn thành công", "index.php?com=ticket&act=edit&id=".$id);
        } else {
            $func->transfer("Gửi tin nhắn thất bại", "index.php?com=ticket&act=edit&id=".$id, false);
        }
    }
}

function get_items() {
    global $d, $items;
    $items = $d->rawQuery("SELECT * FROM table_ticket ORDER BY last_message_at DESC");
}

function get_item() {
    global $d, $item, $id, $messages;
    $item = $d->rawQueryOne("SELECT * FROM table_ticket WHERE id = ? LIMIT 0,1", array($id));
    $messages = $d->rawQuery("SELECT * FROM table_ticket_messages WHERE id_ticket = ? ORDER BY id ASC", array($id));
}
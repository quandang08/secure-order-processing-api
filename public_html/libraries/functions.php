<?php

/**
 * Hàm lấy tên người dùng từ ID Member
 */
function get_username($id)
{
    global $d;

    // Nếu ID là 0, đây là tin nhắn tự động từ hệ thống
    if ($id == 0) return '<span class="text-secondary">Hệ thống</span>';

    $row = $d->rawQueryOne("SELECT username FROM table_member WHERE id = ? LIMIT 0,1", array($id));

    return (isset($row['username']) && $row['username'] != '')
        ? $row['username']
        : '<span class="text-danger">Người dùng ẩn</span>';
}

<div class="card-body table-responsive p-0">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>Người bán</th>
                <th>Trạng thái</th>
                <th>Tin nhắn cuối</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $v) { ?>
                <tr>
                    <td>#<?= $v['order_id'] ?></td>
                    <td><span class="badge badge-info"><?= get_username($v['id_customer']) ?></span></td>
                    <td><span class="badge badge-warning"><?= get_username($v['id_seller']) ?></span></td>
                    <td><span class="badge badge-<?= ($v['status'] == 'open') ? 'success' : 'secondary' ?>"><?= $v['status'] ?></span></td>
                    <td><?= date('H:i d/m', strtotime($v['last_message_at'])) ?></td>
                    <td>
                        <a href="index.php?com=ticket&act=edit&id=<?= $v['id'] ?>" class="btn btn-sm btn-primary">Vào phòng chat</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
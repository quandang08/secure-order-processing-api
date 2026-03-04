<style>
    .chat-box {
        height: 400px;
        overflow-y: scroll;
        padding: 15px;
        background: #f4f6f9;
        border: 1px solid #ddd;
    }

    .direct-chat-msg {
        margin-bottom: 10px;
    }

    .msg-customer {
        text-align: left;
    }

    /* Khách bên trái */
    .msg-seller {
        text-align: right;
    }

    /* Người bán bên phải */
    .msg-admin {
        text-align: center;
        font-style: italic;
    }

    /* Hệ thống ở giữa */
    .msg-content {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 15px;
        max-width: 70%;
    }

    .bg-customer {
        background: #dcf8c6;
    }

    .bg-seller {
        background: #fff;
        border: 1px solid #ddd;
    }

    .msg-photo {
        max-width: 200px;
        display: block;
        margin-top: 5px;
        border-radius: 5px;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Phòng đối chất đơn hàng #<?= $item['order_id'] ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary direct-chat direct-chat-primary">
            <div class="card-header">
                <h3 class="card-title">Lịch sử trò chuyện</h3>
            </div>

            <div class="card-body">
                <div class="chat-box" id="chat-content">
                    <?php if (isset($messages) && count($messages) > 0) {
                        foreach ($messages as $msg) {
                            $role = $msg['sender_role']; // customer, seller, admin
                            $alignClass = "msg-" . $role;
                            $bgClass = "bg-" . $role;
                    ?>
                            <div class="direct-chat-msg <?= $alignClass ?>">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name"><?= get_username($msg['sender_id']) ?></span>
                                    <span class="direct-chat-timestamp float-right"><?= $msg['created_at'] ?></span>
                                </div>
                                <div class="msg-content <?= $bgClass ?>">
                                    <?= $msg['message'] ?>
                                    <?php if ($msg['photo']) { ?>
                                        <a href="../upload/ticket/<?= $msg['photo'] ?>" target="_blank">
                                            <img src="../upload/ticket/<?= $msg['photo'] ?>" class="msg-photo">
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <p class="text-center text-muted">Chưa có tin nhắn nào.</p>
                    <?php } ?>
                </div>
            </div>

            <div class="card-footer">
                <form action="index.php?com=ticket&act=save&id=<?= $item['id'] ?>" method="post">
                    <div class="input-group">
                        <input type="text" name="message" placeholder="Nhập lời nhắn của Admin..." class="form-control" required>
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
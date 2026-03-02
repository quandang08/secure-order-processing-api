<div class="boxfooter_container " id="background-footer">
    <div class="fixwidth">
        <div class="row">
            <div class="col-md-4">
                <div class="tit_ft"><?= $footer['ten' . $lang] ?></div>
                <div class="des_footer">
                    <?= htmlspecialchars_decode($footer['noidung' . $lang]) ?>
                </div>
                <div class="mt-3">
                    <?php foreach ($social1 as $v) { ?>
                        <a href="<?= $v['link'] ?>" class="ftmxh" target="_blank" title="<?= $v['ten' . $lang] ?>"><img
                                onerror="this.src='<?= THUMBS ?>/30x30x2/assets/images/noimage.png';"
                                src="<?= THUMBS ?>/0x30x2/<?= UPLOAD_PHOTO_L . $v['photo'] ?>"
                                alt="<?= $v['ten' . $lang] ?>" title="<?= $v['ten' . $lang] ?>" /></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="tit_ft">Lưu ý cần biết</div>
                        <div class="box_cs">
                            <?php foreach ($cs as $v) { ?>
                                <p>
                                    <a href="<?= $v['tenkhongdauvi'] ?>"><i class="fa fa-angle-double-right"
                                            aria-hidden="true"></i><?= $v['ten' . $lang] ?></a>
                                </p>
                            <?php } ?>
                            <p>
                                <a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Kiểm tra uy tín shop</a>
                            </p>
                            <p>
                                <a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Đăng ký bán tài khoản</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tit_ft">Hướng dẫn</div>
                        <div class="box_cs ">
                            <?php foreach ($cs as $v) { ?>
                                <p>
                                    <a href="<?= $v['tenkhongdauvi'] ?>"><i class="fa fa-angle-double-right"
                                            aria-hidden="true"></i><?= $v['ten' . $lang] ?></a>
                                </p>
                            <?php } ?>

                            <p>
                                <a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Hướng dẫn mua acc</a>
                            </p>
                            <p>
                                <a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Hướng dẫn bán acc</a>
                            </p>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tit_ft">Kết nối với admin</div>
                        <div class="social-icons mb-3">
                            <a href="#" class="social fb" aria-label="Facebook">
                                <svg viewBox="0 0 24 24">
                                    <path d="M22 12a10 10 0 1 0-11.5 9.9v-7H8v-3h2.5V9.5c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.4h-1.2c-1.2 0-1.6.8-1.6 1.6V12H16l-.4 3h-2.1v7A10 10 0 0 0 22 12Z" />
                                </svg>
                            </a>

                            <a href="#" class="social zalo" aria-label="Zalo">
                                <span>Z</span>
                            </a>

                            <a href="#" class="social discord" aria-label="Discord">
                                <svg viewBox="0 0 24 24">
                                    <path d="M20 4.5A17 17 0 0 0 15.5 3l-.3.6a16 16 0 0 1 4.2 2.1A15 15 0 0 0 5 5.7a16 16 0 0 1 4.2-2.1L8.9 3A17 17 0 0 0 4 4.5C1.7 8 1.3 11.4 1.5 14.8A17 17 0 0 0 6.7 18l.9-1.2a11 11 0 0 1-1.9-.9l.5-.4a12 12 0 0 0 10.6 0l.5.4a11 11 0 0 1-1.9.9l.9 1.2a17 17 0 0 0 5.2-3.2c.3-3.4-.1-6.8-2.5-10.3ZM8.5 13.5c-.7 0-1.3-.6-1.3-1.4s.6-1.4 1.3-1.4 1.3.6 1.3 1.4-.6 1.4-1.3 1.4Zm7 0c-.7 0-1.3-.6-1.3-1.4s.6-1.4 1.3-1.4 1.3.6 1.3 1.4-.6 1.4-1.3 1.4Z" />
                                </svg>
                            </a>

                            <a href="#" class="social telegram" aria-label="Telegram">
                                <svg viewBox="0 0 24 24">
                                    <path d="M9.9 15.6 9.6 20c.4 0 .6-.2.8-.4l2-1.9 4.1 3c.7.4 1.2.2 1.4-.6l2.6-12c.3-1-.4-1.4-1.1-1.1L2.6 9.8c-1 .4-1 1 0 1.3l4.4 1.4L17.7 6.6c.5-.3 1-.1.6.2" />
                                </svg>
                            </a>

                            <a href="#" class="social tiktok" aria-label="TikTok">
                                <svg viewBox="0 0 24 24">
                                    <path d="M21 8a6 6 0 0 1-4-1.6V15a5 5 0 1 1-5-5c.3 0 .7 0 1 .1v3a2 2 0 1 0 2 2V2h3a6 6 0 0 0 3 3Z" />
                                </svg>
                            </a>
                        </div>
                        <div class="cskh">
                            Zalo CSKH: <?= $optsetting['hotline'] ?>
                        </div>
                        <div class="cskh">
                            Tele CSKH: <?= $optsetting['zalo'] ?>
                        </div>
                        <div class="cskh">
                            Email: <?= $optsetting['email'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="boxfooter_bottom">
    <div class="fixwidth d-flex justify-content-between flex-wrap">
        <!-- <div>2025 @ All rights reserved. Design by sotagroup.vn</div> -->
        <div>Copyright © 2026. Design by <a href="https://sotagroup.vn/thiet-ke-website" title="Thiết Kế Web SOTA"
                style="color: #fff;">Thiết Kế Web SOTA</a></div>
        <div>Online: <?= $online ?> | Hôm nay: <?= $counter['today'] ?> | Tổng: <?= $counter['total'] ?></div>
    </div>
</div>
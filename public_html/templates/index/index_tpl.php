<!-- #INDEX  -->
<section class="section gioithieu pt-5 pb-5">
    <div class="fixwidth">
        <div class="row">
            <div class="col-md-12 gt_right">
                <div class="gt_title">
                    <?= $gioithieu['ten' . $lang] ?>
                </div>
                <div class="gt_noidung">
                    <?= html_entity_decode($gioithieu['mota' . $lang]) ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="timeline">
    <div class="fixwidth">
        <h2>Quy trình giao dịch an toàn</h2>
        <p class="timeline-sub">
            Escrow trung gian – Admin kiểm tra – Bảo hành – Giải ngân minh bạch
        </p>

        <div class="timeline-wrapper">

            <!-- Progress line -->
            <div class="timeline-line"></div>

            <!-- STEP 1 -->
            <div class="timeline-step">
                <div class="timeline-icon">
                    <!-- user-check -->
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4" />
                        <path d="M4 21c0-4 16-4 16 0" />
                        <path d="M17 11l2 2 4-4" />
                    </svg>
                </div>
                <h4>Người bán uy tín</h4>
                <p>Xác minh CCCD, tick xanh, lịch sử giao dịch</p>
            </div>

            <!-- STEP 2 -->
            <div class="timeline-step">
                <div class="timeline-icon">
                    <!-- shield -->
                    <svg viewBox="0 0 24 24">
                        <path d="M12 3l8 4v5c0 5-3.5 9-8 9s-8-4-8-9V7l8-4z" />
                        <path d="M9 12l2 2 4-4" />
                    </svg>
                </div>
                <h4>Escrow giữ tiền</h4>
                <p>Tiền ở trạng thái Đang giao dịch</p>
            </div>

            <!-- STEP 3 -->
            <div class="timeline-step">
                <div class="timeline-icon">
                    <!-- tools -->
                    <svg viewBox="0 0 24 24">
                        <path d="M14 7l3 3-8 8H6v-3z" />
                        <path d="M16 5l3 3" />
                    </svg>
                </div>
                <h4>Admin kiểm tra</h4>
                <p>Check acc, change info, ghi hình</p>
            </div>

            <!-- STEP 4 -->
            <div class="timeline-step">
                <div class="timeline-icon">
                    <!-- refresh-lock -->
                    <svg viewBox="0 0 24 24">
                        <path d="M3 12a9 9 0 0115-6" />
                        <path d="M21 12a9 9 0 01-15 6" />
                        <path d="M12 8v4l3 3" />
                    </svg>
                </div>
                <h4>Bảo hành</h4>
                <p>24h–7 ngày chống back acc</p>
            </div>

            <!-- STEP 5 -->
            <div class="timeline-step">
                <div class="timeline-icon">
                    <!-- chat -->
                    <svg viewBox="0 0 24 24">
                        <path d="M21 15a4 4 0 01-4 4H7l-4 4V5a4 4 0 014-4h10a4 4 0 014 4z" />
                    </svg>
                </div>
                <h4>Hỗ trợ 24/7</h4>
                <p>Ticket + chat 3 bên</p>
            </div>

        </div>
    </div>
</section>

<section class="wrap_product">
    <div class="wrap_product_index" style="padding-top: 30px;">
        <div class="fixwidth">
            <?php foreach ($danhmucnb_list as $key => $v) { ?>
                <h2 class="name_sp_1"><span><i class="far fa-shield-check mr-2"></i><?= $v['ten' . $lang] ?></span></h2>
                <div class="sp_cap1_all">
                    <div class="owl-carousel owl-theme auto_dcategory">
                        <?php $sanpham = $d->rawQuery("select ten$lang, tenkhongdauvi, mota$lang, ngaytao,photo, id,gia from #_product where id_list = ? and hienthi>0 and type='san-pham' order by stt,id desc", array($v['id'])); ?>
                        <?php foreach ($sanpham as $key1 => $value) { ?>
                            <div class="card">
                                <div class="thumb">
                                    <img src="<?= THUMBS ?>/400x300x1/<?= UPLOAD_PRODUCT_L . $value['photo'] ?>" alt="">
                                </div>
                                <div class="content">
                                    <div class="acc-badges">
                                        <span class="badge badge-verified">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M20 6L9 17l-5-5" />
                                            </svg>
                                            Đã kiểm duyệt
                                        </span>

                                        <span class="badge badge-warranty">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M12 3l8 4v5c0 5-3.5 9-8 9s-8-4-8-9V7l8-4z" />
                                                <path d="M9 12l2 2 4-4" />
                                            </svg>
                                            Có bảo hành
                                        </span>
                                    </div>
                                    <h3><?= $value['tenvi'] ?></h3>
                                    <p>Giá: 1.250.000đ</p>
                                    <div class="bottom">
                                        <button>Xem ngay</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="all-product">
                        <a href="<?= $v['tenkhongdauvi'] ?>">
                            Xem tất cả <?= $v['tenvi'] ?>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>


<section class="wrap_tintuc">
    <div class="wrap_product_index" style="padding-top: 30px;">
        <div class="fixwidth">
            <div class="news-header">
                <h2>Tin tức</h2>
                <span class="news-sub">Cập nhật game • Khuyến mãi • Thông báo shop</span>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="news-card">
                        <div class="news-thumb">
                            <span class="news-tag update">BLOG</span>
                        </div>
                        <div class="news-content">
                            <h3>Riot cập nhật rank mới mùa 2026</h3>
                            <p>
                                Hệ thống xếp hạng được điều chỉnh, acc rank cao sẽ tăng giá trong thời gian tới.
                            </p>

                            <div class="news-bottom">
                                <span class="news-date">02/02/2026</span>
                                <a href="#" class="news-link">Đọc thêm →</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="news-card">
                        <div class="news-thumb">
                            <span class="news-tag update">BLOG</span>
                        </div>
                        <div class="news-content">
                            <h3>Riot cập nhật rank mới mùa 2026</h3>
                            <p>
                                Hệ thống xếp hạng được điều chỉnh, acc rank cao sẽ tăng giá trong thời gian tới.
                            </p>

                            <div class="news-bottom">
                                <span class="news-date">02/02/2026</span>
                                <a href="#" class="news-link">Đọc thêm →</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="news-card">
                        <div class="news-thumb">
                            <span class="news-tag update">BLOG</span>
                        </div>
                        <div class="news-content">
                            <h3>Riot cập nhật rank mới mùa 2026</h3>
                            <p>
                                Hệ thống xếp hạng được điều chỉnh, acc rank cao sẽ tăng giá trong thời gian tới.
                            </p>

                            <div class="news-bottom">
                                <span class="news-date">02/02/2026</span>
                                <a href="#" class="news-link">Đọc thêm →</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="news-card">
                        <div class="news-thumb">
                            <span class="news-tag update">BLOG</span>
                        </div>
                        <div class="news-content">
                            <h3>Riot cập nhật rank mới mùa 2026</h3>
                            <p>
                                Hệ thống xếp hạng được điều chỉnh, acc rank cao sẽ tăng giá trong thời gian tới.
                            </p>

                            <div class="news-bottom">
                                <span class="news-date">02/02/2026</span>
                                <a href="#" class="news-link">Đọc thêm →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- <div class="wrap_bottom" id="background-tuvan">
    <div class="fixwidth">
        <div class="tit_dknt">
            <p>Đăng ký nhận tin</p>
            <span>Đăng ký thông tin để nhận được sự trợ giúp của chúng tôi</span>
        </div>
        <form class="form-contact frm_index validation-contact" novalidate method="post" action="" enctype="multipart/form-data" style="width: 100%;">
            <div class="row">
                <div class="input-contact col-sm-6">
                    <input type="text" class="form-control" id="ten" name="name-newsletter" placeholder="Họ tên" required />
                    <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
                </div>
                <div class="input-contact col-sm-6">
                    <input type="number" class="form-control" id="dienthoai" name="phone-newsletter" placeholder="Số điện thoại" required />
                    <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
                </div>
            </div>
            <div class="row">
                <div class="input-contact col-sm-6">
                    <input type="text" class="form-control" id="diachi" name="diachi-newsletter" placeholder="Địa chỉ" required />
                    <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
                </div>
                <div class="input-contact col-sm-6">
                    <input type="email" class="form-control" id="email" name="email-newsletter" placeholder="Email" required />
                    <div class="invalid-feedback">Vui lòng nhập địa chỉ email</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-contact">
                        <textarea class="form-control" id="noidung" name="noidung-newsletter" placeholder="Nội dung" required></textarea>
                        <div class="invalid-feedback">Vui lòng nhập nội dung</div>
                    </div>
                </div>
                <div class="col-md-4">
                     <input type="submit" class="btn btn-primary frm_index_btn" name="submit-newsletter" value="Gửi" disabled />
                </div>
            </div>
            <input type="hidden" name="recaptcha_response_newsletter" id="recaptchaResponseContact">
        </form>
    </div>
</div>
<div class="wrap_bottom" style="padding: 0;">
    <div>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="left_bottom">
                <div class="from_left_bottom">
                    <div class="title_bottom">THÔNG TIN ĐỐI TÁC</div>
                    <div class="slider slider-nav">
                        <?php foreach ($kh as $k => $v) { ?>
                            <div>
                                <div class="item_kh_img">
                                    <img onerror="this.src='<?= THUMBS ?>/195x195x1/assets/images/noimage.png';" src="<?= THUMBS ?>/195x195x1/<?= UPLOAD_NEWS_L . $v['photo'] ?>" alt="<?= $v['ten' . $lang] ?>">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="slider slider-for">
                        <?php foreach ($kh as $k => $v) { ?>
                            <div>
                                <div class="item_kh_info">
                                    <div class="mota_kh"><?= $v['mota' . $lang] ?></div>
                                    <i class="fas fa-quote-left"></i>
                                    <div class="name_kh"><?= $v['ten' . $lang] ?></div>
                                    <div class="diachi_kh"><?= $v['diachi'] ?></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="right_bottom">
                <div class="from_left_bottom" style="width: 90%;">
                    <div class="title_bottom">VIDEO GIỚI THIỆU</div>
                    <div class="owl-carousel owl-theme auto_video">
                        <?php foreach ($video as $k => $v) { ?>
                            <a data-fancybox="video" class="tailvideo_item_owl" data-src="<?= $v['video'] ?>" data-name="<?= $v['ten' . $lang] ?>" title="<?= $v['ten' . $lang] ?>" style="background:url(https://img.youtube.com/vi/<?= $func->getYoutube($v['video']) ?>/hqdefault.jpg) no-repeat center; background-size:cover;">
                            </a>
                        <?php } ?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
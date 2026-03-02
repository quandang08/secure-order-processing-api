<?php if (count($slider)) { ?>
    <div class="wrap_slider">
        <div class="fixwidth">
            <div class="row">
                <div class="col-md-8">
                    <div class="slideshow">
                        <p class="control-slideshow prev-slideshow transition"><i class="fas fa-chevron-left"></i></p>
                        <div id="slider" class="owl-carousel owl-theme owl-slideshow">
                            <?php foreach ($slider as $v) { ?>
                                <div class="item_slider">
                                    <a href="<?= $v['link'] ?>" target="_blank" title="<?= $v['ten' . $lang] ?>"><img
                                            onerror="this.src='<?= THUMBS ?>/910x380x2/assets/images/noimage.png';"
                                            src="<?= UPLOAD_PHOTO_L . $v['photo'] ?>" alt="<?= $v['ten' . $lang] ?>"
                                            title="<?= $v['ten' . $lang] ?>" /></a>
                                    <!-- <?php if ($v['ten' . $lang] != '') { ?>
                        <div class="slider_info1">
                            <h3 class="slider_info__name1"><?= $v['ten' . $lang] ?></h3>
                        </div>
                        <?php } ?> -->
                                    <?php /*<div class="slider_info">
                            <div class="slider_info--text">
                                <h3 class="slider_info__name"><?=$v['ten'.$lang]?></h3>
                    <p class="slider_info__desc"><?=$v['mota'.$lang]?></p>
                </div>
            </div>*/ ?>
                                </div>
                            <?php } ?>
                        </div>
                        <p class="control-slideshow next-slideshow transition"><i class="fas fa-chevron-right"></i></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bxh">
                        <div class="bxh-header">
                            <i class="fas fa-trophy-alt"></i>
                            <h3>Người bán uy tín</h3>
                        </div>
                        <section class="seller-section">
                            <div class="fixwidth">
                                <div class="seller-grid">
                                    <div class="seller-card">
                                        <img src="https://i.pravatar.cc/100?img=1" class="seller-avatar">
                                        <div class="seller-card-content">
                                            <h3>GameStoreVN <span class="verified">
                                                    ✓ 
                                                </span></h3>
                                            <p>1.245 giao dịch • 98.7% • 4.9★</p>
                                        </div>
                                    </div>
                                    <div class="seller-card">
                                        <img src="https://i.pravatar.cc/100?img=2" class="seller-avatar">
                                        <div class="seller-card-content">
                                            <h3>AccPro247 <span class="verified">
                                                    ✓
                                                </span></h3>
                                            <p>980 giao dịch • 98.7% • 4.9★</p>
                                        </div>
                                    </div>

                                    <div class="seller-card">
                                        <img src="https://i.pravatar.cc/100?img=3" class="seller-avatar">
                                        <div class="seller-card-content">
                                            <h3>VIPGameShop <span class="verified">
                                                    ✓
                                                </span></h3>
                                            <p>1.530 giao dịch • 98.7% • 4.9★</p>
                                        </div>
                                    </div>

                                    <div class="seller-card">
                                        <img src="https://i.pravatar.cc/100?img=4" class="seller-avatar">
                                        <div class="seller-card-content">
                                            <h3>TrustAcc <span class="verified">
                                                    ✓
                                                </span></h3>
                                            <p>760 giao dịch • 98.7% • 4.9★</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- <div id="slidertw" class="nivoSlider">
    <?php foreach ($slider as $v) { ?>
    <a target="_blank" title="<?= $v['ten' . $lang] ?>"><img
            onerror="this.src='<?= THUMBS ?>/1366x520x1/assets/images/noimage.png';"
            src="<?= UPLOAD_PHOTO_L . $v['photo'] ?>" alt="<?= $v['ten' . $lang] ?>" title="<?= $v['ten' . $lang] ?>"
            noidung="<?= $v['mota' . $lang] ?>" /></a>
    <?php } ?>
</div> -->
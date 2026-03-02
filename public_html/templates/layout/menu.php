<div class="header-cachtop">
    <div class="header-top">
        <div class="fixwidth d-flex justify-content-between align-self-center flex-wrap">
            <div class="menu_mobi align-self-center">
                <p class="icon_menu_mobi"><i class="fas fa-bars"></i></p>
                <a href="" class="home_mobi">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
            </div>
            <div class="header_left_mobile align-self-center">
                <a class="header_logo" href=""><img
                        onerror="this.src='assets/images/noimage.png';"
                        src="<?= UPLOAD_PHOTO_L . $logo['photo'] ?>" /></a>
            </div>
            <div class="menu_mobi_add">
                <div class="frm_timkiem">
                    <input type="text" class="input" id="keyword" placeholder="Tìm kiếm"
                        onkeypress="doEnter(event,'keyword');">
                    <button type="submit" class="nut_tim" onclick="onSearch('keyword');"><i
                            class="far fa-search"></i></button>
                </div>
            </div>
            <!-- <div class="menu_baophu"></div> -->
            <div class="menu_mobi align-self-center">
                <p class="icon_menu_mobi1 open_search"><i class="fas fa-search"></i></p>
                <p class="icon_menu_mobi1 close_search"><i class="fas fa-times"></i></p>
            </div>
            <div class="frm_timkiem frmtim1">
                <input type="text" class="input" id="keyword2345" placeholder="Tìm kiếm ..."
                    onkeypress="doEnter(event,'keyword2345');">
                <button type="submit" class="nut_tim" id="nut__tim" onclick="onSearch('keyword2345');"><i
                        class="far fa-search"></i></button>
            </div>
            <div class="diachi-top">
                <marquee behavior="" direction="">
                    <?= $optsetting['slogan'] ?>
                </marquee>
            </div>
            <div class="sub-menu">
                <ul>
                    <li><a href="">Chính sách</a></li>
                    <li><a href="">FAQ</a></li>
                    <li><a href="">Liên hệ</a></li>
                </ul>
            </div>
            <!-- <div class="mxh_1">
                <?php foreach ($social1 as $v) { ?>
                <a href="<?= $v['link'] ?>" class="ftmxh ml-1" target="_blank" title="<?= $v['ten' . $lang] ?>"><img
                        onerror="this.src='<?= THUMBS ?>/30x30x2/assets/images/noimage.png';"
                        src="<?= THUMBS ?>/0x30x2/<?= UPLOAD_PHOTO_L . $v['photo'] ?>" alt="<?= $v['ten' . $lang] ?>"
                        title="<?= $v['ten' . $lang] ?>" /></a>
                <?php } ?>
            </div> -->
            <select class="ngonngu2" name="ngonngu2" id="ngonngu2">
                <option value="vi" <?php if ($lang == 'vi') { ?> selected <?php  } ?> class="ngonngu_item2">VI</option>
                <option value="en" <?php if ($lang == 'en') { ?> selected <?php  } ?> class="ngonngu_item2">EN</option>
                <option value="china" <?php if ($lang == 'china') { ?> selected <?php  } ?> class="ngonngu_item2">CN
                </option>
            </select>
        </div>
    </div>
    <div class="header">
        <div class="fixwidth d-flex justify-content-between flex-wrap align-items-center">
            <div class="header_left align-self-center">
                <a class="header_logo" href=""><img
                        onerror="this.src='assets/images/noimage.png';"
                        src="<?= UPLOAD_PHOTO_L . $logo['photo'] ?>" /></a>
            </div>
            <!-- <div class="header_center">
                <img class="banner" onerror="this.src='assets/images/noimage.png';"
                    src="<?= UPLOAD_PHOTO_L . $banner['photo'] ?>" />
            </div> -->
            <div class="header_center">
                <div class="frm_timkiem">
                    <input type="text" class="input" id="keyword2" placeholder="Tìm kiếm sản phẩm..."
                        onkeypress="doEnter(event,'keyword2');">
                    <button type="submit" class="nut_tim" onclick="onSearch('keyword2');"><i
                            class="far fa-search"></i></button>
                </div>

            </div>
            <div class="header_right">
                <button class="cta-sell">
                    <span class="cta-icon">+</span>
                    Đăng tin bán acc ngay
                </button>
                <div class="naptien btn-icon">
                    <i class="far fa-bell"></i>
                </div>
                <div class="user">
                    <div class="user-icon btn-icon">
                        <i class="fal fa-user"></i>
                    </div>
                    <div class="user-txt">
                        <span>Tài khoản</span>
                        <span>100.000đ</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="header-height">
    <div id="menu_top">
        <div class="fixwidth clearfix">
            <div class="menu">
                <ul class="menu_cap_cha d-flex">
                    <li class="menulicha <?= $source == 'index' ? 'trangchu active' : '' ?>"><a href=""
                            title="TRANG CHỦ">TRANG CHỦ</a></li>
                    <li class="menulicha <?= $com == 'danh-muc-game' ? 'trangchu active' : '' ?>"><a href="danh-muc-game"
                            title="DANH MỤC GAME">DANH MỤC GAME</a></li>

                    <!-- <li class="menulicha <?= $com == 'san-pham' ? 'trangchu active' : '' ?>"><a href="san-pham"
                            title="SẢN PHẨM">SẢN PHẨM</a>
                        <?php if ($splistmenu) { ?>
                            <ul class="menu_cap_con">
                                <?php foreach ($splistmenu as $c => $cat) { ?>
                                    <li><a title="<?= $cat['ten' . $lang] ?>"
                                            href="<?= $cat[$sluglang] ?>"><?= $cat['ten' . $lang] ?></a>
                                        <?php
                                        $spcatmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, id,photo from #_product_cat where type = ? and id_list = ? and hienthi > 0 order by stt,id desc", array('san-pham', $cat['id']));
                                        if (count($spcatmenu) > 0) { ?>
                                            <ul class="menu_cap_2">
                                                <?php foreach ($spcatmenu as $c1 => $cat1) {
                                                    $spitemmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, id,photo from #_product_item where type = ? and id_cat = ? and hienthi > 0 order by stt,id desc", array('san-pham', $cat1['id']));
                                                ?>
                                                    <li><a title="<?= $cat1['ten' . $lang] ?>"
                                                            href="<?= $cat1[$sluglang] ?>"><?= $cat1['ten' . $lang] ?></a>
                                                        <?php if (count($spitemmenu) > 0) { ?>
                                                            <ul class="menu_cap_3">
                                                                <?php foreach ($spitemmenu as $c1 => $cat2) { ?>
                                                                    <li><a title="<?= $cat2['ten' . $lang] ?>"
                                                                            href="<?= $cat2[$sluglang] ?>"><?= $cat2['ten' . $lang] ?></a></li>
                                                                <?php } ?>
                                                            </ul>
                                                        <?php } ?>

                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li> -->
                    <li class="menulicha <?= $com == 'nap-tien' ? 'trangchu active' : '' ?>">
                        <a href="<?= $config_base ?>nap-tien" title="NẠP TIỀN">NẠP TIỀN</a>
                    </li>
                    <li class="menulicha <?= $com == 'lich-su' ? 'trangchu active' : '' ?>"><a href="<?= $config_base ?>lich-su"
                            title="LỊCH SỬ">LỊCH SỬ</a>

                    </li>
                    <li class="menulicha <?= $com == 'blog' ? 'trangchu active' : '' ?>"><a href="blog"
                            title="BLOG">BLOG</a>

                    </li>
                    <li class="menulicha <?= $com == 'tai-lieu' ? 'trangchu active' : '' ?>"><a href="tai-lieu"
                            title="TÀI LIỆU">TÀI LIỆU</a>

                    </li>
                    <li class="menulicha <?= $com == 'chinh-sach' ? 'trangchu active' : '' ?>"><a href="chinh-sach"
                            title="CHÍNH SÁCH">CHÍNH SÁCH</a>

                    </li>
                    <li class="menulicha <?= $com == 'lien-he' ? 'trangchu active' : '' ?>"><a href="lien-he"
                            title="LIÊN HỆ">LIÊN HỆ</a></li>

            </div>
        </div>
    </div>
</div>
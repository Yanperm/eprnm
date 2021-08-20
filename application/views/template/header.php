<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo-fav.png">
    <title>Nutmor - Electronic Patient Record</title>

    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url();?>assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" />

    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url();?>assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/jqvmap/jqvmap.min.css" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url();?>assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/select2/css/select2.min.css" />




    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400&display=swap" rel="stylesheet">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script> -->

    <!-- <script src="https://unpkg.com/vue@next"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="<?php echo base_url();?>assets/lib/jquery/jquery.min.js" type="text/javascript"></script>






    <script src="//cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/at-ui/dist/at.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/at-ui-style/css/at.min.css">





    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/app.css" type="text/css" />


    <link href="https://cdn.jsdelivr.net/npm/vuesax/dist/vuesax.css" rel="stylesheet">
    <script src="https://unpkg.com/vuesax"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url();?>assets/lib/material-design-icons/css/material-design-iconic-font.min.css" />

    <style>
    .icon {
        font-family: 'Material Icons', 'feather' !important;
        speak: none;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .active_menu {
        color: #4285f4 !important;
    }

    .at-table {
        position: relative;
        color: #3F536E;
        font-size: 14px;
    }

    .at-btn__text {
        font-size: 15px;
    }

    .at-btn__icon,
    .at-btn__loading {
        font-size: 14px;
        line-height: 1.5;
    }

    .table-filter-title {
        font-size: 15px;
    }

    label {
        font-size: 1.1rem;
    }

    .vs-input--input.hasValue+.vs-placeholder-label,
    .vs-input--input:focus+.vs-placeholder-label {
        font-size: 13px;
    }

    .vs-input--placeholder {
        font-size: 13px;
    }

    .con-select {
        width: auto;
        clear: both;
    }

    .vs-con-input-label {
        width: 100%;
    }

    .vs-con-textarea h4 {
        font-size: 14px;
    }

    .vs-textarea {
        color: rgb(78 67 67 / 80%);
        font-size: 13px;
    }

    .user-display-bg img {
        height: 78px;
    }

    .centex {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -webkit-box-align: center;
        align-items: center;
        -ms-flex-pack: center;
        -webkit-box-pack: center;
        justify-content: center;
    }

    .vs-button,
    .vs-switch {
        margin: 3px;
    }

    .con-text-noti h3,
    .con-text-noti p {
        color: #ffffff;
        padding-top: 3px;
        padding-bottom: 1px;
        margin-bottom: 3px;
        margin-top: 7px;
    }

    th,
    .vs-table--search-input,
    .vs-table--search i {
        font-size: 14px;
    }

    .vs-con-table table {
        font-size: 13px;
    }

    ol,
    ul,
    dl {
        margin-top: 0;
        margin-bottom: 0;
    }

    .vs-table--pagination .item-pagination {
        font-size: 13px;
    }

    .centerx,
    .con-notifications,
    .con-notifications-position {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .con-vs-dialog .vs-dialog .vs-dialog-text {
        padding: 10px;
        font-size: 14px;
        -webkit-transition: all .23s ease .1s;
        transition: all .23s ease .1s;
    }

    .breadcrumb {
        background-color: #eeeeee;
        margin-bottom: 18px;
        padding: 7px 0px 6px;
        line-height: 16px;
    }

    .page-head-title {
        color: #313030;
    }

    .card {
        border-radius: 8px;
        padding: 10px;
    }

    .vs-table--tbody-table .tr-values td {
        padding: 10px;
        font-size: 14px;
    }

    .sub-text {
        color: rgb(144, 145, 146);
        font-size: 12px;
    }

    th .sort-th,
    th .vs-table-text {
        display: block;
    }

    .vs-input--input.large {
        font-size: 14px;
    }

    table .material-icons {
        font-size: 16px;
        color: #000000 !important;
        font-weight: 900;
    }

    .mdrp__panel.dropdown-menu {
        z-index: 999 !important;
    }

    .vs-con-table.stripe .tr-values:nth-child(2n) {
        background: #f5f5f5 !important;
    }

    .vs-table--tbody-table .tr-values:not(.activeEdit):not(.tr-expandedx):not(.hoverFlat):hover {
        z-index: 200;
        background: #e8e7e7 !important;
        -webkit-transform: translateY(0px);
        transform: translateY(0px);
    }

    .vs-con-table.stripe .tr-values:nth-child(2n) {
        background: #ffffff !important;
        border: 1px solid #dfdfdf;
    }

    .vs-table--tbody-table .tr-values:last-child {
        border: 1px solid#dfdfdf;
    }

    .vs-table-primary .is-selected td:first-child {
        border-left: 1px solid #dfdfdf !important;
    }

    .card-table tr th:first-child,
    .card-table tr td:first-child {
        padding-left: 20px;
        border-left: 1px solid #dfdfdf;
    }

    .vs-table--thead {
        border: 1px solid #ececec;
    }

    thead tr {
        background: #f7f7f7 !important;
    }

    .vs-table--tbody-table .tr-values td {
        padding: 3px;
        font-size: 14px;
    }

    .vs-table--tbody-table tr {
        -webkit-transition: all .3s ease;
        transition: all .3s ease;
        background: #fff;
        border: 1px solid #dfdfdf;
    }

    .vs-popup--content {
        overflow-y: auto;
        overflow-x: hidden;
        width: auto;
    }

    .vuesax-app-is-ltr .vs-chip--text {
        margin-left: 10px;
        font-size: 12px;
    }
    </style>

    <?php
    if (!empty($css)):
        foreach ($css as $item):?>
    <link rel="stylesheet" href="<?php echo $item;?>" type="text/css" />
    <?php endforeach;
    endif;
    ?>
</head>

<body>
    <div class="be-wrapper be-fixed-sidebar">
        <nav class="navbar navbar-expand fixed-top be-top-header">
            <div class="container-fluid">
                <div class="be-navbar-header">
                    <a class="navbar-brand" href="index.html"></a>
                </div>
                <div class="page-title"><span>Electronic Patient Record</span></div>
                <div class="be-right-navbar">
                    <ul class="nav navbar-nav float-right be-user-nav">
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                data-toggle="dropdown" role="button" aria-expanded="false"><img
                                    src="<?php echo base_url();?>assets/img/avatar.png" alt="Avatar"><span
                                    class="user-name">Túpac Amaru</span></a>
                            <div class="dropdown-menu" role="menu">
                                <div class="user-info">
                                    <div class="user-name">Túpac Amaru</div>
                                    <div class="user-position online">Available</div>
                                </div><a class="dropdown-item" href="pages-profile.html"><span
                                        class="icon mdi mdi-face"></span>Account</a><a class="dropdown-item"
                                    href="#"><span class="icon mdi mdi-settings"></span>Settings</a>
                                <a class="dropdown-item" href="<?php echo base_url('logout')?>"><span
                                        class="icon mdi mdi-power"></span>Logout</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right be-icons-nav">
                        <li class="nav-item dropdown"><a class="nav-link be-toggle-right-sidebar" href="#" role="button"
                                aria-expanded="false"><span class="icon mdi mdi-settings"></span></a></li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                data-toggle="dropdown" role="button" aria-expanded="false"><span
                                    class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>
                            <ul class="dropdown-menu be-notifications">
                                <li>
                                    <div class="title">Notifications<span class="badge badge-pill">3</span></div>
                                    <div class="list">
                                        <div class="be-scroller-notifications">
                                            <div class="content">
                                                <ul>
                                                    <li class="notification notification-unread">
                                                        <a href="#">
                                                            <div class="image"><img
                                                                    src="<?php echo base_url();?>assets/img/avatar2.png"
                                                                    alt="Avatar"></div>
                                                            <div class="notification-info">
                                                                <div class="text"><span class="user-name">Jessica
                                                                        Caruso</span> accepted your invitation to join
                                                                    the team.</div><span class="date">2 min ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="notification">
                                                        <a href="#">
                                                            <div class="image"><img
                                                                    src="<?php echo base_url();?>assets/img/avatar3.png"
                                                                    alt="Avatar"></div>
                                                            <div class="notification-info">
                                                                <div class="text"><span class="user-name">Joel
                                                                        King</span> is now following you</div><span
                                                                    class="date">2 days ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="notification">
                                                        <a href="#">
                                                            <div class="image"><img
                                                                    src="<?php echo base_url();?>assets/img/avatar4.png"
                                                                    alt="Avatar"></div>
                                                            <div class="notification-info">
                                                                <div class="text"><span class="user-name">John
                                                                        Doe</span> is watching your main repository
                                                                </div><span class="date">2 days ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="notification">
                                                        <a href="#">
                                                            <div class="image"><img
                                                                    src="<?php echo base_url();?>assets/img/avatar5.png"
                                                                    alt="Avatar"></div>
                                                            <div class="notification-info"><span class="text"><span
                                                                        class="user-name">Emily Carter</span> is now
                                                                    following you</span><span class="date">5 days
                                                                    ago</span></div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer"> <a href="#">View all notifications</a></div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                data-toggle="dropdown" role="button" aria-expanded="false"><span
                                    class="icon mdi mdi-apps"></span></a>
                            <ul class="dropdown-menu be-connections">
                                <li>
                                    <div class="list">
                                        <div class="content">
                                            <div class="row">
                                                <div class="col"><a class="connection-item" href="#"><img
                                                            src="<?php echo base_url();?>assets/img/github.png"
                                                            alt="Github"><span>GitHub</span></a></div>
                                                <div class="col"><a class="connection-item" href="#"><img
                                                            src="<?php echo base_url();?>assets/img/bitbucket.png"
                                                            alt="Bitbucket"><span>Bitbucket</span></a></div>
                                                <div class="col"><a class="connection-item" href="#"><img
                                                            src="<?php echo base_url();?>assets/img/slack.png"
                                                            alt="Slack"><span>Slack</span></a></div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><a class="connection-item" href="#"><img
                                                            src="<?php echo base_url();?>assets/img/dribbble.png"
                                                            alt="Dribbble"><span>Dribbble</span></a></div>
                                                <div class="col"><a class="connection-item" href="#"><img
                                                            src="<?php echo base_url();?>assets/img/mail_chimp.png"
                                                            alt="Mail Chimp"><span>Mail Chimp</span></a></div>
                                                <div class="col"><a class="connection-item" href="#"><img
                                                            src="<?php echo base_url();?>assets/img/dropbox.png"
                                                            alt="Dropbox"><span>Dropbox</span></a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer"> <a href="#">More</a></div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-------------------------------BEGIN COPY MENU--------------------------------------------------->
        <div class="be-left-sidebar">
            <div class="left-sidebar-wrapper"><a class="left-sidebar-toggle" href="#">Dashboard</a>
                <div class="left-sidebar-spacer">
                    <div class="left-sidebar-scroll">
                        <div class="left-sidebar-content">
                            <ul class="sidebar-elements">
                                <li class="divider">Menu</li>
                                <li><a href="<?php echo base_url('dashboard');?>"><i
                                            class="icon mdi mdi-home"></i><span>หน้าหลัก</span></a>
                                </li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-face"></i><span>ผู้ป่วย</span></a>
                                    <ul class="sub-menu">
                                        <li><a class="nav-link"
                                                href="<?php echo base_url('patient/manage-queue');?>">การจัดการนัดหมาย</a>
                                        </li>
                                        <li><a href="<?php echo base_url('patient/queue');?>">เรียกคิว</a>
                                        </li>
                                        <li><a href="<?php echo base_url('patient/list');?>">ฐานข้อมูลผู้ป่วย</a>
                                        </li>

                                    </ul>
                                </li>

                                <li class="parent"><a href="#"><i
                                            class="icon mdi mdi-local-hospital"></i><span>ยาและเวชภัณฑ์</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('productMain');?>">กลุ่มยาหลัก</a>
                                        </li>
                                        <li><a href="<?php echo base_url('productSub');?>">กลุ่มยารอง</a>
                                        </li>
                                        <li><a href="<?php echo base_url('add-product');?>">เพิ่มยาใหม่</a>
                                        </li>
                                        <li><a href="<?php echo base_url('product');?>">คลังยา</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent"><a href="#"><i
                                            class="icon mdi mdi-eyedropper"></i><span>ห้องปฏิบัติการ</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('labCompany');?>">ผู้รับตรวจ</a>
                                        </li>
                                        <li><a href="<?php echo base_url('department');?>">แผนกส่งตรวจ</a>
                                        </li>
                                        <li><a href="<?php echo base_url('checkList');?>">รายการส่งตรวจ</a>
                                        </li>


                                    </ul>
                                </li>
                                <li class="parent"><a href="#"><i
                                            class="icon mdi mdi-male"></i><span>รายการหัตถการ</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('procedure');?>">การจัดการหัตถการ</a>
                                        </li>

                                    </ul>
                                </li>

                                <li class="parent"><a href="#"><i class="icon mdi mdi-chart"></i><span>รายงาน</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('reportSell');?>">รายงานยอดขาย</a>
                                        </li>
                                        <li><a href="<?php echo base_url('reportMembers');?>">รายงานยอดคนไข้</a></li>

                                    </ul>
                                </li>

                                <li class="divider">Configuration</li>
                                <li class="parent"><a href="#"><i
                                            class="icon mdi mdi-local-store"></i><span>ข้อมูลคลินิก</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('clinic')?>">ที่อยู่</a>
                                        </li>
                                        <li><a href="<?php echo base_url('seoClinic')?>">จัดการ SEO</a>
                                        </li>
                                        <li><a href="#">Subscription</a>
                                        </li>
                                        <li><a href="<?php echo base_url('likeClinic');?>">Like</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="parent">
                                    <a href="#"><i class="icon mdi mdi-calendar-alt"></i><span>วันและเวลา</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('time');?>">ตั้งค่าวันและเวลาเปิดปิด</a>
                                        </li>
                                        <li><a href="<?php echo base_url('rest-day');?>">วันหยุดคลินิก</a>
                                        </li>
                                        <li><a href="<?php echo base_url('queueClode');?>">ตั้งค่าคิวเต็ม</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent"><a href="#"><i
                                            class="icon mdi mdi-assignment-account"></i><span>ผู้ใช้งานระบบ</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('showUser');?>">จัดการผู้ใช้งานระบบ</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent"><a href="#"><i
                                            class="icon mdi mdi-youtube-play"></i><span>จอประกาศคิว</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('productYoutube');?>">ตั้งค่าจอประกาศคิว</a>
                                        </li>
                                        <li><a href="">จอประกาศคิว</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="progress-widget">
                    <div class="progress-data"><span class="progress-value">75%</span><i
                            class="icon mdi mdi-cloud"></i><span class="name">Storage </span></div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" style="width: 60%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------END COPY MENU--------------------------------------------------->




        <div class="be-content">
            <div class="main-content container-fluid">
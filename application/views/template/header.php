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

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/jqvmap/jqvmap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/select2/css/select2.min.css" />




    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap" rel="stylesheet">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script> -->

    <!-- <script src="https://unpkg.com/vue@next"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="<?php echo base_url();?>assets/lib/jquery/jquery.min.js" type="text/javascript"></script>




    <script src="//cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/at-ui/dist/at.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/at-ui-style/css/at.min.css">





    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/app.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/material-design-icons/css/material-design-iconic-font.min.css" />


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
        .active_menu{
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
        .at-btn__icon, .at-btn__loading {
            font-size: 14px;
            line-height: 1.5;
        }
        .table-filter-title {
            font-size: 15px;
        }
        label {
            font-size: 1.1rem;
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
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><img src="<?php echo base_url();?>assets/img/avatar.png" alt="Avatar"><span
								  class="user-name">Túpac Amaru</span></a>
                            <div class="dropdown-menu" role="menu">
                                <div class="user-info">
                                    <div class="user-name">Túpac Amaru</div>
                                    <div class="user-position online">Available</div>
                                </div><a class="dropdown-item" href="pages-profile.html"><span class="icon mdi mdi-face"></span>Account</a><a class="dropdown-item" href="#"><span class="icon mdi mdi-settings"></span>Settings</a>
                                <a class="dropdown-item" href="<?php echo base_url('logout')?>"><span class="icon mdi mdi-power"></span>Logout</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right be-icons-nav">
                        <li class="nav-item dropdown"><a class="nav-link be-toggle-right-sidebar" href="#" role="button" aria-expanded="false"><span class="icon mdi mdi-settings"></span></a></li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><span class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>
                            <ul class="dropdown-menu be-notifications">
                                <li>
                                    <div class="title">Notifications<span class="badge badge-pill">3</span></div>
                                    <div class="list">
                                        <div class="be-scroller-notifications">
                                            <div class="content">
                                                <ul>
                                                    <li class="notification notification-unread">
                                                        <a href="#">
                                                            <div class="image"><img src="<?php echo base_url();?>assets/img/avatar2.png" alt="Avatar"></div>
                                                            <div class="notification-info">
                                                                <div class="text"><span class="user-name">Jessica Caruso</span> accepted your invitation to join the team.</div><span class="date">2 min ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="notification">
                                                        <a href="#">
                                                            <div class="image"><img src="<?php echo base_url();?>assets/img/avatar3.png" alt="Avatar"></div>
                                                            <div class="notification-info">
                                                                <div class="text"><span class="user-name">Joel King</span> is now following you</div><span class="date">2 days ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="notification">
                                                        <a href="#">
                                                            <div class="image"><img src="<?php echo base_url();?>assets/img/avatar4.png" alt="Avatar"></div>
                                                            <div class="notification-info">
                                                                <div class="text"><span class="user-name">John Doe</span> is watching your main repository</div><span class="date">2 days ago</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="notification">
                                                        <a href="#">
                                                            <div class="image"><img src="<?php echo base_url();?>assets/img/avatar5.png" alt="Avatar"></div>
                                                            <div class="notification-info"><span class="text"><span class="user-name">Emily Carter</span> is now following you</span><span class="date">5 days ago</span></div>
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
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><span class="icon mdi mdi-apps"></span></a>
                            <ul class="dropdown-menu be-connections">
                                <li>
                                    <div class="list">
                                        <div class="content">
                                            <div class="row">
                                                <div class="col"><a class="connection-item" href="#"><img src="<?php echo base_url();?>assets/img/github.png" alt="Github"><span>GitHub</span></a></div>
                                                <div class="col"><a class="connection-item" href="#"><img src="<?php echo base_url();?>assets/img/bitbucket.png" alt="Bitbucket"><span>Bitbucket</span></a></div>
                                                <div class="col"><a class="connection-item" href="#"><img src="<?php echo base_url();?>assets/img/slack.png" alt="Slack"><span>Slack</span></a></div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><a class="connection-item" href="#"><img src="<?php echo base_url();?>assets/img/dribbble.png" alt="Dribbble"><span>Dribbble</span></a></div>
                                                <div class="col"><a class="connection-item" href="#"><img src="<?php echo base_url();?>assets/img/mail_chimp.png" alt="Mail Chimp"><span>Mail Chimp</span></a></div>
                                                <div class="col"><a class="connection-item" href="#"><img src="<?php echo base_url();?>assets/img/dropbox.png" alt="Dropbox"><span>Dropbox</span></a></div>
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
                                <li><a href="<?php echo base_url();?>"><i class="icon mdi mdi-home"></i><span>หน้าหลัก</span></a>
                                </li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-face"></i><span>ผู้ป่วย</span></a>
                                    <ul class="sub-menu">
                                        <li><a class="nav-link" href="<?php echo base_url('patient/manage-queue');?>">การจัดการนัดหมาย</a>
                                        </li>
                                        <li><a href="<?php echo base_url('patient/queue');?>">เรียกคิว</a>
                                        </li>
                                        <li><a href="<?php echo base_url('patient/list');?>">ฐานข้อมูลผู้ป่วย</a>
                                        </li>



                                        <!-- CLEAR
                                    <li><a href="ui-modals.html">Modals</a>
                                    </li>
                                    <li><a href="ui-cards.html"><span class="badge badge-primary float-right">New</span>Cards</a>
                                    </li>
                                    <li><a href="ui-notifications.html">Notifications</a>
                                    </li>
                                    <li><a href="ui-icons.html">Icons</a>
                                    </li>
                                    <li><a href="ui-grid.html">Grid</a>
                                    </li>
                                    <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a>
                                    </li>
                                    <li><a href="ui-nestable-lists.html">Nestable Lists</a>
                                    </li>
                                    <li><a href="ui-typography.html">Typography</a>
                                    </li>
                                    <li><a href="ui-dragdrop.html"><span class="badge badge-primary float-right">New</span>Drag &amp; Drop</a>
                                    </li>
                                    <li><a href="ui-sweetalert2.html"><span class="badge badge-primary float-right">New</span>Sweetalert 2</a>
                                    </li>-->

                                    </ul>
                                </li>

                                <li class="parent"><a href="#"><i class="icon mdi mdi-local-hospital"></i><span>ยาและเวชภัณฑ์</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('productMain');?>">กลุ่มยาหลัก</a>
                                        </li>
                                        <li><a href="<?php echo base_url('productSub');?>">กลุ่มยารอง</a>
                                        </li>
                                        <li><a href="<?php echo base_url();?>">เพิ่มยาใหม่</a>
                                        </li>
                                        <li><a href="<?php echo base_url();?>">คลังยา</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-eyedropper"></i><span>ห้องปฏิบัติการ</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('labCompany');?>">ผู้รับตรวจ</a>
                                        </li>
                                        <li><a href="<?php echo base_url('department');?>">แผนกส่งตรวจ</a>
                                        </li>
                                        <li><a href="<?php echo base_url('checkList');?>">รายการส่งตรวจ</a>
                                        </li>

                                        <!-- CUT OUT
                                    <li><a href="form-wizard.html">Wizard</a>
                                    </li>
                                    <li><a href="form-masks.html">Input Masks</a>
                                    </li>
                                    <li><a href="form-wysiwyg.html">WYSIWYG Editor</a>
                                    </li>
                                    <li><a href="form-upload.html">Multi Upload</a>
                                    </li> -->


                                    </ul>
                                </li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-male"></i><span>รายการหัตถการ</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('procedure');?>">การจัดการหัตถการ</a>
                                        </li>

                                        <!--<li><a href="tables-datatables.html">Data Tables</a>
                                    </li>
                                    <li><a href="tables-filters.html"><span class="badge badge-primary float-right">New</span>Table Filters</a>
                                    </li>-->

                                    </ul>
                                </li>

                                <li class="parent"><a href="#"><i class="icon mdi mdi-chart"></i><span>รายงาน</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url();?>">รายงานยอดขาย</a>
                                        </li>

                                        <!--
                                     <li><a href="pages-blank-header.html">Blank Page Header</a>
                                     </li>
                                     <li><a href="pages-login.html">Login</a>
                                     </li>
                                     <li><a href="pages-login2.html">Login v2</a>
                                     </li>
                                     <li><a href="pages-404.html">404 Page</a>
                                     </li>
                                     <li><a href="pages-sign-up.html">Sign Up</a>
                                     </li>
                                     <li><a href="pages-forgot-password.html">Forgot Password</a>
                                     </li>
                                     <li><a href="pages-profile.html">Profile</a>
                                     </li>
                                     <li><a href="pages-pricing-tables.html">Pricing Tables</a>
                                     </li>
                                     <li><a href="pages-pricing-tables2.html">Pricing Tables v2</a>
                                     </li>
                                     <li><a href="pages-timeline.html">Timeline</a>
                                     </li>
                                     <li><a href="pages-timeline2.html">Timeline v2</a>
                                     </li>
                                     <li><a href="pages-invoice.html"><span class="badge badge-primary float-right">New</span>Invoice</a>
                                     </li>
                                     <li><a href="pages-calendar.html">Calendar</a>
                                     </li>
                                     <li><a href="pages-gallery.html">Gallery</a>
                                     </li>
                                     <li><a href="pages-code-editor.html"><span class="badge badge-primary float-right">New    </span>Code Editor</a>
                                     </li>
                                     <li><a href="pages-booking.html"><span class="badge badge-primary float-right">New</span>Booking</a>
                                     </li>
                                     <li><a href="pages-loaders.html"><span class="badge badge-primary float-right">New</span>Loaders</a>
                                     </li>
                                     <li><a href="pages-ajax-loader.html"><span class="badge badge-primary float-right">New</span>AJAX Loader</a>
                                     </li> -->

                                    </ul>
                                </li>




                                <li class="divider">Configuration</li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-store"></i><span>ข้อมูลคลินิก</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('clinic')?>">จัดการข้อมูลคลินิก</a>
                                        </li>
                                        <li><a href="<?php echo base_url();?>">ผู้ใช้งานระบบ</a>
                                        </li>
                                        <!--<li><a href="email-compose.html">Email Compose</a>
                                    </li>-->
                                    </ul>
                                </li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-calendar-alt"></i><span>วันและเวลา</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo base_url('close');?>">จัดการเวลาเปิดปิด</a>
                                        </li>
                                        <li><a href="<?php echo base_url('rest-day');?>">วันหยุดคลินิก</a>
                                        </li>
                                        <!--
                                    <li><a href="layouts-warning-header.html">Warning Header</a>
                                    </li>
                                    <li><a href="layouts-danger-header.html">Danger Header</a>
                                    </li>
                                    <li><a href="layouts-search-input.html">Search Input</a>
                                    </li>
                                    <li><a href="layouts-offcanvas-menu.html">Off Canvas Menu</a>
                                    </li>
                                    <li><a href="layouts-top-menu.html"><span class="badge badge-primary float-right">New</span>Top Menu</a>
                                    </li>
                                    <li><a href="layouts-nosidebar-left.html">Without Left Sidebar</a>
                                    </li>
                                    <li><a href="layouts-nosidebar-right.html">Without Right Sidebar</a>
                                    </li>
                                    <li><a href="layouts-nosidebars.html">Without Both Sidebars</a>
                                    </li>
                                    <li><a href="layouts-fixed-sidebar.html">Fixed Left Sidebar</a>
                                    </li>
                                    <li><a href="layouts-boxed-layout.html"><span class="badge badge-primary float-right">New</span>Boxed Layout</a>
                                    </li>
                                    <li><a href="pages-blank-aside.html">Page Aside</a>
                                    </li>
                                    <li><a href="layouts-collapsible-sidebar.html">Collapsible Sidebar</a>
                                    </li>
                                    <li><a href="layouts-sub-navigation.html"><span class="badge badge-primary float-right">New</span>Sub Navigation</a>
                                    </li>
                                    <li><a href="layouts-mega-menu.html"><span class="badge badge-primary float-right">New</span>Mega Menu</a>
                                    </li>-->
                                    </ul>
                                </li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-tv-alt-play"></i><span>จอประกาศคิว</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="maps-google.html">จัดการจอประกาศคิว</a>
                                        </li>
                                        <!-- <li><a href="maps-vector.html">Vector Maps</a>
                                    </li> -->
                                    </ul>
                                </li>



                                <!--<li class="parent"><a href="#"><i class="icon mdi mdi-folder"></i><span>Menu Levels</span></a>
                              <ul class="sub-menu">
                                <li class="parent"><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 1</span></a>
                                  <ul class="sub-menu">
                                    <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 2</span></a>
                                    </li>
                                    <li class="parent"><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 2</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 3</span></a>
                                        </li>
                                        <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 3</span></a>
                                        </li>
                                      </ul>
                                    </li>
                                  </ul>
                                </li>
                                <li class="parent"><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 1</span></a>
                                  <ul class="sub-menu">
                                    <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 2</span></a>
                                    </li>
                                    <li class="parent"><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 2</span></a>
                                      <ul class="sub-menu">
                                        <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 3</span></a>
                                        </li>
                                        <li><a href="#"><i class="icon mdi mdi-undefined"></i><span>Level 3</span></a>
                                        </li>
                                      </ul>
                                    </li>
                                  </ul>
                                </li>
                              </ul>
                            </li>-->



                                <!--<li><a href="documentation.html"><i class="icon mdi mdi-book"></i><span>Documentation</span></a>
                            </li>-->



                            </ul>
                        </div>
                    </div>
                </div>
                <div class="progress-widget">
                    <div class="progress-data"><span class="progress-value">610%</span><span class="name">Current Project</span></div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" style="width: 60%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------END COPY MENU--------------------------------------------------->




        <div class="be-content">
            <div class="main-content container-fluid">
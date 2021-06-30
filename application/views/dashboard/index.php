<div id="vue-root">
    <div class="row">
        <div class="col-12 col-lg-6 col-xl-3">
            <div class="widget widget-tile">
                <div class="chart sparkline" id="spark1"></div>
                <div class="data-info">
                    <div class="desc">คิววันนี้</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span class="number" data-toggle="counter" data-end="<?php echo number_format($todayBooking); ?>">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
            <div class="widget widget-tile">
                <div class="chart sparkline" id="spark2"></div>
                <div class="data-info">
                    <div class="desc">คิวทั้งหมด</div>
                    <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-right"></span><span class="number" data-toggle="counter" data-end="<?php echo $allBooking;?>" data-suffix="">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
            <div class="widget widget-tile">
                <div class="chart sparkline" id="spark3"></div>
                <div class="data-info">
                    <div class="desc">Like</div>
                    <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-right"></span><span class="number" data-toggle="counter" data-end="<?php echo $like;?>">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
            <div class="widget widget-tile">
                <div class="chart sparkline" id="spark4"></div>
                <div class="data-info">
                    <div class="desc">Page Visit</div>
                    <div class="value"><span class="indicator indicator-negative mdi mdi-chevron-right"></span><span class="number" data-toggle="counter" data-end="<?php echo $pageVisit;?>">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-fullwidth be-loading">
                <div class="widget-head">
                    <div class="tools">
                        <div class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><span class="icon mdi mdi-more-vert d-inline-block d-md-none"></span></a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" href="#">Week</a><a class="dropdown-item" href="#">Month</a><a class="dropdown-item" href="#">Year</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Today</a>
                            </div>
                        </div>

                    </div>
                    <div class="button-toolbar d-none d-md-block">
                        <!-- <div class="btn-group">
                            <button class="btn btn-secondary" type="button">สัปดาห์</button>
                            <button class="btn btn-secondary active" type="button">เดือน</button>
                            <button class="btn btn-secondary" type="button">ปี</button>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-secondary" type="button">Today</button>
                        </div> -->
                    </div><span class="title">สถิติการใช้งานรายวัน</span>
                </div>
                <div class="widget-chart-container">
                    <div class="widget-chart-info">
                        <ul class="chart-legend-horizontal">
                            <!-- <li><span data-color="main-chart-color1"></span> ยอดขาย</li> -->
                            <li><span data-color="main-chart-color2"></span> Conversation Rate</li>
                            <li><span data-color="main-chart-color3"></span> จำนวนคนที่มาเข้าร้าน</li>
                        </ul>
                    </div>

                    <div id="main-chart" style="height: 250px;"></div>
                </div>

            </div>
        </div>
    </div>


    <!--Begin ROW-->
    <div class="row">
        <!--COMMENT1-->
        <div class="col-12 col-lg-6">
            <div class="card card-table">
                <div class="card-header">
                    <div class="title">คิวรอนุมัติการจองรายการล่าสุด</div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ผู้ป่วย</th>
                                <th>คิวที่</th>
                                <!-- <th>สาเหตุที่มาพบแพทย์</th> -->
                                <th>วันและเวลา</th>
                                <th class="actions">สถานะคิว</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listToDay)):?>
                            <?php foreach ($listToDay as $item):?>
                            <tr>
                                <td class="user-avatar"> <img src="<?php echo base_url();?>assets/img/avatar6.png" alt="Avatar">
                                    <?php echo $item['CUSTOMERNAME']; ?>
                                </td>
                                <td>
                                    <?php echo $item['QUES'];?>
                                </td>
                                <!-- <td>
                                    <?php echo $item['DETAIL']; ?>
                                </td> -->
                                <td>
                                    <?php echo $item['BOOKDATE']; ?>
                                </td>
                                <td class="actions centex">
                                    <vs-tooltip color="primary" text="ยืนยันการจอง">
                                        <vs-button radius color="primary" type="gradient" icon="check"></vs-button>
                                    </vs-tooltip>
                                    <vs-tooltip color="danger" text="ยกเลิกการจอง">
                                        <vs-button radius color="danger" type="gradient " icon="close"></vs-button>
                                    </vs-tooltip>


                                </td>
                            </tr>
                            <?php endforeach?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--END COMMENT1-->








        <!--COMMENT2-->
        <div class="col-12 col-lg-6 ">
            <div class="card card-table ">
                <div class="card-header ">

                    <div class="tools" style="font-size: 14px;">
                        <vs-button color="primary" type="gradient" icon="add_circle_outline">เพิ่มข้อมูลยา</vs-button>

                    </div>

                    <div class="title ">Monthly Top Sales</div>
                </div>
                <div class="card-body table-responsive ">
                    <table class="table table-striped table-borderless ">
                        <thead>
                            <tr>
                                <th style="width:40%; ">Product</th>
                                <th class="number">จำนวนในคลัง</th>
                                <th class="number " style="width:20%; ">ราคา</th>
                                <!-- <th style="width:20%; ">Total</th> -->
                                <th class="actions " style="width:5%; "></th>
                            </tr>
                        </thead>
                        <tbody class="no-border-x ">
                            <?php if (!empty($product)):?>
                            <?php foreach ($product as $item):?>
                            <tr>
                                <td>
                                    <?php echo $item->CommonName; ?>
                                </td>
                                <td class="number ">
                                    <?php echo $item->Digit; ?>
                                </td>
                                <td class="number ">
                                    <?php echo $item->PriceBuy; ?>฿</td>
                                <td class="actions ">
                                    <vs-tooltip color="primary" text="เติมยาเข้าระบบ">
                                        <vs-button radius color="primary" type="gradient" icon="add"></vs-button>
                                    </vs-tooltip>
                                    <!-- <a class="icon " href="# "><i class="mdi mdi-plus-circle-o "></i></a> -->
                                </td>
                            </tr>
                            <?php endforeach?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--END COMMENT2-->

    </div>
    <!--END ROW-->


    <!-- <div class="row ">
        <div class="col-12 col-lg-4 ">
            <div class="card ">
                <div class="card-header card-header-divider pb-3 ">User Channel</div>
                <div class="card-body pt-5 ">
                    <div class="row user-progress user-progress-small ">
                        <div class="col-lg-5 "><span class="title ">Web</span></div>
                        <div class="col-lg-7 ">
                            <div class="progress ">
                                <div class="progress-bar bg-success " style="width: 40% "></div>
                            </div>
                        </div>
                    </div>
                    <div class="row user-progress user-progress-small ">
                        <div class="col-lg-5 "><span class="title ">iOS</span></div>
                        <div class="col-lg-7 ">
                            <div class="progress ">
                                <div class="progress-bar bg-success " style="width: 65% "></div>
                            </div>
                        </div>
                    </div>
                    <div class="row user-progress user-progress-small ">
                        <div class="col-lg-5 "><span class="title ">Android</span></div>
                        <div class="col-lg-7 ">
                            <div class="progress ">
                                <div class="progress-bar bg-success " style="width: 30% "></div>
                            </div>
                        </div>
                    </div>
                    <div class="row user-progress user-progress-small ">
                        <div class="col-lg-5 "><span class="title ">Phone</span></div>
                        <div class="col-lg-7 ">
                            <div class="progress ">
                                <div class="progress-bar bg-success " style="width: 80% "></div>
                            </div>
                        </div>
                    </div>
                    <div class="row user-progress user-progress-small ">
                        <div class="col-lg-5 "><span class="title ">Staffs</span></div>
                        <div class="col-lg-7 ">
                            <div class="progress ">
                                <div class="progress-bar bg-success " style="width: 45% "></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 ">
            <div class="widget be-loading ">
                <div class="widget-head ">
                    <div class="tools "><span class="icon mdi mdi-chevron-down "></span><span class="icon mdi mdi-refresh-sync toggle-loading "></span><span class="icon mdi mdi-close "></span></div>
                    <div class="title ">Sale Proportions</div>
                </div>
                <div class="widget-chart-container ">
                    <div id="top-sales " style="height:500px; "></div>
                    <div class="chart-pie-counter ">36</div>
                </div>
                <div class="chart-legend ">
                    <table>
                        <tr>
                            <td class="chart-legend-color "><span data-color="top-sales-color1 "></span></td>
                            <td>Medicine</td>
                            <td class="chart-legend-value ">125</td>
                        </tr>
                        <tr>
                            <td class="chart-legend-color "><span data-color="top-sales-color2 "></span></td>
                            <td>Laboratory</td>
                            <td class="chart-legend-value ">1569</td>
                        </tr>
                        <tr>
                            <td class="chart-legend-color "><span data-color="top-sales-color3 "></span></td>
                            <td>Procedure</td>
                            <td class="chart-legend-value ">824</td>
                        </tr>
                    </table>
                </div>
                <div class="be-spinner ">
                    <svg width="40px " height="40px " viewBox="0 0 66 66 " xmlns="http://www.w3.org/2000/svg ">
                    <circle class="circle " fill="none " stroke-width="4 " stroke-linecap="round " cx="33 " cy="33 " r="30 "></circle>
                </svg>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 ">
            <div class="widget widget-calendar ">
                <div id="calendar-widget "></div>
            </div>
        </div>
    </div>
    <div class="row ">

        <div class="col-12 col-lg-6 ">


            <div class="card ">
                <div class="card-header ">Stock Movement</div>
                <div class="card-body ">
                    <ul class="user-timeline user-timeline-compact ">
                        <li class="latest ">
                            <div class="user-timeline-date ">ให้ทำเป็น Graph </div>
                            <div class="user-timeline-title ">ความเคลื่อนไหวของคลังสินค้า</div>
                            <div class="user-timeline-description ">ใช้กราฟ Fullwidth Wave สีเขียว จาก graph Flot</div>
                        </li>
                        <li>
                            <div class="user-timeline-date "> <a href="charts-flot.html "> Link Graph Flot</a></div>
                            <div class="user-timeline-title ">ใช้กราฟ Fullwidth Wave สีเขียว จาก graph Flot</div>
                            <div class="user-timeline-description ">Vestibulum lectus nulla, maximus in eros non, tristique.</div>
                        </li>
                        <li>
                            <div class="user-timeline-date ">Yesterday - 10:41</div>
                            <div class="user-timeline-title "><a href="charts-flot.html "> Link Graph Flot </a> </div>
                            <div class="user-timeline-description ">Vestibulum lectus nulla, maximus in eros non, tristique. </div>
                        </li>
                        <li>
                            <div class="user-timeline-date ">Yesterday - 3:02</div>
                            <div class="user-timeline-title ">Fix the Sidebar</div>
                            <div class="user-timeline-description ">Vestibulum lectus nulla, maximus in eros non, tristique.</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>




        <div class="col-12 col-lg-6 ">
            <div class="widget be-loading ">
                <div class="widget-head ">
                    <div class="tools "><span class="icon mdi mdi-chevron-down "></span><span class="icon mdi mdi-refresh-sync toggle-loading "></span><span class="icon mdi mdi-close "></span></div>
                    <div class="title ">Conversions</div>
                </div>
                <div class="widget-chart-container ">
                    <div class="widget-chart-info mb-4 ">
                        <div class="indicator indicator-positive float-right "><span class="icon mdi mdi-chevron-up "></span><span class="number ">15%</span></div>
                        <div class="counter counter-inline ">
                            <div class="value ">156k</div>
                            <div class="desc ">Impressions</div>
                        </div>
                    </div>
                    <div id="map-widget " style="height: 265px; "></div>
                </div>
                <div class="be-spinner ">
                    <svg width="40px " height="40px " viewBox="0 0 66 66 " xmlns="http://www.w3.org/2000/svg ">
                    <circle class="circle " fill="none " stroke-width="4 " stroke-linecap="round " cx="33 " cy="33 " r="30 "></circle>
                </svg>
                </div>
            </div>
        </div>
    </div> -->
</div>

<style>
    #flot-placeholder div.xAxis div.tickLabel {
        max-width: 30px !important;
        top: 300px !important;
    }
</style>

<script src="<?php echo base_url();?>assets/lib/jquery-flot/jquery.flot.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/jquery.flot.pie.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/jquery.flot.time.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/plugins/curvedLines.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/plugins/jquery.flot.tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery.sparkline/jquery.sparkline.min.js" type="text/javascript"></script>


<script>
    const app = new Vue({
        el: '#vue-root',
        data() {
            return {

            }
        }
    });

    mainChart();
    //Main chart
    function mainChart() {

        var color1 = '#4385f4';
        var color2 = '#81adf8';
        var color3 = '#a2c3fa';

        var data = [];
        var data2 = [];
        var data3 = [];

        $.ajax({
            type: 'GET',
            url: 'dashBoard/getDataChart',
            data: {
                chartType: 'month'
            },
            dataType: "JSON", // data type expected from server
            success: function(response) {
                // for (let i = 0; i < response.data.sale.length; i++) {
                //     data.push([parseInt(response.data.sale[i].DATE), (response.data.sale[i].NUM) / 1000])
                // }

                for (let i = 0; i < response.data.conversationRate.length; i++) {
                    data2.push([parseInt(response.data.conversationRate[i].DATE), parseInt(response.data.conversationRate[i].NUM)])
                }

                for (let i = 0; i < response.data.booking.length; i++) {
                    data3.push([parseInt(response.data.booking[i].DATE), parseInt(response.data.booking[i].NUM)])
                }

                var plot_statistics = $.plot($("#main-chart"), [{
                    data: data2,
                    showLabels: true,
                    label: "Conversation Rate",
                    labelPlacement: "below",
                    canvasRender: true,
                    cColor: "#FFFFFF"
                }, {
                    data: data3,
                    showLabels: true,
                    label: "จำนวนคนที่มาเข้าร้าน",
                    labelPlacement: "below",
                    canvasRender: true,
                    cColor: "#FFFFFF"
                }, {
                    data: data,
                    showLabels: true,
                    label: "ยอดขาย",
                    labelPlacement: "below",
                    canvasRender: true,
                    cColor: "#FFFFFF"
                }, ], {
                    series: {
                        lines: {
                            show: true,
                            lineWidth: 15,
                            fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 1
                                }, {
                                    opacity: 1
                                }]
                            }
                        },
                        fillColor: "rgba(0, 0, 0, 1)",
                        shadowSize: 0,
                        curvedLines: {
                            apply: true,
                            active: true,
                            monotonicFit: true
                        }
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        show: true,
                        margin: {
                            top: 20,
                            bottom: 0,
                            left: 0,
                            right: 0,
                        },
                        labelMargin: 0,
                        minBorderMargin: 0,
                        axisMargin: 0,
                        tickColor: "rgba(0,0,0,0.05)",
                        tickSize: 0,
                        borderWidth: 0,
                        hoverable: true,
                        clickable: true
                    },
                    tooltip: {
                        show: true,
                        cssClass: "tooltip-chart",
                        content: "<div class='content-chart'> <span> %s </span> <div class='label'> <div class='label-x'> %x.0 </div> - <div class='label-y'> %y.0 </div> </div></div>",
                        defaultTheme: false
                    },
                    colors: [color2, color3, color1],
                    xaxis: {
                        tickFormatter: function() {
                            return '';
                        },
                        autoscaleMargin: 0,
                        ticks: 0,
                        tickDecimals: 0,
                        tickLength: 0
                    },
                    yaxis: {
                        tickFormatter: function() {
                            return '';
                        },
                        zoom: true,
                        autoscaleMargin: 0.01,
                        ticks: 5,
                        tickLength: 0,
                        tickDecimals: 0
                    }
                });

            },
            error: function(error) {
                console.log('Error: ' + error);
            }
        });



        widget_tooltipPosition('main-chart', 60);

        //Chart legend color setter
        $('[data-color="main-chart-color1"]').css({
            'background-color': color1
        });
        $('[data-color="main-chart-color2"]').css({
            'background-color': color2
        });
        $('[data-color="main-chart-color3"]').css({
            'background-color': color3
        });
    }

    //Positioning tooltip
    function widget_tooltipPosition(id, top) {
        $('#' + id).bind("plothover", function(event, pos, item) {
            var widthToolTip = $('.tooltip-chart').width();
            if (item) {
                $(".tooltip-chart")
                    .css({
                        top: item.pageY - top,
                        left: item.pageX - (widthToolTip / 2)
                    })
                    .fadeIn(200);
            } else {
                $(".tooltip-chart").hide();
            }
        });
    }
</script>
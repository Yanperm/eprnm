<div id="vue-root">
    <div class="row">
        <div class="col-12 col-lg-6 col-xl-3">
            <div class="widget widget-tile">
                <div class="chart sparkline" id="spark1"></div>
                <div class="data-info">
                    <div class="desc">คิววันนี้</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span
                            class="number" data-toggle="counter"
                            data-end="<?php echo number_format($todayBooking); ?>">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
            <div class="widget widget-tile">
                <div class="chart sparkline" id="spark2"></div>
                <div class="data-info">
                    <div class="desc">คิวทั้งหมด</div>
                    <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-right"></span><span
                            class="number" data-toggle="counter" data-end="<?php echo $allBooking;?>"
                            data-suffix="">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
            <div class="widget widget-tile">
                <div class="chart sparkline" id="spark3"></div>
                <div class="data-info">
                    <div class="desc">Like</div>
                    <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-right"></span><span
                            class="number" data-toggle="counter" data-end="<?php echo $like;?>">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3">
            <div class="widget widget-tile">
                <div class="chart sparkline" id="spark4"></div>
                <div class="data-info">
                    <div class="desc">Page Visit</div>
                    <div class="value"><span class="indicator indicator-negative mdi mdi-chevron-right"></span><span
                            class="number" data-toggle="counter" data-end="<?php echo $pageVisit;?>">0</span>
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
                        <div class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><span
                                    class="icon mdi mdi-more-vert d-inline-block d-md-none"></span></a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" href="#">Week</a><a
                                    class="dropdown-item" href="#">Month</a><a class="dropdown-item" href="#">Year</a>
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
                    </div><span class="title">สถิติการใช้งานย้อนหลัง 30 วัน</span>
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
                    <vs-table :sst="true" v-model="selectedBooking" :data="recordBooking">
                        <template slot="thead">
                            <vs-th></vs-th>
                            <vs-th>
                                ผู้ป่วย
                            </vs-th>
                            <vs-th>
                                คิวที่
                            </vs-th>
                            <vs-th>
                                วันและเวลา
                            </vs-th>
                            <vs-th>
                                สถานะคิว
                            </vs-th>
                        </template>

                        <template slot-scope="{data}">
                            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                <vs-td :data="data[indextr].BOOKINGID">
                                    <vs-avatar v-if="data[indextr].IMAGE == null" :text="data[indextr].CUSTOMERNAME" />
                                    <vs-avatar v-else :src="data[indextr].IMAGE" />
                                </vs-td>
                                <vs-td :data="data[indextr].BOOKINGID">
                                    {{data[indextr].CUSTOMERNAME}}
                                </vs-td>
                                <vs-td :data="data[indextr].QUES">
                                    {{data[indextr].QUES}}
                                </vs-td>
                                <vs-td :data="data[indextr].BOOKDATE">
                                    <?php print_r(dateFormatThai('{{data[indextr].BOOKDATE}}'));?>
                                </vs-td>
                                <vs-td :data="data[indextr].BOOKINGID">
                                    <div class="centerx">
                                        <vs-tooltip text="ยืนยันการจอง">
                                            <vs-button color="rgba(112, 128, 144, 0.25)" type="filled" icon="check"
                                                @click="openConfirmAccept(data[indextr].BOOKINGID)"></vs-button>
                                        </vs-tooltip>
                                        <vs-tooltip text="ยกเลิกการจอง">
                                            <vs-button color="rgba(112, 128, 144, 0.25)" type="filled" icon="close"
                                                @click="openConfirmCancel(data[indextr].BOOKINGID)"></vs-button>
                                        </vs-tooltip>
                                    </div>
                                </vs-td>
                            </vs-tr>
                        </template>
                    </vs-table>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 ">
            <div class="card card-table ">
                <div class="card-header ">

                    <div class="tools" style="font-size: 14px;">
                        <a href="<?php echo base_url('/product');?>">
                            <vs-button color="primary" type="filled" icon="add_circle_outline">เพิ่มข้อมูลยา</vs-button>
                        </a>

                    </div>

                    <div class="title ">Monthly Top Sales</div>
                </div>
                <div class="card-body table-responsive ">

                    <vs-table :sst="true" v-model="selectedProduct" :data="recordProduct">
                        <template slot="thead">
                            <vs-th>
                                Product
                            </vs-th>
                            <vs-th>
                                จำนวนในคลัง
                            </vs-th>
                            <vs-th>
                                ราคา
                            </vs-th>
                            <vs-th>

                            </vs-th>
                        </template>

                        <template slot-scope="{data}">
                            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

                                <vs-td :data="data[indextr].CommonName">
                                    {{data[indextr].CommonName}}
                                </vs-td>
                                <vs-td :data="data[indextr].Digit">
                                    {{data[indextr].Digit}}
                                </vs-td>
                                <vs-td :data="data[indextr].PriceBuy">
                                    {{data[indextr].PriceBuy}}
                                </vs-td>
                                <vs-td :data="data[indextr].ProductID">
                                    <vs-tooltip text="เติมยาเข้าระบบ">
                                        <vs-button color="rgba(112, 128, 144, 0.25)" type="filled" icon="add">
                                        </vs-button>
                                    </vs-tooltip>
                                </vs-td>
                            </vs-tr>
                        </template>
                    </vs-table>
                </div>
            </div>
        </div>
        <!--END COMMENT2-->

    </div>
    <!--END ROW-->

</div>

<style>
#flot-placeholder div.xAxis div.tickLabel {
    max-width: 30px !important;
    top: 300px !important;
}

table .material-icons {
    font-size: 15px;
    color: #000000 !important;
    font-weight: 900;
}

.con-vs-avatar {
    font-size: 18px;
}
</style>

<script src="<?php echo base_url();?>assets/lib/jquery-flot/jquery.flot.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/jquery.flot.pie.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/jquery.flot.time.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js" type="text/javascript">
</script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/plugins/curvedLines.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/lib/jquery-flot/plugins/jquery.flot.tooltip.js" type="text/javascript">
</script>
<script src="<?php echo base_url();?>assets/lib/jquery.sparkline/jquery.sparkline.min.js" type="text/javascript">
</script>


<script>
const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            idSelect: null,
            selectedBooking: [],
            recordBooking: [],
            selectedProduct: [],
            recordProduct: [],
        }
    },
    mounted() {
        this.getDataBooking();
        this.getDataProduct();
    },
    methods: {
        getDataBooking() {
            axios.get("dashboard/getDataBooking").then((response) => {
                let pageData = [];

                if (response.data.result) {
                    for (let i = 0; i < response.data.data.length; i++) {
                        pageData = pageData.concat(response.data.data[i])
                    }
                }

                this.totalItems = pageData.length;
                this.recordBooking = pageData;
                this.selectedBooking = [];

            });
        },
        getDataProduct() {
            axios.get("dashboard/getDataProduct").then((response) => {
                let pageData = [];

                if (response.data.result) {
                    for (let i = 0; i < response.data.data.length; i++) {
                        pageData = pageData.concat(response.data.data[i])
                    }
                }

                this.totalItems = pageData.length;
                this.recordProduct = pageData;
                this.selectedProduct = [];

            });
        },
        openConfirmAccept(id) {
            this.idSelect = id;
            this.$vs.dialog({
                type: 'confirm',
                color: 'primary',
                title: `ยืนยันการการจอง`,
                text: 'ต้องการยืนยันการจองหรือไม่',
                acceptText: 'ตกลง',
                cancelText: 'ยกเลิก',
                accept: this.acceptBooking
            })
        },
        acceptBooking() {
            axios.post("dashboard/acceptBooking", {
                id: this.idSelect,
            }).then((response) => {
                if (response.data.result) {
                    this.$vs.notify({
                        color: 'primary',
                        title: 'ยืนยันการจองสำเร็จ',
                        text: 'ทำการยืนยันการจองสำเร็จ',
                        icon: 'check',
                        position: ' top-right',
                        time: 8000,
                    });
                    this.idSelect = null;
                    this.getDataBooking();
                } else {
                    this.$vs.notify({
                        title: 'ผิดพลาด',
                        text: 'กรุณาลองใหม่อีกครั้ง',
                        color: "warning",
                        icon: 'warning_amber',
                        position: ' top-right',
                    })
                }
            });
        },
        openConfirmCancel(id) {
            this.idSelect = id;
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: `ยืนยันการยกเลิกการจอง`,
                text: 'ต้องการยกเลิกการจองหรือไม่',
                acceptText: 'ตกลง',
                cancelText: 'ยกเลิก',
                accept: this.cancelBooking
            })
        },
        cancelBooking() {
            axios.post("dashboard/cancelBooking", {
                id: this.idSelect,
            }).then((response) => {
                if (response.data.result) {
                    this.$vs.notify({
                        color: 'primary',
                        title: 'ยกเลิกการจองสำเร็จ',
                        text: 'ทำการยกเลิกการจองสำเร็จ',
                        icon: 'check',
                        position: ' top-right',
                        time: 8000,
                    });
                    this.idSelect = null;
                    this.getDataBooking();
                } else {
                    this.$vs.notify({
                        title: 'ผิดพลาด',
                        text: 'กรุณาลองใหม่อีกครั้ง',
                        color: "warning",
                        icon: 'warning_amber',
                        position: ' top-right',
                    })
                }
            });
        },
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
        url: 'dashboard/getDataChart',
        data: {
            chartType: 'month'
        },
        dataType: "JSON", // data type expected from server
        success: function(response) {

            for (let i = 0; i < response.data.conversationRate.length; i++) {
                data2.push([new Date(response.data.conversationRate[i].DATE).getTime(), parseInt(response
                    .data.conversationRate[i].NUM)])
            }

            for (let i = 0; i < response.data.booking.length; i++) {
                data3.push([new Date(response.data.booking[i].DATE).getTime(), parseInt(response.data
                    .booking[i].NUM)])
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
                    content: "<div class='content-chart'> <span> %s </span> <div class='label'> <div class='label-x'> %x </div> - <div class='label-y'> %y.0 </div> </div></div>",
                    defaultTheme: false
                },
                colors: [color2, color3, color1],
                xaxis: {
                    mode: "time",
                    autoScaleMargin: 0,
                    // ticks: 30,
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
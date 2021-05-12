<div class="row">
    <div class="col-12 col-lg-6 col-xl-3">
        <div class="widget widget-tile">
            <div class="chart sparkline" id="spark1"></div>
            <div class="data-info">
                <div class="desc">Today Queue</div>
                <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span class="number" data-toggle="counter" data-end="<?php echo number_format($todayBooking); ?>">0</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-3">
        <div class="widget widget-tile">
            <div class="chart sparkline" id="spark2"></div>
            <div class="data-info">
                <div class="desc">Today Sales</div>
                <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span class="number" data-toggle="counter" data-end="86488" data-suffix="">0</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-3">
        <div class="widget widget-tile">
            <div class="chart sparkline" id="spark3"></div>
            <div class="data-info">
                <div class="desc">Patients YTD</div>
                <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span class="number" data-toggle="counter" data-end="4532">0</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-3">
        <div class="widget widget-tile">
            <div class="chart sparkline" id="spark4"></div>
            <div class="data-info">
                <div class="desc">Sales YTD</div>
                <div class="value"><span class="indicator indicator-negative mdi mdi-chevron-down"></span><span class="number" data-toggle="counter" data-end="1136788">0</span>
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
                    </div><span class="icon mdi mdi-chevron-down"></span><span class="icon toggle-loading mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span>
                </div>
                <div class="button-toolbar d-none d-md-block">
                    <div class="btn-group">
                        <button class="btn btn-secondary" type="button">Week</button>
                        <button class="btn btn-secondary active" type="button">Month</button>
                        <button class="btn btn-secondary" type="button">Year</button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-secondary" type="button">Today</button>
                    </div>
                </div><span class="title">Business Performance</span>
            </div>
            <div class="widget-chart-container">
                <div class="widget-chart-info">
                    <ul class="chart-legend-horizontal">
                        <li><span data-color="main-chart-color1"></span> This Year Sales</li>
                        <li><span data-color="main-chart-color2"></span> Last Year Sales</li>
                        <li><span data-color="main-chart-color3"></span> Patient Number</li>
                    </ul>
                </div>
                <div class="widget-counter-group widget-counter-group-right">
                    <div class="counter counter-big">
                        <div class="value">25%</div>
                        <div class="desc">Purchase</div>
                    </div>
                    <div class="counter counter-big">
                        <div class="value">5%</div>
                        <div class="desc">Plans</div>
                    </div>
                    <div class="counter counter-big">
                        <div class="value">5%</div>
                        <div class="desc">Services</div>
                    </div>
                </div>
                <div id="main-chart" style="height: 260px;"></div>
            </div>
            <div class="be-spinner">
                <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle class="circle" fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                </svg>
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
                <div class="tools dropdown"><span class="icon mdi mdi-download"></span><a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"><span class="icon mdi mdi-more-vert"></span></a>
                    <div class="dropdown-menu dropdown-menu-right" role="menu"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
                <div class="title">Appointment NOW!</div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th style="width:46%;">ผู้ป่วย</th>
                        <th style="width:30%;">สาเหตุที่มาพบแพทย์</th>
                        <th>วันและเวลา</th>
                        <!-- <th class="actions"></th> -->
                    </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($listToDay)):?>
                        <?php foreach ($listToDay as $item):?>
                          <tr>
                              <td class="user-avatar"> <img src="<?php echo base_url();?>assets/img/avatar6.png" alt="Avatar"><?php echo $item['CUSTOMERNAME']; ?></td>
                              <td><?php echo $item['DETAIL']; ?></td>
                              <td><?php echo $item['BOOKDATE']; ?></td>
                              <!-- <td class="actions"><a class="icon" href="#"><i class="mdi mdi-assignment"></i></a></td> -->
                          </tr>
                        <?php endforeach?>
                      <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--END COMMENT1-->








    <!--COMMENT2-->
    <div class="col-12 col-lg-6">
        <div class="card card-table">
            <div class="card-header">
                <div class="tools dropdown"> <span class="icon mdi mdi-download"></span><a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"><span class="icon mdi mdi-more-vert"></span></a>
                    <div class="dropdown-menu" role="menu"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
                <div class="title">Monthly Top Sales</div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th style="width:40%;">Product</th>
                        <th class="number">Price</th>
                        <th style="width:20%;">Qty</th>
                        <th style="width:20%;">Total</th>
                        <th class="actions" style="width:5%;"></th>
                    </tr>
                    </thead>
                    <tbody class="no-border-x">
                    <tr>
                        <td>Nurofen 400 mg 10 tabs</td>
                        <td class="number">45฿</td>
                        <td>3,000</td>
                        <td class="text-success">135,000</td>
                        <td class="actions"><a class="icon" href="#"><i class="mdi mdi-plus-circle-o"></i></a></td>
                    </tr>
                    <tr>
                        <td>Amoxycillin 500 mg 10 caps</td>
                        <td class="number">40฿</td>
                        <td>2,850</td>
                        <td class="text-success">114,000</td>
                        <td class="actions"><a class="icon" href="#"><i class="mdi mdi-plus-circle-o"></i></a></td>
                    </tr>
                    <tr>
                        <td>Zyrtec 10 mg 10 tabs</td>
                        <td class="number">120฿</td>
                        <td>936</td>
                        <td class="text-warning">112,320</td>
                        <td class="actions"><a class="icon" href="#"><i class="mdi mdi-plus-circle-o"></i></a></td>
                    </tr>
                    <tr>
                        <td>Norfox 400 mg 10 tabs</td>
                        <td class="number">45฿</td>
                        <td>2,177</td>
                        <td class="text-warning">97,965</td>
                        <td class="actions"><a class="icon" href="#"><i class="mdi mdi-plus-circle-o"></i></a></td>
                    </tr>
                    <tr>
                        <td>Arcoxia 90 mg 5 tabs</td>
                        <td class="number">225฿</td>
                        <td>394</td>
                        <td class="text-danger">88,650</td>
                        <td class="actions"><a class="icon" href="#"><i class="mdi mdi-plus-circle-o"></i></a></td>
                    </tr>
                    <tr>
                        <td>Voltaren 25 mg 10 tabs</td>
                        <td class="number">80฿</td>
                        <td>830</td>
                        <td class="text-danger">66,400</td>
                        <td class="actions"><a class="icon" href="#"><i class="mdi mdi-plus-circle-o"></i></a></td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div> <!--END COMMENT2-->

</div><!--END ROW-->


<div class="row">
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-header card-header-divider pb-3">User Channel</div>
            <div class="card-body pt-5">
                <div class="row user-progress user-progress-small">
                    <div class="col-lg-5"><span class="title">Web</span></div>
                    <div class="col-lg-7">
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 40%"></div>
                        </div>
                    </div>
                </div>
                <div class="row user-progress user-progress-small">
                    <div class="col-lg-5"><span class="title">iOS</span></div>
                    <div class="col-lg-7">
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
                <div class="row user-progress user-progress-small">
                    <div class="col-lg-5"><span class="title">Android</span></div>
                    <div class="col-lg-7">
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 30%"></div>
                        </div>
                    </div>
                </div>
                <div class="row user-progress user-progress-small">
                    <div class="col-lg-5"><span class="title">Phone</span></div>
                    <div class="col-lg-7">
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
                <div class="row user-progress user-progress-small">
                    <div class="col-lg-5"><span class="title">Staffs</span></div>
                    <div class="col-lg-7">
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="widget be-loading">
            <div class="widget-head">
                <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync toggle-loading"></span><span class="icon mdi mdi-close"></span></div>
                <div class="title">Sale Proportions</div>
            </div>
            <div class="widget-chart-container">
                <div id="top-sales" style="height: 178px;"></div>
                <div class="chart-pie-counter">36</div>
            </div>
            <div class="chart-legend">
                <table>
                    <tr>
                        <td class="chart-legend-color"><span data-color="top-sales-color1"></span></td>
                        <td>Medicine</td>
                        <td class="chart-legend-value">125</td>
                    </tr>
                    <tr>
                        <td class="chart-legend-color"><span data-color="top-sales-color2"></span></td>
                        <td>Laboratory</td>
                        <td class="chart-legend-value">1569</td>
                    </tr>
                    <tr>
                        <td class="chart-legend-color"><span data-color="top-sales-color3"></span></td>
                        <td>Procedure</td>
                        <td class="chart-legend-value">824</td>
                    </tr>
                </table>
            </div>
            <div class="be-spinner">
                <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle class="circle" fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                </svg>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="widget widget-calendar">
            <div id="calendar-widget"></div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-12 col-lg-6">


        <div class="card">
            <div class="card-header">Stock Movement</div>
            <div class="card-body">
                <ul class="user-timeline user-timeline-compact">
                    <li class="latest">
                        <div class="user-timeline-date">ให้ทำเป็น Graph </div>
                        <div class="user-timeline-title">ความเคลื่อนไหวของคลังสินค้า</div>
                        <div class="user-timeline-description">ใช้กราฟ Fullwidth Wave สีเขียว จาก graph Flot</div>
                    </li>
                    <li>
                        <div class="user-timeline-date"> <a href="charts-flot.html"> Link Graph Flot</a></div>
                        <div class="user-timeline-title">ใช้กราฟ Fullwidth Wave สีเขียว จาก graph Flot</div>
                        <div class="user-timeline-description">Vestibulum lectus nulla, maximus in eros non, tristique.</div>
                    </li>
                    <li>
                        <div class="user-timeline-date">Yesterday - 10:41</div>
                        <div class="user-timeline-title"><a href="charts-flot.html"> Link Graph Flot </a> </div>
                        <div class="user-timeline-description">Vestibulum lectus nulla, maximus in eros non, tristique.      </div>
                    </li>
                    <li>
                        <div class="user-timeline-date">Yesterday - 3:02</div>
                        <div class="user-timeline-title">Fix the Sidebar</div>
                        <div class="user-timeline-description">Vestibulum lectus nulla, maximus in eros non, tristique.</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>




    <div class="col-12 col-lg-6">
        <div class="widget be-loading">
            <div class="widget-head">
                <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync toggle-loading"></span><span class="icon mdi mdi-close"></span></div>
                <div class="title">Conversions</div>
            </div>
            <div class="widget-chart-container">
                <div class="widget-chart-info mb-4">
                    <div class="indicator indicator-positive float-right"><span class="icon mdi mdi-chevron-up"></span><span class="number">15%</span></div>
                    <div class="counter counter-inline">
                        <div class="value">156k</div>
                        <div class="desc">Impressions</div>
                    </div>
                </div>
                <div id="map-widget" style="height: 265px;"></div>
            </div>
            <div class="be-spinner">
                <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle class="circle" fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                </svg>
            </div>
        </div>
    </div>
</div>

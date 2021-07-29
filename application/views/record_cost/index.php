<div class="user-profile" id="vue-root">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="tab-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link " href="<?php echo base_url('recordHistory');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-assignment-account"></span>รายการตรวจวินิจฉัย</a></li>
                                <li class="nav-item"><a class="nav-link " href="<?php echo base_url('recordInformation');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-male"></span>ข้อมูลผู้ป่วย</a></li>
                                <li class="nav-item"><a class="nav-link " href="<?php echo base_url('recordPatient');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-local-hospital"></span>การรักษา</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('recordDrug');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-local-pharmacy"></span>ห้องยา</a></li>
                                <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('recordCost');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-card"></span>ค่าใช้จ่าย</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel">
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="invoice">
                                                        <div class="row invoice-header">
                                                            <div class="col-sm-7">
                                                                <div class="invoice-logo" style="background-repeat: no-repeat;background-size: 54px 51px;background-image: url(assets/img/nutmor_logo02.png);"></div>
                                                            </div>
                                                            <div class="col-sm-5 invoice-order"><span class="invoice-id">Invoice
                                                                    #<?php echo $bookingId;?></span><span class="incoice-date"><?php echo date("Y-m-d");?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row invoice-data">
                                                            <div class="col-sm-5 invoice-person">
                                                                <span class="name"><b><?php echo $clinic->CLINICNAME;?></b></span>
                                                                <span><?php echo $clinic->DOCTORNAME;?></span>
                                                                <span><?php echo $clinic->PROFICIENT;?></span>
                                                                <span><?php echo $clinic->ADDRESS;?></span>
                                                                <span><?php echo $clinic->PHONE;?></span></div>
                                                            <div class="col-sm-2 invoice-payment-direction"><i class="icon mdi mdi-chevron-right"></i></div>
                                                            <div class="col-sm-5 invoice-person">
                                                                <span class="name"><?php echo $member->CUSTOMERNAME;?></span>
                                                                <span><?php echo $member->PHONE;?></span>
                                                                <span><?php echo $member->LINEID;?></span>
                                                                <span><?php echo $member->EMAIL;?></span>
                                                            </div>
                                                            <div class="row col-lg-12 mt-5 mb-5">
                                                                <div class="col-lg-12">
                                                                    <table class="invoice-details">
                                                                        <tr>
                                                                            <th style="width:80%">รายการ</th>

                                                                            <th class="amount" style="width:20%">ราคา</th>
                                                                        </tr>
                                                                        <?php 
                                                                        $total = 0;
                                                                        if(!empty($diagnose)):?>
                                                                        <tr>
                                                                            <td colspan="2" class="description">
                                                                                <ul>
                                                                                    <li><b>Diagnose</b>
                                                                                        <ul style="color: #6d6b6b;">
                                                                                            <?php foreach($diagnose as $item):
                                                                                            $total += $item->PH5;
                                                                                            ?>
                                                                                            <li class="mt-2">
                                                                                                <?php echo $item->PH3;?><span style="float: right;"><?php echo number_format($item->PH5, 2);?></span>
                                                                                            </li>
                                                                                            <?php endforeach;?>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </td>

                                                                        </tr>
                                                                        <?php endif;?>
                                                                        <?php if(!empty($medical)):?>
                                                                        <tr>
                                                                            <td colspan="2" class="description">
                                                                                <ul>
                                                                                    <li><b>Medicine</b>
                                                                                        <ul style="color: #6d6b6b;">
                                                                                            <?php foreach($medical as $item):
                                                                                $total += $item->PH8;
                                                                            ?>
                                                                                            <li class="mt-2">
                                                                                                <?php echo $item->PH1;?><span style="float: right;"><?php echo number_format($item->PH8, 2);?></span>
                                                                                            </li>
                                                                                            <?php endforeach;?>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </td>
                                                                        </tr>
                                                                        <?php endif;?>
                                                                        <?php if(!empty($lab)):?>
                                                                        <tr>
                                                                            <td colspan="2" class="description">
                                                                                <ul>
                                                                                    <li><b>Laboratory</b>
                                                                                        <ul style="color: #6d6b6b;">
                                                                                            <?php foreach($lab as $item):
                                                                                $total += $item->PH4;
                                                                            ?>
                                                                                            <li class="mt-2">
                                                                                                <?php echo $item->PH1;?><span style="float: right;"><?php echo number_format($item->PH4, 2);?></span>
                                                                                            </li>
                                                                                            <?php endforeach;?>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </td>
                                                                        </tr>
                                                                        <?php endif;?>
                                                                        <?php if(!empty($procedure)):?>
                                                                        <tr>
                                                                            <td colspan="2" class="description">
                                                                                <ul>
                                                                                    <li><b>Procedure</b>
                                                                                        <ul style="color: #6d6b6b;">
                                                                                            <?php foreach($procedure as $item):
                                                                                $total += $item->PH3;
                                                                            ?>
                                                                                            <li class="mt-2">
                                                                                                <?php echo $item->PH2;?><span style="float: right;"><?php echo number_format($item->PH3, 2);?></span>
                                                                                            </li>
                                                                                            <?php endforeach;?>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </td>
                                                                        </tr>
                                                                        <?php endif;?>
                                                                        <?php if(!empty($certificateJob) || !empty($certificateSick)):?>
                                                                        <tr>
                                                                            <td colspan="2" class="description">
                                                                                <ul>
                                                                                    <li><b>Certificate</b>
                                                                                        <ul style="color: #6d6b6b;">
                                                                                            <?php if(!empty($certificateJob)):?>
                                                                                            <?php foreach($certificateJob as $item):
                                                                                $total += $item->Price;
                                                                            ?>
                                                                                            <li class="mt-2">
                                                                                                ค่าใบรับรองแพทย์ สำหรับสมัครงาน<span style="float: right;"><?php echo number_format($item->Price, 2);?></span>
                                                                                            </li>
                                                                                            <?php endforeach;?>
                                                                                            <?php endif;?>
                                                                                            <?php if(!empty($certificateSick)):?>
                                                                                            <?php foreach($certificateSick as $item):
                                                                                $total += $item->Price;
                                                                            ?>
                                                                                            <li class="mt-2">
                                                                                                ค่าใบรับรองแพทย์ สำหรับลาป่วย<span style="float: right;"><?php echo number_format($item->Price, 2);?></span>
                                                                                            </li>
                                                                                            <?php endforeach;?>
                                                                                            <?php endif;?>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </td>
                                                                        </tr>
                                                                        <?php endif;?>
                                                                        <tr>
                                                                            <td class="description">ส่วนลด</td>
                                                                            <td class="amount">0.00</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>

                                                                            <td class="amount total-value">
                                                                                <?php echo number_format($total, 2);?>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="row invoice-company-info">
                                                                <div class="col-md-6 col-lg-2 logo"><img style="width: 50px;" src="assets/img/nutmor_logo02.png" alt="Logo-symbol">
                                                                </div>
                                                                <div class="col-md-6 col-lg-4 summary"><span class="title"><?php echo $clinic->CLINICNAME;?></span>
                                                                    <p>
                                                                        <?php echo $clinic->DOCTORNAME;?>
                                                                    </p>
                                                                    <p>
                                                                        <?php echo $clinic->ADDRESS;?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-sm-6 col-lg-6 phone">
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <?php echo $clinic->PHONE;?>
                                                                        </li>
                                                                        <li>
                                                                            <?php echo $clinic->USERNAME;?>
                                                                        </li>

                                                                    </ul>
                                                                </div>

                                                            </div>
                                                            <div class="row invoice-footer col-lg-12">
                                                                <div class="col-lg-12">
                                                                    <button class="btn btn-lg btn-space btn-secondary">PDF</button>
                                                                    <button class="btn btn-lg btn-space btn-secondary">พิมพ์</button>
                                                                    <button class="btn btn-lg btn-space btn-primary">ชำระเงิน</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
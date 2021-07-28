<div class="user-profile" id="vue-root">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="tab-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link "
                                        href="<?php echo base_url('recordHistory');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-assignment-account"></span>รายการตรวจวินิจฉัย</a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?php echo base_url('recordInformation');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-male"></span>ข้อมูลผู้ป่วย</a></li>
                                <li class="nav-item"><a class="nav-link active"
                                        href="<?php echo base_url('recordPatient');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-local-hospital"></span>การรักษา</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="<?php echo base_url('recordDrug');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-local-pharmacy"></span>ห้องยา</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="<?php echo base_url('recordCost');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-card"></span>ค่าใช้จ่าย</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel">
                                    <div class="mt-2 mb-2">
                                        <div class="mt-2 mb-2">
                                            <a href="<?php echo base_url('recordPatient');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big "><i
                                                    class="icon mdi mdi-account-add"></i> Diagnose </a>
                                            <a href="<?php echo base_url('recordMedical');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big "><i
                                                    class="icon mdi mdi-hospital-alt"></i> Medicine </a>
                                            <a href="<?php echo base_url('recordLab');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big "><i
                                                    class="icon mdi mdi-eyedropper"></i> Laboratory </a>
                                            <a href="<?php echo base_url('recordProcedure');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big"><i
                                                    class="icon mdi mdi-airline-seat-flat-angled"></i> Procedure</a>
                                            <a href="<?php echo base_url('recordCertification');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big "><i
                                                    class="icon mdi mdi-file-text"></i> Certificate </a>
                                            <a href="<?php echo base_url('recordSummary');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big active"><i
                                                    class="icon mdi mdi-receipt"></i> Summary</a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <input type="hidden" id="id" value="<?php echo $member->MEMBERIDCARD;?>">
                                            <input type="hidden" id="bookingId" value="<?php echo $bookingId;?>">

                                            <div class="card-header card-header-divider">สรุปรายการ<span
                                                    class="card-subtitle">No. <?php echo $bookingId;?></span>
                                            </div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>รายการ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $total = 0;
                                                        if(!empty($diagnose)):?>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <li><b>Diagnose</b>
                                                                        <ul style="color: #6d6b6b;">
                                                                            <?php foreach($diagnose as $item):
                                                                                $total += $item->PH5;
                                                                            ?>
                                                                            <li class="mt-2">
                                                                                <?php echo $item->PH3;?><span
                                                                                    style="float: right;"><?php echo number_format($item->PH5, 2);?></span>
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
                                                            <td>
                                                                <ul>
                                                                    <li><b>Medicine</b>
                                                                        <ul style="color: #6d6b6b;">
                                                                            <?php foreach($medical as $item):
                                                                                $total += $item->PH8;
                                                                            ?>
                                                                            <li class="mt-2">
                                                                                <?php echo $item->PH1;?><span
                                                                                    style="float: right;"><?php echo number_format($item->PH8, 2);?></span>
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
                                                            <td>
                                                                <ul>
                                                                    <li><b>Laboratory</b>
                                                                        <ul style="color: #6d6b6b;">
                                                                            <?php foreach($lab as $item):
                                                                                $total += $item->PH4;
                                                                            ?>
                                                                            <li class="mt-2">
                                                                                <?php echo $item->PH1;?><span
                                                                                    style="float: right;"><?php echo number_format($item->PH4, 2);?></span>
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
                                                            <td>
                                                                <ul>
                                                                    <li><b>Procedure</b>
                                                                        <ul style="color: #6d6b6b;">
                                                                            <?php foreach($procedure as $item):
                                                                                $total += $item->PH3;
                                                                            ?>
                                                                            <li class="mt-2">
                                                                                <?php echo $item->PH2;?><span
                                                                                    style="float: right;"><?php echo number_format($item->PH3, 2);?></span>
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
                                                            <td>
                                                                <ul>
                                                                    <li><b>Certificate</b>
                                                                        <ul style="color: #6d6b6b;">
                                                                            <?php if(!empty($certificateJob)):?>
                                                                            <?php foreach($certificateJob as $item):
                                                                                $total += $item->Price;
                                                                            ?>
                                                                            <li class="mt-2">
                                                                                ค่าใบรับรองแพทย์ สำหรับสมัครงาน<span
                                                                                    style="float: right;"><?php echo number_format($item->Price, 2);?></span>
                                                                            </li>
                                                                            <?php endforeach;?>
                                                                            <?php endif;?>
                                                                            <?php if(!empty($certificateSick)):?>
                                                                            <?php foreach($certificateSick as $item):
                                                                                $total += $item->Price;
                                                                            ?>
                                                                            <li class="mt-2">
                                                                                ค่าใบรับรองแพทย์ สำหรับลาป่วย<span
                                                                                    style="float: right;"><?php echo number_format($item->Price, 2);?></span>
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
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-9">ส่วนลด</div>
                                                                    <div class="col-md-3"><input type="number"
                                                                            v-model="discount" @change="calculate"
                                                                            style="text-align: right;"
                                                                            class="form-control"></div>
                                                                </div>

                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td style="font-weight:bold">รวมทั้งสิ้น <span
                                                                    id="totalShow"
                                                                    style="float: right;"><?php echo number_format($total, 2);?></span>
                                                                <input type="hidden" value="<?php echo $total;?>"
                                                                    id="total">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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

<style>
.table {
    font-size: 15px;
}

.at-notification {
    z-index: 999999999 !important;
}

.vs-con-table table {
    font-size: 13px;
    width: 100%;
    border-collapse: collapse;
}

th {
    font-size: 14px;
}
</style>

<script>
const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            discount: 0
        }
    },
    methods: {
        calculate() {
            console.log(this.discount);

            $('#totalShow').html(($('#total').val() - this.discount).toFixed(2))
        }
    },

});
</script>
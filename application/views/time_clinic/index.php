<div>
    <h2 class="page-head-title">จัดการ เวลาเปิดปิด</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">จัดการ เวลาเปิดปิด</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="card-body">
                <!-- <div class="noSwipe"> -->
                </br>
                <div class="row">
                    <div class="textbox1">
                        <div class="raised-block">
                            <h4>วัน</h4>
                        </div>
                    </div>
                <div class="box">
                    <div class="raised-block">
                        <h4>เวลาเปิด</h4>
                    </div>
                </div>
                <div class="box">
                    <div class="raised-block">
                        <h4>เวลาปิด</h4>
                    </div>
                </div>
                </div>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="วันอาทิตย์" style="text-align: center;" readonly>
                        <input type="time" class="box" v-model="field.openSunday">
                        <input type="time" class="box" v-model="field.closeSunday">
                    </div>

                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="วันจันทร์" style="text-align: center;" readonly>
                        <input type="time" class="box" v-model="field.openMon">
                        <input type="time" class="box" v-model="field.closeMon">
                    </div>

                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="อังคาร" style="text-align: center;" readonly>
                        <input type="time" class="box" v-model="field.openTue">
                        <input type="time" class="box" v-model="field.closeTue">
                    </div>

                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="พุธ" style="text-align: center;" readonly>
                        <input type="time" class="box" v-model="field.openWed">
                        <input type="time" class="box" v-model="field.closeWed">
                    </div>

                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="พฤหัสบดี" style="text-align: center;" readonly>
                        <input type="time" class="box" v-model="field.openThu">
                        <input type="time" class="box" v-model="field.closeThu">
                    </div>

                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="ศุกร์" style="text-align: center;" readonly>
                        <input type="time" class="box" v-model="field.openFri">
                        <input type="time" class="box" v-model="field.closeFri">
                    </div>
                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="เสาร์" style="text-align: center;" readonly>
                        <input type="time" class="box" v-model="field.openSat">
                        <input type="time" class="box" v-model="field.closeSat">
                    </div>


                    <div class="centex mt-3">
                    <button type="submit" name="update" id="update"  class="btn btn-primary btn-lg" @click="save()" >บันทึกข้อมูล</button>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>

    
</div>
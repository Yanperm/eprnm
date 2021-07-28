<div>
    <h2 class="page-head-title">จัดการ</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">จัดการ SEO</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="card-body">
                <!-- <div class="noSwipe"> -->
                
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="วันอาทิตย์"  readonly>
                        <input type="time" class="resizedTextbox" v-model="field.openSunday">
                        <input type="time" class="resizedTextbox" v-model="field.closeSunday">
                    </div>

                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="วันจันทร์" readonly>
                        <input type="time" class="resizedTextbox" v-model="field.openMon">
                        <input type="time" class="resizedTextbox" v-model="field.closeMon">
                    </div>

                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="อังคาร"  readonly>
                        <input type="time" class="resizedTextbox" v-model="field.openTue">
                        <input type="time" class="resizedTextbox" v-model="field.closeTue">
                    </div>

                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="พุธ" readonly>
                        <input type="time" class="resizedTextbox" v-model="field.openWed">
                        <input type="time" class="resizedTextbox" v-model="field.closeWed">
                    </div>

                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="พฤหัสบดี"  readonly>
                        <input type="time" class="resizedTextbox" v-model="field.openThu">
                        <input type="time" class="resizedTextbox" v-model="field.closeThu">
                    </div>

                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="ศุกร์" readonly>
                        <input type="time" class="resizedTextbox" v-model="field.openFri">
                        <input type="time" class="resizedTextbox" v-model="field.closeFri">
                    </div>
                    </br>
                    <div>
                    <input type="text" class="resizedTextbox" placeholder="เสาร์" readonly>
                        <input type="time" class="resizedTextbox" v-model="field.openSat">
                        <input type="time" class="resizedTextbox" v-model="field.closeSat">
                    </div>


                    <div class="centex mt-3">
                    <button type="submit" name="update" id="update"  class="btn btn-default" @click="save()" >บันทึกข้อมูล</button>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>

    
</div>
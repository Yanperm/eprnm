<div>
    <h2 class="page-head-title">จัดการเวลาเปิดปิด</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">จัดการเวลาเปิดปิด</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="card-body">
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

                    
                    <br><br><br>
                    <hr>
                    <br><br>
                    <div class="col-md-12">
                    <h2 class="page-head-title">จัดการเวลาพิเศษ</h2>
                    </div>
                    <br><br>

                    
                   
                    <div class="row table-filters-container">
                        <div class="col-12 col-lg-12 col-xl-6">
                            <div class="row">
                                <div class="textbox2">
                                    <div class="raised-block">
                                    <h4>วัน</h4>
                                    </div>
                                </div>
                                <div class="box2">
                                    <div class="raised-block">
                                    <h4>เวลาเปิด</h4>
                                    </div>
                                </div>
                                <div class="box2">
                                    <div class="raised-block">
                                    <h4>เวลาปิด</h4>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="date" class="resizedTextbox2" v-model="field.date">
                                <input type="time" class="box2" v-model="field.open">
                                <input type="time" class="box2" v-model="field.close">
                            </div>

                            <br>
                            <div class="centex mt-3">
                                <button type="submit" name="insert" id="insert"  class="btn btn-primary btn-lg" @click="insert()" >บันทึกข้อมูล</button>
                            </div>
                            
                        </div>
               
                                    <div class="col-12 col-lg-12 col-xl-6">
                                        <vs-table :sst="true" @sort="handleSort" v-model="selected" :total="totalItems" :max-items="perPage" :data="recordData" @change="changeColor($event.target.value,'primary')" >
                                            <template slot="thead">
                                                <vs-th sort-key="text">
                                                    วันที่
                                                </vs-th>
                                                <vs-th sort-key="text">
                                                    เวลาเปิด
                                                </vs-th>
                                                <vs-th sort-key="text">
                                                    เวลาปิด
                                                </vs-th>
                                                <vs-th class="centerx">
                                                     จัดการ
                                                </vs-th>
                                            </template>
                                            <template slot-scope="{data}">
                                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
                                                    <vs-td :data="data[indextr].date">
                                                        {{data[indextr].date}}
                                                    </vs-td>
                                                     <vs-td :data="data[indextr].time_open">
                                                        {{data[indextr].time_open}}
                                                    </vs-td>
                                                    <vs-td :data="data[indextr].time_close">
                                                        {{data[indextr].time_close}}
                                                    </vs-td>
                                   
                                                    <vs-td :data="data[indextr].date">
                                                        <div class="centerx">
                                                            <vs-tooltip text="ลบข้อมูล">
                                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled" icon="delete" @click="openConfirm()"></vs-button>
                                                            </vs-tooltip>
                                                        </div>
                                                    </vs-td>
                                                </vs-tr>
                                            </template>
                                        </vs-table>
                                            <vs-pagination class="mt-4" :total="pagination.last_page" v-model="page"></vs-pagination>
                                    </div>

                       
            </div>
        </div>
    </div>
</div>



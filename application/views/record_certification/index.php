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
                                                class="btn btn-space btn-secondary btn-big"><i
                                                    class="icon mdi mdi-eyedropper"></i> Laboratory </a>
                                            <a href="<?php echo base_url('recordProcedure');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big "><i
                                                    class="icon mdi mdi-airline-seat-flat-angled"></i> Procedure</a>
                                            <a href="<?php echo base_url('recordCertification');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big active"><i
                                                    class="icon mdi mdi-file-text"></i> Certificate </a>
                                            <a href="<?php echo base_url('recordSummary');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big"><i
                                                    class="icon mdi mdi-receipt"></i> Summary</a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="card">

                                            <input type="hidden" id="id" value="<?php echo $member->MEMBERIDCARD;?>">
                                            <input type="hidden" id="bookingId" value="<?php echo $bookingId;?>">
                                            <vs-tabs>
                                                <vs-tab label="ใบรับรองแพทย์ สมัครงาน">
                                                    <div class="con-tab-ejemplo">
                                                        <vs-row vs-w="12">
                                                            <vs-col vs-offset="10">

                                                                <vs-button color="primary" type="filled"
                                                                    @click="popupActiveJob=true,actionJob='insert'"
                                                                    icon="add_circle_outline">เพิ่มข้อมูล</vs-button>
                                                            </vs-col>
                                                        </vs-row>
                                                        <vs-table :sst="true" @search="handleSearchJob"
                                                            @sort="handleSortJob" v-model="selectedJob"
                                                            :total="totalItemsJob" :max-items="perPageJob" search
                                                            :data="recordDataJob">
                                                            <template slot="header">
                                                                <h4>
                                                                    ใบรับรองแพทย์ สมัครงาน
                                                                </h4>
                                                            </template>
                                                            <template slot="thead">
                                                                <vs-th sort-key="tbpatient_job.CREATE">
                                                                    วันที่
                                                                </vs-th>
                                                                <vs-th sort-key="BOOKINGID">
                                                                    VN
                                                                </vs-th>
                                                                <vs-th sort-key="Recommendation">
                                                                    คำแนะนำ
                                                                </vs-th>
                                                                <vs-th sort-key="Price">
                                                                    ราคา
                                                                </vs-th>
                                                                <vs-th style="text-align: center;">
                                                                    จัดการข้อมูล
                                                                </vs-th>
                                                            </template>

                                                            <template slot-scope="{data}">
                                                                <vs-tr :data="tr" :key="indextr"
                                                                    v-for="(tr, indextr) in data">
                                                                    <vs-td :data="data[indextr].CREATE">
                                                                        {{data[indextr].CREATE}}
                                                                    </vs-td>
                                                                    <vs-td :data="data[indextr].BOOKINGID">
                                                                        {{data[indextr].BOOKINGID}}
                                                                    </vs-td>
                                                                    <vs-td :data="data[indextr].Recommendation">
                                                                        {{data[indextr].Recommendation}}
                                                                    </vs-td>
                                                                    <vs-td :data="data[indextr].Price">
                                                                        {{data[indextr].Price}}
                                                                    </vs-td>
                                                                    <vs-td :data="data[indextr].JobID">
                                                                        <div class="centerx">
                                                                            <vs-tooltip text="พิมพ์">
                                                                                <vs-button
                                                                                    color="rgba(112, 128, 144, 0.25)"
                                                                                    type="filled" icon="print"
                                                                                    @click="popupActiveJob=true,actionJob='update'">
                                                                                </vs-button>
                                                                            </vs-tooltip>
                                                                            <vs-tooltip text="แก้ไข">
                                                                                <vs-button
                                                                                    color="rgba(112, 128, 144, 0.25)"
                                                                                    type="filled" icon="edit_note"
                                                                                    @click="popupActiveJob=true,actionJob='update'">
                                                                                </vs-button>
                                                                            </vs-tooltip>
                                                                            <vs-tooltip text="ลบข้อมูล">
                                                                                <vs-button
                                                                                    color="rgba(112, 128, 144, 0.25)"
                                                                                    type="filled" icon="delete"
                                                                                    @click="openConfirmJob()">
                                                                                </vs-button>
                                                                            </vs-tooltip>
                                                                        </div>
                                                                    </vs-td>
                                                                </vs-tr>
                                                            </template>
                                                        </vs-table>
                                                        <vs-pagination class="mt-4" :total="paginationJob.last_page"
                                                            v-model="pageJob"></vs-pagination>
                                                    </div>
                                                </vs-tab>
                                                <vs-tab label="ใบรับรองแพทย์ ลางาน">
                                                    <div class="con-tab-ejemplo">
                                                        <vs-row vs-w="12">
                                                            <vs-col vs-offset="10">
                                                                <vs-button color="primary" type="filled"
                                                                    @click="popupActiveSick=true,actionSick='insert'"
                                                                    icon="add_circle_outline">เพิ่มข้อมูล</vs-button>
                                                            </vs-col>
                                                        </vs-row>
                                                        <vs-table :sst="true" @search="handleSearchSick"
                                                            @sort="handleSortSick" v-model="selectedSick"
                                                            :total="totalItemsSick" :max-items="perPageSick" search
                                                            :data="recordDataSick">
                                                            <template slot="header">
                                                                <h4>
                                                                    ใบรับรองแพทย์ ลางาน
                                                                </h4>
                                                            </template>
                                                            <template slot="thead">
                                                                <vs-th sort-key="tbpatient_sick.CREATE">
                                                                    วันที่
                                                                </vs-th>
                                                                <vs-th sort-key="BOOKINGID">
                                                                    VN
                                                                </vs-th>
                                                                <vs-th sort-key="Dayoff">
                                                                    รายละเอียด
                                                                </vs-th>
                                                                <vs-th sort-key="Recommendation">
                                                                    คำแนะนำ
                                                                </vs-th>
                                                                <vs-th sort-key="Price">
                                                                    ราคา
                                                                </vs-th>
                                                                <vs-th style="text-align: center;">
                                                                    จัดการข้อมูล
                                                                </vs-th>
                                                            </template>

                                                            <template slot-scope="{data}">
                                                                <vs-tr :data="tr" :key="indextr"
                                                                    v-for="(tr, indextr) in data">
                                                                    <vs-td :data="data[indextr].CREATE">
                                                                        {{data[indextr].CREATE}}
                                                                    </vs-td>
                                                                    <vs-td :data="data[indextr].BOOKINGID">
                                                                        {{data[indextr].BOOKINGID}}
                                                                    </vs-td>

                                                                    <vs-td :data="data[indextr].Dayoff">
                                                                         <p>ระยะเวลา : {{data[indextr].Dayoff}} วัน</p>
                                                                        <p style="color: #929292;"> ตั้งแต่
                                                                            {{data[indextr].Startdate}} จนถึง
                                                                            {{data[indextr].Enddate}}</p>

                                                                    </vs-td>

                                                                    <vs-td :data="data[indextr].Recommendation">
                                                                        {{data[indextr].Recommendation}}
                                                                    </vs-td>
                                                                    <vs-td :data="data[indextr].Price">
                                                                        {{data[indextr].Price}}
                                                                    </vs-td>

                                                                    <vs-td :data="data[indextr].SickID">
                                                                        <div class="centerx">
                                                                            <vs-tooltip text="พิมพ์">
                                                                                <vs-button
                                                                                    color="rgba(112, 128, 144, 0.25)"
                                                                                    type="filled" icon="print"
                                                                                    @click="popupActiveSick=true,actionSick='update'">
                                                                                </vs-button>
                                                                            </vs-tooltip>
                                                                            <vs-tooltip text="แก้ไข">
                                                                                <vs-button
                                                                                    color="rgba(112, 128, 144, 0.25)"
                                                                                    type="filled" icon="edit_note"
                                                                                    @click="popupActiveSick=true,actionSick='update'">
                                                                                </vs-button>
                                                                            </vs-tooltip>
                                                                            <vs-tooltip text="ลบข้อมูล">
                                                                                <vs-button
                                                                                    color="rgba(112, 128, 144, 0.25)"
                                                                                    type="filled" icon="delete"
                                                                                    @click="openConfirmSick()">
                                                                                </vs-button>
                                                                            </vs-tooltip>
                                                                        </div>
                                                                    </vs-td>
                                                                </vs-tr>
                                                            </template>
                                                        </vs-table>
                                                        <vs-pagination class="mt-4" :total="paginationSick.last_page"
                                                            v-model="pageSick"></vs-pagination>
                                                    </div>
                                                </vs-tab>
                                            </vs-tabs>
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

    <vs-popup class="holamundo" title="Medical Certification" :active.sync="popupActiveJob">
        <div class="row">
            <div class="col-md-12">
                <h3>ส่วนที่ 1 ประวัติสุขภาพ</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">1. โรคประจำตัว</label>
            </div>
            <div class="col-md-2">
                <vs-switch v-model="fieldJob.diseases" size="large">
                    <span slot="on">มี</span>
                    <span slot="off">ไม่มี</span>
                </vs-switch>
            </div>
            <div class="col-md-6">
                <div class="centerx labelx" v-if="fieldJob.diseases">
                    <vs-input label="ระบุ" size="large" v-model="fieldJob.diseasesDetail" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">2. อุบัติเหตุและผ่าตัด</label>
            </div>
            <div class="col-md-2">
                <vs-switch v-model="fieldJob.accident" size="large">
                    <span slot="on">มี</span>
                    <span slot="off">ไม่มี</span>
                </vs-switch>
            </div>
            <div class="col-md-6">
                <div class="centerx labelx" v-if="fieldJob.accident">
                    <vs-input label="ระบุ" size="large" v-model="fieldJob.accidentDetail" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">3. เคยเข้ารับการรักษาในโรงพยาบาล</label>
            </div>
            <div class="col-md-2">
                <vs-switch v-model="fieldJob.hospital" size="large">
                    <span slot="on">มี</span>
                    <span slot="off">ไม่มี</span>
                </vs-switch>
            </div>
            <div class="col-md-6">
                <div class="centerx labelx" v-if="fieldJob.hospital">
                    <vs-input label="ระบุ" size="large" v-model="fieldJob.hospitalDetail" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">4. ประวัติอื่นที่สำคัญ</label>
            </div>
            <div class="col-md-2">
                <vs-switch v-model="fieldJob.others" size="large">
                    <span slot="on">มี</span>
                    <span slot="off">ไม่มี</span>
                </vs-switch>
            </div>
            <div class="col-md-6">
                <div class="centerx labelx" v-if="fieldJob.others">
                    <vs-input label="ระบุ" size="large" v-model="fieldJob.othersDetail" />
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h3>ส่วนที่ 2 ของแพทย์</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">สภาพร่างกายทั่วไปอยู่ในเกณฑ์</label>
            </div>
            <div class="col-md-3">
                <vs-switch v-model="fieldJob.health" size="large">
                    <span slot="on">ผิดปกติ</span>
                    <span slot="off">ปกติ</span>
                </vs-switch>
            </div>
            <div class="col-md-5">
                <div class="centerx labelx" v-if="fieldJob.health">
                    <vs-input label="ระบุ" size="large" v-model="fieldJob.healthDetail" />
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <vs-textarea label="อาการแสดงของโรค อื่นๆ" v-model="fieldJob.otherSymptoms" />
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <vs-textarea label="สรุปความเห็นและข้อแนะนำของแพทย์" v-model="fieldJob.recommend" />
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col-lg-12">
                <vs-input label="ราคา (บาท)" placeholder="" v-model="fieldJob.price" />
            </div>
        </div>
        <div class="row centex mt-3">
            <vs-button type="relief" @click="saveJob">บันทึกข้อมูล</vs-button>
        </div>

    </vs-popup>

    <vs-popup class="holamundo" title="Medical Certification" :active.sync="popupActiveSick">
        <div class="row">
            <div class="col-lg-4">
                <p class="mb-0">สมควรให้พักรักษาตัวเป็นเวลา</p>
                <at-input v-model="fieldSick.numOfSick" placeholder="" prepend-button>
                    <template slot="append">
                        <span>วัน</span>
                    </template>
                </at-input>
            </div>
            <div class="col-lg-4">
                <p class="mb-0">ตั้งแต่วันที่</p>
                <b-form-datepicker size="sm" id="example-datepicker" locale="th-TH" v-model="fieldSick.startDate"
                    :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }" class="mb-2">
                </b-form-datepicker>
            </div>
            <div class="col-lg-4">
                <p class="mb-0">จนถึงวันที่</p>
                <b-form-datepicker size="sm" id="example-datepicker2" locale="th-TH" v-model="fieldSick.endDate"
                    :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }" class="mb-2">
                </b-form-datepicker>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <vs-textarea label="คำแนะนำของแพทย์" v-model="fieldSick.recommend" />
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col-lg-12">
                <vs-input label="ราคา (บาท)" placeholder="" v-model="fieldSick.price" />
            </div>
        </div>

        <div class="row centex mt-3">
            <vs-button type="relief" @click="saveSick">บันทึกข้อมูล</vs-button>
        </div>
    </vs-popup>
</div>

<style>
.at-notification {
    z-index: 999999999 !important;
}

.vs-con-table table {
    font-size: 13px;
    width: 100%;
    border-collapse: collapse;
}

.vs-switch {
    margin: 3px;
    width: 88px !important;
}

.vs-switch--text {

    font-size: 14px;
}

th {
    font-size: 14px;
}
</style>
<link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue-icons.min.js"></script>
<script>
const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            actionJob: null,
            popupActiveJob: false,
            idJob: null,
            fieldJob: {
                diseases: null,
                diseasesDetail: null,
                accident: null,
                accidentDetail: null,
                hospital: null,
                hospitalDetail: null,
                others: null,
                othersDetail: null,
                health: null,
                healthDetail: null,
                otherSymptoms: null,
                recommend: null,
                price: null,
            },
            pageJob: 1,
            perPageJob: 5,
            searchJob: '',
            sortByJob: '',
            sortTypeJob: '',
            selectedJob: [],
            totalItemsJob: 0,
            recordDataJob: [],
            paginationJob: {
                last_page: 0,
            },
            actionSick: null,
            selectedDate: null,
            popupActiveSick: false,
            idSick: null,
            fieldSick: {
                numOfSick: null,
                startDate: null,
                endDate: null,
                recommend: null,
                price: null
            },
            pageSick: 1,
            perPageSick: 5,
            searchSick: '',
            sortBySick: '',
            sortTypeSick: '',
            selectedSick: [],
            totalItemsSick: 0,
            recordDataSick: [],
            paginationSick: {
                last_page: 0,
            },
        }
    },
    mounted() {
        this.getDataJob();
        this.getDataSick();
    },
    watch: {
        pageSick: function(val) {
            this.getDataSick();
            this.pageSick = val;
        },
        selectedSick: function(val) {
            this.idSick = val.SickID;
            this.fieldSick.numOfSick = val.Dayoff;
            this.fieldSick.recommend = val.Recommendation;
            this.fieldSick.price = val.Price;
            this.fieldSick.startDate = val.Startdate;
            this.fieldSick.endDate = val.Enddate;
        },
        pageJob: function(val) {
            this.getDataJob();
            this.pageJob = val;
        },
        selectedJob: function(val) {
            this.idJob = val.JobID;
            this.fieldJob.diseases = val.DiseasesDetail ? true : null;
            this.fieldJob.diseasesDetail = val.DiseasesDetail;
            this.fieldJob.accident = val.AccidentDetail ? true : null;
            this.fieldJob.accidentDetail = val.AccidentDetail;
            this.fieldJob.hospital = val.HospitalDetail ? true : null;
            this.fieldJob.hospitalDetail = val.HospitalDetail;
            this.fieldJob.others = val.OthersDetail ? true : null;
            this.fieldJob.othersDetail = val.OthersDetail;
            this.fieldJob.health = val.BodyHealthDetail ? true : null;
            this.fieldJob.healthDetail = val.BodyHealthDetail;
            this.fieldJob.otherSymptoms = val.OtherSymptoms;
            this.fieldJob.recommend = val.Recommendation;
            this.fieldJob.price = val.Price;
        },
        popupActiveJob: function() {
            if (this.actionJob === "insert") {
                this.idJob = null;
                this.fieldJob.diseases = null;
                this.fieldJob.diseasesDetail = null;
                this.fieldJob.accident = null;
                this.fieldJob.accidentDetail = null;
                this.fieldJob.hospital = null;
                this.fieldJob.hospitalDetail = null;
                this.fieldJob.others = null;
                this.fieldJob.othersDetail = null;
                this.fieldJob.health = null;
                this.fieldJob.healthDetail = null;
                this.fieldJob.otherSymptoms = null;
                this.fieldJob.recommend = null;
                this.fieldJob.price = null;
            } else {
                this.idJob = this.selectedJob.JobID;
                this.fieldJob.diseases = this.selectedJob.DiseasesDetail ? true : null;
                this.fieldJob.diseasesDetail = this.selectedJob.DiseasesDetail;
                this.fieldJob.accident = this.selectedJob.AccidentDetail ? true : null;;
                this.fieldJob.accidentDetail = this.selectedJob.AccidentDetail;
                this.fieldJob.hospital = this.selectedJob.HospitalDetail ? true : null;
                this.fieldJob.hospitalDetail = this.selectedJob.HospitalDetail;
                this.fieldJob.others = this.selectedJob.OthersDetail ? true : null;
                this.fieldJob.othersDetail = this.selectedJob.OthersDetail;
                this.fieldJob.health = this.selectedJob.BodyHealthDetail ? true : null;
                this.fieldJob.healthDetail = this.selectedJob.BodyHealthDetail;
                this.fieldJob.otherSymptoms = this.selectedJob.OtherSymptoms;
                this.fieldJob.recommend = this.selectedJob.Recommendation;
                this.fieldJob.price = this.selectedJob.Price;
            }
        },
        popupActiveSick: function() {
            if (this.actionSick == "insert") {
                this.idSick = null;
                this.fieldSick.numOfSick = null;
                this.fieldSick.recommend = null;
                this.fieldSick.price = null;
                this.fieldSick.startDate = null;
                this.fieldSick.endDate = null;
            }
        }
    },
    methods: {
        diseasesCheck() {
            diseasesCheck: true;
        },

        handleSearchJob(searching) {
            this.searchJob = searching;
            this.getDataJob();
        },
        handleSortJob(key, active) {
            this.sortByJob = key;
            this.sortTypeJob = active;
            this.getDataJob();
        },
        handleSearchSick(searching) {
            this.searchSick = searching;
            this.getDataSick();
        },
        handleSortSick(key, active) {
            this.sortBySick = key;
            this.sortTypeSick = active;
            this.getDataSick();
        },
        getDataJob() {
            axios.get("recordCertification/getDataJob", {
                params: {
                    search: this.searchJob,
                    sortBy: this.sortByJob,
                    sortType: this.sortTypeJob,
                    page: this.pageJob,
                    perPage: this.perPageJob,
                    memberId: $('#id').val(),
                }
            }).then((response) => {
                let pageData = [];

                if (response.data.result) {
                    for (let i = 0; i < response.data.data.length; i++) {
                        pageData = pageData.concat(response.data.data[i])
                    }

                    this.paginationJob.last_page = Math.ceil(parseInt(response.data.total) / this
                        .perPageJob);
                } else {
                    this.paginationJob.last_page = 0;
                }
                this.totalItemsJob = pageData.length;
                this.recordDataJob = pageData;
            });
        },
        getDataSick() {
            axios.get("recordCertification/getDataSick", {
                params: {
                    search: this.searchSick,
                    sortBy: this.sortBySick,
                    sortType: this.sortTypeSick,
                    page: this.pageSick,
                    perPage: this.perPageSick,
                    memberId: $('#id').val(),
                }
            }).then((response) => {
                let pageData = [];

                if (response.data.result) {
                    for (let i = 0; i < response.data.data.length; i++) {
                        pageData = pageData.concat(response.data.data[i])
                    }

                    this.paginationSick.last_page = Math.ceil(parseInt(response.data.total) / this
                        .perPageSick);
                } else {
                    this.paginationSick.last_page = 0;
                }
                this.totalItemsSick = pageData.length;
                this.recordDataSick = pageData;
            });
        },
        saveSick() {
            if (this.actionSick === 'insert') {
                axios.post("recordCertification/insertSick", {
                    numOfSick: this.fieldSick.numOfSick,
                    startDate: this.fieldSick.startDate,
                    endDate: this.fieldSick.endDate,
                    recommend: this.fieldSick.recommend,
                    price: this.fieldSick.price,
                    memberId: $('#id').val(),
                    bookingId: $('#bookingId').val(),
                }).then((response) => {
                    if (response.data.result) {
                        this.getDataSick();
                        this.popupActiveSick = false;
                        this.fieldSick.numOfSick = null;
                        this.fieldSick.startDate = null;
                        this.fieldSick.endDate = null;
                        this.fieldSick.recommend = null;
                        this.fieldSick.price = null;
                        this.$vs.notify({
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลข้อมูลทั่วไปสำเร็จ',
                            color: "success",
                            icon: 'check',
                            position: 'top-right',
                        })
                    } else {
                        this.$vs.notify({
                            title: 'ผิดพลาด',
                            text: 'กรุณาลองใหม่อีกครั้ง',
                            color: "warning",
                            icon: 'warning_amber',
                            position: 'top-right',
                        })
                    }
                });
            } else if (this.actionSick === 'update') {
                axios.post("recordCertification/updateSick", {
                    numOfSick: this.fieldSick.numOfSick,
                    startDate: this.fieldSick.startDate,
                    endDate: this.fieldSick.endDate,
                    recommend: this.fieldSick.recommend,
                    price: this.fieldSick.price,
                    id: this.idSick,
                }).then((response) => {
                    if (response.data.result) {
                        this.getDataSick();
                        this.popupActiveSick = false;
                        this.selectedSick = [];
                        this.fieldSick.numOfSick = null;
                        this.fieldSick.startDate = null;
                        this.fieldSick.endDate = null;
                        this.fieldSick.recommend = null;
                        this.fieldSick.price = null;
                        this.$vs.notify({
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลสำเร็จ',
                            color: "success",
                            icon: 'check',
                            position: 'top-right',
                        })
                    } else {
                        this.$vs.notify({
                            title: 'ผิดพลาด',
                            text: 'กรุณาลองใหม่อีกครั้ง',
                            color: "warning",
                            icon: 'warning_amber',
                            position: 'top-right',
                        })
                    }
                });
            }

        },
        saveJob() {
            if (this.actionJob === 'insert') {
                axios.post("recordCertification/insertJob", {
                    diseases: this.fieldJob.diseases,
                    diseasesDetail: this.fieldJob.diseasesDetail,
                    accident: this.fieldJob.accident,
                    accidentDetail: this.fieldJob.accidentDetail,
                    hospital: this.fieldJob.hospital,
                    hospitalDetail: this.fieldJob.hospitalDetail,
                    others: this.fieldJob.others,
                    othersDetail: this.fieldJob.othersDetail,
                    health: this.fieldJob.health,
                    healthDetail: this.fieldJob.healthDetail,
                    otherSymptoms: this.fieldJob.otherSymptoms,
                    recommend: this.fieldJob.recommend,
                    price: this.fieldJob.price,
                    memberId: $('#id').val(),
                    bookingId: $('#bookingId').val(),
                }).then((response) => {
                    if (response.data.result) {
                        this.getDataJob();
                        this.popupActiveJob = false;
                        this.fieldJob.diseases = null;
                        this.fieldJob.diseasesDetail = null;
                        this.fieldJob.accident = null;
                        this.fieldJob.accidentDetail = null;
                        this.fieldJob.hospital = null;
                        this.fieldJob.hospitalDetail = null;
                        this.fieldJob.others = null;
                        this.fieldJob.othersDetail = null;
                        this.fieldJob.health = null;
                        this.fieldJob.healthDetail = null;
                        this.fieldJob.otherSymptoms = null;
                        this.fieldJob.recommend = null;
                        this.fieldJob.price = null;
                        this.$vs.notify({
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลสำเร็จ',
                            color: "success",
                            icon: 'check',
                            position: 'top-right',
                        })
                    } else {
                        this.$vs.notify({
                            title: 'ผิดพลาด',
                            text: 'กรุณาลองใหม่อีกครั้ง',
                            color: "warning",
                            icon: 'warning_amber',
                            position: 'top-right',
                        })
                    }
                });
            } else if (this.actionJob === 'update') {
                axios.post("recordCertification/updateJob", {
                    diseases: this.fieldJob.diseases,
                    diseasesDetail: this.fieldJob.diseasesDetail,
                    accident: this.fieldJob.accident,
                    accidentDetail: this.fieldJob.accidentDetail,
                    hospital: this.fieldJob.hospital,
                    hospitalDetail: this.fieldJob.hospitalDetail,
                    others: this.fieldJob.others,
                    othersDetail: this.fieldJob.othersDetail,
                    health: this.fieldJob.health,
                    healthDetail: this.fieldJob.healthDetail,
                    otherSymptoms: this.fieldJob.otherSymptoms,
                    recommend: this.fieldJob.recommend,
                    price: this.fieldJob.price,
                    id: this.idJob,
                }).then((response) => {
                    if (response.data.result) {
                        this.getDataJob();
                        this.popupActiveJob = false;
                        this.selectedJob = [];
                        this.popupActiveJob = false;
                        this.fieldJob.diseases = null;
                        this.fieldJob.diseasesDetail = null;
                        this.fieldJob.accident = null;
                        this.fieldJob.accidentDetail = null;
                        this.fieldJob.hospital = null;
                        this.fieldJob.hospitalDetail = null;
                        this.fieldJob.others = null;
                        this.fieldJob.othersDetail = null;
                        this.fieldJob.health = null;
                        this.fieldJob.healthDetail = null;
                        this.fieldJob.otherSymptoms = null;
                        this.fieldJob.recommend = null;
                        this.fieldJob.price = null;
                        this.$vs.notify({
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลสำเร็จ',
                            color: "success",
                            icon: 'check',
                            position: 'top-right',
                        })
                    } else {
                        this.$vs.notify({
                            title: 'ผิดพลาด',
                            text: 'กรุณาลองใหม่อีกครั้ง',
                            color: "warning",
                            icon: 'warning_amber',
                            position: 'top-right',
                        })
                    }
                });
            }

        },
        openConfirmJob() {
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: `ยืนยันการลบข้อมูล`,
                text: 'ต้องการลบข้อมูลหรือไม่',
                acceptText: 'ตกลง',
                cancelText: 'ยกเลิก',
                accept: this.acceptAlertJob
            })
        },
        acceptAlertJob() {
            axios.post("recordCertification/deleteJob", {
                id: this.idJob,
            }).then((response) => {
                if (response.data.result) {
                    this.$vs.notify({
                        color: 'success',
                        title: 'ลบข้อมูลสำเร็จ',
                        text: 'ทำการลบข้อมูลสำเร็จ',
                        icon: 'check',
                        position: 'top-right',
                    });
                    this.getDataJob();
                    this.selectedJob = [];
                } else {
                    this.$vs.notify({
                        title: 'ผิดพลาด',
                        text: 'กรุณาลองใหม่อีกครั้ง',
                        color: "warning",
                        icon: 'warning_amber',
                        position: 'top-right',
                    })
                }
            });
        },
        openConfirmSick() {
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: `ยืนยันการลบข้อมูล`,
                text: 'ต้องการลบข้อมูลหรือไม่',
                acceptText: 'ตกลง',
                cancelText: 'ยกเลิก',
                accept: this.acceptAlertSick
            })
        },
        acceptAlertSick() {
            axios.post("recordCertification/deleteSick", {
                id: this.idSick,
            }).then((response) => {
                if (response.data.result) {
                    this.$vs.notify({
                        color: 'success',
                        title: 'ลบข้อมูลสำเร็จ',
                        text: 'ทำการลบข้อมูลสำเร็จ',
                        icon: 'check',
                        position: 'top-right',
                    });
                    this.getDataSick();
                    this.selectedSick = [];
                } else {
                    this.$vs.notify({
                        title: 'ผิดพลาด',
                        text: 'กรุณาลองใหม่อีกครั้ง',
                        color: "warning",
                        icon: 'warning_amber',
                        position: 'top-right',
                    })
                }
            });
        },

    },
});
</script>
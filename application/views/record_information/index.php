<div class="user-profile" id="vue-root">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="tab-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link " href="<?php echo base_url('recordHistory');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span class="icon mdi mdi-assignment-account"></span>รายการตรวจวินิจฉัย</a></li>
                                <li class="nav-item"><a class="nav-link active" href="#"><span class="icon mdi mdi-male"></span>ข้อมูลผู้ป่วย</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('recordPatient');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span class="icon mdi mdi-local-hospital"></span>การรักษา</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('recordDrug');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span class="icon mdi mdi-local-pharmacy"></span>ห้องยา</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('recordCost');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span class="icon mdi mdi-card"></span>ค่าใช้จ่าย</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel">
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <input type="hidden" id="id" value="<?php echo $member->MEMBERIDCARD;?>">
                                            <input type="hidden" id="bookingId" value="<?php echo $bookingId;?>">
                                            <vs-tabs alignment="right">
                                                <vs-tab label="ข้อมูลทั่วไป" icon="accessibility_new">
                                                    <div class="con-tab-ejemplo">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="card">
                                                                    <div class="card-header card-header-divider">ข้อมูลผู้ป่วย</div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-10">
                                                                                <div class="form-group pt-1">
                                                                                    <vs-input label-placeholder="หมายเลขบัตรประชาชน" type="number" v-model="idCard" size="large" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <div class="form-group pt-1">
                                                                                    <vs-select class="selectExample" label="คำนำหน้า" v-model="prefixName" placeholder="กรุณาเลือกคำนำหน้า" size="large">
                                                                                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in prefixNameOption" />
                                                                                    </vs-select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-7">
                                                                                <div class="form-group pt-1">
                                                                                    <vs-input label-placeholder="ชื่อ - สกุล" type="text" v-model="name" size="large" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-5">
                                                                                <div class="form-group pt-1">
                                                                                    <vs-input label-placeholder="เบอร์โทร" type="text" v-model="phone" size="large" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                <div class="form-group pt-1">
                                                                                    <vs-input label-placeholder="Line ID" type="text" v-model="line" size="large" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-5">
                                                                                <div class="form-group pt-1">
                                                                                    <vs-input label-placeholder="เมลล์" type="email" v-model="email" size="large" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-10">
                                                                                <div class="form-group pt-1">
                                                                                    <vs-textarea label="ที่อยู่" v-model="address" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5 col-offset-1">
                                                                <div class="card">
                                                                    <div class="card-header card-header-divider">ประวัติทางการแพทย์</div>
                                                                    <div class="card-body row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group pt-1">
                                                                                <vs-input label-placeholder="โรคประจำตัว" type="text" v-model="disease" size="large" />
                                                                            </div>
                                                                            <div class="form-group pt-1">
                                                                                <vs-input label-placeholder="ผู้ติดต่อฉุกเฉิน" type="text" v-model="emergencyContact" size="large" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group pt-1">
                                                                                <vs-input label-placeholder="แพ้ยา" type="text" v-model="drugAllergy" size="large" />
                                                                            </div>
                                                                            <div class="form-group pt-1">
                                                                                <vs-input label-placeholder="เบอร์มือถือผู้ติดต่อฉุกเฉิน" type="text" v-model="emergencyPhone" size="large" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group pt-1">
                                                                                <vs-input label-placeholder="อาการแพ้ยา" type="text" v-model="drugAllergyDetail" size="large" />
                                                                            </div>
                                                                            <div class="form-group pt-1">
                                                                                <vs-textarea label="Note" v-model="note" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 text-center centex">
                                                                <vs-button color="success" icon="save" type="relief" v-on:click="save">บันทึกข้อมูล</vs-button>
                                                                <vs-button color="rgb(138 200 166)" icon="clear" type="relief" v-on:click="clear">ล้างข้อมูล</vs-button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </vs-tab>
                                                <vs-tab label="ข้อมูลสุขภาพ" icon="favorite">
                                                    <div class="con-tab-ejemplo">
                                                        <vs-row vs-w="12">
                                                            <vs-button @click="popupActive=true" color="primary" type="border" icon="add_circle_outline">เพิ่มข้อมูลสุขภาพ</vs-button>
                                                        </vs-row>

                                                        <vs-table :sst="true" @search="handleSearch" @sort="handleSort" v-model="selected" :total="totalItems" :max-items="perPage" search :data="recordHealth">
                                                            <template slot="header">
                                                                <h3>
                                                                    ประวัติสุขภาพ
                                                                </h3>
                                                            </template>
                                                            <template slot="thead">
                                                                <vs-th sort-key="DATE_CREATE">
                                                                    วันที่
                                                                </vs-th>
                                                                <vs-th sort-key="BOOKINGID">
                                                                    Visit Number
                                                                </vs-th>
                                                                <vs-th sort-key="Wieght">
                                                                    น้ำหนัก
                                                                </vs-th>
                                                                <vs-th sort-key="Height">
                                                                    ส่วนสูง
                                                                </vs-th>
                                                                <vs-th sort-key="BMI">
                                                                    BMI
                                                                </vs-th>
                                                                <vs-th sort-key="BodyTemp">
                                                                    Body Temp
                                                                </vs-th>
                                                                <vs-th sort-key="BP">
                                                                    BP
                                                                </vs-th>
                                                                <vs-th sort-key="HR">
                                                                    HR
                                                                </vs-th>
                                                                <vs-th sort-key="FBS">
                                                                    FBS
                                                                </vs-th>
                                                            </template>

                                                            <template slot-scope="{data}">
                                                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
                                                                    <vs-td :data="data[indextr].DATE_CREATE">
                                                                        {{data[indextr].DATE_CREATE}}
                                                                    </vs-td>

                                                                    <vs-td :data="data[indextr].BOOKINGID">
                                                                        {{data[indextr].BOOKINGID}}
                                                                    </vs-td>

                                                                    <vs-td :data="data[indextr].Wieght">
                                                                        {{data[indextr].Wieght}}
                                                                    </vs-td>

                                                                    <vs-td :data="data[indextr].Height">
                                                                        {{data[indextr].Height}}
                                                                    </vs-td>
                                                                    <vs-td :data="data[indextr].BMI">
                                                                        {{data[indextr].BMI}}
                                                                    </vs-td>

                                                                    <vs-td :data="data[indextr].BodyTemp">
                                                                        {{data[indextr].BodyTemp}}
                                                                    </vs-td>

                                                                    <vs-td :data="data[indextr].BP">
                                                                        {{data[indextr].BP}}
                                                                    </vs-td>

                                                                    <vs-td :data="data[indextr].HR">
                                                                        {{data[indextr].HR}}
                                                                    </vs-td>
                                                                    <vs-td :data="data[indextr].FBS">
                                                                        {{data[indextr].FBS}}
                                                                    </vs-td>
                                                                </vs-tr>
                                                            </template>
                                                        </vs-table>
                                                        <vs-pagination class="mt-4" :total="pagination.last_page" v-model="page"></vs-pagination>
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

        <vs-popup class="holamundo" title="สุขภาพปัจจุบัน" :active.sync="popupActive">
            <p>Body Measurements</p>
            <div class="row">
                <div class="col-lg-6">
                    <at-input v-model="weight" placeholder="น้ำหนัก" prepend-button>
                        <template slot="append">
                          <span>กิโลกรัม</span>
                        </template>
                    </at-input>
                </div>
                <div class="col-lg-6">
                    <at-input v-model="height" placeholder="ส่วนสูง" prepend-button>
                        <template slot="append">
                          <span>เซนติเมตร</span>
                        </template>
                    </at-input>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-6">
                    <at-input disabled v-model="bmi" placeholder="ดัชนีมวลกาย" prepend-button>
                        <template slot="append">
                          <span>kg/m2</span>
                        </template>
                    </at-input>
                </div>
                <div class="col-lg-6">
                    <at-input v-model="bodyTemp" placeholder="อุณหภูมิร่างกาย" prepend-button>
                        <template slot="append">
                          <span>องศาเซลเซียส</span>
                        </template>
                    </at-input>
                </div>
            </div>
            <hr>
            <p>Vitals</p>
            <div class="row mt-3">
                <div class="col-lg-6">
                    <at-input v-model="bp" placeholder="ความดัน" prepend-button>
                        <template slot="append">
                          <span>mmHg</span>
                        </template>
                    </at-input>
                </div>
                <div class="col-lg-6">
                    <at-input v-model="hr" placeholder="อัตราการเต้นของหัวใจ" prepend-button>
                        <template slot="append">
                          <span>BPM</span>
                        </template>
                    </at-input>
                </div>
                <div class="col-lg-6 mt-3">
                    <at-input v-model="fbs" placeholder="ระดับน้ำตาลในเลือด" prepend-button>
                        <template slot="append">
                          <span>mg/dL</span>
                        </template>
                    </at-input>
                </div>
            </div>
            <div class="row centex mt-3">
                <vs-button type="relief" @click="addHealth">บันทึกข้อมูล</vs-button>
            </div>
        </vs-popup>
    </div>

    <style>
        .at-notification {
            z-index: 999999999 !important;
        }
    </style>
    <script>
        const app = new Vue({
            el: '#vue-root',
            data() {
                return {
                    popupActive: false,
                    weight: null,
                    height: null,
                    bmi: null,
                    bodyTemp: null,
                    bp: null,
                    hr: null,
                    fbs: null,
                    isTable: false,
                    id: null,
                    idCard: null,
                    prefixName: null,
                    name: null,
                    email: null,
                    phone: null,
                    line: null,
                    address: null,
                    disease: null,
                    drugAllergy: null,
                    drugAllergyDetail: null,
                    emergencyContact: null,
                    emergencyPhone: null,
                    note: null,
                    page: 1,
                    perPage: 10,
                    record: [],
                    search: '',
                    sortBy: '',
                    sortType: '',
                    health: [],
                    prefixNameOption: [{
                        text: 'นาย',
                        value: 'นาย'
                    }, {
                        text: 'นาง',
                        value: 'นาง'
                    }, {
                        text: 'น.ส.',
                        value: 'น.ส.'
                    }, {
                        text: 'เด็กชาย',
                        value: 'ด.ช.'
                    }, {
                        text: 'เด็กหญิง',
                        value: 'ด.ญ.'
                    }],
                    selected: [],
                    totalItems: 0,
                    recordHealth: [],
                    pagination: {
                        last_page: 0,
                    }
                }
            },
            mounted() {
                this.getData();
                this.getDataHealth();
            },
            watch: {
                page: function(val) {
                    this.getDataHealth();
                    this.page = val;
                },
                weight: function(val) {
                    if (this.weight != null && this.height != null) {
                        this.bmi = (this.weight / ((this.height / 100) * (this.height / 100))).toFixed(2);
                    }
                },
                height: function(val) {
                    if (this.weight != null && this.height != null) {
                        this.bmi = (this.weight / ((this.height / 100) * (this.height / 100))).toFixed(2);
                    }
                }
            },
            methods: {
                loading() {
                    this.$vs.loading({
                        type: 'sound',
                    })
                    setTimeout(() => {
                        this.$vs.loading.close()
                    }, 3000);
                },
                addHealth() {
                    axios.post("recordInformation/addHealth", {
                        weight: this.weight,
                        height: this.height,
                        bmi: this.bmi,
                        bodyTemp: this.bodyTemp,
                        bp: this.bp,
                        hr: this.hr,
                        fbs: this.fbs,
                        memberId: $('#id').val(),
                        bookingId: $('#bookingId').val(),
                    }).then((response) => {
                        if (response.data.result) {
                            this.$vs.notify({
                                title: 'สำเร็จ',
                                text: 'บันทึกข้อมูลข้อมูลสุขภาพสำเร็จ',
                                color: "success",
                                icon: 'check',
                                position: ' top-right',

                            });
                            this.popupActive = false;
                            this.getDataHealth();
                            //this.loading();
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
                handleSearch(searching) {
                    this.search = searching;
                    this.getDataHealth();
                },
                handleChangePage(page) {
                    this.page = page;
                    this.getDataHealth();
                },
                handleSort(key, active) {
                    this.sortBy = key;
                    this.sortType = active;
                    this.getDataHealth();
                },
                getDataHealth() {
                    axios.get("recordInformation/getRecordHealth", {
                        params: {
                            search: this.search,
                            sortBy: this.sortBy,
                            sortType: this.sortType,
                            page: this.page,
                            perPage: this.perPage,
                            memberId: $('#id').val()
                        }
                    }).then((response) => {
                        let pageData = [];

                        if (response.data.result) {
                            for (let i = 0; i < response.data.data.length; i++) {
                                pageData = pageData.concat(response.data.data[i])
                            }
                            this.pagination.last_page = Math.ceil(parseInt(response.data.total) / this.perPage);
                        } else {
                            this.pagination.last_page = 0;
                        }
                        this.totalItems = pageData.length;


                        this.recordHealth = pageData;
                    });
                },
                getData() {
                    this.id = $('#id').val();
                    axios.get("recordInformation/getData", {
                        params: {
                            id: this.id,
                        }
                    }).then((response) => {
                        if (response.data.result) {
                            this.idCard = response.data.patient.IDCARD;
                            this.prefixName = response.data.patient.PATIEN_NAMEPREFIX;
                            this.name = response.data.patient.PATIEN_NAME;
                            this.email = response.data.patient.PATIEN_EMAIL;
                            this.phone = response.data.patient.PATIEN_PHONE;
                            this.line = response.data.patient.PATIEN_LINEID;
                            this.address = response.data.patient.PATIEN_ADDRESS;
                            this.disease = response.data.patient.PATIEN_DISEASE;
                            this.emergencyContact = response.data.patient.PATIEN_EMERGENCY_CONTACT;
                            this.emergencyPhone = response.data.patient.PATIEN_EMERGENCY_PHONE;
                            this.drugAllergy = response.data.patient.PATIEN_DRUG_ALLERGY;
                            this.drugAllergyDetail = response.data.patient.PATIEN_DRUG_ALLERGY_DETAIL;
                            this.note = response.data.patient.PATIEN_NOTE;
                        }
                    });
                },
                save() {
                    axios.post("recordInformation/update", {
                        id: this.id,
                        idCard: this.idCard,
                        prefixName: this.prefixName,
                        name: this.name,
                        email: this.email,
                        phone: this.phone,
                        line: this.line,
                        address: this.address,
                        disease: this.disease,
                        drugAllergy: this.drugAllergy,
                        drugAllergyDetail: this.drugAllergyDetail,
                        emergencyContact: this.emergencyContact,
                        emergencyPhone: this.emergencyPhone,
                        note: this.note
                    }).then((response) => {
                        if (response.data.result) {
                            this.$vs.notify({
                                title: 'สำเร็จ',
                                text: 'บันทึกข้อมูลข้อมูลทั่วไปสำเร็จ',
                                color: "success",
                                icon: 'check',
                                position: ' top-right',

                            })
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
                clear() {
                    this.idCard = null;
                    this.prefixName = null;
                    this.name = null;
                    this.email = null;
                    this.phone = null;
                    this.line = null;
                    this.address = null;
                    this.disease = null;
                    this.drugAllergy = null;
                    this.drugAllergyDetail = null;
                    this.emergencyContact = null;
                    this.emergencyPhone = null;
                    this.note = null;
                }
            }
        });
    </script>
<div class="user-profile" id="vue-root">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="tab-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link " href="<?php echo base_url('recordHistory');?>?id=<?php echo $member->MEMBERIDCARD;?>"><span class="icon mdi mdi-assignment-account"></span>รายการตรวจวินิจฉัย</a></li>
                                <li class="nav-item"><a class="nav-link active" href="#"><span class="icon mdi mdi-male"></span>ข้อมูลผู้ป่วย</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('recordPatient');?>?id=<?php echo $member->MEMBERIDCARD;?>"><span class="icon mdi mdi-local-hospital"></span>การรักษา</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('recordDrug');?>?id=<?php echo $member->MEMBERIDCARD;?>"><span class="icon mdi mdi-local-pharmacy"></span>ห้องยา</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('recordCost');?>?id=<?php echo $member->MEMBERIDCARD;?>"><span class="icon mdi mdi-card"></span>ค่าใช้จ่าย</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel">
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <input type="hidden" id="id" value="<?php echo $member->MEMBERIDCARD;?>">
                                            <div class="tab-container">
                                                <ul class="nav nav-tabs nav-tabs-success" role="tablist">
                                                    <li class="nav-item"><a class="nav-link active" href="#home5" data-toggle="tab" role="tab"><i class="icon icon-left mdi mdi-male"></i>ข้อมูลทั่วไป</a></li>
                                                    <li class="nav-item"><a class="nav-link" href="#profile5" data-toggle="tab" role="tab"><i class="icon icon-left mdi mdi-favorite"></i>ข้อมูลสุขภาพ</a></li>

                                                </ul>
                                                <div class="tab-content" style="padding-top: 20px;padding-left: 0px;padding-right: 0px;">
                                                    <div class="tab-pane active" id="home5" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="card">
                                                                    <div class="card-header card-header-divider">ข้อมูลผู้ป่วย</div>
                                                                    <div class="card-body row">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group pt-1">
                                                                                <label for="idCard">หมายเลขบัตรประชาชน</label>
                                                                                <at-input v-model="idCard" size="large" status="info"></at-input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group pt-1">
                                                                                <label for="name">คำนำหน้า</label>
                                                                                <at-select v-model="prefixName" size="large" status="info">
                                                                                    <at-option value=""></at-option>
                                                                                    <at-option value="นาย">นาย</at-option>
                                                                                    <at-option value="น.ส.">นางสาว</at-option>
                                                                                    <at-option value="นาง">นาง</at-option>
                                                                                    <at-option value="ด.ช.">เด็กชาย</at-option>
                                                                                    <at-option value="ด.ญ.">เด็กหญิง</at-option>
                                                                                </at-select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group pt-1">
                                                                                <label for="name">ชื่อ - สกุล</label>
                                                                                <at-input v-model="name" size="large" status="info"></at-input>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group pt-1">
                                                                                <label for="phone">เบอร์โทร</label>
                                                                                <at-input v-model="phone" size="large" status="info"></at-input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group pt-1">
                                                                                <label for="line">Line ID</label>
                                                                                <at-input v-model="line" size="large" status="info"></at-input>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group pt-1">
                                                                                <label for="email">เมลล์</label>
                                                                                <at-input v-model="email" size="large" status="info"></at-input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group pt-1">
                                                                                <label for="address">ที่อยู่</label>
                                                                                <at-textarea v-model="address" placeholder=""></at-textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header card-header-divider">ประวัติทางการแพทย์</div>
                                                                            <div class="card-body row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group pt-1">
                                                                                        <label for="address">โรคประจำตัว</label>
                                                                                        <at-input v-model="disease" size="large" status="info" placeholder=""></at-input>
                                                                                    </div>
                                                                                    <div class="form-group pt-1">
                                                                                        <label for="address">ผู้ติดต่อฉุกเฉิน</label>
                                                                                        <at-input v-model="emergencyContact" size="large" status="info" placeholder=""></at-input>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group pt-1">
                                                                                        <label for="address">แพ้ยา</label>
                                                                                        <at-input v-model="drugAllergy" size="large" status="info" placeholder=""></at-input>
                                                                                    </div>
                                                                                    <div class="form-group pt-1">
                                                                                        <label for="address">เบอร์มือถือผู้ติดต่อฉุกเฉิน</label>
                                                                                        <at-input v-model="emergencyPhone" size="large" status="info" placeholder=""></at-input>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group pt-1">
                                                                                        <label for="address">อาการแพ้ยา</label>
                                                                                        <at-input v-model="drugAllergyDetail" size="large" status="info" placeholder=""></at-input>
                                                                                    </div>
                                                                                    <div class="form-group pt-1">
                                                                                        <label for="note">Note</label>
                                                                                        <at-textarea v-model="note" placeholder=""></at-textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 text-center">
                                                                        <button class="btn btn-rounded btn-space btn-success btn-lg" v-on:click="save"><i class="icon icon-left mdi mdi-edit"></i>บันทึกข้อมูล</button>
                                                                        <button class="btn btn-rounded btn-space btn-info btn-lg" v-on:click="clear"><i class="icon icon-left mdi mdi-delete"></i>ล้างข้อมูล</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="profile5" role="tabpanel">

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
                note: null
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
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
                        this.$Notify({
                            title: 'สำเร็จ',
                            duration: 5000,
                            message: 'บันทึกข้อมูลสำเร็จ',
                            type: 'success'
                        });
                    } else {
                        this.$Notify({
                            title: 'ผิดพลาด',
                            duration: 5000,
                            message: 'กรุณาลองใหม่อีกครั้ง',
                            type: 'warning'
                        });
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
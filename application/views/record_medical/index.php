<div class="user-profile" id="vue-root">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="tab-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link " href="<?php echo base_url('recordHistory');?>?id=<?php echo $member->MEMBERIDCARD;?>"><span class="icon mdi mdi-assignment-account"></span>รายการตรวจวินิจฉัย</a></li>
                                <li class="nav-item"><a class="nav-link " href="<?php echo base_url('recordInformation');?>?id=<?php echo $member->MEMBERIDCARD;?>"><span class="icon mdi mdi-male"></span>ข้อมูลผู้ป่วย</a></li>
                                <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('recordPatient');?>?id=<?php echo $member->MEMBERIDCARD;?>"><span class="icon mdi mdi-local-hospital"></span>การรักษา</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('recordDrug');?>?id=<?php echo $member->MEMBERIDCARD;?>"><span class="icon mdi mdi-local-pharmacy"></span>ห้องยา</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('recordCost');?>?id=<?php echo $member->MEMBERIDCARD;?>"><span class="icon mdi mdi-card"></span>ค่าใช้จ่าย</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel">
                                    <div class="mt-2 mb-2">
                                        <a href="<?php echo base_url('recordPatient');?>?id=<?php echo $member->MEMBERIDCARD;?>" class="btn btn-space btn-secondary btn-big"><i class="icon mdi mdi-account-add"></i> Diagnose </a>
                                        <a href="<?php echo base_url('recordMedical');?>?id=<?php echo $member->MEMBERIDCARD;?>" class="btn btn-space btn-secondary btn-big active"><i class="icon mdi mdi-hospital-alt"></i> Medicine </a>
                                        <a href="<?php echo base_url('recordLab');?>?id=<?php echo $member->MEMBERIDCARD;?>" class="btn btn-space btn-secondary btn-big"><i class="icon mdi mdi-eyedropper"></i> Laboratory </a>
                                        <a href="<?php echo base_url('recordProcedure');?>?id=<?php echo $member->MEMBERIDCARD;?>" class="btn btn-space btn-secondary btn-big"><i class="icon mdi mdi-airline-seat-flat-angled"></i> Procedure</a>
                                        <a href="<?php echo base_url('recordCertification');?>?id=<?php echo $member->MEMBERIDCARD;?>" class="btn btn-space btn-secondary btn-big"><i class="icon mdi mdi-file-text"></i> Certificate </a>
                                        <a href="<?php echo base_url('recordSummary');?>?id=<?php echo $member->MEMBERIDCARD;?>" class="btn btn-space btn-secondary btn-big"><i class="icon mdi mdi-receipt"></i> Summary</a>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <vs-row>
                                                <vs-col vs-offset="8" v-tooltip="'col - 2'"  vs-w="6">
                                                <vs-button color="primary" type="border" icon="print"> พิมพ์ใบสั่งยา</vs-button>
                                                <vs-button color="success" type="border" icon="print"> พิมพ์ฉลากยา</vs-button>    
                                                <vs-button color="primary" type="filled" icon="add">เพิ่มข้อมูล</vs-button>
                                                </vs-col>
                                            </vs-row>

                                            <input type="hidden" id="id" value="<?php echo $member->MEMBERIDCARD;?>">
                                            <vs-table max-items="3" pagination :data="users">
                                                <template slot="header">
                                                    <h4>
                                                     Medical Record
                                                    </h4>
                                                  </template>
                                                <template slot="thead">
                                                  <vs-th>
                                                    วันที่
                                                  </vs-th>
                                                  <vs-th>
                                                    Visit Number
                                                  </vs-th>
                                                  <vs-th>
                                                  ชื่อยา
                                                  </vs-th>
                                                  <vs-th>
                                                  ขนาด
                                                  </vs-th>
                                                  <vs-th>
                                                  รูปแบบ
                                                  </vs-th>
                                                  <vs-th>
                                                  ความถี่
                                                  </vs-th>
                                                  <vs-th>
                                                  มื้ออาหาร
                                                  </vs-th>
                                                  <vs-th>
                                                  หมายเหตุ
                                                  </vs-th>
                                                    
                                                  <vs-th>จำนวนหน่วย</vs-th>
                                                  <vs-th>หน่วย</vs-th>
                                                  <vs-th>ราคา</vs-th>
                                                </template>

                                                <template slot-scope="{data}">
                                                  <vs-tr :key="indextr" v-for="(tr, indextr) in data" >
                                                    <vs-td :data="data[indextr].email">
                                                      {{data[indextr].email}}
                                                    </vs-td>
                                          
                                                    <vs-td :data="data[indextr].username">
                                                      {{data[indextr].username}}
                                                    </vs-td>
                                          
                                                    <vs-td :data="data[indextr].id">
                                                      {{data[indextr].website}}
                                                    </vs-td>
                                          
                                                    <vs-td :data="data[indextr].id">
                                                      {{data[indextr].id}}
                                                    </vs-td>
                                                  </vs-tr>
                                                </template>
                                            </vs-table>
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
    
    .vs-con-table table {
        font-size: 13px;
        width: 100%;
        border-collapse: collapse;
    }
    
    th {
        font-size: 14px;
    }
    .vs-button {
    margin: 3px;
}
</style>

<script>
    const app = new Vue({
        el: '#vue-root',
        data() {
            return {
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
                health: [],
                users: [],
                columns1: [{
                    title: 'วันที่',
                    key: 'DATE_CREATE',
                }, {
                    title: "ชื่อรายการหัตถการ",
                    key: 'ProcedureName',
                    sortType: 'normal',

                }, {
                    title: "ค่าใช้จ่าย",
                    key: 'ProcedurePrice',
                    sortType: 'normal',

                }, {
                    title: 'จัดการ',
                    key: 'operation',
                    render: (h, params) => {

                        return h('div', [h('AtButton', {
                                props: {
                                    size: 'small',
                                    hollow: false,
                                    type: 'warning',
                                    icon: 'icon-edit'
                                },

                                style: {
                                    marginRight: '8px'
                                },
                                on: {
                                    click: () => {
                                        this.editDialog(params.item.ProcedureID);
                                    }
                                }
                            }, ''),
                            h('AtButton', {
                                props: {
                                    size: 'small',
                                    hollow: false,
                                    type: 'error',
                                    icon: 'icon-trash-2'
                                },
                                style: {
                                    marginRight: '8px'
                                },
                                on: {
                                    click: () => {
                                        this.deleteDialog(params.item.ProcedureID);
                                    }
                                }
                            }, ''),
                        ])

                    },

                }, ],
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
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
                                <li class="nav-item"><a class="nav-link "
                                        href="<?php echo base_url('recordPatient');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-local-hospital"></span>การรักษา</a></li>
                                <li class="nav-item"><a class="nav-link active"
                                        href="<?php echo base_url('recordDrug');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-local-pharmacy"></span>ห้องยา</a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?php echo base_url('recordCost');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span
                                            class="icon mdi mdi-card"></span>ค่าใช้จ่าย</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel">
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <vs-row>
                                                <vs-col vs-offset="9" v-tooltip="'col - 2'" vs-w="8">
                                                    <vs-button color="primary" type="border" icon="watch_later">
                                                        รอเตรียมยา
                                                    </vs-button>

                                                    <vs-button color="success" type="border" icon="medication">
                                                        รอจ่ายยา</vs-button>

                                                </vs-col>
                                            </vs-row>
                                            <input type="hidden" id="id" value="<?php echo $member->MEMBERIDCARD;?>">
                                            <input type="hidden" id="bookingId" value="<?php echo $bookingId;?>">
                                            <vs-table :sst="true" @search="handleSearch" @sort="handleSort"
                                                v-model="selected" :total="totalItems" :max-items="perPage" search
                                                :data="recordData">
                                                <template slot="header">
                                                    <h4>
                                                        ห้องยา
                                                    </h4>
                                                </template>
                                                <template slot="thead">
                                                    <vs-th sort-key="CREATE">
                                                        วันที่
                                                    </vs-th>
                                                    <vs-th sort-key="BOOKINGID">
                                                        Visit Number
                                                    </vs-th>
                                                    <vs-th sort-key="PH1">
                                                        ชื่อยา
                                                    </vs-th>
                                                    <vs-th sort-key="PH3">
                                                        จำนวน
                                                    </vs-th>
                                                    <vs-th sort-key="PH3">
                                                        ราคา
                                                    </vs-th>
                                                    <vs-th sort-key="PH3">
                                                        บาร์โค้ดตรวจสอบ
                                                    </vs-th>

                                                    <vs-th sort-key="COMMENT">
                                                        พิมพ์ฉลากยา
                                                    </vs-th>

                                                </template>

                                                <template slot-scope="{data}">
                                                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                                        <vs-td :data="data[indextr].CREATE">
                                                            {{data[indextr].CREATE}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].BOOKINGID">
                                                            {{data[indextr].BOOKINGID}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].PH1">
                                                            {{data[indextr].PH1}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].PH3">
                                                            {{data[indextr].PH3}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].PH4">
                                                            {{data[indextr].PH8}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].PH5">
                                                            <vs-input class="inputx" placeholder="" />
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].PH6">
                                                            <vs-button color="rgba(112, 128, 144, 0.25)" type="filled"
                                                                @click="print(data[indextr].MEDICALID)" icon="print">
                                                            </vs-button>
                                                        </vs-td>


                                                    </vs-tr>
                                                </template>
                                            </vs-table>
                                            <vs-pagination class="mt-4" :total="pagination.last_page" v-model="page">
                                            </vs-pagination>
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
                barcode: null,
                brandName: null,
                commonName: null,
                indication: null,
                countUnit: null,
                optionsCountUnit: [],
                callingUnit: null,
                optionsCallingUnit: [],
                fregquency: null,
                optionsFregquency: [],
                suggestion: null,
                optionsSuggestion: [],
                meal: null,
                optionsMeal: [],
                duration: 5,
                unit: null,
                numOfUnit: null,
                price: null,
                remark: null,
                pregCat: null,
                popupActive: false,
                detailProduct: true,
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

                id: null,
                page: 1,
                perPage: 10,
                record: [],
                search: '',
                sortBy: '',
                sortType: '',
                selected: [],
                totalItems: 0,
                recordData: [],
                pagination: {
                    last_page: 0,
                },

                idItem: null,
                pageItem: 1,
                perPageItem: 10,
                recordItem: [],
                searchItem: '',
                sortByItem: '',
                sortTypeItem: '',
                selectedItem: [],
                totalItemsPro: 0,
                recordDataItem: [],
                paginationItem: {
                    last_page: 0,
                },
            }
        },
        mounted() {
            this.getData();
        },
        watch: {
            page: function(val) {
                this.getData();
                this.page = val;
            },
            selected: function(val) {
                this.id = val.MEDICALID;
            },
        },
        methods: {
            handleSort(key, active) {
                this.sortBy = key;
                this.sortType = active;
                this.getData();
            },
            handleSearch(searching) {
                this.search = searching;
                this.getData();
            },

            getData() {
                axios.get("recordDrug/getRecord", {
                    params: {
                        search: this.search,
                        sortBy: this.sortBy,
                        sortType: this.sortType,
                        page: this.page,
                        perPage: this.perPage,
                        memberId: $('#id').val(),
                    }
                }).then((response) => {
                    let pageData = [];

                    if (response.data.result) {
                        for (let i = 0; i < response.data.data.length; i++) {
                            pageData = pageData.concat(response.data.data[i])
                        }
                        this.pagination.last_page = Math.ceil(parseInt(response.data.total) / this
                            .perPage);
                    } else {
                        this.pagination.last_page = 0;
                    }
                    this.totalItems = pageData.length;
                    this.recordData = pageData;
                });
            },



            saveItem() {
                axios.post("recordMedical/insert", {
                    member_id: $('#id').val(),
                    booking_id: $('#bookingId').val(),
                    ph1: this.commonName,
                    ph2: this.indication,
                    ph3: this.countUnit,
                    ph4: this.callingUnit,
                    ph5: this.fregquency,
                    ph6: this.meal,
                    ph7: this.suggestion,
                    ph8: this.price,
                    ph9: this.brandName,
                    duration: this.duration,
                    number: this.numOfUnit,
                    unit: this.unit,
                    barcode: this.barcode,
                    pregCat: this.pregCat,
                    comment: this.remark,
                }).then((response) => {
                    if (response.data.result) {
                        this.$vs.notify({
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลข้อมูลสำเร็จ',
                            color: "success",
                            icon: 'check',
                            position: ' top-right',

                        });
                        this.getData();
                        this.selectedItem = [];
                        this.popupActive = false;
                        this.commonName = null;
                        this.indication = null;
                        this.countUnit = this.optionsCountUnit[0].value;
                        this.callingUnit = this.optionsCallingUnit[0].value;
                        this.fregquency = this.optionsFregquency[0].value;
                        this.meal = this.optionsMeal[0].value;
                        this.suggestion = this.optionsSuggestion[0].value;
                        this.numOfUnit = null;
                        this.unit = null;
                        this.price = null;
                        this.duration = 5;
                        this.barcode = null;
                        this.pregCat = null;
                        this.remark = null;
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
            },
            print(id) {

                setTimeout(function() {
                    window.open('<?php echo base_url("recordDrug/sticker");?>?id=' + id, '_blank');
                }, 1000);

            }
        }
    });
    </script>
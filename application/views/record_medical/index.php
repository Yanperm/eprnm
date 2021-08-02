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
                                                class="btn btn-space btn-secondary btn-big active "><i
                                                    class="icon mdi mdi-hospital-alt"></i> Medicine </a>
                                            <a href="<?php echo base_url('recordLab');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big"><i
                                                    class="icon mdi mdi-eyedropper"></i> Laboratory </a>
                                            <a href="<?php echo base_url('recordProcedure');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big "><i
                                                    class="icon mdi mdi-airline-seat-flat-angled"></i> Procedure</a>
                                            <a href="<?php echo base_url('recordCertification');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big"><i
                                                    class="icon mdi mdi-file-text"></i> Certificate </a>
                                            <a href="<?php echo base_url('recordSummary');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"
                                                class="btn btn-space btn-secondary btn-big"><i
                                                    class="icon mdi mdi-receipt"></i> Summary</a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <vs-row>
                                                <vs-col vs-offset="7" v-tooltip="'col - 2'" vs-w="7">
                                                    <vs-button color="primary" type="border" icon="print"> พิมพ์ใบสั่งยา
                                                    </vs-button>
                                                    <a href="<?php echo base_url('recordMedical/sticker')?>?id=<?php echo $bookingId;?>"
                                                        target="_blank">
                                                        <vs-button color="success" type="border" icon="print">
                                                            พิมพ์ฉลากยา</vs-button>
                                                    </a>
                                                    <vs-button @click="popupActive=true,action='insert'" color="primary"
                                                        type="filled" icon="add">เพิ่มข้อมูล</vs-button>
                                                </vs-col>
                                            </vs-row>
                                            <input type="hidden" id="id" value="<?php echo $member->MEMBERIDCARD;?>">
                                            <input type="hidden" id="bookingId" value="<?php echo $bookingId;?>">
                                            <vs-table :sst="true" @search="handleSearch" @sort="handleSort"
                                                v-model="selected" :total="totalItems" :max-items="perPage" search
                                                :data="recordData">
                                                <template slot="header">
                                                    <h4>
                                                        Medical Record
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
                                                        ขนาด
                                                    </vs-th>
                                                    <vs-th sort-key="PH4">
                                                        รูปแบบ
                                                    </vs-th>
                                                    <vs-th sort-key="PH5">
                                                        ความถี่
                                                    </vs-th>
                                                    <vs-th sort-key="PH6">
                                                        มื้ออาหาร
                                                    </vs-th>
                                                    <vs-th sort-key="COMMENT">
                                                        หมายเหตุ
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
                                                            {{data[indextr].PH4}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].PH5">
                                                            {{data[indextr].PH5}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].PH6">
                                                            {{data[indextr].PH6}}
                                                        </vs-td>
                                                        <vs-td :data="data[indextr].COMMENT">
                                                            {{data[indextr].COMMENT}}
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

    <vs-popup fullscreen class="holamundo" title="Medical Record" :active.sync="popupActive">
        <p>กรุณาเลือกยา</p>
        <v-row>
            <vs-table :sst="true" @search="handleSearchItem" @sort="handleSortItem" v-model="selectedItem"
                :total="totalItemsPro" :max-items="perPageItem" search :data="recordDataItem">
                <template slot="thead">
                    <vs-th sort-key="tbproducts.ProID">
                        รหัสยา
                    </vs-th>
                    <vs-th sort-key="tbproducts.BrandName">
                        ชื่อการค้า
                    </vs-th>
                    <vs-th sort-key="tbproducts.CommonName">
                        ชื่อสามัญ
                    </vs-th>
                    <vs-th sort-key="tbproducts.Barcode">
                        Barcode
                    </vs-th>
                    <vs-th sort-key="tbsubcategory.SubName">
                        กลุ่มยารอง
                    </vs-th>
                    <vs-th sort-key="tbproducts.CategoryName">
                        กลุ่มยาหลัก
                    </vs-th>
                </template>

                <template slot-scope="{data}">
                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                        <vs-td :data="data[indextr].ProID">
                            {{data[indextr].ProID}}
                        </vs-td>
                        <vs-td :data="data[indextr].BrandName">
                            {{data[indextr].BrandName}}
                        </vs-td>
                        <vs-td :data="data[indextr].CommonName">
                            {{data[indextr].CommonName}}
                        </vs-td>
                        <vs-td :data="data[indextr].Barcode">
                            {{data[indextr].Barcode}}
                        </vs-td>
                        <vs-td :data="data[indextr].SubName">
                            {{data[indextr].SubName}}
                        </vs-td>
                        <vs-td :data="data[indextr].CategoryName">
                            {{data[indextr].CategoryName}}
                        </vs-td>
                    </vs-tr>
                </template>
            </vs-table>
            <vs-pagination class="mt-4" :total="paginationItem.last_page" v-model="pageItem"></vs-pagination>
        </v-row>
        <hr>
        <v-row :active.sync="detailProduct">
            <div class="row">
                <div class="col-md-4">
                    <div class="centerx labelx">
                        <vs-input label="ชื่อการค้า *" size="large" v-model="brandName" disabled />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="centerx labelx">
                        <vs-input label="ชื่อสามัญ *" size="large" v-model="commonName" disabled />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="centerx labelx">
                        <vs-input label="ข้อบ่งใช้ *" size="large" v-model="indication" />
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <vs-select autocomplete class="selectExample" label="ครั้งล่ะ *" v-model="countUnit">
                                <vs-select-item :key="index" :value="item.value" :text="item.text"
                                    v-for="(item,index) in optionsCountUnit" />
                            </vs-select>
                        </div>
                        <div class="col-md-4">
                            <vs-select autocomplet class="selectExample" label="หน่วย *" v-model="callingUnit">
                                <vs-select-item :key="index" :value="item.value" :text="item.text"
                                    v-for="(item,index) in optionsCallingUnit" />
                            </vs-select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <vs-select autocomplete class="selectExample" label="ความถี่ *" v-model="fregquency">
                                <vs-select-item :key="index" :value="item.value" :text="item.text"
                                    v-for="(item,index) in optionsFregquency" />
                            </vs-select>
                        </div>
                        <div class="col-md-6">
                            <vs-select autocomplet class="selectExample" label="เวลา *" v-model="meal">
                                <vs-select-item :key="index" :value="item.value" :text="item.text"
                                    v-for="(item,index) in optionsMeal" />
                            </vs-select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <vs-select autocomplete class="selectExample" label="ข้อแนะนำ *" v-model="suggestion">
                                <vs-select-item :key="index" :value="item.value" :text="item.text"
                                    v-for="(item,index) in optionsSuggestion" />
                            </vs-select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-2">
                    <div class="centerx labelx">
                        <vs-input label="ระยะเวลา (วัน)  *" size="large" v-model="duration" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="centerx labelx">
                                <vs-input label="จำนวนหน่วย  *" size="large" v-model="numOfUnit" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="centerx labelx">
                                <vs-input label="หน่วย" size="large" v-model="unit" disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="centerx labelx">
                        <vs-input label="ราคา *" size="large" v-model="price" disabled />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="centerx labelx">
                        <vs-input label="หมายเหตุ *" size="large" v-model="remark" />
                    </div>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="centerx labelx">
                        <vs-input label="Preg Cat  *" size="large" v-model="pregCat" disabled />
                    </div>
                </div>
            </div>
            <div class="centex mt-3">
                <vs-button type="relief" @click=saveItem size="large">บันทึกข้อมูล</vs-button>
            </div>
        </v-row>
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
        this.getDataItem();
        this.getOption();
    },
    watch: {
        page: function(val) {
            this.getData();
            this.page = val;
        },
        pageItem: function(val) {
            this.getDataItem();
            this.pageItem = val;
        },
        selectedItem: function(val) {
            this.brandName = val.BrandName;
            this.commonName = val.CommonName;
            this.indication = val.Indication;
            this.price = val.PriceSale;
            this.unit = val.Unit;
            this.pregCat = val.PregCat;
            this.barcode = val.Barcode;
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
        handleSearchItem(searching) {
            this.searchItem = searching;
            this.getDataItem();
        },
        handleSortItem(key, active) {
            this.sortByItem = key;
            this.sortTypeItem = active;
            this.getDataItem();
        },
        getOption() {
            axios.get("recordMedical/getOptiondata").then((response) => {
                if (response.data.result) {
                    for (let i = 0; i < response.data.data.countUnit.length; i++) {
                        this.optionsCountUnit.push({
                            text: response.data.data.countUnit[i].detail,
                            value: response.data.data.countUnit[i].detail
                        }, );
                    }
                    this.countUnit = this.optionsCountUnit[0].value;

                    for (let i = 0; i < response.data.data.callingUnit.length; i++) {
                        this.optionsCallingUnit.push({
                            text: response.data.data.callingUnit[i].detail,
                            value: response.data.data.callingUnit[i].detail
                        }, );
                    }
                    this.callingUnit = this.optionsCallingUnit[0].value;


                    for (let i = 0; i < response.data.data.fregquency.length; i++) {
                        this.optionsFregquency.push({
                            text: response.data.data.fregquency[i].detail,
                            value: response.data.data.fregquency[i].detail
                        }, );
                    }
                    this.fregquency = this.optionsFregquency[0].value;

                    for (let i = 0; i < response.data.data.meal.length; i++) {
                        this.optionsMeal.push({
                            text: response.data.data.meal[i].detail,
                            value: response.data.data.meal[i].detail
                        }, );
                    }
                    this.meal = this.optionsMeal[0].value;

                    for (let i = 0; i < response.data.data.suggestion.length; i++) {
                        this.optionsSuggestion.push({
                            text: response.data.data.suggestion[i].detail,
                            value: response.data.data.suggestion[i].detail
                        }, );
                    }
                    this.suggestion = this.optionsSuggestion[0].value;
                }

            });
        },
        getData() {
            axios.get("recordMedical/getRecord", {
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
                    this.pagination.last_page = Math.ceil(parseInt(response.data.total) / this.perPage);
                } else {
                    this.pagination.last_page = 0;
                }
                this.totalItems = pageData.length;
                this.recordData = pageData;
            });
        },
        getDataItem() {
            axios.get("recordMedical/getProduct", {
                params: {
                    search: this.searchItem,
                    sortBy: this.sortByItem,
                    sortType: this.sortTypeItem,
                    page: this.pageItem,
                    perPage: this.perPageItem,
                }
            }).then((response) => {
                let pageData = [];
                this.isTable = true;

                if (response.data.result) {
                    for (let i = 0; i < response.data.data.length; i++) {
                        pageData = pageData.concat(response.data.data[i])
                    }

                    this.paginationItem.last_page = Math.ceil(parseInt(response.data.total) / this
                        .perPageItem);
                } else {
                    this.paginationItem.last_page = 0;
                }

                this.totalItemsPro = response.data.total;
                this.recordDataItem = pageData;
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
        }
    }
});
</script>
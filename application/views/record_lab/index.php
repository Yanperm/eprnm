<div class="user-profile" id="vue-root">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="tab-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link " href="<?php echo base_url('recordHistory');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span class="icon mdi mdi-assignment-account"></span>รายการตรวจวินิจฉัย</a></li>
                                <li class="nav-item"><a class="nav-link " href="<?php echo base_url('recordInformation');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span class="icon mdi mdi-male"></span>ข้อมูลผู้ป่วย</a></li>
                                <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('recordPatient');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span class="icon mdi mdi-local-hospital"></span>การรักษา</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('recordDrug');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span class="icon mdi mdi-local-pharmacy"></span>ห้องยา</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('recordCost');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>"><span class="icon mdi mdi-card"></span>ค่าใช้จ่าย</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel">
                                    <div class="mt-2 mb-2">
                                        <div class="mt-2 mb-2">
                                            <a href="<?php echo base_url('recordPatient');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>" class="btn btn-space btn-secondary btn-big "><i class="icon mdi mdi-account-add"></i> Diagnose </a>
                                            <a href="<?php echo base_url('recordMedical');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>" class="btn btn-space btn-secondary btn-big "><i class="icon mdi mdi-hospital-alt"></i> Medicine </a>
                                            <a href="<?php echo base_url('recordLab');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>" class="btn btn-space btn-secondary btn-big active"><i class="icon mdi mdi-eyedropper"></i> Laboratory </a>
                                            <a href="<?php echo base_url('recordProcedure');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>" class="btn btn-space btn-secondary btn-big"><i class="icon mdi mdi-airline-seat-flat-angled"></i> Procedure</a>
                                            <a href="<?php echo base_url('recordCertification');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>" class="btn btn-space btn-secondary btn-big"><i class="icon mdi mdi-file-text"></i> Certificate </a>
                                            <a href="<?php echo base_url('recordSummary');?>?id=<?php echo $member->MEMBERIDCARD;?>&booking_id=<?php echo $bookingId;?>" class="btn btn-space btn-secondary btn-big"><i class="icon mdi mdi-receipt"></i> Summary</a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <input type="hidden" id="id" value="<?php echo $member->MEMBERIDCARD;?>">
                                            <input type="hidden" id="bookingId" value="<?php echo $bookingId;?>">
                                            <vs-row vs-w="12">
                                                <vs-button @click="popupActive=true,action='insert'" color="primary" type="border" icon="add_circle_outline">เพิ่มข้อมูล</vs-button>
                                            </vs-row>
                                            <vs-table :sst="true" @search="handleSearch" @sort="handleSort" v-model="selected" :total="totalItems" :max-items="perPage" search :data="record">
                                                <template slot="header">
                                                    <h4>
                                                        Lab Record
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
                                                    รายการแล็บ
                                                  </vs-th>
                                                  <vs-th>
                                                    Department
                                                  </vs-th>
                                                  <vs-th>
                                                    Company
                                                  </vs-th>
                                                  <vs-th>
                                                    ราคา
                                                  </vs-th>
                                                  <vs-th>
                                                    จัดการ
                                                  </vs-th>
                                                </template>

                                                <template slot-scope="{data}">
                                                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
                                                    <vs-td :data="data[indextr].CREATE">
                                                      {{data[indextr].CREATE}}
                                                    </vs-td>
                                          
                                                    <vs-td :data="data[indextr].BOOKINGID">
                                                      {{data[indextr].BOOKINGID}}
                                                    </vs-td>
                                          
                                                    <vs-td :data="data[indextr].PH1">
                                                      {{data[indextr].PH1}}
                                                    </vs-td>
                                                    <vs-td :data="data[indextr].PH2">
                                                      {{data[indextr].PH2}}
                                                    </vs-td>
                                                    <vs-td :data="data[indextr].PH3">
                                                      {{data[indextr].PH3}}
                                                    </vs-td>
                                                    <vs-td :data="data[indextr].PH4">
                                                      {{data[indextr].PH4}}
                                                    </vs-td>
                                                    <vs-td :data="data[indextr].LBID">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <vs-popup class="holamundo" title="Lab Record" :active.sync="popupActive">
        <v-row>
            <vs-table multiple :sst="true" @search="handleSearchItem" @sort="handleSortItem" v-model="selectedItem" :total="totalItemsPro" :max-items="perPageItem" search :data="recordDataItem">
                <template slot="thead">
                    <vs-th sort-key="tbsenddepartment.STESTNAME">
                        Test Name
                    </vs-th>
                    <vs-th sort-key="tbdepartment.DepName">
                        Department
                    </vs-th>
                    <vs-th  sort-key="tblabscompany.LabCName">
                        Company
                    </vs-th>
                    <vs-th  sort-key="tbsenddepartment.Price">
                        Price
                    </vs-th>
                </template>

                <template slot-scope="{data}">
                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
                        <vs-td :data="data[indextr].STESTNAME">
                            {{data[indextr].STESTNAME}}
                        </vs-td>
                        <vs-td :data="data[indextr].DepName">
                            {{data[indextr].DepName}}
                        </vs-td>
                        <vs-td :data="data[indextr].LabCName">
                            {{data[indextr].LabCName}}
                        </vs-td>
                        <vs-td :data="data[indextr].Price">
                            {{data[indextr].Price}}
                        </vs-td>
                    </vs-tr>
                </template>
            </vs-table>
            <vs-pagination class="mt-4" :total="paginationItem.last_page" v-model="pageItem"></vs-pagination>
        </v-row>
        <div class="centex mt-3">
            <vs-button type="relief" @click=saveItem size="large">บันทึกข้อมูล</vs-button>
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
    
    th {
        font-size: 14px;
    }
</style>

<script>
    const app = new Vue({
        el: '#vue-root',
        data() {
            return {
                popupActive: false,
                action: null,
                field: {
                    PH1: null,
                    PH2: null,
                    PH3: null,
                    PH4: null,
                },
                id: null,
                page: 1,
                perPage: 10,
                record: [],
                search: '',
                sortBy: '',
                sortType: '',
                selected: [],
                totalItems: 0,
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
        },
        watch: {
            page: function(val) {
                this.getData();
                this.page = val;
            },
            selected: function(val) {
                this.id = val.LBID
            },
            pageItem: function(val){
                this.getDataItem();
                this.pageItem = val;
            }
        },
        methods: {
            handleSearch(searching) {
                this.search = searching;
                this.getData();
            },
            handleSort(key, active) {
                this.sortBy = key;
                this.sortType = active;
                this.getData();
            },
            handleSearchItem(searching) {
                this.searchItem = searching;
                this.getDataItem();
            },
            handleSortItem(key, active) {
                console.log(key);
                this.sortByItem = key;
                this.sortTypeItem = active;
                this.getDataItem();
            },
            getData() {
                axios.get("recordLab/getData", {
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
                    this.record = pageData;
                    this.selected = [];
                });
            },
            getDataItem() {
                axios.get("recordLab/getLab", {
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

                        this.paginationItem.last_page = Math.ceil(parseInt(response.data.total) / this.perPage);
                    } else {
                        this.paginationItem.last_page = 0;
                    }
                    this.totalItemsPro = pageData.length;
                    this.recordDataItem = pageData;
                });
            },
            saveItem(){
                axios.post("recordLab/insert", {
                    member_id: $('#id').val(),
                    booking_id: $('#bookingId').val(),
                    data : this.selectedItem
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
            openConfirm() {
                this.$vs.dialog({
                    type: 'confirm',
                    color: 'danger',
                    title: `ยืนยันการลบข้อมูล`,
                    text: 'ต้องการลบข้อมูลหรือไม่',
                    acceptText: 'ตกลง',
                    cancelText: 'ยกเลิก',
                    accept: this.acceptAlert
                })
            },
            acceptAlert() {
                axios.post("recordLab/delete", {
                    id: this.id,
                }).then((response) => {
                    if (response.data.result) {
                        this.$vs.notify({
                            color: 'success',
                            title: 'ลบข้อมูลสำเร็จ',
                            text: 'ทำการลบข้อมูลสำเร็จ',
                            icon: 'check',
                            position: ' top-right',
                        });
                        this.getData();
                        this.selected = [];
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
        }
    });
</script>
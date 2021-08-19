<div class="page-head">
    <h2 class="page-head-title">ฐานข้อมูลผู้ป่วย</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">ฐานข้อมูลผู้ป่วย</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span class="table-filter-title">ค้นหาผู้ป่วย</span>
                            <div class="filter-container">
                                <form>
                                    <label class="control-label">โปรดพิมพ์คำที่ต้องการค้นหา</label>
                                    <at-input v-model="search" size="small" @blur="makePageData" placeholder="ค้นหา"></at-input>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span class="table-filter-title">เงื่อนไขการค้นหา</span>
                            <div class="filter-container">
                                <label class="control-label">โปรดเลือกเงื่อนไข</label>
                                <form>
                                    <at-select v-model="conditionType" size="large" @on-change="makePageData">
                                        <at-option value="1">ชื่อผู้ป่วย</at-option>
                                        <at-option value="2">เลขบัตรประชาชน</at-option>
                                        <at-option value="3">เบอร์โทรศัพท์</at-option>
                                    </at-select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="noSwipe">
                    <div>
                        <!-- <at-table v-if="isTable" size="normal" :columns="columns1" :data="data3" pagination :show-page-total=true></at-table> -->
                        <vs-table stripe :sst="true" @sort="handleSort" v-model="selected" :total="totalItems"
                            :max-items="perPage" :data="recordData">
                            <template slot="thead">
                                <vs-th sort-key="IDCARD">
                                    เลขบัตรประชาชน
                                </vs-th>
                                <vs-th sort-key="CUSTOMERNAME">
                                    ชื่อ-นามสกุล
                                </vs-th>
                                <vs-th sort-key="BIRTHDAY">
                                    วันเกิด
                                </vs-th>
                                <vs-th sort-key="PHONE">
                                    เบอร์โทรศัพท์
                                </vs-th>
                                <vs-th sort-key="LINEID">
                                    Line ID
                                </vs-th>
                                <vs-th sort-key="">
                                    สถานะสมาชิก
                                </vs-th>
                                <vs-th sort-key="">
                                    Drop Member
                                </vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                    <vs-td :data="data[indextr].IDCARD">
                                        {{data[indextr].IDCARD}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].CUSTOMERNAME">
                                        {{data[indextr].CUSTOMERNAME}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].BIRTHDAY">
                                        {{data[indextr].BIRTHDAY}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].PHONE">
                                        {{data[indextr].PHONE}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].LINEID">
                                        {{data[indextr].LINEID}}
                                    </vs-td>

                                    <!-- <vs-td :data="data[indextr].ProcedureIDs">
                                        <div class="centerx">
                                            <vs-tooltip text="แก้ไขข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled"
                                                    icon="drive_file_rename_outline"
                                                    @click="editDialog(data[indextr].ProcedureID)"></vs-button>
                                            </vs-tooltip>
                                            <vs-tooltip text="ลบข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled" icon="delete"
                                                    @click="deleteDialog(data[indextr].ProcedureID)"></vs-button>
                                            </vs-tooltip>
                                        </div>
                                    </vs-td> -->
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

<style>
    .mdrp__activator .activator-wrapper .text-field:focus~label,
    .mdrp__activator .activator-wrapper .text-field__filled~label {
        top: -20px;
        font-size: 14px;
        color: #4285f4;
        display: none;
    }
    
    .mdrp__activator .activator-wrapper .text-field {
        display: block;
        font-size: 15px;
        margin-top: 19px;
        padding: 4px 9px 9px 16px;
        width: 100%;
        border: none;
        border-bottom: 1px solid #757575;
    }
    
    .mdrp-root[data-v-7863e830] {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    
    .mdrp__activator .activator-wrapper .bar {
        display: none !important;
        position: relative;
        display: block;
        width: 315px;
    }
    
    .custom-control {
        position: relative;
        display: block;
        min-height: 1.428571rem;
        padding-left: 0px;
    }
    
    .avatar {
        height: 30px;
        width: 30px;
        border-radius: 50%;
        margin-right: 10px;
    }
    
    p {
        margin: 0 0 5px;
    }
    
    .at-notification {
        z-index: 999999999 !important;
    }
</style>

<script src="https://unpkg.com/moment"></script>
<script src="https://unpkg.com/v-md-date-range-picker/dist/v-md-date-range-picker.min.js">
</script>
<script type="text/javascript">
    const app = new Vue({
        el: '#vue-root',
        data() {

            return {
                page: 1,
                perPage: 10,
                record: [],
                search: '',
                conditionType: '1',
                totalItems: 0,
                recordData: [],
                selected: [],
                pagination: {
                last_page: 0,
                },

            }
        },
        watch: {
            page: function(val) {
                this.page = val;
                this.makePageData();
            },
            search: function(val) {
                this.makePageData();
            },
        },
        mounted() {
            this.record = this.makePageData();
        },
        methods: {
            handleSort() {
            this.makePageData();
        },
            makePageData() {
                axios.get("<?php echo base_url('patient/getListDataMember');?>", {
                        params: {
                            search: this.search,
                            type: this.conditionType,
                            page: this.page,
                            perPage: this.perPage,
                        }
                    })
                    .then((response) => {
                        let pageData = [];
                        this.isTable = true;

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
            }
        }
    });

</script>
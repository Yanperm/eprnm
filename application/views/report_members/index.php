<div>
    <h2 class="page-head-title">รายงานยอดคนไข้</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">รายงานยอดคนไข้</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-4 table-filters pb-0 pb-xl-4"><span class="table-filter-title">ค้นหาชื่อคนไข้</span>
                            <div class="filter-container">
                                <form>
                                    <!-- <label class="control-label">โปรดพิมพ์คำที่ต้องการค้นหา</label> -->
                                    <at-input v-model="search" size="large" placeholder="ค้นหา"></at-input>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 table-filters pb-0 pb-xl-4"><span class="table-filter-title">วันที่ - วันที่</span>
                            <div class="filter-container">
                                <form>
                                    <at-input v-model="startDate" size="large" type="date"  placeholder="yyyy-mm-dd" ></at-input>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 table-filters pb-0 pb-xl-4"><span class="table-filter-title"></span>
                            <div class="filter-container">
                                <form>
                                    <br>
                                    <at-input v-model="endDate" size="large" type="date"  placeholder="yyyy-mm-dd" ></at-input>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-md-12 text-right mt-3 mb-3 pr-5">
                            <v-row vs-justify="right">
                                <vs-col vs-offset="9" v-tooltip="'col - 1'" vs-type="flex" vs-justify="center" vs-align="center" vs-w="3">
                                    <!-- <vs-button type="filled" icon="add_circle_outline" to="recordCost/receipt">รายงาน</vs-button> -->
                                    <a href="#" class="btn btn-primary" @click="print">พิมพ์</a>

                                </vs-col>
                            </v-row>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="noSwipe">

                    <div>
                        <vs-table :sst="true" @sort="handleSort" v-model="selected" :total="totalItems" :max-items="perPage" :data="recordData">
                            <template slot="thead">
                                
                                <vs-th sort-key="centerx">
                                    วันที่เข้ารักษา
                                </vs-th>

                                <vs-th sort-key="centerx">
                                    ชื่อ-สกุลคนไข้
                                </vs-th>

                                <vs-th sort-key="centerx">
                                    รายละเอียด
                                </vs-th>

                                <vs-th sort-key="centerx">
                                    Book on
                                </vs-th>

                            </template>
                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >

                                    <vs-td :data="data[indextr].BOOKDATE">
                                        {{data[indextr].BOOKDATE}}
                                    </vs-td>
                                
                                    <vs-td :data="data[indextr].CUSTOMERNAME">
                                        {{data[indextr].CUSTOMERNAME}}
                                    </vs-td>

                                    <vs-td :data="data[indextr].DETAIL">
                                        {{data[indextr].DETAIL}}
                                    </vs-td>

                                    <vs-td :data="data[indextr].BOOK_ON">
                                        {{data[indextr].BOOK_ON}}
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

<script type="text/javascript">
const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            startDate: "",
            endDate: "",
            id: null,
            page: 1,
            perPage: 10,
            record: [],
            date:'',
            search: '',
            sortBy: '',
            sortType: '',
            selected: [],
            totalItems: 0,
            recordData: [],
            pagination: {
                last_page: 0,
            },
            conditionType: '1',

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
        startDate: function(val) {
            this.makePageData();
        },
        endDate: function(val) {
            this.makePageData();
        },
        selected: function(val) {
            
        },
    },
    mounted() {
        this.record = this.makePageData();
    },
    methods: {
        print(){
            window.open('http://localhost/eprnm/recordMembers/print?search='+this.search+"&start="+this.startDate+"&end="+this.endDate, '_blank');
        },
        handleSort(key, active) {
            this.sortBy = key;
            this.sortType = active;
            this.makePageData();
        },
        makePageData() {
            axios.get("reportMembers/getReport", {
                params: {
                    search: this.search,
                    startDate: this.startDate,
                    endDate: this.endDate,
                    sortBy: this.sortBy,
                    sortType: this.sortType,
                    page: this.page,
                    perPage: this.perPage,
                }
            }).then((response) => {
                let pageData = [];
                this.isTable = true;

                if (response.data.result) {
                    for (let i = 0; i < response.data.report.length; i++) {
                        pageData = pageData.concat(response.data.report[i])
                    }

                    this.pagination.last_page = Math.ceil(parseInt(response.data.total) / this.perPage);
                } else {
                    this.pagination.last_page = 0;
                }
              
                this.totalItems = pageData.length;
                this.recordData = pageData;
            });
        },
       
    }
});
</script>
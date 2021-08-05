<div>
    <h2 class="page-head-title">รายงานยอดขาย</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">รายงานยอดขาย</li>
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
                                <!-- <vs-th sort-key="centerx">
                                    ลำดับคิว
                                </vs-th> -->
                                
                                <vs-th sort-key="centerx">
                                    วันที่เข้ารักษา
                                </vs-th>

                                <vs-th sort-key="centerx">
                                    ชื่อ-สกุลคนไข้
                                </vs-th>

                                <vs-th sort-key="centerx">
                                    ค่า DF
                                </vs-th>

                                <vs-th sort-key="centerx">
                                    ค่ายา
                                </vs-th>

                                <vs-th sort-key="centerx">
                                    ค่าแล็บ
                                </vs-th>

                                <vs-th sort-key="centerx">
                                    ค่าหัตถการ
                                </vs-th>

                                <vs-th sort-key="centerx">
                                    ค่าใบรับรอง
                                </vs-th>

                            </template>
                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >

                                    <!-- <vs-td :data="data[indextr].ci_order">
                                        {{data[indextr].ci_order}}
                                    </vs-td> -->
                                    
                                    <vs-td :data="data[indextr].ci_date">
                                        {{data[indextr].ci_date}}
                                    </vs-td>
                                
                                    <vs-td :data="data[indextr].ci_name">
                                        {{data[indextr].ci_name}}
                                    </vs-td>

                                    <vs-td :data="data[indextr].ci">
                                        <!-- {{data[indextr].ci_check}} -->
                                    </vs-td>

                                    <vs-td :data="data[indextr].ci_drug">
                                        {{data[indextr].ci_drug}}
                                    </vs-td>

                                    <vs-td :data="data[indextr].ci_lab">
                                        {{data[indextr].ci_lab}}
                                    </vs-td>

                                    <vs-td :data="data[indextr].ci_procedure">
                                        {{data[indextr].ci_procedure}}
                                    </vs-td>

                                    <vs-td :data="data[indextr].ci_certificate">
                                        {{data[indextr].ci_certificate}}
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
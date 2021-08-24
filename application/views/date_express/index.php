<div>
    <h2 class="page-head-title">เพิ่มวันเวลาเปิดทำการพิเศษ</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">เพิ่มวันเวลาเปิดทำการพิเศษ</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div style="background-color:#CCCCFF;">
                <button type="submit" class="btn  btn-lg" @click="insert()" >
                <i class="icon mdi mdi-save"></i> บันทึกข้อมูล</button>
            </div>
            <div class="col-12 ">
                <h3>วันเวลาเปิดทำการพิเศษ</h3>
                <label>โปรดระบุวันเวลาที่ทางคลินิกต้องการเปิดเป็นกรณีพิเศษ ที่นอกเหนือไปจากวันเวลาปกติ</label><br>
                <label>ระบบจะเปิดให้คนไข้นัดหมายในเวลานี้แทนเวลาในวันทำการปกติ หรือวันหยุด</label>
            </div>
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-4 table-filters pb-0 pb-xl-4">
                            <div class="filter-container">
                                <form>
                                    <at-input v-model="field.date" size="large" type="date"  ></at-input>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 table-filters pb-0 pb-xl-4">
                            <div class="filter-container">
                                <form>
                                    <at-input v-model="field.open" size="large" type="time"  placeholder="" ></at-input>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 table-filters pb-0 pb-xl-4">
                            <div class="filter-container">
                                <form>
                                    <at-input v-model="field.close" size="large" type="time"  placeholder="" ></at-input>
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
                                </vs-col>
                            </v-row>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="noSwipe">
                    <div>
                        <vs-table stripe :sst="true" @sort="handleSort" v-model="selected" :total="totalItems" :max-items="perPage" :data="recordData" >
                            <template slot="thead">
                                <vs-th sort-key="text">
                                    วันที่
                                </vs-th>
                                <vs-th sort-key="text">
                                    เวลาเปิด
                                </vs-th>
                                <vs-th sort-key="centerx">
                                    เวลาปิด
                                </vs-th>
                                <vs-th class="centerx">
                                    จัดการ
                                </vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
                                    <vs-td :data="data[indextr].date">
                                        {{data[indextr].date}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].time_open">
                                        {{data[indextr].time_open}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].time_close">
                                        {{data[indextr].time_close}}
                                    </vs-td>
                                    
                                    <vs-td :data="data[indextr].date">
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
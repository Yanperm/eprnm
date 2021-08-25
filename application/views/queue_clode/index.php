<div>
    <h2 class="page-head-title">วันหยุดพิเศษและคิวเต็ม</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">วันหยุดพิเศษและคิวเต็ม</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div style="background-color:#CCCCFF;">
                <button type="submit" class="btn  btn-lg" @click="save()">
                    <i class="icon mdi mdi-save"></i> บันทึกข้อมูล</button>
            </div>
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-8 table-filters pb-0 pb-xl-4"><span
                                class="table-filter-title">วันหยุดพิเศษ</span>
                            <label>โปรดระบุข้อมูลวันหยุดพิเศษของทางคลินิก</label>
                            <div class="filter-container">
                                <div class="row">
                                    <div class="col-md-10">
                                        <form id="close-form">
                                            <at-input v-for="(item, index) in numOfHoliday"
                                                v-model="field.holiday[index]" size="large" type="date" class="mt-1">
                                            </at-input>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <vs-button type="filled" color="#dfdfdf" icon="add" @click="numOfHoliday++">
                                        </vs-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-8 table-filters pb-0 pb-xl-4"><span
                                class="table-filter-title">คิวเต็ม</span>
                            <label>กรุณาระบุวันที่ต้องการปิดรับการนัดหมายเนื่องจากคิวเต็ม</label>
                            <div class="filter-container">
                                <div class="row">
                                    <div class="col-md-10">
                                        <form id="">
                                            <at-input v-for="(item,index) in numOfClostdate"
                                                v-model="field.CloseDate[index]" size="large" type="date" class="mt-1">
                                            </at-input>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <vs-button type="filled" color="#dfdfdf" icon="add" @click="numOfClostdate++">
                                        </vs-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="card-body">
                <div class="noSwipe">

                    <div>
                        <vs-table :sst="true" @sort="handleSort" v-model="selected" :total="totalItems" :max-items="perPage" :data="recordData">
                            <template slot="thead">
                                <vs-th sort-key="CLOSEDATE">
                                    คิวเต็ม
                                </vs-th>
                                
                                <vs-th class="centerx">
                                    จัดการ
                                </vs-th>
                            </template>
                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
                                    <vs-td :data="data[indextr].CLOSEDATE">
                                        {{data[indextr].CLOSEDATE}}
                                    </vs-td>
                                   
                                    <vs-td :data="data[indextr].CLOSEDATE">
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
            </div> -->
        </div>
    </div>

    <!-- <vs-popup class="holamundo" title="จัดการคิวเต็ม" :active.sync="popupActive">
        <v-row>
            <vs-input label-placeholder="" type="date" v-model="field.CLOSEDATE" size="large" />
        </v-row>
        <div class="centex mt-3">
            <vs-button type="relief" @click=save size="large">บันทึกข้อมูล</vs-button>
        </div>
    </vs-popup> -->
</div>
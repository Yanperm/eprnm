<div>
    <h2 class="page-head-title">กลุ่มยาหลัก</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">กลุ่มยาหลัก</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span class="table-filter-title">ค้นหากลุ่มยาหลัก</span>
                            <div class="filter-container">
                                <form>
                                    <!-- <label class="control-label">โปรดพิมพ์คำที่ต้องการค้นหา</label> -->
                                    <at-input v-model="search" size="large" placeholder="ค้นหา"></at-input>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span class="table-filter-title">เงื่อนไขการค้นหา</span>
                            <div class="filter-container">
                                <!-- <label class="control-label">โปรดเลือกเงื่อนไข</label> -->
                                <form>
                                    <at-select v-model="conditionType" size="large" @on-change="makePageData">
                                        <at-option value="1">รหัสกลุ่มยาหลัก</at-option>
                                        <at-option value="2">ชื่อกลุ่มยาหลัก</at-option>
                                    </at-select>
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
                                    <vs-button type="filled" icon="add_circle_outline" @click="add()">เพิ่มข้อมูล</vs-button>
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
                                <vs-th sort-key="CategoryIDs">
                                    รหัสกลุ่มยาหลัก
                                </vs-th>
                                <vs-th sort-key="CategoryName">
                                    ชื่อกลุ่มยาหลัก
                                </vs-th>
                                <vs-th sort-key="NUM_OF_SUB" style="text-align: right;">
                                    จำนวนกลุ่มยารองที่ใช้งาน
                                </vs-th>
                                <vs-th class="centerx">
                                    จัดการ
                                </vs-th>
                            </template>
                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
                                    <vs-td :data="data[indextr].CategoryIDs">
                                        {{data[indextr].CategoryIDs}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].CategoryName">
                                        {{data[indextr].CategoryName}}
                                        <p class="sub-text">สร้างเมื่อ : {{data[indextr].Create}}</p>
                                    </vs-td>
                                    <vs-td :data="data[indextr].NUM_OF_SUB" class="text-right">
                                    {{data[indextr].NUM_OF_SUB}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].CategoryIDs">
                                        <div class="centerx">
                                            <vs-tooltip text="กลุ่มยารอง">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled" icon="format_list_bulleted" @click="productSub(data[indextr].CategoryIDs)"></vs-button></a>
                                            </vs-tooltip>
                                            <vs-tooltip text="แก้ไขข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled" icon="drive_file_rename_outline" @click="popupActive=true,action='update'"></vs-button>
                                            </vs-tooltip>
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

    <vs-popup class="holamundo" title="กลุ่มยาหลัก" :active.sync="popupActive">
        <v-row>
            <vs-input label-placeholder="ชื่อกลุ่มยาหลัก" type="text" v-model="field.CategoryName" size="large" />
        </v-row>
        <div class="centex mt-3">
            <vs-button type="relief" @click=save size="large">บันทึกข้อมูล</vs-button>
        </div>
    </vs-popup>
</div>
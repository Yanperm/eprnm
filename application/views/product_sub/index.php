<div>
    <h2 class="page-head-title">กลุ่มยารอง</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item">ยาและเวชภัณฑ์</li>
            <li class="breadcrumb-item active">กลุ่มยารอง</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span
                                class="table-filter-title">ค้นหากลุ่มยารอง</span>
                            <div class="filter-container">
                                <vs-input class="inputx" placeholder="ระบุคำที่ต้องการค้นหา" v-model="search" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span
                                class="table-filter-title">เงื่อนไขการค้นหา</span>
                            <div class="filter-container">
                                <vs-select class="selectExample" label="" v-model="typeSearch">
                                    <vs-select-item :key="index" :value="item.value" :text="item.text"
                                        v-for="item,index in optionTypeSearch" />
                                </vs-select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-md-12 text-right mt-3 mb-3 pr-5">
                            <v-row vs-justify="right">
                                <vs-col vs-offset="9" v-tooltip="'col - 1'" vs-type="flex" vs-justify="center"
                                    vs-align="center" vs-w="3">
                                    <vs-button type="filled" icon="add_circle_outline" @click="add()">เพิ่มข้อมูล
                                    </vs-button>
                                </vs-col>
                            </v-row>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="noSwipe">

                    <div>

                        <vs-table stripe :sst="true" @sort="handleSort" v-model="selected" :total="totalItems"
                            :max-items="perPage" :data="recordData">
                            <template slot="thead">
                                <vs-th sort-key="SubIDs">
                                    รหัสกลุ่มยารอง
                                </vs-th>
                                <vs-th sort-key="SubName">
                                    ชื่อกลุ่มยารอง
                                </vs-th>
                                <vs-th class="centerx">
                                    จัดการ
                                </vs-th>
                            </template>
                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                    <vs-td :data="data[indextr].SubIDs">
                                        {{data[indextr].SubIDs}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].SubName">
                                        {{data[indextr].SubName}}
                                        <p class="sub-text">กลุ่มยาหลัก : {{data[indextr].CategoryName}}</p>
                                    </vs-td>
                                    <vs-td :data="data[indextr].SubIDs">
                                        <div class="centerx">
                                            <vs-tooltip text="คลังยา">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled"
                                                    icon="format_list_bulleted"
                                                    @click="productStore(data[indextr].SubIDs)"></vs-button></a>
                                            </vs-tooltip>
                                            <vs-tooltip text="แก้ไขข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled"
                                                    icon="drive_file_rename_outline"
                                                    @click="popupActive=true,action='update'"></vs-button>
                                            </vs-tooltip>
                                            <vs-tooltip text="ลบข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled" icon="delete"
                                                    @click="openConfirm()"></vs-button>
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

    <vs-popup class="holamundo" title="กลุ่มยารอง" :active.sync="popupActive">
        <div class="row">
            <div class="col-12">
                <vs-select class="selectExample" label="" v-model="field.CategoryID">
                    <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in category"
                        size="large" />
                </vs-select>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <vs-input label-placeholder="ชื่อกลุ่มยารอง" type="text" v-model="field.SubName" size="large" />
            </div>
        </div>

        <div class="centex mt-3">
            <vs-button type="relief" @click=save size="large">บันทึกข้อมูล</vs-button>
        </div>
    </vs-popup>
</div>
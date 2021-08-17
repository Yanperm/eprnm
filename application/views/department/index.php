<div>
    <h2 class="page-head-title">แผนกส่งตรวจ</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">แผนกส่งตรวจ</li>
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
                                class="table-filter-title">ค้นหาแผนกส่งตรวจ</span>
                            <div class="filter-container">
                                <at-input v-model="search" size="small" @blur="makePageData" placeholder="ค้นหา"></at-input>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span
                                class="table-filter-title">เงื่อนไขการค้นหา</span>
                            <div class="filter-container">
                                <vs-select class="selectExample" label="" v-model="typeSearch" @on-change="makePageData">
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
                                    <vs-button type="filled" icon="add_circle_outline" @click="addDialog()">เพิ่มข้อมูล
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
                        <vs-table :sst="true" @sort="handleSort" v-model="selected" :total="totalItems"
                            :max-items="perPage" :data="recordData">
                            <template slot="thead">
                                <vs-th sort-key="DID">
                                    รหัสแผนกส่งตรวจ
                                </vs-th>
                                <vs-th sort-key="DepName">
                                    ชื่อแผนกส่งตรวจ
                                </vs-th>
                                <vs-th sort-key="LabCName">
                                    ชื่อบริษัทที่รับตรวจแล็บ
                                </vs-th>
                                <vs-th class="centerx">
                                    จัดการ
                                </vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                    <vs-td :data="data[indextr].DID">
                                        {{data[indextr].DID}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].DepName">
                                        {{data[indextr].DepName}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].LabCName">
                                        {{data[indextr].LabCName}}
                                    </vs-td>

                                    <vs-td :data="data[indextr].DID">
                                        <div class="centerx">
                                            <vs-tooltip text="แก้ไขข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled"
                                                    icon="drive_file_rename_outline"
                                                    @click="editDialog(data[indextr].DepID)"></vs-button>
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

    <vs-popup class="holamundo" title="ผู้รับตรวจ" :active.sync="popupActive">

        <label>บริษัทที่รับตรวจแล็บ</label>
        <div class="form-group pt-2">
            <at-select  v-model="mainId" size="large" style="width: 100%" label-placeholder="รหัสผู้รับตรวจ">
                <at-option  v-for="item in labCompany" v-bind:value="item.LabCID">
                    {{ item.LabCName }}
                </at-option>
                </at-select>
        </div>

        <v-row>
            <label for="">รหัสแผนกส่งตรวจ</label>
            <vs-input label-placeholder="" type="text" v-model="code" size="large" readonly />
        </v-row>
        <br>
        <v-row>
            <label for="">ชื่อแผนกส่งตรวจ</label>
            <vs-input label-placeholder="" type="text" v-model="name" size="large" />
        </v-row>
        <div class="centex mt-3">
            <vs-button type="relief" @click=saveItem size="large">บันทึกข้อมูล</vs-button>
        </div>
    </vs-popup>

   
</div>
<div>
    <h2 class="page-head-title">คลังยา</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item">ยาและเวชภัณฑ์</li>
            <li class="breadcrumb-item active">คลังยา</li>
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
                                class="table-filter-title">ค้นหาคลังยา</span>
                            <div class="filter-container">
                                <form>
                                    <label class="control-label">โปรดพิมพ์คำที่ต้องการค้นหา</label>
                                    <at-input v-model="search" size="small" @blur="makePageData" placeholder="ค้นหา">
                                    </at-input>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span
                                class="table-filter-title">เงื่อนไขการค้นหา</span>
                            <div class="filter-container">
                                <label class="control-label">โปรดเลือกเงื่อนไข</label>
                                <form>
                                    <at-select v-model="conditionType" size="large" @on-change="makePageData">
                                        <at-option value="1">รหัสยา</at-option>
                                        <at-option value="2">ชื่อการค้า</at-option>
                                        <at-option value="3">ชื่อสามัญ</at-option>
                                        <at-option value="4">Barcode</at-option>
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
                                <vs-col vs-offset="9" v-tooltip="'col - 1'" vs-type="flex" vs-justify="center"
                                    vs-align="center" vs-w="3">
                                    <a href="<?php echo base_url('add-product');?>">
                                        <vs-button type="filled" icon="add_circle_outline">เพิ่มข้อมูล
                                        </vs-button>
                                    </a>
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
                                <vs-th sort-key="ProID">
                                    รหัสยา
                                </vs-th>
                                <vs-th sort-key="BrandName">
                                    ชื่อการค้า
                                </vs-th>
                                <vs-th sort-key="CommonName">
                                    ชื่อสามัญ
                                </vs-th>
                                <vs-th sort-key="Barcode">
                                    Barcode
                                </vs-th>
                                <vs-th class="centerx">
                                    จัดการ
                                </vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                    <vs-td :data="data[indextr].ProID">
                                        {{data[indextr].ProID}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].CommonName">
                                        {{data[indextr].CommonName}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].BrandName">
                                        {{data[indextr].BrandName}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].Barcode">
                                        {{data[indextr].Barcode}}
                                    </vs-td>

                                    <vs-td :data="data[indextr].ProID">
                                        <div class="centerx">
                                            <vs-tooltip text="แก้ไขข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled"
                                                    icon="drive_file_rename_outline"
                                                    @click="editDialog(data[indextr].ProductID)"></vs-button>
                                            </vs-tooltip>
                                            <vs-tooltip text="ลบข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled" icon="delete"
                                                    @click="deleteDialog(data[indextr].ProductID)"></vs-button>
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
    <div class="modal fade" id="edit-dialog" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">ผู้รับตรวจ</h3>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span
                            class="mdi mdi-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="form-group pt-2">
                            <label for="inputCode">รหัสผู้รับตรวจ</label>
                            <input class="form-control" id="inputCode" type="text" v-model="code" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputName">ชื่อผู้รับตรวจ</label>
                            <input class="form-control" id="inputName" type="text" v-model="name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"
                        v-on:click="clearItem">ยกเลิก</button>
                    <button class="btn btn-success" type="button" v-on:click="saveItem">บันทึกข้อมูล</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-dialog" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span
                            class="mdi mdi-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                        <h3>ยืนยันการลบข้อมูล!</h3>
                        <p>ต้องการลบข้อมูลผู้รับตรวจหรือไม่</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"
                        v-on:click="clearItem">ยกเลิก</button>
                    <button class="btn btn-danger" type="button" v-on:click="deleteItem">ลบข้อมูล</button>
                </div>
            </div>
        </div>
    </div>
</div>
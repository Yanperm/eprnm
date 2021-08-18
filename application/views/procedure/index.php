<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span class="table-filter-title">ค้นหากลุ่มยาหลัก</span>
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
                                        <at-option value="1">รหัสรายการหัตถการ</at-option>
                                        <at-option value="2">ชื่อรายการหัตถการ</at-option>
                                    </at-select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="card-body">
                <div class="noSwipe">
                    <div class="row">
                        <div class="col-md-12 text-right mt-3 mb-3 pr-5">
                            <at-button type="primary" v-on:click="addDialog"><i class="at-btn__icon icon icon-plus"></i> เพิ่มข้อมูล</at-button>
                        </div>
                    </div>
                    <div>
                        <!-- <at-table v-if="isTable" size="normal" :columns="columns1" :data="data3" pagination :show-page-total=true></at-table> -->

                        <vs-table stripe :sst="true" @sort="handleSort" v-model="selected" :total="totalItems"
                            :max-items="perPage" :data="recordData">
                            <template slot="thead">
                                <vs-th sort-key="ProcedureIDs">
                                    รหัสรายการหัตถการ
                                </vs-th>
                                <vs-th sort-key="ProcedureName">
                                    ชื่อรายการหัตถการ
                                </vs-th>
                                <vs-th sort-key="ProcedurePrice">
                                    ค่าใช้จ่าย
                                </vs-th>
                                <vs-th class="centerx">
                                    จัดการ
                                </vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                    <vs-td :data="data[indextr].ProcedureIDs">
                                        {{data[indextr].ProcedureIDs}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].ProcedureName">
                                        {{data[indextr].ProcedureName}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].ProcedurePrice">
                                        {{data[indextr].ProcedurePrice}}
                                    </vs-td>

                                    <vs-td :data="data[indextr].ProcedureIDs">
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
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="form-group pt-2">
                            <label for="inputCode">รหัสรายการหัตถการ</label>
                            <input class="form-control" id="inputCode" type="text" v-model="code" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputName">ชื่อรายการหัตถการ</label>
                            <input class="form-control" id="inputName" type="text" v-model="name">
                        </div>
                        <div class="form-group">
                            <label for="inputPrice">ค่าใช้จ่าย</label>
                            <input class="form-control" id="inputPrice" type="number" v-model="price" step="any">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" v-on:click="clearItem">ยกเลิก</button>
                    <button class="btn btn-success" type="button" v-on:click="saveItem">บันทึกข้อมูล</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-dialog" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                        <h3>ยืนยันการลบข้อมูล!</h3>
                        <p>ต้องการลบข้อมูลรายการหัตถการหรือไม่</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" v-on:click="clearItem">ยกเลิก</button>
                    <button class="btn btn-danger" type="button" v-on:click="deleteItem">ลบข้อมูล</button>
                </div>
            </div>
        </div>
    </div>
</div>

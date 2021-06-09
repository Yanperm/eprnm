<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span class="table-filter-title">ค้นหาแผนกส่งตรวจ</span>
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
                                        <at-option value="1">รหัสแผนกส่งตรวจ</at-option>
                                        <at-option value="2">ชื่อแผนกส่งตรวจ</at-option>
                                        <at-option value="3">ชื่อบริษัทที่รับตรวจแล็บ</at-option>
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
                        <at-table v-if="isTable" size="normal" :columns="columns1" :data="data3" pagination :show-page-total=true></at-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-dialog" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">แผนกส่งตรวจ</h3>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="form-group pt-2">
                            <label for="inputCode">บริษัทที่รับตรวจแล็บ</label>
                            <at-select v-model="mainId" size="large" style="width: 100%">
                                <at-option  v-for="item in labCompany" v-bind:value="item.LabCID">
                                    {{ item.LabCName }}
                                </at-option>
                            </at-select>
                        </div>
                        <div class="form-group pt-2">
                            <label for="inputCode">รหัสแผนกส่งตรวจ</label>
                            <input class="form-control" id="inputCode" type="text" v-model="code" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputName">ชื่อแผนกส่งตรวจ</label>
                            <input class="form-control" id="inputName" type="text" v-model="name">
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
                        <p>ต้องการลบข้อมูลแผนกส่งตรวจหรือไม่</p>
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

<div>
    <h2 class="page-head-title">กลุ่มยาหลัก</h2>
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
                                        <at-option value="1">รหัสกลุ่มยาหลัก</at-option>
                                        <at-option value="2">ชื่อกลุ่มยาหลัก</at-option>
                                    </at-select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="noSwipe">
                    <button class="btn btn-space btn-success" v-on:click="addDialog"><i class="at-btn__icon icon icon-plus"></i> เพิ่มข้อมูล</button>
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
                    <h3 class="modal-title">กลุ่มยาหลัก</h3>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="form-group pt-2">
                            <label for="inputCode">รหัสกลุ่มยาหลัก</label>
                            <input class="form-control" id="inputCode" type="text" v-model="code" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputName">ชื่อกลุ่มยาหลัก</label>
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
                        <p>ต้องการลบข้อมูลกลุ่มยาหลักหรือไม่</p>
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

<style>
    .mdrp__activator .activator-wrapper .text-field:focus~label,
    .mdrp__activator .activator-wrapper .text-field__filled~label {
        top: -20px;
        font-size: 14px;
        color: #4285f4;
        display: none;
    }
    
    .mdrp__activator .activator-wrapper .text-field {
        display: block;
        font-size: 15px;
        margin-top: 19px;
        padding: 4px 9px 9px 16px;
        width: 100%;
        border: none;
        border-bottom: 1px solid #757575;
    }
    
    .mdrp-root[data-v-7863e830] {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    
    .mdrp__activator .activator-wrapper .bar {
        display: none !important;
        position: relative;
        display: block;
        width: 315px;
    }
    
    .custom-control {
        position: relative;
        display: block;
        min-height: 1.428571rem;
        padding-left: 0px;
    }
    
    .avatar {
        height: 30px;
        width: 30px;
        border-radius: 50%;
        margin-right: 10px;
    }
    
    p {
        margin: 0 0 5px;
    }
    
    .at-notification {
        z-index: 999999999 !important;
    }
    
    .modal-main-icon {
        font-size: 36px;
    }
    
    .form-group {
        text-align: left;
    }
    
    .form-group label {
        font-weight: 800 !important;
    }
</style>

<script type="text/javascript">
    const app = new Vue({
        el: '#vue-root',
        data() {
            return {
                isTable: false,
                idSelect: null,
                action: null,
                code: null,
                name: null,
                page: 1,
                perPage: 10,
                record: [],
                search: '',
                conditionType: '1',
                data3: [],
                columns1: [{
                    title: 'รหัสกลุ่มยาหลัก',
                    key: 'CategoryIDs',
                }, {
                    title: "ชื่อกลุ่มยาหลัก",
                    key: 'CategoryName',
                    sortType: 'normal',
                }, {
                    title: 'วันเวลาที่สร้าง',
                    key: 'Create',
                }, {
                    title: 'จัดการ',
                    key: 'operation',
                    render: (h, params) => {

                        return h('div', [h('AtButton', {
                                props: {
                                    size: 'small',
                                    hollow: false,
                                    type: 'warning',
                                    icon: 'icon-edit'
                                },
                                style: {
                                    marginRight: '8px'
                                },
                                on: {
                                    click: () => {
                                        this.editDialog(params.item.CategoryID);
                                    }
                                }
                            }, 'แก้ไข'),
                            h('AtButton', {
                                props: {
                                    size: 'small',
                                    hollow: false,
                                    type: 'error',
                                    icon: 'icon-trash-2'
                                },

                                style: {
                                    marginRight: '8px'
                                },
                                on: {
                                    click: () => {
                                        this.deleteDialog(params.item.CategoryID)
                                    }
                                }
                            }, 'ลบ'),
                        ])
                    },

                }, ],
            }
        },
        mounted() {
            this.record = this.makePageData();
        },
        methods: {
            makePageData() {
                axios.get("<?php echo base_url('productMain/getProductMain');?>", {
                    params: {
                        search: this.search,
                        type: this.conditionType,
                    }
                }).then((response) => {
                    let pageData = [];
                    this.isTable = true;

                    if (response.data.result) {
                        for (let i = 0; i < response.data.data.length; i++) {
                            pageData = pageData.concat(response.data.data[i])
                        }

                    }
                    this.code = "M" + ('000' + (response.data.data.length + 1)).slice(-3);
                    this.data3 = pageData;
                });
            },
            saveItem() {

                if (this.action == 'insert') {
                    axios.post("<?php echo base_url('productMain/insert');?>", {
                        code: this.code,
                        name: this.name
                    }).then((response) => {
                        if (response.data.result) {
                            this.$Notify({
                                title: 'สำเร็จ',
                                duration: 5000,
                                message: 'บันทึกข้อมูลสำเร็จ',
                                type: 'success'
                            });
                            this.makePageData();
                            this.code = null;
                            this.name = null;
                            $('#edit-dialog').modal("hide");
                        } else {
                            this.$Notify({
                                title: 'ผิดพลาด',
                                duration: 5000,
                                message: 'กรุณาลองใหม่อีกครั้ง',
                                type: 'warning'
                            });
                        }
                    });
                } else if (this.action == 'update') {
                    axios.post("<?php echo base_url('productMain/update');?>", {
                        id: this.idSelect,
                        code: this.code,
                        name: this.name
                    }).then((response) => {
                        if (response.data.result) {
                            this.$Notify({
                                title: 'สำเร็จ',
                                duration: 5000,
                                message: 'บันทึกข้อมูลสำเร็จ',
                                type: 'success'
                            });
                            this.makePageData();
                            this.code = null;
                            this.name = null;
                            $('#edit-dialog').modal("hide");
                        } else {
                            this.$Notify({
                                title: 'ผิดพลาด',
                                duration: 5000,
                                message: 'กรุณาลองใหม่อีกครั้ง',
                                type: 'warning'
                            });
                        }
                    });
                }
            },
            addDialog() {
                this.action = "insert";
                this.name = null;
                $('#edit-dialog').modal("show");
            },
            editDialog(id) {
                this.action = "update";
                this.idSelect = id;
                axios.get("<?php echo base_url('productMain/getProductMainById');?>", {
                    params: {
                        id: id,
                    }
                }).then((response) => {
                    if (response.data.result) {
                        this.code = response.data.data.CategoryIDs;
                        this.name = response.data.data.CategoryName;
                        $('#edit-dialog').modal("show");
                    }
                });
            },
            deleteDialog(id) {
                this.idSelect = id;
                $('#delete-dialog').modal('show');
            },
            deleteItem() {
                axios.post("<?php echo base_url('productMain/delete');?>", {
                    id: this.idSelect,
                }).then((response) => {
                    if (response.data.result) {
                        this.$Notify({
                            title: 'สำเร็จ',
                            duration: 5000,
                            message: 'ลบข้อมูลสำเร็จ',
                            type: 'success'
                        });
                        this.makePageData();
                        this.idSelect = null;
                        $('#delete-dialog').modal('hide');
                    } else {
                        this.$Notify({
                            title: 'ผิดพลาด',
                            duration: 5000,
                            message: 'กรุณาลองใหม่อีกครั้ง',
                            type: 'warning'
                        });
                        $('#delete-dialog').modal('hide');
                    }
                });
            },
            clearItem() {
                this.idSelect = null;
            }
        }
    });
</script>
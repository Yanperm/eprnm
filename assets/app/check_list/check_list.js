const app = new Vue({
    el: '#vue-root',
    data() {

        return {
            isTable: false,
            idSelect: null,
            action: null,
            code: null,
            name: null,
            cost: null,
            price: null,
            mainId: null,
            subId: null,
            labCompany: [],
            department: [],
            page: 1,
            perPage: 10,
            record: [],
            search: '',
            conditionType: '1',
            data3: [],
            columns1: [{
                title: 'รหัสรายการส่งตรวจ',
                key: 'SPID',
                sortType: 'normal',
            }, {
                title: "ชื่อการทดสอบ",
                key: 'STESTNAME',
                sortType: 'normal',

            }, {
                title: "แผนกส่งตรวจ",
                key: 'DepName',
                sortType: 'normal',

            }, {
                title: "บริษัทที่รับตรวจแล็บ",
                key: 'LabCName',
                sortType: 'normal',

            }, {
                title: "ต้นทุน",
                key: 'Price',
                sortType: 'normal',

            }, {
                title: "ราคา",
                key: 'PriceSale',
                sortType: 'normal',

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
                                    this.editDialog(params.item.SID);
                                }
                            }
                        }, ''),
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
                                    this.deleteDialog(params.item.SID)
                                }
                            }
                        }, ''),
                    ])

                },

            }, ],
        }
    },
    mounted() {
        this.record = this.makePageData();
        this.getLabCompany();
        this.getDepartment();
    },
    methods: {
        getLabCompany() {
            axios.get("checkList/getLabCompany")
                .then((response) => {
                    this.labCompany = response.data.data;
                });
        },
        getDepartment() {
            this.subId = "";
            this.department = [];

            axios.get("checkList/getDepartmentByLab", {
                    params: {
                        lab_id: this.mainId,
                    }
                })
                .then((response) => {
                    this.department = response.data.data;
                });
        },
        makePageData() {
            axios.get("checkList/getCheckList", {
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
                this.data3 = pageData;
            });
        },
        saveItem() {
            if (this.action == 'insert') {
                axios.post("checkList/insert", {
                    code: this.code,
                    name: this.name,
                    mainId: this.mainId,
                    subId: this.subId,
                    cost: this.cost,
                    price: this.price
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
                axios.post("checkList/update", {
                    id: this.idSelect,
                    code: this.code,
                    name: this.name,
                    mainId: this.mainId,
                    subId: this.subId,
                    cost: this.cost,
                    price: this.price
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
                        this.mainId = null;
                        this.subId = null;
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
            this.mainId = "";
            this.subId = "";
            this.cost = "";
            this.price = "";

            axios.get("checkList/getMaxId")
                .then((response) => {
                    if (response.data.result) {
                        this.code = "T" + ('000' + (response.data.maxId + 1)).slice(-4);
                    }
                });
            $('#edit-dialog').modal("show");
        },
        editDialog(id) {
            this.action = "update";
            this.idSelect = id;
            axios.get("checkList/getCheckListById", {
                params: {
                    id: id,
                }
            }).then((response) => {
                if (response.data.result) {
                    let result = response.data.data;

                    this.code = result.SPID;
                    this.name = result.STESTNAME;
                    this.cost = result.Price;
                    this.price = result.PriceSale;
                    this.mainId = result.LabCID;

                    setTimeout(function() {
                        this.getDepartment()
                        this.subId = result.DepID;
                    }.bind(this), 1000)
                    $('#edit-dialog').modal("show");
                }
            });
        },
        deleteDialog(id) {
            this.idSelect = id;
            $('#delete-dialog').modal('show');
        },
        deleteItem() {
            axios.post("checkList/delete", {
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
            this.mainId = "";
            this.subId = "";
            this.cost = "";
            this.price = "";
        }
    }
});
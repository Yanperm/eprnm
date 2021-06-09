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
                title: 'รหัสบริษัทที่รับตรวจแล็บ',
                key: 'LCID',
            }, {
                title: "ชื่อบริษัทที่รับตรวจแล็บ",
                key: 'LabCName',
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
                                    this.editDialog(params.item.LabCID);
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
                                    this.deleteDialog(params.item.LabCID);
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
    },
    methods: {
        makePageData() {
            axios.get("labCompany/getLabCompany", {
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
                axios.post("labCompany/insert", {
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
                axios.post("labCompany/update", {
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
            axios.get("labCompany/getMaxId")
                .then((response) => {
                    if (response.data.result) {
                        this.code = "CL" + ('000' + (response.data.maxId + 1)).slice(-4);
                    }
                });
            $('#edit-dialog').modal("show");
        },
        editDialog(id) {
            this.action = "update";
            this.idSelect = id;
            axios.get("labCompany/getLabCompanyById", {
                params: {
                    id: id,
                }
            }).then((response) => {
                if (response.data.result) {
                    this.code = response.data.data.LCID;
                    this.name = response.data.data.LabCName;
                    $('#edit-dialog').modal("show");
                }
            });
        },
        deleteDialog(id) {
            this.idSelect = id;
            $('#delete-dialog').modal('show');
        },
        deleteItem() {
            axios.post("labCompany/delete", {
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
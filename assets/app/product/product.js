const app = new Vue({
    el: '#vue-root',
    data() {

        return {
            //isTable: false,
            idSelect: null,
            action: null,
            code: null,
            name: null,
            page: 1,
            perPage: 10,
            record: [],
            search: '',
            conditionType: '1',
            pagination: {
                last_page: 0,
            },
            totalItems: 0,
            recordData: [],
            selected: [],
            // data3: [],
            // columns1: [{
            //     title: 'รหัสยา',
            //     key: 'ProID',
            // }, {
            //     title: "ชื่อการค้า",
            //     key: 'BrandName',
            //     sortType: 'normal',

            // }, {
            //     title: "ชื่อสามัญ",
            //     key: 'CommonName',
            //     sortType: 'normal',

            // }, {
            //     title: "Barcode",
            //     key: 'Barcode',
            //     sortType: 'normal',

            // }, {
            //     title: 'จัดการ',
            //     key: 'operation',
            //     render: (h, params) => {

            //         return h('div', [h('AtButton', {
            //                 props: {
            //                     size: 'small',
            //                     hollow: false,
            //                     type: 'warning',
            //                     icon: 'icon-edit'
            //                 },

            //                 style: {
            //                     marginRight: '8px'
            //                 },
            //                 on: {
            //                     click: () => {
            //                         this.editDialog(params.item.ProductID);
            //                     }
            //                 }
            //             }, ''),
            //             h('AtButton', {
            //                 props: {
            //                     size: 'small',
            //                     hollow: false,
            //                     type: 'error',
            //                     icon: 'icon-trash-2'
            //                 },
            //                 style: {
            //                     marginRight: '8px'
            //                 },
            //                 on: {
            //                     click: () => {
            //                         this.deleteDialog(params.item.ProductID);
            //                     }
            //                 }
            //             }, ''),
            //         ])

            //     },

            // }, ],
        }
    },
    watch: {
        page: function(val) {
            this.page = val;
            this.makePageData();
        },
        search: function(val) {
            this.makePageData();
        },
    },
    mounted() {
        this.record = this.makePageData();
    },
    methods: {
        handleSort() {
            this.makePageData();
        },
        makePageData() {
            axios.get("product/getProduct", {
                params: {
                    search: this.search,
                    type: this.conditionType,
                    page: this.page,
                    perPage: this.perPage,
                }
            }).then((response) => {
                let pageData = [];
                this.isTable = true;

                if (response.data.result) {
                    for (let i = 0; i < response.data.data.length; i++) {
                        pageData = pageData.concat(response.data.data[i])
                    }

                    this.pagination.last_page = Math.ceil(parseInt(response.data.total) / this.perPage);
                } else {
                    this.pagination.last_page = 0;
                }
                this.totalItems = pageData.length;
                this.recordData = pageData;
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
        openConfirm(id) {
            this.id = id;
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: `ยืนยันการลบข้อมูล`,
                text: 'ต้องการลบข้อมูลหรือไม่',
                acceptText: 'ตกลง',
                cancelText: 'ยกเลิก',
                accept: this.acceptAlert
            })
        },
        acceptAlert() {
            axios.post("product/delete", {
                id: this.id,
            }).then((response) => {
                if (response.data.result) {
                    this.$vs.notify({
                        color: 'success',
                        title: 'ลบข้อมูลสำเร็จ',
                        text: 'ทำการลบข้อมูลสำเร็จ',
                        icon: 'check',
                        position: ' top-right',
                    });
                    this.makePageData();
                    this.selected = [];
                } else {
                    this.$vs.notify({
                        title: 'ผิดพลาด',
                        text: 'กรุณาลองใหม่อีกครั้ง',
                        color: "warning",
                        icon: 'warning_amber',
                        position: ' top-right',

                    })
                }
            });
        },
        clearItem() {
            this.idSelect = null;
        }
    }
});
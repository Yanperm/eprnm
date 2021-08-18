const app = new Vue({
    el: '#vue-root',
    data() {

        return {
            pagination: {
                last_page: 0,
            },
            totalItems: 0,
            recordData: [],
            selected: [],
            idSelect: null,
            action: null,
            code: null,
            name: null,
            price: null,
            page: 1,
            perPage: 10,
            record: [],
            search: '',
            conditionType: '1',
           
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
            axios.get("procedure/getProcedure", {
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
                axios.post("procedure/insert", {
                    code: this.code,
                    name: this.name,
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
                        this.price = null;
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
                axios.post("procedure/update", {
                    id: this.idSelect,
                    code: this.code,
                    name: this.name,
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
                        this.price = null;
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
            axios.get("procedure/getMaxId")
                .then((response) => {
                    if (response.data.result) {
                        this.code = "P" + ('000' + (response.data.maxId + 1)).slice(-4);
                    }
                });
            $('#edit-dialog').modal("show");
        },
        editDialog(id) {
            this.action = "update";
            this.idSelect = id;
            axios.get("procedure/getProcedureById", {
                params: {
                    id: id,
                }
            }).then((response) => {
                if (response.data.result) {
                    this.code = response.data.data.ProcedureIDs;
                    this.name = response.data.data.ProcedureName;
                    this.price = response.data.data.ProcedurePrice;
                    $('#edit-dialog').modal("show");
                }
            });
        },
        deleteDialog(id) {
            this.idSelect = id;
            $('#delete-dialog').modal('show');
        },
        deleteItem() {
            axios.post("procedure/delete", {
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
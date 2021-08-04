const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            optionTypeSearch: [
                { text: 'รหัสกลุ่มยาหลัก', value: 1 },
                { text: 'ชื่อกลุ่มยาหลัก', value: 2 },
            ],
            typeSearch: 1,
            popupActive: false,
            action: null,
            field: {
                CategoryName: null,
                CategoryIDs: null,
            },
            id: null,
            page: 1,
            perPage: 10,
            record: [],
            search: '',
            sortBy: '',
            sortType: '',
            selected: [],
            totalItems: 0,
            recordData: [],
            pagination: {
                last_page: 0,
            },
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
        selected: function(val) {
            this.id = val.CategoryID;
            this.field.CategoryIDs = val.CategoryIDs;
            this.field.CategoryName = val.CategoryName;
        },
        typeSearch: function(val) {
            this.makePageData();
        },
    },
    mounted() {
        this.record = this.makePageData();
    },
    methods: {
        handleSort(key, active) {
            this.sortBy = key;
            this.sortType = active;
            this.makePageData();
        },
        makePageData() {
            axios.get("productMain/getProductMain", {
                params: {
                    search: this.search,
                    type: this.typeSearch,
                    sortBy: this.sortBy,
                    sortType: this.sortType,
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
        save() {

            if (this.action == 'insert') {
                axios.post("productMain/insert", {
                    code: this.field.CategoryIDs,
                    name: this.field.CategoryName
                }).then((response) => {
                    if (response.data.result) {
                        this.$vs.notify({
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลข้อมูลสำเร็จ',
                            color: "success",
                            icon: 'check',
                            position: ' top-right',

                        });
                        this.makePageData();
                        this.field.CategoryIDs = null;
                        this.field.CategoryName = null;
                        this.popupActive = false;
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
            } else if (this.action == 'update') {
                axios.post("productMain/update", {
                    id: this.id,
                    code: this.field.CategoryIDs,
                    name: this.field.CategoryName
                }).then((response) => {
                    if (response.data.result) {
                        this.$vs.notify({
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลข้อมูลสำเร็จ',
                            color: "success",
                            icon: 'check',
                            position: ' top-right',

                        });
                        this.makePageData();
                        this.field.CategoryIDs = null;
                        this.field.CategoryName = null;
                        this.popupActive = false;
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
            }
        },
        add() {
            this.field.CategoryIDs = null;
            this.field.CategoryName = null;
            axios.get("productMain/getMaxId")
                .then((response) => {
                    if (response.data.result) {
                        this.field.CategoryIDs = "M" + ('000' + (response.data.maxId + 1)).slice(-3);
                        this.action = 'insert';
                        this.popupActive = true;
                    }
                });
        },
        openConfirm() {
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
            axios.post("productMain/delete", {
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
        productSub(id) {
            window.location.href = 'productSub?category_id=' + id;
        }
    }
});
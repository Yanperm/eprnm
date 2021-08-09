const app = new Vue({
    el: '#vue-root',
    data() {

        return {
            optionTypeSearch: [
                { text: 'รหัสกลุ่มยารอง', value: 1 },
                { text: 'ชื่อกลุ่มยารอง', value: 2 },
                { text: 'ชื่อกลุ่มยาหลัก', value: 3 },
            ],
            category: [],
            typeSearch: 1,
            popupActive: false,
            action: null,
            field: {
                SubName: null,
                SubIDs: null,
                CategoryID: null,
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
        }
    },
    mounted() {
        this.record = this.makePageData();
        this.getProductMain();
    },
    watch: {
        page: function(val) {
            this.page = val;
            this.makePageData();
        },
        selected: function(val) {
            this.id = val.SubID;
            this.field.SubName = val.SubName;
            this.field.SubIDs = val.SubIDs;
            this.field.CategoryID = val.CategoryID;
        },
        search: function(val) {
            this.makePageData();
        },
        typeSearch: function(val) {
            this.makePageData();
        },
    },
    methods: {
        handleSort(key, active) {
            this.sortBy = key;
            this.sortType = active;
            this.makePageData();
        },
        getProductMain() {
            axios.get("productSub/getProductMain")
                .then((response) => {
                    for (let i = 0; i < response.data.data.length; i++) {
                        this.category.push({ text: response.data.data[i].CategoryName, value: response.data.data[i].CategoryID });
                    }
                });
        },
        makePageData() {
            axios.get("productSub/getProductSub", {
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
                axios.post("productSub/insert", {
                    code: this.field.SubIDs,
                    name: this.field.SubName,
                    category: this.field.CategoryID
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
                        this.field.CategoryID = null;
                        this.field.SubName = null;
                        this.field.SubIDs = null;
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
                axios.post("productSub/update", {
                    id: this.id,
                    name: this.field.SubName,
                    category: this.field.CategoryID
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
                        this.field.CategoryID = null;
                        this.field.SubName = null;
                        this.field.SubIDs = null;
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
            this.field.SubIDs = null;
            this.field.SubName = null;
            this.field.CategoryID = null;
            axios.get("productSub/getMaxId")
                .then((response) => {
                    if (response.data.result) {
                        this.field.SubIDs = "S" + ('000' + (response.data.maxId + 1)).slice(-4);
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
            axios.post("productSub/delete", {
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
        productStore(id) {
            //window.location.href = 'productSub?category_id=' + id;
        }
    }
});
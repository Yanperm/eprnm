const app = new Vue({
    el: '#vue-root',
    data() {

        return {
            optionTypeSearch: [
                { text: 'รหัสแผนกส่งตรวจ', value: 1 },
                { text: 'ชื่อแผนกส่งตรวจ', value: 2 },
                { text: 'ชื่อบริษัทที่รับตรวจแล็บ', value: 3 },
            ],
            typeSearch: 1,
            popupActive: false,
            id: null,
            totalItems: 0,
            recordData: [],
            selected: [],
            pagination: {
                last_page: 0,
            },

            isTable: false,
            idSelect: null,
            action: null,
            code: null,
            name: null,
            mainId: null,
            labCompany: [],
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
        selected: function(val) {
            this.id = val.DepID;
            // this.field.DID = val.DID;
            // this.field.DepName = val.DepName;
            // this.field.LabCName = val.LabCName;
        },
        typeSearch: function(val) {
            this.makePageData();
        },
    },
    mounted() {
        this.record = this.makePageData();
        this.getLabCompany();
    },
    methods: {
        getLabCompany() {
            axios.get("department/getLabCompany")
                .then((response) => {
                    this.labCompany = response.data.data;
                });
        },
        handleSort(key, active) {
            this.sortBy = key;
            this.sortType = active;
            this.makePageData();
        },
        makePageData() {
            axios.get("department/getDepartment", {
                params: {
                    search: this.search,
                    type: this.conditionType,
                    type: this. typeSearch,
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
                axios.post("department/insert", {
                    code: this.code,
                    name: this.name,
                    mainId: this.mainId
                }).then((response) => {
                    if (response.data.result) {
                        this.$vs.notify({
                            color: 'success',
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลสำเร็จ',
                            type: 'success',
                            icon: 'check',
                            position: 'top-right',
                        });
                        this.makePageData();
                        this.code = null;
                        this.name = null;
                        this.popupActive = false;
                    } else {
                        this.$vs.notify({
                            title: 'ผิดพลาด',
                            text: 'กรุณาลองใหม่อีกครั้ง',
                            type: 'warning',
                            icon: 'warning_amber',
                            position: ' top-right',
                        });
                    }
                });
            } else if (this.action == 'update') {
                axios.post("department/update", {
                    id: this.idSelect,
                    code: this.code,
                    name: this.name,
                    mainId: this.mainId
                }).then((response) => {
                    if (response.data.result) {
                        this.$vs.notify({
                            color: 'success',
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลสำเร็จ',
                            type: 'success',
                            icon: 'check',
                            position: 'top-right',
                        });
                        this.makePageData();
                        this.code = null;
                        this.name = null;
                        this.mainId = null;
                        this.popupActive = false;
                    } else {
                        this.$vs.notify({
                            title: 'ผิดพลาด',
                            text: 'กรุณาลองใหม่อีกครั้ง',
                            type: 'warning',
                            icon: 'warning_amber',
                            position: ' top-right',
                        });
                    }
                });
            }
        },
        addDialog() {
            this.action = "insert";
            this.name = null;
            this.mainId = "";

            axios.get("department/getMaxId")
                .then((response) => {
                    if (response.data.result) {
                        this.code = "D" + ('000' + (response.data.maxId + 1)).slice(-3);
                        this.popupActive = true;
                    }
                });
        },
        editDialog(id) {
            this.action = "update";
            this.idSelect = id;
            axios.get("department/getDepartmentById", {
                params: {
                    id: id,
                }
            }).then((response) => {
                if (response.data.result) {
                    this.code = response.data.data.DID;
                    this.name = response.data.data.DepName;
                    this.mainId = response.data.data.LabCID;
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
            axios.post("department/delete", {
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
            this.mainId = "";
        }
    }
});
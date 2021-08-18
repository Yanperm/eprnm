const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            optionTypeSearch: [
                { text: 'รหัสบริษัทที่รับตรวจแล็บ', value: 1 },
                { text: 'ชื่อบริษัทที่รับตรวจแล็บ', value: 2 },
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
            this.id = val.LabCID;
            // this.field.LCID = val.LCID;
            // this.field.LabCName = val.LabCName;
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
            axios.get("labCompany/getLabCompany", {
                params: {
                    search: this.search,
                    //type: this.conditionType,
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
                axios.post("labCompany/insert", {
                    code: this.code,
                    name: this.name
                }).then((response) => {
                    if (response.data.result) {
                        this.$vs.notify({
                            color: 'success',
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลสำเร็จ',
                            type: 'success',
                            icon: 'check',
                            position: ' top-right',
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
                axios.post("labCompany/update", {
                    id: this.id,
                    code: this.code,
                    name: this.name
                }).then((response) => {
                    if (response.data.result) {
                        this.$vs.notify({
                            color: 'success',
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลสำเร็จ',
                            type: 'success',
                            icon: 'check',
                            position: ' top-right',
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
            }
        },
        addDialog() {
            this.action = "insert";
            this.name = null;
            axios.get("labCompany/getMaxId")
                .then((response) => {
                    if (response.data.result) {
                        this.code = "CL" + ('000' + (response.data.maxId + 1)).slice(-4);
                        this.popupActive = true;
                    }
                });
        },
        editDialog(id) {
            this.action = "update";
            this.idSelect = id;
            //console.log(id);
            axios.get("labCompany/getLabCompanyById", {
                params: {
                    id: id,
                }
            }).then((response) => {
                //console.log(response.data.result);
                if (response.data.result) {
                    this.code = response.data.data.LCID;
                    this.name = response.data.data.LabCName;
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
            axios.post("labCompany/delete", {
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
const app = new Vue({
    el: '#vue-root',
    data() {

        return {
            optionTypeSearch: [
                { text: 'รหัสการทดสอบ', value: 1 },
                { text: 'ชื่อการทดสอบ', value: 2 },
                { text: 'บริษัทที่รับตรวจแล็บ', value: 3 },
                { text: 'แผนกส่งตรวจ', value: 4 },
            ],
            typeSearch: 1,
            popupActive: false,
            id: null,
            totalItems: 0,
            recordData: [],
            selected: [],
            sortBy: '',
            sortType: '',
            pagination: {
                last_page: 0,
            },

            //isTable: false,
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
            this.id = val.SID;
        },
        typeSearch: function(val) {
            this.makePageData();
        },
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
        handleSort(key, active) {
            this.sortBy = key;
            this.sortType = active;
            this.makePageData();
        },
        makePageData() {
            axios.get("checkList/getCheckList", {
                params: {
                    search: this.search,
                    //type: this.conditionType,
                    type: this. typeSearch,
                    page: this.page,
                    perPage: this.perPage
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
                axios.post("checkList/insert", {
                    code: this.code,
                    name: this.name,
                    mainId: this.mainId,
                    subId: this.subId,
                    cost: this.cost,
                    price: this.price
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
                        this.subId = null;
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
            this.subId = "";
            this.cost = "";
            this.price = "";

            axios.get("checkList/getMaxId")
                .then((response) => {
                    if (response.data.result) {
                        this.code = "T" + ('000' + (response.data.maxId + 1)).slice(-4);
                        this.popupActive = true;
                    }
                });
            
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
                    this.popupActive = true;

                    setTimeout(function() {
                        this.getDepartment()
                        this.subId = result.DepID;
                    }.bind(this), 1000)
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
            axios.post("checkList/delete", {
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
            this.subId = "";
            this.cost = "";
            this.price = "";
        }
    }
});
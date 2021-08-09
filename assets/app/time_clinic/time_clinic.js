const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            //popupActive: false,
            //action: null,
            field: {
                openSunday : null,
                closeSunday : null,
                openMon : null,
                closeMon : null,
                openTue : null,
                closeTue : null,
                openWed : null,
                closeWed : null,
                openThu : null,
                closeThu : null,
                openFri : null,
                closeFri : null,
                openSat : null,
                closeSat : null,

                date : null,
                open : null,
                close : null,
            },
            id: null,
            ID: null,
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
            this.makePageData2();
        },
        search: function(val) {
            this.makePageData2();
        },
        selected: function(val) {
            this.ID = val.id;
            this.field.open = val.open;
            this.field.close = val.close;
            this.field.date = val.data;
        },
    },
   
    mounted() {
        this.record = this.makePageData();
        this.record = this.makePageData2();
        this.getDay();
    },
    methods: {
        handleSort(key, active) {
            this.sortBy = key;
            this.sortType = active;
            this.makePageData();
            this.makePageData2();
        },
        getDay(){
            axios.get("time/getDay").then((response) => {
               this.field.openSunday = response.data.day.TIME_OPEN;
               this.field.closeSunday = response.data.day.TIME_CLOSE;
               this.field.openMon = response.data.day.TIME1;
               this.field.closeMon = response.data.day.CLOSE1;
               this.field.openTue = response.data.day.TIME2;
               this.field.closeTue = response.data.day.CLOSE2;
               this.field.openWed = response.data.day.TIME3;
               this.field.closeWed = response.data.day.CLOSE3;
               this.field.openThu = response.data.day.TIME4;
               this.field.closeThu = response.data.day.CLOSE4;
               this.field.openFri = response.data.day.TIME5;
               this.field.closeFri = response.data.day.CLOSE5;
               this.field.openSat = response.data.day.TIME6;
               this.field.closeSat = response.data.day.CLOSE6;
            });
        },
        makePageData() {
            axios.get("time/getDay", {
                params: {
                    search: this.search,
                    sortBy: this.sortBy,
                    sortType: this.sortType,
                    page: this.page,
                    perPage: this.perPage,
                }
            }).then((response) => {
                let pageData = [];
                this.isTable = true;

                if (response.data.result) {
                    for (let i = 0; i < response.data.day.length; i++) {
                        //pageData = pageData.concat(response.data.day[i])
                    }

                  // this.pagination.last_page = Math.ceil(parseInt(response.data.total) / this.perPage);
                } //else {
                //      this.pagination.last_page = 0;
                //  }
                //  this.totalItems = pageData.length;
                //  this.recordData = pageData;
            });
        },
        makePageData2() {
            axios.get("time/getDateClinic", {
                params: {
                    search: this.search,
                    sortBy: this.sortBy,
                    sortType: this.sortType,
                    page: this.page,
                    perPage: this.perPage,
                }
            }).then((response) => {
                let pageData2 = [];
                this.isTable = true;

                if (response.data.result) {
                    for (let i = 0; i < response.data.date.length; i++) {
                        pageData2 = pageData2.concat(response.data.date[i])
                    }

                   this.pagination.last_page = Math.ceil(parseInt(response.data.total) / this.perPage);
                } else {
                     this.pagination.last_page = 0;
                 }
                 this.totalItems = pageData2.length;
                 this.recordData = pageData2;
            });
        },
        save() {
                axios.post("time/update", {
                    openSunday: this.field.openSunday,
                    closeSunday: this.field.closeSunday,
                    openMon: this.field.openMon,
                    closeMon: this.field.closeMon,
                    openTue: this.field.openTue,
                    closeTue: this.field.closeTue,
                    openWed: this.field.openWed,
                    closeWed: this.field.closeWed,
                    openThu: this.field.openThu,
                    closeThu: this.field.closeTue,
                    openFri: this.field.openFri,
                    closeFri: this.field.closeFri,
                    openSat: this.field.openSat,
                    closeSat: this.field.closeSat,

                }).then((response) => {
                    if (response.data.result) {
                        this.$vs.notify({
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลข้อมูลสำเร็จ',
                            color: "success",
                            icon: 'check',
                            position: 'top-right',

                        });
                    } else {
                        this.$vs.notify({
                            title: 'ผิดพลาด',
                            text: 'กรุณาลองใหม่อีกครั้ง',
                            color: "warning",
                            icon: 'warning_amber',
                            position: 'top-right',
                        })
                    }
                });
        },
        insert() {
            window.location.reload()
                axios.post("time/insert", {
                    
                    open: this.field.open,
                    close: this.field.close,
                    date: this.field.date,


                }).then((response) => {
                    if (response.data.result) {
                        this.$vs.notify({
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลข้อมูลสำเร็จ',
                            color: "success",
                            icon: 'check',
                            position: 'top-right',

                        });
                    } else {
                        this.$vs.notify({
                            title: 'ผิดพลาด',
                            text: 'กรุณาลองใหม่อีกครั้ง',
                            color: "warning",
                            icon: 'warning_amber',
                            position: 'top-right',
                        })
                    }
                });
        },
        acceptAlert() {
            window.location.reload()
            axios.post("time/delete", {
                ID: this.ID,
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
        
    }
});
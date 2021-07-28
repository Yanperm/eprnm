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
   
    mounted() {
        this.record = this.makePageData();
        this.getDay();
    },
    methods: {
        handleSort(key, active) {
            this.sortBy = key;
            this.sortType = active;
            this.makePageData();
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
            axios.get("", {
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
                    for (let i = 0; i < response.data.main.length; i++) {
                        pageData = pageData.concat(response.data.main[i])
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

            //if (this.action == 'update') {
                axios.post("time/update", {
                    id: this.id,
                    openSunday: this.field.openSunday,
                    

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
           // }
        },
    }
});
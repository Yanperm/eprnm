const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            popupActive: false,
            action: null,
            numOfHoliday: 1,
            field: {
                CLOSEDATE: null,
                holiday: [],
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
            this.id = val.colseid;
            //this.field.CLOSEDATE = val.CLOSEDATE;
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
            axios.get("queueClode/getQueueClode", {
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
            console.log(this.field.holiday);

            // if (this.field.CLOSEDATE != null) {
            //     axios.post("queueClode/insert", {
            //         CloseDate: this.field.CLOSEDATE
            //     }).then((response) => {
            //         if (response.data.result) {
            //             this.$vs.notify({
            //                 title: 'สำเร็จ',
            //                 text: 'บันทึกข้อมูลข้อมูลสำเร็จ',
            //                 color: "success",
            //                 icon: 'check',
            //                 position: 'top-right',

            //             });
            //             this.makePageData();
            //             this.field.CLOSEDATE = null;
            //             this.popupActive = false;
            //         } else {
            //             this.$vs.notify({
            //                 title: 'ผิดพลาด',
            //                 text: 'กรุณาลองใหม่อีกครั้ง',
            //                 color: "warning",
            //                 icon: 'warning_amber',
            //                 position: 'top-right',
            //             })
            //         }
            //     });
            // }

            if (this.field.holiday.length > 0) {
                axios.post("queueClode/inserttbclose", {
                    holiday: this.field.holiday
                }).then((response) => {
                    if (response.data.result) {
                        this.$vs.notify({
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลข้อมูลสำเร็จ',
                            color: "success",
                            icon: 'check',
                            position: 'top-right',

                        });
                        this.makePageData();

                        for (let i = 0; i < this.numOfHoliday; i++) {
                            this.field.holiday[i] = null;
                        }
                        this.numOfHoliday = 1;

                        this.popupActive = false;
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
            }
        },

    }
});
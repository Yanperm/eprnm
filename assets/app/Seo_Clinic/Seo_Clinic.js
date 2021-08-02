const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            popupActive: false,
            action: null,
            field: {
                SEO_TITLE: null,
                SEO_META: null,
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
            this.id = val.IDCLINIC;
            this.field.SEO_TITLE = val.SEO_TITLE;
            this.field.SEO_META = val.SEO_META;
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
            axios.get("seoClinic/getSeoClinic", {
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

            if (this.action == 'update') {
                axios.post("seoClinic/update", {
                    id: this.id,
                    seotitle: this.field.SEO_TITLE,
                    seometa: this.field.SEO_META,
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
                        this.field.SEO_TITLE = null;
                        this.field.SEO_META = null;
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
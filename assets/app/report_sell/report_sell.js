const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            // popupActive: false,
            // action: null,
            // field: {
                
            //     CUSTOMERNAME : null, 
            // },
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
            //this.id = val.ci_id;
            // this.field.ci_order = val.ci_order;
            //this.field.ci_date = val.ci_date;
            //this.field.ci_name = val.ci_name;
            // this.field. = val.;
            // this.field.ci_drug = val.ci_drug;
            // this.field.ci_lab = val.ci_lab;
            // this.field.ci_check = val.ci_procedure;
            // this.field.ci_certificate = val.ci_certificate;
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
            axios.get("reportSell/getReport", {
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
                    for (let i = 0; i < response.data.report.length; i++) {
                        pageData = pageData.concat(response.data.report[i])
                    }

                    this.pagination.last_page = Math.ceil(parseInt(response.data.total) / this.perPage);
                } else {
                    this.pagination.last_page = 0;
                }
              
                this.totalItems = pageData.length;
                this.recordData = pageData;
            });
        },
       
    }
});
const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            popupActive: false,
            action: null,
            field: {
                Nameprefix: null,
                UserName: null,
                Email: null,
                Address: null,
                Phone: null,
                License: null,

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
            this.id = val.UserID;
            this.field.Nameprefix = val.Nameprefix;
            this.field.UserName = val.UserName;
            this.field.Email = val.Email;
            this.field.Address = val.Address;
            this.field.Phone = val.Phone;
            this.field.License = val.License;
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
            axios.get("showUser/getShowUser", {
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
    }
});
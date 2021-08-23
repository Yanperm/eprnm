const app = new Vue({
    el: '#vue-root',
    data() {

        return {
            popupEdit: false,
            idSelect: null,
            action: null,
            code: null,
            name: null,
            page: 1,
            perPage: 10,
            record: [],
            search: '',
            conditionType: '1',
            pagination: {
                last_page: 0,
            },
            totalItems: 0,
            recordData: [],
            selected: [],
            id: '',
            nameCommon: '',
            barcode: '',
            price: '',
            cost: '',
            numOfUnit: '',
            unit: '',
            pregCat: '',
            productMain: '',
            productSub: '',
            brandName: '',
            indication: '',
            countUnit: '',
            callingUnit: '',
            frequency: '',
            meal: '',
            suggestion: '',
            productMainOptions: [],
            productSubOptions: [],
            countUnitOptions: [],
            callingUnitOptions: [],
            frequencyOptions: [],
            mealOptions: [],
            suggestionOptions: [],
            pregCatOptions: [{
                text: 'ไม่ระบุ',
                value: ''
            }, {
                text: 'A',
                value: 'A'
            }, {
                text: 'B',
                value: 'B'
            }, {
                text: 'C',
                value: 'C'
            }, {
                text: 'D',
                value: 'D'
            }, {
                text: 'X',
                value: 'X'
            }, ],

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
            this.idSelect = val.ProductID;
            this.id = val.ProID;
            this.nameCommon = val.CommonName;
            this.barcode = val.Barcode;
            this.price = val.PriceSale;
            this.cost = val.PriceBuy;
            this.numOfUnit = val.Digit;
            this.unit = val.Unit;
            this.pregCat = val.PregCat;
            this.productMain = val.CategoryID;
            this.getProductSub();
            this.productSub = val.SubID;
            this.brandName = val.BrandName;
            this.indication = val.Indication;
            this.countUnit = val.CountUnit;
            this.callingUnit = val.CallingUnit;
            this.frequency = val.Frequency;
            this.meal = val.Meal;
            this.suggestion = val.Suggestion;
        },
    },
    mounted() {
        this.record = this.makePageData();
        this.getProductMain();
        this.getDataOption();
    },
    methods: {
        handleSort() {
            this.makePageData();
        },
        makePageData() {
            axios.get("product/getProduct", {
                params: {
                    search: this.search,
                    type: this.conditionType,
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
        getDataOption() {
            axios.get("product/getOptions").then((response) => {

                if (response.data.result) {

                    let data = response.data.data;

                    this.countUnitOptions = [];
                    for (let i = 0; i < data.countUnit.length; i++) {
                        this.countUnitOptions.push({
                            text: data.countUnit[i].detail,
                            value: data.countUnit[i].detail
                        })
                    }

                    this.callingUnitOptions = [];
                    for (let i = 0; i < data.callingUnit.length; i++) {
                        this.callingUnitOptions.push({
                            text: data.callingUnit[i].detail,
                            value: data.callingUnit[i].detail
                        })
                    }

                    this.frequencyOptions = [];
                    for (let i = 0; i < data.frequency.length; i++) {
                        this.frequencyOptions.push({
                            text: data.frequency[i].detail,
                            value: data.frequency[i].detail
                        })
                    }

                    this.mealOptions = [];
                    for (let i = 0; i < data.meal.length; i++) {
                        this.mealOptions.push({
                            text: data.meal[i].detail,
                            value: data.meal[i].detail
                        })
                    }

                    this.suggestionOptions = [];
                    for (let i = 0; i < data.suggestion.length; i++) {
                        this.suggestionOptions.push({
                            text: data.suggestion[i].detail,
                            value: data.suggestion[i].detail
                        })
                    }
                }
            });
        },
        getProductMain() {
            axios.get("product/getProductMain").then((response) => {

                if (response.data.result) {
                    this.productMainOptions = [];

                    let data = response.data.data;
                    for (let i = 0; i < data.length; i++) {
                        this.productMainOptions.push({
                            text: data[i].CategoryName,
                            value: data[i].CategoryID
                        })
                    }
                }
            });
        },
        getProductSub() {
            axios.get("product/getProductSub", {
                params: {
                    mainId: this.productMain,
                }
            }).then((response) => {

                if (response.data.result) {
                    this.productSubOptions = [];
                    let data = response.data.data;
                    for (let i = 0; i < data.length; i++) {
                        this.productSubOptions.push({
                            text: data[i].SubName,
                            value: data[i].SubID
                        })
                    }
                }
            });
        },
        saveData() {
            axios.post("product/update", {
                productId: this.idSelect,
                id: this.id,
                nameCommon: this.nameCommon,
                barcode: this.barcode,
                price: this.price,
                cost: this.cost,
                numOfUnit: this.numOfUnit,
                unit: this.unit,
                pregCat: this.pregCat,
                productMain: this.productMain,
                productSub: this.productSub,
                brandName: this.brandName,
                indication: this.indication,
                countUnit: this.countUnit,
                callingUnit: this.callingUnit,
                frequency: this.frequency,
                meal: this.meal,
                suggestion: this.suggestion,
            }).then((response) => {
                if (response.data.result) {
                    this.$vs.notify({
                        title: 'สำเร็จ',
                        text: 'บันทึกข้อมูลข้อมูลสำเร็จ',
                        color: "success",
                        icon: 'check',
                        position: ' top-right',

                    });
                    this.popupEdit = false;
                    this.makePageData();
                    this.id = '';
                    this.nameCommon = "";
                    this.barcode = "";
                    this.price = "";
                    this.cost = "";
                    this.numOfUnit = "";
                    this.unit = "";
                    this.pregCat = "";
                    this.productMain = "";
                    this.productSub = "";
                    this.brandName = "";
                    this.indication = "";
                    this.countUnit = "";
                    this.callingUnit = "";
                    this.frequency = "";
                    this.meal = "";
                    this.suggestion = "";
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
        openConfirm(id) {
            this.id = id;
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
            axios.post("product/delete", {
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
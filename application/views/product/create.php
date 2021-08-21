<div>
    <h2 class="page-head-title">เพิ่มคลังยาคลินิก</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">เพิ่มคลังยาคลินิก</li>
        </ol>
    </nav>
</div>

<div class="card card-table" id="vue-root">
    <input type="hidden" value="<?php echo $id?>" id="idProduct">
    <div class="row">
        <div class="col-md-6">
            <vs-list>
                <vs-list-header title="เพิ่มยาใหม่"></vs-list-header>
            </vs-list>
            <div class="row mt-4">
                <div class="col-md-6">
                    <vs-input label-placeholder="รหัสยา *" size="large" disabled v-model="id" />
                </div>
                <div class="col-md-6">
                    <vs-input label-placeholder="ชื่อสามัญ *" size="large" v-model="nameCommon" />
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <vs-input label-placeholder="Barcode *" size="large" v-model="barcode" />
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <vs-select class="selectExample" label="กลุ่มยาหลัก *" v-model="productMain">
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in productMainOptions" />
                    </vs-select>
                </div>
                <div class="col-md-6">
                    <vs-select class="selectExample" label="กลุ่มยารอง *" v-model="productSub">
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in productSubOptions" />
                    </vs-select>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <vs-select class="selectExample" label="Preg Cat *" v-model="pregCat">
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in pregCatOptions" />
                    </vs-select>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <vs-input label-placeholder="ราคาทุน *" size="large" v-model="cost" />
                </div>
                <div class="col-md-6">
                    <vs-input label-placeholder="ราคาขาย *" size="large" v-model="price" />
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <vs-input label-placeholder="จำนวนหน่วย *" size="large" v-model="numOfUnit" />
                </div>
                <div class="col-md-6">
                    <vs-input label-placeholder="หน่วย *" size="large" v-model="unit" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <vs-list>
                <vs-list-header title="รายละเอียดยา" size="large"></vs-list-header>
            </vs-list>
            <div class="row mt-4">
                <div class="col-md-6">
                    <vs-input label-placeholder="ชื่อการค้า *" size="large" v-model="brandName" />
                </div>
                <div class="col-md-6">
                    <vs-input label-placeholder="ข้อบ่งใช้ *" size="large" v-model="indication" />
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <vs-select class="selectExample" label="ครั้งล่ะ *" v-model="countUnit" autocomplete>
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in countUnitOptions" />
                    </vs-select>
                </div>
                <div class="col-md-6">
                    <vs-select class="selectExample" label="หน่วย" v-model="callingUnit" autocomplete>
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in callingUnitOptions" />
                    </vs-select>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <vs-select class="selectExample" label="ความถี่ *" v-model="frequency" autocomplete>
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in frequencyOptions" />
                    </vs-select>
                </div>
                <div class="col-md-6">
                    <vs-select class="selectExample" label="มื้ออาหาร" v-model="meal" autocomplete>
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in mealOptions" />
                    </vs-select>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <vs-select class="selectExample" label="ข้อแนะนำ *" v-model="suggestion" autocomplete>
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in suggestionOptions" />
                    </vs-select>
                </div>

            </div>
        </div>

    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <vs-button color="primary" type="filled" @click="addData">เพิ่มยาใหม่</vs-button>
        </div>
    </div>
</div>

<style>
    .vuesax-app-is-ltr .vs-input--label {
        padding-left: 5px;
        font-size: 15px;
    }
</style>

<script>
    const app = new Vue({
        el: '#vue-root',
        data() {
            return {
                id: $('#idProduct').val(),
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
        mounted() {
            this.getProductMain();
            this.getDataOption();
        },
        watch: {
            productMain: function(val) {
                this.getProductSub();
                this.productSubOptions = [];
                this.productSub = '';
            },
        },
        methods: {
            addData() {
                axios.post("product/insert", {
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
                        this.id = parseInt(this.id) + 1;
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
            getDataOption() {
                axios.get("product/getOptions").then((response) => {

                    if (response.data.result) {
                        console.log(response.data.data);
                        let data = response.data.data;

                        this.countUnitOptions = [];
                        for (let i = 0; i < data.countUnit.length; i++) {
                            this.countUnitOptions.push({
                                text: data.countUnit[i].detail,
                                value: data.countUnit[i].id
                            })
                        }

                        this.callingUnitOptions = [];
                        for (let i = 0; i < data.callingUnit.length; i++) {
                            this.callingUnitOptions.push({
                                text: data.callingUnit[i].detail,
                                value: data.callingUnit[i].id
                            })
                        }

                        this.frequencyOptions = [];
                        for (let i = 0; i < data.frequency.length; i++) {
                            this.frequencyOptions.push({
                                text: data.frequency[i].detail,
                                value: data.frequency[i].id
                            })
                        }

                        this.mealOptions = [];
                        for (let i = 0; i < data.meal.length; i++) {
                            this.mealOptions.push({
                                text: data.meal[i].detail,
                                value: data.meal[i].id
                            })
                        }

                        this.suggestionOptions = [];
                        for (let i = 0; i < data.suggestion.length; i++) {
                            this.suggestionOptions.push({
                                text: data.suggestion[i].detail,
                                value: data.suggestion[i].id
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
            }

        },
    });
</script>
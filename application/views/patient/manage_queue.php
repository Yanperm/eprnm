<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span
                                class="table-filter-title">ค้นหาผู้ป่วย</span>
                            <div class="filter-container">
                                <vs-input label="โปรดพิมพ์คำที่ต้องการค้นหา" placeholder="ค้นหา" v-model="search" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span
                                class="table-filter-title">เงื่อนไขการค้นหา</span>
                            <div class="filter-container">
                                <vs-select class="selectExample" label="เงื่อนไขการค้นหา" v-model="conditionType">
                                    <vs-select-item :key="index" :value="item.value" :text="item.text"
                                        v-for="item,index in optionsTypeSearch" />
                                </vs-select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span
                                class="table-filter-title">Date</span>
                            <div class="filter-container">
                                <form>
                                    <v-md-date-range-picker @change="handleChange" v-model="date"
                                        showCustomRangeLabel=false opens="right"></v-md-date-range-picker>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 table-filters pb-xl-4"><span class="table-filter-title">สถานะ</span>
                            <div class="filter-container">

                                <div class="row">
                                    <div class="col-6">
                                        <div class="custom-controls-stacked">
                                            <div class="custom-control custom-checkbox">
                                                <at-checkbox v-model="typeSearch1" label="t1" @on-change="makePageData">
                                                    นัดหมายสำเร็จ</at-checkbox>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <at-checkbox v-model="typeSearch2" label="t2" @on-change="makePageData">
                                                    เช็คอินแล้ว</at-checkbox>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-controls-stacked">
                                            <div class="custom-control custom-checkbox">
                                                <at-checkbox v-model="typeSearch3" label="t3" @on-change="makePageData">
                                                    วันพบแพทย์</at-checkbox>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <at-checkbox v-model="typeSearch4" label="t4" @on-change="makePageData">
                                                    สำเร็จแล้ว</at-checkbox>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="noSwipe">

                    <vs-table :sst="true" @sort="handleSort" v-model="selected" :total="totalItems" :max-items="perPage"
                        :data="recordData">
                        <template slot="thead">
                            <vs-th sort-key="member.CUSTOMERNAME">
                                ผู้ป่วย
                            </vs-th>
                            <vs-th sort-key="booking.DETAIL">
                                สาเหตุที่มาพบแพทย์
                            </vs-th>
                            <vs-th sort-key="member.PHONE">
                                มือถือ/Line
                            </vs-th>
                            <vs-th sort-key="booking.QUES" class="text-center">
                                คิวที่
                            </vs-th>
                            <vs-th sort-key="booking.BOOKDATE" class="text-center">
                                วัน-เวลานัดหมาย
                            </vs-th>
                            <vs-th sort-key="booking.CHECKIN">
                                สถานะ
                            </vs-th>
                            <vs-th>
                                จัดการ
                            </vs-th>
                        </template>
                        <template slot-scope="{data}">
                            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                <vs-td :data="data[indextr].CUSTOMERNAME">
                                    <p style="display:flex"
                                        @click="recordPatient(data[indextr].MEMBERIDCARD, data[indextr].BOOKINGID)">
                                        <vs-avatar></vs-avatar> <span
                                            style="margin-top: 11px;">{{data[indextr].CUSTOMERNAME}}</span>
                                    </p>
                                </vs-td>
                                <vs-td :data="data[indextr].DETAIL">
                                    {{data[indextr].DETAIL}}
                                </vs-td>
                                <vs-td :data="data[indextr].PHONE">
                                    {{data[indextr].PHONE}}
                                </vs-td>
                                <vs-td :data="data[indextr].QUES" class="text-center">
                                    {{data[indextr].QUES}}
                                    <p class="sub-text">
                                        {{data[indextr].BOOK_ON.charAt(0).toUpperCase() + data[indextr].BOOK_ON.substring(1).toLowerCase()}}
                                    </p>
                                </vs-td>
                                <vs-td :data="data[indextr].BOOKTIME" class="text-center">
                                    {{data[indextr].BOOKDATE}}
                                    <p class="sub-text">
                                        {{data[indextr].BOOKTIME}}
                                    </p>
                                </vs-td>
                                <vs-td :data="data[indextr].CHECKIN">
                                    <vs-chip color="success"
                                        v-if="data[indextr].CHECKIN == 1 && data[indextr].STATUS != 2">
                                        เช็คอินแล้ว
                                    </vs-chip>
                                    <vs-chip color="danger"
                                        v-if="data[indextr].CHECKIN == 0 && data[indextr].STATUS != 2">
                                        ยังไม่เช็คอิน
                                    </vs-chip>
                                    <vs-chip v-if="data[indextr].STATUS == 2 && data[indextr].TYPE == 1">
                                        ยกเลิก
                                    </vs-chip>
                                </vs-td>
                                <vs-td :data="data[indextr].BOOKTIME">
                                    <vs-button color="warning" type="filled" v-if="data[indextr].CHECKIN == 0"
                                        @click="checkin(data[indextr].BOOKINGID)">
                                        เช็คอินให้</vs-button>
                                    <vs-button color="danger" type="filled"
                                        v-if="data[indextr].CHECKIN == 1 && data[indextr].STATUS != 2"
                                        @click="openConfirm()">
                                        ยกเลิก</vs-button>
                                    <vs-button disabled type="filled" v-if="data[indextr].STATUS == 2">
                                        ยกเลิกแล้ว</vs-button>
                                </vs-td>
                            </vs-tr>
                        </template>
                    </vs-table>
                    <vs-pagination class="mt-4" :total="pagination.last_page" v-model="page"></vs-pagination>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
.mdrp__activator .activator-wrapper .text-field:focus~label,
.mdrp__activator .activator-wrapper .text-field__filled~label {
    top: -20px;
    font-size: 14px;
    color: #4285f4;
    display: none;
}

.mdrp__activator .activator-wrapper .text-field {
    display: block;
    font-size: 15px;
    margin-top: 19px;
    padding: 4px 9px 9px 16px;
    width: 100%;
    border: none;
    border-bottom: 1px solid #757575;
}

.mdrp-root[data-v-7863e830] {
    position: relative;
    display: inline-block;
    width: 100%;
}

.mdrp__activator .activator-wrapper .bar {
    display: none !important;
    position: relative;
    display: block;
    width: 315px;
}

.custom-control {
    position: relative;
    display: block;
    min-height: 1.428571rem;
    padding-left: 0px;
}

.avatar {
    height: 30px;
    width: 30px;
    border-radius: 50%;
    margin-right: 10px;
}

p {
    margin: 0 0 5px;
}

.at-notification {
    z-index: 999999999 !important;
}
</style>

<script src="https://unpkg.com/moment"></script>
<script src="https://unpkg.com/v-md-date-range-picker/dist/v-md-date-range-picker.min.js">
</script>
<script type="text/javascript">
const app = new Vue({
    el: '#vue-root',
    data() {

        return {
            descriptionItems: [3, 5, 15],
            optionsTypeSearch: [{
                    text: 'ชื่อผู้ป่วย',
                    value: 1
                },
                {
                    text: 'เลขบัตรประชาชน',
                    value: 2
                },
                {
                    text: 'เบอร์โทรศัพท์',
                    value: 3
                },
            ],
            isTable: false,
            page: 1,
            date: [],
            perPage: 10,
            record: [],
            typeSearch1: false,
            typeSearch2: false,
            typeSearch3: false,
            typeSearch4: false,
            search: '',
            conditionType: '1',
            id: null,
            page: 1,
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
        }
    },
    watch: {
        search: function(val) {
            this.makePageData();
        },
        conditionType: function(val) {
            this.makePageData();
        },
        selected: function(val) {
            this.id = val.BOOKINGID
        },
        page: function(val) {
            this.makePageData();
            this.page = val;
        }
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
        checkin(id) {
            axios.post("<?php echo base_url('patient/checkin');?>", {
                    id: id
                })
                .then((response) => {
                    this.$vs.notify({
                        title: 'สำเร็จ',
                        text: 'ทำการเช็คอิน หมายเลขการจอง ' + id + 'สำเร็จ',
                        color: "success",
                        icon: 'check',
                        position: ' top-right',

                    });
                    this.makePageData()

                }, (response) => {});
        },
        handleChange(values) {
            this.date = values
            this.makePageData();
        },
        makePageData() {
            axios.get("<?php echo base_url('patient/getQueue');?>", {
                    params: {
                        search: this.search,
                        type: this.conditionType,
                        typeSearch1: this.typeSearch1,
                        typeSearch2: this.typeSearch2,
                        typeSearch3: this.typeSearch3,
                        typeSearch4: this.typeSearch4,
                        date: this.date,
                        sortBy: this.sortBy,
                        sortType: this.sortType,
                        page: this.page,
                        perPage: this.perPage,
                    }
                })
                .then((response) => {
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
                }, (response) => {

                });
        },
        openConfirm() {
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: `ยืนยันการยกเลิกคิว`,
                text: 'ต้องการยกเลิกคิวหรือไม่',
                acceptText: 'ตกลง',
                cancelText: 'ยกเลิก',
                accept: this.acceptAlert
            })
        },
        acceptAlert() {
            axios.post("<?php echo base_url('patient/cancel');?>", {
                id: this.id,
            }).then((response) => {
                if (response.data.result) {
                    this.$vs.notify({
                        color: 'success',
                        title: 'ลบข้อมูลสำเร็จ',
                        text: 'ทำการยกเลิกคิวสำเร็จ',
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
        recordPatient(memberId, bookingId) {
            console.log('xvsdf');
            setTimeout(function() {
                window.open('<?php echo base_url('recordInformation?id=');?>' + memberId +
                    '&booking_id=' + bookingId, '_blank');
            }, 500);
        }
    }
});
</script>
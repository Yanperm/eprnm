<div id="vue-root">
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header">คิวขณะนี้</div>
                <div class="card-body" style='height: 126px;'>
                    <p>
                        <Center>
                            <font size="72">
                                <?php if (!empty($currentQues[0]->QUES)): echo $currentQues[0]->QUES; endif; ?>
                            </font>
                        </Center>
                    </p>
                    <p> </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header">ช่องบริการที่</div>
                <div class="card-body">
                    <p>
                        <Center>
                            <font size="64">1</font>
                        </Center>
                    </p>
                    <p> </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">คิวเสริม Walk-in</div>
                <div class="card-body">
                    <p>
                        <font color="grey">สามารถทำการเพิ่มคิวเสริม หรือ คิว Walk-in ได้จากปุุุ่มเพิ่มคิวด้านล่างนี้
                            หรือ กด
                            Reset all เพื่อเรียกคิวใหม่ทั้งหมด</font>
                    </p>
                    <a class="btn btn-success" href="javascript:void(0)" @click="popupAddQueue=true"><i
                            class="icon icon-left mdi mdi-plus"></i>เพิ่มคิว</a> &nbsp;

                    <a class="btn btn-primary" href=""> <i class="icon icon-left mdi mdi-notifications-none"></i>
                        ประกาศคิว</a>
                    <a class="btn btn-warning" href="javascript:void(0)"> <i class="icon icon-left mdi mdi-refresh"></i>
                        Reset all</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-table">

                <div class="card-body">
                    <div class="noSwipe">

                        <vs-table stripe :sst="true" @sort="handleSort" v-model="selected" :total="totalItems"
                            :max-items="perPage" :data="recordData">
                            <template slot="thead">
                                <vs-th sort-key="CUSTOMERNAME">
                                    ผู้ป่วย
                                </vs-th>
                                <vs-th sort-key="DETAIL">
                                    สาเหตุที่มาพบแพทย์
                                </vs-th>
                                <vs-th sort-key="PHONE">
                                    มือถือ
                                </vs-th>
                                <vs-th sort-key="QUES" class="text-center">
                                    คิวที่
                                </vs-th>
                                <vs-th sort-key="BOOKTIME">
                                    เวลานัดหมาย
                                </vs-th>
                                <vs-th sort-key="DETAIL">
                                    สถานะ
                                </vs-th>

                                <vs-th sort-key="DETAIL">
                                    เรียกคิว
                                </vs-th>
                                <vs-th sort-key="DETAIL">
                                    ชำระเงิน
                                </vs-th>
                                <vs-th sort-key="DETAIL">
                                    ห้องยา
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
                                    <vs-td :data="data[indextr].BOOKTIME">
                                        {{data[indextr].BOOKTIME}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].BOOKTIME">
                                        {{data[indextr].BOOKTIME}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].BOOKTIME">
                                        <vs-button>เรียกคิว</vs-button>
                                    </vs-td>
                                    <vs-td :data="data[indextr].BOOKTIME">
                                        <vs-button disabled type="filled">รอชำระเงิน</vs-button>
                                    </vs-td>
                                    <vs-td :data="data[indextr].BOOKTIME">
                                        <vs-button disabled type="filled">ไม่มียา</vs-button>
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
    <vs-popup classContent="popup-example" title="เพิ่มคิว" :active.sync="popupAddQueue">


    </vs-popup>
</div>

<style>
.sub-text {
    color: #b5b5b5;
}
</style>

<script>
const app = new Vue({
    el: '#vue-root',
    data() {
        return {
            active: false,
            popupAddQueue: false,
            optionTypeSearch: [{
                    text: 'รหัสกลุ่มยาหลัก',
                    value: 1
                },
                {
                    text: 'ชื่อกลุ่มยาหลัก',
                    value: 2
                },
            ],
            typeSearch: 1,
            popupActive: false,
            action: null,
            field: {
                CategoryName: null,
                CategoryIDs: null,
            },
            id: null,
            page: 1,
            perPage: 100,
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
        typeSearch: function(val) {
            this.makePageData();
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
            axios.get("<?php echo base_url('patient/getQueueToday');?>", {
                params: {
                    search: this.search,
                    type: this.typeSearch,
                    sortBy: this.sortBy,
                    sortType: this.sortType,
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
                console.log(this.recordData);
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
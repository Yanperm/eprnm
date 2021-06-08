<div class="page-head">
    <h2 class="page-head-title">ผู้ป่วย</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">รายชื่อผู้ป่วย</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span class="table-filter-title">ค้นหาผู้ป่วย</span>
                            <div class="filter-container">
                                <form>
                                    <label class="control-label">โปรดพิมพ์คำที่ต้องการค้นหา</label>
                                    <at-input v-model="search" size="small" @blur="makePageData" placeholder="ค้นหา"></at-input>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span class="table-filter-title">เงื่อนไขการค้นหา</span>
                            <div class="filter-container">
                                <label class="control-label">โปรดเลือกเงื่อนไข</label>
                                <form>
                                    <at-select v-model="conditionType" size="large" @on-change="makePageData">
                                        <at-option value="1">ชื่อผู้ป่วย</at-option>
                                        <at-option value="2">เลขบัตรประชาชน</at-option>
                                        <at-option value="3">เบอร์โทรศัพท์</at-option>
                                    </at-select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="noSwipe">
                    <div>
                        <at-table v-if="isTable" size="normal" :columns="columns1" :data="data3" pagination :show-page-total=true></at-table>
                    </div>

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
                data3: [],
                columns1: [{
                    title: 'ผู้ป่วย',
                    key: 'name',
                    render: (h, params) => {
                        return [
                            h('img', {
                                attrs: {
                                    src: params.item.IMAGE || '<?php echo base_url();?>assets/img/avatar6.png',
                                },
                                class: 'avatar',
                            }), h('span', {
                                style: {
                                    color: '#4285f4',
                                    backgroundColor: 'transparent',
                                }
                            }, params.item.CUSTOMERNAME)
                        ];
                    }
                }, {
                    title: "สาเหตุที่มาพบแพทย์",
                    key: 'DETAIL',
                    sortType: 'normal',
                    render: (h, params) => {
                        return [h('p', params.item.DETAIL),
                            h('span', {
                                style: {
                                    display: 'block',
                                    fontSize: '0.8462rem',
                                    color: '#999999'
                                }
                            }, params.item.BOOKINGID)
                        ];
                    }
                }, {
                    title: 'มือถือ/Line',
                    key: 'PHONE',
                    render: (h, params) => {
                        return [h('p', params.item.PHONE),
                            h('span', {
                                style: {
                                    display: 'block',
                                    fontSize: '0.8462 rem',
                                    color: '#999999',
                                }
                            }, params.item.LINEID)
                        ];
                    }

                }, {
                    title: 'คิวที่',
                    key: 'queue',
                    render: (h, params) => {
                        return [
                            h('span', params.item.QUES),
                            h('span', {
                                style: {
                                    display: 'block',
                                    fontSize: '0.8462 rem',
                                    color: '#999999',
                                }
                            }, params.item.BOOK_ON)
                        ];
                    }
                }, {
                    title: 'วันที่นัดหมาย',
                    key: 'bookdate',
                    render: (h, params) => {
                        return [
                            h('span', params.item.BOOKDATE),
                            h('span', {
                                style: {
                                    display: 'block',
                                    fontSize: '0.8462rem',
                                    color: '#999999'
                                }
                            }, params.item.BOOKTIME),

                        ];
                    }
                }, {
                    title: 'สถานะ',
                    key: 'status',
                    render: (h, params) => {
                        if (params.item.CHECKIN == 1) {
                            return [
                                h('span', {
                                    class: 'at-tag at-tag--success'
                                }, [
                                    h('span', {
                                        class: 'at-tag__text'
                                    }, "เช็คอินแล้ว")
                                ]),
                            ];
                        }

                        if (params.item.CHECKIN == 0) {
                            return [
                                h('span', {
                                    class: 'at-tag at-tag--error'
                                }, [
                                    h('span', {
                                        class: 'at-tag__text'
                                    }, "ยังไม่เช็คอิน")
                                ]),
                            ];
                        }
                    },

                }, {
                    title: 'จัดการ',
                    key: 'operation',
                    render: (h, params) => {
                        if (params.item.CHECKIN == 1) {
                            return h('div', [
                                h('AtButton', {
                                    props: {
                                        size: 'small',
                                        hollow: false,
                                        type: 'error',
                                        icon: 'icon-trash-2'
                                    },

                                    style: {
                                        marginRight: '8px'
                                    },
                                    on: {
                                        click: () => {
                                            this.$Message(params.item.name)
                                        }
                                    }
                                }, 'ยกเลิก'),
                            ])
                        }

                        if (params.item.CHECKIN == 0) {
                            return h('div', [
                                h('AtButton', {
                                    props: {
                                        size: 'small',
                                        hollow: false,
                                        type: 'warning',
                                        icon: 'icon-edit'
                                    },
                                    style: {
                                        marginRight: '8px'
                                    },
                                    on: {
                                        click: () => {
                                            this.checkin(params.item.BOOKINGID)
                                        }
                                    }
                                }, 'เช็คอินให้'),
                            ])
                        }
                    },

                }, ],
            }
        },
        mounted() {
            this.record = this.makePageData();
        },
        methods: {
            checkin(id) {
                axios.post("<?php echo base_url('patient/checkin');?>", {
                        id: id
                    })
                    .then((response) => {
                        this.$Notify({
                            title: 'สำเร็จ',
                            duration: 5000,
                            message: 'ทำการเช็คอิน หมายเลขการจอง ' + id + 'สำเร็จ',
                            type: 'success'
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
                            date: this.date
                        }
                    })
                    .then((response) => {
                        let pageData = [];
                        this.isTable = true;

                        if (response.data.result) {
                            for (let i = 0; i < response.data.data.length; i++) {
                                pageData = pageData.concat(response.data.data[i])
                            }
                        }

                        this.data3 = pageData;
                    }, (response) => {

                    });
            }
        }
    });
</script>
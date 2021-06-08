<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span class="table-filter-title">ค้นหาแผนกส่งตรวจ</span>
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
                                        <at-option value="1">รหัสแผนกส่งตรวจ</at-option>
                                        <at-option value="2">ชื่อแผนกส่งตรวจ</at-option>
                                        <at-option value="3">ชื่อบริษัทที่รับตรวจแล็บ</at-option>
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

</script>
<script type="text/javascript">
    const app = new Vue({
        el: '#vue-root',
        data() {

            return {
                isTable: false,
                page: 1,
                perPage: 10,
                record: [],
                search: '',
                conditionType: '1',
                data3: [],
                columns1: [{
                    title: 'รหัสแผนกส่งตรวจ',
                    key: 'DID',
                }, {
                    title: "ชื่อแผนกส่งตรวจ",
                    key: 'DepName',
                    sortType: 'normal',
                    
                }, {
                    title: "ชื่อบริษัทที่รับตรวจแล็บ",
                    key: 'LabCName',
                    sortType: 'normal',
                    
                }, {
                    title: 'จัดการ',
                    key: 'operation',
                    render: (h, params) => {
                        
                            return h('div', [h('AtButton', {
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
                                            this.$Message(params.item.DepID)
                                        }
                                    }
                                }, 'แก้ไข'),
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
                                            this.$Message(params.item.DepID)
                                        }
                                    }
                                }, 'ลบ'),
                            ])
                        
                    },

                }, ],
            }
        },
        mounted() {
            this.record = this.makePageData();
        },
        methods: {
            makePageData() {
                axios.get("<?php echo base_url('department/getDepartment');?>", {
                        params: {
                            search: this.search,
                            type: this.conditionType,
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
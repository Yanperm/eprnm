<div>
    <h2 class="page-head-title">Like</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">Like</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
        <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span class="table-filter-title">ค้นหา Link Youtube</span>
                            <div class="filter-container">
                                <form>
                                    <!-- <label class="control-label">โปรดพิมพ์คำที่ต้องการค้นหา</label> -->
                                    <at-input v-model="search" size="large" placeholder="ค้นหา"></at-input>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
            <div class="card-body">
                <div class="noSwipe">
                    <div>
                        <vs-table :sst="true" @sort="handleSort" v-model="selected" :total="totalItems" :max-items="perPage" :data="recordData">
                            <template slot="thead">
                                <vs-th sort-key="name">
                                    ชื่อ
                                </vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
                                    <vs-td :data="data[indextr].CUSTOMERNAME">
                                        {{data[indextr].CUSTOMERNAME}}
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

</div>
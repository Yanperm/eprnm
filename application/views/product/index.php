<div>
    <h2 class="page-head-title">คลังยา</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item">ยาและเวชภัณฑ์</li>
            <li class="breadcrumb-item active">คลังยา</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
            <div class="row table-filters-container">
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span
                                class="table-filter-title">ค้นหาคลังยา</span>
                            <div class="filter-container">
                                <form>
                                    <label class="control-label">โปรดพิมพ์คำที่ต้องการค้นหา</label>
                                    <at-input v-model="search" size="small" @blur="makePageData" placeholder="ค้นหา">
                                    </at-input>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 table-filters pb-0 pb-xl-4"><span
                                class="table-filter-title">เงื่อนไขการค้นหา</span>
                            <div class="filter-container">
                                <label class="control-label">โปรดเลือกเงื่อนไข</label>
                                <form>
                                    <at-select v-model="conditionType" size="large" @on-change="makePageData">
                                        <at-option value="1">รหัสยา</at-option>
                                        <at-option value="2">ชื่อการค้า</at-option>
                                        <at-option value="3">ชื่อสามัญ</at-option>
                                        <at-option value="4">Barcode</at-option>
                                    </at-select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-md-12 text-right mt-3 mb-3 pr-5">
                            <v-row vs-justify="right">
                                <vs-col vs-offset="9" v-tooltip="'col - 1'" vs-type="flex" vs-justify="center"
                                    vs-align="center" vs-w="3">
                                    <a href="<?php echo base_url('add-product');?>">
                                        <vs-button type="filled" icon="add_circle_outline">เพิ่มข้อมูล
                                        </vs-button>
                                    </a>
                                </vs-col>
                            </v-row>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="noSwipe">
                    <div>
                        <vs-table stripe :sst="true" @sort="handleSort" v-model="selected" :total="totalItems"
                            :max-items="perPage" :data="recordData">
                            <template slot="thead">
                                <vs-th sort-key="ProID">
                                    รหัสยา
                                </vs-th>
                                <vs-th sort-key="BrandName">
                                    ชื่อการค้า
                                </vs-th>
                                <vs-th sort-key="CommonName">
                                    ชื่อสามัญ
                                </vs-th>
                                <vs-th sort-key="Barcode">
                                    Barcode
                                </vs-th>
                                <vs-th class="centerx">
                                    จัดการ
                                </vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                    <vs-td :data="data[indextr].ProID">
                                        {{data[indextr].ProID}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].CommonName">
                                        {{data[indextr].CommonName}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].BrandName">
                                        {{data[indextr].BrandName}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].Barcode">
                                        {{data[indextr].Barcode}}
                                    </vs-td>

                                    <vs-td :data="data[indextr].ProID">
                                        <div class="centerx">
                                            <vs-tooltip text="แก้ไขข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled"
                                                    icon="drive_file_rename_outline" @click="popupEdit=true">
                                                </vs-button>
                                            </vs-tooltip>
                                            <vs-tooltip text="ลบข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" type="filled" icon="delete"
                                                    @click="openConfirm(data[indextr].ProductID)"></vs-button>
                                            </vs-tooltip>
                                        </div>
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
    <vs-popup fullscreen title="แก้ไขคลังยา" :active.sync="popupEdit">
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
                            <vs-select-item :key="index" :value="item.value" :text="item.text"
                                v-for="item,index in productMainOptions" />
                        </vs-select>
                    </div>
                    <div class="col-md-6">
                        <vs-select class="selectExample" label="กลุ่มยารอง *" v-model="productSub">
                            <vs-select-item :key="index" :value="item.value" :text="item.text"
                                v-for="item,index in productSubOptions" />
                        </vs-select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <vs-select class="selectExample" label="Preg Cat *" v-model="pregCat">
                            <vs-select-item :key="index" :value="item.value" :text="item.text"
                                v-for="item,index in pregCatOptions" />
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
                            <vs-select-item :key="index" :value="item.value" :text="item.text"
                                v-for="item,index in countUnitOptions" />
                        </vs-select>
                    </div>
                    <div class="col-md-6">
                        <vs-select class="selectExample" label="หน่วย" v-model="callingUnit" autocomplete>
                            <vs-select-item :key="index" :value="item.value" :text="item.text"
                                v-for="item,index in callingUnitOptions" />
                        </vs-select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <vs-select class="selectExample" label="ความถี่ *" v-model="frequency" autocomplete>
                            <vs-select-item :key="index" :value="item.value" :text="item.text"
                                v-for="item,index in frequencyOptions" />
                        </vs-select>
                    </div>
                    <div class="col-md-6">
                        <vs-select class="selectExample" label="มื้ออาหาร" v-model="meal" autocomplete>
                            <vs-select-item :key="index" :value="item.value" :text="item.text"
                                v-for="item,index in mealOptions" />
                        </vs-select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <vs-select class="selectExample" label="ข้อแนะนำ *" v-model="suggestion" autocomplete>
                            <vs-select-item :key="index" :value="item.value" :text="item.text"
                                v-for="item,index in suggestionOptions" />
                        </vs-select>
                    </div>

                </div>
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <vs-button color="primary" type="filled" @click="saveData">บันทึกข้อมูล</vs-button>
            </div>
        </div>
    </vs-popup>
</div>
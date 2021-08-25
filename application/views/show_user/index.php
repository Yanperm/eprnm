<div>
    <h2 class="page-head-title">ผู้ใช้งานระบบ</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">ผู้ใช้งานระบบ</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">
        <div style="background-color:#CCCCFF;">
                <button type="submit" class="btn  btn-lg" @click="" >
                <i class="icon mdi mdi-account"></i> เพิ่มผู้ใช้งาน</button>
            </div>
            <div class="col-12 ">
                <h3>การจัดการผู้ใช้งาน</h3>
                <label>เพิ่มและแก้ไขข้อมูลเกี่ยวกับผู้ใช้งานระบบคลินิก</label>
            </div><br>
            <div class="card-body">
                <div class="noSwipe">

                    <div>
                        <vs-table :sst="true" @sort="handleSort" v-model="selected" :total="totalItems" :max-items="perPage" :data="recordData">
                            <template slot="thead">
                            <!-- <vs-th sort-key="Nameprefix">
                                    คำนำหน้าชื่อ
                                </vs-th>   -->
                                <vs-th sort-key="UserName">
                                    ชื่อ
                                </vs-th>
                                <vs-th sort-key="UserName">
                                    ประเภท
                                </vs-th>
                                <vs-th sort-key="Email">
                                    E-mail
                                </vs-th>
                                <!-- <vs-th sort-key="Address">
                                    ที่อยู่
                                </vs-th> -->
                                <vs-th sort-key="Phone">
                                    เบอร์โทรศัพท์
                                </vs-th>
                                <!-- <vs-th sort-key="License">
                                    ใบอนุญาต
                                </vs-th> -->
                                <vs-th class ="centerx">
                                    จัดการ
                                </vs-th>
                            </template>
                            <template slot-scope="{data}">
                                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
                                    <!-- <vs-td :data="data[indextr].Nameprefix">
                                        {{data[indextr].Nameprefix}}
                                    </vs-td> -->
                                    <vs-td :data="data[indextr].UserName">
                                        {{data[indextr].UserName}}
                                    </vs-td>
                                    <vs-td :data="data[indextr].UserName">
                                        <!-- {{data[indextr].UserName}} -->
                                    </vs-td>
                                    <vs-td :data="data[indextr].Email">
                                        {{data[indextr].Email}}
                                    </vs-td>
                                    <!-- <vs-td :data="data[indextr].Address">
                                        {{data[indextr].Address}}
                                    </vs-td> -->
                                    <vs-td :data="data[indextr].Phone">
                                        {{data[indextr].Phone}}
                                    </vs-td>
                                    <!-- <vs-td :data="data[indextr].License">
                                        {{data[indextr].License}}
                                    </vs-td> -->
                                    <vs-td :data="data[indextr].date">
                                        <div class="centerx">
                                            <vs-tooltip text="แก้ไขข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" 
                                                type="filled" icon="drive_file_rename_outline" @click="openConfirm()"></vs-button>
                                            </vs-tooltip>
                                            <vs-tooltip text="ลบข้อมูล">
                                                <vs-button color="rgba(112, 128, 144, 0.25)" 
                                                type="filled" icon="delete" @click="openConfirm()"></vs-button>
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
</div>
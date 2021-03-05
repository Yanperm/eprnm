<div class="page-head" id="top">
    <h2 class="page-head-title">จัดการข้อมูลคลินิก</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">จัดการข้อมูลคลินิก</li>
        </ol>
    </nav>
</div>

<div id="app">
    <div class="row">
        <div class="col-lg-12">
            <div id="msg" class="alert alert-msg alert-success alert-icon alert-icon-border alert-dismissible hidden" role="alert">
                <div class="icon"><span class="mdi mdi-check"></span></div>
                <div class="message">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button><strong>สำเร็จ!</strong> ทำการแก้ไขข้อมูลคลินิกสำเร็จ
                </div>
            </div>
        </div>
        <div class="col-md-12">

            <div class="card card-border-color card-border-color-primary">
                <div class="card-header card-header-divider">ข้อมูลคลินิก
                </div>
                <div class="card-body" v-if="clinic" :key="clinic.IDCLINIC" v-for="(item, index) in clinic">
                    <form id="form-clinic" @submit.prevent="submit" >
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">ชื่อคลินิก</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input class="form-control" id="name" name="name" type="text" value="" v-model="clinic_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">ไลน์ไอดี</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input class="form-control" id="line" name="line" type="text" value="" v-model="clinic_line_id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">เบอร์โทรศัพท์</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input class="form-control" id="phone" name="phone" type="text" value="" v-model="clinic_phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">เมลล์</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input class="form-control" id="email" name="email" type="text" value="" v-model="clinic_email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">รายละเอียดที่อยู่</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <textarea class="form-control" id="address" name="address" v-model="clinic_address"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">จังหวัด</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input class="form-control" id="province" name="province" type="text" value="" v-model="clinic_province">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">Latitude</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input class="form-control" id="latitude" name="latitude" type="text" value="" v-model="clinic_latitude">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">Longitude</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input class="form-control" id="longitude" name="latitude" type="text" value="" v-model="clinic_longitude">
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-rounded btn-space btn-primary btn-lg"><i class="icon icon-left mdi mdi-assignment-check"></i>บันทึกการแก้ไข</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .hidden{
        display: none;
    }
    .alert-msg{
        margin-top: 10px;
        position: fixed;
        z-index: 99999;
        width: 26%;
        right: 0px;
        top: 2em;
    }
</style>
<script>
    const app = new Vue({
        el: '#app',
        data: {
            clinic: null,
            clinic_name: null,
            clinic_line_id: null,
            clinic_email: null,
            clinic_phone: null,
            clinic_address: null,
            clinic_province: null,
            clinic_latitude: null,
            clinic_longitude: null,
        },
        mounted() {
            axios
                .get('<?php echo base_url('clinic/data')?>')
                .then((response) => {
                    var data = response.data;
                    if (data.length) {
                        this.clinic = data;
                        this.clinic_name = data[0]["CLINICNAME"];
                        this.clinic_line_id = data[0]["LINE"];
                        this.clinic_email = data[0]["USERNAME"];
                        this.clinic_phone = data[0]["PHONE"];
                        this.clinic_address = data[0]["ADDRESS"];
                        this.clinic_province = data[0]["PROVINCE"];
                        this.clinic_latitude = data[0]["LONG"];
                        this.clinic_longitude = data[0]["LAT"];
                    } else {
                        this.clinic = [];
                    }
                    //  this.dataLoading = false;
                })
                .catch((error) => {
                    console.log(error);
                    // this.dataLoading = false;
                });
        },
        methods: {
            submit: function(e) {
                var form = document.getElementById('form-clinic');
                var formData = new FormData(form);

                axios.post('<?php echo base_url('clinic/update')?>', formData)
                    .then((response) => {
                        var top = $("#top").offset().top;
                        $("html, body").animate({ scrollTop: top }, 1000);
                        $("#msg").removeClass("hidden").attr("aria-hidden", false);
                        $("#msg").fadeIn();

                        setTimeout(function(){ $("#msg").fadeOut(); }, 5000);
                    }, (response) => {
                        // error callback
                    });
            }
        }
    })
</script>

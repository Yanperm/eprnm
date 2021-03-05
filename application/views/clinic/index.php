<script src="https://unpkg.com/vue-input-tag"></script>
<script src="https://unpkg.com/vue-picture-input"></script>
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
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button>
                    <strong>สำเร็จ!</strong> ทำการแก้ไขข้อมูลคลินิกสำเร็จ
                </div>
            </div>
            <div id="msg-error" class="alert alert-msg alert-contrast alert-danger alert-dismissible hidden" role="alert">
                <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                <div class="message">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button>
                    <strong>ไม่สำเร็จ!</strong> เกิดข้อผิดพบาน กรุณาลองใหม่อีกครั้ง
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <form id="form-clinic" @submit.prevent="submit" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                    <div class="card card-border-color card-border-color-primary">
                        <div class="card-header card-header-divider">ข้อมูลคลินิก
                        </div>
                        <div class="card-body">

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


                        </div>
                    </div>
                </div>
                    <div class="col-md-12">
                        <div class="card card-border-color card-border-color-primary">
                            <div class="card-header card-header-divider">ข้อมูลแพทย์
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">แพทย์</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input class="form-control" id="doctor_name" name="doctor_name" type="text" value="" v-model="doctor_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">สาขาที่เชี่ยวชาญ</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input class="form-control" id="PROFICIENT" name="PROFICIENT" type="text" value="" v-model="PROFICIENT">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">ปริญญาบัตรและสถาบันการศึกษา</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input class="form-control" id="DIPLOMA" name="DIPLOMA" type="text" value="" v-model="DIPLOMA">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">วุฒิบัตร</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input-tag v-model="DEGREE" ></input-tag>
                                        <input class="form-control" id="DEGREE" name="degree" type="hidden" value="" v-model="DEGREE">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-border-color card-border-color-primary">
                            <div class="card-header card-header-divider">บริการของคลินิก
                            </div>
                            <div class="card-body">
                                <input-tag v-model="SERVICES" ></input-tag>
                                <input type="hidden" name="services" v-model="SERVICES">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-border-color card-border-color-primary">
                            <div class="card-header card-header-divider">ข้อมูลเข้าระบบ
                            </div>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-border-color card-border-color-primary">
                            <div class="card-header card-header-divider">รูปภาพ
                            </div>
                            <div class="card-body">
                                <picture-input ref="pictureInput"
                                               name="avatar"
                                               width="250"
                                               height="250"
                                               margin="16"
                                               accept="image/jpeg,image/png"
                                               size="10"
                                               :removable="true"
                                               @remove="onRemoved"
                                               removeButtonClass="ui red button"
                                               button-class="btn"
                                               :custom-strings="{
                                                upload: '<h1>Bummer!</h1>',
                                                drag: 'วางไฟล์ที่นี้ หรือ เลือกไฟล์'
                                              }" @change="onChange"></picture-input>
                                    <input type="hidden" v-model="old_avatar" name="old_image">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">


                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-rounded btn-space btn-primary btn-lg"><i class="icon icon-left mdi mdi-assignment-check"></i>บันทึกการแก้ไข</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .hidden {
        display: none;
    }

    .alert-msg {
        margin-top: 10px;
        position: fixed;
        z-index: 99999;
        width: 26%;
        right: 0px;
        top: 2em;
    }
    .vue-input-tag-wrapper .input-tag {
        background-color: #4384f3;
        border-radius: 2px;
        border: 1px solid #4383f2;
        color: #ffffff;
        display: inline-block;
        font-size: 13px;
        font-weight: 400;
        margin-bottom: 4px;
        margin-right: 4px;
        padding: 3px;
    }
    .vue-input-tag-wrapper .input-tag .remove {
        cursor: pointer;
        font-weight: 700;
        color: #ffffff;
    }
</style>
<script>
    Vue.component('input-tag', vueInputTag.default);

    const app = new Vue({
        el: '#app',
        components: {
            'picture-input': PictureInput
        },
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
            doctor_name: null,
            PROFICIENT : null,
            DIPLOMA : null,
            SERVICES : [],
            DEGREE : [],
            image1 : null,
            old_avatar : null
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
                        this.doctor_name = data[0]["DOCTORNAME"];
                        this.PROFICIENT = data[0]["PROFICIENT"];
                        this.DIPLOMA = data[0]["DIPLOMA"];
                        this.SERVICES = data[0]["SERVICE"].split(',');
                        this.DEGREE = data[0]["DEGREE"].split(',');
                        this.old_avatar = data[0]["image"];
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
            submit: function (e) {
                var form = document.getElementById('form-clinic');
                var formData = new FormData(form);

                axios.post('<?php echo base_url('clinic/update')?>', formData)
                    .then((response) => {
                        if (response.data.result) {
                            this.old_avatar = response.data.image_path;
                            var top = $("#top").offset().top;
                            $("html, body").animate({scrollTop: top}, 1000);
                            $("#msg").removeClass("hidden").attr("aria-hidden", false);
                            $("#msg").fadeIn();
                            setTimeout(function () {
                                $("#msg").fadeOut();
                            }, 5000);
                        } else {
                            var top = $("#top").offset().top;
                            $("html, body").animate({scrollTop: top}, 1000);
                            $("#msg-error").removeClass("hidden").attr("aria-hidden", false);
                            $("#msg-error").fadeIn();
                            setTimeout(function () {
                                $("#msg-error").fadeOut();
                            }, 5000);
                        }

                    }, (response) => {
                        // error callback
                        var top = $("#top").offset().top;
                        $("html, body").animate({scrollTop: top}, 1000);
                        $("#msg-error").removeClass("hidden").attr("aria-hidden", false);
                        $("#msg-error").fadeIn();
                        setTimeout(function () {
                            $("#msg-error").fadeOut();
                        }, 5000);
                    });
            },
            onChange (image) {
                console.log('New picture selected!')
                if (image) {
                    console.log('Picture loaded.')
                    this.image = image
                } else {
                    console.log('FileReader API not supported: use the <form>, Luke!')
                }
            },
            onRemoved() {
                this.image = '';
            },
        }
    })
</script>

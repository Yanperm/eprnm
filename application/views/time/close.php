<div class="page-head" id="top">
    <h2 class="page-head-title">วันหยุด</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">วันหยุด</li>
        </ol>
    </nav>
</div>
<div class="main-content container-fluid" id="app">
    <div class="row">
        <div class="col-lg-12">
            <div id="msg" class="alert alert-msg alert-success alert-icon alert-icon-border alert-dismissible hidden" role="alert">
                <div class="icon"><span class="mdi mdi-check"></span></div>
                <div class="message">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button>
                    <strong>สำเร็จ!</strong> ทำการแก้ไขข้อมูลวันหยุดของคลินิกสำเร็จ
                </div>
            </div>
            <div id="msg-error" class="alert alert-msg alert-contrast alert-danger alert-dismissible hidden" role="alert">
                <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                <div class="message">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button>
                    <strong>ไม่สำเร็จ!</strong> เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header card-header-divider">วันหยุดของคลินิก<span class="card-subtitle">ข้อมูลวันหยุดจะแสดงด้านหน้าเว็บไซต์</span></div>
                <div class="card-body">
                    <form id="form-time" @submit.prevent="submit" style="border-radius: 0px;">
                        <div class="form-group row">
                            <label class="col-2 col-sm-3 col-form-label text-sm-right">อาทิตย์</label>
                            <div class="col-4 col-sm-8 col-lg-2 pt-1">
                                <div class="switch-button switch-button-success">

                                    <input type="checkbox" :checked="day0" v-model="day0" name="w1" id="w1">
                                    <span>
                                        <label for="w1"></label>
                                    </span>
                                </div>
                            </div>
                            <div class="col-2" v-if="day0">
                                เปิด <input type="time" name="time_open" class="form-control" v-model="sundayStart">
                            </div>
                            <div class="col-2" v-if="day0">
                                ปิด <input type="time" name="time_close" class="form-control" v-model="sundayEnd">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-sm-3 col-form-label text-sm-right">จันทร์</label>
                            <div class="col-4 col-sm-8 col-lg-2 pt-1">
                                <div class="switch-button switch-button-success">
                                    <input type="checkbox" :checked="day1" v-model="day1" name="w2" id="w2"><span>
                            <label for="w2"></label></span>
                                </div>
                            </div>

                            <div class="col-2" v-if="day1">
                                เปิด <input type="time" class="form-control" v-model="mondayStart" name="time1">
                            </div>
                            <div class="col-2" v-if="day1">
                                ปิด <input type="time" class="form-control" v-model="mondayEnd" name="close1">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">อังคาร</label>
                            <div class="col-4 col-sm-8 col-lg-2 pt-1">
                                <div class="switch-button switch-button-success">
                                    <input type="checkbox" :checked="day2" v-model="day2" name="w3" id="w3"><span>
                            <label for="w3"></label></span>
                                </div>
                            </div>
                            <div class="col-2" v-if="day2">
                                เปิด <input type="time" class="form-control" v-model="tuesdayStart" name="time2">
                            </div>
                            <div class="col-2" v-if="day2">
                                ปิด <input type="time" class="form-control" v-model="tuesdayEnd" name="close2">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">พุธ</label>
                            <div class="col-4 col-sm-8 col-lg-2 pt-1">
                                <div class="switch-button switch-button-success">
                                    <input type="checkbox" :checked="day3" v-model="day3" name="w4" id="w4"><span>
                            <label for="w4"></label></span>
                                </div>
                            </div>

                            <div class="col-2" v-if="day3">
                                เปิด <input type="time" class="form-control" v-model="wednesdayStart" name="time3">
                            </div>
                            <div class="col-2" v-if="day3">
                                ปิด <input type="time" class="form-control" v-model="wednesdayEnd" name="close3">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">พฤหัสบดี</label>
                            <div class="col-4 col-sm-8 col-lg-2 pt-1">
                                <div class="switch-button switch-button-success">
                                    <input type="checkbox" :checked="day4" v-model="day4" name="w5" id="w5"><span>
                            <label for="w5"></label></span>
                                </div>
                            </div>
                            <div class="col-2" v-if="day4">
                                เปิด <input type="time" class="form-control" v-model="thursdayStart" name="time4">
                            </div>
                            <div class="col-2" v-if="day4">
                                ปิด <input type="time" class="form-control" v-model="thursdayEnd" name="close4">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">ศุกร์</label>
                            <div class="col-4 col-sm-8 col-lg-2 pt-1">
                                <div class="switch-button switch-button-success">
                                    <input type="checkbox" :checked="day5" v-model="day5" name="w6" id="w6"><span>
                            <label for="w6"></label></span>
                                </div>
                            </div>

                            <div class="col-2" v-if="day5">
                                เปิด <input type="time" class="form-control" v-model="fridayStart" name="time5">
                            </div>
                            <div class="col-2" v-if="day5">
                                ปิด <input type="time" class="form-control" v-model="fridayEnd" name="close5">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">เสาร์</label>
                            <div class="col-4 col-sm-8 col-lg-2 pt-1">
                                <div class="switch-button switch-button-success">
                                    <input type="checkbox" :checked="day6" v-model="day6" name="w7" id="w7"><span>
                            <label for="w7"></label></span>
                                </div>
                            </div>

                            <div class="col-2" v-if="day6">
                                เปิด <input type="time" class="form-control" v-model="saturdayStart" name="time6">
                            </div>
                            <div class="col-2"  v-if="day6">
                                ปิด <input type="time" class="form-control" v-model="saturdayEnd" name="close6">
                            </div>

                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-rounded btn-space btn-primary btn-lg">บันทึกการแก้ไข</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
</style>
<script>
    const app = new Vue({
        el: '#app',
        data: {
            dayOff: null,
            sundayStart: null,
            sundayEnd: null,
            mondayStart: null,
            mondayEnd: null,
            tuesdayStart: null,
            tuesdayEnd: null,
            wednesdayStart: null,
            wednesdayEnd: null,
            thursdayStart: null,
            thursdayEnd: null,
            fridayStart: null,
            fridayEnd: null,
            saturdayStart: null,
            saturdayEnd: null,
            day0: true,
            day1: true,
            day2: true,
            day3: true,
            day4: true,
            day5: true,
            day6: true,
        },
        mounted() {
            axios
                .get('<?php echo base_url('time/data')?>')
                .then((response) => {
                    var data = response.data;
                    if (data.length) {
                        this.dayOff = data[0]["DAYOFF"];
                        this.sundayStart = data[0]["TIME_OPEN"];
                        this.sundayEnd = data[0]["TIME_CLOSE"];
                        this.mondayStart = data[0]["TIME1"];
                        this.mondayEnd = data[0]["CLOSE1"];
                        this.tuesdayStart = data[0]["TIME2"];
                        this.tuesdayEnd = data[0]["CLOSE2"];
                        this.wednesdayStart = data[0]["TIME3"];
                        this.wednesdayEnd = data[0]["CLOSE3"];
                        this.thursdayStart = data[0]["TIME4"];
                        this.thursdayEnd = data[0]["CLOSE4"];
                        this.fridayStart = data[0]["TIME5"];
                        this.fridayEnd = data[0]["CLOSE5"];
                        this.saturdayStart = data[0]["TIME6"];
                        this.saturdayEnd = data[0]["CLOSE6"];
                        if (data[0]["DAYOFF"] == 0) {
                            this.day0 = false;
                        } else if (data[0]["DAYOFF"] == 1) {
                            this.day1 = false;
                        } else if (data[0]["DAYOFF"] == 2) {
                            this.day2 = false;
                        } else if (data[0]["DAYOFF"] == 3) {
                            this.day3 = false;
                        } else if (data[0]["DAYOFF"] == 4) {
                            this.day4 = false;
                        } else if (data[0]["DAYOFF"] == 5) {
                            this.day5 = false;
                        } else if (data[0]["DAYOFF"] === '6') {

                            this.day6 = false;
                        }
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
                var form = document.getElementById('form-time');
                var formData = new FormData(form);

                axios.post('<?php echo base_url('time/update')?>', formData)
                    .then((response) => {
                        if (response.data.result) {

                            this.dayOff = response.data.dayOff;
                            if (this.dayOff == 0) {
                                this.day0 = false;
                            } else if (this.dayOff == 1) {
                                this.day1 = false;
                            } else if (this.dayOff == 2) {
                                this.day2 = false;
                            } else if (this.dayOff == 3) {
                                this.day3 = false;
                            } else if (this.dayOff == 4) {
                                this.day4 = false;
                            } else if (this.dayOff == 5) {
                                this.day5 = false;
                            } else if (this.dayOff == 6) {
                                this.day6 = false;
                            }

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
        }
    })
</script>
<div>
    <h2 class="page-head-title">วันหยุดคลินิก</h2>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb page-head-nav">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">วันหยุดคลินิก</li>
        </ol>
    </nav>
</div>
<div class="row" id="vue-root">
    <div class="col-md-12">
        <div class="card card-table">

            <h2 class="page-head-title">ทดสอบ</h2>

                <div id='calendar'></div>
            
        </div>
    </div>
</div>


<script>
    

    let event;
    $.post("restDay/getDataRest", function(data){
        console.log(data.data)
        //console.log(event)

    //  calendar.fullCalendar('renderEvent',{
    //                 title: 'ถูกจองแล้ว',
    //                 start: '2021-08-02',
    //                 end: '2021-08-02',
    //                 color: 'red',
    //                 textColor: 'white'
    //  })
       
       
    });

    var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
        // eventColor: 'green',
        events: 
        [ 
            {
                title: 'ถูกจองแล้ว',
                start: '2021-08-01',
                end: '2021-08-01',
                color: 'red',
                textColor: 'white'
            },
        ]

        // eventSources: [

        // // your event source
        // {
        // url: 'restDay/getDataRest', // use the `url` property
        // color: 'yellow',    // an option!
        // textColor: 'black'  // an option!
        // }

        // // any other sources...

        // ]

    });
    calendar.render();


    
    

</script>


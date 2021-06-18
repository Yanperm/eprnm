<div class="user-profile">
    <div class="row">
        <div class="col-12">
            <div class="user-display">
                <div class="user-display-bg"><img src="<?php echo base_url();?>assets/img/bg_profile.jpg" alt="Profile Background"></div>
                <div class="user-display-bottom">
                    <div class="user-display-avatar"><img src="<?php echo base_url();?>assets/img/avatar6.png" alt="Avatar"></div>
                    <div class="user-display-info">
                        <div class="name">
                            <?php echo $member->CUSTOMERNAME;?>
                        </div>
                        <div class="nick"><span class="mdi mdi-assignment-account"></span>
                            <?php echo $member->IDCARD ?? '-' ;?>
                        </div>
                    </div>
                    <div class="row user-display-details">
                        <div class="col-2">
                            <div class="title" align="center">Age (year)</div>
                            <div class="counter" align="center"></div>
                        </div>
                        <div class="col-2">
                            <div class="title" align="center">Blood (group)</div>
                            <div class="counter" align="center"></div>
                        </div>
                        <div class="col-2">
                            <div class="title" align="center">Height (cm)</div>
                            <div class="counter" align="center"></div>
                        </div>
                        <div class="col-2">
                            <div class="title" align="center">Weight (kg)</div>
                            <div class="counter" align="center"></div>
                        </div>
                    </div>
                </div>
                <!--ROW-->
            </div>
            <!--DIV user-profile-->
        </div>
    </div>
</div>
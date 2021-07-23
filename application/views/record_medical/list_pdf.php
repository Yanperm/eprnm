<style>
 body {
  font-family: 'TH SarabunPSK';
  font-size : 15pt;
  margin : 0px;
 }
 table{
  width : 100%;
  border-collapse: collapse;
 }
 table { page-break-inside:auto; }
 .text_center{
   text-align : center;
   font-size: 18pt;
   
 }
 .text_right{
   text-align : right;
 }
 .medical_name{
   text-align : left;
   font-size: 12pt;
 }
 .use{
   font-size: 8pt;
 }
 .ph2{
   font-size: 18pt;
 }
</style>

<table cellpadding="2">
  <tr bgcolor="#EBEBEB" border=1 > 
    <td colspan="2" class="text_center"><b><?php echo $clinicName;?></b></td>
  </tr>
  <tr> 
    <td><?php echo $customerName;?></td>
    <td class="text_right"><?php echo $dateMedical;?></td>
  </tr>
  <tr bgcolor="#EBEBEB" > 
    <td class="medical_name"><b><?php echo $medicalName;?></b></td>
    <td class="text_right">จำนวน <?php echo $number;?> <?php echo $unit;?></td>
  </tr>
  <tr> 
    <td  colspan="2"  class='medical_name'>ครั้งล่ะ <?php echo $ph3;?> <?php echo $ph4;?> <?php echo $ph5;?></td>
  </tr>
  <tr> 
    <td  colspan="2" ><?php echo $ph6;?></td>
  </tr>
  <tr> 
    <td  colspan="2"  class='use'><i><b>***<?php echo $ph7;?></b></i></td>
  </tr>
  <tr> 
    <td  colspan="2"  class='ph2'><?php echo $ph2;?></td>
  </tr>
</table>
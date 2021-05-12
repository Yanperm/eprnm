<div class="row">
	<div class="col-lg-4">
		<div class="card card-border-color card-border-color-primary">
			<div class="card-header">คิวขณะนี้</div>
			<div class="card-body" style='height: 126px;'>
				<p>
					<Center>
						<font size="72"><?php if (!empty($currentQues[0]->QUES)): echo $currentQues[0]->QUES; endif; ?></font>
					</Center>
				</p>
				<p> </p>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="card card-border-color card-border-color-primary">
			<div class="card-header">ช่องบริการที่</div>
			<div class="card-body">
				<p>
					<Center>
						<font size="64">1</font>
					</Center>
				</p>
				<p> </p>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="card">
			<div class="card-header">คิวเสริม Walk-in</div>
			<div class="card-body">
				<p>
					<font color="grey">สามารถทำการเพิ่มคิวเสริม หรือ คิว Walk-in ได้จากปุุุ่มเพิ่มคิวด้านล่างนี้ หรือ กด Reset all เพื่อเรียกคิวใหม่ทั้งหมด</font>
				</p>
				<a class="btn btn-success" href="#"><i class="icon icon-left mdi mdi-plus"></i>เพิ่มคิว</a> &nbsp; &nbsp; &nbsp;
				<a class="btn btn-primary" href="#"> <i class="icon icon-left mdi mdi-notifications-none"></i> ประกาศคิว</a>
				<a class="btn btn-warning" href="#"> <i class="icon icon-left mdi mdi-refresh"></i> Reset all</a>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card card-table">

			<div class="card-body">
				<div class="noSwipe">
					<table class="table table-striped table-hover be-table-responsive" id="table1">
						<thead>
							<tr>
								<th style="width:5%;">
									<div class="custom-control custom-control-sm custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="check5">
										<label class="custom-control-label" for="check5"></label>
									</div>
								</th>
								<th style="width:20%;">ผู้ป่วย</th>
								<th style="width:17%;">สาเหตุที่มาพบแพทย์</th>
								<th style="width:15%;">มือถือ</th>
								<th style="width:10%;text-align:center">คิวที่</th>
								<th style="width:10%;">วันที่นัดหมาย</th>
								<th style="width:10%;">สถานะ</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($queue as $item):?>
							<tr class="success done">
								<td>
									<div class="custom-control custom-control-sm custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="check6">
										<label class="custom-control-label" for="check6"></label>
									</div>
								</td>
								<td class="user-avatar cell-detail user-info"><img class="mt-0 mt-md-2 mt-lg-0" src="<?php echo base_url();?>assets/img/avatar6.png" alt="Avatar"><span><?php echo $item['CUSTOMERNAME']; ?></span><span class="cell-detail-description">อายุ 24 ปี</span></td>
								<td class="cell-detail" data-project="Bootstrap"><span><?php echo $item['DETAIL']; ?></span><span class="cell-detail-description"><?php echo $item['BOOKINGID']; ?></span></td>
								<td class="cell-detail"><span class="cell-detail-description"><?php echo $item['PHONE']; ?></span></td>

								</td>
								<td class="cell-detail text-center"><span><?php echo $item['QUES']; ?></span><span class="cell-detail-description"><?php echo $item['BOOK_ON']; ?></span></td>
								<td class="cell-detail"><span class="date"><?php echo $item['BOOKDATE']; ?></span><span class="cell-detail-description"><?php echo $item['BOOKTIME']; ?></span></td>
								<td class="text-right">
									<div class="btn-group btn-hspace">
										<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">เช็คอินแล้ว <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
										<div class="dropdown-menu" role="menu"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
											<div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
										</div>
									</div>
								</td>
							</tr>
						<?php endforeach;?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

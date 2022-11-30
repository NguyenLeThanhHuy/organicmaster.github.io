<?php
	$title = 'Quản lý người dùng';
	$baseUrl = '../';
	require_once($baseUrl.'layouts/header.php');

	$sql = "SELECT * from user";
	$data = executeResult($sql);
?>
<style> 
	.nav-item:nth-child(3) {
		background-color: #c1c1c1;
	}
</style>
<div class="row">
	<div class="col-md-12 table-responsive" style="margin-top: 30px;">
		<h3>Quản lý người dùng</h3>
		<table class="table table-bordered table-hover" style="margin-top: 15px;">
			<!-- <thead> -->
				<tr>
					<th>STT</th>
					<th>Họ & tên</th>
					<th>Email</th>
					<th style="width: 50px;">Tùy chỉnh</th>
					<th style="width: 50px;">Tùy chỉnh</th>
				</tr>
			<!-- </thead> -->
			<!-- <tbody> -->
				<?php
				$index = 0;
				foreach($data as $item) {
					echo '
						<tr>
						<th>'.(++$index).'</th>
						<td>'.$item['fullname'].'</td>
						<td>'.$item['email'].'</td>
						<th style="width: 50px;" >
							<button class="btn btn-warning">Sửa</button>
						</th>
						<th style="width: 50px;" >
							<button class="btn btn-danger">Xóa</button>
						</th>
						</tr>
					';
				}
				?>
			<!-- </tbody> -->
		</table>
	</div>
</div>

<?php
	require_once($baseUrl.'layouts/footer.php');
?>
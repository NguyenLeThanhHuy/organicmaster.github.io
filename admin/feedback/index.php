<?php
	$title = 'Quản lý phản hồi';
	$baseUrl = '../';
	require_once($baseUrl.'layouts/header.php');
    $sql = "SELECT * FROM feedback";
    $data = executeResult($sql);
?>
<style> 
	.nav-item:nth-child(4) {
		background-color: #c1c1c1;
	}
</style>
<div class="row">
	<div class="col-md-12 table-responsive" style="margin-top: 30px;">
		<h3>Quản lý Phản hồi</h3>
		<table class="table table-bordered table-hover" style="margin-top: 15px;">
			<!-- <thead> -->
				<tr>
					<th>STT</th>
					<th>Họ & tên</th>
					<th>SĐT</th>
					<th>Email</th>
					<th>Tiêu đề</th>
					<th>Nội dung</th>
				</tr>
				<?php
				$index = 0;
				foreach($data as $item) {
					echo '
						<tr>
						<th>'.(++$index).'</th>
						<td>'.$item['user_name'].'</td>
						<td>'.$item['phone'].'</td>
						<td>'.$item['email'].'</td>
						<td>'.$item['title'].'</td>
						<td>'.$item['content'].'</td>
                        </tr>
					';
				}
				?>
		</table>
	</div>
</div>

<?php
	require_once($baseUrl.'layouts/footer.php');
?>
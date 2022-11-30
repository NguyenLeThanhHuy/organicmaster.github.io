<?php
    $title = "Đặt hàng";
    $baseUrl = '../';
    include_once ($baseUrl.'layouts/header.php');
    if(!empty($_POST)) {
        $fullname_order = getPost('name');
        $phone_number = getPost('phone');
        $email = getPost('email');
        $matinh_tp =  getPost('matp');
        $maquan_huyen = getPost('maqh');
        if($matinh_tp != "#") {
            $sql = "SELECT name FROM devvn_tinhthanhpho WHERE matp='$matinh_tp'";
            $data = executeResult($sql,true);
            $tinh_tp = $data['name'];
        }   
        if($maquan_huyen != "#") {
            $sql = "SELECT name FROM devvn_quanhuyen WHERE maqh='$maquan_huyen'";
            $data = executeResult($sql,true);
            $quan_huyen = $data['name'];
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $xa_phuong = getPost('maphuongxa');
        $address = $xa_phuong.','.$quan_huyen.','.$tinh_tp;
        $created_at = date('Y-m-d h:m:s');
        $sql = "SELECT product_id,num FROM cart WHERE user_name = '$user_name'";
        $data = executeResult($sql);
        foreach($data as $item) {
            $product_id = $item['product_id'];
            $num = $item['num'];
            if($address != null) {
                $sql = "INSERT INTO  orders (user_name,user_name1,phone_number,email,address,created_at,product_id,num,status) VALUES 
                ('$fullname_order','$user_name','$phone_number','$email','$address','$created_at','$product_id','$num',0)";
                execute($sql);
                
                header("Location: ../success");
            } else {
                echo 'VUI LÒNG ĐIỀN ĐẦY ĐỦ THÔNG TIN';
            }
        }
    }
?>
<link rel="stylesheet" href="<?=$baseUrl?>assets/css/checkouts.css">
<link rel="stylesheet" href="<?=$baseUrl?>assets/css/checkouts_product.css">
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<style>
    .phuong-thuc-pay-items input {
    margin-top: 5px;
    }
    .phuong-thuc-pay-items span {
    font-size: 18px;
    margin-left: 10px;
}
</style>
<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_breadcrumb.png" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page">Đặt hàng - Oars Organic</p>
        </div>
    </div>
</div>
<div class="checkouts">
    <div class="grid wide">
        <div class="row">
            <div class="col l-7 c-12">
                <div class="infor-order">
                    <form action="" method="post">
                        <div class="title-infor">
                            <h2>Thông tin giao hàng</h2>
                        </div>
                        <div class="form-group">
                            <div class="input-item">
                                <input type="text" name="name" placeholder="Họ và tên người nhận hàng" required>
                            </div>
                            <div class="input-item">
                                <input type="email" name="email" placeholder="Email" class="input-email" required>
                                <input type="phone" name="phone" placeholder="Số điện thoại" required>
                            </div>
                            <div class="input-item">
                                <div class="tinh-thanh-pho flex">
                                    <label for="">Tỉnh/thành phố:</label>
                                    <select  name="matp" id="matp" required>
                                        <option value="#">Chọn tỉnh/thành phố</option>
                                        <?php
                                        $sql = "SELECT * FROM devvn_tinhthanhpho";
                                        $data = executeResult($sql);
                                        foreach ($data as $item=>$key) {
                                            echo '<option value="'.$key['matp'].'">'.$key['name'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="input-item">
                                <div class="quan-huyen-main flex">
                                    <label for="">Quận/huyện:</label>
                                    <select  name="maqh" id="maqh" required>
                                        <option value="#">Chọn quận/huyện</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-item">
                                <div class="xa-phuong flex">
                                    <label for="">Thị trấn/xã/phường:</label>
                                    <select  name="maphuongxa" id="phuongxa" required>
                                    <option value="#">Chọn xã/phường</option>
                                    </select>
                                </div>  
                            </div>
                            <div class="phuong-thuc-pay" style="margin-top:20px;">
                                <div class="phuong-thuc-pay-items-box">
                                    <div class="phuong-thuc-pay-items flex">
                                        <input required="" type="radio" name="radio" value="Thanh toán khi nhận hàng">
                                        <span>Thanh toán khi nhận hàng</span>
                                    </div>
                                </div>
                                <div class="phuong-thuc-pay-items-box">
                                    <div class="phuong-thuc-pay-items flex">
                                        <input required="" type="radio" name="radio" value="Chuyển khoản ngân hàng">
                                        <span>Chuyển khoản ngân hàng</span>
                                    </div>
                                </div>
                                <div class="phuong-thuc-pay-items-box">
                                    <div class="phuong-thuc-pay-items flex">
                                        <input required="" type="radio" name="radio" value="Thanh toán với PayPal">
                                        <span>Thanh toán với PayPal</span>
                                    </div>
                                </div>
                                <div class="phuong-thuc-pay-items-box">
                                    <div class="phuong-thuc-pay-items flex">
                                        <input required="" type="radio" name="radio" value="Quét mã MoMo">
                                        <span>Quét mã MoMo</span>
                                    </div>
                                </div>
                                <div class="phuong-thuc-pay-items-box">
                                    <div class="phuong-thuc-pay-items flex">
                                        <input required="" type="radio" name="radio" value="Cổng thanh toán nội địa OnePay">
                                        <span>Cổng thanh toán nội địa OnePay</span>
                                    </div>
                                </div>
                                <div class="phuong-thuc-pay-items-box">
                                    <div class="phuong-thuc-pay-items flex">
                                        <input required="" type="radio" name="radio" value="Cổng thanh toán Quốc tế OnePay">
                                        <span>Cổng thanh toán Quốc tế OnePay</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="infor-order-end">
                            <div class="go-to-cart">
                                <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
                                <a href="../cart" class="tag-a">Giỏ hàng</a>
                            </div>
                            <div class="continue-pay">
                                <button type="submit">Hoàn tất đơn hàng</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            include_once('../layouts/checkout_product.php');
            ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#matp').change(function() {
            var a = $(this).val()
            $.get("a-jax1.php",{a_ajax1:a},function(data) {
                $("#maqh").html(data);
                $('#maqh').change(function() {
                var b = $(this).val()
                $.get("a-jax2.php",{a_ajax2:b},function(data) {
                    $("#phuongxa").html(data);
                })
        })
            })
        })
    })
</script>
<?php
    include_once ($baseUrl.'layouts/footer.php');
?>
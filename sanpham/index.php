<?php
	$baseUrl = '../';
    include_once('../database/dbhelper.php');
    if(isset($_GET["slug"])) {
        $slug = $_GET["slug"];
        $sql = "SELECT * FROM product WHERE slug = '$slug'";
        $dataProduct = executeResult($sql,true);
        if($dataProduct == null) {
            header('Location: ../');
        }
    }else {
        header('Location: ../');
    }
    $id = $dataProduct['id'];
    $category_id = $dataProduct['category_id'];
    $title = $dataProduct['name'];
    include_once ($baseUrl.'layouts/header.php');
    $UrlCartView = '..';
    include ($baseUrl.'cart/add_cart.php');
    
?>
<link rel="stylesheet" href="<?=$baseUrl?>assets/css/chitietsanpham.css">
<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_breadcrumb.png" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page"><?=$dataProduct['name']?></p>
        </div>
    </div>
</div>

<div class="grid wide">
    <div class="chitietsanpham">
        <div class="chitiet-header">
            <div class="row">
                <div class="col l-6 c-12">
                    <?php 
                        
                        // $x = $dataProduct['product_type'];
                        echo '<div class="chitiet-big-img">
                                <img src="'.$baseUrl.$dataProduct['img'].'" alt="" style="object-fit: cover">
                            </div>';
                    ?>
                    <div class="chitiet-small-img">
                        <?php
                        echo ' <div class="chitiet-small-box-img " style="height: 75px">
                                    <img src="'.$baseUrl.$dataProduct['img'].'" alt="" >
                                 </div>';
                        $sql = "SELECT img_desct FROM img_desct WHERE product_id = $id";
                        $img_desctItems = executeResult($sql);
                            foreach ($img_desctItems as $a => $b) {
                                foreach ($b as $c => $d) {
                                    $e = $baseUrl.$d;
                                    echo '<div class="chitiet-small-box-img " style="height: 75px">
                                            <img src="'.$e.'" alt="" >
                                        </div>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col l-6 c-12">
                    <div class="chitiet-description">
                        <div class="type-product">
                            <a href="" class="tag-a"><span style="text-transform: uppercase;">Rau c???</span></a>
                        </div>
                        <div class="group-status">
                            <span class="frist-status">
                                Th????ng hi???u: <span class="status-name">Vinmart</span>
                            </span>
                            <span class="frist-status status-2">
                                <span class="line_tt hidden-sm" style="margin-right: 10px;">|</span>
                                T??nh tr???ng: <span class="status-name">C??n h??ng</span>
                            </span>
                        </div>
                        <div class="chitiet-des-name">
                            <span><?=$dataProduct['name']?></span>
                        </div>
                        <div class="chitiet-des-price">
                            <span><?=$dataProduct['price']?><sup>??</sup></span>
                        </div>
                        <div class="product-description">
                            <span>Th??ng tin s???n ph???m ??ang ???????c c???p nh???t</span>
                        </div>
                        <form method="post" class="quantity-product">
                                <div class="box-quantity-product">
                                    <div class="so-luong">
                                        <h1>S??? l?????ng: </h1>
                                    </div>
                                    <input type="button" value="-" class="tru">
                                        <input type="number" name="num" id="" class="value-quantity" value="1">
                                    <input type="button" value="+" class="cong">
                                </div>
                                <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
                                <?php
                                    if(isset($_SESSION['email'])) {
                                        $Url_cart = 'cart/cart_home.php?add_to_cart='.$dataProduct['id'];
                                    }else {
                                        $Url_cart = 'authen/login';
                                    }
                                    echo '<button onclick=alertChitiet() data-title="'.$Url_cart.'" type="submit"  name="btn-add-cart" value="'.$id.'" class="chitiet-add-cart ">
                                        <h3>Th??m v??o gi??? h??ng</h3>
                                    </button>';
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-product" style="margin-bottom: 30px;">
            <img src="../assets/img/bg_pro.jpg" xriginal="" alt="">
            <h1>OARS</h1>
            <h3>Th???c ph???m an to??n 100%</h3>
        </div>
        <div class="chitiet-body">
            <div class="chitiet-body-header">
                <div class="chitiet-body-title">
                    <span class="chitiet-title-mota chitiet-body-active" data-title="#chitiet-mota">
                        M?? t???
                    </span>
                    <span class="chitiet-title-rate" data-title="#chitiet-rate">????NH GI?? <p class="quantity-rate">(0)</p></span>
                </div>
                <div class="chitiet-mota chitiet-active" id="chitiet-mota">
                    <div class="chitiet-mota-text"><?=$dataProduct['description']?></div>
                </div>
                <div class="chitiet-rate" id="chitiet-rate">
                    <span>Ch??a c?? ????nh gi?? n??o</span>
                    <div class="chitiet-rate-foot">Ch??? nh???ng kh??ch h??ng ???? ????ng nh???p v?? mua s???n ph???m n??y m???i c?? th??? ????a ra ????nh gi??.</div>
                </div>
            </div>
        </div>
        <div class="chitiet-foot">
            <div class="chitiet-foot-title">
                <span>S???N PH???M T????NG T???</span>
            </div>
            <div class="grid wide product-selling-main">
                <div class="row">
                    <?php
                        $sql = "SELECT * FROM product WHERE id != $id AND category_id = '$category_id' limit 4";
                        $dataProduct = executeResult($sql);
                        foreach($dataProduct as $item) {
                            echo '
                                <div class="col l-3 c-6">
                                    <div class="content-tab-item">
                                        <div class="product-thumnail">
                                            <a href="'.$baseUrl.'sanpham/?slug='.$item['slug'].'">
                                                <img src="'.$baseUrl.$item['img'].'" alt="">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <div class="product-name">
                                                <h3>'.$item['name'].'</h3>
                                            </div>
                                            <div class="product-price">
                                                <h3>'.number_format($item['price']).'</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	require_once($baseUrl.'layouts/footer.php');
?>
<script src="../assets/js/chitiet.js"></script>
<script>
    function alertChitiet() {
            const link_cart = 'cart/cart_home.php'
            const a = document.querySelector('.chitiet-add-cart')
            const attr = a.getAttribute('data-title')
            if(attr.indexOf(link_cart) !== -1) {
                return;
            }else {
                alert('B???n h??y ????ng nh???p ????? th??m s???n ph???m v??o gi??? h??ng c???a m??nh!!!')
            }
    }
</script>
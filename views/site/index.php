<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Quản lý kho</h1>

        
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Xuất kho</h2>
                <p><a class="btn btn-default" href="/index.php?r=stockin%2Findex">Quản lý nhập kho</a></p>
				<p><a class="btn btn-default" href="/index.php?r=stockin%2Fcreate">Nhập kho thêm mới</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Nhập kho</h2>
                <p><a class="btn btn-default" href="/index.php?r=delivery%2Findex">Quản lý xuất kho</a></p>
				<p><a class="btn btn-default" href="/index.php?r=delivery%2Fcreate">Xuất kho thêm mới</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Thu chi</h2>
				<p><a class="btn btn-default" href="/index.php?r=collection%2Findex">Quản lý thu chi</a></p>
				<p><a class="btn btn-default" href="/index.php?r=collection%2Fcreate">Thêm mới thu chi</a></p>
            </div>
			
			<div class="col-lg-4">
                <h2>Báo cáo</h2>
				<p><a class="btn btn-default" href="/index.php?r=avg%2Findex">Báo cáo số lượng tồn</a></p>
				<p><a class="btn btn-default" href="/index.php?r=avg%2Ftien">Báo cáo tiền xuất nhập</a></p>
				<p><a class="btn btn-default" href="/index.php?r=avg%2Fgiatb">Báo cáo giá trung bình</a></p>
                <p><a class="btn btn-default" href="/index.php?r=avg%2Fsanluong">Báo cáo giá sản lượng bán</a></p>
            </div>
			
        </div>

    </div>
</div>

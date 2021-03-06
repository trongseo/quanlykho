<?php
/**
 * Created by PhpStorm.
 * User: sba010
 * Date: 4/18/2018
 * Time: 11:21 AM
 */

use kartik\date\DatePicker;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Báo cáo tiền nhập xuất');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'avg'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$js = <<<JS



JS;

$this->registerJs($js, $this::POS_END);

?>

<div class="wrap">
    <div class="container">
        <div class="avg-form">



            <form action="/index.php" method="get">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                <input type="hidden" name="r" value="avg/tien">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group field-avg-productname">
                            <?php
                            echo '<label class="control-label">Chọn khoảng thời gian</label>';

                            echo DatePicker::widget([
                                'name' => 'from_date',
                                'value' => $yearmondayfrom,
                                'type' => DatePicker::TYPE_RANGE,
                                'name2' => 'to_date',
                                'value2' => $yearmondayto,
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]);
                            ?>


                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>


                <input class="btn btn-success" type="submit">
                <br><br>

            </form>
        </div>


        <div class="product-index">
<!--            sl_xuat,giatb_nhap,tong_gia_goc ,giatb_xuat ,tongtienban    ,  productname , productid-->
            <?php
            if(isset($dataProvider))
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [

                    [
                        'label' => 'ID Sản Phẩm',
                        'value' => 'productid',
                    ],
                    [
                        'label' => 'Tên sản phẩm',
                        'value' => 'productname',
                    ],

                    [
                        'label' => 'Giá nhập kho',
                        'value' => function ($arrData, $key, $index, $widget) {
                                return number_format(  $arrData['giatb_nhap']);
                        }
                    ],
                    'sl_xuat',
                    [
                        'label' => 'Tổng tiền vốn',
                        'value' => function ($arrData, $key, $index, $widget) {
                            return number_format(  $arrData['tong_gia_goc']);
                        }
                    ],
                    [
                        'label' => 'Giá xuất tb',
                        'value' => function ($arrData, $key, $index, $widget) {
                            return number_format(  $arrData['giatb_xuat']);
                        }
                    ],
                    [
                        'label' => 'Tổng tiền bán',
                        'value' => function ($arrData, $key, $index, $widget) {
                            return number_format(  $arrData['tongtienban']);
                        }
                    ],
                    [
                        'label' => 'Lời  cuối kì',
                        'value' => function ($arrData, $key, $index, $widget) {
                            return number_format(   $arrData['tongtienban']-$arrData['tong_gia_goc']);
                        }
                    ],
                ],
            ]);
            ?>



        </div>


    </div>
</div>

</div>




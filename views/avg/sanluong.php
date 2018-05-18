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

$this->title = Yii::t('app', 'Báo cáo sản lượng');
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
<!--            SELECT pr.id AS product_id , pr.`name`, IFNULL(sum_count, 0) sum_count FROM product  pr-->
            <?php
            if(isset($dataProvider))
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [

                    [
                        'label' => 'ID Sản Phẩm',
                        'value' => 'product_id',
                    ],
                    [
                        'label' => 'Tên sản phẩm',
                        'value' => 'name',
                    ],

                    [
                        'label' => 'Sản lượng bán',
                        'value' => function ($arrData, $key, $index, $widget) {
                                return number_format(  $arrData['sum_count']);
                        }
                    ],

                ],
            ]);
            ?>



        </div>


    </div>
</div>

</div>




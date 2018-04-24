<?php
/**
 * Created by PhpStorm.
 * User: sba010
 * Date: 4/18/2018
 * Time: 11:20 AM
 */

namespace app\controllers;

use app\models\Bill;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


class AvgController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'prices','monthavg'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        
        if (isset($_REQUEST['year_avg'])) {
            $year_avg = $_REQUEST['year_avg'];
            $month_avg = $_REQUEST['month_avg'];
            $myQuery ="SELECT  SUM( stockin_detail.`count`) AS countt, 
                        SUM( stockin_detail.`price`*stockin_detail.`count`) AS sumprice, stockin_detail.`product_id` AS productid,product.`name` AS productname
 
                        FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                        WHERE DATE_FORMAT(stockin.`time`,'%Y-%m ') = :yearmonth
                        GROUP BY stockin_detail.`product_id`,product.`name`";

            $commanRun = Yii::$app->db->createCommand($myQuery);
//
//            $commanRun = Yii::$app->db->createCommand('
//                        SELECT stockin_detail.`product_id` AS productid,product.`name` AS productname,((SUM(COUNT*stockin_detail.`price`) )/(SUM(COUNT) )) AS price,SUM(count) as quantity,stockin.`time` AS timeavg
//                        FROM stockin_detail
//                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
//                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`product_id`
//                        WHERE stockin.`time` LIKE \'%' . $year_avg . '' . "-" . '' . $month_avg . '%\'
//                        GROUP BY stockin_detail.`product_id`
//                ')->queryAll();
            $commanRun->bindValue(':yearmonth', $year_avg.'-'.$month_avg);
            $giatrungbinh= $commanRun->queryAll();

            foreach ($giatrungbinh as $myitem) {
                $productid = $myitem['productid'];
                $price = $myitem['price'];
                $quantity = $myitem['quantity'];
                $parameters = array("price" => $price, "quantity" => $quantity);
                Yii::$app->db->createCommand()->update('product', $parameters, "id=" . $productid)->execute();
            }
            return $this->render('index', [
                'giatrungbinh' => $giatrungbinh
            ]);
        }

        return $this->render('index', [
            'giatrungbinh' => []
        ]);
    }

    public function actionMonthavg()
    {

        if (isset($_REQUEST['year_avg'])) {
            $year_avg = $_REQUEST['year_avg'];
            $month_avg = $_REQUEST['month_avg'];
            $giatrungbinh = Yii::$app->db->createCommand('
                        SELECT stockin_detail.`product_id` AS productid,product.`name` AS productname,product.unit,product.`specification`,product.`cost`,((SUM(COUNT*stockin_detail.`price`) )/(SUM(COUNT) )) AS price,SUM(COUNT) AS quantity,stockin.`time` AS timeavg
                        FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`product_id`
                        WHERE stockin.`time` LIKE \'%' . $year_avg . '' . "-" . '' . $month_avg . '%\'
                        GROUP BY stockin_detail.`product_id`
                ')->queryAll();

            foreach ($giatrungbinh as $myitem) {
                $id = $myitem['productid'];
                $todayyearmonth=date("Y-m");
                $c =  "product_id=".$id." AND  yearmonth like '%".$todayyearmonth."%'";
                Yii::$app->db->createCommand()->delete("product_month",$c)->execute();
            }

            foreach ($giatrungbinh as $myitem) {
                $name=$myitem['productname'];
                $unit=$myitem['unit'];
                $specification=$myitem['specification'];
                $cost=$myitem['cost'];
                $price = $myitem['price'];
                $quantity = $myitem['quantity'];
                $product_id=$myitem['productid'];
                $yearmonth=$myitem['timeavg'];
                $parameters = array("product_id"=>$product_id,"name"=>$name,"unit"=>$unit,"specification"=>$specification,"cost"=>$cost,"price" => $price, "quantity" => $quantity,"yearmonth"=>$yearmonth);
                Yii::$app->db->createCommand()->insert('product_month', $parameters)->execute();
            }
            return $this->render('monthavg', [
                'giatrungbinh' => $giatrungbinh
            ]);
        }

        return $this->render('monthavg',[
            'giatrungbinh' => []
        ]);
    }
}


?>
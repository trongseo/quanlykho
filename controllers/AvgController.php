<?php
/**
 * Created by PhpStorm.
 * User: sba010
 * Date: 4/18/2018
 * Time: 11:20 AM
 */

namespace app\controllers;

use app\models\Bill;
use DateTime;
use Yii;
use yii\data\SqlDataProvider;
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
                        'actions' => ['index','tien', 'view','giatb', 'create', 'update', 'delete', 'prices','monthavg'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $date = new DateTime('now');
        $date->modify('last day of this month');
        echo $date->format('Y-m-d');
        $yearmondayfrom = date('Y-m-01');

        $yearmondayto = $date->format('Y-m-d');
        if (isset($_REQUEST['from_date'])) {

            $myQuery ="SELECT 
                       
SUM( stockin_detail.`price`*stockin_detail.`count`)/SUM( stockin_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     stockin_detail.`product_id` as productid ,SUM( stockin_detail.`count`) AS quantity
 
                        FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                        WHERE DATE_FORMAT(stockin.`time`,'%Y-%m ') = :yearmonth
                        GROUP BY stockin_detail.`product_id`,product.`name`";

            $myQuery="       SELECT  tbl_nhapthang.quantity AS quantity_nhap,tbl_xuatthang.quantity AS quantity_xuat , 
       tbl_nhapthang.quantity-tbl_xuatthang.quantity AS quantity_ton,tbl_xuatthang.productname ,tbl_xuatthang.productid FROM (  SELECT 
                       
SUM( stockin_detail.`price`*stockin_detail.`count`)/SUM( stockin_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     stockin_detail.`product_id` AS productid ,SUM( stockin_detail.`count`) AS quantity
 
                        FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                        WHERE  DATE_FORMAT(stockin.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <=:yearmondayto
                        GROUP BY stockin_detail.`product_id`,product.`name` 
                        ) AS tbl_nhapthang  
        LEFT JOIN                

 ( SELECT 
                       
SUM( delivery_detail.`price`*delivery_detail.`count`)/SUM( delivery_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     delivery_detail.`product_id` AS productid ,SUM( delivery_detail.`count`) AS quantity
 
                        FROM delivery_detail
                        LEFT JOIN product ON product.`id`=delivery_detail.`product_id`
                        LEFT JOIN delivery ON delivery.`id`=delivery_detail.`delivery_id`
                        WHERE   DATE_FORMAT(delivery.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(delivery.`time`,'%Y-%m-%d') <=:yearmondayto
                        GROUP BY delivery_detail.`product_id`,product.`name`
                        ) AS tbl_xuatthang
         ON  tbl_nhapthang.productid =  tbl_xuatthang.productid";
            //toncuoiki
            $myQuery="SELECT  tbl_nhapthang.quantity AS quantity_nhap,tbl_xuatthang.quantity AS quantity_xuat , 
       tbl_nhapthang.quantity-tbl_xuatthang.quantity AS quantity_ton,subpro.quantity_ton AS ton_cuoiki, tbl_xuatthang.productname ,tbl_xuatthang.productid FROM (  SELECT 
                       
SUM( stockin_detail.`price`*stockin_detail.`count`)/SUM( stockin_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     stockin_detail.`product_id` AS productid ,SUM( stockin_detail.`count`) AS quantity
 
                        FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                        WHERE  DATE_FORMAT(stockin.`time`,'%Y-%m-%d') >=:yearmondayfrom   AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <=:yearmondayto  
                        GROUP BY stockin_detail.`product_id`,product.`name` 
                        ) AS tbl_nhapthang  
        LEFT JOIN                

 ( SELECT 
                       
SUM( delivery_detail.`price`*delivery_detail.`count`)/SUM( delivery_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     delivery_detail.`product_id` AS productid ,SUM( delivery_detail.`count`) AS quantity
 
                        FROM delivery_detail
                        LEFT JOIN product ON product.`id`=delivery_detail.`product_id`
                        LEFT JOIN delivery ON delivery.`id`=delivery_detail.`delivery_id`
                        WHERE   DATE_FORMAT(delivery.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(delivery.`time`,'%Y-%m-%d')  <=:yearmondayto 
                        GROUP BY delivery_detail.`product_id`,product.`name`
                        ) AS tbl_xuatthang
         ON  tbl_nhapthang.productid =  tbl_xuatthang.productid
        
           LEFT JOIN   ( 
( SELECT  
       tbl_nhapthang.quantity- COALESCE(tbl_xuatthang.quantity , 0) AS quantity_ton,tbl_nhapthang.productid FROM (  SELECT 
                       
SUM( stockin_detail.`price`*stockin_detail.`count`)/SUM( stockin_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     stockin_detail.`product_id` AS productid ,SUM( stockin_detail.`count`) AS quantity
 
                        FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                        WHERE   DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <:yearmondayfrom  
                        GROUP BY stockin_detail.`product_id`,product.`name` 
                        ) AS tbl_nhapthang  
        LEFT JOIN                

 ( SELECT 
                       
SUM( delivery_detail.`price`*delivery_detail.`count`)/SUM( delivery_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     delivery_detail.`product_id` AS productid ,SUM( delivery_detail.`count`) AS quantity
 
                        FROM delivery_detail
                        LEFT JOIN product ON product.`id`=delivery_detail.`product_id`
                        LEFT JOIN delivery ON delivery.`id`=delivery_detail.`delivery_id`
                        WHERE   DATE_FORMAT(delivery.`time`,'%Y-%m-%d') <:yearmondayfrom
                        GROUP BY delivery_detail.`product_id`,product.`name`
                        ) AS tbl_xuatthang
         ON  tbl_nhapthang.productid =  tbl_xuatthang.productid  ) AS subpro
         ) ON tbl_xuatthang.productid =subpro.productid
         
         
         ";

            $commanRun = Yii::$app->db->createCommand($myQuery);
            $yearmondayfrom = $_REQUEST['from_date'] ;
            $yearmondayto =  $_REQUEST['to_date'] ;
            $commanRun->bindValue(':yearmondayfrom', $yearmondayfrom);
            $commanRun->bindValue(':yearmondayto', $yearmondayto);
           // DATE_FORMAT(stockin.`time`,'%Y-%m-%d') >='2018-04-24' AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <='2018-04-25'
            $giatrungbinh= $commanRun->queryAll();

//            foreach ($giatrungbinh as $myitem) {
//                $productid = $myitem['productid'];
//                $price = $myitem['price'];
//                $quantity = $myitem['quantity'];
//                $parameters = array("price" => $price, "quantity" => $quantity);
//                Yii::$app->db->createCommand()->update('product', $parameters, "id=" . $productid)->execute();
//            }
            return $this->render('index', [
                'giatrungbinh' => $giatrungbinh,'yearmondayfrom'=>$yearmondayfrom,'yearmondayto'=>$yearmondayto
            ]);
        }

        return $this->render('index', [
            'giatrungbinh' => [],'yearmondayfrom'=>$yearmondayfrom,'yearmondayto'=>$yearmondayto
        ]);
    }

    public function getSqlDataProviderTien($arPara){
    $myQuery="   SELECT  tbl_nhapthang.price AS price_nhap,tbl_xuatthang.price AS price_xuat , 
       tbl_xuatthang.price- tbl_nhapthang.price  AS price_loi,tbl_xuatthang.productname ,tbl_xuatthang.productid FROM (  SELECT 
                       
SUM( stockin_detail.`price`*stockin_detail.`count`) AS price    ,                   
                  product.`name` AS productname  ,     stockin_detail.`product_id` AS productid ,SUM( stockin_detail.`count`) AS quantity
 
                        FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                        WHERE DATE_FORMAT(stockin.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <=:yearmondayto
                        GROUP BY stockin_detail.`product_id`,product.`name` 
                        ) AS tbl_nhapthang  
        LEFT JOIN                

 ( SELECT 
                       
SUM( delivery_detail.`price`*delivery_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     delivery_detail.`product_id` AS productid ,SUM( delivery_detail.`count`) AS quantity
 
                        FROM delivery_detail
                        LEFT JOIN product ON product.`id`=delivery_detail.`product_id`
                        LEFT JOIN delivery ON delivery.`id`=delivery_detail.`delivery_id`
                        WHERE DATE_FORMAT(delivery.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(delivery.`time`,'%Y-%m-%d') <=:yearmondayto
                        GROUP BY delivery_detail.`product_id`,product.`name`
                        ) AS tbl_xuatthang
         ON  tbl_nhapthang.productid =  tbl_xuatthang.productid";


    $dataProvider = new SqlDataProvider([
        'sql' => $myQuery,
        'params' =>$arPara,
        'totalCount' => 100,
        //'sort' =>false, to remove the table header sorting
        'sort' => [
            'attributes' => [
                'tbl_xuatthang.productname' => [
                    'asc' => ['tbl_xuatthang.productname' => SORT_ASC],
                    'desc' => ['tbl_xuatthang.productname' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Post Title',
                ]
            ],
        ],
        'pagination' => [
            'pageSize' => 100,
        ],
    ]);

    return $dataProvider;

}
    public function actionTien()
    {
        $date = new DateTime('now');
        $date->modify('last day of this month');
       // echo $date->format('Y-m-d');
        $yearmondayfrom = date('Y-m-01');
        $yearmondayto = $date->format('Y-m-d');
        $para=[':yearmondayfrom' => $yearmondayfrom,':yearmondayto' => $yearmondayto];

        //$myQuery =  $this->getQueryTien($para);


        if (isset($_REQUEST['from_date'])) {
            $yearmondayfrom = $_REQUEST['from_date'] ;
            $yearmondayto =  $_REQUEST['to_date'] ;
            $para=[':yearmondayfrom' => $yearmondayfrom,':yearmondayto' => $yearmondayto];
        }
        $dataProvider = $this->getSqlDataProviderTien($para);
        return $this->render('tien', [
            'giatrungbinh' => [],'yearmondayfrom'=>$yearmondayfrom,'yearmondayto'=>$yearmondayto,'dataProvider'=>$dataProvider
        ]);
    }

    public function getSqlDataProviderGiatb($arPara){
        $myQuery="     SELECT 
                  stockin_detail.product_id AS productid ,     
SUM( stockin_detail.`price`*stockin_detail.`count`)/SUM( stockin_detail.`count`)  AS price_tb    ,                   
                  product.`name` AS productname     
 
                        FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                       WHERE  DATE_FORMAT(stockin.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <=:yearmondayto
                        GROUP BY stockin_detail.`product_id`,product.`name` ";


        $dataProvider = new SqlDataProvider([
            'sql' => $myQuery,
            'params' =>$arPara,
            'totalCount' => 100,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'attributes' => [
                    'productname' => [
                        'asc' => ['productname' => SORT_ASC],
                        'desc' => ['productname' => SORT_DESC],
                        'default' => SORT_DESC,
                        'label' => 'Post Title',
                    ]
                ],
            ],
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $dataProvider;

    }
    public function actionGiatb()
    {

        $date = new DateTime('now');
        $date->modify('last day of this month');
        // echo $date->format('Y-m-d');
        $yearmondayfrom = date('Y-m-01');
        $yearmondayto = $date->format('Y-m-d');
       // $para=[':yearmondayfrom' => $yearmondayfrom,':yearmondayto' => $yearmondayto];

        //$myQuery =  $this->getQueryTien($para);

        if (isset($_REQUEST['from_date'])) {
            $yearmondayfrom =  $_REQUEST['from_date'];
            $yearmondayto =  $_REQUEST['to_date'];

        }
        $para=[':yearmondayfrom' => $yearmondayfrom,':yearmondayto' => $yearmondayto];
        $dataProvider = $this->getSqlDataProviderGiatb($para);
        return $this->render('giatb', [
            'giatrungbinh' => [],'yearmondayfrom'=>$yearmondayfrom,'yearmondayto'=>$yearmondayto,'dataProvider'=>$dataProvider
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
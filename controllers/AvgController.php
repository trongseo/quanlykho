<?php
/**
 * Created by PhpStorm.
 * User: sba010
 * Date: 4/18/2018
 * Time: 11:20 AM
 */

namespace app\controllers;

use app\models\Bill;
use app\models\Delivery;
use app\models\Product;
use app\models\ProductReport;
use DateTime;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Response;


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
                        'actions' => ['sanluong','sanluongre','index','tien','soluongtons', 'view','giatb', 'create', 'update', 'delete', 'prices','monthavg'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function getSqlDataProviderSL($arPara){



        $myQuery = "
                        ";
        
$myQuery = "SELECT pr.id AS product_id , pr.`name`, IFNULL(sum_count, 0) sum_count FROM product  pr
LEFT JOIN 
   (SELECT SUM( dt.count ) AS sum_count,dt.`product_id` FROM delivery INNER JOIN delivery_detail dt ON delivery.`id` = dt.`delivery_id`
       WHERE  DATE_FORMAT(delivery.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(delivery.`time`,'%Y-%m-%d' ) <=:yearmondayto  GROUP BY dt.`product_id` ) AS dt ON
        pr.`id` = dt.`product_id`
WHERE  pr.username=:username

";
       // $subQuery = BaseFollower::find()->select('id');

    //   $query->addParams([':username'=>$arPara[':username']]);

        $subQuery = Delivery::find()->select('SUM( dt.count ) AS sum_count,dt.`product_id`');
        $subQuery->joinWith("deliveryDetails dt");
        $subQuery->where("delivery.username = 'trong'");
        $subQuery->andFilterWhere(['>=', 'delivery.time', '2018-05-01']);
        $subQuery->andFilterWhere(['<=', 'delivery.time', '2018-05-31']);
        $subQuery->groupBy('dt.`product_id`');

        $query = Product::find()->select('product.id as product_id, IFNULL(dt.sum_count,0 ) as sum_count ');
        $query->leftJoin(['dt' => $subQuery], 'product.id = dt.product_id');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $sortArr =['pr.name'=>SORT_ASC];
        if (isset($_REQUEST['sort'])) {
            $sort = $_REQUEST['sort'] ;
            if(strpos($sort,'-') !== false){
                $sortArr =[$sort=>SORT_DESC];
            }else{
                $sortArr =[$sort=>SORT_ASC];
            }


        }


        $dataProvider = new SqlDataProvider([
            'sql' => $myQuery,
            'params' =>$arPara,
            'totalCount' => 100,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'defaultOrder' => $sortArr,
                'attributes' => [
                    'pr.name',
                    'sum_count'

                ],
            ],
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $dataProvider;

    }
    public function actionSanluongee()
    {
        $date = new DateTime('now');
        $date->modify('last day of this month');
        // echo $date->format('Y-m-d');
        $yearmondayfrom = date('Y-m-01');
        $yearmondayto = $date->format('Y-m-d');
        $para=[':yearmondayfrom' => $yearmondayfrom,':yearmondayto' => $yearmondayto];
        Yii::$app->user->username;
        //$myQuery =  $this->getQueryTien($para);


        if (isset($_REQUEST['from_date'])) {
            $yearmondayfrom = $_REQUEST['from_date'] ;
            $yearmondayto =  $_REQUEST['to_date'] ;
            $para=[':yearmondayfrom' => $yearmondayfrom,':yearmondayto' => $yearmondayto];
        }
        $para[':username']=Yii::$app->user->username;
        $dataProvider = $this->getSqlDataProviderSL($para);
        return $this->render('sanluong', [
            'giatrungbinh' => [],'yearmondayfrom'=>$yearmondayfrom,'yearmondayto'=>$yearmondayto,'dataProvider'=>$dataProvider
        ]);


    }
    public function actionSanluong()
    {
        $date = new DateTime('now');
        $date->modify('last day of this month');
        // echo $date->format('Y-m-d');
        $yearmondayfrom = date('Y-m-01');
        $yearmondayto = $date->format('Y-m-d');
        $para=[':yearmondayfrom' => $yearmondayfrom,':yearmondayto' => $yearmondayto];
        Yii::$app->user->username;
        //$myQuery =  $this->getQueryTien($para);


        if (isset($_REQUEST['from_date'])) {
            $yearmondayfrom = $_REQUEST['from_date'] ;
            $yearmondayto =  $_REQUEST['to_date'] ;
            $para=[':yearmondayfrom' => $yearmondayfrom,':yearmondayto' => $yearmondayto];
        }
        $para[':username']= Yii::$app->user->username;
        $subQuery = Delivery::find()->select('SUM( dt.count ) AS sumCount,dt.`product_id`');
        $subQuery->joinWith("deliveryDetails dt");
       // $subQuery->where("delivery.username = 'trong'");
        $subQuery->andFilterWhere(['>=', 'delivery.time', $yearmondayfrom]);
        $subQuery->andFilterWhere(['<=', 'delivery.time', $yearmondayto]);
        $subQuery->groupBy('dt.`product_id`');

        $query = ProductReport::find()->select('product.id,name,  sumCount');
        $query->leftJoin(['dt' => $subQuery], 'product.id = dt.product_id');
        $query->where("product.username = :username",[':username'=>Yii::$app->user->username]);
        echo  $query->createCommand()->getRawSql();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $searchModel = new ProductReport();
        return $this->render('sanluong', ['searchModel'=>$searchModel,
            'giatrungbinh' => [],'yearmondayfrom'=>$yearmondayfrom,'yearmondayto'=>$yearmondayto,'dataProvider'=>$dataProvider
        ]);


    }
    public function actionIndex()
    {
        $date = new DateTime('now');
        $date->modify('last day of this month');
        $yearmondayfrom = date('Y-m-01');
        $yearmondayto = $date->format('Y-m-d');
        if (isset($_REQUEST['from_date'])) {


            //toncuoiki
            $myQuery="SELECT GTB.price_tb,  IFNULL(tbl_nhapthang.quantity , 0) AS quantity_nhap,  IFNULL(tbl_xuatthang.quantity , 0) AS quantity_xuat , 
      IFNULL( tbl_nhapthang.quantity , 0) -  IFNULL (tbl_xuatthang.quantity , 0)   AS quantity_ton, IFNULL( subpro.quantity_ton , 0) AS ton_cuoiki,tbl_nhapthang.productname ,tbl_nhapthang.productid FROM (  SELECT 
                       
SUM( stockin_detail.`price`*stockin_detail.`count`)/SUM( stockin_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     stockin_detail.`product_id` AS productid ,SUM( stockin_detail.`count`) AS quantity
 
                        FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                        WHERE stockin.username=:username and DATE_FORMAT(stockin.`time`,'%Y-%m-%d') >=:yearmondayfrom   AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <=:yearmondayto  
                        GROUP BY stockin_detail.`product_id`,product.`name` 
                        ) AS tbl_nhapthang  
        LEFT JOIN                

 ( SELECT 
                       
SUM( delivery_detail.`price`*delivery_detail.`count`)/SUM( delivery_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     delivery_detail.`product_id` AS productid ,SUM( delivery_detail.`count`) AS quantity
 
                        FROM delivery_detail
                        LEFT JOIN product ON product.`id`=delivery_detail.`product_id`
                        LEFT JOIN delivery ON delivery.`id`=delivery_detail.`delivery_id`
                        WHERE  delivery.username=:username and DATE_FORMAT(delivery.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(delivery.`time`,'%Y-%m-%d')  <=:yearmondayto 
                        GROUP BY delivery_detail.`product_id`,product.`name`
                        ) AS tbl_xuatthang
         ON  tbl_nhapthang.productid =  tbl_xuatthang.productid
        
           LEFT JOIN   ( 
( SELECT  
       COALESCE(  tbl_nhapthang.quantity, 0) - COALESCE(tbl_xuatthang.quantity , 0) AS quantity_ton,tbl_nhapthang.productid FROM (  SELECT 
                       
SUM( stockin_detail.`price`*stockin_detail.`count`)/SUM( stockin_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     stockin_detail.`product_id` AS productid ,SUM( stockin_detail.`count`) AS quantity
 
                        FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                        WHERE  stockin.username=:username and  DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <:yearmondayfrom  
                        GROUP BY stockin_detail.`product_id`,product.`name` 
                        ) AS tbl_nhapthang  
        LEFT JOIN                

 ( SELECT 
                       
SUM( delivery_detail.`price`*delivery_detail.`count`)/SUM( delivery_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     delivery_detail.`product_id` AS productid ,SUM( delivery_detail.`count`) AS quantity
 
                        FROM delivery_detail
                        LEFT JOIN product ON product.`id`=delivery_detail.`product_id`
                        LEFT JOIN delivery ON delivery.`id`=delivery_detail.`delivery_id`
                        WHERE  delivery.username=:username and DATE_FORMAT(delivery.`time`,'%Y-%m-%d') <:yearmondayfrom
                        GROUP BY delivery_detail.`product_id`,product.`name`
                        ) AS tbl_xuatthang
         ON  tbl_nhapthang.productid =  tbl_xuatthang.productid  ) AS subpro
         ) ON tbl_xuatthang.productid =subpro.productid
         
          LEFT JOIN  (  
SELECT 
                  stockin_detail.product_id AS productid ,     
SUM( stockin_detail.`price`*stockin_detail.`count`)/SUM( stockin_detail.`count`)  AS price_tb    
                        FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                       WHERE  stockin.username=:username AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <=:yearmondayto
                        GROUP BY stockin_detail.`product_id`,product.`name`
                        ) AS GTB ON  GTB.productid  = tbl_xuatthang.productid 
         ";

            $commanRun = Yii::$app->db->createCommand($myQuery);
            $yearmondayfrom = $_REQUEST['from_date'] ;
            $yearmondayto =  $_REQUEST['to_date'] ;
            $commanRun->bindValue(':yearmondayfrom', $yearmondayfrom);
            $commanRun->bindValue(':yearmondayto', $yearmondayto);
            $commanRun->bindValue(':username',  Yii::$app->user->username);
           // DATE_FORMAT(stockin.`time`,'%Y-%m-%d') >='2018-04-24' AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <='2018-04-25'
            $giatrungbinh= $commanRun->queryAll();
           // echo("<br/><br/><br/><br/><br/><br/><br/><br/><br/>"."<br/>".$commanRun->rawSql);

            return $this->render('index', [
                'giatrungbinh' => $giatrungbinh,'yearmondayfrom'=>$yearmondayfrom,'yearmondayto'=>$yearmondayto
            ]);
        }

        return $this->render('index', [
            'giatrungbinh' => [],'yearmondayfrom'=>$yearmondayfrom,'yearmondayto'=>$yearmondayto
        ]);
    }

    public function getSqlDataProviderTien($arPara){


    $myQuery="
 SELECT  tbl_nhapthang.price AS price_nhap,tbl_xuatthang.price AS price_xuat ,tbl_xuatthang.quantity as soluong_xuat, 
       tbl_xuatthang.price- tbl_nhapthang.price  AS price_loi,tbl_nhapthang.productname ,tbl_nhapthang.productid ,sub_tien.price_loi_truocki
 FROM (
         SELECT 
                       
				SUM( stockin_detail.`price`*stockin_detail.`count`) AS price    ,                   
					product.`name` AS productname  ,     stockin_detail.`product_id` AS productid ,SUM( stockin_detail.`count`) AS quantity
 
          FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                        WHERE stockin.username=:username and DATE_FORMAT(stockin.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <=:yearmondayto
                        GROUP BY stockin_detail.`product_id`,product.`name` 
           ) AS tbl_nhapthang  
        LEFT JOIN                

	 ( SELECT 
			       
			SUM( delivery_detail.`price`*delivery_detail.`count`)  AS price    ,                   
			  product.`name` AS productname  ,     delivery_detail.`product_id` AS productid ,SUM( delivery_detail.`count`) AS quantity
	 
		FROM delivery_detail
				LEFT JOIN product ON product.`id`=delivery_detail.`product_id`
				LEFT JOIN delivery ON delivery.`id`=delivery_detail.`delivery_id`
		WHERE delivery.username=:username and DATE_FORMAT(delivery.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(delivery.`time`,'%Y-%m-%d') <=:yearmondayto
		GROUP BY delivery_detail.`product_id`,product.`name`
	) AS tbl_xuatthang
		
         ON  tbl_nhapthang.productid =  tbl_xuatthang.productid
         -- sub price 
        LEFT JOIN                

	 ( SELECT  tbl_nhapthang.price AS price_nhap,tbl_xuatthang.price AS price_xuat , 
	       tbl_xuatthang.price- tbl_nhapthang.price  AS price_loi_truocki,tbl_nhapthang.productname ,tbl_nhapthang.productid 
		FROM (
			 SELECT 
				       
						SUM( stockin_detail.`price`*stockin_detail.`count`) AS price    ,                   
							product.`name` AS productname  ,     stockin_detail.`product_id` AS productid ,SUM( stockin_detail.`count`) AS quantity
		 
			  FROM stockin_detail
					LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
					LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
					WHERE stockin.username=:username and DATE_FORMAT(stockin.`time`,'%Y-%m-%d')<:yearmondayfrom 
					GROUP BY stockin_detail.`product_id`,product.`name` 
		   ) AS tbl_nhapthang  
		LEFT JOIN                

		 ( 
			SELECT 
				       
				SUM( delivery_detail.`price`*delivery_detail.`count`)  AS price    ,                   
				  product.`name` AS productname  ,     delivery_detail.`product_id` AS productid ,SUM( delivery_detail.`count`) AS quantity
		 
			FROM delivery_detail
					LEFT JOIN product ON product.`id`=delivery_detail.`product_id`
					LEFT JOIN delivery ON delivery.`id`=delivery_detail.`delivery_id`
			WHERE delivery.username=:username and DATE_FORMAT(delivery.`time`,'%Y-%m-%d') <:yearmondayfrom 
			GROUP BY delivery_detail.`product_id`,product.`name`
		) AS tbl_xuatthang
			
		 ON  tbl_nhapthang.productid =  tbl_xuatthang.productid
	    ) AS sub_tien
	    
	     ON  sub_tien.productid =  tbl_xuatthang.productid";

    $myQuery = " SELECT 
			       
			SUM( delivery_detail.`count`) AS sl_xuat,price_tb AS giatb_nhap,SUM(delivery_detail.`count`)*price_tb AS tong_gia_goc ,
			SUM( delivery_detail.`price`*delivery_detail.`count`)/sum(delivery_detail.`count`)  AS giatb_xuat ,
			SUM( delivery_detail.`price`*delivery_detail.`count`)  AS tongtienban    ,                   
			  product.`name` AS productname  ,     delivery_detail.`product_id` AS productid 
	 
		FROM delivery_detail
				LEFT JOIN product ON product.`id`=delivery_detail.`product_id`
				LEFT JOIN delivery ON delivery.`id`=delivery_detail.`delivery_id`
				
				 LEFT JOIN  (  
						SELECT 
								stockin_detail.product_id AS productid ,     
							SUM( stockin_detail.`price`*stockin_detail.`count`)/SUM( stockin_detail.`count`)  AS price_tb    
					FROM stockin_detail
						LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
						LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
					 WHERE  stockin.username=:username AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <=:yearmondayto
						GROUP BY stockin_detail.`product_id`,product.`name`
				   ) AS GTB ON  GTB.productid  = product.id 
                        
		WHERE delivery.username=:username AND DATE_FORMAT(delivery.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(delivery.`time`,'%Y-%m-%d') <=:yearmondayto
		GROUP BY delivery_detail.`product_id`,product.`name`";

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
    public function actionQuantitypro(){
       
    }
    public function actionTien()
    {
        $date = new DateTime('now');
        $date->modify('last day of this month');
       // echo $date->format('Y-m-d');
        $yearmondayfrom = date('Y-m-01');
        $yearmondayto = $date->format('Y-m-d');
        $para=[':yearmondayfrom' => $yearmondayfrom,':yearmondayto' => $yearmondayto];
        Yii::$app->user->username;
        //$myQuery =  $this->getQueryTien($para);


        if (isset($_REQUEST['from_date'])) {
            $yearmondayfrom = $_REQUEST['from_date'] ;
            $yearmondayto =  $_REQUEST['to_date'] ;
            $para=[':yearmondayfrom' => $yearmondayfrom,':yearmondayto' => $yearmondayto];
        }
        $para[':username']=Yii::$app->user->username;
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
                       WHERE  stockin.username=:username and DATE_FORMAT(stockin.`time`,'%Y-%m-%d') >=:yearmondayfrom AND DATE_FORMAT(stockin.`time`,'%Y-%m-%d') <=:yearmondayto
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
        $para[':username']= Yii::$app->user->username;
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

    public function actionSoluongtons()
    {
        //toncuoiki
        $myQuery="SELECT   IFNULL(tbl_nhapthang.quantity , 0) AS quantity_nhap,  IFNULL(tbl_xuatthang.quantity , 0) AS quantity_xuat , 
      IFNULL( tbl_nhapthang.quantity , 0) -  IFNULL (tbl_xuatthang.quantity , 0)   AS quantity_ton,  tbl_nhapthang.productname ,tbl_nhapthang.productid
       FROM 
      (  SELECT 
                       
			SUM( stockin_detail.`price`*stockin_detail.`count`)/SUM( stockin_detail.`count`)  AS price    ,                   
			product.`name` AS productname  ,     stockin_detail.`product_id` AS productid ,SUM( stockin_detail.`count`) AS quantity
	FROM stockin_detail
                        LEFT JOIN product ON product.`id`=stockin_detail.`product_id`
                        LEFT JOIN stockin ON stockin.`id`=stockin_detail.`stockin_id`
                        WHERE  stockin.username='phuong' 
                        GROUP BY stockin_detail.`product_id`,product.`name` 
            ) AS tbl_nhapthang  
        LEFT JOIN                

	( SELECT 
                       
			SUM( delivery_detail.`price`*delivery_detail.`count`)/SUM( delivery_detail.`count`)  AS price    ,                   
                  product.`name` AS productname  ,     delivery_detail.`product_id` AS productid ,SUM( delivery_detail.`count`) AS quantity
 
          FROM delivery_detail
                        LEFT JOIN product ON product.`id`=delivery_detail.`product_id`
                        LEFT JOIN delivery ON delivery.`id`=delivery_detail.`delivery_id`
                        WHERE  delivery.username=:username 
                        GROUP BY delivery_detail.`product_id`,product.`name`
           ) AS tbl_xuatthang
         ON  tbl_nhapthang.productid =  tbl_xuatthang.productid
         
         ";

        $commanRun = Yii::$app->db->createCommand($myQuery);
        $commanRun->bindValue(':username',  Yii::$app->user->username);
        $product= $commanRun->queryAll();

        // $product = Product::find()->select(["id", "price", "unit", "specification"])->asArray()->all();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return json_encode($product);
    }
}


?>
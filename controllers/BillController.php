<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


class BillController extends Controller{

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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'prices'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        if (Yii::$app->request->post()){
            $idchungtu=$_REQUEST['idchungtu'];
            $idproduct=$_REQUEST['idproduct'];
            $productname = $_REQUEST['productname'];
            $unit=$_REQUEST['unit'];
            $count=$_REQUEST['count'];
            $price=$_REQUEST['price'];
            $cost=$_REQUEST['cost'];
            $idnhacungcap=$_REQUEST['idnhacungcap'];
            $note=$_REQUEST['note'];
            $date=$_REQUEST['date'];

            $sql = "insert into warehouse (idchungtu,idproduct,productname,unit,count,price,cost,idnhacungcap,note,date) values (:idchungtu,:idproduct,:productname,:unit,:idnhacungcap,:note,:date)";

            $parameters = array("idchungtu"=>$idchungtu,"idproduct"=>$idproduct,"productname"=>$productname,"unit"=>$unit,"count"=>$count,"price"=>$price,"cost"=>$cost,"idnhacungcap"=>$idnhacungcap,"note"=>$note,"date"=>$date);
          // Yii::$app->db->createCommand($sql)->insert($parameters)->execute();

            Yii::$app->db->createCommand()->insert('warehouse', $parameters)->execute();

        }


        return $this->render('index');
    }
}
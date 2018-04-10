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
            $productname = $_REQUEST['productname'];
            $sql = "insert into warehouse (productname) values (:productname)";

            $parameters = array("productname"=>$productname);
          // Yii::$app->db->createCommand($sql)->insert($parameters)->execute();

            Yii::$app->db->createCommand()->insert('warehouse', $parameters)->execute();


        }


        return $this->render('index');
    }
}
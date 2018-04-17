<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


class UnitController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'prices'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        $datas = Yii::$app->db->createCommand('SELECT * FROM unit')
            ->queryAll();
        return $this->render('index', [
            'datas' => $datas
        ]);
    }
    public function actionUpdate()
    {
        $idUpdate = $_GET['id'];
        if (Yii::$app->request->post()) {

            $nameUpdate = $_REQUEST['unit_name'];
            $parameters = array("unit_name" => $nameUpdate);
            // Yii::$app->db->createCommand($sql)->insert($parameters)->execute();

            Yii::$app->db->createCommand()->update('unit',$parameters,'id='.$idUpdate)->execute();
            // goi controller bill va action index
            return $this->redirect("/index.php?r=unit/index");

        }


        return $this->render('update',["idUpdate"=>$idUpdate]);
    }

    public function actionCreate()
    {
            if (Yii::$app->request->post()) {
            $unit_name = $_REQUEST['unit_name'];



            $parameters = array("unit_name" => $unit_name);
            // Yii::$app->db->createCommand($sql)->insert($parameters)->execute();

            Yii::$app->db->createCommand()->insert('unit', $parameters)->execute();
            // goi controller bill va action index
            return $this->redirect("/index.php?r=unit/index");

        }

      // echo "ok".$bienmoi;
           return $this->render('create');
    }

}
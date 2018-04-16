<?php
namespace app\controllers;

use app\models\Bill;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


class BillController extends Controller
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

        $datas = Yii::$app->db->createCommand('SELECT * FROM warehouse LEFT JOIN unit ON warehouse.`idunit`=unit.`id` ')
            ->queryAll();
        return $this->render('index', [
            'datas' => $datas
        ]);
    }

    public function actionCreate()
    {

        $comboboxdata = Yii::$app->db->createCommand('SELECT * FROM unit')
            ->queryAll();


        if (Yii::$app->request->post()) {
            $idchungtu = $_REQUEST['idchungtu'];
            $idproduct = $_REQUEST['idproduct'];
            $productname = $_REQUEST['productname'];
            $unit = $_REQUEST['unit'];
            $count = $_REQUEST['count'];
            $price = $_REQUEST['price'];
            $cost = $_REQUEST['cost'];
            $idnhacungcap = $_REQUEST['idnhacungcap'];
            $note = $_REQUEST['note'];
            $date = $_REQUEST['date'];

            $sql = "insert into warehouse (idchungtu,idproduct,productname,unit,count,price,cost,idnhacungcap,note,date)
                    values (:idchungtu,:idproduct,:productname,:unit,:idnhacungcap,:note,:date)";

            $parameters = array("idchungtu" => $idchungtu, "idproduct" => $idproduct, "productname" => $productname,
                "unit" => $unit, "count" => $count, "price" => $price, "cost" => $cost, "idnhacungcap" => $idnhacungcap, "note" => $note, "date" => $date);
            // Yii::$app->db->createCommand($sql)->insert($parameters)->execute();

            Yii::$app->db->createCommand()->insert('warehouse', $parameters)->execute();
            return $this->redirect(['/bill/index']);
        }

        return $this->render('create', [
            'comboboxdata' => $comboboxdata
        ]);
    }

    public function actionUpdate()
    {

        $comboboxdata = Yii::$app->db->createCommand('SELECT * FROM unit')
            ->queryAll();

        if (Yii::$app->request->post()) {
            $idwarehouse=$_REQUEST['idwarehouse'];
            $idchungtu = $_REQUEST['idchungtu'];
            $idproduct = $_REQUEST['idproduct'];
            $productname = $_REQUEST['productname'];
            $unit = $_REQUEST['unit'];
            $count = $_REQUEST['count'];
            $price = $_REQUEST['price'];
            $cost = $_REQUEST['cost'];
            $idnhacungcap = $_REQUEST['idnhacungcap'];
            $note = $_REQUEST['note'];
            $date = $_REQUEST['date'];

            $sql = "UPDATE warehouse set (idchungtu=".'$idchungtu'.") where idwarehouse=". $_REQUEST['idwarehouse'];

            $parameters = array("idchungtu" => $idchungtu, "idproduct" => $idproduct, "productname" => $productname,
                "unit" => $unit, "count" => $count, "price" => $price, "cost" => $cost, "idnhacungcap" => $idnhacungcap, "date" => $date);
            // Yii::$app->db->createCommand($sql)->insert($parameters)->execute();

            Yii::$app->db->createCommand()->update('warehouse', $parameters)->execute();
            return $this->redirect(['/bill/index']);
        }

        $objWarehouse = $this->findModel($_REQUEST["id"]);
        return $this->render('update', [
            'comboboxdata' => $comboboxdata, 'objWarehouse' => $objWarehouse
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Bill::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
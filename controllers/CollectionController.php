<?php

namespace app\controllers;

use Yii;
use app\models\Collection;
use app\models\CollectionSearch;
use yii\web\Controller;
use yii\web\JqueryAsset;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * CollectionController implements the CRUD actions for Collection model.
 */
class CollectionController extends AppController
{
    public function behaviors()
    {



        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ] ,
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Collection models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new CollectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Collection model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->image1 = '/uploads/'. $model->image1;
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Collection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Collection();

        if ($model->load(Yii::$app->request->post())) {
            // set the time
            if ($model->time) {
                date_default_timezone_set("Asia/ShangHai");
                $model->time .= ("  ". date("H:i:s"));
            }
            $model->username = Yii::$app->user->username;
            //upload image
            $image = UploadedFile::getInstance($model, 'image1');
            if (!is_null($image)) {
                $model->image1 = $image->name;
                $ext = end((explode(".", $image->name)));
                // generate a unique file name to prevent duplicate filenames
                $model->image1 = Yii::$app->security->generateRandomString().".{$ext}";
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
                $path = Yii::$app->params['uploadPath'] . $model->image1;
                $image->saveAs($path);
            }
            $model->save();
            // add the money to customer
            $customer = $model->customer;
            $customer->payed += $model->money;
            $customer->unpay -= $model->money;
            $customer->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Collection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {


        $model = $this->findModel($id);

        $this->checkPermissionModel($model);
        $oldMoney = $model->money;
        $model->image1 = '/uploads/'. $model->image1;
        if ($model->load(Yii::$app->request->post())) {
            // set the time
            if ($model->time) {
                $this->date_default_timezone_set();
                $model->time .= ("  ". date("H:i:s"));
            }
//            if($model->flg_thuchi==0){
//                $model->money = - $model->money;
//            }
            $model->username = Yii::$app->user->username;
            //upload image
            $image = UploadedFile::getInstance($model, 'image1');
            if (!is_null($image)) {
                $model->image1 = $image->name;
                $ext = end((explode(".", $image->name)));
                // generate a unique file name to prevent duplicate filenames
                $model->image1 = Yii::$app->security->generateRandomString().".{$ext}";
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
                $path = Yii::$app->params['uploadPath'] . $model->image1;
                $image->saveAs($path);
            }
            $model->save();
            // update the money to customer
            $customer = $model->customer;
            $customer->unpay += $oldMoney;
            $customer->payed -= $oldMoney;
            $customer->payed += $model->money;
            $customer->unpay -= $model->money;
            $customer->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Collection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->checkPermissionModel($model);
        // delete the money to customer
        $customer = $model->customer;
        $customer->unpay += $model->money;
        $customer->payed -= $model->money;
        $customer->save();
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Collection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Collection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Collection::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

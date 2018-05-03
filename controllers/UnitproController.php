<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
/**
 * Created by PhpStorm.
 * User: sba010
 * Date: 5/3/2018
 * Time: 4:43 PM
 */
class UnitproController extends Controller
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
                        'actions' => ['index', 'tien', 'soluongtons', 'view', 'giatb', 'create', 'update', 'delete', 'prices', 'monthavg'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataunit = Yii::$app->db->createCommand('SELECT * FROM unit_pro')
            ->queryAll();
        return $this->render('index', [
            'datas' => $dataunit
        ]);
    }
}


?>
<?php

namespace app\controllers;

use Yii;
use app\models\Account;
use app\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AppController extends Controller
{
    public function init()
    {
        parent::init();
    }

    function date_default_timezone_set(){
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }
    function checkPermissionModel($myModel){
        if(Yii::$app->user->username=="supperadmin") return true;
        if($myModel->username==Yii::$app->user->username ){
            return true;
        }
        echo "khong du quyen";
        exit();
        return false;
    }
    function getWhereFilter($arRwhere){
        if(Yii::$app->user->username=="superadmin") return $arRwhere;

         $arRwhere['username']=Yii::$app->user->username;
         return $arRwhere;

    }
}

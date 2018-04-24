<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "unit".
 *
 * @property integer $id
 * @property string $email
 * @property string $passwd
 *
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user';
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public  function findByUsername($username)
    {
        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

       // $this->load($params);


        $query->andFilterWhere([
            'email' => $username,
        ]);


//        var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
//        exit();
        $returnobj = $dataProvider->getModels();
        if(count($returnobj)==0) return null;
        $iden = new User();
        $iden->password = $returnobj[0]->passwd;
        $iden->username = $returnobj[0]->email;
        $iden->id = $returnobj[0]->id;
        $iden->accessToken="xxx";
        $iden->authKey = "fff";
        return $iden;
    }
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password,$usr)
    {
        if( $usr['passwd']==$password){
            return true;
        }
        //return $this->passwd === $password;
        return false;
    }

}

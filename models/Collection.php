<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "collection".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $time
 * @property string $money
 * @property string $note
 * @property integer $customer_id
 * @property integer $flg_thu_chi
 * @property Customer $customer
 * @property Account $account
 */
class Collection extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $blankmass = Yii::t('app', 'require');
        $require_number = Yii::t('app', 'require_number');
//        'require' => 'Vui lòng nhập',
//    '' => 'Vui lòng nhập kiểu số',
//    'require_date' => 'Vui lòng nhập đúng định dạng ngày yyyy-MM-dd';
        return [
            [['account_id', 'money', 'note','customer_id','flg_thuchi'], 'required','message' =>$blankmass],
            [['account_id', 'customer_id'], 'integer'],
            [['time'], 'safe'],
            [['money','flg_thuchi'], 'number','message' =>$require_number],
            [['note'], 'string', 'max' => 128]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'account_id' => Yii::t('app', 'Account'),
            'time' => Yii::t('app', 'Time'),
            'money' => Yii::t('app', 'Money'),
            'note' => Yii::t('app', 'Note'),
            'flg_thuchi' => Yii::t('app', 'Thu hoặc chi'),
            'customer_id' => Yii::t('app', 'Customer'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

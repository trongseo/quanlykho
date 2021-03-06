<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $unit
 * @property integer $specification
 * @property string $price
 * @property string $username
 * @property string $cost
 * @property integer $unit_id
 * @property DeliveryDetail[] $deliveryDetails
 * @property StockinDetail[] $stockinDetails
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price','unit_id'], 'number'],
            [['name','username'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'unit' => Yii::t('app', 'Unit'),
            'specification' => Yii::t('app', 'Specification'),
            'price' => Yii::t('app', 'Price'),
            'cost' => Yii::t('app', 'Cost'),
            'unit_id' => Yii::t('app', 'Unit'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryDetails()
    {
        return $this->hasMany(DeliveryDetail::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockinDetails()
    {
        return $this->hasMany(StockinDetail::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockins()
    {
        return $this->hasMany(Stockin::className(), ['id' => 'stockin_id'])->viaTable('stockin_detail', ['product_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unit_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitPro()
    {
        return $this->hasOne(UnitPro::className(), ['id' => 'unit_id']);
    }

    public static  function findAllforUser(){
        if(Yii::$app->user->username=="superadmin"){
            return  Product::find()->all();
        }
        return  Product::find()->andFilterWhere(["username"=> Yii::$app->user->username
        ])->all();
    }
}

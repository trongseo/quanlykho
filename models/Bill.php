<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property integer $id
 * @property string $name
 * @property string $unit
 * @property integer $specification
 * @property string $price
 * @property string $cost
 *
 * @property DeliveryDetail[] $deliveryDetails
 * @property StockinDetail[] $stockinDetails
 */
class Bill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idwarehose'], 'required'],
            [['unit','idchungtu','idproduct','productname','idnhacungcap','note'], 'string'],
            [['count','idunit'], 'integer'],
            [['price', 'cost'], 'number'],
            [['date'],'date']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idwarehouse' => Yii::t('app', 'Idwarehouse'),
            'idchungtu' => Yii::t('app', 'Idchungtu'),
            'idproduct' => Yii::t('app', 'Idproduct'),
            'productname' => Yii::t('app', 'Productname'),
            'idnhacungcap' => Yii::t('app', 'Idnhacungcap'),
            'unit' => Yii::t('app', 'Unit'),
            'count' => Yii::t('app', 'Count'),
            'price' => Yii::t('app', 'Price'),
            'cost' => Yii::t('app', 'Cost'),
            'note'=>Yii::t('app','Note'),
            'date'=>Yii::t('app','Date'),
            'idunit'=>Yii::t('app','IDunit'),
        ];
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getDeliveryDetails()
//    {
//        return $this->hasMany(DeliveryDetail::className(), ['product_id' => 'id']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getStockinDetails()
//    {
//        return $this->hasMany(StockinDetail::className(), ['product_id' => 'id']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getStockins()
//    {
//        return $this->hasMany(Stockin::className(), ['id' => 'stockin_id'])->viaTable('stockin_detail', ['product_id' => 'id']);
//    }

}

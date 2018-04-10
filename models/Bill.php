<?php
/**
 * Created by PhpStorm.
 * User: sba010
 * Date: 4/6/2018
 * Time: 3:09 PM
 */

use Yii;
use yii\helpers\ArrayHelper;
class bill extends \yii\db\ActiveRecord{
    public static function tableName()
    {
        return 'warehouse';
    }

    public function getBill()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('warehouse', ['warehouseid' => 'id']);
    }

}
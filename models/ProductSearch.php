<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'specification'], 'integer'],
            [['name', 'unit','unit_id'], 'safe'],
            [['price', 'cost'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query, 'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'specification' => $this->specification,
            'price' => $this->price,
            'cost' => $this->cost,
        ]);
      //  $query->joinwith('unit');
        $query->joinwith('unitPro');
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'unit', $this->unit])
           ->andFilterWhere(['like', 'unit_pro.unit_name', $this->unit_id]);

//        var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
//        exit();
        return $dataProvider;
    }
}

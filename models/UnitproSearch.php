<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UnitPro;

/**
 * UnitproSearch represents the model behind the search form about `app\models\Product`.
 */
class UnitproSearch extends UnitPro
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['unit_name'], 'safe'],

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

        $arrayWhere=[];
        $query = UnitPro::find()->andFilterWhere($arrayWhere);

        $dataProvider = new ActiveDataProvider([
            'query' => $query, 'pagination' => [
                'pageSize' => 100,
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

        ]);
        //  $query->joinwith('unit');

      //  $query->andFilterWhere(['like', 'unit_name', $this->unit_name]);

//        var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
//        exit();
        return $dataProvider;
    }
}

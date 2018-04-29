<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Collection;

/**
 * CollectionSearch represents the model behind the search form about `app\models\Collection`.
 */
class CollectionSearch extends Collection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['time', 'account_id', 'customer_id'], 'safe'],
            [['money'], 'number'],
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
    function get_calling_class() {

        //get the trace
        $trace = debug_backtrace();

        // Get the class that is asking for who awoke it
        $class = $trace[1]['class'];

        // +1 to i cos we have to account for calling this function
        for ( $i=1; $i<count( $trace ); $i++ ) {
            if ( isset( $trace[$i] ) ) // is it set?
                if ( $class != $trace[$i]['class'] ) // is it a different class
                    return $trace[$i]['class'];
        }
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
       $callClass=  $this->get_calling_class();
       $objCall = new $callClass(null,null,null);
        $arrayWhere=[];
        $arrayWhere =$objCall->getWhereFilter($arrayWhere,"collection");
      //  var_dump("<br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/><br/>,<br/>,<br/>,<br/>,<br/>,",$arrayWhere) ;
        $query = Collection::find()->andFilterWhere($arrayWhere);
       // $params['username'] = Yii::$app->user->username;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(isset($this->time) && $this->time != '') {
            $date_explode = explode(" to ", $this->time);
            $date1 = trim($date_explode[0]);
            $date2 = trim($date_explode[1]);
            $date2 = date("Y-m-d", strtotime("+1 day", strtotime($date2)));
            $query->andFilterWhere(['between', 'collection.time', $date1, $date2]);
        }

        $query->joinwith('customer');
        $query->joinwith('account');

        $query->andFilterWhere([
            'collection.id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'customer.name', $this->customer_id]);
        $query->andFilterWhere(['like', 'account.name', $this->account_id]);
        $query->andFilterWhere(['like', 'money', $this->money]);

//        var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
//        exit();

        return $dataProvider;
    }
}

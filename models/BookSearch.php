<?php namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BookSearch represents the model behind the search form about `app\models\Books`.
 */
class BookSearch extends Books {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['author_id'], 'integer'],
            [['date_from', 'date_till'], 'date', 'format' => 'yyyy-m-d'],
            [['name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Books::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if ($this->author_id) {
            $query->andFilterWhere([
                'author_id' => $this->author_id,
            ]);
        }

        if ($this->date_from) {
            if ($this->date_till) {
                $query->andFilterWhere([
                    'date' => ['between', $this->date_from, $this->date_till],
                ]);
            } else {
                $query->andFilterWhere([
                    '>=', 'date', $this->date_from
                ]);
            }
        } elseif ($this->date_till) {
            $query->andFilterWhere([
                '<=', 'date', $this->date_till
            ]);
        }

        if ($this->name) {
            $query->andFilterWhere(['like', 'name', $this->name]);
        }

        return $dataProvider;
    }

}

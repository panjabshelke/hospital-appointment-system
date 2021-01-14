<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Testimonial;

/**
 * BannerSearch represents the model behind the search form of `common\models\Banner`.
 */
class TestimonialSearch extends Testimonial
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name','description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Testimonial::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'image' => $this->image,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

    public function searchTestimonialDetails($params) {
        $query = Testimonial::find()->alias('t')->select(['t.id','t.description','t.name']);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // if ($this->parent_category == 'Primary') {
        //     $this->parent_category = '';
        // }
        // if ($this->parent_category == '-1') {
        //     $query->andWhere(['is', 'parent_id', NULL]);
        // } else {
        //     $query->andFilterWhere(['parent_id'=> $this->parent_category]);
        // }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
           
           
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        // ->andFilterWhere(['like', 'status', $this->status]);
        //echo $query->createCommand()->getRawSql();die;
        return $dataProvider;
    }
}

<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProductMaster;

/**
 * ProductMasterSearch represents the model behind the search form of `backend\models\ProductMaster`.
 */
class ProductMasterSearch extends ProductMaster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_type', 'created_by', 'updated_by'], 'integer'],
            [['product_name', 'slug', 'product_description', 'product_image', 'status', 'created_at', 'updated_at'], 'safe'],
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
        // $query = ProductMaster::find();

        $query = ProductMaster::find()->alias('pm')->select(['pm.id', 'pm.product_name', 'pm.slug', 'pm.product_description', 'pm.product_image', 'pm.status', 'pm.created_at', 'pm.created_by', 'pm.updated_at', 'pm.updated_by', 'cm.category_name as category_type'])
                ->Join("INNER JOIN", "tbl_category_master cm", " pm.product_type = cm.id");

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
            // 'id' => $this->id,
            'cm.id' => $this->product_type,
            'pm.status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'pm.product_name', $this->product_name])
            ->andFilterWhere(['like', 'pm.slug', $this->slug])
            ->andFilterWhere(['like', 'pm.product_description', $this->product_description])
            ->andFilterWhere(['like', 'pm.created_at', $this->created_at]);

        return $dataProvider;
    }
}

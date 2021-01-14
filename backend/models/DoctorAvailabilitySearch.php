<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DoctorAvailability;

/**
 * DoctorAvailabilitySearch represents the model behind the search form of `backend\models\DoctorAvailability`.
 * 
 */
class DoctorAvailabilitySearch extends DoctorAvailability {

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'doctor_id', 'branch_id'], 'integer'],
            [['available_from', 'available_upto', 'status', 'created_at', 'modified_at'], 'safe'],
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
        $query = DoctorAvailability::find();
        // $query = DoctorAvailability::find()->alias('pm')->select(['pm.id', 'pm.product_name', 'pm.slug', 'pm.product_description', 'pm.product_image', 'pm.status', 'pm.created_at', 'pm.created_by', 'pm.updated_at', 'pm.updated_by', 'cm.category_name as category_type'])
        //         ->Join("INNER JOIN", "tbl_category_master cm", " pm.product_type = cm.id");

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
            // 'cm.id' => $this->product_type,
            // 'pm.status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'available_from', $this->available_from])
            ->andFilterWhere(['like', 'available_upto', $this->available_upto])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }
}

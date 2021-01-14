<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CategoryMaster;

/**
 * CategoryMasterSearch represents the model behind the search form of `backend\models\CategoryMaster`.
 */
class CategoryMasterSearch extends CategoryMaster {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['id', 'parent_id', 'created_by'], 'integer'],
                [['parent_category', 'category_name', 'created_at', 'modified_at', 'status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = CategoryMaster::find();

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
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'category_name', $this->category_name]);
        // ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    public function searchCategoryDetails($params) {
        $query = CategoryMaster::find()->alias('t')->select(['t.id', 't.category_name', 't.parent_id', 't.created_by', 't.created_at', 't.modified_at', 't.status', '(select subc.category_name from tbl_category_master as subc where subc.id = t.parent_id) as parent_category']);

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
        if ($this->parent_category == 'Primary') {
            $this->parent_category = '';
        }
        if ($this->parent_category == '-1') {
            $query->andWhere(['is', 'parent_id', NULL]);
        } else {
            $query->andFilterWhere(['parent_id'=> $this->parent_category]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'category_name', $this->category_name]);
        // ->andFilterWhere(['like', 'status', $this->status]);
        //echo $query->createCommand()->getRawSql();die;
        return $dataProvider;
    }

    public function getPrimaryCategories() {
        $newArr = [];
        $catArr = CategoryMaster::find()->where(['parent_id' => NULL, 'status' => 'active'])->all();
        if (!empty($catArr)) {
            foreach ($catArr as $catParents) {
                $parentCatArr[$catParents->id] = $catParents->category_name;
            }
            $newArr = ['-1' => 'Primary'] + $parentCatArr;
        }
        return $newArr;
    }

}

<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PatientFollowUpDetails;

/**
 * PatientFollowUpDetailsSearch represents the model behind the search form of `backend\models\PatientFollowUpDetails`.
 */
class PatientFollowUpDetailsSearch extends PatientFollowUpDetails
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'patient_appointemnt_details_fk'], 'integer'],
            [['patient_name', 'patient_contact_no', 'patient_email', 'doctor_prescription', 'next_follow_up_date', 'created_at', 'modified_at', 'doctor_name', 'branch_name'], 'safe'],
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
        $query = PatientFollowUpDetails::find()->alias("pfud");
        $query->select(['pfud.*', PatientAppointmentDetails::tableName().'.doctor_name', PatientAppointmentDetails::tableName().'.branch_name']);
        $query->innerJoin(PatientAppointmentDetails::tableName(), PatientAppointmentDetails::tableName().".id = pfud.patient_appointemnt_details_fk");
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
            'pfud.next_follow_up_date' => $this->next_follow_up_date,
            'pfud.created_at' => $this->created_at,
            'pfud.modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'pfud.patient_name', $this->patient_name])
            ->andFilterWhere(['like', 'pfud.patient_contact_no', $this->patient_contact_no])
            ->andFilterWhere(['like', 'pfud.patient_email', $this->patient_email])
            ->andFilterWhere(['like', 'pfud.doctor_prescription', $this->doctor_prescription])
            ->andFilterWhere(['like', PatientAppointmentDetails::tableName().'.doctor_name', $this->doctor_name])
            ->andFilterWhere(['like', PatientAppointmentDetails::tableName().'.branch_name', $this->branch_name]);

        return $dataProvider;
    }
}

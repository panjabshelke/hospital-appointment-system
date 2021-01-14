<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PatientAppointmentDetails;
use Yii;
use yii\data\ArrayDataProvider;

/**
 * PatientAppointmentDetailsSearch represents the model behind the search form of `backend\models\PatientAppointmentDetails`.
 */
class PatientAppointmentDetailsSearch extends PatientAppointmentDetails
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'doctor_availability_id', 'doctor_id', 'branch_id'], 'integer'],
            [['doctor_name', 'branch_name', 'available_date', 'available_time_slot', 'slot_type', 'booking_status', 'appointment_category', 'status', 'patient_name', 'patient_contact_no', 'created_at', 'modified_at'], 'safe'],
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
        $query = PatientAppointmentDetails::find();
        $todayDate = date('Y-m-d');
        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        // $dataProvider->sort->defaultOrder = ['status' => SORT_DESC];
        // $query->orderBy(['status' => SORT_DESC]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'doctor_availability_id' => $this->doctor_availability_id,
            'doctor_id' => $this->doctor_id,
            'branch_id' => $this->branch_id,
            'available_date' => $this->available_date,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'doctor_name', $this->doctor_name])
            ->andFilterWhere(['like', 'branch_name', $this->branch_name])
            ->andFilterWhere(['like', 'available_time_slot', $this->available_time_slot])
            ->andFilterWhere(['like', 'slot_type', $this->slot_type])
            ->andFilterWhere(['like', 'booking_status', $this->booking_status])
            ->andFilterWhere(['like', 'appointment_category', $this->appointment_category])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'patient_name', $this->patient_name])
            ->andFilterWhere(['like', 'patient_contact_no', $this->patient_contact_no]);
        
            $sqlCommand = $query->createCommand()->getRawSql();
            $sqlCommand .= " ORDER BY status='Pending' DESC, available_date ASC"; 

            $connection = Yii::$app->getDb();
            $command = $connection->createCommand($sqlCommand);
            $result = $command->queryAll();
            // $result
            $dataProvider = new ArrayDataProvider(
                [
            'allModels' => $result,
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

            
            // $command = $connection->createCommand($sqlRecords);
            // $sqlRecords = $command->queryOne();

            // $query->orde rBy('status  = "Pending" DESC');
            // $query->orderBy(['status'.' = "Pending"' => SORT_DESC, 'available_date="'.$todayDate.'"' => SORT_ASC]);
        

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchFollowData($params)
    {
        $query = PatientAppointmentDetails::find();
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->available_date = date('Y-m-d');
        $this->status = 'Confirmed';
        $this->load($params);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'doctor_availability_id' => $this->doctor_availability_id,
            'doctor_id' => $this->doctor_id,
            'branch_id' => $this->branch_id,
            'available_date' => $this->available_date,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'doctor_name', $this->doctor_name])
            ->andFilterWhere(['like', 'branch_name', $this->branch_name])
            ->andFilterWhere(['like', 'available_time_slot', $this->available_time_slot])
            ->andFilterWhere(['like', 'slot_type', $this->slot_type])
            ->andFilterWhere(['like', 'booking_status', $this->booking_status])
            ->andFilterWhere(['like', 'appointment_category', $this->appointment_category])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'patient_name', $this->patient_name])
            ->andFilterWhere(['like', 'patient_contact_no', $this->patient_contact_no]);
        $query->orderBy('doctor_availability_id ASC');
        
        return $dataProvider;
    }
}

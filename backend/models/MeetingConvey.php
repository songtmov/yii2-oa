<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MeetingConvey as MeetingConveyModel;

/**
 * MeetingConvey represents the model behind the search form about `common\models\MeetingConvey`.
 */
class MeetingConvey extends MeetingConveyModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'meeting_type', 'owner_phone', 'cstore_number', 'cstore_area', 'manager_phone', 'emplyees_number', 'hotel_floor', 'ticket', 'draw', 'invitation', 'box'], 'integer'],
            [['meeting_topic', 'meeting_address', 'cstore_address', 'owner_id', 'manager_id', 'training_date', 'hotel_name', 'hotel_address', 'doctor_id', 'instructor_id', 'host_id', 'asistant_id', 'consultant_id', 'engineer_id', 'nurse_id', 'resident_id', 'cameraman_id', 'travel_arrangement', 'vehicle_type', 'renter_id', 'marketing_responsible_id', 'meeting_responsible_id', 'ko_solution', 'place_solution', 'creattime', 'comment'], 'safe'],
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
        $query = MeetingConveyModel::find();

        // add conditions that should always apply here

        //        $dataProvider = new ActiveDataProvider([
        //            'query' => $query,
        //        ]);
        
        $pageSize = isset($params['per-page']) ? intval($params['per-page']) : 20; //默认20
        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' =>  ['pageSize' => $pageSize,],
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
            'meeting_type' => $this->meeting_type,
            'owner_phone' => $this->owner_phone,
            'cstore_number' => $this->cstore_number,
            'cstore_area' => $this->cstore_area,
            'manager_phone' => $this->manager_phone,
            'emplyees_number' => $this->emplyees_number,
            'training_date' => $this->training_date,
            'hotel_floor' => $this->hotel_floor,
            'ticket' => $this->ticket,
            'draw' => $this->draw,
            'invitation' => $this->invitation,
            'box' => $this->box,
            'creattime' => $this->creattime,
        ]);
        
        $query->andFilterWhere(['like', 'meeting_topic', $this->meeting_topic])
            ->andFilterWhere(['like', 'meeting_address', $this->meeting_address])
            ->andFilterWhere(['like', 'cstore_id', $this->cstore_id])
            ->andFilterWhere(['like', 'cstore_address', $this->cstore_address])
            ->andFilterWhere(['like', 'owner_id', $this->owner_id])
            ->andFilterWhere(['like', 'manager_id', $this->manager_id])
            ->andFilterWhere(['like', 'hotel_name', $this->hotel_name])
            ->andFilterWhere(['like', 'hotel_address', $this->hotel_address])
            ->andFilterWhere(['like', 'doctor_id', $this->doctor_id])
            ->andFilterWhere(['like', 'instructor_id', $this->instructor_id])
            ->andFilterWhere(['like', 'host_id', $this->host_id])
            ->andFilterWhere(['like', 'asistant_id', $this->asistant_id])
            ->andFilterWhere(['like', 'consultant_id', $this->consultant_id])
            ->andFilterWhere(['like', 'engineer_id', $this->engineer_id])
            ->andFilterWhere(['like', 'nurse_id', $this->nurse_id])
            ->andFilterWhere(['like', 'resident_id', $this->resident_id])
            ->andFilterWhere(['like', 'cameraman_id', $this->cameraman_id])
            ->andFilterWhere(['like', 'travel_arrangement', $this->travel_arrangement])
            ->andFilterWhere(['like', 'vehicle_type', $this->vehicle_type])
            ->andFilterWhere(['like', 'renter_id', $this->renter_id])
            ->andFilterWhere(['like', 'marketing_responsible_id', $this->marketing_responsible_id])
            ->andFilterWhere(['like', 'meeting_responsible_id', $this->meeting_responsible_id])
            ->andFilterWhere(['like', 'ko_solution', $this->ko_solution])
            ->andFilterWhere(['like', 'place_solution', $this->place_solution])
            ->andFilterWhere(['like', 'comment', $this->comment]);
            
        return $dataProvider;
    }
}

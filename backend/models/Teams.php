<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_teams".
 *
 * @property int $id
 * @property string|null $description
 * @property int $image
 * @property string $status
 */
class Teams extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_teams';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'description','name'], 'required'],
            [['image', 'description'], 'string'],
            [['name'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'name' => 'Name',
            'image' => 'Team Image',
        ];
    }

    public static function getTeamsUploadDir() {
        return Yii::getAlias("@frontend/web") . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "teams";
    }

    public static function getTeamsDir() {
        return Yii::getAlias('@root') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'teams' . DIRECTORY_SEPARATOR;
    }

    public static function getTeamDetails($id = "") {
        $teamsArray = [];
        if(!empty($id)) {
            if(!empty($id) && is_numeric($id)) {
                $teamDtl = Teams::find()->where(['id' => $id])->one();
                if(empty($teamDtl)) {
                    $teamDtl = Teams::find()->where(['id' => 1])->one();
                }
            }
            if(!empty($teamDtl)) {
                $teamsArray = ['id' => $teamDtl->id, 'name' => $teamDtl->name, 'description' => $teamDtl->description, 'image' => self::getTeamsDir().$teamDtl->image];
            }
        }
        if(empty($teamsArray)) {
            $teamsDetails = Teams::find()->all();
            if(!empty($teamsDetails)) {
                foreach($teamsDetails as $teamsDetail) {
                    $teamsArray[] = ['id' => $teamsDetail->id, 'name' => $teamsDetail->name, 'image' => self::getTeamsDir().$teamsDetail->image];
                }
            }
        }
        return $teamsArray;
    }
}

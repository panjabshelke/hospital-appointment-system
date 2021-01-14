<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_testimonials".
 *
 * @property int $id
 * @property string|null $description
 * @property int $image
 * @property string $status
 */
class Testimonial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_testimonials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description','name'], 'required'],
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
            'image' => 'Testimonial Image',
        ];
    }

    public static function getBannerUploadDir() {
        return Yii::getAlias("@frontend/web") . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "testinomy";
    }

    public static function getBannerDir() {
        return Yii::getAlias('@root') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'testinomy' . DIRECTORY_SEPARATOR;
    }

    public static function getTestimonialImages() {
        $bannerArray = [];
        $bannerDetails = Testimonial::find()->all();
        if(!empty($bannerDetails)) {
            foreach($bannerDetails as $bannerDetail) {
                $bannerArray[] = ['name' => $bannerDetail->name, 'image' => self::getBannerDir().$bannerDetail->image];
            }
        }
        if(empty($bannerArray)) {
            $bannerArray = [['name' => "Name 1", 'image' => "/textile/img/default-image.png"],
                            ['name' => "Name 2", 'image' => "/textile/img/default-image.png"],
                            ['name' => "Name 3", 'image' => "/textile/img/default-image.png"]];
        }
        return $bannerArray;
    }

    public static function getTestimonialDetails() {
        $allTestimonialDetail = Testimonial::find()->all();
        return $allTestimonialDetail;
    }

    public static function getTeamDetails() {
        $allTeamDetail = Teams::find()->all();
        // self::getBannerDir().$bannerDetail->image
        return $allTeamDetail;
    }
}

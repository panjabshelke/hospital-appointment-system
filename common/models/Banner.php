<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_banner".
 *
 * @property int $id
 * @property string|null $title
 * @property int $image
 * @property string $status
 */
class Banner extends \yii\db\ActiveRecord
{
    const CATEGORY_STATUS = ['active' => 'Active', 'in-active' => 'In-Active', 'deleted' => 'Deleted'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'image', 'status'], 'required'],
            [['image', 'status'], 'string'],
            [['title'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'status' => 'Status',
        ];
    }

    public static function getBannerUploadDir() {
        return Yii::getAlias("@frontend/web") . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "banner";
    }

    public static function getBannerDir() {
        return Yii::getAlias('@root') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'banner' . DIRECTORY_SEPARATOR;
    }

    public function getBannerImgDir() {
        return Yii::getAlias('@root') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'banner' . DIRECTORY_SEPARATOR;
    }

    public static function getBannerImages($id = "") {
        $bannerArray = [];
        if(empty($id)) {
            $bannerDetails = Banner::find()->where(['status' => 'active'])->all();
            if(!empty($bannerDetails)) {
                foreach($bannerDetails as $bannerDetail) {
                    $bannerArray[] = ['title' => $bannerDetail->title, 'image' => self::getBannerDir().$bannerDetail->image];
                }
            }
        } else {
            $bannerDetails = Banner::find()->where(['id' => $id, 'status' => 'active'])->one();
            if(!empty($bannerDetails)) {
                $bannerArray = ['title' => $bannerDetails->title, 'image' => self::getBannerDir().$bannerDetails->image];
            }
        }
        if(empty($bannerArray)) {
            $bannerArray = [['title' => "Banner 1", 'image' => "/textile/img/default-image.png"],
                            ['title' => "Banner 2", 'image' => "/textile/img/default-image.png"],
                            ['title' => "Banner 3", 'image' => "/textile/img/default-image.png"]];
        }
        return $bannerArray;
    }

    public static function getImage($string){
        preg_match('/<img([ alt="alt"]*?) src="([a-zA-Z0-9._:\\-\\/]+)"([ alt="alt"]*?)(\\/?)>/i',$string,$matches);
        
        foreach($matches AS $match){
            if(preg_match('/(.jpg|jpeg|.gif|.png)$/i',$match)){
                return $match;
                break;
            }
        }
    }
}

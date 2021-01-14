<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_product_master".
 *
 * @property int $id
 * @property int $product_type
 * @property string $product_name
 * @property string $slug
 * @property string $product_description
 * @property string $product_image
 * @property string $status
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 */
class ProductMaster extends \yii\db\ActiveRecord
{
    public $category_type;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_product_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_type', 'product_name', 'product_description'], 'required'],
            [['product_type', 'created_by', 'updated_by'], 'integer'],
            [['product_description', 'product_image', 'status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_name'], 'string', 'max' => 300],
            [['slug'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_type' => 'Product Type',
            'product_name' => 'Product Name',
            'slug' => 'Slug',
            'product_description' => 'Product Description',
            'product_image' => 'Product Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public static function getProductUploadDir() {
        return Yii::getAlias("@frontend/web") . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "product-image";
    }

    public static function getProductDir() {
        return Yii::getAlias('@root') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'product-image' . DIRECTORY_SEPARATOR;
    }
}
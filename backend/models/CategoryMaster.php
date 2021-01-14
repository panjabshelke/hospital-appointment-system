<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_category_master".
 *
 * @property int $id
 * @property string $category_name
 * @property int|null $parent_id
 * @property int|null $created_by
 * @property string|null $created_at
 * @property string|null $modified_at
 * @property string|null $status
 * Yii::$app->params['doctors_id'] branches_id
 */
class CategoryMaster extends \yii\db\ActiveRecord {

    public $parent_category = "Primary";

    const CATEGORY_STATUS = ['active' => 'Active', 'inactive' => 'In-Active', 'deleted' => 'Deleted'];
    const PAYMENT_TYPES_ID = 47;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tbl_category_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['category_name'], 'required'],
                [['id', 'parent_id', 'created_by'], 'integer'],
                [['parent_category', 'slug', 'created_at', 'modified_at'], 'safe'],
                [['category_name', 'status'], 'string', 'max' => 255],
                [['category_name'], 'unique', 'targetAttribute' => ['category_name', 'parent_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
            'parent_id' => 'Parent Category',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'status' => 'Status',
        ];
    }

    static function getActiveCategoryList() {
        return CategoryMaster::find()->where(['parent_id' => null, 'status' => 'active'])->all();
    }

    public static function categoryDetails($id = null) {
        if ($id != null) {
            $query = "SELECT c.*, (select subc.category_name from " . CategoryMaster::tableName() . " as subc where subc.id = c.parent_id) as parent_category FROM " . CategoryMaster::tableName() . " as c WHERE c.id={$id}";

            $categoryDetails = CategoryMaster::findBySql($query)->one();
        } else {
            $categoryDetails = CategoryMaster::find()->all();
        }
        return $categoryDetails;
    }

    public static function getParentCategories($parentCatID = '') {
        return CategoryMaster::find()->select(["id", "category_name"])->where(['parent_id' => $parentCatID, 'status' => 'active'])->all();
    }

    public function beforeSave($insert) {
        $this->slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->category_name));
        return parent::beforeSave($insert);
    }

    /**
     * If child category check is true then pass single row with id check
     * If 
     */
    public static function getAvailableCategoryList($doctorID, $childCategoryCheck = true) {
        if ($childCategoryCheck) {
            // $categoryDetails = CategoryMaster::find()->where(['parent_id' => $doctorID, ])
            // $query = "SELECT c.*, (select subc.category_name from " . CategoryMaster::tableName() . " as subc where subc.id = c.parent_id) as parent_category FROM " . CategoryMaster::tableName() . " as c WHERE c.id={$id}";

            // $categoryDetails = CategoryMaster::findBySql($query)->one();
        } else {
            $categoryDetails = CategoryMaster::find()->all();
        }
        return $categoryDetails;
    }

}

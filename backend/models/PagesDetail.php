<?php

namespace backend\models;

use backend\models\CategoryMaster;
use backend\models\ProductMaster;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * This is the model class for table "tbl_pages_detail".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $page_image
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property string $status
 */
class PagesDetail extends \yii\db\ActiveRecord
{
    const TAG_LINE_ID = 1;
    const PRODUCT_TYPE_ID = 1;
    const ABOUT_US_PAGES_ID = 15;
    const OUR_CLIENTS_PAGES_ID = 4;
    const HOME_PAGE_ID = 1;
    const CATEGORY_STATUS = ['active' => 'Active', 'in-active' => 'In-Active', 'deleted' => 'Deleted'];
    const DIV_COLUMN_ARRAY = [1 => '<div class="col-lg-12 ', 2 => '<div class="col-lg-6 '];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_pages_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['slug', 'description', 'page_image', 'status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
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
            'slug' => 'Slug',
            'description' => 'Description',
            'page_image' => 'Page Image',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'status' => 'Status',
        ];
    }

    static function getActivePages($parentId = "") {
        if($parentId == "")
            return CategoryMaster::find()->where(['status' => 'active'])->andWhere(['not', ['parent_id' => null]])->all();
        else 
            return CategoryMaster::find()->where(['status' => 'active', 'parent_id' => $parentId])->all();
    }

    public function beforeSave($insert) {
        $this->slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->title));
        return parent::beforeSave($insert);
    }

    public static function getPagesUploadDir() {
        return Yii::getAlias("@frontend/web") . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "pages-image";
    }

    public static function getPagesDir() {
        return Yii::getAlias('@root') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'pages-image' . DIRECTORY_SEPARATOR;
    }

    public static function getPagesDetail($categoryId = '', $shortContent = TRUE, $pagesDetailId = "") {
        $pagesDetailsArray = [];
        // $pagesDetails = PagesDetail::find()->where(['status' => 'active'])->orderBy(['id' => SORT_DESC])->limit(3)->all();
        if($categoryId == "") {
            $categoryId = PagesDetail::PRODUCT_TYPE_ID;
        }
        //$pagesDetailId
        $pagesDetails = PagesDetail::find()->alias('pd')->select(["pd.*"])
                            ->Join("INNER JOIN", "tbl_category_master cm", " cm.slug = pd.slug")
                            ->where(['cm.status' => 'active', 'pd.status' => 'active']);
                        if (empty($pagesDetailId))
                            $pagesDetails->andWhere(['cm.parent_id' => $categoryId]);
                        else 
                            $pagesDetails->andWhere(['pd.id' => $pagesDetailId, 'cm.parent_id' => $categoryId]);
        $rowLimit = 1;
        if($categoryId == PagesDetail::OUR_CLIENTS_PAGES_ID) 
            $rowLimit = 100;
        
        $pagesDetails = $pagesDetails->orderBy(['pd.id' => SORT_ASC])->limit($rowLimit)->all(); 
        
        if(!empty($pagesDetails)) {
            foreach($pagesDetails as $pagesDetail) {
                $pagesDetail->description = (strlen($pagesDetail->description) > 125 && $shortContent) ? substr($pagesDetail->description, 0, 120) . "..." : $pagesDetail->description;
                $pagesDetailsArray[] = ['title' => $pagesDetail->title, 'description' => $pagesDetail->description, 'page_image' => self::getPagesDir().$pagesDetail->page_image, 'slug' => $pagesDetail->slug];
            }
        }
        if(empty($pagesDetailsArray)) {
            // $pagesDetailsArray = [['title' => "Fabric", 'description' => "Fabric are designed and used in products, processes, or services where functional requirement trump the ...", 'page_image' => '/textile/img/default-image.png'],
            //                 ['title' => "Made up", 'description' => "Drop Cloth are Durable and Long lasting. Its mainly Suitable for household cleaning & painting projects...", 'page_image' => '/textile/img/default-image.png'],
            //                 ['title' => "Technical Textile", 'description' => "Technical Textiles are defined as materials and products manufactured primarily for their technical and ...", 'page_image' => '/textile/img/default-image.png']];
        }
        return $pagesDetailsArray;
    }

    public function getPageBySlug($slug) {
        
        $productDtl = PagesDetail::find()->where(['slug' => $slug, 'status' => 'active'])->one();
        if (!empty($productDtl)) {

            $productDetails = ProductMaster::find()->alias('pm')->select(["pm.*"])
                            ->Join("INNER JOIN", "tbl_category_master cm", " cm.id = pm.product_type")
                            ->where(['cm.status' => 'active', 'pm.status' => 'active', 'cm.slug' => $productDtl->slug])->orderBy(['pm.id' => SORT_DESC])->all();

            return ['model' => $productDtl, 'productDetails' => $productDetails];
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function getTeamDetails($id = 1) {
        $teamDtl = [];
        if(!empty($id) && is_numeric($id)) {
            $teamDtl = Teams::find()->where(['id' => $id])->one();
            if(empty($teamDtl)) {
                $teamDtl = Teams::find()->where(['id' => 1])->one();
            }
        }
        
        return $teamDtl;
    }
}

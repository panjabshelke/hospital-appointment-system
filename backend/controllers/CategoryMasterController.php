<?php

namespace backend\controllers;

use Yii;
use backend\models\CategoryMaster;
use backend\models\CategoryMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * CategoryMasterController implements the CRUD actions for CategoryMaster model.
 */
class CategoryMasterController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CategoryMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoryMasterSearch();
        $searchModel->status = 'active';
        $dataProvider = $searchModel->searchCategoryDetails(Yii::$app->request->queryParams);
        if (isset($_POST['export_type'])) {
            $dataProvider->pagination = false;
        }
        return $this->render('index', [
            'searchModel' => $searchModel, 
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryMaster model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = new CategoryMaster();
        $categoryDetails = $model->categoryDetails($id);
        if(!empty($categoryDetails))
            $categoryDetails->parent_category = ($categoryDetails->parent_category == null || $categoryDetails->parent_category == "") ? 'Primary' : $categoryDetails->parent_category;
        return $this->render('view', [
            'model' => $categoryDetails,
        ]);
    }

    /**
     * Creates a new CategoryMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateCategory()
    {
        $model = new CategoryMaster();
        $categoryData = CategoryMaster::getActiveCategoryList();
        $categoryData = ArrayHelper::map($categoryData,'id','category_name');
        if ($model->load(Yii::$app->request->post())) {
            $model->created_by = Yii::$app->user->identity->id;
            $model->created_at = $model->modified_at = date('Y-m-d H:i:s');
            if ( $model->save() ) {
                Yii::$app->session->setFlash('success', "Category created successfully.");
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        $categoryStatus = CategoryMaster::CATEGORY_STATUS;
        return $this->render('create-category', [
            'model' => $model,
            'categoryData' => $categoryData,
            'categoryStatus' => $categoryStatus
        ]);
    }

    /**
     * Updates an existing CategoryMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categoryData = $model->getActiveCategoryList();
        $categoryData = ArrayHelper::map($categoryData,'id','category_name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Category details updated successfully.");
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $categoryStatus = CategoryMaster::CATEGORY_STATUS;
        return $this->render('create-category', [
            'model' => $model,
            'categoryData' => $categoryData,
            'categoryStatus' => $categoryStatus
        ]);
    }

    /**
     * Deletes an existing CategoryMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $childCategories = CategoryMaster::find()->where(['parent_id'=> $id])->all();
        if(!empty($childCategories)) {
            // Yii::$app->session->setFlash('success', "Your message to display.");
            // Yii::$app->session->setFlash('warning', "Couldn't connect with server, please verify credentials.");
            Yii::$app->session->setFlash('error', 'First delete all child categories.');
        } else {
            $model = $this->findModel($id);
            $model->status = 'deleted';
            if($model->save())
                Yii::$app->session->setFlash('success', "Category deleted successfully.");
            else
                Yii::$app->session->setFlash('error', 'Category not deleted.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the CategoryMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

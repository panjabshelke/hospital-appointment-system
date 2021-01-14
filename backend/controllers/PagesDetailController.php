<?php

namespace backend\controllers;

use Yii;
use backend\models\PagesDetail;
use backend\models\PagesDetailSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\filters\VerbFilter;

/**
 * PagesDetailController implements the CRUD actions for PagesDetail model.
 */
class PagesDetailController extends Controller
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
     * Lists all PagesDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagesDetailSearch();
        $searchModel->status = 'active';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (isset($_POST['export_type'])) {
            $dataProvider->pagination = false;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PagesDetail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PagesDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PagesDetail();
        $activePages = PagesDetail::getActivePages();
        $activePages = ArrayHelper::map($activePages,'category_name','category_name');
        
        if ($model->load(Yii::$app->request->post())) {
            $model->title = trim($model->title);
            //Check page details allready exists or not If exists then in-active previous pages
            $existingPages = PagesDetail::find()->where(['title' => trim($model->title), 'status' => "active"])
            ->andWhere(['<>','title', 'Our Clients Details'])->all();
            if(!empty($existingPages)) {
                Yii::$app->db->createCommand()
                    ->update(PagesDetail::tableName(), ['status' => 'in-active'], 'status = "active" AND  title = "'.$model->title.'"')
                    ->execute();
            }

            $file = UploadedFile::getInstance($model, 'page_image');
            if (!empty($file)) {
                // image
                $tempFileName = $model->title . '-' . time();
                $prodImageTitle = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $tempFileName));
                $model->page_image = $prodImageTitle . "." . $file->getExtension();
                FileHelper::createDirectory(PagesDetail::getPagesUploadDir(), 0777, true);
                if (file_exists(PagesDetail::getPagesUploadDir() . DIRECTORY_SEPARATOR . $model->page_image)) {
                    unlink(PagesDetail::getPagesUploadDir() . DIRECTORY_SEPARATOR . $model->page_image);
                }
                $file->saveAs(PagesDetail::getPagesUploadDir() . DIRECTORY_SEPARATOR . $model->page_image);
            } else {
                unset($model->page_image);
            }

            $model->created_by = $model->updated_by = Yii::$app->user->identity->id;
            $model->created_at = $model->updated_at = date('Y-m-d H:i:s');
            if ( $model->save() ) {
                Yii::$app->session->setFlash('success', "Page detail added successfully.");
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
            // && $model->save()
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $categoryStatus = PagesDetail::CATEGORY_STATUS;
        return $this->render('create', [
            'model' => $model,
            'activePages' => $activePages,
            'categoryStatus' => $categoryStatus,
        ]);
    }

    /**
     * Updates an existing PagesDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $activePages = PagesDetail::getActivePages();
        $activePages = ArrayHelper::map($activePages,'category_name','category_name');
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'page_image');
            if (!empty($file)) {
                // image
                $tempFileName = $model->title . '-' . time();
                $prodImageTitle = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $tempFileName));
                $model->page_image = $prodImageTitle . "." . $file->getExtension();
                FileHelper::createDirectory(PagesDetail::getPagesUploadDir(), 0777, true);
                if (file_exists(PagesDetail::getPagesUploadDir() . DIRECTORY_SEPARATOR . $model->page_image)) {
                    unlink(PagesDetail::getPagesUploadDir() . DIRECTORY_SEPARATOR . $model->page_image);
                }
                $file->saveAs(PagesDetail::getPagesUploadDir() . DIRECTORY_SEPARATOR . $model->page_image);
            } else {
                unset($model->page_image);
            }
            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_at = date('Y-m-d H:i:s');
            if ( $model->save() ) {
                Yii::$app->session->setFlash('success', "Page detail updated successfully.");
                return $this->redirect(['view', 'id' => $model->id]);
            }
            Yii::$app->session->setFlash('error', "Page detail not added.");
        }
        $categoryStatus = PagesDetail::CATEGORY_STATUS;
        return $this->render('update', [
            'model' => $model,
            'activePages' => $activePages,
            'categoryStatus' => $categoryStatus,
        ]);
    }

    /**
     * Deletes an existing PagesDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(!empty($model)) {
            $model->status = 'deleted';
            if($model->save()){
                Yii::$app->session->setFlash('success', "Page detail deleted successfully.");
            } else{
                Yii::$app->session->setFlash('error', 'Page detail not deleted.');
            }  
        }
          
        return $this->redirect(['index']);
    }

    /**
     * Finds the PagesDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PagesDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PagesDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

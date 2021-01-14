<?php

namespace backend\controllers;

use Yii;
use common\models\Banner;
use common\models\BannerSearch;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
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
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
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
     * Displays a single Banner model.
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
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'image');
            
            if (!empty($file)) {
                // image
                $tempFileName = $model->title . '-' . time();
                $prodImageTitle = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $tempFileName));
                $model->image = $prodImageTitle . "." . $file->getExtension();
                FileHelper::createDirectory(Banner::getBannerUploadDir(), 0777, true);
                if (file_exists(Banner::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image)) {
                    unlink(Banner::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image);
                }
                $file->saveAs(Banner::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image);
            } else {
                unset($model->product_image);
            }
            if($model->save()) {
                // Yii::$app->session->setFlash('warning', "Couldn't connect with server, please verify credentials.");
                Yii::$app->session->setFlash('success', "Banner image added successfully.");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', "Banner image not added.");
            }
            
        }

        $categoryStatus = Banner::CATEGORY_STATUS;
        return $this->render('create', [
            'model' => $model,
            'categoryStatus' => $categoryStatus,
        ]);
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'image');
            if (!empty($file)) {
                // image
                $tempFileName = $model->title . '-' . time();
                $prodImageTitle = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $tempFileName));
                $model->image = $prodImageTitle . "." . $file->getExtension();
                FileHelper::createDirectory(Banner::getBannerUploadDir(), 0777, true);
                if (file_exists(Banner::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image)) {
                    unlink(Banner::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image);
                }
                $file->saveAs(Banner::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image);
            } else {
                unset($model->image);
            }
            if($model->save()) {
                // Yii::$app->session->setFlash('warning', "Couldn't connect with server, please verify credentials.");
                Yii::$app->session->setFlash('success', "Banner image added successfully.");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', "Banner image not added.");
            }
        }
        $categoryStatus = Banner::CATEGORY_STATUS;
        return $this->render('update', [
            'model' => $model,
            'categoryStatus' => $categoryStatus
        ]);
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->status = 'deleted';
        if($model->save()){
            Yii::$app->session->setFlash('success', "Category deleted successfully.");
        }     
        else{
            Yii::$app->session->setFlash('error', 'Category not deleted.');
        }    
        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

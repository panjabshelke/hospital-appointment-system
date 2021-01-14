<?php

namespace backend\controllers;

use Yii;
use backend\models\Testimonial;
use backend\models\TestimonialSearch;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestimonialController implements the CRUD actions for Banner model.
 */
class TestimonialController extends Controller
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
        $searchModel = new TestimonialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->searchTestimonialDetails(Yii::$app->request->queryParams);
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
        $model = new Testimonial();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'image');
            
            if (!empty($file)) {
                // image
                $tempFileName = $model->name . '-' . time();
                $prodImageTitle = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $tempFileName));
                $model->image = $prodImageTitle . "." . $file->getExtension();
                FileHelper::createDirectory(Testimonial::getBannerUploadDir(), 0777, true);
                if (file_exists(Testimonial::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image)) {
                    unlink(Testimonial::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image);
                }
                $file->saveAs(Testimonial::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image);
            } else {
                // unset($model->product_image);
            }
            if($model->save()) {
                // Yii::$app->session->setFlash('warning', "Couldn't connect with server, please verify credentials.");
                Yii::$app->session->setFlash('success', "Testimonial added successfully.");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', "Testimonial not added.");
            }
            
        }

        return $this->render('create', [
            'model' => $model,
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
                $tempFileName = $model->name . '-' . time();
                $prodImageTitle = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $tempFileName));
                $model->image = $prodImageTitle . "." . $file->getExtension();
                FileHelper::createDirectory(Testimonial::getBannerUploadDir(), 0777, true);
                if (file_exists(Testimonial::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image)) {
                    unlink(Testimonial::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image);
                }
                $file->saveAs(Testimonial::getBannerUploadDir() . DIRECTORY_SEPARATOR . $model->image);
            } else {
                // unset($model->product_image);
            }
            if($model->save()) {
                // Yii::$app->session->setFlash('warning', "Couldn't connect with server, please verify credentials.");
                Yii::$app->session->setFlash('success', "Testinomy added successfully.");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', "Testinomy not added.");
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Testinomy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
        if (($model = Testimonial::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

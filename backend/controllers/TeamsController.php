<?php

namespace backend\controllers;

use Yii;
use backend\models\Teams;
use backend\models\TeamsSearch;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeamsController implements the CRUD actions for Team model.
 */
class TeamsController extends Controller
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
     * Lists all Team models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeamsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->searchTeamsDetails(Yii::$app->request->queryParams);
        if (isset($_POST['export_type'])) {
            $dataProvider->pagination = false;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Team model.
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
     * Creates a new Team model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teams();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'image');
            
            if (!empty($file)) {
                // image
                $tempFileName = $model->name . '-' . time();
                $prodImageTitle = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $tempFileName));
                $model->image = $prodImageTitle . "." . $file->getExtension();
                FileHelper::createDirectory(Teams::getteamsUploadDir(), 0777, true);
                if (file_exists(Teams::getteamsUploadDir() . DIRECTORY_SEPARATOR . $model->image)) {
                    unlink(Teams::getteamsUploadDir() . DIRECTORY_SEPARATOR . $model->image);
                }
                $file->saveAs(Teams::getteamsUploadDir() . DIRECTORY_SEPARATOR . $model->image);
            } else {
                // unset($model->product_image);
            }
            if($model->save()) {
                // Yii::$app->session->setFlash('warning', "Couldn't connect with server, please verify credentials.");
                Yii::$app->session->setFlash('success', "Teams added successfully.");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', "Teams not added.");
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Team model.
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
                FileHelper::createDirectory(Teams::getteamsUploadDir(), 0777, true);
                if (file_exists(Teams::getteamsUploadDir() . DIRECTORY_SEPARATOR . $model->image)) {
                    unlink(Teams::getteamsUploadDir() . DIRECTORY_SEPARATOR . $model->image);
                }
                $file->saveAs(Teams::getteamsUploadDir() . DIRECTORY_SEPARATOR . $model->image);
            } else {
                // unset($model->product_image);
            }
            if($model->save()) {
                // Yii::$app->session->setFlash('warning', "Couldn't connect with server, please verify credentials.");
                Yii::$app->session->setFlash('success', "Teams added successfully.");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', "Teams not added.");
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Teams model.
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
     * Finds the Team model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Team the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teams::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

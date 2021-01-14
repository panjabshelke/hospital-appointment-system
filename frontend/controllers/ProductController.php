<?php

namespace frontend\controllers;

// use common\models\OrderDetails;
// use common\models\Customer;
// use frontend\models\Order;
use backend\models\PagesDetail; 
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Product controller
 */
class ProductController extends Controller {

    public function behaviors() {

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionDetail($slug = '') {
        
        $model = new PagesDetail();
        $productDetails = $model->getPageBySlug($slug);
        if (!empty($productDetails['model']->id)) {
            return $this->render('product-details', $productDetails);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

<?php

namespace frontend\controllers;

// use common\models\OrderDetails;
// use common\models\Customer;
// use frontend\models\Order;
use backend\models\PagesDetail;
use backend\models\Teams;
use common\models\Banner;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Product controller
 */
class CoursesController extends Controller {

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

        $pageDetail = $productDetails['model']->description;
        $pageContain = "";
            $pageDetailAry = explode("<tr>", $pageDetail);
            foreach($pageDetailAry as $pageKey => $pageInfo) {
                if( $pageKey == 0)
                    continue;

                $pageInfo = str_replace(['<td colspan="3">', '<td colspan="4">', '<td colspan="5">', '<td colspan="2">', "<td colspan='2'>"], '<td>', $pageInfo);
                // $pageInfo = str_replace('<td colspan="2">', '<td>', $pageInfo);
                $columnCount = substr_count($pageInfo, "<td>");
                $pageDetailInfoAry = explode("<td>", $pageInfo);
                
                
                $temp = 1;
                $pageContain .= '<div class="row about-container">';
                foreach($pageDetailInfoAry as $pageInfoKey => $pageDetailInfo) {
                    if($pageInfoKey == 0)
                        continue;
                    
                    $pageContain .= PagesDetail::DIV_COLUMN_ARRAY[$columnCount];
                    $pageDetailInfo = trim(str_replace(["</td>", "</tr>", "</tbody>", "</table>"], "", $pageDetailInfo));
                    if(strpos($pageDetailInfo, "<img ") !== false){
                        $pageContain .= 'background order-lg-'.$temp.' order-'.$temp.'  wow fadeInUp" style="text-align: center;" >';
                        $imgPath = Banner::getImage($pageDetailInfo);
                        $imgeName = explode(".", $imgPath);
                        $imgId = (isset($imgeName[0]) && !empty($imgeName[0]))? $imgeName[0] : 1;

                        $bannerImg = Banner::getBannerImages($imgeName[0]);
                        $imgAlt = '';
                        $imgPath = 'img/ab-1.jpg';
                        if(!empty($bannerImg)) {
                            $imgPath = $bannerImg['image'];
                            $imgAlt = $bannerImg['title'];
                        }
                        $pageDetailInfo = '<img src="'.$imgPath.'" class="img-fluid" alt="'.$imgAlt.'" style="max-width: 90%;border-radius: 20px;">';
                    } else {
                        $pageContain .= 'content order-lg-'.$temp.' order-'.$temp.' " >';
                    }
                    $pageContain .= $pageDetailInfo."</div>";
                    $temp++;
                }
                $pageContain .='</div>';
            }
            //class="icon-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;"
            $pageContain = str_replace("<li>", '<li class="icon-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp; font-weight: bold; margin-left:80px">', $pageContain);

            $productDetails['pageContain'] = $pageContain;
        
        if (!empty($productDetails['model']->id)) {
            return $this->render('courses-details', $productDetails);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTeamDetail($id) {
        
        $getTeamDetails = Teams::getTeamDetails($id); 
        if(!empty($getTeamDetails)) {
            return $this->render('team-details', ['model' => $getTeamDetails]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        echo "<pre>";
        print_r($getTeamDetails);
        die;
    }
}

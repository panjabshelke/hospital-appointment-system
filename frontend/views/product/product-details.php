<?php

use backend\models\PagesDetail;
use backend\models\ProductMaster;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

?>
    <header>
        <div style="height: 400px !important">
          <div class="item">
            <div class="s-12" style="height: 400px;">
                <?php
                    $bannerImage = trim(PagesDetail::getPagesDir().$model->page_image);
                    if(empty($bannerImage)) {
                        $bannerImage = "/textile/img/default-image.png";
                    }
                ?>
              <img src="<?=$bannerImage?>" alt="" style="height: 400px;width: 100%;">
            </div>
          </div>              
        </div>               
      </header>

      <section class="section background-white">
          <div class="line">
            <h2 class="text-size-40 margin-bottom-30"><?=$model->title?></h2>
            <hr class="break-small background-primary margin-bottom-30">
            <p class="margin-bottom-40" style="font-size: 16px">
                <?php $model->description = str_replace("<p>","<div>", $model->description); 
                    echo $model->description = str_replace("</p>","</div>", $model->description);
                ?>
            </p>
          </div>   
          
          <?php
          if(!empty($productDetails)) {
          ?>
        <div class="section background-white"> 
            <div class="line">
                <h2 class="text-size-40 margin-bottom-20">Products</h2>
                <hr class="break-small background-primary margin-bottom-20">
                <div class="margin">
                    <?php 
                        foreach($productDetails as $productDetail) {
                            $productImage = trim(ProductMaster::getProductDir().$productDetail->product_image);
                            if(empty($productImage)) {
                                $productImage = "/textile/img/default-image.png";
                            }                
                    ?>
                            <div class="s-12 m-6 l-4">
                                <div class="image-with-hover-overlay image-hover-zoom margin-bottom">
                                <div class="image-hover-overlay background-primary"> 
                                    <div class="image-hover-overlay-content text-center padding-2x">
                                     <?= strip_tags(substr($productDetail->product_description, 0, 80)); ?>
                                    </div>
                                </div> 
                                <img src="<?=$productImage?>" alt="<?=$productDetail->product_name;?>" title="<?=$productDetail->product_name;?>" style="height: 224px;" />
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>  
            </div>
        </div> 
          <?php
          }
        //   echo "<pre>";
        //   print_r($productDetails);
        //   die("end here");
          ?>
        </section> 
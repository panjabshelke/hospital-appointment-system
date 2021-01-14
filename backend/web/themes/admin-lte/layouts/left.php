<?php

use mdm\admin\components\Helper;
use yii\helpers\Url;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    // ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Home / Dashboard', 'icon' => 'fa fa-edit-o', 'url' => ['/']],
                    ['label' => 'Category', 'icon' => 'fa fa-edit-o', 'url' => ['/category-master']],
                    ['label' => 'Doctor Availability', 'icon' => 'fa fa-map-o', 'url' => ['/doctor-availability']],
                    ['label' => 'Appointment Details', 'icon' => 'fa fa-map-o', 'url' => ['/patient-appointment-details']],
                    // ['label' => 'Patient Follow Up', 'icon' => 'fa fa-map-o', 'url' => ['/patient-follow-up-details']],
                    [
                        'label' => 'Patient Follow',
                        'items' => [
                            ['label' => 'Add Follow Up', 'url' => Url::to(['/patient-follow-up-details/patient-data'])],
                            ['label' => 'Details', 'url' => Url::to(['/patient-follow-up-details'])],
                        ],
                    ],
                    ['label' => 'User Management', 'icon' => 'fa fa-map-o', 'url' => ['/admin/user']],
                    // patient-data /admin/user/
                    // ['label' => 'Pages', 'icon' => 'fa fa-map-o', 'url' => ['/pages-detail']],
                    // ['label' => 'Banner Images', 'icon' => 'fa fa-map-o', 'url' => ['/banner']],
                    // ['label' => 'Testimonial', 'icon' => 'fa fa-map-o', 'url' => ['/testimonial']],
                    // ['label' => 'Teams', 'icon' => 'fa fa-map-o', 'url' => ['/teams']],
                    [
                        'label' => 'Access Management',
                        'items' => [
                            ['label' => 'Role Assignment', 'url' => Url::to(['/admin/assignment/index'])],
                            ['label' => 'Manage Roles', 'url' => Url::to(['/admin/role/index'])],
                            ['label' => 'Manage Permissions', 'url' => Url::to(['/admin/permission/index'])],
                            ['label' => 'Manage Route', 'url' => Url::to(['/admin/route/index'])],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>

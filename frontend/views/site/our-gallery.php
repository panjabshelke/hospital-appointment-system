<!--/.Navbar -->
<section id="bg2">
    <div class="parallax-overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-5 mt-5  p-4">
                    <div class="inpge-heading mb-3 animate__fadeInRight animate__animated">OUR GALLERY</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">


        <div class="row gallery-box" id="gallery" data-toggle="modal" data-target="#exampleModal">
            <div class="col-12 col-sm-6 col-lg-4">

                <img class="w-100" src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic1.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="0">

            </div>
            <div class="col-12 col-sm-6 col-lg-4 animate__slideOutUp">
                <img class="w-100" src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic2.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="1">
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <img class="w-100" src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic3.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="2">
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <img class="w-100" src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic4.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="3">
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <img class="w-100" src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic5.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="4">
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <img class="w-100" src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic6.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="5">
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <img class="w-100" src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic7.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="6">
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <img class="w-100" src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/11-B.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="7">
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <img class="w-100" src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/12-B.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="8">
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <img class="w-100" src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/13-B.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="9">
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <img class="w-100" src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/14-B.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="10">
            </div>
        </div>

        <!-- Modal -->
        <!-- 
This part is straight out of Bootstrap docs. Just a carousel inside a modal.
-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="carouselExample" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExample" data-slide-to="1"></li>
                                <li data-target="#carouselExample" data-slide-to="2"></li>
                                <li data-target="#carouselExample" data-slide-to="3"></li>
                                <li data-target="#carouselExample" data-slide-to="4"></li>
                                <li data-target="#carouselExample" data-slide-to="5"></li>
                                <li data-target="#carouselExample" data-slide-to="6"></li>
                                <li data-target="#carouselExample" data-slide-to="7"></li>
                                <li data-target="#carouselExample" data-slide-to="8"></li>
                                <li data-target="#carouselExample" data-slide-to="9"></li>
                                <li data-target="#carouselExample" data-slide-to="10"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> Before </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic1.jpg" class="d-block w-100" alt="Image 1" data-slide-to="0">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> After </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/A-pic1.jpg" class="d-block w-100" alt="Image 1">
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> Before </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic2.jpg" class="d-block w-100" alt="Image 1" data-slide-to="1">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> After </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/A-pic2.jpg" class="d-block w-100" alt="Image 1">
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> Before </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic3.jpg" class="d-block w-100" alt="Image 1" data-slide-to="2">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> After </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/A-pic3.jpg" class="d-block w-100" alt="Image 1">
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> Before </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic4.jpg" class="d-block w-100" alt="Image 1" data-slide-to="3">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> After </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/A-pic4.jpg" class="d-block w-100" alt="Image 1">
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> Before </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic5.jpg" class="d-block w-100" alt="Image 1" data-slide-to="4">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> After </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/A-pic5.jpg" class="d-block w-100" alt="Image 1">
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> Before </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic6.jpg" class="d-block w-100" alt="Image 1" data-slide-to="5">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> After </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/A-pic6.jpg" class="d-block w-100" alt="Image 1">
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> Before </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/B-pic7.jpg" class="d-block w-100" alt="Image 1" data-slide-to="6">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> After </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/A-pic7.jpg" class="d-block w-100" alt="Image 1">
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> Before </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/11-B.jpg" class="d-block w-100" alt="Image 1" data-slide-to="7">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> After </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/11-A.jpg" class="d-block w-100" alt="Image 1">
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> Before </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/12-B.jpg" class="d-block w-100" alt="Image 1" data-slide-to="8">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> After </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/12-A.jpg" class="d-block w-100" alt="Image 1">
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> Before </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/13-B.jpg" class="d-block w-100" alt="Image 1" data-slide-to="9">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> After </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/13-A.jpg" class="d-block w-100" alt="Image 1">
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> Before </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/14-B.jpg" class="d-block w-100" alt="Image 1" data-slide-to="10">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-xl-6">
                                            <h3> After </h3> <img src="<?= Yii::getAlias('@root') . DIRECTORY_SEPARATOR ?>img/after-before/photo1/14-A.jpg" class="d-block w-100" alt="Image 1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
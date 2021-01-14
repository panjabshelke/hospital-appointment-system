 <style>
 .social-team .stretch-card>.card {
    width: 100%;
    min-width: 100%
}


.social-team .flex {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto
}



.social-team .padding {
    /* padding: 3rem */
    margin-bottom: 10px;
}

.social-team .card {
    box-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    -ms-box-shadow: none;
  
}

.social-team .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: none;
   margin-left: 100px;
    
}

.social-team .card .card-body {
    padding: 1.25rem 1.75rem
}

.social-team .card .card-title {
    color: #000000;
    margin-bottom: 0.625rem;
    text-transform: capitalize;
    font-size: 0.875rem;
    font-weight: 500
}

.social-team .card .card-description {
    margin-bottom: .875rem;
    font-weight: 400;
    color: #76838f
}

.social-team .btn.btn-social-icon {
    width: 50px;
    height: 50px;
    padding: 0
}

.social-team .template-demo>.btn {
    margin-right: 0.5rem !important
}

.social-team .template-demo {
    margin-top: 0.5rem !important
}

.social-team .btn.btn-rounded {
    border-radius: 50px
}

.social-team .btn-outline-facebook {
    border: 1px solid #3b579d;
    color: #3b579d
}

.social-team .btn-outline-facebook:hover {
    background: #3b579d;
    color: #ffffff
}

.social-team .btn-outline-youtube {
    border: 1px solid #e52d27;
    color: #e52d27
}

.social-team .btn-outline-twitter {
    border: 1px solid #2caae1;
    color: #2caae1
}

.social-team .btn-outline-dribbble {
    border: 1px solid #ea4c89;
    color: #ea4c89
}

.social-team .btn-outline-linkedin {
    border: 1px solid #0177b5;
    color: #0177b5
}

.social-team .btn-outline-instagram {
    border: 1px solid #dc4a38;
    color: #dc4a38
}

.social-team .btn-outline-twitter:hover {
    background: #2caae1;
    color: #ffffff
}

.social-team .btn-outline-linkedin:hover {
    background: #0177b5;
    color: #ffffff
}

.social-team .btn-outline-youtube:hover {
    background: #e52d27;
    color: #ffffff
}

.social-team .btn-outline-instagram:hover {
    background: #e52d27;
    color: #ffffff
}

.social-team .btn-facebook {
    background: #3b579d;
    color: #ffffff
}

.social-team .btn-youtube {
    background: #e52d27;
    color: #ffffff
}

.social-team .btn-twitter {
    background: #2caae1;
    color: #ffffff
}

.social-team .btn-dribbble {
    background: #ea4c89;
    color: #ffffff
}

.social-team .btn-linkedin {
    background: #0177b5;
    color: #ffffff
}

.social-team .btn-instagram {
    background: #dc4a38;
    color: #ffffff
}

.social-team .btn-facebook:hover,
.social-team .btn-facebook:focus {
    background: #2d4278;
    color: #ffffff
}

.social-team .btn-youtube:hover,
.social-team .btn-youtube:focus {
    background: #c21d17;
    color: #ffffff
}

.social-team .btn-twitter:hover,
.social-team .btn-twitter:focus {
    background: #1b8dbf;
    color: #ffffff
}

.social-team .btn-dribbble:hover,
.social-team .btn-dribbble:focus {
    background: #e51e6b;
    color: #ffffff
}

.social-team .btn-linkedin:hover,
.social-team .btn-linkedin:focus {
    background: #015682;
    color: #ffffff
}

.social-team .btn-instagram:hover,
.social-team .btn-instagram:focus {
    background: #bf3322;
    color: #ffffff
}

@media (max-width:900px) {
    .social-team .padding {
        padding: 1.5rem
    }
    .social-team .card {
        margin-left: 50px;
    }
}

@media (max-width:767.98px) {
    .social-team .padding {
        padding: 1rem
    }
    .social-team .card {
        margin-left: 50px;
    }
}
 </style>
 <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix" style="padding-top: 202px !important">
        <div class="container">

            <div class="banner-info">


            </div>
    </section><!-- #intro -->
    <!--==========================
      About Us Section
    ============================-->
    <?php
    // echo $model['description'];
    $test =  strip_tags($model['description'], 'p');
    
    $result['href'] = [];
    preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $model['description'], $result);

    $linkArray = ['facebook.com' => '<button type="button" class="btn btn-social-icon btn-facebook btn-rounded"><i class="fa fa-facebook" style="font-size:18px"></i></button>', 
                  'youtube.com' => '<button type="button" class="btn btn-social-icon btn-youtube btn-rounded"><i class="fa fa-youtube"  style="font-size:18px"></i></button>', 
                  'twitter.com' => '<button type="button" class="btn btn-social-icon btn-twitter btn-rounded"><i class="fa fa-twitter"  style="font-size:18px"></i></button>', 
                  'linkedin.com' => '<button type="button" class="btn btn-social-icon btn-linkedin btn-rounded"><i class="fa fa-linkedin"  style="font-size:18px"></i></button>', 
                  'instagram.com' => '<button type="button" class="btn btn-social-icon btn-instagram btn-rounded"><i class="fa fa-instagram"  style="font-size:18px"></i></button>', 
                  ];
    $userLinks = "";
    // print_r($result);
    $teamDetail = $model['description'];
    
    if(!empty($result['href'])) {
        foreach($result['href'] as $hrefKey => $socialLink) {
            foreach($linkArray as $key => $link) {
                if(strpos($socialLink, $key)) {
                    // $hrefKey
                    $searchString = "<p>".$result[0][$hrefKey].$socialLink."</a></p>";
                    $teamDetail = str_replace($searchString, "", $teamDetail);
                    $userLinks.= '<a href="'.$socialLink.'" style="padding-right:10px">'.$link.'</a>';
                    break;
                }
            }
            
        }
    }

    ?>
    <section id="about">
        <div class="container">

            <header class="section-header">
                <h3><?=$model['name']?></h3>

                <div id="team">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-3 col-md-6 wow fadeInUp" style="margin: 0 auto">
                                <div class="member">
                                    <img src="<?=$model['image']?>" class="img-fluid" alt="">

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- #team -->
                <div class="social-team page-content page-container" id="page-content">
                    <div class="padding">
                        <div class="row container d-flex justify-content-center">
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="template-demo">
                                            <?=$userLinks?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="row about-container">

                <div class="col-lg-12 content order-lg-1 order-2">
                    <?=$teamDetail?>



                    <!-- <div class="icon-box wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon"><i class="fa fa-bar-chart"></i></div>
                        <h4 class="title"><a href="">Dolor Sitema</a></h4>
                        <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat tarad limino ata</p>
                    </div> -->

                </div>

                <!-- <div class="col-lg-6 background order-lg-2 order-1 wow fadeInUp">
                    <img src="img/ab-1.jpg" class="img-fluid float-right" alt="" style="max-width: 90%">
                </div> -->
            </div>


        </div>
    </section><!-- #about -->

    
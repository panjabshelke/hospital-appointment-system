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
    <section id="about">
        <div class="container">

            <header class="section-header">
                <h3><?=(isset($model->title))? $model->title : "Page Heading"?></h3>
            </header>
            <?php
            $pageContain = str_replace("<p><strong>", "<h3 style='margin-top: 30px; color: #ec9c05;'>", $pageContain);
            $pageContain = str_replace("</strong></p>", "</h3>", $pageContain);
            ?>
            <?=$pageContain?>
        </div>
    </section><!-- #about -->

    
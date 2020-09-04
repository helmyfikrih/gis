<!-- section -->
<div class="section ">
    <!-- <div class="section padding_layout_1 blog_grid"> -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right">
                <div class="full">
                    <div class="blog_section margin_bottom_0">
                        <!-- <div class="blog_feature_img"> <img class="img-responsive" src="images/it_service/post-05.jpg" alt="#"> </div> -->
                        <div class="blog_feature_cantant">
                            <p class="blog_head"><?= $news[0]['news_title'] ?></p>
                            <div class="post_info">
                                <ul>
                                    <li><i class="fa fa-user" aria-hidden="true"></i> <?= $news[0]['ud_full_name'] ?></li>
                                    <!-- <li><i class="fa fa-comment" aria-hidden="true"></i> 5</li> -->
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> <?= $news[0]['news_created_date'] ?></li>
                                </ul>
                            </div>
                            <?= $news[0]['news_body'] ?>
                        </div>
                        <!-- <div class="bottom_info margin_bottom_30_all">
                            <div class="pull-right">
                                <div class="shr">Share: </div>
                                <div class="social_icon">
                                    <ul>
                                        <li class="fb"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li class="twi"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li class="gp"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li class="pint"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left">
                <div class="side_bar">
                    <div class="side_bar_blog">
                        <h4>RECENT POST</h4>
                        <div class="recent_post">
                            <ul>
                                <?php foreach ($recent_news as $rn) { ?>
                                    <li>
                                        <p class="post_head"><a href="<?= base_url('news/view/' . $rn['news_id'] . '/' . $rn['news_slug']) ?>"><?= $rn['news_title'] ?></a></p>
                                        <p class="post_date"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $rn['news_created_date'] ?></p>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="side_bar_blog">
                        <h4>TAG</h4>
                        <div class="tags">
                            <ul>
                                <?php
                                $tags  = $news[0]['news_tags'];
                                $tag = explode(",", $tags);
                                ?>
                                <?php foreach ($tag as $t) { ?>
                                    <li><a href="#"><?= $t ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end section -->
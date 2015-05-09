<div id="blog-wrapper">
    <div class="container">

            <?php foreach($this->posts as $k => $post) :?>
                <div class="row"  style="margin: 0 auto;">
                    <div class="12u">

                        <!-- Box -->
                        <section class="box feature">
<!--                            <a href="http://localhost:8080/post/view/--><?//=$post['id']?><!--" class="image featured"><img src="http://localhost:8080/images/pic--><?//=($k+1)?><!--.jpg" alt="" /></a>-->
                            <div class="inner">
                                <header>
                                    <h2><a href="http://localhost:8080/posts/view/<?=$post['id']?>"><?=$post['title']?></a></h2>
                                    <p><small><?=$post['username']?> | <?=$post['post_date']?></small></p>
                                </header>
                                <p><?=$post['excerpt']?></p>
                            </div>
                        </section>

                    </div>
                </div>
            <?php endforeach; ?>

    </div>
</div>
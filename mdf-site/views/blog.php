<div id="blog-wrapper">
    <div class="container">

            <?php foreach($this->posts as $k => $post) :?>
                <div class="row">
                    <div class="10u mdf-center">

                        <!-- Box -->
                        <section class="box feature">
<!--                            <a href="http://localhost:8080/post/view/--><?//=$post['id']?><!--" class="image featured"><img src="http://localhost:8080/images/pic--><?//=($k+1)?><!--.jpg" alt="" /></a>-->
                            <div class="inner">
                                <header>
                                    <h2><a href="/posts/view/<?=$post['id']?>"><?=htmlspecialchars($post['title'])?></a></h2>
                                    <p><small><?=$post['username']?> | <?=$post['post_date']?></small></p>
                                </header>
                                <p><?=$post['excerpt']?></p>
                            </div>
                        </section>
                    </div>
                    <?php if($this->is_logged && $this->uname == $post['username']) { ?>
                        <div class="2u">
                            <a href="http://localhost:8080/user/delete-post/<?=$post['id']?>" class="delete-post button icon fa-remove mdf-full-width">Delete</a>
                        </div>
                    <?php } ?>

                </div>
            <?php endforeach; ?>

    </div>
</div>
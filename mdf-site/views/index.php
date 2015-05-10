<div id="main-wrapper">
    <div class="container">

        <div id="content">

            <!-- Content -->
            <article>
                <div class="row">
                    <div class="8u">
                        <h2>Hello from index, <?php echo $this->username;?>!</h2>
                        <p>The <strong>Farmers' Square</strong> is a small cosy place for anyone with passion for farming, gardening,
                            growing and caring for plants and of course for anyone having <strong>great love for nature</strong>.</p>
                        <p><i>Share your farming thoughts, stories or tips and tricks about your favourite growing topic.</i></p>
                    </div>
                    <div class="4u">
                        <ul>
                            <li><a href="http://localhost:8080/user/login" class="button big icon fa-arrow-circle-right mdf-full-width">Login</a></li>
                            <li><a href="http://localhost:8080/user/register" class="button big alt icon fa-arrow-circle-right mdf-full-width">Register</a></li>
                        </ul>
                    </div>
                </div>
            </article>

        </div>
    </div>
</div>

<!-- Features -->
<div id="features-wrapper">
    <div class="container">
        <div class="row">
            <?php foreach($this->posts as $k => $post) :?>
                <div class="4u">

                    <!-- Box -->
                    <section class="box feature">
                        <a href="posts/view/<?=$post['id']?>" class="image featured"><img src="images/pic<?=($k+1)?>.jpg" alt="" /></a>
                        <div class="inner">
                            <header>
                                <h2><a href="posts/view/<?=$post['id']?>"><?=htmlspecialchars($post['title'])?></a></h2>
                                <p><small><?=$post['username']?> | <?=$post['post_date']?></small></p>
                            </header>
                            <p><?=htmlspecialchars($post['excerpt'])?></p>
                        </div>
                    </section>

                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>





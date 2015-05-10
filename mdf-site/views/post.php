<div id="main-wrapper">
    <div class="container">
        <div id="content">

            <!-- Content -->
            <article>

                <h2><?=htmlspecialchars($this->post['title'])?></h2>
                <small>by <?=$this->post['username']?> | <?=$this->post['post_date']?></small>

                <div><?=$this->post['content']?></div>

            </article>

        </div>
    </div>
</div>
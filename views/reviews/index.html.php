<?php require_once views_path('header.html.php'); ?>
<?php if ($this->success) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <p>Отзыв отпрален</p>
            </div>
        </div>
    </div>
<?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            Sort by:
            <a href="/?sort=created_at&rev=<?php echo $this->sort === 'created_at' && $this->rev ? 0 : 1; ?>">Created</a>
            |
            <a href="/?sort=name&rev=<?php echo $this->sort === 'name' && $this->rev ? 0 : 1; ?>">Name</a>
            |
            <a href="/?sort=email&rev=<?php echo $this->sort === 'email' && $this->rev ? 0 : 1; ?>">Email</a>
        </div>
        <br>
        <br>
        <div class="col-md-12">
            <?php foreach ($this->reviews as $review) : ?>
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?php echo "{$review->name} | {$review->email}" ?>
                            <?php if ($review->is_changed) : ?>
                                <small class="text-muted">изменено администратором</small>
                            <?php endif; ?>
                        </h4>
                        <div><?php echo $review->text; ?></div>

                        <?php if ($review->hasImage()) : ?>
                            <img src="<?php echo uploads_uri($review->image); ?>">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Оставить отзыв</h2>
            <div id="preview" class="hidden">
                <h3>Предпросмотр</h3>
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading"></h4>
                        <div class="text"></div>
                        <img src="" style="max-width: 320px; max-height: 240px">
                    </div>
                </div>
                <br>
                <div class="btn btn-default" onclick="closePreview()">Назад</div>
                <br>
            </div>

            <form id="new-review" action="/" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" name="name" required id="name" class="form-control" placeholder="Имя">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" required id="email" class="form-control"
                                   placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Фото</label>
                    <input type="file" name="image" id="image" class="form-control" placeholder="Фото" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="text">Текст</label>
                    <textarea rows="5" id="text" name="text" required class="form-control"
                              placeholder="Текст"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Отправить</button>
                <div class="btn btn-default" onclick="preview()">Просмотр</div>
            </form>
        </div>
    </div>
    <br>

    <script src="/js/preview.js"></script>
<?php require_once views_path('footer.html.php'); ?>
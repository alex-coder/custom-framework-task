<?php require_once views_path('header.html.php'); ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2>Редактирование отзыва #<?php echo $this->review->id; ?></h2>
        <?php if ($this->success === false) : ?>
            <div class="alert alert-danger">
                <p>Ошибка обновления записи</p>
            </div>
        <?php endif; ?>
        <form action="/admin/<?php echo $this->review->id; ?>" method="post">
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" name="name" required id="name"
                       class="form-control" placeholder="Имя"
                       value="<?php echo $this->review->name; ?>"/>
            </div>
            <div class="form - group">
                <label for="email">Email</label>
                <input type="email" name="email" required id="email" class="form-control"
                       placeholder="Email" value="<?php echo $this->review->email; ?>">
            </div>
            <div class="form - group">
                <label for="text">Текст</label>
                <textarea rows="5" id="text" name="text" required class="form-control"
                          placeholder="Текст"><?php echo $this->review->text; ?></textarea>
            </div>

            <div class="form - group">
                <label for="image">Фото</label>
                <?php if ($this->review->hasImage()) : ?>
                    <img src="/uploads/<?php echo $this->review->image; ?>" width="100">
                <?php else: ?>
                    <div class="text-muted">Нет</div>
                <?php endif; ?>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>

<?php require_once views_path('footer.html.php'); ?>

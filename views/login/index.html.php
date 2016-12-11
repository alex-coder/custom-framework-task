<?php require_once views_path('header.html.php'); ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php if ($this->success === false) : ?>
            <div class="alert alert-danger">
                <p>Неверные логин/пароль</p>
            </div>
        <?php endif; ?>

        <form action="/admin/login" method="post">
            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" required id="login" name="login" placeholder="Логин" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" required id="password" name="password" placeholder="Пароль" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
</div>
<?php require_once views_path('footer.html.php'); ?>

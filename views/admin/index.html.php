<?php require_once views_path('header.html.php'); ?>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Статус</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Текст</th>
        <th>Фото</th>
        <th></th>
    </tr>

    <?php foreach ($this->reviews as $review) : ?>
        <tr>
            <td><?php echo $review->id; ?></td>
            <td id="status<?php echo $review->id; ?>">
                <?php if ($review->status == \App\Models\Review::STATUS_APPROVED) : ?>
                    <div class="text-success">принят</div>
                <?php elseif ($review->status == \App\Models\Review::STATUS_DECLINED) : ?>
                    <div class="text-danger">отклонен</div>
                <?php elseif ($review->status == \App\Models\Review::STATUS_CREATED) : ?>
                    <div class="text-muted">ожидает можерации</div>
                <?php endif; ?>
            </td>
            <td><?php echo $review->name; ?></td>
            <td><?php echo $review->email; ?></td>
            <td><?php echo $review->text; ?></td>
            <td>
                <?php if ($review->hasImage()) : ?>
                    <img width="120" src="<?php echo uploads_uri($review->image); ?>">
                <?php endif; ?>
            </td>
            <td width="100">
                <?php if ($review->status == \App\Models\Review::STATUS_CREATED) : ?>
                    <div onclick="approve(<?php echo $review->id; ?>, this)" class="btn-action btn btn-success btn-xs">
                        Принять
                    </div>
                    <div onclick="decline(<?php echo $review->id; ?>, this)" class="btn-action btn btn-danger btn-xs">
                        Отклонить
                    </div>
                <?php endif; ?>
                <a href="/admin/<?php echo $review->id; ?>" class="btn btn-default btn-xs">Изменить</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<script src="/public/js/admin.js"></script>
<?php require_once views_path('footer.html.php'); ?>

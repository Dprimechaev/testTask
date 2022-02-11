<?php
/* @var $this yii\web\View */
?>
<h1 class="mb-3">Список постов</h1>
<ul class="list-group">
    <?php foreach ($PostsList as $post): ?>
        <li class="list-group-item">
        <?php echo $post->id . '. ' . $post->text?>
        </li>
    <?php endforeach;?>
</ul>

<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <form>
        <div class="form-group">
            <label>Create Post</label>
            <textarea type="password" class="form-control" placeholder="Password" name="text"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


</div>

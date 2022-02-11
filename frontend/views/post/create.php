<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h1 class="mb-3">Создание поста</h1>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'text'); ?>

    <?php echo Html::submitButton('Create', [
            'class' => 'btn btn-primary'
    ]); ?>
<?php ActiveForm::end();


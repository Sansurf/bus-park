<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 19.06.17
 * Time: 22:43
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;
use yii\jui\DatePicker;
?>

<h2>Админ панель</h2>

<!-- Сообщение при успешном сохранении данных -->
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<!-- Сообщение при ошибке сохранения данных -->
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

<!-- Форма добавления данных -->
<?php $form = ActiveForm::begin() ?>
<?= $form->field($driver, 'first_name') ?>
<?= $form->field($driver, 'last_name') ?>
<?= $form->field($driver, 'mobile')->widget(MaskedInput::className(), ['mask' => '+9(999)999-99-99']) ?>
<?= $form->field($driver, 'birth_date')->widget(DatePicker::classname()) ?>
<?= $form->field($driver, 'bus_ids')->label('Модели автобусов')->checkboxList($busesArr) ?>
<?= $form->field($driver, 'active')->checkbox(['checked ' => '']) ?>
<?= Html::submitButton('OK', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>
<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 19.06.17
 * Time: 22:43
 */

use app\models\Bus;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
?>


<h1>Админ панель</h1>

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
<?= $form->field($driver, 'birth_date')->widget(DatePicker::classname(), ['dateFormat' => 'php:Y/m/d']) ?>
<?= $form->field($driver, 'bus_ids')->checkboxList(Bus::listAll()) ?>
<?= $form->field($driver, 'active')->checkbox() ?>
<?= Html::submitButton('OK', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>
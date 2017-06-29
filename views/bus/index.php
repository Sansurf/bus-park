<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 19.06.17
 * Time: 22:22
 */
use yii\helpers\Html;
use \yii\widgets\LinkPager;
?>

<h1>Список водителей:</h1>

<?php foreach ($drivers as $driver) { ?>
    <?= $driver['first_name'] .' '. $driver['last_name'] ?> <br>
    возраст: <?= $age($driver['birth_date']) ?> <br>
    телефон: <?= $driver['mobile'] ?> <br>
    модели автобусов:
    <?php $bus_list = array();
    foreach ($driver->buses as $bus) {
        $bus_list[] = $bus['model'];
    } ?>
    <?= implode(', ', $bus_list) ?> <br>

    // проверка активности водителя
    <?php $checked = false;
    if ($driver['active']) $checked = true; ?>

    <?= Html::checkbox('active_driver', $checked, ['class' => 'active', 'id' => $driver['id']]) ?> ' Активен'
    <br><br>
<?php } ?>

<?php echo LinkPager::widget([
    'pagination' => $pages,
]) ?>
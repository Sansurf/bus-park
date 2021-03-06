<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 19.06.17
 * Time: 22:22
 */
use yii\helpers\Html;
use \yii\widgets\LinkPager;
use app\models\Driver;
?>


<h1>Список водителей:</h1>

<?php foreach ($drivers as $driver) { ?>

    <?= $driver['first_name'] .' '. $driver['last_name'] ?> <br>
    возраст: <?= Driver::age($driver['id']) ?> <br>
    телефон: <?= $driver['mobile'] ?> <br>
    модели автобусов:
    <?php $bus_list = array();
    foreach ($driver->buses as $bus) {
        $bus_list[] = $bus['model'];
    } ?>
    <?= implode(', ', $bus_list) ?> <br>

    <!-- проверка активности водителя -->
    <?php $checked = false;
    if ($driver['active']) $checked = true; ?>

    <?= Html::checkbox('active_driver', $checked, ['class' => 'active', 'id' => $driver['id']]) ?> Активен |
    <?= Html::a('', ['delete', 'id' => $driver->id], [
        'class' => 'glyphicon glyphicon-trash',
        'data' => [
            'confirm' => 'Удалить этого водителя?',
            'method' => 'post',
        ],
    ]) ?>
    <?= Html::a('', ['update', 'id' => $driver->id], ['class' => 'glyphicon glyphicon-pencil']) ?>
    <br><br>
<?php } ?>

<?php echo LinkPager::widget([
    'pagination' => $pages,
]) ?>
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

<h2>Список водителей:</h2>

<?php
foreach ($drivers as $driver) {
    echo $driver['first_name'] .' '. $driver['last_name'] . '<br>';
    echo 'возраст: ' . $age($driver['birth_date']) . '<br>';
    echo 'телефон: ' . $driver['mobile'] . '<br>';
    echo 'модели автобусов: ';
    $bus_list = array();
    foreach ($driver->buses as $bus) {
        $bus_list[] = $bus['model'];
    }
    echo implode(', ', $bus_list) . '<br>';

    $checked = false;
    if ($driver['active']) $checked = true;

    echo Html::checkbox('Active', $checked, ['class' => 'active', 'id' => $driver['id']]) . ' Активен';
    echo '<br><br>';
}
echo LinkPager::widget([
    'pagination' => $pages,
]);
?>
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
AppAsset::register($this);

$this->title = 'Автобусный парк';
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>


<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <ul>
            <li>
                <?= Html::a('Список водителей', Url::to('/')) ?></li>
            <li>
                <?= Html::a('Экран редактирования водителя', Url::to('/admin')) ?></li>
        </ul>
            <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
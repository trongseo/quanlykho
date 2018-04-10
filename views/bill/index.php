<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Create Bill');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bill'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="bill-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form') ?>

</div>

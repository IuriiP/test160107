<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\Authors;

/* @var $this yii\web\View */
/* @var $model app\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?=
    $form->field($model, 'author_id')->dropDownList(
            ArrayHelper::map(Authors::find()->all(), 'id', 'fullName'), ['prompt' => Yii::t('books', 'select Author')])
    ?>

    <?=
    $form->field($model, 'date_from')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => Yii::t('books', 'select Date')],
        'pluginOptions' => [
            'hideInput' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ])
    ?>

    <?=
    $form->field($model, 'date_till')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => Yii::t('books', 'select Date')],
        'pluginOptions' => [
            'hideInput' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ])
    ?>

    <?= $form->field($model, 'name') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

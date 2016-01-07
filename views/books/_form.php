<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use app\models\Authors;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'preview')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false]]);
    ?>

    <?=
    $form->field($model, 'date')->widget(DatePicker::classname(), [
        'value' => date('Y-m-d', strtotime('today')),
        'options' => ['placeholder' => Yii::t('books','select Date')],
        'pluginOptions' => [
            'hideInput' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ])
    ?>

    <?=
    $form->field($model, 'author_id')->dropDownList(
            ArrayHelper::map(Authors::find()->all(), 'id', 'fullName'), ['prompt' => Yii::t('books','select Author')])
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

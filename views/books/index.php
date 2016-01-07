<?php

use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Books'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => "{pager}\n{summary}\n{items}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['format' => 'raw',
                'value' => function($data) {
                    return Html::a(Html::img(Yii::getAlias('@web') . '/' . $data->preview, ['style' => ['max-height' => '120px', 'max-width' => '120px']]), Yii::getAlias('@web') . '/uploads/' . $data->preview, ['rel' => 'fancybox', 'data-pjax' => 0]);
                }],
                    'author.fullName',
                    'date',
                    'name',
                    'created_at',
                    'updated_at',
                    ['class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                            'title' => Yii::t('app', 'Delete'),
                                            'data-pjax' => 'w1',
                                            'data' => [
                                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                                'method' => 'post',
                                            ],
                                ]);
                            },
                                    'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open modalButton"></span>', "#", [
                                            'title' => Yii::t('app', 'View'),
                                            'value' => $url,
                                            'data-pjax' => 'modalContent',
                                ]);
                            },
                                ]
                            ],
                        ],
                    ]);
                    ?>
                </div>
                <?php Pjax::end(); ?>

                <?php
                echo newerton\fancybox\FancyBox::widget([
                    'target' => 'a[rel=fancybox]',
                    'helpers' => true,
                    'mouse' => true,
                    'config' => [
                        'maxWidth' => '90%',
                        'maxHeight' => '90%',
                        'playSpeed' => 7000,
                        'padding' => 0,
                        'fitToView' => false,
                        'width' => '70%',
                        'height' => '70%',
                        'autoSize' => false,
                        'closeClick' => false,
                        'openEffect' => 'elastic',
                        'closeEffect' => 'elastic',
                        'prevEffect' => 'elastic',
                        'nextEffect' => 'elastic',
                        'closeBtn' => false,
                        'openOpacity' => true,
                        'helpers' => [
                            'title' => ['type' => 'float'],
                            'buttons' => [],
                            'thumbs' => ['width' => 68, 'height' => 50],
                            'overlay' => [
                                'css' => [
                                    'background' => 'rgba(0, 0, 0, 0.8)'
                                ]
                            ]
                        ],
                    ]
                ]);
                ?>
                <?php
                Modal::begin([
                    'header' => 'Preview',
                    'id' => 'modal',
                    'size' => 'modal-lg',
                ]);

                echo '<div id="modalContent"></div>';

                Modal::end();
                ?>
                <?php
                $this->registerJs('$(function(){$(".modalButton").click(function(){console.log($(this));$("#modal").modal("show").find("#modalContent").load($(this).closest("a").attr("value"));});});'
                        , View::POS_READY);
                ?>
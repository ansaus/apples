<?php

use common\models\dict\AppleStatus;
use yii\bootstrap\Progress;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ActiveRecord\search\ApplesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Яблоки';
$this->params['breadcrumbs'][] = $this->title;

$statusList = AppleStatus::getList();
?>
<div class="apples-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Сгенерировать', ['generate'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered'],
        'rowOptions'=>function($model){
            if ($model->status == AppleStatus::GROUND) {
                return ['class' => 'bg-success'];
            } elseif ($model->status == AppleStatus::SPOILED) {
                return ['class' => 'bg-danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'color',
                'format' => 'html',
                'value' => function($model) {
                    $color = $model->color;
                    $html = "
                        <span style=\"font-size: 30px; color: $color;\">
                          <i class=\"fas fa-apple-alt\"></i>
                        </span>
                        ";
                    return $html;
                },
                'filter' => false
            ],
            [
                'attribute' => 'size',
                'format' => 'html',
                'value' => function($model) {
                    $percent = $model->size*100;
                    if ($percent <= 20) {
                        $class = 'progress-bar-danger';
                    } elseif ($percent > 20 && $percent <= 50) {
                        $class = 'progress-bar-warning';
                    } else {
                        $class = 'progress-bar-success';
                    }

                    return Progress::widget([
                        'percent' => $percent,
                        'label' => $percent.'%',
                        'barOptions' => ['class' => $class]
                    ]);
                },
                'filter' => false
            ],
            [
                'attribute' => 'status',
                'value'     => function ($model) use ($statusList) {
                    return $statusList[$model->status] ?? $model->status;
                },
                'filter'    => $statusList
            ],
            [
                'attribute' => 'created_date',
                'label' => 'Создано',
                'format' => ['date', 'php:d.m.Y H:i'],
            ],
            [
                'attribute' => 'fallen_date',
                'label' => 'Упало',
                'format' => ['date', 'php:d.m.Y H:i'],
            ],
            [
                'class'     => 'yii\grid\ActionColumn',
                'template'  => '{fall} {eat}',
                'buttons'   => [
                    'eat' => function ($url, $data, $id) {
                        $html = '<a href="" data-role="eat" data-id="'.$data->id.'" class="btn btn-default">Откусить</a>';
                        return $html;
                    },
                    'fall' => function ($url, $data, $id) {
                        $html = '<a href="" data-role="fall" data-id="'.$data->id.'" class="btn btn-default">Упасть</a>';
                        return $html;
                    },
                ],
                'visibleButtons' => [
                    'salary'    => (Yii::$app->user->can('admin/salary/index')),
                ],
            ],
        ],
    ]); ?>


</div>
<?php echo $this->render('js/index.js.php', [
    'model' => $model,
]); ?>

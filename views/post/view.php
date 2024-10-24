<?php
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Post $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['manage']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

/** @var TYPE_NAME $dataProvider */
/** @var TYPE_NAME $searchModel */
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ]
        ])?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'content:ntext',
            'tags',
            'createtime',
        ],
    ]) ?>

    <!-- Exibir os comentários associados -->
    <h2>Comentários</h2>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'content:ntext',
            'createtime',
            'author',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Comment $commentModel, $key, $index, $column) {
                    return Url::toRoute(['/comment/'.$action, 'id' => $commentModel->id]);
                }
            ],
        ],
    ]); ?>




</div>

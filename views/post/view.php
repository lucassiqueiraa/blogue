<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $comments app\models\Comment[] */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <!-- Exibir os detalhes do post -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'content:ntext',
            'createtime',
            // outros atributos do post
        ],
    ]) ?>

    <!-- Exibir os comentários associados -->
    <h2>Comentários</h2>

    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $comments,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]),
        'columns' => [
            'author',
            'content:ntext',
            'createtime',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'comment', // Assegura que as ações CRUD usam o controlador de comentários
                'urlCreator' => function ($action, $model, $key, $index) {
                    // Aqui você define a URL para cada ação de forma personalizada
                    return \yii\helpers\Url::to(["comment/$action", 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


    <p>
        <?= Html::a('Add Comment', ['comment/create', 'post_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

</div>

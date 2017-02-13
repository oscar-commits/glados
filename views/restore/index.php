<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use app\components\ActiveEventField;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RestoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<?= DetailView::widget([
    'model' => $ticketModel,
    'attributes' => [
        [
            'attribute' => 'restore_lock',
            'format' => 'raw',
            'value' =>  ActiveEventField::widget([
                'content' => $ticketModel->restore_lock,
                'event' => 'ticket/' . $ticketModel->id,
                'jsonSelector' => 'restore_lock',
            ]),
            'visible' => YII_ENV_DEV,
            'captionOptions' => ['class' => 'dev_item']
        ],
        [
            'attribute' => 'restore_state',
            'format' => 'raw',
            'value' =>  ActiveEventField::widget([
                'content' => yii::$app->formatter->format($ticketModel->restore_state, 'ntext'),
                'event' => 'ticket/' . $ticketModel->id,
                'jsonSelector' => 'restore_state',
            ]),
        ],
    ],
]) ?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['id' => 'restores-accordion', 'class' => 'panel-group'],
    'itemOptions' => ['class' => 'panel panel-default'],
    'itemView' => '_item',
    'emptyText' => 'No restores found.',
    'layout' => '{items} <br>{summary} {pager}',
]); ?>

<?php

Modal::begin([
    'id' => 'restoreLogModal',
    'header' => '<h4>Backup Log</h4>',
    'footer' => Html::Button('Close', ['data-dismiss' => 'modal', 'class' => 'btn btn-default']),
    'size' => \yii\bootstrap\Modal::SIZE_LARGE
]);

    Pjax::begin([
        'id' => 'restoreLogModalContent',
    ]);
    Pjax::end();

Modal::end();

?>
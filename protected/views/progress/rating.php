<?php
/**
 *
 * @var WorkPlanController $this
 * @var FilterForm $model
 */

$this->pageHeader=tt('Рейтинг группы');
$this->breadcrumbs=array(
    tt('Рейтинг'),
);

Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/rating/main.js', CClientScript::POS_HEAD);

$this->renderPartial('/filter_form/timeTable/group', array(
    'model' => $model,
    'showDateRangePicker' => false,
	'showCheckBoxCalendar'=>false,
));


echo <<<HTML
    <span id="spinner1"></span>
HTML;


if (! empty($model->group))
    $this->renderPartial('rating/_bottom', array(
        'model' => $model,
        'type'  => ProgressController::GROUP
    ));
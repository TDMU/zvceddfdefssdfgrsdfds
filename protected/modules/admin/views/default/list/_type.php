<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ps-appearance',
    'htmlOptions' => array('class' => 'form-horizontal'),
    'action' => '#'
));

    $options = array(
        ' '.tt('Стандартный'),
        ' '.tt('C модулями'),
    );
    $htmlOptions = array(
        'class'=>'ace',
        'labelOptions' => array(
            'class' => 'lbl'
        )
    );


    $htmlOptions2 = array(
        'class'=>'ace',
    );
?>
    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(34)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Выводить Бюджет/контракт')?></span>
        <?=CHtml::hiddenField('settings[34]', PortalSettings::model()->findByPk(34)->ps2)?>
    </div>

    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(35)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Выводить для администратора закрепления паспортов')?></span>
        <?=CHtml::hiddenField('settings[35]', PortalSettings::model()->findByPk(35)->ps2)?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>
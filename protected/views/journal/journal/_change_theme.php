<div class="">
    <?php

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'change-theme-form',
        'htmlOptions' => array('class' => 'form-horizontal')
    ));
    $html = '<div>';
    $html .= $form->errorSummary($model, null, null, array('class' => 'alert alert-error'));

    echo $form->hiddenField($model,'elgzu3');
    echo $form->hiddenField($model,'elgzu2');
    echo $form->hiddenField($model,'r1');

    $dates = R::model()->getDatesForJournalByChangeTheme(
        $elg->elg2,
        $gr->gr1,
        $elg->elg4,
        $elg->elg3,
        $elgz->elgz3
    );

    $items = CHtml::listData($dates, 'elgz1',
        function($data){
            switch($data['elgz4'])
            {
                case '0':
                    $type='';
                    break;
                case '1':
                    $type=tt('Субмодуль');
                    break;
                case '2':
                    $type=tt('ПМК');
                    break;
                default:
                    $type='';
            }

            return sprintf('<strong>'.tt('Занятие').' №%s '.tt('Тема').' №%s %s</strong> %s',$data['elgz3'],$data['ustem3'],$type,$data['ustem5']);
        }
    );

    echo $form->radioButtonList($model,'elgz1',$items, array('separator'=>' '));

    $html .= '</div>';
    echo $html;

    $this->endWidget();
    ?>
</div>
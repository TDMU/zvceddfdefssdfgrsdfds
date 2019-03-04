<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 07.12.2018
 * Time: 17:17
 */

/**
 * @var $st St
 */

$requests = $st->getRequestPayment();

$dataProvider=new CArrayDataProvider($requests,array(
    'sort'=>false,
    'pagination'=>false,
    'keyField' => 'zsno0'
));

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'request-payment-list',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'type' => 'striped bordered',
    'columns' => array(
        array(
            'header' => Zsno::model()->getAttributeLabel('zsno2'),
            'value'=>'$data->zsno2'
        )
    ),
));

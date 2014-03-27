<?php

/**
 * This is the model class for table "vmp".
 *
 * The followings are the available columns in table 'vmp':
 * @property integer $vmp1
 * @property integer $vmp2
 * @property integer $vmp3
 * @property integer $vmp4
 * @property integer $vmp5
 * @property integer $vmp6
 * @property integer $vmp7
 */
class Vmp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vmp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vmp1, vmp2, vmp3, vmp4, vmp5, vmp6, vmp7', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('vmp1, vmp2, vmp3, vmp4, vmp5, vmp6, vmp7', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'vmp1' => 'Vmp1',
			'vmp2' => 'Vmp2',
			'vmp3' => 'Vmp3',
			'vmp4' => 'Vmp4',
			'vmp5' => 'Vmp5',
			'vmp6' => 'Vmp6',
			'vmp7' => 'Vmp7',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('vmp1',$this->vmp1);
		$criteria->compare('vmp2',$this->vmp2);
		$criteria->compare('vmp3',$this->vmp3);
		$criteria->compare('vmp4',$this->vmp4);
		$criteria->compare('vmp5',$this->vmp5);
		$criteria->compare('vmp6',$this->vmp6);
		$criteria->compare('vmp7',$this->vmp7);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vmp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
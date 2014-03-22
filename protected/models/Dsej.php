<?php

/**
 * This is the model class for table "dsej".
 *
 * The followings are the available columns in table 'dsej':
 * @property integer $dsej1
 * @property integer $dsej2
 * @property integer $dsej3
 * @property double $dsej4
 * @property double $dsej5
 * @property double $dsej6
 * @property double $dsej7
 */
class Dsej extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dsej';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('dsej1', 'safe'),
			array('dsej2, dsej3', 'numerical', 'integerOnly'=>true),
			array('dsej4, dsej5, dsej6, dsej7', 'numerical', 'allowEmpty' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('dsej1, dsej2, dsej3, dsej4, dsej5, dsej6, dsej7', 'safe', 'on'=>'search'),
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
			'dsej1' => 'Dsej1',
			'dsej2' => 'Dsej2',
			'dsej3' => 'Dsej3',
			'dsej4' => 'Dsej4',
			'dsej5' => 'Dsej5',
			'dsej6' => 'Dsej6',
			'dsej7' => 'Dsej7',
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

		$criteria->compare('dsej1',$this->dsej1);
		$criteria->compare('dsej2',$this->dsej2);
		$criteria->compare('dsej3',$this->dsej3);
		$criteria->compare('dsej4',$this->dsej4);
		$criteria->compare('dsej5',$this->dsej5);
		$criteria->compare('dsej6',$this->dsej6);
		$criteria->compare('dsej7',$this->dsej7);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dsej the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getMarksForStudent($st1, $nr1)
    {
        $sql = <<<SQL
        SELECT *
        FROM dsej
        WHERE dsej2=:ST1 AND dsej3=:NR1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':NR1', $nr1);
        $res = $command->queryRow();

        if (empty($res)) {
            $model = new Dsej();
            $model->dsej1 = new CDbExpression('GEN_ID(GEN_DSEJ, 1)');
            $model->dsej2 = $st1;
            $model->dsej3 = $nr1;
            $model->dsej4 = 0;
            $model->dsej5 = 0;
            $model->dsej6 = 0;
            $model->dsej7 = 0;
            $model->save();
            $res = $command->queryRow();
        }
        return $res;
    }
}

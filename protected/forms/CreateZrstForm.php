<?php

/**
 * Class CreateZrstForm
 */
class CreateZrstForm extends CFormModel
{
    /**
     * сценарий для первой таблицы (студент)
     * @see Zrst::$zrst4 = 0
     * @see Zrst::$zrst6 = 0
     */
    const TYPE_TABLE1 = 'table1';
    /**
     * сценарий для второй таблицы (студент)
     * @see Zrst::$zrst4 = 1
     */
    const TYPE_TABLE2 = 'table2';
    /**
     * сценарий для третьей таблицы (студент)
     * @see Zrst::$zrst4 = 2
     */
    const TYPE_TABLE3 = 'table3';
    /**
     * сценарий для четвертой таблицы (студент)
     * @see Zrst::$zrst4 = 3
     */
    const TYPE_TABLE4 = 'table4';
    /**
     * сценарий для пятой таблицы (студент)
     * @see Zrst::$zrst4 = 4
     */
    const TYPE_TABLE5 = 'table5';
    /**
     * сценарий для третьей таблицы (студент)
     * @see Zrst::$zrst4 = 0
     * @see Zrst::$zrst6 = 1
     */
    const TYPE_TEACHER = 'teacher';

	public $st1;
    public $us1;
    /**
     * @var CUploadedFile|null
     */
    public $file;

    public $zrst5 = 0;
    public $note;

	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('st1, file', 'required'),
            //array('st1, validateSt1'),
            array('note', 'length', 'max'=>100),
            array('us1', 'required', 'on' => array(self::TYPE_TABLE1, self::TYPE_TEACHER)),
            //array('us1', 'validateUs1', 'on' => array(self::TYPE_TABLE1, self::TYPE_TEACHER)),
            array('zrst5', 'numerical', 'integerOnly'=>true),
            array('zrst5', 'safe', 'on' => array(self::TYPE_TABLE4, self::TYPE_TABLE5 ,self::TYPE_TABLE3, self::TYPE_TABLE1, self::TYPE_TEACHER)),
            array('zrst5', 'required', 'on' => self::TYPE_TABLE2),
            array('zrst5', 'in','range'=>array_keys(self::getZrst5Types()),'allowEmpty'=>false, 'on' => self::TYPE_TABLE2 ),
            array('file', 'file',
                'types'=> 'doc, docx, xls, xlsx, ppt, pptx, pdf, jpeg, jpg, png, zip',
                'maxSize' => 1024 * 1024 * 128,
            ),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'captchaAction' => 'site/captcha'),
		);
	}

    /**
     */
    public function validateUs1($attribute,$params)
    {
        if(!$this->hasErrors())
        {

        }
    }

    /**
     */
    public function validateSt1($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            if(Yii::app()->user->isAdmin)
                return;

            if($this->scenario != self::TYPE_TEACHER){
                if(!Yii::app()->user->isStd)
                    $this->addError('file', tt('Ошибка доступа'));
                else
                    if(Yii::app()->user->isStd!=$this->st1)
                        $this->addError('file', tt('Ошибка доступа'));
            }
        }
    }

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
		    'file' => tt('Файл'),
            'zrst5' => tt('Вид'),
			'verifyCode'=>tt('Проверочный код'),
            'note' => tt('Пояснение'),
		);
	}

    /**
     * @return array
     */
	public static function getZrst5Types(){
	    return array(
	        1=>  tt('олимпиады'),
            2=> tt('конференции, конкурсы, проекты'),
            3=> tt('публикации')
        );
    }

    /**
     * @return bool
     */
    public function save(){
        $model = new Zrst();
        $model->zrst2 = $this->st1;
        $model->zrst3 = $this->us1;
        $model->zrst5 = $this->zrst5;
        $model->zrst7 = empty($this->note) ? '' : $this->note;
        $model->zrst8 = $this->file->extensionName;
        switch ($this->scenario){
            case self::TYPE_TABLE1:
                $model->zrst4 = 0;
                $model->zrst6 = 0;
                break;
            case self::TYPE_TABLE2:
                $model->zrst4 = 1;
                $model->zrst6 = 0;
                break;
            case self::TYPE_TABLE3:
                $model->zrst4 = 2;
                $model->zrst6 = 0;
                break;
            case self::TYPE_TABLE4:
                $model->zrst4 = 3;
                $model->zrst6 = 0;
                break;
            case self::TYPE_TABLE5:
                $model->zrst4 = 4;
                $model->zrst6 = 0;
                break;
            case self::TYPE_TEACHER:
                $model->zrst4 = 0;
                $model->zrst6 = 1;
                break;
        }
        $model->zrst1 = Yii::app()->db->createCommand('select gen_id(GEN_ZRST, 1) from rdb$database')->queryScalar();

        $trans = $model->getDbConnection()->beginTransaction();
        try {
            if (in_array($this->scenario, array(self::TYPE_TABLE1, self::TYPE_TEACHER))) {
                Zrst::model()->deleteAllByAttributes(array(
                    'zrst2'=>$model->zrst2,
                    'zrst3'=>$model->zrst3,
                    'zrst6'=>$model->zrst6
                ));
            }

            if ($model->save()) {
                $fileName = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH) . '/' . $model->zrst1 . '.' . $model->zrst8;
                if($this->file->saveAs($fileName) === false)
                    throw new CException('Ошибка сохранения файла');
            }else{
                throw new CException('Ошибка добавления файла');
            }

            $trans->commit();

            return true;
        }catch (CException $error){
            $trans->rollback();
            throw new CException('Ошибка сохранения файла, откат');
        }
    }
}
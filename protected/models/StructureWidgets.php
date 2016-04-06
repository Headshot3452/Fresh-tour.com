<?php

/**
 * This is the model class for table "structure_widgets".
 *
 * The followings are the available columns in table 'structure_widgets':
 * @property string $id
 * @property string $structure_id
 * @property integer $widget_id
 * @property string $block
 * @property string $settings
 * @property integer $sort
 *
 * The followings are the available model relations:
 * @property Structure $structure
 * @property Widgets $widget
 */
class StructureWidgets extends Model
{
    public $for_children=false;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'structure_widgets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('structure_id, widget_id', 'required'),
			array('widget_id, sort', 'numerical', 'integerOnly'=>true),
			array('structure_id', 'length', 'max'=>11),
			array('block', 'length', 'max'=>50),
            array('for_children,settings','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, structure_id, widget_id, block, settings, sort', 'safe', 'on'=>'search'),
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
			'structure' => array(self::BELONGS_TO, 'Structure', 'structure_id'),
			'widget' => array(self::BELONGS_TO, 'Widgets', 'widget_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'structure_id' => Yii::t('app','Structure'),
			'widget_id' => Yii::t('app','Widget'),
			'block' => Yii::t('app','Block'),
			'settings' => Yii::t('app','Settings'),
			'sort' => Yii::t('app','Sort'),
            'for_children'=>Yii::t('app','For children'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('structure_id',$this->structure_id,true);
		$criteria->compare('widget_id',$this->widget_id);
		$criteria->compare('block',$this->block,true);
		$criteria->compare('settings',$this->settings,true);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StructureWidgets the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getForm($key,$form,$widgets=array(),$blocks=array())
    {
        echo '<div class="item">
                    '.$form->dropDownList($this,'['.$key.']widget_id',$widgets,array('prompt'=>Yii::t('app','Select widget'))).'
                    '.$form->dropDownList($this,'['.$key.']block',$blocks,array('prompt'=>Yii::t('app','Select a location'))).'
                    '.$form->textField($this,'['.$key.']settings');
                    if ($this->isNewRecord)
                    {
                        echo $form->labelEx($this,'['.$key.']for_children').'
                            '.$form->checkbox($this,'['.$key.']for_children');
                    }
                    echo '<a href="javascript:void(0)"><i class="glyphicon glyphicon-remove-circle del-widget"></i></a>
            </div>';
    }
}

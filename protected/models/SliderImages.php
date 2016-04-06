<?php

/**
 * This is the model class for table "slider_images".
 *
 * The followings are the available columns in table 'slider_images':
 * @property string $id
 * @property string $slider_id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string $image
 * @property integer $sort
 *
 * The followings are the available model relations:
 * @property Slider $slider
 */
class SliderImages extends Model
{
    public $item_file;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'slider_images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'filter', 'filter'=>'trim'),
			array('slider_id, title', 'required'),
			array('item_file', 'required','on'=>'insert,update'),
			array('sort', 'numerical', 'integerOnly'=>true, 'allowEmpty'=>true),
			array('slider_id', 'length', 'max'=>10),
			array('title', 'length', 'max'=>128),
			array('url', 'length', 'max'=>255),
            array('description', 'safe'),
//            array('item_file','safe','on'=>'insert,update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, slider_id, title, description, url, image', 'safe', 'on'=>'search'),
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
			'slider' => array(self::BELONGS_TO, 'Slider', 'slider_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'slider_id' => Yii::t('app','Slider'),
			'title' => Yii::t('app','Title'),
			'description' => Yii::t('app','Description'),
			'url' => Yii::t('app','Url'),
			'image' => Yii::t('app','Image'),
			'sort' => Yii::t('app','Sort'),
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
		$criteria->compare('slider_id',$this->slider_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SliderImages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public function behaviors()
    {
        return array(
            'imageBehavior' => array(
                'class'=>'application.behaviors.ImageBehavior',
                'path'=>'data/slider/',
                'sizes'=>array('big'=>array('1920','1080'),'medium'=>array('1170','400'),'small'=>array('200','200')),
                'files_attr_model'=>'image'
            ),
			'SortUpDownBehavior'=>array(
				'class'=>'application.behaviors.SortUpDownBehavior',
				'same_attributes'=>array(
					'slider_id'
				)
			)
        );
    }


    public static function getItemsBySliderId($slider_id)
    {
        return self::model()->findAll(array('condition'=>'slider_id=:slider_id','params'=>array(':slider_id'=>$slider_id),'order'=>'sort'));
    }
}

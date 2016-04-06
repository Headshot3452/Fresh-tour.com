<?php

/**
 * This is the model class for table "tag_items".
 *
 * The followings are the available columns in table 'tag_items':
 * @property string $id
 * @property string $tag_id
 * @property string $item_id
 * @property integer $type
 *
 * The followings are the available model relations:
 * @property Tags $tag
 */
class TagItems extends Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tag_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tag_id, item_id, type', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('tag_id, item_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tag_id, item_id, type', 'safe', 'on'=>'search'),
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
			'tag' => array(self::BELONGS_TO, 'Tags', 'tag_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tag_id' => 'Tag',
			'item_id' => 'Item',
			'type' => 'Type',
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
		$criteria->compare('tag_id',$this->tag_id,true);
		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TagItems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Получить список тегов для записи по типу
     * @param $type
     * @param $item_id
     * @return array
     */
    public static function getTagsByType($type,$item_id)
    {
        return CHtml::listData(self::model()->with('tag')->findAllByAttributes(array('type'=>$type,'item_id'=>$item_id)),'id','tag.title');
    }

    public static function removeTags($ids)
    {
        self::model()->deleteAllByAttributes(array('id'=>$ids));
    }

    public static function insertTagItem($tag,$item_id,$type)
    {
        $tag_item=new self;
        $relation=$tag_item->getInstanceRelation('tag');
        $tag_id=$relation::getTagId($tag);

        if ($tag_id)
        {
            $tag_item->tag_id=$tag_id;
            $tag_item->item_id=$item_id;
            $tag_item->type=$type;
            $tag_item->save();
        }
    }
}

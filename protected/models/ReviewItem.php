<?php
    /**
     * This is the model class for table "review_item".
     *
     * The followings are the available columns in table 'review_item':
     * @property string $id
     * @property string $parent_id
     * @property string $user_id
     * @property string $email
     * @property string $phone
     * @property string $language_id
     * @property string $sort
     * @property string $create_time
     * @property integer $status
     * @property integer $rating
     * @property string $text
     * @property string $note
     * @property string $fullname
     */

    class ReviewItem extends Model
    {
        const STATUS_NEW = 1;
        const STATUS_MODERATE = 2;
        const STATUS_ARCHIVE = 3;
        const STATUS_DELETED = 4;
        const STATUS_ANSWERED = 5;
        const STATUS_PLACEMENT = 6;
        const STATUS_REJECTED = 7;

        public $verifyCode;

        /**
         * @return string the associated database table name
         */

        public function tableName()
        {
            return 'review_item';
        }

        /**
         * @return array validation rules for model attributes.
         */

        public function rules()
        {
            return array(
                array('text, fullname, email', 'required'),
                array('text', 'required', 'on' => 'moderate'),
//                array('theme', 'themevalidate', 'on' => 'insert,update'),
                array('phone', 'phonevalidate', 'on' => 'insert,update'),
                array('email', 'emailvalidate', 'on' => 'insert,update'),
                array('fullname', 'fullnamevalidate', 'on' => 'insert, update'),
                array('note', 'safe', 'on' => 'moderate, update'),
                array('parent_id, user_id, language_id, create_time', 'length', 'max' => 11),
                array('phone', 'length', 'max' => 20),
                array('text', 'length', 'min' => 20),
                array('fullname', 'length', 'max' => 255),
                array('header', 'length', 'max' => 60),
                array('email', 'email'),
                array('id, parent_id, user_id, language_id, create_time, status, rating, text, note, fullname', 'safe', 'on' => 'search'),
            );
        }

        public function themevalidate($attribute, $params)
        {
            $set = ReviewSetting::model()->findAll();
            if ($set[0]->status == 1 and $this->theme == '' and Yii::app()->user->isGuest)
            {
                $this->addError('theme', Yii::t('app', 'Error'));
            }
            else
            {
                $this->parent_id = $this->theme;
            }
        }

        public function phonevalidate($attribute, $params)
        {
            $set = ReviewSetting::model()->findAll();
            if ($set[2]->status == 0 and $set[5]->status == 1 and $this->phone == '' and Yii::app()->user->isGuest)
            {
                $this->addError('phone', Yii::t('app', 'Error'));
            }
            elseif($set[2]->status == 0 and $set[5]->status == 1 and Yii::app()->user->isGuest and preg_match('/^\+[0-9]{5,25}$/', $this->phone) != 1)
            {
                $this->addError('phone', Yii::t('app', 'Invalid format'));
            }
        }

        public function emailvalidate($attribute, $params)
        {
            $set = ReviewSetting::model()->findAll();
            if ($set[2]->status == 0 and $set[4]->status == 1 and $this->email == '' and Yii::app()->user->isGuest)
            {
                $this->addError('email', Yii::t('app', 'Error'));
            }
        }

        public function ratingvalidate($attribute, $params)
        {
            $set = ReviewSetting::model()->findAll();
            if ($set[6]->status == 0 and $this->rating == '' and Yii::app()->user->isGuest)
            {
                $this->addError('rating', Yii::t('app', 'Error rating'));
            }
        }

        public function fullnamevalidate($attribute, $params)
        {
            $set = ReviewSetting::model()->findAll();
            if ($set[2]->status == 0 and $set[3]->status == 1 and $this->fullname == '' and Yii::app()->user->isGuest)
            {
                $this->addError('fullname', Yii::t('app', 'Error'));
            }
        }

        /**
         * @return array relational rules.
         */

        public function relations()
        {
            return array(
                'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
                'theme' => array(self::BELONGS_TO, 'ReviewThemesTree', 'parent_id'),
                'language' => array(self::BELONGS_TO, 'Language', 'language_id'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */

        public function attributeLabels()
        {
            return array(
                'id' => Yii::t('app', 'ID'),
                'parent_id' => Yii::t('app', 'Parent'),
                'theme' => Yii::t('app', 'Theme review'),
                'user_id' => Yii::t('app', 'User'),
                'language_id' => Yii::t('app', 'Language'),
                'create_time' => Yii::t('app', 'Create Time'),
                'status' => Yii::t('app', 'Status'),
                'rating' => Yii::t('app', 'Rating'),
                'text' => Yii::t('app', 'Review text'),
                'note' => Yii::t('app', 'Note'),
                'phone' => Yii::t('app', 'Phone'),
                'email' => Yii::t('app', 'E-mail'),
                'fullname' => Yii::t('app', 'Your name'),
                'header' => 'Заголовок',
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

        public function search($page_size)
        {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id, true);
            $criteria->compare('parent_id', $this->parent_id, true);
            $criteria->compare('user_id', $this->user_id, true);
            $criteria->compare('language_id', $this->language_id, true);
            $criteria->compare('create_time', $this->create_time, true);
            $criteria->compare('status', $this->status);
            $criteria->compare('rating', $this->rating);
            $criteria->compare('text', $this->text, true);
            $criteria->compare('note', $this->note, true);
            $criteria->compare('fullname', $this->fullname, true);

            return new CActiveDataProvider($this,
                array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => $page_size,
                        'pageVar' => 'page',
                    ),
                )
            );
        }

        public function behaviors()
        {
            return array(
                'CTimestampBehavior' => array(
                    'class' => 'zii.behaviors.CTimestampBehavior',
                    'createAttribute' => 'create_time',
                    'updateAttribute' => null,
                ),
                'LanguageBehavior' => array(
                    'class' => 'application.behaviors.LanguageBehavior',
                ),
                'ContentBehavior' => array(
                    'class' => 'application.behaviors.ContentBehavior',
                ),
            );
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         * @param string $className active record class name.
         * @return ReviewItem the static model class
         */

        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        public static function getStatus($key = null)
        {
            $array = array(
                self::STATUS_ARCHIVE => Yii::t('app', 'Status archive'),
                self::STATUS_NEW => Yii::t('app', 'Status new'),
                self::STATUS_DELETED => Yii::t('app', 'Deleted'),
                self::STATUS_ANSWERED => Yii::t('app', 'Status answer'),
            );

            return $key === null ? $array : self::getArrayItem($array, $key);
        }

        public static function getFilterStatus($key = null)
        {
            $array = array(
                self::STATUS_NEW => Yii::t('app', 'Status new'),
                self::STATUS_MODERATE => Yii::t('app', 'Status moderate'),
                self::STATUS_PLACEMENT => Yii::t('app', 'Status placement'),
                self::STATUS_REJECTED => Yii::t('app', 'Status rejected'),
            );

            return $key === null ? $array : self::getArrayItem($array, $key);
        }

        public static function getItemsByThemeId($theme_id)
        {
            return self::model()->findAllByAttributes(array('parent_id' => $theme_id));
        }

        public static function getItemsByStatus($status = array())
        {
            $criteria = new CDbCriteria();

            foreach($status as $s)
            {
                $criteria->addCondition('t.status = :status'.$s, 'or');
                $params[':status'.$s] = $s;
                $criteria->params = $params;
            }
            return self::model()->findAll($criteria);
        }

        public static function getRating($key = null)
        {
            $array = array(
                1 => Yii::t('app', 'Horror'),
                2 => Yii::t('app', 'Poorly'),
                3 => Yii::t('app', 'It could be better'),
                4 => Yii::t('app', 'Good'),
                5 => Yii::t('app', 'Excellent'),
                0 => Yii::t('app', 'Not rated'),
            );

            return $key === null ? $array : self::getArrayItem($array, $key);
        }

        public function getReviewProvider($pagesize = 4, $date_from = '', $date_to = '', $status = null, $theme = null, $sort = 't.id', $order = 'DESC')
        {
            $criteria = new CDbCriteria();
            $criteria->with = array('theme');

            if ($status != self::STATUS_ARCHIVE and $status != self::STATUS_DELETED)
            {
                $criteria->addCondition('t.status != :status0')->addCondition('t.status != :status1');
                $params[':status0'] = self::STATUS_DELETED;
                $params[':status1'] = self::STATUS_ARCHIVE;
            }

            if ($status) {
                $criteria->addCondition('t.status = :status');
                $params[':status'] = $status;
            }

            if ($theme > 0) {
                $criteria->addCondition('t.parent_id = :parent_id');
                $params[':parent_id'] = $theme;
            }

            if ($date_from) {
                $criteria->addCondition('t.create_time > :date_from');
                $params[':date_from'] = $date_from;
            }

            if ($date_to) {
                $criteria->addCondition('t.create_time < :date_to');
                $params[':date_to'] = $date_to;
            }


            if (isset($params)) {
                $criteria->params = $params;
            }

            $criteria->order = $sort . ' ' . $order;

            return new CActiveDataProvider($this,
                array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => $pagesize,
                        'pageVar' => 'page',
                    )
                )
            );
        }
    }

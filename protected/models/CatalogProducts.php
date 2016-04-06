<?php
    /**
     * This is the model class for table "catalog_products".
     *
     * The followings are the available columns in table 'catalog_products':
     * @property string $id
     * @property string $parent_id
     * @property string $language_id
     * @property string $sort
     * @property string $seo_title
     * @property string $seo_keywords
     * @property string $seo_description
     * @property string $article
     * @property string $barcode
     * @property double $price
     * @property double $old_price
     * @property string $images
     * @property string $title
     * @property string $name
     * @property string $text
     * @property string $create_time
     * @property string $update_time
     * @property integer $status
     * @property integer $sale
     * @property integer $popular
     * @property integer $new
     * @property integer $hit
     * @property integer $count
     * @property integer $unit_id
     * @property string $stock
     * @property string $sale_info
     * @property string $preview
     *
     * The followings are the available model relations:
     * @property Language $language
     * @property CatalogTree $parent
     * @property CatalogProductsParams[] $catalogProductsParams
     * @property OrderItems[] $orderItems
     */
    class CatalogProducts extends Model
    {
        const PathImage='data/catalog/products/';

        public $item_file='';

        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return 'catalog_products';
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
                array('parent_id, title', 'required'),
                array('status','default','value'=>self::STATUS_OK,'on'=>'insert'),
                array('parent_id, create_time, update_time, status, sale, popular, new, hit', 'numerical', 'integerOnly'=>true),
                array('price,old_price,count,unit_id', 'numerical'),
                array('language_id', 'length', 'max'=>10),
                array('article', 'length', 'max'=>15),
                array('barcode', 'length', 'max'=>20),
                array('seo_title, seo_keywords, title, name, preview', 'length', 'max'=>255),
                array('sort,seo_description,text, item_file,sale_info,stock,unit_id','safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, parent_id, language_id, seo_title, seo_keywords, seo_description, article, barcode, price, old_price, images, title, name, text, create_time, update_time, sale, popular, new, hit, status', 'safe', 'on'=>'search'),
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
                'parent' => array(self::BELONGS_TO, 'CatalogTree', 'parent_id'),
                'parameters' => array(self::HAS_MANY, 'CatalogProductsParams', 'product_id'),
                'parameters_value' => array(self::HAS_MANY, 'CatalogParamsVal', array('value_id'=>'id'), 'through' => 'parameters'),
                'language' => array(self::BELONGS_TO, 'Language', 'language_id'),
                'parameters_uniq' => array(self::HAS_MANY, 'CatalogProductsParams', 'product_id','group'=>'parameters_uniq.`params_id`'),
                'orderItems' => array(self::HAS_MANY, 'OrderItems', 'product_id'),
                'productsReleateds' => array(self::HAS_MANY, 'ProductsReleated', 'product_id'),
                'productsReleatedsId' => array(self::HAS_MANY, 'ProductsReleated', 'releated_id'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'parent_id' => Yii::t('app','Parent'),
                'language_id' => Yii::t('app','Language'),
                'sort' => Yii::t('app','Sort'),
                'seo_title' => Yii::t('app','Seo Title'),
                'seo_keywords' => Yii::t('app','Seo Keywords'),
                'seo_description' => Yii::t('app','Seo Description'),
                'article' =>  Yii::t('app', 'Article'),
                'barcode' =>  Yii::t('app', 'Barcode'),
                'price' => Yii::t('app','Price'),
                'old_price' => Yii::t('app','Old price'),
                'images' => Yii::t('app','Images'),
                'title' => Yii::t('app','Title'),
                'name' => Yii::t('app','Name product'),
                'text' => Yii::t('app','Text'),
                'create_time' => Yii::t('app','Create Time'),
                'update_time' => Yii::t('app','Update Time'),
                'status' => Yii::t('app','Status'),
                'sale' =>  Yii::t('app','Sale'),
                'popular' => Yii::t('app','Popular'),
                'new' => Yii::t('app','New'),
                'hit' => Yii::t('app','Hit'),
                'count' => Yii::t('app','Count'),
                'unit_id' =>  Yii::t('app','Unit'),
                'stock' => Yii::t('app','Stock'),
                'sale_info' => Yii::t('app','Sale Info'),
                'preview' => Yii::t('app','Preview'),
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

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id);
            $criteria->compare('parent_id',$this->parent_id);
            $criteria->compare('language_id',$this->language_id,true);
            $criteria->compare('sort',$this->sort);
            $criteria->compare('seo_title',$this->seo_title,true);
            $criteria->compare('seo_keywords',$this->seo_keywords,true);
            $criteria->compare('seo_description',$this->seo_description,true);
            $criteria->compare('article',$this->article,true);
            $criteria->compare('barcode',$this->barcode,true);
            $criteria->compare('price',$this->price);
            $criteria->compare('old_price',$this->old_price);
            $criteria->compare('images',$this->images,true);
            $criteria->compare('title',$this->title,true);
            $criteria->compare('name',$this->name,true);
            $criteria->compare('text',$this->text,true);
            $criteria->compare('create_time',$this->create_time);
            $criteria->compare('update_time',$this->update_time);
            $criteria->compare('status',$this->status);
            $criteria->compare('sale',$this->sale);
            $criteria->compare('popular',$this->popular);
            $criteria->compare('new',$this->new);
            $criteria->compare('hit',$this->hit);
            $criteria->compare('count',$this->count);
            $criteria->compare('unit_id',$this->unit_id);
            $criteria->compare('stock',$this->stock,true);
            $criteria->compare('sale_info',$this->sale_info,true);
            $criteria->compare('preview',$this->preview,true);

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=>$page_size,
                ),
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         * @param string $className active record class name.
         * @return CatalogProducts the static model class
         */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

        public function behaviors()
        {
            return array(
                'CTimestampBehavior' => array(
                    'class' => 'zii.behaviors.CTimestampBehavior',
                    'createAttribute' => 'create_time',
                    'updateAttribute' => 'update_time',
                ),
                'LanguageBehavior' => array(
                    'class' => 'application.behaviors.LanguageBehavior',
                ),
                'ContentBehavior'=>array(
                    'class'=>'application.behaviors.ContentBehavior',
                ),
                'ImageBehavior'=>array(
                    'class'=>'application.behaviors.ImageBehavior',
                    'path'=>self::PathImage,
                    'find_path'=>'getDir',
                    'files_attr_model'=>'images',
                    'sizes'=>array('small' => array('150', '150'), 'original' => array(null, null), 'big' => array('800', '800')),
                    'quality' => 100
                ),
            );
        }

        public function category($id)
        {
            if ($this->hasAttribute('parent_id'))
            {
                $array=$this->getCriteriaAlias();
                $array['criteria']->mergeWith(array(
                        'condition'=>'`'.$array['alias'].'`.`parent_id`='.$id
                    )
                );
            }
            return $this;
        }

        public function getDir()
        {
            if ($this->isNewRecord)
            {
                $id=self::model()->dbConnection->createCommand('SELECT MAX(`id`) as max_id FROM '.$this->tableName())->queryRow();
                $id=$id['max_id']+1;
            }
            else
            {
                $id=$this->id;
            }

            $dir=self::PathImage.$id.'/';
            if (!file_exists($dir))
            {
                mkdir($dir);
            }

            return $dir;
        }

        public static function getProductsForCategory($parent_id)
        {
            return self::model()->active()->findAll('t.`parent_id`=:parent_id',array('parent_id'=>$parent_id));
        }

        public function getDataProviderForCategory($parent_id, $order = '', $count = 10)
        {
            $criteria = new CDbCriteria;
            $criteria->condition = 't.`parent_id` = :parent_id';
            $criteria->params = array(
                ':parent_id' => $parent_id,
            );

            $criteria->scopes = array(
                  'active'
            );

            $criteria->with = array(
                'parameters' => array('alias' => 'p', 'joinType' => 'INNER JOIN'),
                'parameters_value' => array('alias' => 'v', 'joinType' => 'INNER JOIN'),
            );

            if(isset($_GET['CountryForm']) && !empty($_GET['CountryForm']))
            {
                if($_GET['CountryForm']["date_from"] || $_GET['CountryForm']["tema_tours"] || $_GET['CountryForm']["stars"] || $_GET['CountryForm']["type_hotel"])
                {
                    $criteria->together = true;
                }

                $counter = 0;

                $par = array();

                if($_GET['CountryForm']['price_tours'])
                {
                    $re = "/([0-9 ]*)[Руб -]* ([0-9 ]*)/";
                    $str = $_GET['CountryForm']['price_tours'];
                    preg_match($re, $str, $matches);

                    $from = str_replace(" ", "", $matches[1]);
                    $to = str_replace(" ", "", $matches[2]);

//                $par[] = '(t.`price` >= '.$from.' AND t.`price` <= '.$to.')';

                    $criteria->addCondition('t.`price` >= '.$from.' AND t.`price` <= '.$to);

//                $counter ++;
                }

                if($_GET['CountryForm']['date_from'])
                {
                    $par[] = '(v.`params_id` = :date_from_id AND v.`value` = :date_from_val)';
                    $criteria->mergeWith(
                        array(
                            'params' => array(
                                ':date_from_id' => Yii::app()->params['date_from'],
                                ':date_from_val' => $_GET['CountryForm']['date_from']
                            )
                        )
                    );
                    $counter++;
                }

                if($_GET['CountryForm']['type_hotel'])
                {
                    $id = implode($_GET['CountryForm']['type_hotel'], ',');

                    $par[] = '(v.`params_id` = :type_hotel_id AND v.`value` IN (:type_hotel))';

                    $criteria->mergeWith(
                        array(
                            'params' => array(
                                ':type_hotel_id' => Yii::app()->params['type_hotel'],
                                ':type_hotel' => $id
                            )
                        )
                    );
                    $counter++;
                }

                if($_GET['CountryForm']['stars'])
                {
                    $id = implode($_GET['CountryForm']['stars'], ',');

                    $par[] = '(v.`params_id` = :stars_id AND v.`value` IN ('.$id.'))';

                    $criteria->mergeWith(
                        array(
                            'params'=>array(
                                ':stars_id' => Yii::app()->params['stars']
                            )
                        )
                    );
                    $counter++;
                }

                if($_GET['CountryForm']['tema_tours'])
                {
                    $id = "'" . implode($_GET['CountryForm']['tema_tours'], "','") . "'";
                    $par[] = '(v.`params_id` = :tema_tours_id AND v.`value` IN ('.$id.'))';

                    $criteria->mergeWith(array(
                            'params' => array(
                                ':tema_tours_id' => Yii::app()->params['tema_tours'],
                            )
                        )
                    );
                    $counter += count($_GET['CountryForm']['tema_tours']);
                }

                $pars = implode($par, ' OR ');

                $criteria->mergeWith(
                    array(
                        'condition' => $pars
                    )
                );

                if($counter > 0)
                {
                    $criteria->group = 't.`id`';
                    $criteria->having = 'COUNT(t.`id`) = '.$counter;
                }
            }

            if($order)
            {
                $criteria->order = $order;
            }

            return new CActiveDataProvider($this,
                array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'class' => 'CustomPagination',
                        'pageSize' => $count,
                        'pageVar' => 'page',
                    ),
                )
            );
        }

        /**
         * @param $root_id
         * @param bool $only_parent
         * @param null $language_id
         * @return string
         */

        public function getUrlForItem($root_id, $only_parent = false, $language_id = null)
        {
            $parent=$this->parent;
            if ($parent)
            {
                $url=$parent->findUrlForItem('name', false, $root_id, $language_id).$parent->name.'/';

                if (!$only_parent)
                {
                    $url.=$this->name;
                }

                return $url;
            }
            return $this->name;
        }

        public function typePopular()
        {
            if ($this->hasAttribute('popular'))
            {
                $array=$this->getCriteriaAlias();
                $array['criteria']->mergeWith(array(
                        'condition'=>'`'.$array['alias'].'`.`popular`=1'
                    )
                );
            }
            return $this;
        }

        public function typeSale()
        {
            if ($this->hasAttribute('sale'))
            {
                $array=$this->getCriteriaAlias();
                $array['criteria']->mergeWith(array(
                        'condition'=>'`'.$array['alias'].'`.`sale`=1'
                    )
                );
            }
            return $this;
        }

        public function typeHit()
        {
            if ($this->hasAttribute('hit'))
            {
                $array=$this->getCriteriaAlias();
                $array['criteria']->mergeWith(array(
                        'condition'=>'`'.$array['alias'].'`.`hit`=1'
                    )
                );
            }
            return $this;
        }

        public function typeNew()
        {
            if ($this->hasAttribute('new'))
            {
                $array=$this->getCriteriaAlias();
                $array['criteria']->mergeWith(array(
                        'condition'=>'`'.$array['alias'].'`.`new`=1'
                    )
                );
            }
            return $this;
        }

        /**
         *  товары во всех дочерних категориях для категории $category_id
         * @param $category_id - ид родительской категори, для которой ищутся товары
         * @param bool $same  - искать в категории $category_id
         * @throws InvalidArgumentException
         */

        public function parent($category_id, $same=true)
        {
            $sign = $same? '=' : '';

            $category = $this->getInstanceRelation('parent')->findByPk($category_id);
            if(!$category) throw new InvalidArgumentException('Категория с id='.$category_id.' не найдена');

            $this->with('parent');
            $array=$this->getCriteriaAlias();
            $array['criteria']->mergeWith(array(
                    'condition'=>'`parent`.`lft`>'.$sign.$category->lft.' AND `parent`.`rgt`<'.$sign.$category->rgt.' AND `parent`.`root`='.$category->root,
                    'order' => '`t`.`parent_id` ASC, `t`.`sort` ASC',
                )
            );

            $array['criteria']->mergeWith(array(
                'condition'=>'`parent`.`status` ='.self::STATUS_OK,
            ));

            return $this;
        }

        /**
         *  Расчёт цены с учётом скидки
         * @param $price - цена товара без скидки
         * @param $sale_info  - информация о скидке на товар.
         * (
         * 1-ый парамерт - размер скидки,
         * 2-ой параметр - вид скидки (процент либо число)
         * 3-ий параметр - начало действия скидки
         * 4-ый параметр - окончание действия скидки
         * )
         * @throws InvalidArgumentException
         */

        public function getSalePrice($price, $sale_info)
        {
            $sale = unserialize($sale_info);

            if(empty($sale[0]))
            {
                return 0;
            }

            switch($sale[1])
            {
                case 0:
                    $price_sale = $price - ($price*$sale[0]/100);
                    break;
                case 1:
                    $price_sale = $price - $sale[0];
                    break;
                default:
                    $price_sale = $price;
                    break;
            }
            return number_format($price_sale, 2,'.',' ');
        }

        public function onlyOneParent($category_id, $product_id = NULL, $keys_array = array())
        {
            $category = $this->getInstanceRelation('parent')->findByPk($category_id);

            if(!$category)
            {
                throw new InvalidArgumentException('Категория с id='.$category_id.' не найдена');
            }

            $keys = '';

            if(!empty($keys_array))
            {
                $keys = implode(',', $keys_array);
            }

            $array = $this->getCriteriaAlias();
            $array['criteria']->mergeWith(
                array(
                    'condition' => '`t`.`parent_id` = '.$category_id.' AND `t`.`id` <> '.$product_id.(!empty($keys) ? ' AND `t`.`id` NOT IN ( '.$keys.' )': ''),
                    'order' => '`t`.`sort` ASC',
                )
            );
            return $this;
        }

        public function getViza()
        {
            $viza = $this->getProductsForCategory(Yii::app()->params['vizy_catalog']);
            return CHtml::listData($viza, 'name', 'title');
        }

        public function getStars()
        {
            $par = CatalogProductsParams::model()->find('`params_id` = :id AND `product_id` = :product_id', array(':id' => Yii::app()->params['stars'], ':product_id' => $this->id));
            return CatalogParamsVal::model()->find('id = :id', array(':id' => $par['value_id']));
        }
    }

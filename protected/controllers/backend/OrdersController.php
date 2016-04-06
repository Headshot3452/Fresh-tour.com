<?php
    class OrdersController extends ModuleController
    {
        public $layout_in='backend_one_block';

        public function init()
        {
            parent::init();

        }

        public function filters()
        {
            return array(
                'accessControl',
            );
        }

        public function accessRules()
        {
            return array(
                array('deny',
                    'roles' => array(Users::ROLE_SEO),
                ),
            );
        }

        public static function getModuleName()
        {
            return Yii::t('app','Orders');
        }

        public static function getActionsConfig()
        {
            return array(
                'index'=>array('label'=>static::getModuleName(),'parent'=>'main_orders'),
                'order'=>array('label'=>Yii::t('app','Order'),'parent'=>'index')
            );
        }

        public function actionOrder($id)
        {
            $order = Orders::model()->findByPk($id);
            if(!$order) throw new CHttpException('404');

            if (!empty($_POST))
            {
                $data=CJSON::decode($_POST['products']);
                if (!empty($data))
                {
                    $products=$order->orderItems;
                    $oldProducts=array_combine(array_keys(CHtml::listData($products,'id','id')),$products);
                    $count=count($data);
                    for ($i=0;$i<$count;$i++)
                    {
                        $id=$data[$i]['id'];
                        if (isset($oldProducts[$id]))
                        {
                            if ($oldProducts[$id]->count_edit!=$data[$i]['countEdit'] || $oldProducts[$id]->status!=$data[$i]['status'])
                            {
                                $oldProducts[$id]->count_edit=$data[$i]['countEdit'];
                                $oldProducts[$id]->status=$data[$i]['status'];
                                $oldProducts[$id]->save();
                            }
                            unset($oldProducts[$id]);
                        }
                        else
                        {
                            $product=new OrderItems();
                            $product->attributes=$data[$i];
                            $product->order_id=$order->id;
                            $product->count_edit=$data[$i]['countEdit'];
                            $product->product_type_add=$data[$i]['type'];
                            $product->save();
                        }
                    }

                    foreach($oldProducts as $item)
                    {
                        if ($item->product_type_add==OrderItems::ADMIN_ADD_PRODUCT)
                        {
                            $item->delete();
                        }
                    }

                    $sum=0;
                    $count=0;
                    $products=$order->getRelated('orderItems',true);
                    foreach($products as $product)
                    {
                        if ($product->status==OrderItems::STATUS_OK)
                        {
                            $sum+=$product->getItemPrice();
                            $count+=$product->getCount();
                        }
                    }
                    $order->count=$count;
                    $order->sum=$sum;
                    if ($order->sum > $order->getDeliveryLimit())
                    {
                        $order->sum_delivery=0;
                    }
                    $order->save();

                    $this->refresh();
                }
            }


            $managers = Users::model()->findAllByAttributes(array('role'=>Users::ROLE_MODER),array('with'=>'user_info'));
            $workers = Workers::model()->findAll();

            $this->pageTitleBlock = $this->renderPartial('_order_bar',array('order'=>$order),true);

            $this->render('order',array('order'=>$order,
                                        'managers'=>$managers,
                                        'workers'=>$workers,
                                        'products'=>$order->orderItems));

        }

        public function actionIndex()
        {
            $managers = Users::model()->findAllByAttributes(array('role'=>Users::ROLE_MODER),array('with'=>'user_info'));
            $picker = Workers::model()->findAllByAttributes(array('role'=>Workers::ROLE_PICKER));
            $executor = Workers::model()->findAllByAttributes(array('role'=>Workers::ROLE_EXECUTOR));

            $managers_list = array();
            foreach($managers as $item)
            {
                $managers_list['m_'.$item->id] = $item->getFullName();
            }

            $workers = array(
                'Менеджеры'=>$managers_list,
                'Сборщики'=>$this->setKeyPrefix($picker,'id','name','w_'),
                'Исполнители'=>$this->setKeyPrefix($executor,'id','name','w_'),
            );

            //поля соортировки
            $sort_list = array(
    //            'id'=>'По номеру заказа',
                'delivery_time'=>'По оставшемуся времени',
                'user_id'=>'По клиенту',
                'sum_asc'=>'По сумме (возрастание)',
                'sum_desc'=>'По сумме (убывание)',
                'count'=>'По количеству товаров в заказе',
            );

            //период в unixtime
            $date_from = $this->strToTime(Yii::app()->request->getParam('date_from'));
            $date_to = $this->strToTime(Yii::app()->request->getParam('date_to'));

            //определяем по кому фильтруем, по менеджеру или работникам
            $manager_id = '';
            $worker_id = '';
            if($worker = Yii::app()->request->getParam('worker'))
            {
                $worker_data = explode('_',$worker);

                if(count($worker_data) == 2)
                {
                    //у менеджера префикс m, у работника w
                    if($worker_data[0] == 'm')
                    {
                        $manager_id = $worker_data[1];
                    }
                    elseif($worker_data[0] == 'w')
                    {
                        $worker_id = $worker_data[1];
                    }
                }
            }

            //сортировка
            $order = 'DESC';
            $sort = 't.id';
            if(($sort_param = Yii::app()->request->getParam('sort')) && isset($sort_list[$sort_param]))
            {
                //если есть постфикс _desc или _asc
                if(strpos($sort_param,'_desc') !== false)
                {
                    $sort = 't.'.str_replace('_desc','',$sort_param);
                }
                elseif(strpos($sort_param,'_asc') !== false)
                {
                    $sort = 't.'.str_replace('_asc','',$sort_param);
                    $order = 'ASC';
                }
                else
                {
                    $sort = 't.'.$sort_param;
                }
            }

            $this->pageTitleBlock = $this->renderPartial('_filter',array('workers'=>$workers,'sort_list'=>$sort_list),true);
            $provider = Orders::getAdminOrdersProvider(15,'',Yii::app()->request->getParam('status'),$manager_id,$worker_id,$date_from,$date_to,$sort,$order);
            $this->render('index',array('dataProvider'=>$provider));
        }

        public function actionChangeStatus($status,$id)
        {
            $order = Orders::model()->findByPk($id);

            if(!$order) throw new CHttpException('404');

            try{
                Orders::getStatus($status);

                $order->status = $status;

                $order->save();

            }
            catch(Exception $ex){
                echo $ex->getMessage();
            }

            Yii::app()->end();
        }

        protected function setKeyPrefix($array,$key_attr,$val_attr,$pref='')
        {
            $new_array = array();
            foreach($array as $item)
            {
                $new_array[$pref.$item->{$key_attr}] = $item->{$val_attr};
            }

            return $new_array;
        }

        protected  function strToTime($str)
        {
            if($str)
            {
                $date = explode('.',$str);
                if(count($date) == 3)
                {
                    return mktime(0,0,0,$date[1],$date[0],$date[2]);
                }

            }

            return '';
        }
    }

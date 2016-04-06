<?php
class ProfileController extends FrontendController
{
    public $layout='profile_left_menu';

    protected $order_periods = array('7'=>'Неделя','30'=>'Месяц','0'=>'Все');

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'roles'=>array(Users::ROLE_USER),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $user = Yii::app()->user->getUser();
        $full_name = UserInfo::getForUser($user->id)->getFullName();

//        $periods = array_keys($this->order_periods);
//        $period = Yii::app()->request->getParam('period');

//        if(!is_numeric($period))
//        {
//            $period = $periods[0];
//        }
//        elseif(!$period)
//        {
//            $period = null;
//        }

//        $dataProvider = Orders::getOrdersProvider(Yii::app()->user->id,$period);

        if(Yii::app()->request->isAjaxRequest)
        {
            $this->render('_orders_list',array('orders'=>$dataProvider));
        }
        else
        {
            $this->render('index',array('full_name'=>$full_name, 'user'=>$user));
//            $this->render('orders',array('orders'=>$dataProvider));
        }
    }

    public function actionOrder($id)
    {
        $order = Orders::model()->findByAttributes(array('id'=>$id,'user_id'=>Yii::app()->user->id));
        if(!$order) throw new CHttpException(404);

        $this->render('order',array('order'=>$order));
    }

    public function actionOrderRating($id)
    {
        $order = Orders::model()->with('orderRating')->findByAttributes(array('id'=>$id,'user_id'=>Yii::app()->user->id));
        if(!$order) throw new CHttpException(404);

        if (!$order->orderRating)
        {
            $order->orderRating=new OrdersRating();
        }

        if ($order->orderRating->allowEdit() && !$order->allowEdit())
        {
            if (isset($_POST['OrdersRating']) && $order->orderRating->allowEdit())
            {
                $order->orderRating->attributes=$_POST['OrdersRating'];
                if ($order->orderRating->validate())
                {
                    $order->orderRating->user_id=$order->user_id;
                    $order->orderRating->order_id=$order->id;
                    $order->orderRating->save();

                    Yii::app()->user->setFlash('alert-swal', array(
                        'header' => 'Отзыв сохранен',
                        'content' => 'Нам важно Ваше мнение.',
                    ));

                    $this->refresh();
                }
            }

            $this->render('order_rating_edit',array('order'=>$order));
        }
        else
        {
            $this->render('order_rating',array('order'=>$order));
        }
    }

    public function actionAskAnswer()
    {
        $this->render('ask_answer');
    }

    public function actionSupport()
    {
        $room=Rooms::getClientRoom(Yii::app()->user->id);
        if (!$room)
        {

        }

        $messages=RoomMessages::getMessagesFromRoom($room->id);

        $this->render('support',array('room'=>$room));
    }


    public function actionSettings()
    {
        $user = Yii::app()->user->getUser();
        $user_info = UserInfo::getForUser($user->id);

        $this->render('settings',array('user_info'=>$user_info,'user'=>$user));
    }

    public function actionSettingsEdit()
    {
        $user = Yii::app()->user->getUser();
        $user_info = UserInfo::getForUser($user->id);

        if (isset($_POST['UserInfo']))
        {
            $user_info->attributes=$_POST['UserInfo'];
            if ($user_info->validate())
            {
                if ($user_info->isNewRecord)
                {
                    $user_info->user_id=$user->id;
                }

                $user->scenario = 'update_avatar';
                $user->attributes = isset($_POST['Users']) ? $_POST['Users'] : array();
                $user->save();

                $user_info->save();

                Yii::app()->user->setFlash('alert-swal', array(
                    'header' => 'Ваши данные сохранены',
                    'content' => '',
                ));
                $this->refresh();
            }
        }

        $this->render('settings_edit',array('user_info'=>$user_info,'user'=>$user));
    }

    public function getLeftMenu()
    {
        return array(
            array('text'=>CHtml::link('Личные данные',array('profile/index'),array('class'=>(strpos($this->action->id,'index')!==false ? 'active': '')))),
//            array('text'=>CHtml::link('Шаблоны заказа',array('profile/templateOrders'),array('class'=>($this->action->id == 'templateOrders' ? 'active': '')))),
//            array('text'=>CHtml::link('Система скидок',array('profile/discount'),array('class'=>($this->action->id == 'discount' ? 'active': '')))),
//            array('text'=>CHtml::link('Вопрос-Ответ',array('profile/askAnswer'),array('class'=>($this->action->id == 'askanswer' ? 'active': '')))),
//            array('text'=>CHtml::link('Техподдержка',array('profile/support'),array('class'=>($this->action->id == 'support' ? 'active': '')))),
            array('text'=>CHtml::link('Избранное',array('profile/favorite'),array('class'=>(strpos($this->action->id,'favorite')!==false ? 'active': '')))),
            array('text'=>'<div class="hitarea" data-toggle="collapse" data-target="#settings_submenu" '.(in_array($this->action->id,array('addresses','address','settings','paymentsSystem','notification','changeemail','changepassword')) ? 'active="active"': '').'>Настройки<span class="fa fa-caret-up"></span></div>',
                'children'=>array(
                    array('text'=>CHtml::link('Профиль',array('profile/settings'),array('class'=>(in_array($this->action->id,array('settings','settingsedit')) ? 'active': '')))),
//                    array('text'=>CHtml::link('Адреса доставки',array('profile/addresses'),array('class'=>(in_array($this->action->id,array('addresses','address')) ? 'active': '')))),
                    array('text'=>CHtml::link('Изменить E-mail',array('profile/changeemail'),array('class'=>($this->action->id == 'changeemail' ? 'active': '')))),
                    array('text'=>CHtml::link('Изменить пароль',array('profile/changepassword'),array('class'=>($this->action->id == 'changepassword' ? 'active': '')))),
//                    array('text'=>CHtml::link('Платежные системы',array('profile/paymentsSystem'),array('class'=>($this->action->id == 'paymentsSystem' ? 'active': '')))),
//                    array('text'=>CHtml::link('Уведомления',array('profile/notification'),array('class'=>($this->action->id == 'notification' ? 'active': '')))),
                )
            ),
        );
    }

    public function actionAddresses()
    {
        $address=Address::getUserAddress(Yii::app()->user->id);
        $this->render('address',array('address'=>$address));
    }

    public function actionAddress()
    {
        $model=new Address();

        if (isset($_GET['id']))
        {
            $model=$model::getAddressForUser($_GET['id'],Yii::app()->user->id);
            if (!$model)
            {
                throw new CHttpException(404);
            }
        }

        if (isset($_POST['Address']))
        {
            $model->attributes=$_POST['Address'];
            if ($model->validate())
            {
                $redirect=false;
                $message='Адрес сохранен';

                if ($model->isNewRecord)
                {
                    $model->user_id=Yii::app()->user->id;
                    $redirect=true;
                    $message='Адрес добавлен';
                }

                if (!$model->city)
                {
                    $model->addError('city_id','Не корректный населенный пункт');
                }

                if (!$model->hasErrors() && $model->save(false))
                {

                    Yii::app()->user->setFlash('alert-swal', array(
                        'header' => $message,
                        'content' => '',
                    ));
                    if ($redirect)
                    {
                        $this->redirect(array('addresses'));
                    }
                    else
                    {
                        $this->refresh();
                    }
                }
            }
        }
        $this->render('address_save',array('model'=>$model));
    }

    public function actionDeleteAddress($id)
    {
        $model = Address::getAddressForUser($id,Yii::app()->user->id);
        if (!$model)throw new CHttpException(404);

        $model->delete();
    }

    public function actionSetDefaultAddress($id)
    {
        $model = Address::getAddressForUser($id,Yii::app()->user->id);
        if (!$model)throw new CHttpException(404);

        $model->default = Address::ADDRESS_DEFAULT;
        $model ->save();
    }

    public function actionChangePassword()
    {
        $model = Users::model()->findByPk(Yii::app()->user->id);
        $model->scenario = 'change_password';
        if (isset($_POST['Users']))
        {
            $model->attributes = $_POST['Users'];
            if ($model->validate())
            {
                $model->password = $model->new_password;
                $model->save();

                Yii::app()->user->setFlash('alert-swal', array(
                    'header' => 'Пароль успешно изменен',
                    'content' => ''
                ));
                $this->refresh();
            }
        }
        $this->render('//user/change_password',array('model'=>$model));
    }

    public function actionChangeEmail()
    {
        $model=Users::model()->findByPk(Yii::app()->user->id);
        $model->scenario='change_email';
        $model->new_email=$model->email;
        if (isset($_POST['Users']))
        {
            $model->attributes=$_POST['Users'];
            if ($model->validate())
            {
                $model->scenario='update';
                $model->email=$model->new_email;

                $model->save(true,array('email'));

                Yii::app()->user->login = $model->email;

                Yii::app()->user->setFlash('alert-swal', array(
                    'header' => 'Email успешно изменен',
                    'content' => ''
                ));
                $this->refresh();
            }
        }
        $this->render('//user/change_email',array('model'=>$model));
    }
}
?>
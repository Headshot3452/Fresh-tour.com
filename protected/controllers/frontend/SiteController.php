<?php
class SiteController extends FrontendController
{
    public $currency_byn;
    public $currency_eur;
    public $currency_usd;

    public function init()
    {
        parent::init();
        if(isset(Yii::app()->request->cookies['sort_products']))
        {
            unset(Yii::app()->request->cookies['sort_products']);
        }
        if(isset(Yii::app()->request->cookies['count_item']))
        {
            unset(Yii::app()->request->cookies['count_item']);
        }

        $this->currency_byn = SettingsCurrency::model()->findByAttributes(array('currency_name' => 'BYN'));
        $this->currency_eur = SettingsCurrency::model()->findByAttributes(array('currency_name' => 'EUR'));
        $this->currency_usd = SettingsCurrency::model()->findByAttributes(array('currency_name' => 'USD'));
    }

    public function actionIndex()
    {
        $this->getPage($this->getHomeId());

        if(isset($_POST['BronForm']))
        {
            $bron = new BronForm();
            $bron->attributes = $_POST['BronForm'];

            if($bron->validate())
            {
                Yii::app()->user->setFlash('modalReview', array('header' => 'Забронировано', 'content' => 'Ожидайте подтверждения брони.'));

                $bodyEmail = $this->renderEmail('bron', array('model' => $bron));
                $mail=Yii::app()->mailer->isHtml(true)->setFrom($bron->email);
                $mail->send($this->settings->email_order, 'Раннее бронирование', $bodyEmail);

                $this->refresh();
            }
        }

        $root = CatalogTree::model()->language($this->getCurrentLanguage()->id)->roots()->active()->findByPk(Yii::app()->params['strany_catalog']);
        $categories = $root->children()->active()->findAll();

        $_list_fresh = CHtml::listData($categories, 'id', 'id');

        $list_fresh = implode(',', $_list_fresh);

        $tem_tours = CatalogProducts::model()->active()->findAll(
            array(
                'condition' => 'parent_id = :parent',
                'params' => array('parent' => Yii::app()->params['tema_catalog']),
                'limit' => '5',
                'order' => 'sort'
            )
        );

        if($tem_tours)
        {
            foreach($tem_tours as $value)
            {
                $tem_products[$value->name] = CatalogProducts::model()->with('parameters_value')->active()->findAll(
                    array(
                        'condition' => 'parameters_value.value = :value',
                        'params' => array('value' => $value->title),
                        'together' => true,
                        'limit' => '6',
                        'order' => 't.sort'
                    )
                );
            }
        }

        $fresh = CatalogProducts::model()->active()->findAll(array('condition' => 'parent_id IN ('.$list_fresh.') AND new = 1', 'order' => 'parent_id'));

        $this->render('index', array('categories' => $categories, 'fresh' => $fresh, 'tem_tours' => $tem_tours, 'tem_products' => $tem_products));
    }

    public function actionContacts()
    {
        $this->setPageForUrl('kontakty');

        $model = new ContactsForm('contacts');

        if (isset($_POST['type']))
        {
            switch($_POST['type'])
            {
                case 'phone': $model->setScenario('phone'); break;
            }
        }

        if(isset($_POST['ajax']) && $_POST['ajax']==='contacts-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['ContactsForm']))
        {
            $model->attributes = $_POST['ContactsForm'];
            if ($model->validate())
            {
                $bodyEmail=$this->renderEmail('contacts', array('model' => $model));
                $mail=Yii::app()->mailer->isHtml(true)->setFrom($model->email);
                $mail->send($this->settings->email_callback, 'Обратная связь', $bodyEmail);
                Yii::app()->user->setFlash('modalReview', array('header' => 'Письмо отправлено', 'content' => 'Ваше письмо отправлено. Вы получите ответ в ближайшее время.'));

                echo CJSON::encode(
                    array(
                        'status' => 'success'
                    )
                );
                Yii::app()->end();
            }
            else
            {
                $error = CActiveForm::validate($model);
                if($error!='[]')
                    echo $error;

                Yii::app()->end();
            }
        }

        $this->render('contacts',array('model'=>$model));
    }

    public function actionSearch($search)
    {
        $this->setPageForUrl('poisk');
        $this->setPageTitle("Результаты поиска");

        $this->breadcrumbs[] = $this->pageTitle;
        $this->setPageTitle($this->pageTitle);

        $words = explode(' ', $search);

        $criteria = new CDbCriteria;

        if (!empty($words))
        {
            $count = count($words);
            for ($i = 0; $i < $count; $i++)
            {
                $criteria->addSearchCondition('title', $words[$i]);
            }
        }

        $criteria->scopes = array(
            'language' => array($this->getCurrentLanguage()->id),
            'active',
        );

        $criteria->compare('parent_id', '<>'.Yii::app()->params['vizy_catalog']);

        $model = new CatalogProducts();

        $products = new CActiveDataProvider($model,
            array(
                'criteria' => $criteria,
                'pagination' => array(),
            )
        );

        $this->render('search', array('dataProducts'=>$products));
    }

	public function actionPage($url)
    {
        $this->layout = 'frontend_two_columns';

		$this->setPageForUrl($url);

        if($this->page_id == Yii::app()->params['pages']['o-kompanii'])
        {
            $url = $this->getUrlById(Yii::app()->params['pages']['nash-ofis']);
            $this->redirect('/'.$url);
        }
        elseif($this->page_id == Yii::app()->params['pages']['informaciya'])
        {
            $url = $this->getUrlById(Yii::app()->params['pages']['sposoby-oplaty']);
            $this->redirect('/'.$url);
        }
        elseif($this->page_id == Yii::app()->params['pages']['srochno'])
        {
            $url = $this->getUrlById(Yii::app()->params['pages']['hot-tour']);
            $this->redirect('/'.$url);
        }
        elseif($this->page_id == Yii::app()->params['pages']['tours_and_vizy'])
        {
            $url = $this->getUrlById(Yii::app()->params['pages']['poisk_tours']);
            $this->redirect('/'.$url);
        }

        if(isset($_POST['BronForm']))
        {
            $bron = new BronForm();
            $bron->attributes = $_POST['BronForm'];

            if($bron->validate())
            {
                Yii::app()->user->setFlash('modalReview', array('header' => 'Забронировано', 'content' => 'Ожидайте подтверждения брони.'));

                $bodyEmail = $this->renderEmail('bron', array('model' => $bron));
                $mail=Yii::app()->mailer->isHtml(true)->setFrom($bron->email);
                $mail->send($this->settings->email_order, 'Раннее бронирование', $bodyEmail);

                $this->refresh();
            }
        }

        $this->render('page', array());
    }

    public function actionError()
    {
        $this->render('error',array());
    }

    public function actions()
    {
        return array_merge(
            parent::actions(),
            array(
                'cart'=>array(
                    'class'=>'application.actions.frontend.CartAction',
                ),
            )
        );
    }
}
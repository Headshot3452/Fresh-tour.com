<?php
class SliderController extends ModuleController
{
    public $layout_in = 'backend_left_tree';

	public function init()
    {
        parent::init();

        $this->addButtonsLeftMenu('create', array(
                'url'=>$this->createUrl('index')
            )
        );
    }

    public static function getModuleName()
    {
        return Yii::t('app','Slider');
    }

    public function actions()
    {
        return array(
            'index'=>array(
                'class'=>'actionsBackend.UpdateAction',
                'scenario'=>'insert',
                'Model'=>'Slider',
                'View'=>'slider'
            ),
            'delete-slider'=>array(
                            'class'=>'actionsBackend.DeleteAction',
                            'Model'=>'Slider'
                    ),
            'update-slider'=>array(
                            'class'=>'actionsBackend.UpdateAction',
                            'scenario'=>'update',
                            'Model'=>'Slider',
                            'View'=>'slider'
                    ),
            'delete-slider-image'=>array(
                            'class'=>'actionsBackend.DeleteAction',
                            'Model'=>'SliderImages'
                    ),
            'upload'=>array('class'=>'actionsBackend.UploadAction'),
            'settings'=>array('class'=>'actionsBackend.SettingsAction')
        );
    }

    public function actionSliderImage()
    {
        if(isset($_GET['id']))
        {
            $model = SliderImages::model()->findByPk($_GET['id']);
            if(!$model) throw new CHttpException('404');
        }
        else
        {
            if(!isset($_GET['parent_id'])) throw new CHttpException('404');
            $model=new SliderImages;
            $model->slider_id = $_GET['parent_id'];
        }

        if(isset($_POST['SliderImages']))
        {
            $model->attributes=$_POST['SliderImages'];
            if($model->save())
            {
                $this->redirect($this->createUrl('sliderImage',array('id'=>$model->id)));
            }
        }

        $this->render('sliderImage',array('model'=>$model));
    }


    public function getLeftMenu()
    {
        $sliders = Slider::getAllForMenu($this->getCurrentLanguage()->id);
        $data = array();
        foreach($sliders as $s)
        {
            $data[$s->id] = array('text'=>$s->title,'children'=>  CHtml::listData(SliderImages::getItemsBySliderId($s->id), 'id', 'title'));
        }

        return $this->getTreeDataMenu($data, 'update-slider', 'delete-slider', 'sliderimage', 'delete-slider-image');

    }
}
?>
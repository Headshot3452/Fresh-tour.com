<?php

class FeedbackUpdateAction extends BackendAction
{
    public function run($id)
    {
        $model = $this->getModel();

        $this->controller->layout_in='backend_one_block';

        if(isset($_POST['Feedback']))
        {
            $model->attributes = $_POST['Feedback'];
            if($model->save())
            {
                Yii::app()->user->setFlash('modal', Yii::t('app','Product has been saved'));
                $this->redirect($this->controller->createUrl('update').'?id='.$id);
            }
        }

        if(isset($_GET['file'])){
            Yii::app()->request->sendFile($_GET['name'], file_get_contents(Yii::getPathOfAlias('webroot').'/data/file/'.$_GET['file']));
        }

        $this->controller->pageTitleBlock=BackendHelper::htmlTitleBlockDefault(CHtml::link(CHtml::image('/images/icon-admin/feedback.png'), '/admin/feedback').'Вопрос № '.$model->id.' <span>'.date("d.m.y", $model->time).' в '.date("h:m", $model->time).'</span>','/admin/feedback');
        $this->controller->pageTitleBlock.=$this->renderPartial('_status', array('model'=>$model), true);

        $this->render(array('model'=>$model));
    }
}
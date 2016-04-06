<?php
class TagsController extends BackendController
{
    public function filter()
    {

    }

    public function actionSearch($term)
    {
       $tags=Tags::searchTags($term,$this->getCurrentLanguage()->id);
       $result=CHtml::listData($tags,'id','title');
       echo CJSON::encode($result);
    }
}
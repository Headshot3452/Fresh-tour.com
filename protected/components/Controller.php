<?php
class Controller extends CController
{
    public $main_menu=array();
    public $pageTitles = array();

    protected  $_languages = array();
    protected $_language = null;

    public function init()
    {
        parent::init();
        if (Yii::app()->request->getIsAjaxRequest())
        {
            $this->layout='clear';
            CHtml::$liveEvents = FALSE;
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.yiiactiveform.js'] = false;
        }
    }


    public function setTitle($action)
    {
        if(isset($this->pageTitles[$action->id]))
        {
            $this->setPageTitle($this->pageTitles[$action->id]);
        }
    }

    protected function beforeAction($action)
    {
        if(!parent::beforeAction($action))
        {
            return false;
        }

        $this->setTitle($action);

        $this->setLanguage(); // init application language

        return true;
    }

    public function getLanguages()
    {
        if(!$this->_languages)
        {
            $this->_languages = Language::model()->findAll();
        }
        return $this->_languages;
    }

    /**
     * Возвращает информацию по языку который в базе
     * @return CActiveRecord|null
     * @throws CHttpException
     */
    public function getCurrentLanguage()
    {
        if($this->_language === null)
        {
            $this->_language = Language::getLanguageByCode(Yii::app()->language);

            if(!$this->_language)
                throw new CHttpException(404,'Language not found');
        }
        return $this->_language;
    }


    /**
     * Устанавливаем язык приложения для пользоватедя
     * @param $code
     * @return CActiveRecord
     * @throws CHttpException
     */
    public function setCurrentLanguage($code)
    {
        $language = Language::getLanguageByCode($code);

        if(!$language)
            throw new CHttpException(404,'Language not found');

        $this->_language = $language;

        return $this->_language;
    }

    public function setLanguage()
    {
        return true;
    }

    /**
     * Render email
     * @param $view
     * @param $data
     * @return string
     */
    public function renderEmail($view,$data=array())
    {
        if (!empty($view))
        {
            $file = $this->resolveViewFile('email.'.$view,'','');
            return $this->renderInternal($file,$data,true);
        }
    }

    public function getCountryFromAPI()
    {
        $lang = 0; // russian

        $headerOptions = array(
            'http' => array(
                'method' => "GET",
                'header' => "Accept-language: en\r\n" .
                "Cookie: remixlang=$lang\r\n"
            )
        );

        $methodUrl = 'http://api.vk.com/method/database.getCountries?v=5.5&need_all=1&count=1000';
        $streamContext = stream_context_create($headerOptions);
        $json = file_get_contents($methodUrl, false, $streamContext);
        $arr = json_decode($json, true);

        return(CHtml::listData($arr['response']['items'], 'title', 'title'));
    }
}
?>
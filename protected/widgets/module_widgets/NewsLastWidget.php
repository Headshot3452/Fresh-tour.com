<?php
class NewsLastWidget extends StructureWidget
{
    public $view = 'last_news';
    public $count;
    public $dateFormat = 'd.m.Y';
    protected $_items = array();
    public $parent_id = '';


    public function setData()
    {
        $this->_items = News::getLastNews($this->count, $this->owner->getCurrentLanguage()->id, $this->parent_id);
        if (empty($this->_items))
        {
            return false;
        }
        return true;
    }

    public function renderContent()
    {
        $this->render(get_class().'/'.$this->view);
    }
}
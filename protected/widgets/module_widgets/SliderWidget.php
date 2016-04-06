<?php
class SliderWidget extends StructureWidget
{
    public $size='medium';
    public $height='400px';
    public $slider_id;
    protected $_items=array();

    public function setData()
    {
        $this->_items=SliderImages::getItemsBySliderId($this->slider_id);

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
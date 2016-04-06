<?php

Yii::import('bootstrap.widgets.BsPager');

class PagerWidget extends BsPager
{
    protected function createPageLinks()
    {
        $links=parent::createPageLinks();

        if ($this->getPageCount()-ceil($this->maxButtonCount/2)>$this->getCurrentPage())
        {
            $pop=array_pop($links);
            $links[]= $this->createPageLink('...', 0, true, false);
            $links[]= $this->createPageLink($this->getPageCount(), $this->getPageCount(), false, false);
            $links[]= $pop;
        }

        return $links;
    }
}
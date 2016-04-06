<?php
    Yii::import('bootstrap.widgets.BsListView');

    class ProductListViewAdmin extends BsListView
    {
        public $typeCatalog = 'small';
        public $counter = 10;

        public function renderMainItems()
        {
            echo CHtml::openTag($this->itemsTagName,array('class' => $this->itemsCssClass))."\n";
            $data = $this->dataProvider->getData();
            if(($n = count($data)) > 0)
            {
                $temp_title = '';
                $owner=$this->getOwner();
                $viewFile = $owner->getViewFile($this->itemView);
                $j = 0;
                $folder_count = 0;
                $old_item = null; //предидущее значение data
                $temp_date = null; //
                foreach($data as $i => $item)
                {
                    $data = $this->viewData;
                    $data['index'] = $i;
                    $data['data'] = $item;
                    $data['widget'] = $this;

                    if (isset($item->parent) && isset($item->parent->title) && $temp_title != $item->parent->title)
                    {
                        $temp_title = $item->parent->title;
                        $folder_count++;
                        $title = CHtml::tag('span', array('class' => 'icon-admin-folder-gray'), $folder_count);
                        $title .= CHtml::tag('span', array('class' => 'parent'), $temp_title);
                        if($folder_count == 0)
                        {
                            echo CHtml::openTag('ul');
                        }
                        else
                        {
                            echo CHtml::closeTag('ul');
                            echo CHtml::openTag('ul');
                        }
                        echo CHtml::tag('div', array('class' => 'title_parent'), $title);
                    }

                    $owner->renderFile($viewFile, $data);

                    $old_item = $item;
                    if(isset($old_item->create_time))
                    {
                        $old_item->create_time = $temp_date;
                    }

                    if($j++ < $n - 1)
                    {
                        echo $this->separator;
                    }
                }
                echo CHtml::closeTag('ul');
            }
            else
            {
                $this->renderEmptyText();
            }

            echo CHtml::closeTag($this->itemsTagName);

            $cs = Yii::app()->getClientScript();
            $button_show = '
                $(".items ul").each(function()
                {
                    var title = $(this).find(".parent").text();
                    var count = $(this).find("li").length;

                    $(this).find(".parent").text(title+" ("+count+")");
                });

                $(".btn-group.checkbox .checkbox-action").on("click",function()
                {
                    if($(this).hasClass("checked-all") || $(this).hasClass("checked-single"))
                    {
                        $(".copy_products").hide();
                        $(".move_products").hide();
                        $(".status label").removeClass("active");
                    }
                    else
                    {
                       $(".copy_products").show();
                       $(".move_products").show();
                       $(".status label").addClass("active");
                    }
                });

                $(".status label").on("click", function()
                {
                    if(!$(this).hasClass("active"))
                    {
                        $(this).addClass("active");
                    }
                    else
                    {
                        $(this).removeClass("active");
                    }

                    if($(".status label").hasClass("active"))
                    {
                        $(".copy_products").show();
                        $(".move_products").show();
                    }
                    else
                    {
                        $(".copy_products").hide();
                        $(".move_products").hide();
                    }
                })
            ;';

            $cs->registerScript("button_show",$button_show);
        }

        public function renderMainSorter()
        {
            $count=$this->dataProvider->getItemCount();
            if ($count>0)
            {
                $cs=Yii::app()->getClientScript();
                $sorter='
                        $("body").on("change","#sort-main",function()
                        {
                            $.cookie("sort_products",$(this).val(),{expires: 3600, path: "/"});
                            window.location.reload();
                        });
                    ';
                $cs->registerPackage("cookie")->registerScript('sorter',$sorter);

                echo 'Сортировать: '.CHtml::dropDownList('sort-main',$this->sorter,array('price_asc'=>'Сначало дешевые','price_desc'=>'Сначало дорогие','title_asc'=>'А-Я','title_desc'=>'Я-А'),array('prompt'=>'---'));;
            }
        }

        public function renderCounter()
        {
            $count = $this->dataProvider->getItemCount();
            if ($count > 0)
            {
                $cs = Yii::app()->getClientScript();
                $counter = '
                    $("body").on("change", "#count-main", function()
                    {
                        $.cookie("count", $(this).val(), {expires: 3600, path: "/"});
                        window.location.reload();
                    });
                ';
                $cs->registerPackage("cookie")->registerScript('counter', $counter);

                echo CHtml::dropDownList('count-main', $this->counter, array('10' => '10', '20' => '20', '40' => '40', '50' => '50'), array('class' => 'product_for_page'));
            }
        }

        public function renderCounterUsers()
        {
            Yii::app()->clientScript->registerPackage('boot-select');
            $count = $this->dataProvider->getItemCount();
            if ($count > 0) {
                $cs = Yii::app()->getClientScript();
                $counter = '
                    $(".selectpicker").selectpicker();

                    $("body").on("change","#count-main",function()
                    {
                        $.cookie("count",$(this).val(),{expires: 3600, path: "/"});
                        window.location.reload();
                    });
                ';
                $cs->registerPackage("cookie")->registerScript('counter', $counter);

                echo CHtml::dropDownList('count-main', $this->counter, array('20' => '20', '50' => '50', '100' => '100', '200' => '200'), array('class' => 'product_for_page selectpicker'));
            }
        }
        public function renderCounterGallery()
        {
            Yii::app()->clientScript->registerPackage('boot-select');
            $count = $this->dataProvider->getItemCount();
            if ($count > 0) {
                $cs = Yii::app()->getClientScript();
                $counter = '
                    $(".selectpicker").selectpicker();

                    $("body").on("change","#count-main",function()
                    {
                        $.cookie("countGallery",$(this).val(),{expires: 3600, path: "/"});
                        window.location.reload();
                    });
                ';
                $cs->registerPackage("cookie")->registerScript('counterGallery', $counter);

                echo CHtml::dropDownList('count-main', $this->counter, array('20' => '20', '50' => '50', '100' => '100', '200' => '200'), array('class' => 'product_for_page selectpicker'));
            }
        }
    }

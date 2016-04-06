<?php
    class NestedSetHelper
    {
        /**
         * @param $categories
         * @param $attribute
         * @param string $url
         * @param null $active_id
         * @param bool $tree_links
         * @param bool $expanded
         * @return array
         */

        public static function nestedToTreeView($categories, $attribute, $url='#', $active_id = null, $tree_links = true, $expanded = false)
        {
            $result = array();
            $stack = array();
            $urls = array();

            foreach ($categories as $key=>$category)
            {
                if ($active_id !== null && $category['id'] == $active_id)
                {
                    $expanded_item = true;
                }
                else
                {
                    $expanded_item = $expanded;
                }

                $item = array('id' => $category['id'],
                    'text' => '',
                    'expanded' => $expanded_item,
                    'level' => $category['level'],
                    'children' => array());

                $urls[$category['level']-1] = $category[$attribute];//меняем урл текущего уровня
                array_splice($urls, $category['level']);//удаляем все урлы после, на случай, если перешли на новую ветку меньшего уровня

                if ($tree_links === false && isset($categories[$key+1]) && $categories[$key+1]['level'] > $category['level'])
                {
                    $item['text'] .= '<div class="hitarea">'.$category['title'].'</div>';
                }
                else
                {
                    $item['text'].= '<a href="'.$url.implode('/',$urls).'">'.$category['title'].'</a>';
                }

                self::treeTraversal($stack,$result,$item);
            }

            return $result;
        }

        /**
         * @param $categories
         * @param string $attribute
         * @param array $options
         * @param null $active_id
         * @param bool $expanded
         * @return array
         */

        public static function nestedToTreeViewWithOptions($categories,$attribute='id',$options=array(),$active_id=null,$expanded=false)
        {
            $result = array();
            $stack = array();
            $class = '';

            foreach ($categories as $category)
            {
                if ($active_id!==null && $category['id']==$active_id)
                {
                    $expanded_item=true;
                }
                else
                {
                    $expanded_item=$expanded;
                }

                $item = array('id'=>$category['id'],
                              'text'=>'',
                              'expanded'=>$expanded_item,
                              'level'=>$category['level'],
                              'children'=>array());

                foreach($options as $option)
                {
                    if (isset($option['icon']))
                    {
                        $item['text'].='<a href="'.$category['icon']['url'].'"><div class="icon '.$category['icon']['class'].'"></div></a>';
                    }
                    if (isset($option['catalog_icon']))
                    {
                        $item['text'].='<a href="'.$category['catalog_icon']['url'].'"><div class="icon '.$category['catalog_icon']['class'].'"></div></a>';
                    }
                    if (isset($option['params']))
                    {
                        $params=$option['params'];
                    }
                    else
                    {
                        $params='id';
                    }
                    if (isset($option['url']))
                    {
                        $url=$option['url'];
                    }
                    else
                    {
                        $url='#';
                    }
                    if (isset($option['class']))
                    {
                        $class=$option['class'].$category['status'];
                    }
    //              Добавил data-id. Нужно для отправки формы копированиея файлом и перемещения
    //              (чтобы было видно в какую категорию переносим)
                    if ($option['title']=='title')
                    {
                        $class_active = ( $category['id'] == $active_id ) ? "active": "";
                        $item['text'].='<a class="'.$class_active.' '.$class.'" href="'.$url.$category[$attribute].'" data-id="'.$category[$attribute].'">'.$category['title'].'</a>';
                    }
                    else
                    {
                        //костыль Дополнительные кнопки(удалить и т.д. скрыть)
                        if (is_object($category) && ($category->isRoot() || ($category->hasAttribute('system') && $category->system==1)))
                        {
                            break;
                        }
                        if ($url!='#')
                        {
                            $item['text'].='<a href="'.$url.$category[$attribute].'" >'.$option['title'].'</a>';
                        }
                        else
                        {
                            $item['text'].=$option['title'];
                        }
                    }
                }

                self::treeTraversal($stack,$result,$item);
            }
            return $result;
        }

        /**
         * @param $categories - дерево
         * @param string $attribute - аттрибут указывающий на url в записи
         * @param int $level - указывает на уровеь начало дерева
         * @return array
         */
        public static function nestedToTree($categories,$attribute='name',$level=1)
        {
            $result = array();
            $stack = array();
            $urls = array();

            foreach ($categories as $category)
            {
                $urls[$category['level']-$level] = $category[$attribute];//меняем урл текущего уровня
                array_splice($urls,$category['level']-($level-1));//удаляем все урлы после, на случай, если перешли на новую ветку меньшего уровня

                $item = array(
                    'item'=>$category,
                    'url'=>implode('/',$urls),
                    'level'=>$category['level'],
                    'children'=>array()
                );

                self::treeTraversal($stack,$result,$item);
            }
            return $result;
        }

        public static function treeTraversal(&$stack,&$result,$item)
        {
            $level=count($stack);
            while ($level>0 && $stack[$level-1]['level']>=$item['level'])
            {
                array_pop($stack);
                $level--;
            }
            if ($level==0)
            {
                $i=count($result);
                $result[$i]=$item;
                $stack[]=&$result[$i];
            }
            else
            {
                if (isset($item['expanded']) && $item['expanded']==true)
                {
                    $temp_level=$level-1;
                    while($temp_level>0)
                    {
                        $stack[$temp_level-1]['expanded']=true;
                        $temp_level--;
                    }
                    $stack[$level-1]['expanded']=true;
                }

                $i=count($stack[$level-1]['children']);
                $stack[$level-1]['children'][$i]=$item;
                $stack[]=&$stack[$level-1]['children'][$i];
            }
        }


        /**
         * @param $category
         */
        public static function nestedSetChildrenStatus($category)
        {
            if (!$category->isLeaf())
            {
                $children=$category->descendants()->notDeleted()->findAll();
                foreach ($children as $child)
                {
                    $child->status=$category->status;
                    $child->saveNode(false);
                }
            }
        }
    }
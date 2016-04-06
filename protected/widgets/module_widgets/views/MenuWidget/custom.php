<?php
    $count = count($this->_items);

//echo '<pre>';
//var_dump($this->_items);
//echo '</pre>';

    for ($i = 0; $i < $count; $i++)
    {
        if (isset($this->_items[$i]))
        {
//            if($this->_items[$i]['children'] && $this->_items[$i]['level'] == 2)
//            {
//                $attributes = 'class = "dropdown dropdown-toggle" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false"';
//
//                echo
//                    '<li '.(($this->_items[$i]['active']) ? 'class="active dropdown"' : 'class="dropdown"').'>
//                        <a '.$attributes.' href="'.$this->_items[$i]['url'].'">
//                            '.$this->_items[$i]['label'].'
//                        </a>
//                        <ul class = "dropdown-menu">';
//            }
//            elseif($this->_items[$i]['level'] == 3)
//            {
//                echo '<li><a href="'.$this->_items[$i]['url'].'">'.$this->_items[$i]['label'].'</a></li>';
//                if($i+1 == $count || !isset($this->_items[$i+1]) || $this->_items[$i+1]['level'] == 2)
//                {
//                    echo '</ul></li>';
//                }
//            }
//            else
//            {

//            }
            if(isset($this->_items[$i]['items'][0]))
            {
                echo
                    '<li class="'.(($this->_items[$i]['active']) ? 'active dropdown' : 'dropdown').'">
                        <a class = "dropdown dropdown-toggle" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" href="'.$this->_items[$i]['url'].'">'.$this->_items[$i]['label'].'</a>
                        <ul class = "dropdown-menu">';

                            foreach($this->_items[$i]['items'] as $value)
                            {
                                echo '<li><a href="'.$value['url'].'">'.$value['label'].'</a></li>';
                            }
                echo
                        '</ul>
                    </li>';
            }
            else
            {
                echo '<li '.(($this->_items[$i]['active']) ? 'class="active"' : '').'><a href="'.$this->_items[$i]['url'].'">'.$this->_items[$i]['label'].'</a></li>';
            }
        }
    }
?>

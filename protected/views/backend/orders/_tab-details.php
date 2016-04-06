<?php

if ($order->status < Orders::STATUS_STAFFED)
{
    $this->renderPartial('_edit_order',array('order'=>$order,'products'=>$products));
}
else
{
    $this->renderPartial('_view_order',array('order'=>$order,'products'=>$products));
}
?>
<?php
$this->renderPartial('_print_order',array('order'=>$order,'products'=>$products));
?>

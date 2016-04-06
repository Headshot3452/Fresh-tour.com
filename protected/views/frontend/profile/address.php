<div class="main-title">Адреса доставки</div>
<div class="address-list">
    <?php
        Yii::app()->getClientScript()->registerScript('addressdelete',
            '
                $(document).ready(function(){

                    $(".address-edit-block .delete").click(function(){
                        if(confirm("Вы уверены, что хотите удалить адрес?"))
                        {
                            var id = $(this).data("id");
                            $.ajax({
                               type: "POST",
                               url: "'.$this->createUrl('deleteAddress').'?id="+id,
                               success: function(msg){
                                 window.location.reload();
                               }
                            });
                        }
                        return false;
                    });

                    $("input#Address_default").change(function(){
                         var id = $(this).data("id");
                            $.ajax({
                               type: "POST",
                               url: "'.$this->createUrl('setDefaultAddress').'?id="+id,
                            });
                    });
                });
            '
        );

        $i=1;
        foreach($address as $item)
        {
                echo '<div class="address-block">
                        <div class="row address-edit-block">
                            <div class="col-xs-2">
                                Адрес '.$i.'
                            </div>

                            <div class="col-xs-3">
                                '.CHtml::activeRadioButton($item,'default',array('data-id'=>$item->id)),' Адрес по умолчанию'.'
                            </div>

                            <div class="col-xs-3">
                                '.CHtml::link('<span class="fa fa-edit"></span> Редактировать',$this->createUrl('address',array('id'=>$item->id)),array('class'=>'edit')).'
                            </div>

                            <div class="col-xs-2">
                                '.CHtml::link('<span class="fa fa-trash"></span> Удалить','#',array('class'=>'delete','data-id'=>$item->id)).'
                            </div>
                        </div>';
                        $this->renderPartial('_address_item',array('data'=>$item));
                        $i++;
                    echo '</div>';
        }
    ?>

    <?php echo CHtml::link('<span class="fa fa-plus-circle"></span> Добавить адрес доставки',$this->createUrl('address'),array('class'=>'edit')); ?>
</div>
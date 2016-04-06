<div class="row">
    <div class="main-title"><?php echo $this->getPageTitle(); ?></div>
    <div class="text">
        <?php
        echo $content;

        $cs=Yii::app()->getClientScript();

        $cart_back='$("body").on("click","input[name=back]",
            function()
            {
                  $(this).closest("form").yiiactiveform();
                  $(this).closest("form").submit();
            }
        )';
        $cs->registerScript('cart_back',$cart_back);
        ?>
    </div>
</div>
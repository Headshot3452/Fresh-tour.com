<div class="container home-menu-block">
    <div class="col-xs-4 logo no-left">
        <a href="<?php echo $this->createUrl('admin/index'); ?>"><img src="/images/logo.png"></a>
    </div>
    <div class="col-xs-8 menu">
        <menu>
<?php
            $this->widget('zii.widgets.CMenu',
                array(
                    'id' => 'home-menu',
                    'items' => $this->getTopMenuItems(),
                )
            );
?>
        </menu>
    </div>
</div>
<div class="main-title-block module-title">
    <div class="container">
        <?php echo $this->pageTitleBlock; ?>
    </div>
</div>
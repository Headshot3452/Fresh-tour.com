<div id="title-container">
	<img src = "/images/title-img.png" alt = "">
	<div class="breadcrumbs-container">
		<div class="container">
			<div class="row">
				<div class="breadcrumbs">
					<?php
					if (!empty($this->breadcrumbs))
					{
						echo '<div>';

						$this->widget('bootstrap.widgets.BsBreadcrumb',
								array(
										'links'=>$this->breadcrumbs,
								)
						);

						echo '</div>';
					}
					?>
				</div>
				<h1><?php echo $this->pageTitle ;?></h1>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="row contakts-page">
	<div class="col-xs-6 no-right">
		<div class="form-contakts">
			<div class="col-xs-8 no-all" style="float: right; padding-right: 30px;">
				<h1 class="">Обратная связь</h1>
				<?php $this->renderPartial('_form_contacts',array('model'=>new ContactsForm('contacts'))) ;?>
			</div>
		</div>

<!--		<div class="text">-->
<!--			--><?php //echo $this->text; ?>
<!--		</div>-->
	</div>
	<div class="col-xs-6 no-left no-right">
		<div class="contakts-green">
			<div class="address">
				<?php echo $this->settings['address'] ;?>
			</div>
			<div class="phones">
				<i>Для частных лиц</i>
				<?php echo $this->velcom[1][0] ;?> <span> <?php echo $this->velcom[2][0] ;?></span>
				<i>Горячая линия</i>
				<?php echo $this->mts[1][0] ;?> <span> <?php echo $this->mts[2][0] ;?></span>
                <i>Городской номер</i>
                <?php echo $this->gorod[1][0] ;?> <span> <?php echo $this->gorod[2][0] ;?></span>
			</div>
			<div class="row"></div>
			<div class="work">
				<?php echo $this->settings['work'] ;?>
			</div>
			<div class="email">
				<?php echo $this->settings['email_order'] ;?>
			</div>
		</div>

<!--		<div class="form-contakts">-->
<!--			<div class="col-xs-7 no-all">-->
<!--				<h1>Обратная связь</h1>-->
<!--				--><?php //$this->renderPartial('_form_contacts',array('model'=>new ContactsForm('contacts'))) ;?>
<!--			</div>-->
<!--		</div>-->
	</div>
	<div class="clearfix"></div>
	[[w:MapWidget|map_id=1;height=465px;]]
</div>
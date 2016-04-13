<div id = "title-container">
	<img src = "/images/title-img.png" alt = "Слайд">
	<div class = "breadcrumbs-container">
		<div class = "container">
			<div class = "row">
				<div class = "breadcrumbs">
					<?php
					if(!empty($this->breadcrumbs))
					{
						echo '<div>';

						$this->widget('bootstrap.widgets.BsBreadcrumb',
							array(
								'links' => $this->breadcrumbs,
							)
						);

						echo '</div>';
					}
					?>
				</div>
				<h1><?php echo $this->pageTitle; ?></h1>
			</div>
		</div>
		<div class = "clearfix"></div>
	</div>
</div>

<div id="search_container">
	<div class="container">
		<div class="row">
<?php
			echo CHtml::beginForm(array('/search'), 'get');
			echo CHtml::textField('search', Yii::app()->request->getQuery('search', ''), array('placeholder' => 'ПОИСК ПО САЙТУ'));
			echo CHtml::linkButton('Искать на сайте', array('class' => 'search-link'));
			echo CHtml::endForm();
?>
		</div>
	</div>
</div>

<div id="main-content">
	<div class="container no-all">
		<div class="row">
<?php
			if(isset($_GET['search']) && $_GET['search'] != '')
			{
				echo '<span class="search_result col-xs-12">Найдено '.$dataProducts->getItemCount().' результатов:</span>';
				$this->widget('application.widgets.ProductListView',
					array(
						'id' => 'products-list',
						'htmlOptions' => array(

						),
						'itemView' => '_search_view',
						'dataProvider' => $dataProducts,
						'ajaxUpdate' => false,
						'template' => "{items}\n",
						'emptyText' => 'Поиск не дал результатов',
						'viewData' => array(

						),
					)
				);
			}
?>
		</div>
	</div>
</div>
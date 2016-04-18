<div id="title-container">
	<img src = "/images/title-img.png" alt = "">
	<div class="breadcrumbs-container">
		<div class="container">
			<div class="row">
				<div class="breadcrumbs">
					<?php
					if (!isset($url))
					{
						$url = '';
					}

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
				<h1><?php echo $this->pageTitle ;?></h1>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div id="main-content">
	<div class="container">
		<div class="row">
			<div id="tyrs">
				<div class="col-xs-3 no-left">
					<ul class="left-title">
						<h2>Срочно!Горит!</h2>
						[[w:MenuWidget|menu_id=33;menu_type=custom;]]
					</ul>
				</div>

				<div class="col-xs-9 no-right">
					<h1> <?php echo $this->pageTitle ;?> </h1>
					<table id="avia">
						<thead>
							<tr>
								<td>Страна</td>
								<td>Даты</td>
								<td>Направление</td>
								<td>А/компания</td>
								<td>№ рейса</td>
								<td>Аэрапорт</td>
								<td>Вылет</td>
								<td>Стоимость</td>
								<td>Заказ</td>
							</tr>
						</thead>
						<tbody>
<?php
						$this->widget('application.widgets.ProductListView',
							array(
								'id' => 'products-list',
								'itemView' => '_hot-avia',
								'dataProvider' => $dataProducts,
								'ajaxUpdate' => false,
								'template' => "{items}\n<div class=\"col-xs-12 text-center\">{pager}</div>",
								'pager' => array(
									'class' => 'bootstrap.widgets.BsPager',
									'firstPageLabel' => '',
									'prevPageLabel' => '',
									'nextPageLabel' => '',
									'lastPageLabel' => '',
									'hideFirstAndLast' => true,
								)
							)
                        );
?>
						<tbody>
					</table>
					<div class="text">
						<?php echo $this->text ;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
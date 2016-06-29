<!DOCTYPE html>
<html lang = "ru">
<head>
	<meta http-equiv = "content-type" content = "text/html; charset=utf-8">
<?php
	$cs = Yii::app()->getClientScript();

	$css_path = Yii::getPathOfAlias('webroot.css');
	$js_path = Yii::getPathOfAlias('webroot.js');

	$cs->registerCoreScript('jquery', CClientScript::POS_END);

	$cs->registerPackage('bootstrap');
	$cs->registerPackage('slider-slick');
	$cs->registerPackage('function');

	$cs->registerCssFile(
		Yii::app()->assetManager->publish($css_path . '/style.css')
	);

	$cs->registerCssFile(
			Yii::app()->assetManager->publish($css_path . '/jScrollPane.css')
	);

	$cs->registerCssFile(
		Yii::app()->assetManager->publish($css_path . '/common.css')
	);
?>
	<title><?php echo $this->seo['title']; ?></title>
	<meta name = "keywords" content = "<?php echo $this->seo['keywords']; ?>"/>
	<meta name = "description" content = "<?php echo $this->seo['description']; ?>"/>
</head>

<div class="wrapper">
<body>

<ul class = "hidden-top">
	<div class = "container no-all">
		<div class = "logo">
			<a href = "/">
				<img src = "/images/logo-hidden.png" alt = "Логотип">
			</a>
		</div>
		[[w:MenuWidget|menu_id=5;menu_type=custom;]]
		<div class = "icons">
			<div class = "phones"><?php echo $this->mts[1][0] ;?> <span> <?php echo $this->mts[2][0] ;?></span></div>
			<div class = "search hid">
				<i class = "glyphicon glyphicon-search"></i>
			</div>
			<div class = "translate">
				ENG
				<img src = "/images/flag.png" alt = "">
			</div>
<?php
			echo CHtml::beginForm(array('/search'), 'get', array('class' => 'form-search'));
			echo CHtml::textField('search', '', array('class' => 'hid', 'placeholder' => 'ПОИСК ПО САЙТУ'));
			echo CHtml::linkButton('Искать на сайте',array('class' => 'search-link'));
			echo CHtml::endForm();
?>
		</div>
	</div>
</ul>

<header>
	<div class = "info container">
		<div class = "row">
			<div class = "logo">
				<a href = "/">
					<img src = "/images/logo.png" alt = "Логотип">
				</a>
			</div>
			<ul>
				[[w:MenuWidget|menu_id=1;menu_type=custom;]]
			</ul>
			<div class = "phones">
				<div>
					Горячая линия <br>
					<div class = "number mts">
						<?php echo $this->mts[1][0] ;?> <span> <?php echo $this->mts[2][0] ;?></span>
					</div>
				</div>
				<div>
					Для частных лиц <br>
					<div class = "number velcom">
						<?php echo $this->velcom[1][0] ;?> <span> <?php echo $this->velcom[2][0] ;?></span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<nav class = "navbar nav" role = "navigation">
		<div class = "container no-left no-right">
			<div class = "navbar-header navbar-default">
				<button type = "button" class = "navbar-toggle" data-toggle = "collapse"
				        data-target = "#bs-example-navbar-collapse-1">
					<span class = "sr-only">Toggle navigation</span>
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
				</button>
			</div>
			<div class = "collapse navbar-collapse navbar-left no-left no-right" id = "bs-example-navbar-collapse-1">
				<ul class = "nav navbar-nav">
					[[w:MenuWidget|menu_id=5;menu_type=custom;]]
				</ul>
			</div>
			<div class = "search top">
				<i class = "glyphicon glyphicon-search"></i>
			</div>
			<div class = "translate">
				ENG
				<img src = "/images/flag.png" alt = "">
			</div>
<?php
			echo CHtml::beginForm(array('/search'), 'get', array('class' => 'form-search'));
			echo CHtml::textField('search', '', array('class' => 'top', 'placeholder' => 'ПОИСК ПО САЙТУ'));
			echo CHtml::linkButton('Искать на сайте',array('class' => 'search-link'));
			echo CHtml::endForm();
?>
		</div>
	</nav>
</header>
	<section>
	</section>

<?php
	$cs = Yii::app()->getClientScript();

	$menu = '
		$("header .dropdown, .hidden-top .dropdown").bind("mouseenter", function()
		{
			$(this).addClass("open");
		}).bind("mouseleave", function()
		{
			$(this).removeClass("open");
		});

		$(function(f)
		{
		    var element = f(".hidden-top");
		    f(window).scroll(function ()
		    {
		        element["fade" + (f(this).scrollTop() > 164 ? "In" : "Out")](500);
		    });
		});

		$(".search.top i").on("click", function()
		{
			$("header input.top").fadeIn();
			$("header input.top + a").fadeIn();
		});

		$(".search.hid i").on("click", function()
		{
			$("input.hid + a").fadeIn();
			$("input.hid").fadeIn();
		});

		$(document).click(function(event)
		{
			if ($(event.target).closest("#search").length) return;
			if ($(event.target).closest(".search").length) return;

			$("input.hid + a").fadeOut();
			$("input.hid").fadeOut();
			$("header input.top").fadeOut();
			$("header input.top + a").fadeOut();
			event.stopPropagation();
		});
	';

	$cs->registerScript('menu', $menu);
?>
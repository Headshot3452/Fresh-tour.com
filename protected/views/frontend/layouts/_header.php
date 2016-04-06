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
			<input type = "text" placeholder = "ПОИСК ПО САЙТУ" class = "hid">
			<a href = "" class = "search-link">Искать на сайте</a>
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
			<input type = "text" placeholder = "ПОИСК ПО САЙТУ" class = "top">
			<a href = "" class = "search-link">Искать на сайте</a>
		</div>
	</nav>
</header>

<!--<div class = "wrapper">-->
<!--		<header>-->
<!--			<div class = "search">-->
<!--				--><?php
//				echo CHtml::beginForm(array('catalog/search'), 'get');
//				$this->widget('application.widgets.AutoCompleteWidget', array(
//						'name' => 'term',
//						'value' => '',
//						'source' => $this->createUrl('catalog/search'),
//						'options' => array(
//								'minLength' => '3', // min chars to start search
//								'select' => 'js:function(event, ui) {
//                         window.location = "' . Yii::app()->getBaseUrl(true) . '"+ui.item.url;
//                     }'
//						),
//						'methodChain' => '.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
//                            var words=this.term.split(" ");
//                            var length=words.length;
//                            for (var i=0;i<words.length;i++)
//                            {
//                                if (words[i]!="")
//                                {
//                                    item.label=item.label.replace(new RegExp("("+words[i]+")","gi"),"<strong>$1</strong>");
//                                }
//                            }
//                       return $( "<li>" )
//                           .data( "item.autocomplete", item )
//                           .append( "<a href=\""+item.url+"\"><img src=\"/"+item.src+"\">" + item.label +  "</a>")
//                           .appendTo( ul );
//                     }',
//						'htmlOptions' => array(
//								'id' => 'searchstring',
//								'rel' => 'url',
//								'placeholder' => 'поиск',
//								'class' => 'search-input'
//						),
//				));
//				echo '<button id="searchsubmit" type="submit"><span class="glyphicon glyphicon-search"></span></button>';
//				echo CHtml::endForm();
//				?>
<!--			</div>-->

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
		    var element = f(\'.hidden-top\');
		    f(window).scroll(function ()
		    {
		        element[\'fade\' + (f(this).scrollTop() > 164 ? \'In\' : \'Out\')](500);
		    });
		});
	';
	$cs->registerScript('menu', $menu);
?>
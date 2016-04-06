<div id = "slider-main">
    [[w:SliderWidget|slider_id=1;]]
</div>

<div id="slider-fon"></div>

<div id="slider-form">
	<div class="inner">
		<h4>Путешествуйте вместе с нами!</h4>
		<h3>Найдите свое идеальное путешествие</h3>

		<ul class="nav nav-tabs">
			<li class="active"><a href="#tyrs" data-toggle="tab">Туры</a></li>
			<li><a href="#avia" data-toggle="tab">Авиабилеты</a></li>
			<li><a href="#otels" data-toggle="tab">Отели</a></li>
			<a href = "" class="gift">Подарочные карты</a>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id = "tyrs">
				<div class="row">
					<form action = "" id = "tyrs-form">
						<div class="col-xs-6">
							<div class="form-group">
								<label for = "country_to">Куда хотите поехать</label>
								<select type = "text" name = "country_to" placeholder = "Выберите страну" class="form-control">
									<option value = "Выберите страну">Выберите страну</option>
									<option value = "Россия">Россия</option>
									<option value = "Беларусь">Беларусь</option>
								</select>
							</div>
							<div class="form-group">
								<label for = "country_from">Город вылета</label>
								<select type = "text" name = "country_from" placeholder = "Выберите страну" class="form-control">
									<option value = "Выберите город вылета">Выберите город вылета</option>
									<option value = "Россия">Россия</option>
									<option value = "Беларусь">Беларусь</option>
								</select>
							</div>
							<div class="form-group">
								<label for = "date">Дата вылета</label>
								<input type = "text" name = "date" placeholder = "01.01.2015" class="form-control" id="date_tyrs">
							</div>
							<a href = "">Расширеный поиск</a>
						</div>

						<div class="col-xs-4">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label for = "kids">Дети</label>
										<select type = "text" name = "kids" placeholder = "1" class="form-control">
											<option value = "1">1</option>
											<option value = "2">2</option>
											<option value = "3">3</option>
										</select>
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
										<label for = "parent">Взрослые</label>
										<select type = "text" name = "parent" placeholder = "1" class="form-control">
											<option value = "1">1</option>
											<option value = "2">2</option>
											<option value = "3">3</option>
										</select>
									</div>
								</div>

								<label for = "time" class="pad_left">Продолжительность</label>

								<div class="col-xs-6">
									<div class="form-group">
										<select type = "text" name = "time_to" placeholder = "1" class="form-control">
											<option value = "1">1</option>
											<option value = "2">2</option>
											<option value = "3">3</option>
										</select>
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
										<select type = "text" name = "time_from" placeholder = "1" class="form-control">
											<option value = "1">1</option>
											<option value = "2">2</option>
											<option value = "3">3</option>
										</select>
									</div>
									<span>Ночей</span>
								</div>

								<div class="col-xs-6">
									<button type="submit">Подобрать</button>
								</div>

							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="tab-pane" id="avia">
				<div class="row">
					<form action = "" id = "avia-form">
						<div class="col-xs-6">
							<div class="form-group">
								<label for = "city_to">Город вылета</label>
								<select type = "text" name = "city_to" placeholder = "Выберите город" class="form-control">
									<option value = "Выберите город">Выберите город</option>
									<option value = "Россия">Минск</option>
									<option value = "Беларусь">Москва</option>
								</select>
							</div>
							<div class="form-group">
								<label for = "date">Дата вылета</label>
								<input type = "text" name = "date" placeholder = "01.01.2015" class="form-control" id="date_avia">
							</div>
							<div class="form-group">
								<label for = "aviacompany">Авиакомпания</label>
								<select type = "text" name = "aviacompany" placeholder = "Любая авиакомпания" class="form-control">
									<option value = "Любая авиакомпания">Любая авиакомпания</option>
									<option value = "Авиакомпания 1">Авиакомпания 1</option>
									<option value = "Авиакомпания 2">Авиакомпания 2</option>
								</select>
							</div>
							<a href = "">Расширеный поиск</a>
						</div>

						<div class="col-xs-6">
							<div class="form-group">
								<label for = "holiday">Куда хотите поехать</label>
								<select type = "text" name = "holiday" placeholder = "Выберите страну" class="form-control">
									<option value = "Выберите страну">Выберите страну</option>
									<option value = "Египет">Египет</option>
									<option value = "Турция">Турция</option>
								</select>
							</div>

							<div class="form-group">
								<label for = "for">Для кого</label>
								<select type = "text" name = "for" placeholder = "1 взрослый" class="form-control">
									<option value = "1 взрослый">1 взрослый</option>
									<option value = "2 взрослых">2 взрослых</option>
									<option value = "3 взрослых">3 взрослых</option>
								</select>
							</div>
							<div class="col-xs-6">
								<div class="row">
									<button type="submit">Подобрать</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="tab-pane" id="popular">
			</div>
		</div>
	</div>
</div>

<div class = "redirect container">
    <div class="row">
        <h1>Отели и страны <a href = "<?php echo $this->getUrlById(Yii::app()->params['pages']['strany-i-oteli']) ;?>" class = "show_all">Показать всё</a></h1>
    </div>
</div>

<div id = "slider-hotels">
    <div class = "container">
        <div id="slider-nav">
<?php
            if(isset($categories))
            {
                foreach($categories as $key =>$category)
                {
                    $images = $category->getFiles();
                    $flag = next($images);
                    $gerb = next($images);

                    echo  '<div><img src = "'.$gerb['path'].'/small/'.$gerb['name'].'" alt = "'.$category['title'].'">'.$category['title'].'</div>';
                }
            }
?>
        </div>

        <div id="slider-for">
<?php
            if(isset($categories))
            {
                foreach($categories as $category)
                {
                    $products = CatalogProducts::model()->active()->findAll('parent_id = :id', array('id' => $category->id));

                    if($products)
                    {
                        echo
                            '<div class="item">';

                        for($i = 0, $count = count($products); $i < $count; $i += 4)
                        {
                            if($i <= $count)
                            {
                                $images = $products[$i]->getOneFile('big');

                                $stars = $products[$i]->getStars();

                                echo
                                    '<div class="items-inner">
                                        <div class="col-xs-6 no-left">
                                            <div class="med-container">
                                                <img class="med" src = "'.$images.'" alt = "'.$products[$i]['title'].'">
                                                <div class="med-caption caption">
                                                    <h2>'.$products[$i]['title'].'</h2>
                                                    <div class="stars">';

                                                        for($j = 0; $j < 5; $j++)
                                                        {
                                                            if($j < $stars['value'])
                                                            {
                                                                echo '<img src = "/images/star_full.png" alt = "">';
                                                            }
                                                            else
                                                            {
                                                                echo '<img src = "/images/star.png" alt = "">';
                                                            }
                                                        }
                                echo
                                                    '</div>
                                                    <h3>От <span>'.Yii::app()->format->formatNumber($products[$i]['price']).' руб.</span></h3>
                                                    <div class="footer-container">
                                                        <span>2 человека</span>
                                                        <span>7 ночей с 7.09</span>
                                                        <a class="forward" href = "'.$products[$i]->getUrlForItem($this->getUrlById(Yii::app()->params['pages']['strany-i-oteli'])).'">Перейти</a>
                                                    </div>
                                                </div>
                                            </div>';

                                if($i + 1 >= $count)
                                {
                                    echo
                                         '</div>
                                    </div>
                                    </div>';

                                    break;
                                }
                            }

                            if($i + 1 < $count)
                            {
                                $images = $products[$i + 1]->getOneFile('big');

                                $stars = $products[$i + 1]->getStars();

                                echo
                                            '<div class="small-container">
                                                <div class="col-xs-6 no-left">
                                                    <img class="small" src = "'.$images.'" alt = "'.$products[$i + 1]['title'].'">
                                                    <div class="small-caption caption">
                                                        <h2>'.$products[$i + 1]['title'].'</h2>
                                                        <div class="stars">';
                                                             for($j = 0; $j < 5; $j++)
                                                                {
                                                                    if($j < $stars['value'])
                                                                    {
                                                                        echo '<img src = "/images/star_full.png" alt = "">';
                                                                    }
                                                                    else
                                                                    {
                                                                        echo '<img src = "/images/star.png" alt = "">';
                                                                    }
                                                                }
                                echo
                                                        '</div>
                                                        <h3>От <span>'.Yii::app()->format->formatNumber($products[$i + 1]['price']).' руб.</span></h3>
                                                        <div class="footer-container">
                                                            <span>2 человека</span>
                                                            <span>7 ночей с 7.09</span>
                                                            <a class="forward" href = "'.$products[$i + 1]->getUrlForItem($this->getUrlById(Yii::app()->params['pages']['strany-i-oteli'])).'">Перейти</a>
                                                        </div>
                                                    </div>
                                                </div>';

                                if($i + 2 >= $count)
                                {
                                    echo
                                            '</div>
                                        </div>
                                    </div>
                                    </div>';

                                    break;
                                }
                            }

                            if($i + 2 < $count)
                            {
                                $images = $products[$i + 2]->getOneFile('big');

                                $stars = $products[$i + 2]->getStars();

                                echo
                                                '<div class="col-xs-6 no-right">
                                                    <img class="small" src = "'.$images.'" alt = "'.$products[$i + 2]['title'].'">
                                                    <div class="small-caption caption">
                                                        <h2>'.$products[$i + 2]['title'].'</h2>
                                                        <div class="stars">';
                                                            for($j = 0; $j < 5; $j++)
                                                            {
                                                                if($j < $stars['value'])
                                                                {
                                                                    echo '<img src = "/images/star_full.png" alt = "">';
                                                                }
                                                                else
                                                                {
                                                                    echo '<img src = "/images/star.png" alt = "">';
                                                                }
                                                            }
                                echo
                                                        '</div>
                                                        <h3>От <span>'.Yii::app()->format->formatNumber($products[$i + 2]['price']).' руб.</span></h3>
                                                        <div class="footer-container">
                                                            <span>2 человека</span>
                                                            <span>7 ночей с 7.09</span>
                                                            <a class="forward" href = "'.$products[$i + 2]->getUrlForItem($this->getUrlById(Yii::app()->params['pages']['strany-i-oteli'])).'">Перейти</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';

                                if($i + 3 >= $count)
                                {
                                    echo
                                    '</div>
                                    </div>';

                                    break;
                                }
                            }

                            if($i + 3 < $count)
                            {
                                $images = $products[$i + 3]->getOneFile('big');

                                $stars = $products[$i + 3]->getStars();

                                echo
                                        '<div class="col-xs-6 no-right">
                                            <div class="big-container">
                                                <img class="big" src = "'.$images.'" alt = "'.$products[$i + 3]['title'].'">
                                                <div class="big-caption caption">
                                                    <h2>'.$products[$i + 3]['title'].'</h2>
                                                    <div class="stars">';
                                                        for($j = 0; $j < 5; $j++)
                                                        {
                                                            if($j < $stars['value'])
                                                            {
                                                                echo '<img src = "/images/star_full.png" alt = "">';
                                                            }
                                                            else
                                                            {
                                                                echo '<img src = "/images/star.png" alt = "">';
                                                            }
                                                        }
                                echo
                                                    '</div>
                                                    <h3>От <span>'.Yii::app()->format->formatNumber($products[$i + 3]['price']).' руб.</span></h3>
                                                    <div class="footer-container">
                                                        <span>2 человека</span>
                                                        <span>7 ночей с 7.09</span>
                                                        <a class="forward" href = "'.$products[$i + 3]->getUrlForItem($this->getUrlById(Yii::app()->params['pages']['strany-i-oteli'])).'">Перейти</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';

                                if($i + 4 >= $count)
                                {
                                    echo '</div>';
                                    break;
                                }
                            }
                        }
                    }
                }
            }
?>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<div class = "redirect container">
    <div class="row">
        <h1>Тематические туры <a href = "<?php echo $this->getUrlById(Yii::app()->params['pages']['tema-tours']) ;?>" class = "show_all">Показать всё</a></h1>
    </div>
</div>

<div id="temat-tyrs">
    <div class="container">
        <div class="row">
            <div class="col-xs-5 no-right">
                <div class="row">
                    <ul class="nav nav-tabs">
                        <li class="active"><img src = "/images/temat1.png" alt = ""><a href="#winter" data-toggle="tab">Зимний отдых</a></li>
                        <li><img src = "/images/temat2.png" alt = ""><a href="#corp" data-toggle="tab">Корпоративный отдых</a></li>
                        <li><img src = "/images/temat1.png" alt = ""><a href="#spa" data-toggle="tab">Спа отдых</a></li>
                        <li><img src = "/images/temat2.png" alt = ""><a href="#family" data-toggle="tab">Семейный отдых</a></li>
                        <li><img src = "/images/temat1.png" alt = ""><a href="#spa1" data-toggle="tab">Спа отдых</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-7 no-right">
                <div class="tab-content">
                    <div class="tab-pane active" id = "winter">
                        <div class="col-xs-6 no-all">
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 no-all">
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id = "corp">
                        <div class="col-xs-6 no-all">
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 no-all">
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id = "spa">
                        <div class="col-xs-6 no-all">
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 no-all">
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id = "family">
                        <div class="col-xs-6 no-all">
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>5 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 no-all">
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id = "spa1">
                        <div class="col-xs-6 no-all">
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>10 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 no-all">
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>5 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/hot_tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>5 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src = "/images/popular-tyr.png" alt = "">
                                <div class="caption">
                                    <h3>STEUNG SIEM REAP</h3>
                                    <div class="stars">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                        <img src = "/images/star_full.png" alt = "">
                                    </div>
                                    <h5>От <span>5 000 000 руб.</span></h5>
                                    <div class="footer-container">
                                        <span>2 человека</span>
                                        <span>7 ночей с 7.09</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h2>Семейный отдых</h2>
            <h4 class="col-xs-11 no-all">Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более того, нечитабельность текста сыграет на руку при оценке качества восприятия макета.
                                         Самым известным «рыбным» текстом является знаменитый Lorem ipsum. Считается, что впервые его применили в книгопечатании еще в XVI веке. Своим появлением Lorem ipsum обязан древнеримскому философу Цицерону, ведь именно из его трактата «О </h4>
        </div>
    </div>
</div>

<div class = "redirect gray">
    <div class="container">
        <div class="row">
            <h1>Текстовый блок</h1>
            <h4 class="col-xs-11 no-all">
                Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более того, нечитабельность текста сыграет на руку при оценке качества восприятия макета.
                <br><br>
                Самым известным «рыбным» текстом является знаменитый Lorem ipsum. Считается, что впервые его применили в книгопечатании еще в XVI веке. Своим появлением Lorem ipsum обязан древнеримскому философу Цицерону, ведь именно из его трактата «О пределах добра и зла» средневековый книгопечатник вырвал отдельные фразы и слова, получив текст-«рыбу», широко используемый и по сей день. Конечно, возникают некоторые вопросы, связанные с использованием Lorem ipsum на сайтах и проектах, ориентированных на кириллический контент – написание символов на латыни и на кириллице значительно различается.
                <br><br>
                И даже с языками, использующими латинский алфавит, могут возникнуть небольшие проблемы: в различных языках те или иные буквы </h4>
        </div>
    </div>
</div>

<div class = "redirect container">
    <div class="row">
        <h1>Свежие туры <a href = "" class = "show_all">Показать всё</a></h1>
    </div>
</div>

<div id="fresh-tyr">
    <div class="container no-all">
        <div class="row">
            <div id="slider_fresh">
                <div class="item">
                    <img src = "/images/oae.png" alt = "">
                    <h2>ОАЭ</h2>
                    <a href = "">150 туров</a>
                </div>
                <div class="item">
                    <img src = "/images/egypt.png" alt = "">
                    <h2>Франция</h2>
                    <a href = "">120 туров</a>
                </div>
                <div class="item">
                    <img src = "/images/france.png" alt = "">
                    <h2>Египет</h2>
                    <a href = "">110 туров</a>
                </div>
                <div class="item">
                    <img src = "/images/egypt.png" alt = "">
                    <h2>Франция</h2>
                    <a href = "">120 туров</a>
                </div>
                <div class="item">
                    <img src = "/images/france.png" alt = "">
                    <h2>Египет</h2>
                    <a href = "">110 туров</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="slider_fresh_for" class="container no-all">
    <div class="row">
        <div class="items">
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">RADISSON BLU TALA
                                      BAY RESORT
                                      AQABA</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
        </div>
        <div class="items">
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">RADISSON BLU TALA
                                      BAY RESORT
                                      AQABA</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
        </div>
        <div class="items">
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">RADISSON BLU TALA
                                      BAY RESORT
                                      AQABA</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
        </div>
        <div class="items">
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">RADISSON BLU TALA
                                      BAY RESORT
                                      AQABA</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
        </div>
        <div class="items">
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">RADISSON BLU TALA
                                      BAY RESORT
                                      AQABA</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
            <div class="col-xs-4 item">
                <div class="inner">
                    <h5 class="title">STEUNG SIEM REAP</h5>
                    <img src = "/images/fresh1.png" alt = "">
                    <div class="clearfix"></div>
                    <div class="stars">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                        <img src = "/images/star_full.png" alt = "">
                    </div>
                    <h5>От <span>5 000 000 руб.</span></h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="news-main">
    <div class="container no-all">
        <div class="row">
            <div class="col-xs-6 bron">
                <h1>Раннее бронирование</h1>
                <p>
                    По любому из наших 26 направлений мы предлагаем
                    широкий выбор экономичных отелей, стоимость размещения в которых ниже, чем в гостиницах
                </p>

                <form action = "" id="form-bron">

                    <div class="form-group">
                        <label for = "country_to">Куда хотите поехать</label>
                        <select type = "text" name = "country_to" placeholder = "Куда хотите поехать" class="form-control">
                            <option value = "Россия">Россия</option>
                            <option value = "Беларусь">Беларусь</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for = "name">Ваше имя</label>
                        <input type = "text" name = "name" placeholder = "Иванов Иван" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for = "phone">Телефон</label>
                        <input type = "text" name = "phone" placeholder = "+75 33 987 77 77" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for = "email">Ваше имя</label>
                        <input type = "text" name = "email" placeholder = "ivanov@gmail.com" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for = "comment">Комментарий</label>
                        <textarea name = "comment" placeholder="Оставьте свой комментарий..."></textarea>
                    </div>

                    <div class="clearfix"></div>

                    <button type="submit">Забронировать</button>

                    <div class="clearfix"></div>
                </form>

            </div>
            <div class="col-xs-6 news">
                <h1>Новости</h1>
                [[w:NewsLastWidget|count=4;parent_id=2;]]

                <a href = "<?php echo $this->getUrlById(Yii::app()->params['pages']['novosti']) ;?>" class="all_items">Все новости</a>
                <div id="send">
                    <input type = "text" placeholder="Ваш email"><a href = "" class = "show_all">Показать всё</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $cs = Yii::app()->getClientScript();
    $slider = '
        $("#slider-for").slick(
        {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: "#slider-nav"
        });

        $("#slider-for .item").slick(
        {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            dots: true,
            autoplay: true,
            autoplaySpeed: 5000,
        });

        $("#slider-nav").slick({
            slidesToShow: 7,
            variableWidth: true,
            slidesToScroll: 1,
            asNavFor: "#slider-for",
            dots: false,
            centerMode: false,
            focusOnSelect: true
        });

        $("#slider_fresh").slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: "#slider_fresh_for .row",
			dots: false,
			centerMode: false,
			focusOnSelect: true
		});

		$("#slider_fresh_for .row").slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			dots: false,
			autoplay: false,
			draggable: false
		});
    ';

    $cs->registerScript('slider', $slider);
?>
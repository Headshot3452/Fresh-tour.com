<?php
	$start = 0;
	$counter = -1;
	if(isset($categories))
	{
		echo
		'<div id="fresh-tyr" class="strany">
			<div class="no-all">
				<div class="row">';

					$kol = count($categories);
					foreach($popular as $value)
					{
						$image = $value->getOneFile('small');
						$count = CatalogProducts::model()->active()->count('parent_id = :id', array(':id' => $value->id));
						echo
						'<div class="item col-xs-4">
							<img src = "/'.$image.'" alt = "">
							<h2 onclick=\'location.href="'.$value->name.'" \'>'.$value->title.'</h2>
							<a href = "'.$value->name.'" class="kolichestvo">'.$count.' '.Yii::t('app', 'Tours', array($count)).' </a>
						</div>';
					}
		echo
				'</div>
			</div>
		</div>

		<div id="all-tyrs">
			<h1>Все маршруты <h2>'.$kol.' <span>'.Yii::t('app', 'Countries', array($kol)).'</span></h2></h1>
			<div class="clearfix"></div>';

			mb_internal_encoding("UTF-8");

			foreach($categories as $value)
			{
				$new_letter = mb_substr($value->title, 0, 1);
				if(!isset($letter) || $letter != $new_letter)
				{
					$counter++;
					if($start != 0)
					{
						echo
						'</ul></div>';

						if($counter % 3 == 0)
						{
							echo '<div class="clearfix"></div>';
						}
					}

					$letter = $new_letter;

					echo
					'<div class="col-xs-4">
						<h3>'.$new_letter.'</h3>
						<ul>
							<li><a href = "'.$value->name.'">'.$value->title.'</a></li>';

					$start = 2;
				}
				elseif($letter == $new_letter)
				{
					echo
					'<li><a href = "'.$value->name.'">'.$value->title.'</a></li>';
					$start = 1;
				}
			}
		echo
				'</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="text" style="margin-top: 30px;">
		    '.$root->text.'
		</div>';
	}
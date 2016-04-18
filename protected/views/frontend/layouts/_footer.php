        <div class="ghost-footer"></div>
    </div>
        <footer>
            <div class="container no-right">
                <div class="rows">
                    <div>
                        <h3><a href = "">Туры и визы</a></h3>
                        <ul>
                            [[w:MenuWidget|menu_id=27;menu_type=custom;]]
                        </ul>
                    </div>
                    <div>
                        <h3><a href = "">Информация</a></h3>
                        <ul>
                            [[w:MenuWidget|menu_id=24;menu_type=custom;]]
                        </ul>
                    </div>
                    <div>
                        <h3><a href = "">О компании</a></h3>
                        <ul>
                            [[w:MenuWidget|menu_id=19;menu_type=custom;]]
                        </ul>
                    </div>
                    <div>
                        <h3><a href = "/<?php echo $this->getUrlById(Yii::app()->params['pages']['strany-i-oteli']) ;?>">Страны и отели</a></h3>
                        <h3><a href = "/<?php echo $this->getUrlById(Yii::app()->params['pages']['tema-tours']) ;?>">Тематические туры</a></h3>
                        <h3><a href = "/<?php echo $this->getUrlById(Yii::app()->params['pages']['agentstvam']) ;?>">Агенствам</a></h3>
                    </div>
                    <div class="contakts">
                        <h5>Наш адрес</h5>
                        <span class="address"><?php echo $this->settings['address'] ;?></span>
                        <h5>Время работы</h5>
                        <span class="clock"><?php echo $this->settings['work'] ;?></span>
                        <h5>Телефоны для связи</h5>
                        <span class="mts"><?php echo $this->mts[1][0].'<i> '.$this->mts[2][0].'</i>' ;?></span><br>
                        <span class="velcom"><?php echo $this->velcom[1][0].' <i> '.$this->velcom[2][0].'</i>' ;?></span>
                        <h5 class="email">Наш e-mail</h5>
                        <span><?php echo $this->settings['email_order'] ;?></span>
                    </div>
                    <div class="payment">
                        <h2>Способы оплаты</h2>
                        <a href = ""><img src = "/images/visa.png" alt = ""></a>
                        <a href = ""><img src = "/images/visa_electron.png" alt = ""></a>
                        <a href = ""><img src = "/images/mastercard.png" alt = ""></a>
                        <a href = ""><img src = "/images/maestro.png" alt = ""></a>
                    </div>
                    <div class="soc">
                        <h2>Мы в соц сетях</h2>
                        <a href = "/<?php echo $this->settings['odnoklasniki'] ;?>"><img src = "/images/odnoklasniki.png" alt = ""></a>
                        <a href = "/<?php echo $this->settings['facebook'] ;?>"><img src = "/images/facebook.png" alt = ""></a>
                        <a href = "/<?php echo $this->settings['vk'] ;?>"><img src = "/images/vk.png" alt = ""></a>
                        <a href = "/<?php echo $this->settings['google'] ;?>"><img src = "/images/google+.png" alt = ""></a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </footer>
    </body>
</html>

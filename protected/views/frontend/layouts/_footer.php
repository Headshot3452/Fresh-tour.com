        <div class="ghost-footer"></div>
    </div>
        <footer>		
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter37587465 = new Ya.Metrika({
                    id:37587465,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/37587465" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->				
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
<?php
                        $link = $this->getUrlById(Yii::app()->params['pages']['sposoby-oplaty']);
?>
                        <h2>Способы оплаты</h2>
                        <a href = "/<?php echo $link ;?>"><img src = "/images/visa.png" alt = "visa"></a>
                        <a href = "/<?php echo $link ;?>"><img src = "/images/visa_electron.png" alt = "visa-electron"></a>
                        <a href = "/<?php echo $link ;?>"><img src = "/images/mastercard.png" alt = "mastercard"></a>
                        <a href = "/<?php echo $link ;?>"><img src = "/images/maestro.png" alt = "maestro"></a>
                        <a href = "/<?php echo $link ;?>"><img src = "/images/mastercard-electronic.png" alt = "mastercard-electronic"></a>
                        <a href = "/<?php echo $link ;?>"><img src = "/images/belkart.png" alt = "Белкарт"></a>
                    </div>
                    <div class="soc">
                        <h2>Мы в соц сетях</h2>
                        <a href = "<?php echo $this->settings['odnoklasniki'] ;?>"><img src = "/images/odnoklasniki.png" alt = "odnoklasniki"></a>
                        <a href = "<?php echo $this->settings['facebook'] ;?>"><img src = "/images/facebook.png" alt = "facebook"></a>
                        <a href = "<?php echo $this->settings['vk'] ;?>"><img src = "/images/vk.png" alt = "vk"></a>
                        <a href = "<?php echo $this->settings['google'] ;?>"><img src = "/images/instagram.png" alt = "instagram"></a>
                        <a href = "<?php echo $this->settings['twitter'] ;?>"><img src = "/images/twitter.png" alt = "twitter"></a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </footer>
    </body>
</html>

<?php
class CartWidget extends Portlet
{
    public function renderContent()
    {
        echo '<div id="cart"></div>
        <script id="template-cart" type="ractive/text">
            <div class="orders-list">
                <div class="row header">
                    <div class="col-xs-1">№</div>
                    <div class="col-xs-4">Наименование товара</div>
                    <div class="col-xs-2 text-right">Цена</div>
                    <div class="col-xs-2 text-center">Количество</div>
                    <div class="col-xs-2 text-right">Сумма</div>
                    <div class="col-xs-1"></div>
                </div>
                {{#products:i}}
                <div class="row order">
                    <div class="col-xs-1 text-center">{{i+1}}</div>
                    <div class="col-xs-4">{{{title}}}</div>
                    <div class="col-xs-2 text-right"><b>{{price}}</b> руб.</div>
                    <div class="col-xs-2 text-center"><a href="javascript:void(0);" on-click="downCountItem" data-index="{{i}}"><i class="glyphicon glyphicon-minus"></i></a><input type="text" value="{{count}}" on-change="updateItem" data-index="{{i}}" style="width:35px;"><a href="javascript:void(0);" on-click="upCountItem" data-index="{{i}}"><i class="glyphicon glyphicon-plus"></i></a></div>
                    <div class="col-xs-2 text-right"><b>{{price*count}}</b> руб.</div>
                    <div class="col-xs-1 text-center"><a href="javascript:void(0);" on-click="removeItem" data-index="{{i}}"><i class="glyphicon glyphicon-remove"></i></a></div>
                </div>
                {{/products}}
                <div class="row footer">
                    <div class="col-xs-10">
                        <div class="clear">
                            <a href="javascript:void(0);" class="clear-cart"><i class="glyphicon glyphicon-remove"></i> Очистить корзину</a>
                        </div>
                    </div>
                </div>
                <div class="result row">
                 <div class="col-xs-12">
                        <div class="total_price" style="margin-top:40px;">
                            <div class="label col-xs-2" style="font-size:100%;">Итого:</div>
                            <div class="value col-xs-6"><b>{{total_price}}</b> руб.</div>
                        </div>
                    </div>
                 </div>
            </div>
        </script>';

        $cs=Yii::app()->getClientScript();

        $cart='
            var CartRactive = Ractive.extend({
                onrender:function(options)
                {
                    var self = this;
                    // proxy event handlers
                    self.on({
                        removeItem: function (e)
                        {
                            swal({
                              title: "Удалить товар из корзины?",
                              type: "warning",
                              showCancelButton: true,
                              confirmButtonColor: "#DD6B55",
                              confirmButtonText: "Да удалить!",
                              cancelButtonText: "Нет",
                              closeOnConfirm: false
                            },
                            function(){
                              cart.removeItem(e.index.i);
                              swal("Удален!", "Товар удален из Вашей корзины.", "success");
                            });
                        },
                        updateItem: function (e)
                        {
                            cart.save();
                        },
                        downCountItem: function (e)
                        {
                            cart.downCountItem(e.index.i);
                        },
                        upCountItem: function (e)
                        {
                            cart.upCountItem(e.index.i);
                        }
                    });
                }
            });

            initCartRactive();

             $.jStorage.listenKeyChange("cart", function(key, action){
                initCartRactive();
             });

             function initCartRactive()
             {
                ractive=new CartRactive(
                {
                  el: "#cart",
                  template: "#template-cart",
                  data: {
                      products: cart.products,
                      count: cart.count,
                      total_discount: cart.total_discount,
                      total_price: cart.total_price,
                  },
                });

                // $("#FormModel_products").val(JSON.stringify(cart.products));
                $("#CartForm_products").val(JSON.stringify(cart.products));
             }

             $("body").on("click",".clear-cart",function()
             {
                swal({
                  title: "Очистить корзину?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Да очистить!",
                  cancelButtonText: "Нет",
                  closeOnConfirm: false
                },
                function(){
                  $.jStorage.deleteKey("cart");
                  swal("Очищена!", "Ваша корзина очищена", "success");
                });
             });
        ';


        $cs->registerPackage('ractivejs')->registerPackage('sweet')->registerScript("cart",$cart);
    }
}
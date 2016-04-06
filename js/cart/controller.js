$(document).ready(function()
{
    if ($.cookie('refresh_cart')!=undefined)
    {
        $.jStorage.deleteKey('cart');
        $.cookie('refresh_cart',null,{expires: 0, path: '/'});
    }

    initCart();

    $("body").on("click",".addProduct",function()
    {
        var val=$(this).closest('div').find('input.count').val();

        if (val == undefined || val>0)
        {
            var p=$(this).data();
            var product=new Product(p.id,p.title,p.price,1,p.url, p.image);
            cart.addProduct(product);
//          saveAjaxStorage('cart',cart);
        }
    });
});

$.jStorage.listenKeyChange("cart", function(key, action){
    initCart();
});

function initCart()
{
    cart=new Cart;
    cart.init({storage:$.jStorage,storage_key:'cart'});
    cart.setTotal();
    var count='0';
    var price='0';
    if (cart.count!=0)
    {
        count=cart.count+'';
        price=number_format(cart.total_price, 0, '.',' ');
    }
    $('.count-product').html(cart.count);
    $('.total-price').html(number_format(cart.total_price, 0, '.',' '));

    $('.addProduct').each(function(index)
    {
        if (cart.products_by_id[$(this).data('id')]!==undefined)
        {
            $(this).addClass('active');
        }
        else
        {
            $(this).removeClass('active');
        }
    });
}

function saveAjaxStorage(key,storage)
{
    $.ajax(
    {
        url:"/ajax/saveStorage/",
        type:'POST',
        dataType: 'JSON',
        data:{
            key: key,
            items: JSON.stringify(storage.products),
        }
    });
}

function getAjaxStorage(key,storage)
{
    $.ajax(
    {
        url:"/ajax/getStorage/",
        type:'POST',
        dataType: 'JSON',
        data:{
            key: key
        },
        success:function(data)
        {
            storage.merge(data);
            storage.save();
        }
    });
}

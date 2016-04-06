(function($)
{
    $(".form-group.buttons").hide();

    $("body").on("change click", "input, textarea, select",function()
    {
        viewSubmitButton(this);
    });

    $('textarea').on('keyup', function()
    {
        if($(this).val().length > 255)
        {
            $(this).val($(this).val().substr(0, 255));
        }
        var value = 255 - $(this).val().length;
        $(this).prev().find('span').text(value);
    });

})(jQuery);

// добавления по карточке товара
$(document).ready(function()
{
    checkStock('#stock');
    $(document).on('change','#stock', function()
    {
        checkStock($(this));
    });

    $(document).on('click','.marker', function()
    {
        $(this).toggleClass('active');
        $(this).find('i').toggleClass('fa-bookmark');
        if($(this).find('input[type="checkbox"]').prop('checked'))
        {
            $(this).find('input[type="checkbox"]').prop('checked',false);
            $(this).find('i').removeClass('fa-bookmark');
            $(this).find('i').addClass('fa-bookmark-o');
        }
        else
        {
            $(this).find('input[type="checkbox"]').prop('checked', true);
            $(this).find('i').removeClass('fa-bookmark-o');
            $(this).find('i').addClass('fa-bookmark');
        }
    });

    $(document).on('click','.add_sale.add', function()
    {
        $(this).hide();
        $('.sale').show();
    });

    $(document).on('click','.checkbox-action', function()
    {
        var $t = $(this),
            $f = $(this).closest('#products-list');

            if($f.length == 0)
            {
                var $f = $(this).closest('#table-sotrudniki');
            }

        var $fc = $f.find('input[type=checkbox]');

        if ($t.hasClass('checked-all')){
            $fc.prop('checked', false);
            $t.removeClass('checked-all');
        }
        else if($t.hasClass('checked-single')){
            $fc.prop('checked', false);
            $t.removeClass('checked-single');
        }
        else
        {
            $fc.prop('checked', true);
            $t.addClass('checked-all');
        }
    });

    $(document).on('click', 'input[type=checkbox].group', function(e)
    {
        var $t = $(this),
            $f = $(this).parents('#products-list');

            if($f.length == 0)
            {
                var $f = $(this).closest('#table-sotrudniki');
            }

        var $fb = $f.find('.checkbox-action'); //button check all

        if ($f.find('input[type=checkbox]:checked').length == $f.find('input[type=checkbox]').length){
            $fb.removeClass('checked-single checked-all').addClass('checked-all');
        }
        else if($f.find('input[type=checkbox]:checked').length < $f.find('input[type=checkbox]').length && $f.find('input[type=checkbox]:checked').length != 0)
        {
            $fb.removeClass('checked-single checked-all').addClass('checked-single');
        }
        else
        {
            $fb.removeClass('checked-single checked-all');
        }
    });

    $(document).on('click', '.copy_products, .move_products', function ()
    {
        var a = $('.items').find('input[type=checkbox]:checked').clone();
        $('form.copy').html(a);
        return false;
    });

    $(document).on('click',' .move_products', function ()
    {
        $('form.copy').append('<input hidden type="text" name="move" value="1" />');
        return false;
    });


    $(document).on('click', '#modal_copy_products a', function ()
    {
        var parent_category = $(this).data('id');
        $('form.copy').append('<input hidden name="parent_category" value="'+parent_category+'" />');
        var data = $('form.copy').serialize();
        $.ajax({
            url: '/admin/'+$('form.copy').data('module')+'/copy_product/',
            type: 'POST',
            data: data,
            success: function(e)
            {
                window.location.reload();
            }
        });
        return false;
    });

    $(document).on('click','#modal_moderate .change_status, #modal_answer .change_status, #modal_delete .delete, #modal_not_active .change_status, #modal_active .change_status, #modal_archive .change_status', function ()
    {
        var a = $('.items').find('input[type=checkbox]:checked').clone();
        $('form.copy').html(a);
        var data = $('form.copy').serialize();
        var status = $(this).data('status');
        $.ajax(
        {
            url: '/admin/'+$('form.copy').data('module')+'/status_products/',
            type: 'POST',
            data: data+'&status='+status,
            success: function(e)
            {
                window.location.reload();
            }
        });
    });

    $(document).on('click','#modal_delete button:last-child', function ()
    {
        $('#modal_delete .close').trigger('click');
    });
});

function viewSubmitButton(obj)
{
    var el = $(obj).closest("form").find(".form-group.buttons");

    if (!el.is(':visible'))
    {
        el.show(500);
    }
}

function number_format(number, decimals, dec_point, thousands_sep)
{
    var i, j, kw, kd, km;

    if(isNaN(decimals = Math.abs(decimals)))
    {
        decimals = 2;
    }
    if(dec_point == undefined)
    {
        dec_point = ",";
    }
    if(thousands_sep == undefined)
    {
        thousands_sep = ".";
    }

    i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

    if( (j = i.length) > 3 )
    {
        j = j % 3;
    }
    else
    {
        j = 0;
    }

    km = (j ? i.substr(0, j) + thousands_sep : "");
    kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
    kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");

    return km + kw + kd;
}

function checkStock(object)
{
    var val = $(object).val();
    var color = 'black';
    switch (val)
    {
        case '0':
            color = 'green';
            $('#stock').closest('div').next().hide();
            $('#stock').closest('div').next().next().hide();
            break;
        case '1':
            color = 'red';
            $('#stock').closest('div').next().show();
            $('#stock').closest('div').next().next().show();
            break;
        default :
            break;
    }
    $(object).css('color', color);
    $(object).find('option').css('color', 'black');
}
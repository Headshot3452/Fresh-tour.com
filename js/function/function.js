$(function()
{
    $("body").on("change", "#count li a", function()
    {
        val = $(this).find('span').text();
        $.cookie("count_item", parseInt(val), {expires: 60, path: "/"});
        window.location.reload();
    });
});

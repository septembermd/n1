$(document).ready(function()
{
    $(function() {
        $( "#services" ).tabs();
    });
});
function resetf()
{
    $('#checkout1-form')[0].reset();
}

function tabs(obj)
{
    $("#services .items li").each(function() {
        $(this).removeAttr('id');
        $(this).parent().find("img").attr('src', '/images/arrow.jpg');
    });

    $("#service_text div[class='retr']").each(function() {
        $(this).css('display', 'none');
    });

    var attr = '';
    attr = $(obj).attr('href');
    $(obj).parent().parent().attr('id', 'active');
    $(obj).parent().find("img").attr('src', '/images/arrow_active.jpg');
    $(attr).css('display', 'block');
    //$(this).parent().parent().attr('id', 'active');
}
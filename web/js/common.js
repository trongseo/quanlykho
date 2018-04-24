function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}


//form collection
function formatNumberAll(){
    $(".number_format").each(function( index ) {
        var afterCommars = addCommas( $(this).val());
        $( "<p class='pformat'  style='float: right'  id='pformat_"+ $(this).attr('id') +"' ><b>"+afterCommars+"</b></p>" ).insertAfter( "#"+ $(this).attr('id') );
    });
}
function formatNumber(objs){
        var afterCommars = addCommas( $(objs).val());
    $("#pformat_"+ $(objs).attr('id')).remove();
        $( "<p class='pformat' style='float: right' id='pformat_"+ $(objs).attr('id') +"'><b>"+afterCommars+"</b></p>" ).insertAfter(  "#"+ $(this).attr('id') );

}
$( document ).ready(function() {

    $(".number_format").keyup(function(){
        formatNumber($(this));
    });
    formatNumberAll();

});
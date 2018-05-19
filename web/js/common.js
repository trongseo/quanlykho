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
function removecommas(str) {
  return  str.replace(/,/g, "");
}

// var text = "#here_is_the_one#";
// var find = ["#","_"];
// var replace = ['',' '];
// text = replaceStr(text, find, replace);
// console.log(text);

//form collection
function formatNumberAll(){

    $(".pformat").remove();
    $(".number_format").each(function( index ) {
        var afterCommars = addCommas( $(this).val());

        $( "<p class='pformat'  style='float: right'  id='pformat_"+ $(this).attr('id') +"' ><b>"+afterCommars+"</b></p>" ).insertAfter( "#"+ $(this).attr('id') );
    });
}
function formatNumber(objs){
        var afterCommars = addCommas( $(objs).val());
        debugger;

    $("#pformat_"+ $(objs).attr('id')).remove();
        $( "<p class='pformat' style='float: right' id='pformat_"+ $(objs).attr('id') +"'><b>"+afterCommars+"</b></p>" ).insertAfter(  "#"+ $(objs).attr('id') );

}
$( document ).ready(function() {

    $(".number_format").keyup(function(){
        formatNumber($(this));
    });
    formatNumberAll();

});
document.onkeyup = function(e) {
    if (e.which == 77) {
      //  alert("M key was pressed");
    } else if (e.ctrlKey && e.which == 66) {
        ///alert("Ctrl + B shortcut combination was pressed");
        document.forms[0].submit();
    } else if (e.ctrlKey && e.altKey && e.which == 89) {
      //  alert("Ctrl + Alt + Y shortcut combination was pressed");
    } else if (e.ctrlKey && e.altKey && e.shiftKey && e.which == 83) {
       // alert("Ctrl + Alt + Shift + U shortcut combination was pressed");
    }
};
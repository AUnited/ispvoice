$(document).ready(function(){
$('form.ajax').submit(function() {
    var form = $(this);
    $('#status').html('sending');
    $.ajax({type: form.attr('method'), url: form.attr('action'), data: form.serializeArray(), success: function(response) {

        $('#status').html('sended');
    }});
    return false;
});
};
$(document).ready(function() {
    $("#btn_type_bus").click(
        function(){
            sendAjaxForm('result_form', 'Type_Bus_For_Ajax', "www/Practice/handlers/handler.php");
            return false;
        }
    );
});

function sendAjaxForm(result_form, ajax_form, url){
    $.ajax({
        url : url,
        type: "POST",
        dataType: "html",
        data: $("#"+ajax_form).serialize(),
        success: function(response) {
            result = $.parseJSON(response);
            $('#result_form').html('Код автобуса: '+result.CodeBus+'<br>Марка автобуса: '+result.BrandBus+'<br>Модель автобуса'+result.ModelBus+'Количество мест: '+result.NumbSeats);

        },
        error: function(response) {
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}
let obj = {
    'Типы автобусов': "`Код автобуса`, `Марка автобуса`, `Модель автобуса`, `Количество мест`",
    'Парк': "`Гаражный номер`, `Код автобуса`, `Гос.Номер`, `Год выпуска`",
    'Маршрутный лист': "`Номер маршрута`, `Количество промежуточных остановок на маршруте`, `Продолжительсноть простоя на одной остановке, мин.`, `Время прохождения маршрута, мин.`, `Стоимость проезда, руб.`",
    'Водители': "`Табельный номер водителя`, `Ф.И.О`, `Дата рождения`, `Оклад, руб.`, `Стаж работы, лет.`, `Номер маршрута`",
    'Тех.талоны': "`Номер тех.талона`, `Код автобуса`, `Дата прохождения ТО`, `Дата следующего ТО`, `Ф.И.О Тех.эксперта`",
    'Путевой лист': "`ID`, `Код автобуса`, `Табельный номер водителя`, `Номер маршрута`, `Дата`, `Время выхода автобуса на маршрут`, `Время прибытия автобуса с маршрута`, `Топливо при выезде, л.`, `Топливо при возврате, л.`, `Причина схода автобуса с маршрута`, `Количество проданных билетов`, `Выручка, руб.`",
    'Статистика': "`ID`, `Код автобуса`, `Табельный номер водителя`, `Статус`",
};
let primaryKeys = ['Код автобуса', 'Гаражный номер', 'Номер маршрута', 'Табельный номер водителя', 'Номер тех.талона', 'ID', 'ID'];
$(document).ready( function() {
    $('form').submit( function(event) {

        event.preventDefault();
        
        let action = $(event.originalEvent.submitter).attr('name');
        var form = new FormData( this );
        let arr = [];
        let pk, valuePk;
        
        for( let [name, value] of form ) {
            if( primaryKeys.includes(name) ) {
                pk = name;
                valuePk = value;
            }
            arr.push( `'${value}'` );
        }
        
        $.ajax({
            type: 'POST',
            url: 'handlerNew.php',
            data: {
                name: this.name,
                fieldsName: obj[this.name],
                action: action,
                primaryKey: pk,
                valuePk: valuePk,
                values: arr.join(','),
                
            },

            cache: false,
            
        }).done(function( result ) {
            alert( result );
            getTable.apply( event.target );
        });
        
    });

function getTable() {
    let table = this.closest('.menu').nextElementSibling.querySelector('table');
    table.innerHTML = null;
    console.log( table );
    let headerArr = obj[this.name].replace( /[`]/g, '' ).split(',');
    
    let tHead = document.createElement('tr');
    for( let elem of headerArr ) {
        let th = document.createElement('th');
        th.innerText = elem;
        tHead.append(th);
    }
    table.append( tHead );
    $.ajax({
        url: 'handlerNew.php',
        method: 'GET',
        data: { 
            name: this.name,
            action: 'showTable'},
        dataType: 'html',
        
    }).done(function(respons) {
        $(table).append(respons);
    });
}
});
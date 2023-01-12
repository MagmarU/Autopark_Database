let obj = {
    'Типы автобусов': "`Код автобуса`, `Марка автобуса`, `Модель автобуса`, `Количество мест`",
    'Парк': "`Гаражный номер`, `Код автобуса`, `Гос.Номер`, `Год выпуска`",
};
let primaryKeys = ['Код автобуса', 'Гаражный номер'];
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
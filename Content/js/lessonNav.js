//--------------------------------------- Changer le contenu de la div principal (avec Right menu)
function changeContent($elem){
    var id = $($elem).attr('ChapterPart');
    console.log(id);
    $.post('/lesson/display', { id: id })
        .done(function(data) {
            $(".content-container").html(data);
        })
        .fail(function(data) {
            alert('Error: ' + data);
        });
}

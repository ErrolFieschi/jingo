$(document).ready(function(){
    $('#modal-btn').on('click', function(){
        $('#modal').css('display' , '');
        $('#modal').css('display' , 'block');
        $('#modal').css('padding-right' , '16px');
    });

    $('.modal-content').find('.close').on('click',function(){
        $('#modal').css('display' , 'none');
    });
});
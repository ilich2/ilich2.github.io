$(document).on('click', 'td.edit', function(){
  $('.ajax').html($('.ajax input').val());
  $('.ajax').removeClass('ajax');
  $(this).addClass('ajax');
  $(this).html('<input id="editbox" size="'+ $(this).text().length+'" value="' + $(this).text() + '" type="text">');
  $('#editbox').focus();
});
$(document).on('keydown', 'td.edit', function(event){
  var arr = $(this).attr('class').split( " " );
  if(event.which === 13)
  {
    var table = $('table').attr('id');
    $.ajax({ type: "POST",
      url:'/users/edit_user',
      data: "value="+$('.ajax input').val()+"&id="+arr[2]+"&field="+arr[1]+"&table="+table,
      success: function(data){
        $('.ajax').html($('.ajax input').val());
        $('.ajax').removeClass('ajax');
      }});
  }
});

$(document).on('blur', '#editbox', function(){
  var arr = $('td.edit').attr('class').split( " " );
  var table = $('table').attr('id');
  $.ajax({ type: "POST",
    url:'/users/edit_user',
    data: "value="+$('.ajax input').val()+"&id="+arr[2]+"&field="+arr[1]+"&table="+table,
    success: function(data){
      $('.ajax').html($('.ajax input').val());
      $('.ajax').removeClass('ajax');
    }});
});

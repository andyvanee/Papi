$(document).ready(function(){
  $.get('/api.php?fonts=true', function(data){
    $(data.fonts).each(function(__, elem){
      $('#font').append('<option value="'+elem+'">'+elem+'</option>');
    });
  });
  $('#figlet_form').submit(function(ev){
    ev.preventDefault();
    $.get('/api.php?'+$(this).serialize(), function(data){
      if (data.lines) {
        $('#output').html(data.lines);
      }
    });
  });
});

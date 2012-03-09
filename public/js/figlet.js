$(document).ready(function(){
  $.get('/api.php?fonts=true', function(data){
    $(data.fonts).each(function(__, elem){
      $('#font').append('<option value="'+elem+'">'+elem+'</option>');
    });
  });
  
  $('#figlet_form textarea').bind('keyup', function(){
    $('#figlet_form').trigger('submit');
  });
  
  $('#figlet_form select').bind('change', function(){
    $('#figlet_form').trigger('submit');
  });
  
  $('#figlet_form').submit(function(ev){
    ev.preventDefault();
    $.get('/api.php?'+$(this).serialize(), function(data){
      if (data.lines) {
        $('#output').html(data.lines);
      }
    });
  });
  
  $('#browser_font').bind('change', function(){
    var font = $(this).val();
    var menlo = (font == 'Menlo Bold')
    $('#output').css({'font-family': menlo?'Menlo':font, 'font-weight': menlo?'bold':'normal'});
  });

  $('#browser_font_size').bind('change', function(){
    $('#output').css({'font-size': $(this).val()});
  });
  
});

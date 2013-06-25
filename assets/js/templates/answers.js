$(function() {  

  $('.answer h1').on('click', function() {
    if($(this).parent().find('.inner').hasClass('is-invisible')) {
      $('.answer .inner').addClass('is-invisible');    
      $(this).parent().find('.inner').removeClass('is-invisible');
    } else {
      $('.answer .inner').addClass('is-invisible');        
    }
    return false;
  });

});
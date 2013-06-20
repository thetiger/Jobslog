$(document).ready(function() {
  $('#submitregistration').click(function(){

 $.ajax({
  type: "POST",
  url: "ajax/modify.php",
  data: ('#myform').serialize(),
 success: function(html){
    $('#data').append(html);
  }

})
  
  
  });
});
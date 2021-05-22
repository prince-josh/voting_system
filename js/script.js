
$('document').ready(function(){
  var greet = document.getElementById("greeting");
  var d = new Date();
  var h = d.getHours();
  
  if(h < 12){
    greet.innerHTML = "Good Morning";
  } 
  if(h < 16){
    greet.innerHTML = "Good Afternoon";
  } 
  else{
    greet.innerHTML = "Good Evening";
  }
  
 


  document.getElementById("2").style.display ="none";
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#imgPlaceholder').attr('src', e.target.result);
        }

        // base64 string conversion
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#chooseFile").change(function () {
      readURL(this);
    });
});
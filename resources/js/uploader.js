$(document).ready(function(){
//CROPIE
//$('#item').croppie(opts);
// call a method via jquery
//$('#item').croppie(method, args);

//DROPZONE
  var
      dropzone = '[data-role="drop-zone"]',
      dropcontrolupload = '[data-role="drop-control-upload"]'
      dropcontrolrevert = '[data-role="drop-control-revert"]',
      
      dropimage = '[data-role="preview-image"]',
      dropinput = 'input[data-role="file-input"]'
   
  $('body').on('change', dropinput, function(event) {
    console.log('dropintput changed');
    zone = $(this).closest(dropzone);
    img = zone.find(dropimage);
    oldimg = img.attr('src');
    reverter = zone.find(dropcontrolrevert);

    hasChanged = readURL(this, img);

    if(hasChanged === true)
    {
      reverter.removeClass('disabled');
    } else {
      reverter.addClass('disabled');
    }
  });

  
  $('body').on('click', dropcontrolupload, function(e) {
      console.log('dropcontrolupload clicked');
      $this = $(this);
      input = $this.closest(dropzone)
          .find(dropinput);
      input.click();
  });

  $('body').on('click', dropcontrolrevert, function(e) {
    console.log('dropcontrolrevert clicked');
    $this = $(this);
    zone = $this.closest(dropzone);
    input = zone.find(dropinput);
    img = zone.find(dropimage);
    fallback = img.data('default');
    img.attr('src', fallback );
    $this.addClass('disabled');
  });
 
  // DRANG N DROP
 
  $('body').on('dragover', dropzone, function() {
    $this = $(this).addClass('dropping');
    return false;
  });

  $('body').on('dragend dragleave', dropzone, function() {
    $(dropzone).removeClass('dropping');
    return false;
  });


  $('body').on('drop', dropzone, function(e) {
    e.preventDefault();
    $this = $(this);
    zone = $this.closest(dropzone);
    zone.removeClass('dropping');

    var files = e.originalEvent.dataTransfer.files;
    if (files && files[0])
    {
      input = zone.find(dropinput);
      input.files = files[0];
      console.log('input',input);
      
      img = zone.find(dropimage);

      //if (input.files && input.files[0]) {   
        var reader = new FileReader();
        reader.onload = function(e) {
           img.attr('src', e.target.result);
          console.log('drop2', img.attr('src'));
        }
        reader.readAsDataURL(input.files[0]);  
      //}

      return true;
    }
  });

function readURL(input, img) {    
    $this = this;
    if (input.files && input.files[0]) {   
      var reader = new FileReader();
      reader.onload = function(e) {
        img.attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);  

      return true;
    }
    return false;
  }
   
/*
    reverter = zone.find(dropcontrolrevert);
    hasChanged = readURL(this, img); 
    if(hasChanged === true)
    {
      reverter.removeClass('disabled');
    } else {
      reverter.addClass('disabled');
    }
*/
});

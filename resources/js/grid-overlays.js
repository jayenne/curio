

$(document).on("click", '[data-overlay]', function(event) { 
    var $this = $(this);
    var url = $this.data("url"); 
    var include = $this.data("include");
    var $overlay = $this.closest('.card').find('.overlay');
  
    if($overlay.hasClass('show')){
        $overlay.removeClass('show');
        $this.removeClass('on');
        return;
    }
    if(url == null ){
        $overlay.addClass('show');
        $this.addClass('on');
        return;       
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
       
    $.ajax({
        type: "GET",
        url: '/api/'+url,
        data: {
          include: include,
        },
        success: function(response) {
            $this.addClass('on');
            $overlay.html(response);
            $overlay.addClass('show');              
        },
        error:function(request, status, error) {
            console.log("ajax call went wrong:" + request.responseText);
        }
    });

});

$(document).on("click", '.overlay .close ', function(event) {
    var $this = $(this);
    $this.removeClass("show" ); 
    var $button  = $this.closest('.grid-item').find('[data-overlay]');
    $button.removeClass('on');             
});


var modalTrigger = null;

$('.modal').on('show.bs.modal', function (e) {
    // prevent under-page scrolling
    const $body = $('html');
    const top = $body.scrollTop();
    $body.css('position', 'fixed');
    $body.css('top', - top);

    // do modal stuff
    modalTrigger = $(e.relatedTarget); // Button that triggered the modal
    modalTrigger.addClass('on');
    modalTitle = modalTrigger.data('target-title');
    
    var $this = $(this);
    var url = modalTrigger.data('url');
        url.substring(0,1) == '/' ? '/api'+url : url = '/api/'+url;

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
        type: "GET",
        url: url,
        success: function(response) {
            $('.modal-content').html(response);
            $('.modal-dialog').find('[role="title"]').text(modalTitle);
            $this.modal('show');
            $this.addClass('on');
            
        },
        error:function(request, status, error) {
            toast = {
                'title' : 'Error',
                'subtitle' : 'just now',
                'content' : 'Your request failed with an '+status+'<br>Reason: '+error,
                'type' : 'error',
                'delay' : 3,
                'pause_on_hover' : false
            };
            $.toast(toast);
            console.log('[ajax-forms.js] ajax error response:',jqxhr.status);
            console.log("ajax call went wrong:" + request.responseText);
        }
    });
});

$('.modal').on('hide.bs.modal', function (e) {
    modalTrigger.removeClass('on');

    //relaest fixed scroll
    const $body = $('html');
    const offset = $body.offset().top;
    $body.css('position', '');
    $body.css('top', '');
    window.scrollTo(0, parseInt(offset || '0') * -1);
});

$('.modal').on('hidden.bs.modal', function (e) {
    $('.modal-body').html('');
});
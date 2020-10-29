
$('body').on("submit", '[data-ajax="true"]', function(e) { 
    e.preventDefault();

    console.log('Submit: ajax form');
    $this = $(this);
    console.log('this is:',$this);

    $form = $this[0];
    console.log('this form is:',$form);

    url = $this.attr('action');
    console.log('this url is: ',url);

    method = $this.attr('method');
    console.log('this method is: ',method);

    var enctype = $this.attr('enctype');
    console.log('this enctype is: ',enctype);

    var data = new FormData($form);
    console.log('data:',data);

    $onSuccess = $this.data('success');
    console.log('onSuccess:',$onSuccess);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
        type: method,
        url: url,
        data: data,
        enctype: enctype,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data, textStatus, xhr) {
            var status = xhr.status;
            var html = data.html;
            var success = data.success;
            var message = data.message;
            var $html = $( html );
            var toast = data.toast;

            if(toast != 'undefind'){
                $.toast(toast);
            }

            switch($onSuccess){
                case 'close-modal': $this.closest('.modal').modal('toggle');
                    console.log('success: closing modal',$this.closest('.modal'), response);
                    break;
                case 'reload-page': location.reload();
                    break;
            } 
        },
        error:function(request, status, error) {
            toast = {
                'title' : 'Error',
                'subtitle' : 'just now',
                'content' : 'Your request failed with an '+status+'<br>Reason: '+error,
                'type' : 'error',
                'delay' : -1,
                'pause_on_hover' : false
            };
            $.toast(toast);
            console.log('[ajax-forms.js] ajax error response:',request);
        }
    });
 
});
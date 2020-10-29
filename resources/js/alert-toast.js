// CATCH AJAX ERRORS AND ALERT THEM
$( document ).ajaxError(function( event, jqxhr, settings, thrownError ) {
    // handle any ajax error
    console.log('error status:',jqxhr.status);
    var title = 'Alert';
    var subtitle = 'Just now';
    var content = '';
    var type = 'error';
    var delay = -1;
    var pauseable = false;

    switch(jqxhr.status){
        case 202:
            title = 'Alert: no content';
            content = 'You`re good but there is not content.';
            delay = 3;
            break;
        case 403:
            title = 'Alert: Forbidden access';
            subtitle = 'Just now';
            content = 'You can`t have that Dave!';
            break;          
        case 401:
        case 419:
            title = 'Alert: Session Timeout';
            subtitle = 'Just now';
            content = 'Your current session has expired through lack of activiy. You will need to log back in to continue.';
            break;
        case 404:
            title = 'Alert: Page not found';
            subtitle = 'Just now';
            content = 'This is not the page your were looing for. Move along.';
            delay = 5;
            break;
        case 429:
            title = 'alert: Throtled';
            subtitle = 'Just now';
            content = 'Hey, slow down buddy!';
            var delay = 5;
            break;
        case 500:
            title = 'alert: Server error';
            subtitle = 'Just now';
            content = 'Okay, My bad!';
            break;
    }
    
    var toast = {
        'title' : title,
        'subtitle' : subtitle,
        'content' : content,
        'type' : type,
        'delay' : delay,
        'pause_on_hover' : pauseable
    };
    $.toast(toast);
    console.log('[alert-toast.js] ajax error response:',jqxhr.status);
});
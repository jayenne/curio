window.onload = function() {
    //jQuery test
    if (window.jQuery) {  
        // jQuery is loaded  
        console.log("jquery loaded:", jQuery.fn.jquery);
    } else {
        // jQuery is not loaded
        alert("jQuery not loaded");
    }
    //jQ-UI test
    // if (typeof jQuery.ui != 'undefined') {
    //     console.log("jQuery-UI loaded");
    // } else {
    //     console.log("jQuery-UI not loaded");
    // }
    //boostrap test
    var bootstrap_enabled = (typeof $().modal == 'function');
    if(bootstrap_enabled){
      console.log("Bootstrap enabled:");
    } else {
      console.log("bootstrap doesn`t work"); 
    }
    if(typeof(Popper) === 'undefined'){
        console.log('Popper doesn`t work');
    } else {
        console.log('Popper works');
    }

    if(typeof(Isotope) === 'undefined'){
        console.log('Isotope doesn`t work');
    } else {
        console.log('Isotope works');
    }
}
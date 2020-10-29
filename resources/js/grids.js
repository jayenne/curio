import Freezeframe from 'freezeframe';

$(document).ready(function(){
  
  const grid = '.grid';
  var $grid = $(grid);
  const griditem = '.grid-item';
  const status = '.loader';
  var draggies = [];
  var isDrag = false;

 function saveItems(sortOrder) {
  var index = $grid.data('index');
  console.log('Saving',sortOrder, 'board', index);
  $.ajax({
      url: '/api/b/ri/'+index,
      type: 'POST',
      data: {order : sortOrder, board_id : index},
      success: function(response){
            console.log('AJAX RESULT',response);
         }
   });
 }
  function orderItems() {
    var itemElems = $grid.packery('getItemElements');
    var order = [];
    $( itemElems ).each( function( i, itemElem ) {
      order.push( 
        $(itemElem).attr('tabindex')
      );
    });
    console.log('Ordering',order);
    return order;
  }

//PACKERY
  $( function() {
    $grid.packery({
    });
    $grid.packery( 'on', 'layoutComplete', function() {
      console.log('layout is complete');
    });
    $grid.on( 'dragItemPositioned', function(event, draggeditem) {
      console.log('packery position');
      //$grid.layout();
    });
  });
  //fit layout for expanding items
  $grid.on( 'click', griditem, function( event ) {
    var $item = $( event.currentTarget );
    // change size of item by toggling large class
    $item.toggleClass('col-md-8');
    if ( $item.is('.col-md-8') ) {
      // fit large item
      $grid.packery( 'fit', event.currentTarget );
    } else {
      // back to small, shiftLayout back
      $grid.packery('shiftLayout');
    }
  });

  $('.toggle-drag-button').on( 'click', function(e) {
    var method = isDrag ? 'disable' : 'enable';
    draggies.forEach( function( draggie ) {
      draggie[ method ]();
    });
    isDrag = !isDrag;
    // toglgle class
    $(griditem).toggleClass('draggable');
    $(this).parent('li').toggleClass('active');
    // toggle text
    var t = $(this).text();
    var tt = $(this).attr('data-toggletext');
    $(this).text(tt);
    $(this).attr('data-toggletext',t)
    // action
    if(isDrag == false) {
      var o = orderItems();
      saveItems(o);
      console.log('saving order', o);
    } else {
      //$grid.packery();
    }
  });

  function loadGrid(counter = 0, timeout = 3){
    // init Infinte Scroll
    var url = $grid.data('url');

    // SORTING
    var sortString = '';
    //var sortString = '&sort=random';

    // FILTERING
    var filterString = '';
    //filterString = filterString.concat('&filter[user]=1');
    //filterString = filterString.concat('&filter[test]=true');
    //console.log('filterstring: '+filterString);
    url.substring(0,1) == '/' ? url : url = '/'+url;
    
    $grid.infiniteScroll({
      path: function() {
        var pageNumber = (this.loadCount +1 );
        var p = '/api'+url+'?page=' + pageNumber + filterString + sortString; 
        return p
      },
      checkLastPage: false,
      scrollThreshold: 0,
      history:true,
      status: status
    });
    
    $grid.infiniteScroll('loadNextPage');
  } 

  $grid.on( 'append.infiniteScroll', function( event, response, path, items ) {
    console.log('Appended now');
  });

  $grid.on( 'scrollThreshold.infiniteScroll', function( event ) {
    console.log('Scroll threshold has been met');
  });

  $grid.on( 'request.infiniteScroll', function( event, path ) {
    console.log( 'Requesting page: ' + path );
  });

  $grid.on( 'load.infiniteScroll', function( event, response, path ) {
    console.log( 'Loaded: ' + path );
    var viewmode = 'layout-' + $grid.attr('data-layout') ? $grid.attr('data-layout') : 'default';
    var $items = $( response ).find('.grid-item');
    // layout Packery after each image loads

    $items.each( function( i, gridItem ) {
        var draggie = new Draggabilly( gridItem );
        draggie.disable();
        draggies.push( draggie );
        // bind drag events to Packery
        $grid.packery( 'bindDraggabillyEvents', draggie );
    });

    $grid.append( $items ).packery( 'appended', $items );

    $grid.imagesLoaded().progress( function() {
      //$grid.packery();
    });

    let gifs = new Freezeframe('.freezeframe', {
      overlay: true
    });

    // const vplayers = Array.from(document.querySelectorAll('video')).map(p => new Plyr(p));
    // const aplayers = Array.from(document.querySelectorAll('audio')).map(p => new Plyr(p));
    // window.vplayers = vplayers;
    // window.aplayers = aplayers;

  });
  //LAST PAGE
  $grid.on( 'last.infiniteScroll', function( event, response, path ) {
    console.log( 'Loaded Last: ' + path );
  });

  //EMPTY
  $grid.on( 'error.infiniteScroll', function( event, error, path ) {
    //split path on ? then append 'create'
    console.log('Error Loading: ');
    // console.log('Path: ', path );
    console.log( error );
    // console.log('404 Event: ', event  );
    $('.loader').addClass('footer');
    var msg = error.toString().replace('Error: ','');
    var url = path.substring(0, path.indexOf('?'))+'/?error='+msg;

    return getErrorResponse(url);   
  })

  function getErrorResponse(url){
    console.log('sending error to:',url)
    $.getJSON(url,function (data, textStatus, jqXHR){
        console.log('appending:',data.html);
        $grid.append(data.html);
    });
  }

  loadGrid();
});
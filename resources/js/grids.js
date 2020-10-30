import Freezeframe from 'freezeframe';

$(document).ready(function(){

  const grid = '.grid';
  var $grid = $(grid);
  const griditem = '.grid-item';
  const status = '.loader';
  var draggies = [];
  var isDrag = false;

  // get JSON-friendly data for items positions
  Packery.prototype.getShiftPositions = function( attrName ) {
    attrName = attrName || 'id';
    var _this = this;

    return this.items.map( function( item ) {
      return {
        i: item.element.getAttribute( attrName ),
        x: item.rect.x / _this.packer.width
      }
    });
  };

  Packery.prototype.initShiftLayout = function( positions, attr ) {
    if ( !positions ) {
      // if no initial positions, run packery layout
      this.layout();
      return;
    }
    // parse string to JSON
    if ( typeof positions == 'string' ) {
      try {
        positions = JSON.parse( positions );
      } catch( error ) {
        console.error( 'JSON parse error: ' + error );
        this.layout();
        return;
      }
    }
    
    attr = attr || 'id'; // default to id attribute
    this._resetLayout();
    // set item order and horizontal position from saved positions
    this.items = positions.map( function( itemPosition ) {
      console.log('itemPosition',itemPosition);
      var selector = '[' + attr + '="' + itemPosition.i  + '"]'

      var itemElem = this.element.querySelector( selector );
      var item = this.getItem( itemElem );
      item.rect.x = itemPosition.x * this.packer.width;
      return item;
    }, this );
    this.shiftLayout();
  };

 function savePositions() {
  var board_id = $grid.data('index');
  var positions = localStorage.getItem('dragPositions');
  if(board_id){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/api/b/ri',
        type: 'POST',
        data: {id : board_id, positions : positions},
        success: function(response){
              console.log('AJAX RESULT',response);
           }
     });
  }
 }


//PACKERY
  $( function() {
    $grid.packery({
      columnWidth: '.grid-sizer',
      percentPosition: true
    });
  });

  //fit layout for expanding items
  // $grid.on( 'click', griditem, function( event ) {
  //   var $item = $( event.currentTarget );
  //   // change size of item by toggling large class
  //   $item.toggleClass('col-md-8');
  //   if ( $item.is('.col-md-8') ) {
  //     // fit large item
  //     $grid.packery( 'fit', event.currentTarget );
  //   } else {
  //     // back to small, shiftLayout back
  //     $grid.packery('shiftLayout');
  //   }
  // });

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
      savePositions();
    } 
  });

  function loadGrid(counter = 0, timeout = 3){
    // init Infinte Scroll
    //localStorage.removeItem('dragPositions');

    var url = $grid.data('url');
        url.substring(0,1) == '/' ? url : url = '/'+url;

    var sortString = '';
    var filterString = '';
    
    $grid.infiniteScroll({
      path: function() {
        var pageNumber = (this.loadCount +1 );
        return '/api'+url+'?page=' + pageNumber + filterString + sortString; 
      },
      checkLastPage: false,
      scrollThreshold: 0,
      history:true,
      status: status,
    });
    
    $grid.infiniteScroll('loadNextPage');
  } 

  $grid.on( 'load.infiniteScroll', function( event, response, path ) {
    var viewmode = 'layout-' + $grid.attr('data-layout') ? $grid.attr('data-layout') : 'default';
    var $items = $( response ).find('.grid-item');
    localStorage.removeItem('dragPositions');

    //make draggable. initially disabled
    var positions = [];
    $items.each( function( i, gridItem ) {
        var draggie = new Draggabilly( gridItem );
        draggie.disable();
        draggies.push( draggie );
        $grid.packery( 'bindDraggabillyEvents', draggie );
        var index = gridItem.getAttribute('data-index');
        var x = gridItem.getAttribute('data-position');
        positions[i] = {'i':index, 'x':x};
    });
    $grid.append( $items ).packery( 'appended', $items );
    // set positons
    $grid.packery( 'initShiftLayout', positions, 'data-index' );
    //$grid.packery();
    // $grid.imagesLoaded().progress( function() {});

    let gifs = new Freezeframe('.freezeframe', {
      overlay: true
    });

    // const vplayers = Array.from(document.querySelectorAll('video')).map(p => new Plyr(p));
    // const aplayers = Array.from(document.querySelectorAll('audio')).map(p => new Plyr(p));
    // window.vplayers = vplayers;
    // window.aplayers = aplayers;

  });

    $grid.on( 'dragItemPositioned', function() {
      // save drag positions 
      var positions = $grid.packery( 'getShiftPositions', 'data-index' );
      localStorage.setItem( 'dragPositions', JSON.stringify( positions ) );
      //$grid.packery();
    });

  //LAST PAGE
  // $grid.on( 'last.infiniteScroll', function( event, response, path ) {
  //   console.log( 'Loaded Last: ' + path );
  // });

  //EMPTY
  $grid.on( 'error.infiniteScroll', function( event, error, path ) {
    //split path on ? then append 'create'
    console.log('Error Loading: ', error);
    // console.log('Path: ', path );
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
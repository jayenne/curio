import Freezeframe from 'freezeframe';

$(document).ready(function(){
  // count the duration the window is out of focus. then reload grid on re-focus after n seconds.
  var awayCount = 0;
  const refeshCount = 5;
  const grid = '.grid';
  const $grid = $(grid);
  const griditem = '.grid-item';
  const status = '.loader';

  function loadGrid(counter = 0, timeout = 3){
    
    console.log('counter:', counter, ' timeout:',timeout);
    if(counter >= timeout){
      console.log('loadGrid has timed-out - refreshing'); 
      /*
      $grid.packery('destroy');
      $grid.infiniteScroll('destroy');
      */
    }

    // init Isotope
    $grid.isotope({
     itemSelector: griditem,
     layoutMode: 'packery',
     percentPosition: false,
     gutterWidth: 0,
     stagger: 10,
     visibleStyle: { transform: 'translateY(0)', opacity: 1 },
     hiddenStyle: { transform: 'translateY(100px)', opacity: 0 },
     getSortData: {
       date: '.date',
       curator: '.curator',
       category: '.category',
       hashtag: '.hashtag',
       datacategory: '[data-category]',
       weight: function( itemElem ) {
         var weight = $( itemElem ).find('.weight').text();
         return parseFloat( weight.replace( /[\(\)]/g, '') );
       }
     }
    }); 
    // get Packery instance
    var $pkry = $grid.data('packery');

    // init Infinte Scroll
    var url = $grid.data('url');

    // SORTING
    var sortString = '';
    //var sortString = '&sort=random';

    // FILTERING
    var filterString = '';
    //filterString = filterString.concat('&filter[user]=1');
    //filterString = filterString.concat('&filter[test]=true');
    console.log('filterstring: '+filterString);
    url.substring(0,1) == '/' ? url : url = '/'+url;
    
    $grid.infiniteScroll({
      path: function() {
        var pageNumber = (this.loadCount +1 );
        var p = '/api'+url+'?page=' + pageNumber + filterString + sortString; 
        return p
      },
      checkLastPage: false,
      scrollThreshold: 400,
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
      $items.each(function( index){
        $(this).removeClass (function (index, className) {
          return (className.match (/\blayout-\S+/g) || []).join(' ');
        }).addClass( viewmode );
      });
      // append items after images loaded
      $items.imagesLoaded( function() {
        $grid.append( $items );
        $grid.isotope( 'insert', $items );
        let gifs = new Freezeframe('.freezeframe', {
          overlay: true
        });

        const vplayers = Array.from(document.querySelectorAll('video')).map(p => new Plyr(p));
        const aplayers = Array.from(document.querySelectorAll('audio')).map(p => new Plyr(p));
        window.vplayers = vplayers;
        window.aplayers = aplayers;
      });
  });
  //LAST PAGE
  $grid.on( 'last.infiniteScroll', function( event, response, path ) {
   console.log( 'Loaded Last: ' + path );
   //console.log('Event: ', event  );
   //console.log('Responce: ', response  );
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

  function awayTimer(counter){
    setInterval(function(){
      counter++;
      awayCount = counter; 
    },1000);
  }

  // detect browser windoe focus/blur
  function onVisibilityChange(callback) {
      var visible = true;
      var duration = 0.0;

      if (!callback) {
          throw new Error('no callback given');
      }

      function focused() {
          if (!visible) {
              callback(visible = true);
          }
      }

      function unfocused() {
          if (visible) {
              callback(visible = false);
          }
      }

      // Standards:
      if ('hidden' in document) {
          document.addEventListener('visibilitychange',
              function() {(document.hidden ? unfocused : focused)()});
      }
      if ('mozHidden' in document) {
          document.addEventListener('mozvisibilitychange',
              function() {(document.mozHidden ? unfocused : focused)()});
      }
      if ('webkitHidden' in document) {
          document.addEventListener('webkitvisibilitychange',
              function() {(document.webkitHidden ? unfocused : focused)()});
      }
      if ('msHidden' in document) {
          document.addEventListener('msvisibilitychange',
              function() {(document.msHidden ? unfocused : focused)()});
      }
      // IE 9 and lower:
      if ('onfocusin' in document) {
          document.onfocusin = focused;
          document.onfocusout = unfocused;
      }
      // All others:
      window.onpageshow = window.onfocus = focused;
      window.onpagehide = window.onblur = unfocused;
  };

  onVisibilityChange(function(visible) {
         
    console.log('the page is now', visible ? 'focused' : 'unfocused');
    
    switch(visible){
      case false : awayTimer(0)
        break;
      case true: 
            console.log('awayCount:', awayCount);
            loadGrid(awayCount, refeshCount);
            clearInterval(awayCount); 
        break;
    }
  });

  // layout fns
  var isHorizontal = false;
  var $window = $( window );
  $('[data-layout="modes"]').on( 'click', 'a', function() {
    // adjust container sizing if layout mode is changing from vertical or horizontal
    var $this = $(this);
    var isHorizontalMode = !!$this.attr('data-is-horizontal');
    var viewmode = 'layout-'+$this.attr('data-layout-mode')
    $grid.attr('data-layout', viewmode);

    $(griditem).removeClass (function (index, className) {
      return (className.match (/\blayout-\S+/g) || []).join(' ');
    }).addClass( viewmode);
    
    if ( isHorizontal !== isHorizontalMode ) {
      // change container size if horiz/vert change
      var containerStyle = isHorizontalMode ? {
        height: $window.height() * 0.7,
      } : {
        width: 'auto'
      };
      $grid.css( containerStyle );
      isHorizontal = isHorizontalMode;
    }
    // change layout mode
    var layoutModeValue = $this.attr('data-layout-mode');
    $grid.isotope({ layoutMode: layoutModeValue });
  });  

  // filter functions
  var filterFns = {
    // show if number is greater than 50
    numberGreaterThan50: function() {
      var number = $(this).find('.number').text();
      return parseInt( number, 10 ) > 50;
    },
    // show if name ends with -ium
    ium: function() {
      var name = $(this).find('.name').text();
      return name.match( /ium$/ );
    }
  };

  // bind filter button click
  $('#filters').on( 'click', 'button', function() {
    var filterValue = $( this ).attr('data-filter');
    // use filterFn if matches value
    filterValue = filterFns[ filterValue ] || filterValue;
    $grid.isotope({ filter: filterValue });
  });

  // bind sort button click
  $('#sorts').on( 'click', 'button', function() {
    var sortByValue = $(this).attr('data-sort-by');
    $grid.isotope({ sortBy: sortByValue });
  });

  // change is-checked class on buttons
  $('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $( this ).addClass('is-checked');
    });
  });

  // init Grid/Packery
  loadGrid();
});
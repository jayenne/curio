// GENERAL PLATFORM FUNCTIONS
function nFormatter(num, digits) {
  var si = [
    { value: 1E18, symbol: "Q" },
    { value: 1E15, symbol: "q" },
    { value: 1E12, symbol: "t" },
    { value: 1E9,  symbol: "B" },
    { value: 1E6,  symbol: "M" },
    { value: 1E3,  symbol: "k" }
  ], i;
  for (i = 0; i < si.length; i++) {
    if (num >= si[i].value) {
      return (num / si[i].value).toFixed(digits).replace(/\.?0+$/, "") + si[i].symbol;
    }
  }
  return num;
}

$(document).on("click", '[data-action]', function(e) { 
    e.preventDefault();
    e.stopPropagation();

    var $this = $(this);
    $this.prop('disabled', true);

    var action = $this.data('action');
    var type = $this.data('type');
    var id = $this.data('id');
    var url = $this.data('url');
        url.substring(0,1) == '/' ? '/api'+url : url = '/api/'+url;    
    var data = {
      action : action,
      type: type,
      id: id,
    };

    var $item = $this.closest('.card');

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type:'POST',
      data: data,
      url: url,
      success: function(data) {
        var count = data.totals.count ? data.totals.count: 0;
        var weight = data.totals.weight ? data.totals.count : null ;

        var count_string = nFormatter(count, 1);
        var $parent = $item.closest('.grid-item');
        //set counts & wieghts
        $parent.data('total-weight', weight);
        $parent.data('total-count', count);

        // set count_string
        $parent.find('[data-acted="'+action+'"]').each(function(){
          $(this).html(count_string);
        });

        //set reacted class
        if(data.totals.reacted == true){
          $this.addClass('on');
        } else {
          $this.removeClass('on');
        }
      },
      error:function(request, status, error) {
        console.log("actions ajax call went wrong:" + request.responseText);
        console.log("action url:"+ url);
      }
    }).done(function() {
        $this.prop('disabled', false);
    });
});
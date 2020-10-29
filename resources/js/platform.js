window.onload = function() {
  // BOOTSTRAP
  $('body').tooltip({
      selector: '[data-toggle="tooltip"]'
  });

  // BS$-TOAST
  $(document).on('hidden.bs.toast', '.toast', function (e) {
    $(this).remove();
  });

};
// GENERAL PLATFORM FUNCTIONS

/*
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
*/

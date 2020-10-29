$(document).ready(function () {

	$(document).on("click", '[data-to]', function(e) { 
		$this = $(this);
		url = $this.attr('data-to');
		
		if($this[0].hasAttribute('target')){
			target = $this.attr('target');
			window.open( url , target);
		} else {
			window.location = url ;
		}
	});
	// STICKY
	// get the sticky element thne add .isStuck once it is stuck.
	const stickyElm = document.querySelector('.sticky-top')

	const observer = new IntersectionObserver( 
	  ([e]) => e.target.classList.toggle('isStuck', e.intersectionRatio < 1),
	  {threshold: [1]}
	);

	observer.observe(stickyElm)
});
jQuery(document).on("click", function() {
    jQuery("#sidenav, #header-wrap").addClass('sidenav-idle');	
});

jQuery("#sidenav, #menu-toggle").on("click, mouseenter", function(event) {
	jQuery("#sidenav, #header-wrap").removeClass('sidenav-idle');
	event.stopPropagation();
});


jQuery(document).foundation();


// http://www.thecssninja.com/javascript/pointer-events-60fps
var body = document.body,
    timer;

window.addEventListener('scroll', function() {
  clearTimeout(timer);
  if(!body.classList.contains('disable-hover')) {
    body.classList.add('disable-hover')
  }
  
  timer = setTimeout(function(){
    body.classList.remove('disable-hover')
  },500);
}, false);
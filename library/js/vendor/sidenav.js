jQuery(document).on("click", function() {
    jQuery("#sidenav, #header-wrap").addClass('sidenav-idle');	
});

jQuery("#sidenav, #menu-toggle").on("click, mouseenter", function(event) {
	jQuery("#sidenav, #header-wrap").removeClass('sidenav-idle');
	event.stopPropagation();
});


jQuery(document).foundation();
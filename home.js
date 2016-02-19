(function () {
	// Open links based on number pressed (0-8)
	document.onkeypress = function ( evt ) {
		var href = '',
		    linksChildren = document.getElementsByClassName('links')[0].children;

		if (evt.keyCode == 49) {
			href = linksChildren[0].children[0].href;
		}
		if (evt.keyCode == 50) {
			href = linksChildren[1].children[0].href;
		}
		if (evt.keyCode == 51) {
			href = linksChildren[2].children[0].href;
		}
		if (evt.keyCode == 52) {
			href = linksChildren[3].children[0].href;
		}
		if (evt.keyCode == 53) {
			href = linksChildren[4].children[0].href;
		}
		if (evt.keyCode == 54) {
			href = linksChildren[5].children[0].href;
		}
		if (evt.keyCode == 55) {
			href = linksChildren[6].children[0].href;
		}
		if (evt.keyCode == 56) {
			href = linksChildren[7].children[0].href;
		}
		if (evt.keyCode == 57) {
			href = linksChildren[8].children[0].href;
		}
		if (evt.keyCode == 58) {
			href = linksChildren[9].children[0].href;
		}

		if( href ) {
			window.open( href, '_blank' );
		}
	};
})();

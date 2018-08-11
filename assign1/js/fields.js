var selectHandlers = document.getElementsByClassName('field-type');

for (var i=0; i < selectHandlers.length; i++) {
	selectHandlers[i].addEventListener('change', function() {
		// slice(-1) gets the last character
		checkOptional(this,this.id.slice(-1));
	});
}

function checkOptional(option,Id) {
	var radios = document.getElementsByClassName('radio' + Id);
	var checkboxes = document.getElementsByClassName('checkbox' + Id);

	if (option.value == 'checkbox') {

		// display checkbox's option and hide radio options
		for (var i=0; i < radios.length; i++) {
			radios[i].style.display = "none";
		}

		for (var i=0; i < checkboxes.length; i++) {
			checkboxes[i].style.display = "block";
		}
	}

	else if (option.value == 'radio') {

		// display radio's option and hide checkbox options
		for (var i=0; i < radios.length; i++) {
			radios[i].style.display = "block";
		}

		for (var i=0; i < checkboxes.length; i++) {
			checkboxes[i].style.display = "none";
		}
	}

	else {
		// displays to none
		for (var i=0; i < radios.length; i++) {
			radios[i].style.display = "none";
		}

		for (var i=0; i < checkboxes.length; i++) {
			checkboxes[i].style.display = "none";
		}

	}
}


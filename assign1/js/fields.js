var selectHandlers = document.getElementsByClassName('field-type');
var addHandlers = document.getElementsByClassName('add-option');
var removeHandlers = document.getElementsByClassName('remove-option');

for (var i=0; i < selectHandlers.length; i++) {

	selectHandlers[i].addEventListener('change', function() {
		// slice(-1) gets the last character
		checkOptional(this,this.id.slice(-1));
	});

	addHandlers[i].addEventListener('click', function() {
		addOption(this.id.slice(-1));
	});

	removeHandlers[i].addEventListener('click', function() {
		removeOption(this.id.slice(-1));
	});

}

function checkOptional(option,Id) {
	var radios = document.getElementsByClassName('radio' + Id);
	var checkboxes = document.getElementsByClassName('checkbox' + Id);
	var addButton = document.getElementById('add' + Id);
	var removeButton = document.getElementById('remove' + Id);

	if (option.value == 'checkbox') {

		// display checkbox's option and hide radio options
		for (var i=0; i < radios.length; i++) {
			radios[i].style.display = "none";
		}

		for (var i=0; i < checkboxes.length; i++) {
			checkboxes[i].style.display = "block";
		}

		addButton.style.display = "block";
		removeButton.style.display = "block";
	}

	else if (option.value == 'radio') {

		// display radio's option and hide checkbox options
		for (var i=0; i < radios.length; i++) {
			radios[i].style.display = "block";
		}

		for (var i=0; i < checkboxes.length; i++) {
			checkboxes[i].style.display = "none";
		}

		addButton.style.display = "block";
		removeButton.style.display = "block";
	}

	else {
		// displays to none
		for (var i=0; i < radios.length; i++) {
			radios[i].style.display = "none";
		}

		for (var i=0; i < checkboxes.length; i++) {
			checkboxes[i].style.display = "none";
		}

		addButton.style.display = "none";
		removeButton.style.display = "none";

	}
}

function addOption(id) {
	var type = document.getElementById('field_type' + id).value;

	if (type == 'checkbox') {
		var original = document.getElementById('checkbox' + id);
	}
	
	else if (type == "radio") {
		var original = document.getElementById('radio' + id);
	}

	else {
		return;
	}

	var clone = original.cloneNode(true);
	clone.lastElementChild.value = "";   // dom manipulation
	original.parentNode.appendChild(clone);
}

function removeOption(id) {
	var type = document.getElementById('field_type' + id).value;

	if (type == 'checkbox') {
		var node = document.getElementById('checkbox' + id);
	}

	else if (type == 'radio') {
		var node = document.getElementById('radio' + id);
	}

	else {
		return;
	}
	
	var count = node.parentNode.childElementCount;
	if (count == 1) {
		return;
	}

	node.parentNode.removeChild(node.parentNode.childNodes[count -1 ]);
}


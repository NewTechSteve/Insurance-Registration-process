// script.js


function validateForm() {
    var form = document.getElementById('personal-info-form');
    if (form.checkValidity()) {
        // Proceed to the next page or perform other actions
        console.log('Form is valid');
    } else {
        // Display error messages
        form.reportValidity();
    }
}


function loadPage(pageId, file) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(pageId).innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", file, true);
    xhttp.send();
}



// Store form data
var formData = {};

function prevPage(pageId, file) {
    document.getElementById(pageId).classList.remove('show');
    loadPage(pageId, file);
    document.getElementById(pageId).classList.add('show');
}


function nextPage(pageId, file) {
    var form = document.getElementById(pageId).querySelector('form');
    var inputs = form.querySelectorAll('input, textarea, select');

    var isValid = true;

    inputs.forEach(function(input) {
        if (input.hasAttribute('required') && !input.value.trim()) {
            isValid = false;
            var errorElement = document.createElement('span');
            errorElement.textContent = 'Please fill all the fields!!!.';
            errorElement.className = 'error';
            var parent = input.parentElement;
            if (parent.querySelector('.error') === null) {
                parent.appendChild(errorElement);
            }
        }
    });

    if (isValid) {
        loadPage(pageId, file);
        document.getElementById(pageId).classList.add('show');
    } else {
        alert('Please fill in all required fields.');
    }
}


// Listen for Enter key press
document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        var nextButton = document.querySelector('.next-button:not([disabled])');
        if (nextButton) {
            nextButton.click();
        }
    }
});



// Load the first page
loadPage('content', 'bio_data.html');
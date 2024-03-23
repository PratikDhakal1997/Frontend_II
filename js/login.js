$(document).ready(function() {
    // Initialize datepicker with specific options
    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd", // Set date format to YYYY-MM-DD
        changeYear: true, // Enable changing the year
        changeMonth: true, // Enable changing the month
        yearRange: "1950:2008" // Limit the year range from 1950 to 2008
    });

    // Form submission handler
    $("#signUpForm").on("submit", function(e) {
        // Perform HTML5 validation check
        if (this.checkValidity()) {
            // Initialize jQuery validation
            $(this).validate({
                rules: {
                    email: {
                        required: true,
                        email: true // Ensure the input is a valid email address
                    },
                    mySelect: {
                        required: true // Ensure a selection is made
                    }
                },
                messages: {
                    email: {
                        required: "Please enter an email address",
                        email: "Please enter a valid email address"
                    },
                    mySelect: {
                        required: "Please select your gender"
                    }
                },
                errorPlacement: function(error, element) {
                    // Custom placement for error messages
                    if (element.attr("name") == "email") {
                        error.appendTo("#email_error");
                    } else if (element.attr("name") == "mySelect") {
                        error.appendTo("#gender_error");
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            // Prevent form submission if validation fails
            if (!$(this).valid() || !check()) {
                e.preventDefault();
            }
        } else {
            // Prevent form submission if HTML5 validation fails
            e.preventDefault();
        }
    });
});

// Toggle between sign-in and sign-up modes
const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

// Switch to sign-up mode
sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
});

// Switch to sign-in mode
sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
});

// Function to check if passwords match
var check = function() {
    if (document.getElementById('password').value ==
        document.getElementById('confirm_password').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = '✔';
        return true;
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = '✗';
        return false;
    }
};

// Function to validate email format
var emailCheck = function() {
    var email = document.getElementById('Email').value;
    var regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/; // Regex for email validation
    
    if (regex.test(email)) {
        document.getElementById('emailMessgage').innerHTML = '';
        return true;
    } else {
        document.getElementById('emailMessgage').style.color = 'red';
        document.getElementById('emailMessgage').innerHTML = 'Enter Valid Email Format';
        return false;
    }
};

// Function to validate password length
var passwordCheck = function() {
    var password = document.getElementById('pswd').value;
    var regex = /^.{8,}$/; // Regex for minimum 8 characters

    if (regex.test(password)) {
        document.getElementById('passwordMessgage').innerHTML = '';
        return true;
    } else {
        document.getElementById('passwordMessgage').style.color = 'red';
        document.getElementById('passwordMessgage').innerHTML = 'length should be 8 digit long';
        return false;
    }
};

// Form submission validation for sign-in form
document.getElementById('signForm').addEventListener('submit', function(event) {
    var isEmailValid = emailCheck();
    var isPasswordValid = passwordCheck();

    if (!isEmailValid || !isPasswordValid) {
        event.preventDefault(); // Prevent form submission if validation fails
    }
});

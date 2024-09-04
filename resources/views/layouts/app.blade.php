<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="{{ asset('style/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('style/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('style/model.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css">
    @yield('head')
</head>
<body>
    <header>
        <nav class="navbar">
             <a href="{{url('/')}}" class="navbar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                <span class="brand-name">Ej Education</span>
            </a>
            <ul class="navbar-menu" id="navbar-menu">
                <li><a href="{{url('videos')}}">Video</a></li>
                <li><a href="{{url('books')}}">Books</a></li>
                <li><a href="javascript:void(0);" onclick="scrollToSection('opportunities')">Our Services</a></li>
                <li><a href="javascript:void(0);" onclick="scrollToSection('market')">Market Research</a></li>
                <li><a href="javascript:void(0);" onclick="scrollToSection('faq')">FAQ</a></li>
            </ul>
            <div class="navbar-account">
                @if(Auth::check())
                <!-- Show 'Account' and 'Logout' if the user is logged in -->
                <a href="{{ url('profile') }}">Account</a>
                <a href="{{ route('logout') }}" class="logout-link">
                    <img src="{{ asset('images/logout.svg') }}" alt="Logout Icon" class="logout-icon">
                </a>
            @else
                <!-- Show 'My Account' if the user is not logged in -->
                <a href="javascript:void(0);" class="account-link" id="account-link">My Account</a>
                <img src="{{ asset('images/user.svg') }}" alt="Account Icon" class="account-icon">
            @endif
            </div>
            <div class="navbar-toggle" id="navbar-toggle">
                <img src="{{ asset('images/burger-open.svg') }}" alt="Menu" id="burger-icon">
            </div>
            <div class="mobile-menu" id="mobile-menu">
                <div class="mobile-menu-header">
                    <span>Menu</span>
                    <img src="{{ asset('images/burger-close.svg') }}" alt="Close" id="close-icon">
                </div>
                <ul class="mobile-menu-list">
                    <li><a href="{{url('videos')}}">Video</a></li>
                    <li><a href="{{url('books')}}">Books</a></li>
                    <li><a href="javascript:void(0);" onclick="scrollToSection('opportunities')">Our Services</a></li>
                    <li><a href="javascript:void(0);" onclick="scrollToSection('market')">Market Research</a></li>
                    <li><a  href="javascript:void(0);" onclick="scrollToSection('faq')">FAQ</a></li>
                    @if(Auth::check())
                    <li><a href="{{url('profile')}}">Profile</a></li>
                    <li><a href="{{route('logout')}}">Logout</a></li>
                    @else
                    <li><a href="javascript:void(0);" class="account-link" id="account-link">My Account</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>
    <div class="menu-overlay" id="menu-overlay"></div>


    <main>
        @yield('content')
    </main>

<!-- Modal Structure -->
<div class="modal" id="account-modal">
    <div class="modal-content">

        <!-- Login Form -->
        <div class="login-form" id="login-form">
            <h2>Welcome to FJ
                <img src="{{ asset('images/burger-close.svg') }}" class="model-close" alt="Close" id="close-btn">
            </h2>
             <!-- Error Message Alert -->
             <div id="error-alert" class="alert alert-danger" style="display: none;">
                <span id="error-message"></span>
                <span class="close-btn" id="close-alert" style="cursor: pointer;">&times;</span>
            </div>
            <!-- Form Section -->
            <form id="loginForm">
                <label for="email">Email</label>
                <div class="input-group">
                    <img src="{{ asset('images/email.png') }}" alt="Email Icon" class="icon">
                    <input type="email" id="email" name="email" value="tech@fujtown.com" required>
                </div>

                <label for="password">Password</label>
                <div class="input-group">
                    <img src="{{ asset('images/lock.png') }}" alt="Password Icon" class="icon">
                    <input type="password" id="password" name="password" value="********" required>
                </div>
                <div id="loading-spinner" style="display: none;">
                    <!-- You can replace this with any spinner/loading animation -->
                    <img src="{{ asset('images/spinner.gif') }}" alt="Loading..." />
                </div>
                <button type="submit" class="btn">Sign in</button>
            </form>




            <!-- Links Section -->
            <div class="links">
                <a href="javascript:void(0);" id="show-signup">No account? <strong>Sign up</strong></a>
                <a href="javascript:void(0);" id="show-passreset" class="forgot-password">Forgot password</a>
            </div>
        </div>

        <!-- Signup Form -->
        <div class="signup-form" id="signup-form" style="display: none;">
            <h2>Create an account
                <img src="{{ asset('images/burger-close.svg') }}" class="model-close" alt="Close" id="close-btn-signup">
            </h2>
            <!-- Error Alert -->
             <div id="error-alert-signup" class="alert alert-danger" style="display: none;">
                <span id="error-message-signup">User with this email already exists.</span>
                <span class="close-btn" id="close-alert-signup" style="cursor: pointer;">&times;</span>
            </div>
            <!-- Form Section -->
            <form id="signupForm">
                <label for="name">Your name</label>
                <div class="input-group">
                    <img src="{{ asset('images/name.png') }}" alt="User Icon" class="icon">
                    <input type="text" id="name" name="name" value="" >
                </div>
                <span class="error-message" id="error-name"></span>
                <label for="last-name">Your last name</label>
                <div class="input-group">
                    <img src="{{ asset('images/name.png') }}" alt="User Icon" class="icon">
                    <input type="text" id="last-name" name="last-name" value="" required>
                </div>
                <span class="error-message" id="error-last-name"></span>
                <label for="signup-email">Email</label>
                <div class="input-group">
                    <img src="{{ asset('images/email.png') }}" alt="Email Icon" class="icon">
                    <input type="email" id="signup-email" name="signup-email" value="" required>
                </div>
                <span class="error-message" id="error-email"></span>

                <label for="signup-address">Address</label>
                <div class="input-group">
                    <img src="{{ asset('images/address.png') }}" alt="Address Icon" class="icon">
                    <textarea name="address" id="address" cols="10" rows="3"></textarea>
                </div>
                <span class="error-message" id="error-address"></span>
                <label for="signup-address">Select Country</label>
                <div class="input-group">
                    <select name="country" required class="countries" id="countries">
                        <option value="">countries</option>
                      </select>
                </div>
                <span class="error-message" id="error-country"></span>
                <label for="signup-address">Select State</label>
                <div class="input-group">
                    <select name="city"  class="state" id="state" required>
                        <option value="">States </option>
                    </select>
                </div>
                <span class="error-message" id="error-state"></span>

                <label for="phone">Phone number</label>
                <div class="input-group">
                    <img src="{{ asset('images/phone.png') }}" alt="Phone Icon" class="icon">
                    <input type="text" id="phone" name="phone" value="" required>
                </div>
                <span class="error-message" id="error-phone"></span>
                <label for="signup-password">Password</label>
                <div class="input-group">
                    <img src="{{ asset('images/lock.png') }}" alt="Password Icon" class="icon">
                    <input type="password" id="signup-password" name="signup-password" value="" required>
                </div>
                <span class="error-message" id="error-password"></span>
                <label for="referral-code">Referral code</label>
                <div class="input-group">
                    <img src="{{ asset('images/name.png') }}" alt="Referral Icon" class="icon">
                    <input type="text" id="referral-code" name="referral-code">
                </div>
                <span class="error-message" id="error-referral-code"></span>

                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to <a href="#">terms and conditions</a></label>
                </div>
                <span class="error-message" id="error-terms"></span>
                <button type="submit" class="btn">Sign up</button>
            </form>


            <div class="links">
                <a href="javascript:void(0);" class="show-login" id="show-login">Already have an account? <strong>Sign in</strong></a>
            </div>
        </div>

           <!-- Login Form -->
           <div class="passwordreset-form" id="passwordreset-form">
            <h2>Recover password
                <img src="{{ asset('images/burger-close.svg') }}" class="model-close" alt="Close" id="close-btn">
            </h2>
             <!-- Error Message Alert -->
             <div id="error-alert" class="alert alert-danger" style="display: none;">
                <span id="error-message"></span>
                <span class="close-btn" id="close-alert" style="cursor: pointer;">&times;</span>
            </div>
            <!-- Form Section -->
            <form id="passwordResetForm">
                <label for="email">Email</label>
                <div class="input-group">
                    <img src="{{ asset('images/email.png') }}" alt="Email Icon" class="icon">
                    <input type="email" id="email" name="email" value="tech@fujtown.com" required>
                </div>

                <button type="submit" class="btn">Next</button>
            </form>
            <!-- Placeholder for success message -->
        <div id="successMessage" style="display: none; color: #00BCD4; font-weight: bold;"></div>
            <!-- Links Section -->
            <div class="links" id="reset-link" style="flex-direction: column;">
                <p>Remember acccess?</p>
                <a  href="javascript:void(0);" class="show-login" id="show-login"><strong>Sign in</strong></a>
            </div>
        </div>


    </div>
</div>

    <footer class="footer-section">
        <div class="payment-icons">
            <img src="{{ asset('images/visa.png') }}" alt="Visa" class="icon">
            <img src="{{ asset('images/mc.png') }}" alt="MasterCard" class="icon">
            <img src="{{ asset('images/pci.png') }}" alt="PCI DSS" class="icon">
        </div>
        <div class="footer-links">
            <a href="mailto:info@fjeducation.com">Contact Us</a>
            <a href="{{url('privacy')}}">Privacy Policy</a>
            <a href="{{url('cookie')}}">Cookie Policy</a>
            <a href="{{url('terms')}}">Terms and Conditions</a>
        </div>
        <div class="footer-address">
            <p>LLM Media Ltd</p>
            <p>27 Old Gloucester Street, London, WC1N 3AX, United Kingdom.</p>
            <p>2024 © All rights reserved.</p>
        </div>
    </footer>
    <script>
        document.getElementById('navbar-toggle').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            var overlay = document.getElementById('menu-overlay');
            var burgerIcon = document.getElementById('burger-icon');

            menu.classList.add('active');
            overlay.classList.add('active');
            burgerIcon.src = "{{ asset('images/burger-close.svg') }}";
        });

        document.getElementById('close-icon').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            var overlay = document.getElementById('menu-overlay');
            var burgerIcon = document.getElementById('burger-icon');

            menu.classList.remove('active');
            overlay.classList.remove('active');
            burgerIcon.src = "{{ asset('images/burger-open.svg') }}";
        });

        document.getElementById('menu-overlay').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            var overlay = document.getElementById('menu-overlay');
            var burgerIcon = document.getElementById('burger-icon');

            menu.classList.remove('active');
            overlay.classList.remove('active');
            burgerIcon.src = "{{ asset('images/burger-open.svg') }}";
        });

        function scrollToSection(sectionId) {
    const currentPage = window.location.pathname;
    const homePage = "{{ url('/') }}";  // Your home page URL is '/'

    // Check if we are already on the home page
    if (currentPage === '/' || currentPage === '/home') {
        // If already on the home page, scroll to the section directly
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    } else {
        // If we are not on the home page, redirect to the home page
        // Save the target section to sessionStorage
        sessionStorage.setItem('scrollToSection', sectionId);

        // Redirect to the home page
        window.location.href = homePage;
    }
}

// When the page loads, check if there's a section we need to scroll to
window.addEventListener('load', function() {
    const targetSection = sessionStorage.getItem('scrollToSection');

    // If a section is stored in sessionStorage, scroll to it
    if (targetSection) {
        const section = document.getElementById(targetSection);
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }

        // Clear the sessionStorage item after scrolling
        sessionStorage.removeItem('scrollToSection');
    }
});


document.addEventListener('DOMContentLoaded', function () {
    // Get elements
    const modal = document.getElementById("account-modal");
    const accountLinks = document.querySelectorAll(".account-link");
    const closeBtns = document.querySelectorAll(".model-close"); // Handles both close buttons
    const mobileMenu = document.getElementById("mobile-menu");
    const overlay = document.getElementById("menu-overlay");
    const loginForm = document.getElementById("login-form");
    const signupForm = document.getElementById("signup-form");
    const passresetForm = document.getElementById("passwordreset-form");

    // Get buttons to switch between forms
    const showPassreset = document.getElementById("show-passreset");
    const showSignup = document.getElementById("show-signup");
    const showLogin = document.querySelectorAll(".show-login");

    // Function to open the modal and show login form
    function openModal() {
        modal.style.display = "flex";
        document.body.style.overflow = "hidden";

        if (window.innerWidth <= 768) {
            mobileMenu.style.display = "none";
            overlay.classList.remove('active');
        }
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
        document.body.style.overflow = "auto";

        if (window.innerWidth <= 768) {
            mobileMenu.style.display = "block";
        }
    }

    // Function to switch to the signup form
    function switchToSignup() {
        loginForm.style.display = "none";
        signupForm.style.display = "block";
        passresetForm.style.display = "none";
    }

    // Function to switch to the login form
    function switchToLogin() {
        signupForm.style.display = "none";
        loginForm.style.display = "block";
        passresetForm.style.display = "none";
    }
    function swtichToPassreset() {
        signupForm.style.display = "none";
        loginForm.style.display = "none";
        passresetForm.style.display = "block";
    }

    // Add event listeners to all "My Account" links
    accountLinks.forEach(accountLink => {
        accountLink.addEventListener('click', function () {
            openModal();
            switchToLogin(); // Default to showing the login form when opening
        });
    });

    // Event listener for close buttons
    closeBtns.forEach(btn => {
        btn.addEventListener('click', closeModal);
    });

    // Close modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Close modal when pressing "Escape" key
    window.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && modal.style.display === "flex") {
            closeModal();
        }
    });

    // Event listeners to switch between forms
    showSignup.addEventListener('click', switchToSignup);
    showLogin.forEach(btn => {
        btn.addEventListener('click', switchToLogin);
    });
    // showLogin.addEventListener('click', switchToLogin);
    showPassreset.addEventListener('click', swtichToPassreset);
});


    </script>

    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Toastify JS -->
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    $(document).ready(function() {
        $('#signupForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            $('.error-message').text(''); // Clear previous error messages

            // Perform client-side validation
            let hasErrors = false;

            let name = $('#name').val().trim();
            let lastName = $('#last-name').val().trim();
            var address = $('#address').val();
            let email = $('#signup-email').val().trim();
            let country = $('#countries').val();
            let city = $('#state').val();
            let phone = $('#phone').val().trim();
            let password = $('#signup-password').val().trim();
            let terms = $('#terms').is(':checked');
            // console.log(country);
            // Simple client-side validation logic
            if (name === '') {
                $('#error-name').text('Name is required.');
                hasErrors = true;
            }

            if (lastName === '') {
                $('#error-last-name').text('Last name is required.');
                hasErrors = true;
            }
            if (country === '') {
                $('#error-country').text('Country is required.');
                hasErrors = true;
            }
            if (state === '') {
                $('#state-name').text('State is required.');
                hasErrors = true;
            }

            if (email === '' || !validateEmail(email)) {
                $('#error-email').text('A valid email is required.');
                hasErrors = true;
            }

            if (phone === '') {
                $('#error-phone').text('Phone number is required.');
                hasErrors = true;
            }

            if (password === '' || password.length < 8) {
                $('#error-password').text('Password must be at least 8 characters long.');
                hasErrors = true;
            }

            if (!terms) {
                $('#error-terms').text('You must agree to the terms.');
                hasErrors = true;
            }

            // If no errors, proceed with the AJAX submission
            if (!hasErrors) {
                let formData = {
                    name: name,
                    last_name: lastName,
                    email: email,
                    address: address,
                    country: country,
                    city: city,
                    phone: phone,
                    password: password,
                    referral_code: $('#referral-code').val().trim(),
                    terms: terms
                };

                // Send AJAX request
                $.ajax({
                    type: 'POST',
                    url: '{{ route('sign-up') }}',
                    data: formData,
                    dataType: 'json',
                    headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for security
                },
                        success: function(response) {
                        // If the registration is successful, close the modal
                    $('#account-modal').hide();

                    // Show success Toastify message
                    Toastify({
                        text: "Successfully! Check your email to verify account.",
                        duration: 1000,  // Duration of the toast in milliseconds
                        close: true,  // Show close icon
                        gravity: "top",  // Position on top
                        position: "right",  // Position on right
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },  // Success green background color
                    }).showToast();

                    // Optionally, reset the form fields after successful submission
                    $('#signupForm')[0].reset();
                        // Optionally redirect to another page or reset form fields
                    },
                    error: function(response) {
                        let errorMsg = response.responseJSON.Error || 'An error occurred';

                    // Show the error message in the alert div
                    $('#error-message-signup').text(errorMsg);
                    $('#error-alert-signup').fadeIn(); // Show the error alert
                    }
                });
            }
        });

         // Close alert when close button is clicked
    $('#close-alert').on('click', function() {
        $('#error-alert').fadeOut(); // Hide the alert
    });

    $('#close-alert-signup').on('click', function() {
        $('#error-alert-signup').fadeOut(); // Hide the alert
    });
        // Email validation function
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    });

    $(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Clear previous error messages
        $('#error-alert').hide();
        $('#error-message').text('');

        // Get form values
        let email = $('#email').val().trim();
        let password = $('#password').val().trim();

        // Basic validation (can be expanded)
        if (!validateEmail(email)) {
            $('#error-message').text('Please enter a valid email address.');
            $('#error-alert').fadeIn();
            return;
        }

        if (password === '') {
            $('#error-message').text('Password is required.');
            $('#error-alert').fadeIn();
            return;
        }

        // Data to be sent via AJAX
        let formData = {
            email: email,
            password: password,
        };

        // Send AJAX request to the backend
        $.ajax({
            type: 'POST',
            url: '{{ route('sign-in') }}', // Your backend sign-in route
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for security
            },
            beforeSend: function() {
                // Show the loading spinner
                $('#loading-spinner').fadeIn();
                $('#sign-in-btn').fadeOut();
            },
            success: function(response) {
                console.log(response.Success);
                if (response.Success==true) {
                    $('#loading-spinner').fadeOut();
                    // Show success message (using Toastify for example)
                    Toastify({
                        text: "Login successful! Redirecting...",
                        duration: 1000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4CAF50",
                    }).showToast();

                    // Redirect to the dashboard or another page
                    setTimeout(function() {
                        window.location.href = "{{ url('/profile') }}"; // Adjust redirect URL as needed
                    }, 1000);
                } else {

                    // Show the error message
                    $('#error-message').text(response.error || 'Login failed. Please try again.');
                    $('#error-alert').fadeIn();
                    $('#sign-in-btn').fadeIn();
                    $('#loading-spinner').fadeOut();
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseJSON)
                $('#loading-spinner').fadeOut();
                $('#sign-in-btn').fadeIn();
                if(xhr.responseJSON.Error=='Wrong credentials.')
            {
                // Handle wrong credentials
                $('#error-message').text('Wrong credentials. Please try again.');
                $('#error-alert').fadeIn();
            }
            else if(xhr.responseJSON.Error=='User not found.')
            {
                // Handle user not found
                $('#error-message').text('User not found. Please check your email and try again.');
                $('#error-alert').fadeIn();
            }
            else{
            // Handle any errors returned from the server
            $('#error-message').text('An error occurred during login. Please try again.');
                $('#error-alert').fadeIn();
            }

            }
        });
    });

    // Close alert when close button is clicked
    $('#close-alert').on('click', function() {
        $('#error-alert').fadeOut();
    });

    // Email validation function
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    $('#passwordResetForm').on('submit', function(e) {
        e.preventDefault();

        var email = $('#email').val();

        $.ajax({
            url: '{{ url('/password-reset') }}', // Update with your actual route for checking email
            method: 'POST',
            data: {
                email: email,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Hide the form and show the success message
                    $('#passwordResetForm').hide();
                    $('#reset-link').hide();
                    $('#successMessage').text('Password Reset link is sent to your email. Follow the instructions and reset the password.').show();
                } else {
                    alert('Email not found. Please try again.');
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    });
});

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="https://unpkg.com/lokijs@^1.5/build/lokijs.min.js"></script>
    <script>
        $(".countries").select2();
        $(".state").select2();
           var db = new loki('csc.db');

           const countriesJSON = 'https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/countries.json';
           const statesJSON    = 'https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/states.json';
           const citiesJSON    = 'https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/cities.json';
           async function initializeData() {
             var countries = db.getCollection("countries");
             if (!countries) {
               countries = db.addCollection('countries');
               await fetch(countriesJSON)
                 .then(response => response.json())
                 .then(async (data) => {
                   await data.forEach((c) => {
                     countries.insert(c);
                     $('.countries').append(`
                       <option data-id="${c.id}" value="${c.iso2}">
                       ${c.name}
                       </option>

                     `);
                   });
                 });
             }
              var states = db.getCollection("states");
             if (!states) {
               states = db.addCollection('states');
               await fetch(statesJSON)
                 .then(response => response.json())
                 .then(async (data) => {
                   await data.forEach((d) => {
                     states.insert(d);
                   });
                 });
             }


             $('.countries option[value="United Arab Emirates"]').attr("selected",true);
             var $cids=$('.countries option:selected').data('id');
           // alert($cids)
           filterStates($cids)
             }

           initializeData();


           $(document).on('change','.countries',function(){
               var $cid=$(this).find(':selected').attr('data-id')

               // alert($cid)
               filterStates($cid)
           })

           // filterStates($cid)
           async function filterStates($cid) {
               // alert($cid)
             let statesColl = db.getCollection("states");
             let states = await statesColl.find({ country_id: parseInt($cid) });
             let $states = $('.state');
             $states.html('');
             $('.state').html('');
             if (states.length) {
               await states.forEach((s) => {
                   console.log(s)
                 $states.append(`
                   <option value="${s.name}">
                       ${s.name}
                       </option>
                 `);
               });
             } else {
               $states.append(`
                   <option >
                     No State Found
                       </option>
                 `);
             }
           }
           </script>

    <!-- Custom Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @yield('scripts')

</body>
</html>

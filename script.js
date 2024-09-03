document.addEventListener("DOMContentLoaded", function() {
    // Send OTP Form Validation
    const sendOtpForm = document.getElementById('sendOtpForm');
    sendOtpForm.addEventListener('submit', function(event) {
        const mobileNumber = document.getElementById('mobile_number').value;
        const mobileNumberPattern = /^[6-9]\d{9}$/;

        if (!mobileNumberPattern.test(mobileNumber)) {
            alert('Please enter a valid 10-digit mobile number starting with 6-9.');
            event.preventDefault();
        }
    });

    // Verify OTP Form Validation
    const verifyOtpForm = document.getElementById('verifyOtpForm');
    verifyOtpForm.addEventListener('submit', function(event) {
        const otp = document.getElementById('otp').value;
        const otpPattern = /^\d{4}$/;

        if (!otpPattern.test(otp)) {
            alert('Please enter a valid 4-digit OTP.');
            event.preventDefault();
        }
    });

    // Profile Update Form Validation
    const profileUpdateForm = document.getElementById('profileUpdateForm');
    profileUpdateForm.addEventListener('submit', function(event) {
        const email = document.getElementById('email').value;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if (!emailPattern.test(email)) {
            alert('Please enter a valid email address.');
            event.preventDefault();
        }
    });
});

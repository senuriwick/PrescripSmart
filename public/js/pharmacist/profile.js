function validatePasswords() {
    var newPassword = document.getElementById('newPassword').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword === confirmPassword) {
        document.getElementById('passwordForm').submit();
    } else {
        alert('Passwords do not match.');
    }
}
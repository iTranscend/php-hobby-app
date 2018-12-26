function signUpValidate() {
    if ( document.signUpForm.passkeyconf.value == "" || ( document.signUpForm.passkeyconf.value !== document.signUpForm.passkey.value)) {
        alert("Please ensure that your confirmation password is the same as your original password");
        document.signUpForm.passkeyconf.focus();
        return false;
    }

    return true;
}
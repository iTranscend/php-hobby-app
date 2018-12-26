function signUpValidate() {
    if ( document.signUpForm.firstname.value == "" ) {
        alert("Please Enter your firstname");
        document.signUpForm.firstname.focus();
        return false;
    }
    if ( document.signUpForm.lasname.value == "" ) {
        alert("Please Enter your Lastname");
        document.signUpForm.lasname.focus();
        return false;
    }
    if ( document.signUpForm.email.value == "" ) {
        alert("Please Enter your email");
        document.signUpForm.email.focus();
        return false;
    }
    if ( document.signUpForm.passkey.value == "" ) {
        alert("Please Enter your password");
        document.signUpForm.passkey.focus();
        return false;
    }
    if ( document.signUpForm.passkeyconf.value == "" || ( document.signUpForm.passkeyconf.value !== document.signUpForm.passkey.value)) {
        alert("Please ensure that your confirmation password is the same as your original password");
        document.signUpForm.passkeyconf.focus();
        return false;
    }

    return true;
}
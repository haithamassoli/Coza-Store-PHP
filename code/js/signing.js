    //////////////sign Up validation ///////////////
    const pass2InputSignUpPage = document.querySelector("#signUP_pass2_input");
    if (pass2InputSignUpPage) {
        const signUp_Btn = document.getElementById("signUp_insignup_btn");
        const form1 = document.querySelector("#signup_form")
            //username

        const signup_input_username = document.getElementById("signup_input_username");
        const username_help = document.getElementById("username_help");
        const username_format = /^[a-zA-Z0-9_$\.]{4,16}$/;
        //email

        const signup_input_email = document.getElementById("signUp_email_input");
        const email_help = document.getElementById("emailHelp");
        const email_format = /^[A-ZA-z0-9._-]+@(hotmail|gmail|yahoo|outlook).com$/;

        //password
        const signup_input_pass = document.getElementById("signUP_pass_input");
        const pass_help = document.getElementById("passHelp");
        const format_pass = /^(?=.*[0-9])[a-zA-Z0-9]{6,16}$/;
        //passwor2
        const pass2InputSignUpPage = document.querySelector("#signUP_pass2_input");
        const pass2ErrorSignUpPage = document.querySelector("#pass2Help");
        pass2InputSignUpPage.onkeyup = function() {
            //pass2
            if (pass2InputSignUpPage.value === "") {
                pass2ErrorSignUpPage.innerHTML = "password confirmation is empty";
                pass2ErrorSignUpPage.style.color = "red";
                form1.action = "#";
            } else {
                if (pass2InputSignUpPage.value === signup_input_pass.value) {
                    pass2ErrorSignUpPage.innerHTML = "";
                    pass2ErrorSignUpPage.style.color = "green";
                    form1.action = "#";
                } else {
                    pass2ErrorSignUpPage.innerHTML = "password confirmation not equal to origin";
                    pass2ErrorSignUpPage.style.color = "red";
                    form1.action = "#";
                }
            }
        };

        //email
        signup_input_email.onkeyup = function() {
            if (signup_input_email.value === "") {
                email_help.innerHTML = "email is empty";
                email_help.style.color = "red";
                form1.action = "#form";
            } else {
                if (signup_input_email.value.match(email_format)) {
                    email_help.innerHTML = "";
                    email_help.style.color = "green";
                    form1.action = "welcome.php";
                } else {
                    email_help.innerHTML = "email not valid";
                    email_help.style.color = "red";
                    form1.action = "#form";
                    form1.action = "welcome.php";
                }
            }
        };

        //pass
        signup_input_pass.onkeyup = function() {
            if (signup_input_pass.value === "") {
                pass_help.innerHTML = "Password is empty ";
                pass_help.style.color = "red";
            } else {
                if (signup_input_pass.value.match(format_pass)) {
                    pass_help.innerHTML = "";
                    pass_help.style.color = "green";
                    form1.action = "#";
                } else {
                    pass_help.innerHTML = "Password Not Valid";

                    pass_help.style.color = "red";
                    form1.action = "#";
                }
            }
            // e.preventDefault()
        }
    }
    /*end sign up */
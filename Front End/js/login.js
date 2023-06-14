// Function for the Password showing button
function PassShow() {
    let x = document.getElementById("id_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


document.addEventListener('DOMContentLoaded', ()=> {

  // Validating mobile number
  let mobile_number_input = document.getElementById('id_mobile');

  document.getElementById('signup_form').addEventListener('submit', ()=> {
    if(validateNumber() || passCheck()) {
      event.preventDefault();
    }
  });
  
  mobile_number_input.addEventListener('blur', ()=> {
    validateNumber();
  });

  function validateNumber() {
    let mobileNumber = mobile_number_input.value;
    let pattern = /^\d{10}$/;

    if(!pattern.test(mobileNumber)) {
      document.getElementById('invalid_number').innerHTML = "invalid number";
      return true;
    }
    else {
      return false;
    }
  }

  mobile_number_input.addEventListener('focus', ()=> {
    document.getElementById('invalid_number').innerHTML = "";
  });


  // Checking for password equality

  const pass_input= document.getElementById('id_password');
  const con_pass = document.getElementById('id_conpassword');
  const warn = document.getElementById('password_missmatch');

  con_pass.addEventListener('blur', ()=> {
    passCheck();
  });

  function passCheck() {
    let pass = pass_input.value;
    let con = con_pass.value;

    if(pass != con) {
      warn.innerHTML = "Password dont match";
      return true;
    }
    else {
      return false;
    }
  }

  con_pass.addEventListener('focus', ()=> {
    warn.innerHTML = "";
  });
});


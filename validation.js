function validateEmail(id1 ,id2) {
    let emailID = document.getElementById(id1).value;
    let info = document.getElementById(id2);
    let msg;
    atpos = emailID.indexOf("@");
    dotpos = emailID.lastIndexOf(".");
    
    if (atpos < 1 || ( dotpos - atpos < 2 )) {
      msg= "Please enter correct email ID";
    }
    else
     msg ="";
    info.innerHTML = msg;
  }
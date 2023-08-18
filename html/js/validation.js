function fullFormValidation() {

    
    var text;
    
    const textreset = "";

    
    
    if(document.contactForm.firstname.value == "") {
      text = "Enter your name";
      document.getElementById("info-text").style.color="red";
      document.getElementById("info-text").innerHTML = text;

      document.getElementById("info-text1").innerHTML = textreset;

      return false;

    } else {
      text = "The form contains name";
      document.getElementById("info-text1").style.color="green";
      document.getElementById("info-text1").innerHTML = text;
    }
    
    if(document.contactForm.lastname.value == "") {
      text = "Enter your last name";
      document.getElementById("info-text").style.color="red";
      document.getElementById("info-text").innerHTML = text;

      document.getElementById("info-text2").innerHTML = textreset;

      return false;

    } else {
      text = "The form contains last name";
      document.getElementById("info-text2").style.color="green";
      document.getElementById("info-text2").innerHTML = text;
    }

    if(document.contactForm.phone.value == "") {
      text = "Enter your phone number";
      document.getElementById("info-text").style.color="red";
      document.getElementById("info-text").innerHTML = text;

      document.getElementById("info-text3").innerHTML = textreset;
      
      return false;

    } else {
      text = "The form contains phone number";
      document.getElementById("info-text3").style.color="green";
      document.getElementById("info-text3").innerHTML = text;
      
      text = "The form contains all the required parameters";
      alert(text);
    }
}
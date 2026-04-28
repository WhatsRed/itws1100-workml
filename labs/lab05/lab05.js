
function validate(formObj) {

   if (formObj.firstName.value == "") {
      alert("You must enter a first name");
      formObj.firstName.focus();
      return false;
   }

   if (formObj.lastName.value == "") {
      alert("You must enter a last name");
      formObj.lastName.focus();
      return false;
   }

   if (formObj.title.value == "") {
      alert("You must enter a title");
      formObj.title.focus();
      return false;
   }

   if (formObj.org.value == "") {
      alert("You must enter an organization");
      formObj.org.focus();
      return false;
   }

   if (formObj.pseudonym.value == "") {
      alert("You must enter a nickname");
      formObj.pseudonym.focus();
      return false;
   }

   if (formObj.comments.value == "" || formObj.comments.value == "Please enter your comments") {
      alert("You must enter comments");
      formObj.comments.focus();
      return false;
   }

   alert("Form submitted successfully!");
   return true;
}


//nickname
function showNickname() {
   var first = document.getElementById("firstName").value;
   var last = document.getElementById("lastName").value;
   var nick = document.getElementById("pseudonym").value;

   alert(first + " " + last + " is " + nick);
}


//fuction to clear the comments if it is still the base one
function clearComments() {
   var comments = document.getElementById("comments");

   if (comments.value == "Please enter your comments") {
      comments.value = "";
   }
}


//if nothing in comments, restore to the base value
function restoreComments() {
   var comments = document.getElementById("comments");

   if (comments.value == "") {
      comments.value = "Please enter your comments";
   }
}
// Quiz 2
// Put your javascript here in a document.ready function
alert("Page is going to load...");
$(document).ready(function () {

  const defaultTitle = "ITWS 1100 - Quiz 2";
  const nameTitle = "Lancelot Workman – Quiz 2";

  document.title = defaultTitle;
//$ = jquery
  $("#goButton").click(function () {
    if (document.title === defaultTitle) {
      document.title = nameTitle;
    }
    else {
      document.title = defaultTitle;
    }
  });

  
  $("#lastName").hover(
    function () {
      $(this).addClass("makeItPurple");
    },
    function () {
      $(this).removeClass("makeItPurple");
    }
  );

});

$(document).ready(function () {

  $.ajax({
    url: "lab08.json",
    dataType: "json",
    success: function (data) {

      let output = "";

      //looping through each of the projects
      $.each(data.projects, function (index, item) {
        output += `
          <h3>${item.title}</h3>
          <div>
            <p>${item.description}</p>
            <a href="${item.link}">View Project</a>
          </div>
        `;
      });

      //putting #projectsContainer onto the page
      $("#projectsContainer").html(output);

      //applying accoridion after loading above ^
      $("#projectsContainer").accordion({
        collapsible: true,
        heightStyle: "content"
      });

    },
//if there is an error, give an error message for the page
    error: function () {
      $("#projectsContainer").html("<p>Error loading projects.</p>");
    }
  });

});
$(document).ready(function() {
    $("#filter-button").click(function() {
      
      refreshTrainings();
    });
  });
  
  function refreshTrainings() {
  var ime = $("#ime").val();
  
  $.ajax({
    type: "POST",
    url: "filter-treninga.php",
    data: {ime: ime},
    success: function(data) {
      $("#trainings-table").html(data);
    }
  });
  }
  
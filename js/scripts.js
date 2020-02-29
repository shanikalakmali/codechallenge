jQuery(document).ready(function($) {
  $("#viewlist").click(function(event) {
    event.preventDefault();
    $("#list").toggle("slow", function() {});
  });
});

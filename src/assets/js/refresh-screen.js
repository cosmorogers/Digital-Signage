var refresh = 600000; //10 Minutes

function checkAndReload() {
  $.ajax({
    url: window.location,
    cache: false,
    type: "GET",
    timeout: 10000, //10 second timeout
    success: function(response) { window.location = window.location },
    error: function(x, t, m) {
      setTimeout(checkAndReload, refresh);
    }
  });
}

$(function() {
  setTimeout(checkAndReload, refresh);

});

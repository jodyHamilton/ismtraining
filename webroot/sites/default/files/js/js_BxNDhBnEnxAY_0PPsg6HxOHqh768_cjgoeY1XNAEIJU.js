(function ($, Drupal) {

  Drupal.behaviors.mailfishUserTime = {
    attach: function attach(context) {
      var timezone;
      var initialized;
      if (initialized) {
      	return;
      }
      initialized = true;
      if ($.cookie('mailfish-timezone')) {
      	timezone = $.cookie('mailfish-timezone');
      	// FIX FROM BOOK TYPO!!!
      	setTime(timezone);
      }
      else {
      	$.get("http://ip-api.com/json/", function (data) {
      	  timezone = data.timezone;
      	  $.cookie('mailfish-timezone', timezone, {expires: 1, path: '/'});
      	  setTime(timezone);
      	});
      }
      function setTime(timezone) {
      	var time = new Date();
      	var formatted = time.toLocaleTimeString('en-US', { 
      	  hour: 'numeric', 
      	  minute: 'numeric', 
      	  hour12: true, 
      	  timezone: timezone
      	});
      	var iso = time.toISOString();
      	$('time.mailfish-time', context).once('set-time').html(formatted).attr('datetime', iso);
      } 
    }
  };
})(jQuery, Drupal);;

(function ($, Drupal) {

  Drupal.behaviors.mailfishUserTime = {
    attach: function attach(context) {
      var timezone;
      if ($.cookie('mailfish-timezone')) {
        timezone = $.cookie('mailfish-timezone');
        setTime(context);
      }
      else {
        $.get("https://api.ipgeolocation.io/timezone?apiKey=8b9254dee7394f4a881bb86fb65c4c68", function (data) {
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
})(jQuery, Drupal);
(function ($, Drupal) {

  Drupal.behaviors.mailfishUserTime = {
    attach: function attach(context) {
      $.get("http://ip-api.com/json/", function (data) {
        var timezone = data.timezone;
        var time = new Date();
        var formatted = time.toLocaleTimeString('en-US', { 
          hour: 'numeric', 
          minute: 'numeric', 
          hour12: true, 
          timezone: timezone
        });
        var iso = time.toISOString();
        $('time.mailfish-time', context).once('set-time').html(formatted).attr('datetime', iso);
      });

    }
  };
})(jQuery, Drupal);;

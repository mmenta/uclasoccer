// scripts for japan

(function() {
        var endDate = "March 20, 2014 00:35:00";

        $('.countdown_timer').countdown({
          date: endDate,
          render: function(data) {
            $(this.el).html("<div class='days'>" + this.leadingZeros(data.days, 2) + "  &nbsp;: &nbsp;</div><div class='hrs'>" + this.leadingZeros(data.hours, 2) + " &nbsp;: &nbsp;</div><div class='min'>" + this.leadingZeros(data.min, 2) + "</div><div class='clear'></div>");
          }
        });

}(window));

(function ($) {
    "use strict";

    /**
      * IE safe console.log, not that you should leave log messages around
      */
    $.log = function (data) {
        if (window.console) {
            console.log(data);
        }
    };

    $(document).ready(function () {
        $.log("loaded and rocking...");
    });
}(jQuery, undefined));

$(document).ready(function () {
    // All sides
    var sides = ["left", "top", "right", "bottom"];

    // Initialize sidebars
    for (var i = 0; i < sides.length; ++i) {
        var cSide = sides[i];
        $(".sidebar." + cSide).sidebar({side: cSide});
    }

    // Click handlers
    $("a[data-action]").on("click", function () {
        var $this = $(this);
        var action = $this.attr("data-action");
        var side = $this.attr("data-side");
        $(".sidebar." + side).trigger("sidebar:" + action);
        return false;
    });

    $(document).on("keyup", function(e) {
        //esc key
        if (e.keyCode === 27) 
        {
            var sides = ["left", "top", "right", "bottom"];
            for (var i = 0; i < sides.length; ++i) {
                var side = sides[i];
                $(".sidebar." + side).trigger("sidebar:close");
            }
        }
        return false;
    });

});

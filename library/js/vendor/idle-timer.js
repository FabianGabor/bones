(function ($) {
    $.idleTimer = function (firstParam, elem, opts) {
        opts = $.extend({
            startImmediately: true,
            idle: false,
            enabled: true,
            timeout: 30000,
            events: "mousemove keydown DOMMouseScroll mousewheel mousedown touchstart touchmove"
        }, opts);
        elem = elem || document;
        var jqElem = $(elem),
            obj = jqElem.data("idleTimerObj") || {}, toggleIdleState = function (myelem) {
                if (typeof myelem === "number") {
                    myelem = undefined;
                }
                var obj = $.data(myelem || elem, "idleTimerObj");
                obj.idle = !obj.idle;
                var elapsed = (+new Date()) - obj.olddate;
                obj.olddate = +new Date();
                if (obj.idle && (elapsed < opts.timeout)) {
                    obj.idle = false;
                    clearTimeout($.idleTimer.tId);
                    if (opts.enabled) {
                        $.idleTimer.tId = setTimeout(toggleIdleState, opts.timeout);
                    }
                    return;
                }
                var event = $.Event($.data(elem, "idleTimer", obj.idle ? "idle" : "active") + ".idleTimer");
                $(elem).trigger(event);
            }, stop = function (jqElem) {
                var obj = jqElem.data("idleTimerObj") || {};
                obj.enabled = false;
                clearTimeout(obj.tId);
                jqElem.off(".idleTimer");
            };
        obj.olddate = obj.olddate || +new Date();
        if (typeof firstParam === "number") {
            opts.timeout = firstParam;
        } else {
            if (firstParam === "destroy") {
                stop(jqElem);
                return this;
            } else {
                if (firstParam === "getElapsedTime") {
                    return (+new Date()) - obj.olddate;
                }
            }
        }
        jqElem.on($.trim((opts.events + " ").split(" ").join(".idleTimer ")), function () {
            var obj = $.data(this, "idleTimerObj");
            clearTimeout(obj.tId);
            if (obj.enabled) {
                if (obj.idle) {
                    toggleIdleState(this);
                }
                obj.tId = setTimeout(toggleIdleState, obj.timeout);
            }
        });
        obj.idle = opts.idle;
        obj.enabled = opts.enabled;
        obj.timeout = opts.timeout;
        if (opts.startImmediately) {
            obj.tId = setTimeout(toggleIdleState, obj.timeout);
        }
        jqElem.data("idleTimer", "active");
        jqElem.data("idleTimerObj", obj);
    };
    $.fn.idleTimer = function (firstParam, opts) {
        if (!opts) {
            opts = {};
        }
        if (this[0]) {
            return $.idleTimer(firstParam, this[0], opts);
        }
        return this;
    };
    if ($("#header-wrap").hasClass("auto-hide")) {
        var idleTimeout = parseInt($("#header-wrap").attr("data-menutimeout") * 1000);
        $(document).bind("idle.idleTimer", function () {
            if (!$("#header-wrap").hasClass("active")) {
                if ($.support.transition === false) {
                    $("#header-wrap").addClass("idle", 1000, "easeOutSine");
                } else {
                    $("#header-wrap").addClass("sidenav-idle");
                }
            }
        });
        var stor_pos = 0;
        $("#primary-wrapper").prepend('<div class="trigger-menu"></div>');
        $(document.body).on("click mousemove", function (e) {
            if (e.type == "mousemove") {
                var curr_pos = e.pageX;
                if (curr_pos != stor_pos) {
                    if ($.support.transition === false) {
                        $("#header-wrap").removeClass("idle", 1000, "easeOutSine");
                    } else {
                        $("#header-wrap").removeClass("sidenav-idle");
                    }
                    stor_pos = e.pageX;
                }
            } else {
                if ($.support.transition === false) {
                    $("#header-wrap").removeClass("idle", 1000, "easeOutSine");
                } else {
                    $("#header-wrap").removeClass("sidenav-idle");
                }
            }
        });
        $.idleTimer(idleTimeout);
    }
})(jQuery);
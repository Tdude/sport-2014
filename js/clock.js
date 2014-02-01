jQuery(document).ready(function($) {

    var CLOCK = (function() {
        var drawClock = function() {
            var INITIAL_R = 10;

            var zoom = 1; //document.getElementById("rangeinput").value;
            
            var r = INITIAL_R * zoom;

            // Draw Circle
            var circle = document.getElementById("circle");
            circle.setAttribute('r', r);
            circle.setAttribute('cx', r);
            circle.setAttribute('cy', r);

            // Draw Hours
            for(var i = 0; i < 12; i++) {
                var hour = document.getElementById("hour"+i);
                var degrees = i * 30;
                hour.setAttribute('x1', getX(degrees, r, 0.9)); // 90% of radio's length.
                hour.setAttribute('y1', getY(degrees, r, 0.9)); // 90% of radio's length.
                hour.setAttribute('x2', getX(degrees, r));
                hour.setAttribute('y2', getY(degrees, r));
            }

            // Draw hands
            drawHands();
        };

        var drawHands = function() {
            // Constants for hand's sizes.
            var SECONDS_HAND_SIZE = 0.95,
            MINUTES_HAND_SIZE = 0.85,
            HOURS_HAND_SIZE = 0.55;

            var circle = document.getElementById("circle");

            // Clock Circle's Properties
            var r = circle.getAttribute('r'),
            cx = parseInt(circle.getAttribute('cx')),
            cy = parseInt(circle.getAttribute('cy'));

            // Current time.
            var currentTime = new Date();

            // Draw Hands
            drawHand(document.getElementById("secondhand"),
                     currentTime.getSeconds(),
                     SECONDS_HAND_SIZE,
                     6);
            drawHand(document.getElementById("minutehand"),
                     currentTime.getMinutes(),
                     MINUTES_HAND_SIZE,
                     6);
            drawHand(document.getElementById("hourhand"),
                     currentTime.getHours(),
                     HOURS_HAND_SIZE,
                     30);
            
            function drawHand(hand, value, size, degrees) {
                var deg = degrees * value;
                x2 = getX(deg, r, size, cx),
                y2 = getY(deg, r, size, cy);
                
                hand.setAttribute('x1', cx);
                hand.setAttribute('y1', cy); 
                hand.setAttribute('x2', x2);
                hand.setAttribute('y2', y2); 
            }
        };

        /*
         * Get a Point X value.
         * degress. Angle's degrees.
         * r. Circle's radio.
         * adjust. Percent of length.
         * x. Start of X point.
         */
        function getX(degrees, r, adjust, x) {
            var x = x || r, 
            adj = adjust || 1;
            return x + r * adj * Math.cos(getRad(degrees));
        }

        /*
         * Get a Point Y value.
         * degress. Angle's degrees.
         * r. Circle's radio.
         * adjust. Percent of length.
         * x. Start of Y point.
         */   
        function getY(degrees, r, adjust, y) {
            var y = y || r,
            adj = adjust || 1;
            return y + r * adj * Math.sin(getRad(degrees));
        }

        // Convert from degrees to radians.
        function getRad(degrees) {
            var adjust = Math.PI / 2;
            return (degrees * Math.PI / 180) - adjust;
        }
            
        return {
            init: function() {
                drawClock();
                setInterval(drawHands, 1000);
            },
            zoom: function() {
                drawClock();
            }
        };
    })();
    CLOCK.init();

});
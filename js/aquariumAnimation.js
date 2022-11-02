$(document).ready(function() {

    // give all fishes using a .svg instead of an image a random color
    $('.fish svg').each(function() {
        // generates a random 24-bit number and converts it to hex
        var randomColor = "#" + Math.floor(Math.random() * 16777215).toString(16);
        $(this).css('fill', randomColor);
    });

    // set a random starting position for all fishes
    $('.fish').each(function() {
        var pos = getNewPos();
        
        $(this).css('left', pos[0]);
        $(this).css('top', pos[1]);
    });

    $('.fish').each(function() { animateFish($(this)); });
});

// generates a new random position for a fish within the aquarium's bounds
function getNewPos() {
    var h = $('#aquariumContainer').height() - 90;
    var w = $('#aquariumContainer').width() - 90;
    nh = Math.floor(Math.random() * h);
    nw = Math.floor(Math.random() * w);
    
    return [nw,nh];
}

// find the angle of the vector between two positions in degrees
function getAngleBetweenPoints(p1, p2) {
    var dx = p2[0] - p1[0];
    var dy = p2[1] - p1[1];
    var angle = Math.floor(Math.atan2(dy, dx) * (180 / Math.PI));
    return ((angle + 180) % 360) - 180;
}

// continually generate new random positions for each fish
// and animate their movements to those positions
// while also rotating the fish to match the movement
function animateFish(fish) {
        var newPos = getNewPos();
        var duration = Math.max(Math.random() * 8000, 5000);
        var rotationDuration = Math.max(Math.random() * 3, 1.5);
        // make sure that rotation is done when fish starts moving
        var delay = Math.max(Math.random() * 3000, rotationDuration * 1000);
        var angle = getAngleBetweenPoints([fish.position().left, fish.position().top], newPos);
        
        // if the fish must turn over 180 degrees, flip it instead
        if (angle > 90 || angle < -90) {
            flipTransform = " scaleX(-1)";
            angle -= 180;
        }
        else {
            flipTransform = "";
        }

        // get the fish div's image child, since rotating the div itself
        // looks weird for some reason
        fish.children("img:first").css( { 
            transition: ("transform " + rotationDuration + "s"),
            transitionDelay: (delay / 2000 + "s"),
            transform:  "rotate(" + angle + "deg)" + flipTransform
        });
        
        // apply the movement animation with a delay
        fish.delay(delay)
        .animate(
            { top: newPos[1], left: newPos[0] }, 
            {
                duration: duration,
                easing: "swing",
                complete:function() {
                    animateFish(fish);
                }
            }
        )    
};

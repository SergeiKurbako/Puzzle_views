const buttonClose = document.querySelector('.close_svg');
const swatter = document.querySelector(".swatter");
const deviceAgent = navigator.userAgent.toLowerCase();
const isMobile = ("ontouchstart" in document.documentElement) ? true : false;
const touchMenuEvent = (isMobile) ? "touchstart" : "click";
const touchMove = (isMobile) ? "touchmove" : "mousemove";
const guntsSpeed = (isMobile) ? 6 : 10;

// if (isMobile) {
//     buttonClose.style.width = '60px';
//     buttonClose.style.height = '60px';
//     buttonClose.style.fontSize = '12px';
// }

let isRemove = false;

window.addEventListener("mousemove", onMove);
window.addEventListener("mouseout", onMouseOut);
document.body.addEventListener("mouseover", onMouseOver);

window.addEventListener(touchMenuEvent, (e) => {
    if (isMobile) {
        TweenMax.set(".swatter-container", {
            x: e.pageX,
            y: e.pageY - window.pageYOffset
        });
    }
});

function onMove(e) {
    TweenMax.set(".swatter-container", {
        x: e.pageX,
        y: e.pageY - window.pageYOffset
    });
}

function onMouseOut(e) {
    // hide swatter when not in the window
    TweenMax.to(".swatter", 0.1, {
        autoAlpha: 0
    });
}

function onMouseOver(e) {
    // show swatter while inside the window
    TweenMax.to(".swatter", 0.1, {
        autoAlpha: 1
    });
}

function swat(e) {
    // swat on click
    TweenMax.to(".swatter", .05, {
        rotationX: -55,
        transformOrigin: "0% 110%",
        yoyo: true,
        repeat: 1,
        ease: Quint.easeOut
    });
    checkPoint(e.clientX, e.clientY);
}

window.addEventListener("mousedown", swat);
window.addEventListener("touchstart", swat);


//////////////////////
// swarm

var index = 0;
var gnatTemplate = document.querySelector(".gnat");
var swatterButton = document.querySelector('.swatter-button');
swatterButton.style.transform = 'scale(0.4)';
var enemies = document.querySelector(".enemies");
var gnats = [];
var swatThreshold = 45;
var swatCount = 0;

let closeCount = false;

buttonClose.style.zIndex = 100;

function getPath() {
    // generate a bunch of random points to tween through for bezier plugin
    var numPoints = 8;
    var angle = 0;
    var initX = Math.random() < 0.5 ? -20 : window.innerWidth + 20;
    var initY = Math.random() < 0.5 ? -20 : window.innerHeight + 20
    var points = [{
        x: initX,
        y: initY
    }];

    for (var i = 0; i < numPoints; i++) {
        angle = Math.random() * Math.PI * 2;
        var x = (Math.cos(angle) * window.innerWidth * .3) + window.innerWidth * .5;
        var y = (Math.sin(angle) * window.innerHeight * .3) + window.innerHeight * .5;
        points.push({
            x: x,
            y: y
        });

    }
    points.push({
        x: Math.random() < 0.5 ? -20 : window.innerWidth + 20,
        y: Math.random() < 0.5 ? -20 : window.innerHeight + 20
    })
    return points;
}

function buzz(gnatObject) {
    // flap gnat wings
    if (gnatObject) {
        var gnatElement = gnatObject.element;
        var flap = Math.random();
        TweenMax.set(gnatElement.querySelector(".wing1"), {
            autoAlpha: flap > 0.5 ? 0 : 1
        });
        TweenMax.set(gnatElement.querySelector(".wing2"), {
            autoAlpha: flap > 0.5 ? 1 : 0
        });
        TweenMax.set(gnatElement, {
            x: gnatObject.x,
            y: gnatObject.y
        });
    }
}

var bugGroup = [];

function createGnats(numGnats) {
    // generate a random batch of gnats
    var path = getPath();
    var bugGroup = [];
    for (var i = 0; i < numGnats; i++) {
        var gnat = gnatTemplate.cloneNode(true);
        enemies.appendChild(gnat);
        var gnatObject = {
            element: gnat,
            x: path[0].x,
            y: path[0].y,
            alive: true
        };
        gnats.push(gnatObject);
        bugGroup.push(gnatObject);
        TweenMax.set(gnat, {
            x: path[0].x,
            y: path[0].y,
            transformOrigin: "50% 50%"
        })
        index++;
        TweenMax.to(gnatObject, guntsSpeed, {
            bezier: {
                type: "thru",
                values: path,
                curviness: 1.5,
            },
            ease: Linear.easeNone,
            onUpdate: buzz,
            onUpdateParams: [gnatObject],
            onComplete: removeGnat,
            onCompleteParams: [gnatObject]
        });
    }
}

let hideEnemiesTimeout;
let isSwatterHide = false;

function hideSvg() {
    buttonClose.style.visibility = 'hidden';
    swatter.style.display = 'none';
    document.body.style.cursor = 'auto';
    isSwatterHide = true;

    TweenMax.to(enemies, 1.5, {
        x: window.screen.width
    });

    hideEnemiesTimeout = setTimeout(() => {
        enemies.style.display = 'none';
    }, 1500)
};

function openSvg() {
    isSwatterHide = false;
    buttonClose.style.visibility = 'visible';
    enemies.style.display = 'block';
    swatter.style.display = 'block';
    document.body.style.cursor = 'none';

    TweenMax.to(enemies, 1.5, {
        x: 0
    });

    clearInterval(hideEnemiesTimeout);
};

function removeGnat(gnatObject) {
    // kill gnats
    if (gnatObject) {
        TweenMax.killTweensOf(gnatObject);
        TweenMax.killTweensOf(gnatObject.element);
        TweenMax.killChildTweensOf(gnatObject.element);
        enemies.removeChild(gnatObject.element);
        gnatObject = null;
        createGnats(parseInt(1))
    }
}

var numFlies = 0;

function emitGnats() {
    // randomly generate gnats at random intervals
    createGnats(parseInt(1));
    if (numFlies <= 3) {
        numFlies++
        TweenMax.delayedCall((Math.random()), emitGnats);
    }

}

function deleteElement(element) {
    enemies.removeChild(element);
}

function checkPoint(x, y) {
    // hit detection for swat
    for (var i = 0; i < gnats.length; i++) {
        var gnatObject = gnats[i];
        if (gnatObject) {
            if (gnatObject.alive) {
                if (Math.abs(gnatObject.x - x) < swatThreshold && Math.abs(gnatObject.y - y) < swatThreshold) {
                    if (swatCount >= 4) {
                        showIframe();
                        isRemove = true;
                        document.querySelector('#wrapper__svg').remove();
                        document.body.style.cursor = 'auto';
                    }
                    swatCount++;
                    TweenMax.set(".counter text", {
                        textContent: swatCount
                    });
                    TweenMax.killTweensOf(gnatObject);
                    TweenMax.killTweensOf(gnatObject.element);
                    TweenMax.killChildTweensOf(gnatObject.element);

                    TweenMax.to(gnatObject.element, 1, {
                        y: "+=1000",
                        rotation: Math.random() < .5 ? -1000 : 1000,
                        transformOrigin: "50% 50%",
                        autoAlpha: 0,
                        ease: Sine.easeIn,
                        onComplete: deleteElement,
                        onCompleteParams: [gnatObject.element]
                    });
                    gnatObject.alive = false;

                }
            }
        }

    }
}

function showIframe() {
    var div = document.getElementById('wrapper-iframe');

    div.classList.remove('disabled');
    document.body.style.overflow = 'hidden';
    document.body.setAttribute('scroll', 'no');


    var n = 0;
    int = setInterval(function () {
        if (n >= 1) {
            n = 1;
            clearInterval(int);
        }
        n = n + 0.1;
        div.style.opacity = n;
        div.style.filter = 'alpha(opacity=' + 100 * n + ')';
    }, 30);
}

document.getElementById('js-close-modal').onclick = function () {
    var div = document.getElementById('wrapper-iframe');

    var n = 1;

    int = setInterval(function () {
        if (n <= 0) {
            n = 0;
            clearInterval(int);
        }
        n = n - 0.1;
        div.style.opacity = n;
        div.style.filter = 'alpha(opacity=' + 100 * n + ')';
    }, 30);


    div.classList.add('disabled');

    document.body.style.overflow = 'auto';
    document.body.setAttribute('scroll', 'yes');
}


emitGnats();

window.addEventListener(touchMenuEvent, function (e) {
    const buttonX = parseInt(getComputedStyle(buttonClose).left);
    const buttonY = parseInt(getComputedStyle(buttonClose).top);
    const buttonWidth = parseInt(getComputedStyle(buttonClose).width);
    const buttonHeight = parseInt(getComputedStyle(buttonClose).height)

    if (!isRemove) {
        closeCount = !closeCount;

        if (!isMobile && e.clientX > buttonX && e.clientX < buttonX + buttonWidth && e.clientY > buttonY && e.clientY < buttonY + buttonHeight) {
            if (closeCount) {
                buttonClose.style.opacity = '0.5';
                hideSvg()
            } else {
                buttonClose.style.opacity = '1';
                openSvg();
            }
        }

        if (isMobile && e.targetTouches[0].clientX > buttonX && e.targetTouches[0].clientX < buttonX + buttonWidth &&
            e.targetTouches[0].clientY > buttonY && e.targetTouches[0].clientY < buttonY + buttonHeight) {
            swatter.style.display = 'none';

            if (closeCount) {
                buttonClose.style.opacity = '0.5'
                hideSvg()
            } else {
                buttonClose.style.opacity = '1'
                openSvg();
                swatter.style.display = 'none';
            }
        }

        if (!isMobile && e.clientX < buttonX && e.clientY < buttonY) {
            swatter.style.display = 'block';
        }

        if (isMobile && !isSwatterHide &&  e.targetTouches[0].clientX < buttonX && e.targetTouches[0].clientY < buttonY) {
            swatter.style.display = 'block';
        }
    }

});

setInterval(() => {
    const buttonX = parseInt(getComputedStyle(buttonClose).left);
    const buttonY = parseInt(getComputedStyle(buttonClose).top);
    const buttonWidth = parseInt(getComputedStyle(buttonClose).width);
    const buttonHeight = parseInt(getComputedStyle(buttonClose).height)

    TweenMax.set(swatterButton, {
        x: document.documentElement.clientWidth - 145,
        y: document.documentElement.clientHeight - 110
    })

    buttonClose.style.left = `${document.documentElement.clientWidth - 143 + buttonWidth / 1.5}px`
    buttonClose.style.top = `${document.documentElement.clientHeight - 110 + buttonHeight / 5}px`
}, 4)

window.addEventListener(touchMove, (e) => {
    const buttonX = parseInt(getComputedStyle(buttonClose).left);
    const buttonY = parseInt(getComputedStyle(buttonClose).top);
    const buttonWidth = parseInt(getComputedStyle(buttonClose).width);
    const buttonHeight = parseInt(getComputedStyle(buttonClose).height)

    if (!isRemove) {
        if (closeCount) {
            document.body.style.cursor = 'auto';
        } else {
            document.body.style.cursor = 'none';
        }

        if (e.clientX > buttonX && e.clientX < buttonX + buttonWidth && e.clientY > buttonY && e.clientY < buttonY + buttonHeight) {
            document.body.style.cursor = 'pointer';
            buttonClose.style.opacity = '0.5'
            swatter.style.visibility = 'hidden';
        } else {
            buttonClose.style.opacity = '1'
            swatter.style.visibility = 'visible';
        }
    }
})

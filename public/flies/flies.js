window.onload = function () {
    const div = document.createElement('div');
    div.innerHTML = `
<div class="disabled modalIframe" id="wrapper-iframe">
<link rel="stylesheet" href="http://admin.webwidgets.ru/monster/css/style.css">
    <div class="wrapper-iframe--wrapper">
    <a id="js-close-modal" class="madalIframe--close" href="#"></a>
    <iframe id="iframe" src='https://partycamera.org/lidsystem/?frame_id=16&code=5c491550-ff10-11e9-8624-0de7bc30d08d' width='1000' height='600'> </iframe>
    </div>
    </div>
    <div class="wrapper__svg" id="wrapper__svg">
    <div class="close_svg">
        <img src='http://partycamera.org/flies/stop.png'/>
    </div>
        <svg class="game SVG" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <g class="gnat">
                    <g class="wing1" stroke-width="2">
                        <path fill="#D5D8D0" stroke="#9F9F86" d="M-6-3c-7 13-14 16-20 10M6-3c7 13 14 16 20 10" />
                        <path fill="none" stroke="#5D5D45" d="M6 15V4M-6 15V4" />
                    </g>
                    <g class="wing2" stroke-width="2" visibility="hidden" opacity="0">
                        <path fill="none" stroke="#5D5D45" d="M11 13L2 4M-11 13l9-9" />
                        <path fill="#D5D8D0" stroke="#9F9F86" d="M-4-2c-15 1-21-4-19-12M3-2c15 1 21-4 19-12" />
                    </g>
                    <path fill="#ACADA6" d="M0 9c-3.9 0-7-3.1-7-7v-4c0-3.9 3.1-7 7-7s7 3.1 7 7v4c0 3.9-3.1 7-7 7z" />
                    <circle fill="#F70000" cx="-4" cy="-7" r="2" />
                    <circle fill="#F70000" cx="4" cy="-7" r="2" />
                    <path fill="none" stroke="#2B2920" stroke-width="2" d="M7 2c0 3.9-3.1 7-7 7s-7-3.1-7-7" />
                    <path fill="none" stroke="#9F9F86" stroke-width="2" d="M-5-13l5 5 5-5" />
                    <path fill="none" stroke="#5D5D45" stroke-width="2" d="M-13 8l7-7M13 8L6 1" />
                </g>
                <radialGradient cx="60%" cy="80%" r="120%" fx="30%" fy="0%" id="Shadow" gradientUnits="userSpaceOnUse">
                    <stop offset="30%" stop-opacity="0" />
                    <stop offset="100%" stop-opacity=".5" />
                </radialGradient>
                <pattern id="BackgroundTile" x="50%" y="50%" width="60" height="60" patternUnits="userSpaceOnUse" stroke-width="4" fill="none">
                    <path fill="#efefef" d="M0 0h60v60H0z" />
                    <path stroke="#d9d9d9" d="M0 60h60V0" />
                    <path stroke="#fff" d="M0 60V0h60" />
                </pattern>
            </defs>
            <defs>
                <linearGradient id="Grad" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0" style="stop-color:#da1d1d"/>
                    <stop offset="100%" style="stop-color:#da1d1d"/>
                </linearGradient>
            </defs>
            <desc>Кнопка</desc>
            <g class="enemies"></g>
        </svg>
        <div class="swatter-container">
            <svg class="swatter" overflow="visible" opacity="0">
                <path fill="none" stroke="#645CA8" stroke-width="4" d="M0 32v45" />
                <path fill="none" stroke="#4D99D3" stroke-width="2" d="M-20-30v60m10-60v60M0-30v60m0-60v60m10-60v60m10-60v60m-50-50h60m-60 10h60M-30 0h60m-60 0h60m-60 10h60m-60 10h60" />
                <path fill="none" stroke="#645CA8" stroke-width="4" d="M30 20v-50h-60v50c0 5.5 4.5 10 10 10h40c5.5 0 10-4.5 10-10z" />
                <path fill="#4699D4" stroke="#645CA8" stroke-width="2" d="M0 36c-2.8 0-5-2.2-5-5H5c0 2.8-2.2 5-5 5z" />
                <path fill="#FFF" d="M22.6 101.6c2.4-12-2.5-22.3-5-25.8-2.6-3.5-5.8-6.1-10.3-5.8 0-10-14-10-14 0 0 1 .1 1.8.2 2.6-4.8 2.3-7.5 7.5-7.5 14.2 0 4 4.3 6 7 4.2-1.1 2.5-2.1 5.4-1.5 10.1 1.3 9.2 8.5 13.8 8.5 13.8-6.1 4.6 1.5 14.8 7.6 10.3 3.1-2.3 3.1-4 7.7-7.4s6.2-2.9 9.3-5.2c4.3-3.3 1.9-9.2-2-11z" />
                <path fill="#BFBFBF" d="M26.7 106.4c.6 2.1.1 4.4-2 6-3.1 2.3-4.7 1.8-9.3 5.2s-4.6 5.1-7.7 7.4c-6.1 4.6-13.8-5.7-7.6-10.3.8 5.4 2.1 5.6 5.2 6 3.1.4 6.9-6.9 12.9-8.8 6-1.7 8.5-5.5 8.5-5.5zm-22.6 6C-5.9 101 2.9 91.5-.7 80.7c-1.8-5.2-3.4-14.1.8-18.2C-3.4 62.5-7 65-7 70s2 6.2 2 13-5 8.8-3.8 18 8.5 13.8 8.5 13.8c1.7-1.3 2.9-1.7 4.4-2.4zM-7 90.9c.4-.9.8-1.7 1.1-2.6-4.6-.4-5.3-5.6-3.8-13.7-2.9 2.7-4.4 7-4.4 12 .1 4.1 4.4 6.1 7.1 4.3z" />
                <path fill="none" stroke="#818181" stroke-width="2" stroke-linecap="round" d="M.1 114.8s-7.2-4.5-8.5-13.8 3.8-11.2 3.8-18-2-8-2-13c0-10 14-10 14 0 0 4.1-1 8.2-1 13s4.2 8 4.2 8m-6.2 21.4c-1.5.7-2.7 1.1-4.3 2.3-6.1 4.6 1.5 14.8 7.6 10.3 3.1-2.3 3.1-4 7.7-7.4 4.6-3.4 6.2-2.9 9.3-5.2 6.1-4.6-1.5-14.8-7.6-10.3-1.6 1.2-2.4 2.3-3.5 3.5m9-4c2.4-12-2.5-22.3-5-25.8-2.6-3.5-5.8-6.1-10.3-5.8m-13.8 2.5C-11.3 74.8-14 80-14 86.7c0 4 4.3 6 7 4.2" />
            </svg>
        </div>
    <svg class="swatter-button" overflow="visible">
    <path fill="none" stroke="#645CA8" stroke-width="4" d="M0 32v45" />
    <path fill="none" stroke="#4D99D3" stroke-width="2" d="M-20-30v60m10-60v60M0-30v60m0-60v60m10-60v60m10-60v60m-50-50h60m-60 10h60M-30 0h60m-60 0h60m-60 10h60m-60 10h60" />
    <path fill="none" stroke="#645CA8" stroke-width="4" d="M30 20v-50h-60v50c0 5.5 4.5 10 10 10h40c5.5 0 10-4.5 10-10z" />
    </svg>
    </div>
    `
    document.body.appendChild(div);
    let closeCount = false;

    const buttonClose = document.querySelector('.close_svg');
    const swatter = document.querySelector(".swatter");
    swatter.style.transformOrigin = '0px 0px';
    const isMobile = ("ontouchstart" in document.documentElement) ? true : false;
    const touchMenuEvent = (isMobile) ? "touchstart" : "click";
    const touchMove = (isMobile) ? "touchmove" : "mousemove";
    const guntsSpeed = (isMobile) ? 6 : 10;
    document.body.style.cursor = 'none';

    const wrapperSvg = document.querySelector('.wrapper__svg');
    wrapperSvg.style.width = '100%';
    wrapperSvg.style.height = '100%';
    wrapperSvg.style.position = 'fixed';
    wrapperSvg.style.top = '0px';
    wrapperSvg.style.zIndex = '1000';
    wrapperSvg.style.userSelect = 'none';

    const gameSvg = document.querySelector('.game');
    gameSvg.style.width = '100%';
    gameSvg.style.height = '100%';
    gameSvg.style.position = 'fixed';
    gameSvg.style.top = '0px';
    gameSvg.style.zIndex = '1000';

    const swatterStyles = document.querySelector('.swatter');
    swatterStyles.style.transform = 'perspective(500px)';
    swatterStyles.style.position = 'absolute';
    swatterStyles.style.zIndex = '1000';
    swatterStyles.style.overflow = 'visible';

    const swatterContainerStyles = document.querySelector('.swatter-container');
    swatterContainerStyles.style.position = 'absolute';
    swatterContainerStyles.style.zIndex = '10000';

    const closeSvgStyles = document.querySelector('.close_svg');
    closeSvgStyles.style.width = '75px';
    closeSvgStyles.style.height = '75px';
    closeSvgStyles.style.position = 'fixed';
    // closeSvgStyles.style.zIndex = '500';
    closeSvgStyles.style.display = 'flex';
    closeSvgStyles.style.alignItems = 'center';
    closeSvgStyles.style.justifyContent = 'center';
    closeSvgStyles.style.transformOrigin = ' 50% 50%';

    const closeSvgImgStyles = closeSvgStyles.querySelector('img');
    closeSvgImgStyles.style.width = '100%';
    closeSvgImgStyles.style.height = '100%';
    closeSvgImgStyles.style.zIndex = '1000';

    let isRemove = false;
    let allowTouch = true;

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
        if (!closeCount) {
            TweenMax.set(".swatter-container", {
                x: e.pageX,
                y: e.pageY - window.pageYOffset,
                autoAlpha: 1
            });
        } else {
            TweenMax.set(".swatter-container", {
                x: e.pageX,
                y: e.pageY - window.pageYOffset,
                autoAlpha: 0
            });
        }
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
        if (allowTouch) {
            TweenMax.to(".swatter", .05, {
                rotationX: -55,
                transformOrigin: "0% 110%",
                yoyo: true,
                repeat: 1,
                ease: Quint.easeOut,
                onComplete: removeGnat
            });

            setTimeout(() => {
                allowTouch = true;
            }, 120)

            allowTouch = false;
            checkPoint(e.clientX, e.clientY);
        }
    }

    window.addEventListener("mousedown", swat);
    window.addEventListener("touchstart", swat);


//////////////////////
// swarm

    var index = 0;
    var gnatTemplate = document.querySelector(".gnat");
    var swatterButton = document.querySelector('.swatter-button');
    swatterButton.style.transform = 'scale(0.4)';
    swatterButton.style.overflow = 'visible';
    swatterButton.style.zIndex = '1000';
    var enemies = document.querySelector(".enemies");
    var gnats = [];
    var swatThreshold = 45;
    var swatCount = 0;

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
            if (!isMobile && e.clientX > buttonX && e.clientX < buttonX + buttonWidth && e.clientY > buttonY && e.clientY < buttonY + buttonHeight) {
                closeCount = !closeCount;

                if (closeCount) {
                    buttonClose.style.opacity = '0.5';
                    wrapperSvg.style.zIndex = '0';
                    swatter.style.visibility = 'hidden';
                    hideSvg();
                } else {
                    buttonClose.style.opacity = '1';
                    wrapperSvg.style.zIndex = '1000';
                    swatter.style.visibility = 'visible';
                    openSvg();
                }
            }

            if (isMobile && e.targetTouches[0].clientX > buttonX && e.targetTouches[0].clientX < buttonX + buttonWidth &&
                e.targetTouches[0].clientY > buttonY && e.targetTouches[0].clientY < buttonY + buttonHeight) {
                swatter.style.display = 'none';
                closeCount = !closeCount;

                if (closeCount) {
                    buttonClose.style.opacity = '0.5'
                    wrapperSvg.style.zIndex = '0';
                    swatter.style.visibility = 'hidden';
                    hideSvg()
                } else {
                    buttonClose.style.opacity = '1'
                    wrapperSvg.style.zIndex = '1000';
                    swatter.style.visibility = 'visible';
                    openSvg();
                }
            }

            if (!isMobile && e.clientX < buttonX && e.clientY < buttonY) {
                swatter.style.display = 'block';
            }

            if (isMobile && !isSwatterHide && e.targetTouches[0].clientX < buttonX && e.targetTouches[0].clientY < buttonY) {
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
            } else {
                buttonClose.style.opacity = '1'
            }
        }
    })
}
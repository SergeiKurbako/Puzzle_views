<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Maze</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport"
        content="user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">
    <link rel="stylesheet" href="../games/css/main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
</head>

<body>
    <div class="messege-game" id="messege-game">
        
            <p class="messege-game-wrapper" id="messege-game-wrapper">dfdsfdkf;jdlkkl; jdklfjkldj klfj kdsjf kdsjklf jdkfj kldjskfkljv kdlj vkldf vkjfkljlkfjdklg m</p>
        
    </div>
    
    <div class="box">
        <div class="game-container">

            <div id="game"></div>
        </div>
        <div class="side-panel"></div>
    </div>


    <script>
         const box = document.querySelector('#game')
            box.style.height = `${window.innerWidth}px`
            box.style.width = `${window.innerWidth}px`
                // FS()
        let BasicGame = {
            orientated: false
        };
        function submitForm() {
            // let width = document.body.querySelector('#width').value;
            // let height = document.body.querySelector('#height').value;
            // HERO_SPEED = document.body.querySelector('#hero-speed').value;
            // ENEMY_SPEED = document.body.querySelector('#enemy-speed').value;
            // HEALTH_REDUCTION_RATE = document.body.querySelector('#health-reduction-rate').value;
            // COOKIES_QUANTITY = document.body.querySelector('#cookies-quantity').value;
            // HEART_QUANTITY_BOOL = document.body.querySelector('#heart-checkbox').checked;
            // HEART_QUANTITY = document.body.querySelector('#heart-quantity').value;
            // MEN_HEART = document.body.querySelector('#men-heart').value;

            // GAME_WIDTH = +document.body.querySelector('#width-camera-size').value * 32;
            // GAME_HEIGHT = +document.body.querySelector('#height-camera-size').value * 32;

            let width = 22;
            let height = 22;
            HERO_SPEED = 500; 
            // HERO_SPEED = 500; 
            ENEMY_SPEED = 64;
            // HEALTH_REDUCTION_RATE = 0.05;
            HEALTH_REDUCTION_RATE = 0.05;
            COOKIES_QUANTITY = 20;
            HEART_QUANTITY_BOOL = true;
            HEART_QUANTITY = 4;
            MEN_HEART = 3;

            GAME_WIDTH = +18 * 32;
            GAME_HEIGHT = +18 * 32;


            
            // let threeMenLife = document.body.querySelector('#men-life-3-input').checked
            // let oneMenLife = document.body.querySelector('#men-life-1-input').checked
            // console.log(threeMenLife, oneMenLife)
            if (MEN_HEART>=1) {
                THREE_MAN_LIFE = true
            } else {
                THREE_MAN_LIFE = false
            }
            const box = document.querySelector('.box')
            box.style.height = `${window.innerHeight}px`

            if (!(width & 1)) {
                width++
            }
            if (!(height & 1)) {
                height++
            }
            BasicGame.mapWidth = 45 * 32;
            BasicGame.mapHeight = 45 * 32;
            // BasicGame.mapWidth = width * 32;
            // BasicGame.mapHeight = height * 32;
            // let xhr = new XMLHttpRequest();
            // xhr.open("GET", `/orthogonal?width=${width}&height=${height}`);
            // xhr.open("GET", `../maze/orthogonal?width=${width}&height=${height}`);
            // xhr.onload = function () {
                // if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(allMaze)
                    // BasicGame.dataJSON = xhr.responseText;
                    BasicGame.dataJSON = JSON.stringify(allMaze)
                    BasicGame.tilemapURL = tilemapGenerator(JSON.stringify(allMaze), 45, 45);
                    // BasicGame.tilemapURL = tilemapGenerator(xhr.responseText, width, height);
                    // let modal = document.body.querySelector('.modal-window');
                    // modal.remove();
                    renderUI(menuStructure, '.side-panel')
                    startGame();
                    if (!isMobile) {
                        renderSpeedPanel()
                    }
                // }
            // };
            // xhr.send(null);
        }
        setTimeout(() => submitForm(), 50);
    </script>
    <script src="../games/js/phaser.min.js"></script>
    <script src="../games/js/tilemapGen.js"></script>
    <script src="../games/js/constants.js"></script>
    <script src="../games/js/pathfinding.js"></script>
    <script src="../games/js/ui.js"></script>
    <script src="../games/js/detect.js"></script>
    <script src="../games/js/functions.js"></script>
    <script src="../games/js/exData.js"></script>
    <script src="../games/js/socket.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Maze</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport"
        content="user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">
    <link rel="stylesheet" href="/maze/css/main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="modal-window">
        <div class="modal_window_container">
            <div class="inputs-container">
                <div class="width-input">
                    <label for="width">Ширина лабиринта</label>
                    <input type="number" id="width" min="0" value="9" class="form-control">
                </div>
                <div class="height-input">
                    <label for="height">Высота лабиринта</label>
                    <input type="number" id="height" min="0" value="9" class="form-control">
                </div>
                <div class="hero-speed-input">
                    <label for="height">Скорость героя</label>
                    <input type="number" id="hero-speed" min="0" value="500" step='1' class="form-control">
                </div>
                <div class="enemy-speed-input">
                    <label for="height">Скорость врага</label>
                    <input type="number" id="enemy-speed" min="0" value="64" step='1' class="form-control">
                </div>
                <div class="health-reduction-rate-input">
                    <label for="height">Умешьшение жизни</label>
                    <input type="number" id="health-reduction-rate" min="0" value="0.05" step='0.01'
                        class="form-control">
                </div>
                <div class="cookies-quantity-input">
                    <label for="height">Предметы жизни</label>
                    <input type="number" id="cookies-quantity" min="0" value="20" step='1' class="form-control">
                </div>
                <div class="height-camera-size-input">
                    <label for="height">Ширина камеры</label>
                    <input type="number" id="width-camera-size" min="0" value="10" step='1' class="form-control">
                </div>
                <div class="width-camera-size-input">
                    <label for="width">Высота камеры</label>
                    <input type="number" id="height-camera-size" min="0" value="10" step='1' class="form-control">
                </div>
                <div class="heart-quantity-input">

                    <span>Сердечки</span>


                    <input type="checkbox" id="heart-checkbox" checked>
                    <input type="number" id="heart-quantity" min="0" value="4" step='1' class="form-control">

                </div>
                <div class="men-live-quantuty-input">
                    <span>Жизни героя:</span>
                    <input type="number" id="men-heart" min="1" value="3" step='1' class="form-control">

                </div>
                <div class="vaiants">
                        <span>размер:</span>

                    <div class="radio-box">

                        <input type="radio" name="sizes" id="size20" class="form-control" checked>
                        <label for="size20">20x20</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" name="sizes" id="size50" class="form-control">
                        <label for="size50">50x50</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" name="sizes" id="size100" class="form-control">
                        <label for="size100">100x100</label>
                    </div>

                </div>
            </div>
            <button onclick="submitForm()" class="submit-btn btn btn-secondary">Send</button>
        </div>
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
            let width = document.body.querySelector('#width').value;
            let height = document.body.querySelector('#height').value;
            HERO_SPEED = document.body.querySelector('#hero-speed').value;
            ENEMY_SPEED = document.body.querySelector('#enemy-speed').value;
            HEALTH_REDUCTION_RATE = document.body.querySelector('#health-reduction-rate').value;
            COOKIES_QUANTITY = document.body.querySelector('#cookies-quantity').value;
            HEART_QUANTITY_BOOL = document.body.querySelector('#heart-checkbox').checked;
            HEART_QUANTITY = document.body.querySelector('#heart-quantity').value;
            MEN_HEART = document.body.querySelector('#men-heart').value;

            GAME_WIDTH = +document.body.querySelector('#width-camera-size').value * 32;
            GAME_HEIGHT = +document.body.querySelector('#height-camera-size').value * 32;
            // let threeMenLife = document.body.querySelector('#men-life-3-input').checked
            // let oneMenLife = document.body.querySelector('#men-life-1-input').checked
            // console.log(threeMenLife, oneMenLife)
            let inputSize20 = document.querySelector('#size20').checked
            let inputSize50 = document.querySelector('#size50').checked
            let inputSize100= document.querySelector('#size100').checked

            if (MEN_HEART >= 1) {
                THREE_MAN_LIFE = true
            } else {
                THREE_MAN_LIFE = false
            }
            const box = document.querySelector('.box')
            box.style.height = `${window.innerHeight}px`

            if (width%2===1) {
                width++
            }
            if (height%2===1) {
                height++
            }
            BasicGame.mapWidth = width * 32;
            BasicGame.mapHeight = height * 32;
            if(inputSize20){
                BasicGame.dataJSON = size20;
            }
            if(inputSize50){
                BasicGame.dataJSON = size50;
            }
            if(inputSize100){
                BasicGame.dataJSON = size100;
			}
			actionStartGame({
				width,
				height
			})
            let modal = document.body.querySelector('.modal-window');
			modal.remove();
            startGame();
        }
	</script>
	<script src="/maze/js/reqActions.js"></script>

    <script src="/maze/js/20х20.js"></script>
    <script src="/maze/js/50х50.js"></script>
    <script src="/maze/js/100х100.js"></script>
    <script src="/maze/js/exemple.js"></script>
    <script src="/maze/js/phaser.min13.js"></script>
    <script src="/maze/js/tilemapGen.js"></script>
    <script src="/maze/js/constants.js"></script>
    <script src="/maze/js/pathfinding.js"></script>
    <script src="/maze/js/ui.js"></script>
    <script src="/maze/js/detect.js"></script>
    <script src="/maze/js/functions.js"></script>
</body>

</html>

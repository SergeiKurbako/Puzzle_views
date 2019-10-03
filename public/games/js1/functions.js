function startGame() {
    var game = new Phaser.Game(GAME_WIDTH, GAME_HEIGHT, Phaser.CANVAS, 'game');
    BasicGame.Preloader = function (game) {
        this.ready = false;
    };

    BasicGame.Preloader.prototype = {
        preload: function () {
            this.setGameConfig();
            this.game.load.image('cellBot', '/maze/images/cellBot1.png');
            this.game.load.image('cellRight', '/maze/images/cellRight1.png');
            this.game.load.image('cellBotRight', '/maze/images/cellBotRight1.png');
            this.game.load.image('cellEmpty', '/maze/images/cellEmpty.png');
            this.game.load.image('botWall', '/maze/images/botWall.png');
            this.game.load.image('rightWall', '/maze/images/rightWall.png');
            this.game.load.image('finWall', '/maze/images/finWall.png');




            this.game.load.image('btn', '/maze/images/btn.png');
            this.game.load.image('restartBtn', '/maze/images/restart-btn.png');
            this.game.load.image('stopBtn', '/maze/images/stop-btn.png');
            this.game.load.image('demoBtn', '/maze/images/demo-btn.png');
            this.game.load.image('wall', '/maze/images/wall.png');
            this.game.load.image('level', '/maze/images/wall.png');
            this.game.load.image('path', '/maze/images/path.png');
            this.game.load.image('pathWin', '/maze/images/pathWin.png');
            this.game.load.image('wallFinish', '/maze/images/wallFinish.png');
            this.game.load.image('wallStart', '/maze/images/wallStart.png');
            this.game.load.image('pathFinish', '/maze/images/pathFinish.png');
            this.game.load.image('pathPreFinish', '/maze/images/pathPreFinish.png');
            this.game.load.image('pathStart', '/maze/images/pathStart.png');
            this.game.load.image('pathPreStart', '/maze/images/pathPreStart.png');
            this.game.load.image('men', '/maze/images/ball.png');
            this.game.load.image('enemy', '/maze/images/enemy.png');
            this.game.load.image('healthItem', '/maze/images/health-item.png');
            this.game.load.image('heart', '/maze/images/heart.png');
        },
        create: function () {
        },
        update: function () {
            this.ready = true;
            this.state.start('Game');
        },
        setGameConfig: function () {
            // this.scale.setGameSize(GAME_WIDTH, GAME_HEIGHT)
            this.scale.fullScreenScaleMode = Phaser.ScaleManager.SHOW_ALL; //EXACT_FIT  SHOW_ALL
            this.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;

            this.scale.pageAlignVertically = true;
            this.scale.pageAlignHorizontally = true;

            this.stage.disableVisibilityChange = true;

            // this.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;
            // this.scale.pageAlignVertically = true;
            // this.scale.pageAlignHorizontally = true;
        }
    };
    BasicGame.Game = function (game) { };
    BasicGame.Game.prototype = {
        create: function () {
            this.gameStatus = true
            this.game.physics.startSystem(Phaser.Physics.ARCADE);
            // this.data = JSON.parse(BasicGame.dataJSON);
            this.data = BasicGame.mazeData
            // console.log(BasicGame.mazeData)
            // console.log(this.data)

            const { mazeWidth, mazeHeight } = this.data
            this.stage.backgroundColor = '#000';

            this.game.world.setBounds(0, 0, mazeWidth * 32, mazeHeight * 32)
            // this.path = game.add.tileSprite(0, 0, mazeWidth*32, mazeHeight*32, "path");

            this.groupCell = game.add.physicsGroup(Phaser.Physics.ARCADE);
            this.groupWall = game.add.physicsGroup(Phaser.Physics.ARCADE);
            this.finGroup = game.add.physicsGroup(Phaser.Physics.ARCADE);

            const { startCellX, startCellY } = this.data
            this.menPosition = {
                x: startCellX,
                y: startCellY
            }
            this.men = this.add.sprite(startCellX, startCellY, 'men');
            this.physics.arcade.enable(this.men);
            // this.physics.enable(this.men, Phaser.Physics.ARCADE);
            this.men.move = true;
            this.men.body.collideWorldBounds = true;

            // this.men.anchor.x = 0.5;
            // this.men.anchor.y = 0.5;
            this.men.body.setCircle(12);
            this.game.camera.follow(this.men, Phaser.Camera.FOLLOW_LOCKON, 0.1, 0.1);
            this.upKey = this.game.input.keyboard.addKey(Phaser.Keyboard.UP);
            this.downKey = this.game.input.keyboard.addKey(Phaser.Keyboard.DOWN);
            this.leftKey = this.game.input.keyboard.addKey(Phaser.Keyboard.LEFT);
            this.rightKey = this.game.input.keyboard.addKey(Phaser.Keyboard.RIGHT);

            this.drawMaze(this.data)
        },
        update() {
            this.game.physics.arcade.collide(this.men, this.groupWall);
            this.game.physics.arcade.overlap(this.men, this.finGroup, this.finEvent, null, this);
            this.men.body.velocity.x = 0;
            this.men.body.velocity.y = 0;
            if (this.upKey.isDown && this.gameStatus) {
                this.men.body.velocity.y = -200
                this.currentMenPosition()
            }
            if (this.downKey.isDown && this.gameStatus) {
                this.men.body.velocity.y = 200
                this.currentMenPosition()
            }
            if (this.leftKey.isDown && this.gameStatus) {
                this.men.body.velocity.x = -200
                this.currentMenPosition()
            }
            if (this.rightKey.isDown && this.gameStatus) {
                this.men.body.velocity.x = 200
                this.currentMenPosition()
            }
        },
        stopGame() {
            this.gameStatus = false;
        },
        finEvent() {//эвент срабатывающий при достижении игроком финиша
            if (this.gameStatus) {
                this.stopGame()
                actionMove(this.menPosition);
                actionEndGame();
            }
        },
        currentMenPosition() {//определяет координаты игрока + отправляет запрос 
            const currentX = Math.floor((this.men.body.x + 12) / 32)
            const currentY = Math.floor((this.men.body.y + 12) / 32)
            const { x, y } = this.menPosition
            if (x !== currentX || y !== currentY) {
                this.menPosition.x = currentX
                this.menPosition.y = currentY
                actionMove(this.menPosition)
            }
        },
        drawMaze() {//рендер лабиринта
            const { chunk: { cells }, endCellX, endCellY } = this.data;
            cells.forEach(cell => {
                const { bottomWall, rightWall, cellX, cellY } = cell;
                if (bottomWall && rightWall) {
                    let rightWallSprite = this.groupWall.create(cellX * 32 + 24, cellY * 32, 'rightWall');
                    rightWallSprite.body.immovable = true;
                    let botWallSprite = this.groupWall.create(cellX * 32, cellY * 32 + 24, 'botWall');
                    botWallSprite.body.immovable = true;


                }
                if (bottomWall && !rightWall) {
                    let botWallSprite = this.groupWall.create(cellX * 32, cellY * 32 + 24, 'botWall');
                    botWallSprite.body.immovable = true;

                }
                if (!bottomWall && rightWall) {
                    let rightWallSprite = this.groupWall.create(cellX * 32 + 24, cellY * 32, 'rightWall');
                    rightWallSprite.body.immovable = true;
                }
            })

            //рендер выхода
            let finSprite = this.finGroup.create(endCellX * 32, endCellY * 32 + 24, 'finWall');
            finSprite.body.immovable = true;

        },

    };
    (function () {
        game.state.add('Preloader', BasicGame.Preloader);
        game.state.add('Game', BasicGame.Game);
        game.state.start('Preloader');
    })();
}

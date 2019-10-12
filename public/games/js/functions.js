function startGame() {
    var game = new Phaser.Game(GAME_WIDTH, GAME_HEIGHT, Phaser.CANVAS, 'game');
    BasicGame.Preloader = function (game) {
        this.ready = false;
    };

    BasicGame.Preloader.prototype = {
        preload: function () {
            this.setGameConfig();
            this.game.load.tilemap('map', BasicGame.tilemapURL, null, Phaser.Tilemap.TILED_JSON);
            this.game.load.image('debug', '../games/images/debug-grid-1920x1920.png');
            this.game.load.image('btn', '../games/images/btn.png');
            this.game.load.image('restartBtn', '../games/images/restart-btn.png');
            this.game.load.image('stopBtn', '../games/images/stop-btn.png');
            this.game.load.image('demoBtn', '../games/images/demo-btn.png');
            this.game.load.image('wall', '../games/images/wall.png');
            this.game.load.image('level', '../games/images/wall.png');
            this.game.load.image('path', '../games/images/path.png');
            this.game.load.image('pathWin', '../games/images/pathWin.png');
            this.game.load.image('wallFinish', '../games/images/wallFinish.png');
            this.game.load.image('wallStart', '../games/images/wallStart.png');
            this.game.load.image('pathFinish', '../games/images/pathFinish.png');
            this.game.load.image('pathPreFinish', '../games/images/pathPreFinish.png');
            this.game.load.image('pathStart', '../games/images/pathStart.png');
            this.game.load.image('pathPreStart', '../games/images/pathPreStart.png');
            this.game.load.image('men', '../games/images/men4.png');
            this.game.load.image('enemy', '../games/images/enemy.png');
            this.game.load.image('healthItem', '../games/images/health-item.png');
            this.game.load.image('heart', '../games/images/heart.png');
        },
        create: function () {
        },
        update: function () {
            this.ready = true;
            this.state.start('Game');
        },
        setGameConfig: function () {
            // this.scale.setGameSize(document.querySelector('.game-container').offsetWidth, document.querySelector('.game-container').offsetHeight)
            this.scale.setGameSize(GAME_WIDTH, GAME_HEIGHT)
            // this.scale.setupScale(document.querySelector('.game-container').offsetWidth, document.querySelector('.game-container').offsetHeight)
            // this.scale.setGameSize( 12*34,12*34)
            // this.scale.scaleMode = Phaser.ScaleManager.FIT;
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
            let {
                mapWidth,
                mapHeight,
            } = BasicGame;
            this.menProps = {
                coordinate: {
                    x: 1,
                    y: 0
                },
                moveDirection: null,
                isMove: false,
            }
            this.game.physics.startSystem(Phaser.Physics.ARCADE);
            this.path = game.add.tileSprite(0, 0, mapWidth, mapHeight, "path");
            // this.game.world.setBounds(0, 0, GAME_WIDTH*32, GAME_HEIGHT*32+34)
            this.game.world.setBounds(0, 0, mapWidth, mapHeight + 34)
            this.data = JSON.parse(BasicGame.dataJSON);
            this.finishCoordinate = this.getFinCoord(this.data);
            // this.path = game.add.tileSprite(0, 0, 12*32,12*32, "path");
            this.lastKeyPres = 0;
            this.gameStatus = true;
            this.demoStatus = false;
            this.numPosition = 0;
            this.groupWall = game.add.physicsGroup(Phaser.Physics.ARCADE);
            this.groupPath = game.add.physicsGroup(Phaser.Physics.ARCADE);
            this.groupHealthItem = game.add.physicsGroup(Phaser.Physics.ARCADE);
            this.groupHeartItem = game.add.physicsGroup(Phaser.Physics.ARCADE);
            this.groupWinPath = game.add.physicsGroup(Phaser.Physics.ARCADE);
            this.finishCell = game.add.sprite(this.finishCoordinate.x * 32, this.finishCoordinate.y * 32, 'pathFinish');
            this.game.physics.enable(this.finishCell, Phaser.Physics.ARCADE);
            //men
            this.men = this.add.sprite(48, 16, 'men');
            this.men.anchor.x = 0.5;
            this.men.anchor.y = 0.5;
            this.men.scale.setTo(0.8, 0.8)
            this.men.move = true;
            this.game.camera.follow(this.men, Phaser.Camera.FOLLOW_LOCKON, 0.1, 0.1);
            this.game.physics.enable(this.men, Phaser.Physics.ARCADE);
            this.menHealth = 100;
            this.menGodMode = false;
            //enemy
            this.enemy = this.add.sprite(-50, -50, 'enemy');
            this.enemyTween = this.game.add.tween(this.enemy)
            this.enemyStatus = false;
            this.enemyOne = false;
            this.enemyChangePathStatus = false;
            this.lastChangePathEnemy = 0;
            this.enemyNumPosition = 0;
            this.enemyPath = [];
            //heart
            this.heartArr = []
            this.cursors = this.game.input.keyboard.createCursorKeys();
            this.time = game.time.create(false);
            this.timeStatus = false;
            this.timeWidget = document.querySelector('.menu-container__time-widget');
            this.map = game.add.tilemap('map');
            this.map.addTilesetImage('level');
            this.map.setCollisionBetween(1, 5);
            // this.drawMaze(this.data);
            this.layer = this.map.createLayer('Tile Layer 1')
            this.layer.resizeWorld()
            // this.menuPanel();
            this.EASING_STILE = Phaser.Easing.Linear.None
            this.upKey = this.game.input.keyboard.addKey(Phaser.Keyboard.UP);
            this.downKey = this.game.input.keyboard.addKey(Phaser.Keyboard.DOWN);
            this.leftKey = this.game.input.keyboard.addKey(Phaser.Keyboard.LEFT);
            this.rightKey = this.game.input.keyboard.addKey(Phaser.Keyboard.RIGHT);
            this.imposeUIEvents();
            this.arragmentHealthItem()
            this.healthBarRun()
            if (HEART_QUANTITY_BOOL && THREE_MAN_LIFE) {
                this.arragmentHeartItem()
            }
            if (THREE_MAN_LIFE) {
                this.renderHeart(MEN_HEART)

            }
            if (isMobile) {
                this.swipeEvents()


            } else {
                this.imposeSpeedPanelEvents()
                this.keyboardEvents()
            }
        },
        renderHeart(numHeart) {
            let firstPos = GAME_WIDTH / 4
            for (let i = 0; i < numHeart; i++) {
                let heart = this.add.sprite(firstPos + i * 20, 0, 'heart')
                heart.scale.setTo(0.5, 0.5)
                heart.fixedToCamera = true;
                this.heartArr.push(heart)
            }
        },
        rerenderHeart() {
            // const h = this.heartArr[0]
            // h.x=0
            const menHeartCount = this.heartArr.length
            console.log(menHeartCount)
            for (let i = 0; i < menHeartCount; i++) {

                let heart = this.heartArr.pop();
                heart.destroy()
            }
            this.renderHeart(menHeartCount)
        },
        arragmentHeartItem() {
            const mazeArr = JSON.parse(BasicGame.dataJSON)
            const pathCellArr = []
            mazeArr.forEach((y, yId) => {
                y.forEach((x, xId) => {
                    if (x === '1') {
                        pathCellArr.push([xId, yId])
                    }
                })
            })
            const pathCellArrLen = pathCellArr.length
            const coockieStep = Math.floor(pathCellArrLen / (+HEART_QUANTITY + 1))
            for (let i = 1; i <= +HEART_QUANTITY; i++) {
                const rndValue = Math.floor((Math.random() - 0.5) * coockieStep / 2)
                const [x, y] = pathCellArr[(i * coockieStep) + rndValue];
                let heartItem = this.groupHeartItem.create(x * 32 + 16, y * 32 + 16, 'heart');

                heartItem.anchor.x = 0.5;
                heartItem.anchor.y = 0.5;
                heartItem.body.immovable = true;
            }
        },
        destroyAllHeart() {
            this.heartArr.forEach(heart => {
                heart.destroy()
            })
        },
        menTouchHeart(men, heartItem) {
            if (this.heartArr.length < MEN_HEART) {
                this.heartArr[this.heartArr.lenght - 1]
                let firstPos = GAME_WIDTH / 4
                let heart = this.add.sprite(firstPos + (this.heartArr.length * 20), 0, 'heart')
                heart.scale.setTo(0.5, 0.5)
                heart.fixedToCamera = true;
                this.heartArr.push(heart)
                heartItem.destroy()
            }
        },

        arragmentHealthItem() {
            const mazeArr = JSON.parse(BasicGame.dataJSON)
            const pathCellArr = []
            mazeArr.forEach((y, yId) => {
                y.forEach((x, xId) => {
                    if (x === '1') {
                        pathCellArr.push([xId, yId])
                    }
                })
            })
            const pathCellArrLen = pathCellArr.length
            const coockieStep = Math.floor(pathCellArrLen / (+COOKIES_QUANTITY + 1))
            for (let i = 1; i <= +COOKIES_QUANTITY; i++) {
                const [x, y] = pathCellArr[i * coockieStep];
                let healthItem = this.groupHealthItem.create(x * 32 + 16, y * 32 + 16, 'healthItem');
                healthItem.anchor.x = 0.5;
                healthItem.anchor.y = 0.5;
                healthItem.body.immovable = true;
            }
        },
        killAllHealthItem() {
            this.groupHealthItem.children.forEach(child => {
                child.kill()
            })
        },

        menTouchHealthItem(men, healthItem) {
            healthItem.destroy()
            this.menHealth += 5
            if (this.menHealth > 100) {
                this.menHealth = 100
            }
        },
        healthBarRun() {
            this.healthBarX = GAME_WIDTH / 4
            this.healthBarW = GAME_WIDTH / 2
            this.healthBarH = 16
            this.healthBarContailerGraphics = game.add.graphics(this.healthBarX, 0);
            this.healthBarContailerGraphics.z = 1000000
            this.healthBarContailerGraphics.beginFill(0Xff0000)
            this.healthBarContailer = this.healthBarContailerGraphics.drawRect(0, 0, this.healthBarW, this.healthBarH);
            this.healthBarContailer.fixedToCamera = true;
            this.healthBarGraphics = game.add.graphics(this.healthBarX, 0);
            this.healthBarGraphics.beginFill(0X00ff00);
            this.healthBar = this.healthBarGraphics.drawRect(0, 0, this.healthBarW, this.healthBarH);
            this.healthBar.fixedToCamera = true;
        },
        healthBarRerender() {
            this.healthBarContailer.destroy()
            this.healthBar.destroy()
            this.healthBarRun()
        },
        healthBarUpdate() {
            if (this.timeStatus) {
                this.menHealth -= HEALTH_REDUCTION_RATE
                this.healthBarGraphics.scale.x = this.menHealth / 100
            }
            if (this.menHealth <= 0) {
                messegeFinishGame("Время вышло, вы проиграли");
                this.menHealth = 0
                this.endRound()
                
            }
        },
        enemyStart() {
            this.enemy.x = 48
            this.enemy.y = 16
            this.enemy.anchor.x = 0.4;
            this.enemy.anchor.y = 0.4;
            this.enemy.z = 1
            this.enemy.scale.setTo(0.7, 0.7)
            this.enemy.move = true;
            this.game.physics.enable(this.enemy, Phaser.Physics.ARCADE);
            this.enemyPath = this.pathEnemyToMen();
        },
        enemyStop() {
            this.enemy.body.velocity.x = 0
            this.enemy.body.velocity.y = 0
            this.enemyStatus = false;
        },
        enemyTweenCB (){

                // this.enemyTween.stop()
            if(!!this.enemyPath[this.enemyNumPosition+1]){
                this.enemyNumPosition++
                this.enemyRun()
            }else{
                const newPartPath = this.addNewPartPath()
                if(newPartPath.length>1){
                    this.enemyPath.push(...newPartPath)
                    this.enemyTweenCB()
                }else{
                    setTimeout(this.enemyTweenCB.bind(this),200)
                }
            }
        },
        enemyRun() {
            if (this.enemyStatus && this.enemyPath[this.enemyNumPosition]) {
                let x = (this.enemyPath[this.enemyNumPosition][0] * 32) + 12;
                let y = (this.enemyPath[this.enemyNumPosition][1] * 32) + 12;
                const time = (32 / ENEMY_SPEED) * 1000
                this.enemyTween = this.game.add.tween(this.enemy)
                this.enemyTween.onComplete.add(this.enemyTweenCB, this)
                this.enemyTween.to({ x: x, y: y }, time, Phaser.Easing.Linear.None, true)

            }
            else if (this.enemyStatus) {
                // this.enemy.body.velocity.x = 0
                // this.enemy.body.velocity.y = 0
                // const newPartPath = this.addNewPartPath()
                // this.enemyPath.push(...newPartPath)
                // this.enemyNumPosition

            }
        },
        enemyUpdate() {
            if (this.enemyStatus && this.enemyPath[this.enemyNumPosition]) {
                let x = (this.enemyPath[this.enemyNumPosition][0] * 32) + 16;
                let y = (this.enemyPath[this.enemyNumPosition][1] * 32) + 16;
                // console.log(this.enemyTween.isRunning)
                if (!this.enemyTween.isRunning) {
                    this.enemyRun()
                }

                // this.game.physics.arcade.moveToXY(this.enemy, x, y, ENEMY_SPEED);
                // let diffX = Math.abs(this.enemy.x - x);
                // let diffY = Math.abs(this.enemy.y - y);
                // if (diffX < 3
                //     && diffY < 3) {
                //     this.enemyNumPosition++
                // }
                // let x = (this.enemyPath[this.enemyNumPosition][0] * 32) + 12;
                // let y = (this.enemyPath[this.enemyNumPosition][1] * 32) + 12;

                // this.game.physics.arcade.moveToXY(this.enemy, x, y, ENEMY_SPEED);
                // let diffX = Math.abs(this.enemy.x - x);
                // let diffY = Math.abs(this.enemy.y - y);
                // if (diffX < 3
                //     && diffY < 3) {
                //     this.enemyNumPosition++
                // }
            } else if (this.enemyStatus) {
                this.enemy.body.velocity.x = 0
                this.enemy.body.velocity.y = 0
                const newPartPath = this.addNewPartPath()
                this.enemyPath.push(...newPartPath)
                // this.enemyNumPosition

            }
        },
        addNewPartPath() {

            let data = this.responseHandler(BasicGame.dataJSON)
            let grid = new PF.Grid(data);
            grid.setWalkableAt(0, 1, false);
            let finder = new PF.AStarFinder();
            let lastEnemyCell = this.enemyPath.pop();
            let startX = lastEnemyCell[0]
            let startY = lastEnemyCell[1]
            let endX = Math.floor(this.men.x / 32)
            let endY = Math.floor(this.men.y / 32)
            var path = finder.findPath(startX, startY, endX, endY, grid);
            return path.slice(0, 6)

        },
        enemyTouchMen() {
            if (this.heartArr.length - 1 > 0 && !this.menGodMode && THREE_MAN_LIFE) {
                let heart = this.heartArr.pop();
                heart.destroy()
                this.menGodMode = true;
                const fadingTween = this.game.add.tween(this.men).to({ alpha: 0 }, 300, Phaser.Easing.Linear.None, true, 0, 1000, true);

                setTimeout(() => {
                    this.menGodMode = false;
                    fadingTween.stop()
                    this.men.alpha = 1;
                }, 2000)
            } else if (this.gameStatus && !this.menGodMode && THREE_MAN_LIFE) {
                let heart = this.heartArr.pop();
                heart.destroy()
                let curentTime = new Date();
                let finishTimeSecond = Math.floor((curentTime - this.timeStart) / 1000);
                this.men.move = false;
                this.enemy.body.velocity.x = 0
                this.enemy.body.velocity.y = 0
                this.gameStatus = false;
                this.demoStatus = false;
                this.enemyStatus = false
                this.timeStatus = false;

                this.time.stop();
                this.menTween.stop();
                // this.timeText.text = `Result: ${finishTimeSecond}.${finishTimeMS}s`;
                this.timeWidget.innerHTML = `Result: ${finishTimeSecond}s`;

                // В случае когда закончились жизни
                messegeFinishGame("У вас кончились жизни. Вы проиграли!")

            }
            if (this.gameStatus && !THREE_MAN_LIFE) {
                let curentTime = new Date();
                let finishTimeSecond = Math.floor((curentTime - this.timeStart) / 1000);
                this.men.move = false;
                this.enemy.body.velocity.x = 0
                this.enemy.body.velocity.y = 0
                this.gameStatus = false;
                this.demoStatus = false;
                this.enemyStatus = false
                this.timeStatus = false;
                this.time.stop();

                this.menTween.stop();
                // this.timeText.text = `Result: ${finishTimeSecond}.${finishTimeMS}s`;
                this.timeWidget.innerHTML = `Result: ${finishTimeSecond}s`;
            }
        },
        pathEnemyToMen() {
            let data = this.responseHandler(BasicGame.dataJSON)
            let grid = new PF.Grid(data);
            grid.setWalkableAt(0, 1, false);
            let finder = new PF.AStarFinder();
            let startX = Math.floor(this.enemy.x / 32);
            let startY = Math.floor(this.enemy.x / 32);
            let endX = Math.floor(this.men.x / 32)
            let endY = Math.floor(this.men.y / 32)
            var path = finder.findPath(startX, startY, endX, endY, grid);

            return path.slice(0, 5)
        },
        enemyInit() {
            let time = new Date();
            let seconds = Math.round((time - this.timeStart) / 1000);
            if (this.enemyOne && seconds < 4) {
                this.enemyOne = false
            }
            if (!this.enemyStatus && !this.enemyOne && seconds > 4) {
                this.lastChangePathEnemy = seconds * 1000
                this.enemyStatus = true;
                this.enemyOne = true;
                this.enemyStart();
                this.enemyRun()
                // this.enemyUpdate()
            }
        },
        keyboardEvents() {
            const game = document.querySelector('body')
            const rightCode = 39;
            const leftCode = 37;
            const upCode = 38;
            const downCode = 40;
            game.addEventListener('keydown', e => {
                const { keyCode, repeat } = e
                if (keyCode == upCode && this.men.move && !repeat) {
                    this.menProps.isMove = true;
                    this.checkCell("UP")
                    this.initTime();
                }
                if (keyCode == rightCode && this.men.move && !repeat) {
                    this.menProps.isMove = true;
                    this.checkCell("RIGHT")
                    this.initTime();
                }
                if (keyCode == downCode && this.men.move && !repeat) {
                    this.menProps.isMove = true;
                    this.checkCell("DOWN")
                    this.initTime();
                    this.enemyInit()
                }
                if (keyCode == leftCode && this.men.move && !repeat) {
                    this.menProps.isMove = true;
                    this.checkCell("LEFT")
                    this.initTime();
                }
            })

        },
        swipeEvents() {
            const game = document.querySelector('body')
            const minDistanceToSwipe = 20
            let startMoveX;
            let startMoveY;
            game.addEventListener('touchstart', e => {
                e.preventDefault()
                startMoveX = e.changedTouches[0].clientX;
                startMoveY = e.changedTouches[0].clientY;
            });
            game.addEventListener('touchmove', e => {
                e.preventDefault()
            })
            game.addEventListener('touchend', e => {
                // e.preventDefault()
                const deltaMoveX = startMoveX - e.changedTouches[0].clientX;
                const deltaMoveY = startMoveY - e.changedTouches[0].clientY;
                if (Math.abs(deltaMoveX) > Math.abs(deltaMoveY)) {
                    if (deltaMoveX < -minDistanceToSwipe && this.men.move) {
                        this.menProps.isMove = true;
                        this.checkCell("RIGHT")
                        this.initTime();
                        // this.menProps.moveDirection = "RIGHT"
                        // this.initTime();
                        // this.men.body.velocity.x = HERO_SPEED;
                    }
                    if (deltaMoveX > minDistanceToSwipe && this.men.move) {
                        // this.menProps.moveDirection = "LEFT"
                        // this.initTime();
                        // this.men.body.velocity.x = -HERO_SPEED;
                        this.menProps.isMove = true;
                        this.checkCell("LEFT")
                        this.initTime();
                    }
                } else {
                    if (deltaMoveY > minDistanceToSwipe && this.men.move) {
                        this.menProps.isMove = true;
                        this.checkCell("UP")
                        this.initTime();
                        // this.menProps.moveDirection = "UP"
                        // this.initTime();
                        // this.men.body.velocity.y = -HERO_SPEED;
                    } else if (deltaMoveY < -minDistanceToSwipe && this.men.move) {
                        this.menProps.isMove = true;
                        this.checkCell("DOWN")
                        this.initTime();
                        // this.menProps.moveDirection = "DOWN"
                        // this.initTime();
                        // this.men.body.velocity.y = HERO_SPEED;
                    }
                }
            });
        },
        restartGame() {
            this.gameStatus = true;
            this.timeWidget.innerHTML = `0s`;
            this.time.stop();
            this.timeStatus = false;
            this.men.move = true;
            this.demoStatus = false;
        },
        demoRun() {
            
            var men = this.men;
            // men.body.velocity.x = HERO_SPEED;
            // men.body.velocity.y = HERO_SPEED;
            let path = this.calculateWinPath();
            if (path[this.numPosition] == undefined) {
                
                this.endRound()
            }
            let x = (path[this.numPosition][0] * 32) + 12;
            let y = (path[this.numPosition][1] * 32) + 16;
            this.game.physics.arcade.moveToXY(men, x, y, 222);
            let diffX = Math.abs(men.x - x);
            let diffY = Math.abs(men.y - y);
            if (diffX < 15
                && diffY < 15) {
                this.numPosition++
                
            }
        },
        responseHandler(data) {
            let parseData = JSON.parse(data);
            parseData.forEach((i, id) => {
                parseData[id] = i.map(y => {
                    if (+y === 1) {
                        return 0
                    } else {
                        return 1
                    }
                })
            })
            return parseData
        },
        getMenCoord() {
            let x = Math.floor(this.men.x / 32);
            let y = Math.floor(this.men.y / 32);
            return { x, y }
        },
        checkMenPosition() {
            let { coordinate: { x, y } } = this.menProps;
            let { x: currentX, y: currentY } = this.getMenCoord();

            let stopMen;
            if (x !== currentX || y !== currentY) {
                this.menProps.coordinate.x = currentX;
                this.menProps.coordinate.y = currentY;
            
                switch (this.menProps.moveDirection) {
                    case "LEFT":
                        stopMen = verticalCheck(currentX, currentY, this.data)
                        if (stopMen) {
                         
                            this.men.body.velocity.x = 0
                            this.men.body.velocity.y = 0
                            game.add.tween(this.men).to({ x: currentX * 32 + 16, y: currentY * 32 + 16 }, 2, Phaser.Easing.Linear.None, true)
                            // this.men.x = currentX * 32 + 24
                            // this.men.y = currentY * 32 + 16;
                            this.menProps.isMove = false
                            HERO_IS_BOOST = false;
                            BOOST_SPEED = 0
                        }
                        break;
                    // case "RIGHT":
                    //     stopMen = verticalCheck(currentX, currentY, this.data)
                    //     if (stopMen) {
                    //         this.men.body.velocity.x = 0
                    //         this.men.body.velocity.y = 0
                    //         game.add.tween(this.men).to( { x: currentX * 32+16, y:currentY * 32+16 }, 2, Phaser.Easing.Linear.None, true)
                    //         this.menProps.isMove = false
                    //         HERO_IS_BOOST = false;
                    //         BOOST_SPEED = 0
                    //     }
                    //     break;
                    case "UP":
                        stopMen = horizontallCheck(currentX, currentY, this.data)
                        if (stopMen) {
                        
                            this.men.body.velocity.x = 0
                            this.men.body.velocity.y = 0
                            game.add.tween(this.men).to({ x: currentX * 32 + 16, y: currentY * 32 + 16 }, 2, Phaser.Easing.Linear.None, true)
                            this.menProps.isMove = false
                            HERO_IS_BOOST = false;
                            BOOST_SPEED = 0
                        }
                        break;
                    case "DOWN":
                        stopMen = horizontallCheck(currentX, currentY, this.data)
                        if (stopMen) {
                            this.men.body.velocity.y = 0
                            this.men.body.velocity.x = 0
                            game.add.tween(this.men).to({ x: currentX * 32 + 16, y: currentY * 32 + 16 }, 2, Phaser.Easing.Linear.None, true)
                            this.menProps.isMove = false

                            // this.men.x = currentX * 32 + 16
                            // this.men.y = currentY * 32 + 8;
                            HERO_IS_BOOST = false;
                            BOOST_SPEED = 0
                        }
                        break;
                }
                function horizontallCheck(currentX, currentY, data) {
                    let leftCellX = currentX - 1
                    let rightCellX = currentX + 1
                    let dataLeftCell = data[currentY][leftCellX]
                    let dataRightCell = data[currentY][rightCellX]
                    if (dataLeftCell === "1" || dataRightCell === "1") {
                        return true;
                    } else {
                        return false
                    }
                }
                function verticalCheck(currentX, currentY, data) {
                    let upCellY = currentY - 1
                    let downCellY = currentY + 1
                    let dataUpCell = data[upCellY][currentX]
                    let dataDownCell = data[downCellY][currentX]
                    if (dataUpCell === "1" || dataDownCell === "1") {
                        return true;
                    } else {
                        return false
                    }
                }
            }
        },
        checkCell(way) {
            let { x: currentX, y: currentY } = this.getMenCoord();
            let time;
            const easingStyle = EASING_STILE
            switch (way) {
                case "LEFT":
                    const resL = checkLeftWay.call(this, currentX, currentY);
                    if (resL != false) {
                        const { x: nextXleftSide, y: nextYleftSide } = resL
                        time = timeCalc(currentX, nextXleftSide)
                        this.menTween = this.game.add.tween(this.men)
                        this.menTween.to({ x: nextXleftSide * 32 + 16, y: nextYleftSide * 32 + 16 }, time, easingStyle, true)
                        setTimeout(() => {
                            this.menProps.isMove = false;
                        }, 250)
                    } else {
                        this.menProps.isMove = false;
                    }
                    break;
                case "RIGHT":
                    const resR = checkRightWay.call(this, currentX, currentY);
                    if (resR !== false) {
                        const { x: nextXRightSide, y: nextYRightSide } = resR
                        time = timeCalc(currentX, nextXRightSide)
                        this.menTween = this.game.add.tween(this.men)
                        this.menTween.to({ x: nextXRightSide * 32 + 16, y: nextYRightSide * 32 + 16 }, time, easingStyle, true)
                        setTimeout(() => {
                            this.menProps.isMove = false;
                        }, 250)
                    } else {
                        this.menProps.isMove = false
                    }
                    break;
                case "UP":
                    const resU = checkUpWay.call(this, currentX, currentY);
                    if (resU !== false) {
                        const { x: nextXUpSide, y: nextYUpSide } = resU;
                        time = timeCalc(currentY, nextYUpSide)
                        this.menTween = this.game.add.tween(this.men)
                        this.menTween.to({ x: nextXUpSide * 32 + 16, y: nextYUpSide * 32 + 16 }, time, easingStyle, true)
                        setTimeout(() => {
                            this.menProps.isMove = false;
                        }, 250)
                    } else {
                        this.menProps.isMove = false;
                    }
                    break;
                case "DOWN":
                    const resD = checkDownWay.call(this, currentX, currentY);
                    if (resD) {
                        const { x: nextXDownSide, y: nextYDownSide } = resD
                        time = timeCalc(currentY, nextYDownSide)
                        this.menTween = this.game.add.tween(this.men)
                        this.menTween.to({ x: nextXDownSide * 32 + 16, y: nextYDownSide * 32 + 16 }, time, easingStyle, true)
                        setTimeout(() => {
                            this.menProps.isMove = false;
                        }, 250)
                    }
                    break;

                default:
                    break;
            }
            function checkRightWay(x, y) {
                let currentMenY = y
                let mazeWidth = this.data[y].length;
                for (let currentMenX = x + 1; currentMenX < mazeWidth; currentMenX++) {
                    let cellData = +this.data[currentMenY][currentMenX];
                    if (currentMenX - 1 == x && cellData == 0) {
                        return false
                    }
                    if (cellData === 1) {
                        let checkResult = verticalCheck(currentMenX, currentMenY, this.data)
                        if (checkResult) {
                            this.menProps.isMove = false;

                            return {

                                x: currentMenX,
                                y: currentMenY
                            }
                        }
                    } else if (cellData === 0) {
                        this.menProps.isMove = false;

                        return {
                            x: currentMenX - 1,
                            y: currentMenY
                        }
                    }
                }
            }
            function checkLeftWay(x, y) {
                let currentMenY = y
                let mazeWidth = this.data[currentMenY].length;
                for (let currentMenX = x - 1; currentMenX < mazeWidth; currentMenX--) {
                    let cellData = +this.data[currentMenY][currentMenX];
                    if (currentMenX + 1 == x && cellData == 0) {
                        return false
                    }
                    if (cellData === 1) {
                        let checkResult = verticalCheck(currentMenX, currentMenY, this.data)
                        if (checkResult) {
                            this.menProps.isMove = false;
                            return {
                                x: currentMenX,
                                y: currentMenY
                            }
                        }
                    } else if (cellData === 0) {
                        this.menProps.isMove = false;
                        return {
                            x: currentMenX + 1,
                            y: currentMenY
                        }
                    }
                }
            }
            function checkUpWay(x, y) {
                let currentMenX = x
                let mazeHeight = this.data.length;
                for (let currentMenY = y - 1; currentMenY < mazeHeight; currentMenY--) {
                    let cellData = +this.data[currentMenY][currentMenX];
                    if (currentMenY + 1 == y && cellData == "0") {
                        return false
                    } else if (cellData === 1) {
                        let checkResult = horizontallCheck(currentMenX, currentMenY, this.data)
                        if (checkResult) {
                            this.menProps.isMove = false;
                            return {
                                x: currentMenX,
                                y: currentMenY
                            }
                        }
                    } else if (cellData === 0) {
                        this.menProps.isMove = false;

                        return {
                            x: currentMenX,
                            y: currentMenY + 1
                        }
                    }
                }
            }
            function checkDownWay(x, y) {
                let currentMenX = x
                let mazeHeight = this.data.length;
                let currentMenY = y + 1
                let { x: finX, y: finY } = this.finishCoordinate
                for (currentMenY; currentMenY < mazeHeight; currentMenY++) {
                    let cellData = +this.data[currentMenY][currentMenX];
                    if (currentMenY - 1 == y && cellData === 0) {
                        return false;
                    } else if (cellData === 1) {
                        let checkResult = horizontallCheck(currentMenX, currentMenY, this.data)
                        if (checkResult || (finX == currentMenX && finY == currentMenY)) {
                            this.menProps.isMove = false;
                            return {

                                x: currentMenX,
                                y: currentMenY
                            }
                        }
                    } else if (cellData === 0) {
                        this.menProps.isMove = false;

                        return {
                            x: currentMenX,
                            y: currentMenY - 1
                        }
                    }
                }
            }

            function horizontallCheck(currentX, currentY, data) {
                let leftCellX = currentX - 1
                let rightCellX = currentX + 1
                let dataLeftCell = data[currentY][leftCellX]
                let dataRightCell = data[currentY][rightCellX]
                if (dataLeftCell === "1" || dataRightCell === "1") {
                    return true;
                } else {
                    return false
                }
            }
            function verticalCheck(currentX, currentY, data) {
                let upCellY = currentY - 1
                let downCellY = currentY + 1
                let dataUpCell = data[upCellY][currentX]
                let dataDownCell = data[downCellY][currentX]
                if (dataUpCell === "1" || dataDownCell === "1") {
                    return true;
                } else {
                    return false
                }
            }
            function timeCalc(curentPos, nextPos) {
                let diff = Math.abs(curentPos - nextPos) * 32
                return (diff / HERO_SPEED) * 1000
            }
        },
        layerCollideEvent() {
            this.menProps.isMove = false
            HERO_IS_BOOST = false;
            BOOST_SPEED = 0
        },
        update() {
            this.game.physics.arcade.collide(this.men, this.layer, this.layerCollideEvent, null, this);
            this.game.physics.arcade.overlap(this.men, this.finishCell, this.endRound, null, this);
            this.enemyInit()
            // this.enemyUpdate()
            if (this.enemy) {
                this.game.physics.arcade.collide(this.enemy, this.layer);
                this.game.physics.arcade.overlap(this.enemy, this.men, this.enemyTouchMen, null, this);
            }
            this.healthBarUpdate()

            this.game.physics.arcade.overlap(this.men, this.groupHealthItem, this.menTouchHealthItem, null, this);
            this.game.physics.arcade.overlap(this.men, this.groupHeartItem, this.menTouchHeart, null, this);

            // if (this.leftKey.isDown && this.men.move && !this.menProps.isMove) {
            //     this.menProps.isMove = true;
            //     this.checkCell("LEFT")
            //     this.initTime();
            // } else if (this.rightKey.isDown && this.men.move && !this.menProps.isMove) {
            //     this.menProps.isMove = true;
            //     this.checkCell("RIGHT")
            //     this.initTime();
            //     // this.men.body.velocity.x = HERO_SPEED + BOOST_SPEED;
            // }
            // if (this.upKey.isDown && this.men.move && !this.menProps.isMove) {
            //     // this.menProps.moveDirection = "UP"
            //     this.menProps.isMove = true;
            //     this.checkCell("UP")
            //     this.initTime();
            //     // this.men.body.velocity.y = -(HERO_SPEED + BOOST_SPEED);
            // } else if (this.downKey.isDown && this.men.move && !this.menProps.isMove) {
            //     // this.menProps.moveDirection = "DOWN"
            //     this.menProps.isMove = true;
            //     this.checkCell("DOWN")
            //     this.initTime();
            //     // this.men.body.velocity.y = (HERO_SPEED + BOOST_SPEED);
            // }
            // if (this.leftKey.isDown & this.men.move) {
            //     this.menProps.moveDirection = "LEFT"
            //     this.initTime();
            //     // this.game.physics.arcade.computeVelocity(1,this.men,-HERO_SPEED,1,0,1000)
            //     this.menProps.isMove = true;
            //     this.men.body.velocity.x = -(HERO_SPEED + BOOST_SPEED);
            // } else if (this.rightKey.isDown & this.men.move ) {
            //     this.menProps.moveDirection = "RIGHT"
            //     this.initTime();
            //     this.menProps.isMove = true;
            //     this.men.body.velocity.x = HERO_SPEED + BOOST_SPEED;
            // }
            // if (this.upKey.isDown & this.men.move) {
            //     this.menProps.moveDirection = "UP"
            //     this.initTime();
            //     this.menProps.isMove = true;
            //     this.men.body.velocity.y = -(HERO_SPEED + BOOST_SPEED);
            // } else if (this.downKey.isDown & this.men.move) {
            //     this.menProps.moveDirection = "DOWN"
            //     this.initTime();
            //     this.menProps.isMove = true;
            //     this.men.body.velocity.y = (HERO_SPEED + BOOST_SPEED);
            // }

            if (HERO_IS_BOOST) {
                BOOST_SPEED += BOOST
                // this.runBoost();

            }
            if (this.demoStatus) {
                this.initTime();
                this.demoRun();
            }

            // if (this.game.width != window.innerWidth || this.game.height != window.innerHeight) {
            // 	this.scale.setGameSize(window.innerWidth, window.innerHeight)
            // }
        },
        calculateWinPath() {
            let data = this.responseHandler(BasicGame.dataJSON)
            let grid = new PF.Grid(data);
            grid.setWalkableAt(0, 1, false);
            let finder = new PF.AStarFinder();
            let startCoordinate = {
                x: 1,
                y: 0
            };
            var path = finder.findPath(startCoordinate.x, startCoordinate.y, this.finishCoordinate.x, this.finishCoordinate.y, grid);
            return path
        },
        endRound() {
            if (this.gameStatus) {
                let curentTime = new Date();
                let finishTimeSecond = Math.floor((curentTime - this.timeStart) / 1000);
                let finishTimeMS = (curentTime - this.timeStart) % 1000;
                if (finishTimeMS < 100) {
                    finishTimeMS = '0' + finishTimeMS;
                    console.log("endRound1")
                } else if (finishTimeMS < 10) {
                    finishTimeMS = '00' + finishTimeMS;
                    console.log("endRound2")
                }
                function stopMenMove() {
                    console.log("endRound3")
                    this.men.move = false;
                }
                setTimeout(stopMenMove.bind(this), 100);
                this.enemyStop()
                this.gameStatus = false;
                this.demoStatus = false;
                this.timeStatus = false;
                this.time.stop();
                // this.timeText.text = `Result: ${finishTimeSecond}.${finishTimeMS}s`;
                this.timeWidget.innerHTML = `Result: ${finishTimeSecond}s`;
                console.log("endRound4")
            }
        },

        initTime() {
            if (!this.timeStatus) {
                this.timeStatus = true;
                this.timeStart = new Date();
                this.time.repeat(1 * Phaser.Timer.SECOND, 7200, this.updateTime, this);
                this.time.start();
            }
        },
        updateTime() {
            // let timeWidget = document.querySelector('.menu-container__time-widget');
            let time = new Date();
            let seconds = Math.round((time - this.timeStart) / 1000);
            let timeString = `${seconds}s`;
            this.timeWidget.innerHTML = timeString
        },
        drawMaze(data) {
            let groupWall = this.groupWall;
            let groupPath = this.groupPath;

            data.forEach(function (item, i, ) {
                item.forEach(function (cell, indexWall) {

                    switch (cell) {
                        case "1":
                            let pathSprite = groupPath.create(indexWall * 32, i * 32, 'path');
                            pathSprite.body.immovable = true;
                            pathSprite.z = -1;
                            break;
                        // case "0":
                        // 	// let wallRect = graphics.drawRect(indexWall * 32, i * 32,32,32)
                        // 	// let wallSprite = groupWall.create(wallRect, 'wall');

                        // 	// groupWall.add();
                        // 	let wallSprite = groupWall.create(indexWall * 32, i * 32, 'wall');
                        // 	wallSprite.body.immovable = true;
                        // 	wallSprite.getBounds();
                        // 	wallSprite.autoCull = true;
                        // 	// wallSprite.body.static = true;
                        // 	// graphics.drawRect(indexWall * 32, i * 32,32,32)
                        // 	break;
                    }
                });
            });
        },
        drawWinPath() {
            console.log("drawWinPath")
            let groupPath = this.groupPath;
            let path = this.calculateWinPath()
            path.forEach(coordinate => {
                let [x, y] = coordinate;
                let winPathSprite = groupPath.create(x * 32, y * 32, 'pathWin');
                winPathSprite.body.immovable = true;
            })
        },
        hideWinPath() {
            console.log("hideWinPath");
            let groupPath = this.groupPath;
            groupPath.children.forEach(child => {
                child.kill()
            })
        },
        getFinCoord(data) {
            let dataLen = data.length;
            let itemLen = data[0].length;
            return {
                x: itemLen - 2,
                y: dataLen - 1
            }
        },
        imposeUIEvents() {
            const demoBtn = document.querySelector('.menu-container__demo-btn');
            demoBtn.addEventListener('click', e => {
                e.preventDefault();
                if (!this.demoStatus) {
                    this.restartGame();
                    this.demoStatus = true;
                    this.numPosition = 0;
                    this.drawWinPath();
                    this.men.x = 48;
                    this.men.y = 16;
                }
            })
            const stopBtn = document.querySelector('.menu-container__stop-btn');
            stopBtn.addEventListener('click', e => {
                e.preventDefault();
                this.enemyStop()
                this.time.stop();
                this.timeStatus = false;
                this.men.move = false;
                this.demoStatus = false;
                this.men.body.velocity.x = 0
                this.men.body.velocity.y = 0
            })

            const restartBtn = document.querySelector('.menu-container__restart-btn');
            restartBtn.addEventListener('click', e => {
                // e.preventDefault();
                // this.enemyNumPosition = 0;
                // this.enemyPath = []
                // this.enemyStatus = false;
                // this.enemyOne = true;
                // this.enemy.x = -100;
                // this.enemy.y = -100;
                // // this.enemy.destroy()
                // setTimeout(()=>{
                //     this.healthBarW = GAME_WIDTH / 2;
                //     this.menHealth = 100
                //     this.hideWinPath();
                //     this.killAllHealthItem();
                //     this.arragmentHealthItem();
                //     this.destroyAllHeart();
                //     this.renderHeart()
                //     this.men.body.velocity.x = 0
                //     this.men.body.velocity.y = 0
                //     this.men.x = 48;
                //     this.men.y = 16;
                // },100)
                // setTimeout(this.restartGame.bind(this), 200);
                this.game.destroy()
                startGame();

            })
        },
        imposeSpeedPanelEvents() {
            const speedInput = document.querySelector('.speed-panel__speed-input');
            speedInput.addEventListener('input', () => {
                HERO_SPEED = +speedInput.value
            }, false)
            // const boostInput = document.querySelector('.speed-panel__boost-input');
            // boostInput.addEventListener('input', () => {
            //     BOOST = +boostInput.value
            // }, false)
            // const isBoostInput = document.querySelector('.speed-panel__is-boost-input');
            // isBoostInput.addEventListener('change', () => {
            //     HERO_IS_BOOST = !HERO_IS_BOOST
            // }, false);

            const gameWidthInput = document.querySelector('.speed-panel__game-width-input');
            const gameWidthLabel = document.querySelector('.game-width-label');
            gameWidthInput.addEventListener('input', () => {
                gameWidthLabel.innerHTML = `ширина ${gameWidthInput.value} клеток`
                GAME_WIDTH = +gameWidthInput.value * 32
                this.scale.setGameSize(GAME_WIDTH, GAME_HEIGHT)
                this.layer.kill()
                this.layer = this.map.createLayer('Tile Layer 1')
                this.healthBarRerender()
                this.rerenderHeart()
                if (THREE_MAN_LIFE) {
                }
            }, false);

            const gameHeightInput = document.querySelector('.speed-panel__game-height-input');
            const gameHeightLabel = document.querySelector('.game-height-label');
            gameHeightInput.addEventListener('input', () => {
                gameHeightLabel.innerHTML = `высота ${gameHeightInput.value} клеток`
                GAME_HEIGHT = +gameHeightInput.value * 32
                this.scale.setGameSize(GAME_WIDTH, GAME_HEIGHT)
                this.layer.kill()
                this.layer = this.map.createLayer('Tile Layer 1')
                this.healthBarRerender()
                this.rerenderHeart()

            }, false);


            

            const healthReductionRateInput = document.querySelector('.speed-panel__health-reduction-rate');
            healthReductionRateInput.addEventListener('input', (e) => {
                const { target: { value } } = e
                HEALTH_REDUCTION_RATE = value
            })
            const enemySpeedInput = document.querySelector('.speed-panel__enemy-speed');
            enemySpeedInput.addEventListener('input', (e) => {
                const { target: { value } } = e
                ENEMY_SPEED = value
            })
        }

    };
    (function () {
        game.state.add('Preloader', BasicGame.Preloader);
        game.state.add('Game', BasicGame.Game);
        game.state.start('Preloader');
    })();
}

function messegeFinishGame(str){
    var box = document.getElementsByClassName('messege-game');
    var textMessage = 
};

messegeFinishGame("good")
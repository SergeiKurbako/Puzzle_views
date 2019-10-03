<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <button type="button" name="button" onclick="login('your_name')">login</button>
        <br/>
        <button type="button" name="button" onclick="openGame()">openGame</button>
        <br/>
        <button type="button" name="button" onclick="move()">move</button>
        <br/>
        <button type="button" name="button" onclick="getChunk()">getChunk</button>
        <br/>
        <button type="button" name="button" onclick="endGame()">endGame</button>
        <br/>
        <br/>
        <button type="button" name="button" onclick="upHealth()">upHealth</button>
        <br/>
        <button type="button" name="button" onclick="upSpeed()">upSpeed</button>
        <br/>
        <button type="button" name="button" onclick="upTime()">upTime</button>
        <br/>
        <button type="button" name="button" onclick="downHealth()">downHealth</button>
        <br/>
        <button type="button" name="button" onclick="downSpeed()">downSpeed</button>
        <br/>
        <button type="button" name="button" onclick="downTime()">downTime</button>


        <script>
            let resourceId = '';
            let sessionUuid = '';

            let conn = new WebSocket("ws://localhost:8081");

            // установление соединения
            conn.onopen = function(e) {
                console.log("Connection established!");
            };

            // получение данных
            conn.onmessage = function(e) {
                let data = JSON.parse(JSON.parse(e.data));

                if (data.hasOwnProperty('sessionData')) {
                    sessionUuid = data.sessionData.sessionUuid;
                }

                console.log("Полученны данные: " + JSON.parse(e.data));
            };

            function login(name) {
                let data = {
                    'messageType': 'login',
                    'name': name
                };

                // отправка данных
                conn.send(JSON.stringify(data));
            }

            function openGame() {
                let data = {
                    'messageType': 'action',
                    'action': 'open_game',
                    'maze_width': 20,
                    'maze_height': 20,
                    'game_id': 1,
                    'startCellX': 0,
                    'startCellY': 0,
                    'endCellX': 0,
                    'endCellY': 0,
                    'userId': 1,
                    'sessionUuid': '',
                    'mode': 'full'
                };

                // отправка данных
                conn.send(JSON.stringify(data));
            }

            function move() {
                let data = {
                    'messageType': 'action',
                    'action': 'move',
                    'sessionUuid': sessionUuid,
                    'userId': 1,
                    'mode': 'full',
                    'game_id': 1,
                    'cellX': 0,
                    'cellY': 1
                };

                // отправка данных
                conn.send(JSON.stringify(data));
            }

            function getChunk() {
                let data = {
                    'messageType': 'action',
                    'action': 'get_chunk',
                    'sessionUuid': sessionUuid,
                    'userId': 1,
                    'mode': 'full',
                    'game_id': 1,
                    'need_chunk_x': 4,
                    'need_chunk_y': 4
                };

                // отправка данных
                conn.send(JSON.stringify(data));
            }

            function endGame() {
                let data = {
                    'messageType': 'action',
                    'action': 'end_game',
                    'sessionUuid': sessionUuid,
                    'userId': 1,
                    'mode': 'full',
                    'game_id': 4
                };

                // отправка данных
                conn.send(JSON.stringify(data));
            }

            function upHealth() {
                let data = {
                    'messageType': 'action',
                    'action': 'up_health',
                    'sessionUuid': sessionUuid,
                    'userId': 1,
                    'mode': 'full',
                    'game_id': 1,
                    'up_health': 10
                };

                // отправка данных
                conn.send(JSON.stringify(data));
            }

            function downHealth() {
                let data = {
                    'messageType': 'action',
                    'action': 'down_health',
                    'sessionUuid': sessionUuid,
                    'userId': 1,
                    'mode': 'full',
                    'game_id': 1,
                    'down_health': 10
                };

                // отправка данных
                conn.send(JSON.stringify(data));
            }

            function upSpeed() {
                let data = {
                    'messageType': 'action',
                    'action': 'up_speed',
                    'sessionUuid': sessionUuid,
                    'userId': 1,
                    'mode': 'full',
                    'game_id': 1,
                    'up_speed': 10
                };

                // отправка данных
                conn.send(JSON.stringify(data));
            }

            function upTime() {
                let data = {
                    'messageType': 'action',
                    'action': 'up_time',
                    'sessionUuid': sessionUuid,
                    'userId': 1,
                    'mode': 'full',
                    'game_id': 1,
                    'up_time': 10
                };

                // отправка данных
                conn.send(JSON.stringify(data));
            }

            function downSpeed() {
                let data = {
                    'messageType': 'action',
                    'action': 'down_speed',
                    'sessionUuid': sessionUuid,
                    'userId': 1,
                    'mode': 'full',
                    'game_id': 1,
                    'down_speed': 10
                };

                // отправка данных
                conn.send(JSON.stringify(data));
            }

            function downTime() {
                let data = {
                    'messageType': 'action',
                    'action': 'down_time',
                    'sessionUuid': sessionUuid,
                    'userId': 1,
                    'mode': 'full',
                    'game_id': 1,
                    'down_time': 10
                };

                // отправка данных
                conn.send(JSON.stringify(data));
            }
        </script>
    </body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <script src="js/autobahn.min.js"></script>
        <script>
            var conn = new ab.connect(
                'ws://localhost:8082',
                function (session) {
                    session.subscribe('message', function (topic, data) {
                        console.info('New data: topic_id: ' + topic);
                        console.log(data.data);
                    });
                },

                function (code, reason, detail) {
                    console.warn('WebSocket connection closed: code=' + code + '; reason= '+ reason + '; detail= ' + datail);
                },

                {
                    'maxRetries': 60,
                    'retryDelay': 4000,
                    'skipSubprotocolCheck': true
                }
            );
        </script>
    </body>
</html>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="http://www.iron.io/favicon.ico">
    <link rel="stylesheet" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Alegreya:400italic,700italic,400,700' rel='stylesheet'
          type='text/css'>
    <link rel="stylesheet" href="css/jquery.snippet.min.css">

    <style type="text/css" media="screen">
        @font-face {
            font-family: 'Conv_gillsans';
            src: url('fonts/gillsans.eot');
            src: local('☺'), url('fonts/gillsans.woff') format('woff'), url('fonts/gillsans.ttf') format('truetype'), url('fonts/gillsans.svg') format('svg');
            font-weight: normal;
            font-style: normal;
        }
    </style>

    <script type="text/javascript"
            src="https://www.google.com/jsapi?key=ABQIAAAAhes0f80sBcwL-h5xCNkkgxQBmiBpQeSpIciQPfZ5Ss-a60KXIRQOVvqzsNpqzhmG9tjky_5rOuaeow"></script>
    <script type="text/javascript">google.load('jquery', '1');
    google.load('jqueryui', '1'); </script>
    <script src="javascripts/jquery.snippet.min.js" type="text/javascript" charset="utf-8"></script>
    <title>Performance tests</title>

</head>
<body>
<section id="result-flow">
    <h2>Test Results</h2>

    <div style="text-align:center">Num of iterations:<input id="iterations" type="text" value="100"/><br/><br/>
        <input id="Start test" type="button" value="Start test" class="red" onclick="start_test();"/>
    </div>
    <br/>
    <table id="output" class="sample">
        <thead>
        <tr>
            <th>num of iterations</th>
            <th>workers queue time(sec)</th>
            <th>messages send time(sec)</th>
            <th>messages receive time(sec)</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</section>

<footer>
    <a href="http://iron.io" title="Messaging and Background Processing for Cloud Apps"><img
        src="http://www.iron.io/assets/resources/ironio-badge-red.png" alt="Iron.io Badge"/></a>
</footer>

<script>

    function parse_result(data, task_id) {
        if (data) {
            var parsed = jQuery.parseJSON(data);
            for (var k in parsed) {
                $("#" + task_id + "_" + k).html(parsed[k]);
            }
        }
    }
    function start_test() {
        var num_of_iterations = $('#iterations').val();
        var task_id = Math.floor(Math.random() * 500)

        var html = '<tr><td>' + num_of_iterations + '</td><td><span id="' +
            task_id + '_worker"><img src="images/ajax-loader-circle.gif" class="spinner" /></span></td><td><span id="' +
            task_id + '_sent"><img src="images/ajax-loader-circle.gif" class="spinner" /></span></td><td><span id="' +
            task_id + '_received"><img src="images/ajax-loader-circle.gif" class="spinner" /></span></td></tr>';
        $('#output tbody').prepend(html);

        jQuery.ajaxSetup({async:true});
        $.get('/test/ironWorker_queue_test.php?iterations=' + num_of_iterations, null, function (data) {
            parse_result(data, task_id);
        });
        $.get('/test/ironMQ_get_test.php?iterations=' + num_of_iterations, null, function (data) {
            parse_result(data, task_id);
        });
        $.get('/test/ironMQ_put_test.php?iterations=' + num_of_iterations, null, function (data) {
            parse_result(data, task_id);
        });
    }
</script>

<style type="text/css">
    table.sample {
        border-width: 1px;
        border-spacing: 10px;
        border-style: none;
        border-color: gray;
        border-collapse: collapse;
        background-color: white;
    }

    table.sample th {
        border-spacing: 10px;
        border-width: 1px;
        padding: 1px;
        border-style: inset;
        border-color: gray;
        background-color: white;
        -moz-border-radius:;
    }

    table.sample td {
        width: 300;
        height: 300;
        align: center;
        valign: center;
        border-spacing: 10px;
        border-width: 1px;
        padding: 1px;
        border-style: inset;
        border-color: gray;
        background-color: white;
        -moz-border-radius:;
    }
</style>


</body>
</html>

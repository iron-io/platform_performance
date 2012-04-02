<?php
include(__DIR__ . '/../lib/IronMQWrapper.php');
$iterations = $_REQUEST['iterations'];
$queue_name = "test_queue_name";
$start = get_time();
for ($i = 1; $i <= $iterations; $i++)
{
    post_message($ironmq, $queue_name);
}
$sent_time = get_time() - $start;
$details = array("sent" => $sent_time);
echo json_encode($details);


function get_time()
{
    return (float)array_sum(explode(' ', microtime()));
}

function post_message($ironmq, $queue_name)
{
    $ironmq->postMessage($queue_name, array("body" => "body"));
}
?>

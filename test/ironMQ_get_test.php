<?php
include(__DIR__ . '/../lib/IronMQWrapper.php');
$iterations = $_REQUEST['iterations'];
$queue_name = "test_queue_name";
$start = get_time();
for ($i = 1; $i <= $iterations; $i++)
{
    get_message($ironmq, $queue_name);
}
$received_time = get_time() - $start;
$details = array("received" => $received_time);
echo json_encode($details);


function get_time()
{
    return (float)array_sum(explode(' ', microtime()));
}

function get_message($ironmq, $queue_name)
{
    $ironmq->getMessage($queue_name);
}
?>

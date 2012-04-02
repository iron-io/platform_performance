<?php
include(__DIR__ . '/../lib/IronMQWrapper.php');
$queue_name = "test_queue_name";
include(__DIR__ . '/../lib/IronWorkerWrapper.php');
$name = "sampleWorker.php";


$start = get_time();
for ($i = 1; $i <= 10; $i++)
{
    queue_worker($iw, $name);
}
$worker_time = get_time() - $start;

$start = get_time();
for ($i = 1; $i <= 10; $i++)
{
    post_message($ironmq, $queue_name);
}
$sent_time = get_time() - $start;

$start = get_time();
for ($i = 1; $i <= 10; $i++)
{
    get_message($ironmq, $queue_name);
}
$received_time = get_time() - $start;


$details = array("worker" => $worker_time, "sent" => $sent_time, "received" => $received_time);
echo json_encode($details);


function get_time()
{
    return (float)array_sum(explode(' ', microtime()));
}

function get_message($ironmq, $queue_name)
{
    $ironmq->getMessage($queue_name);
}

function post_message($ironmq, $queue_name)
{
    $ironmq->postMessage($queue_name, array("body" => "body"));
}

function queue_worker($iw, $name)
{
    ob_start();
    $tmpdir = $_SERVER['TMP_DIR'];
    if (empty($tmpdir)) {
        $tmpdir = dirname(__FILE__);
    }
    $zipName = $tmpdir . "/$name.zip";
        $file = IronWorker::zipDirectory(dirname(__FILE__) . "/../workers", $zipName, true);
        $res = $iw->postCode('sampleWorker.php', $zipName, $name);
        $payload = array('sample param' => "sample value");
        $task_id = $iw->postTask($name, $payload);
    ob_end_clean();
}

?>

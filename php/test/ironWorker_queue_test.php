<?php
include(__DIR__ . '/../lib/IronWorkerWrapper.php');
$iterations = $_REQUEST['iterations'];
$name = "sampleWorker.php";

$start = get_time();
for ($i = 1; $i <= $iterations; $i++)
{
    queue_worker($iw, $name);
}
$worker_time = get_time() - $start;
$details = array("worker" => $worker_time);
echo json_encode($details);

function get_time()
{
    return (float)array_sum(explode(' ', microtime()));
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

<?php
session_start();
require('firstimport.php');

$tbl_name="train_list"; // Table name

mysqli_select_db($conn,"$db_name")or die("cannot select DB");


$sql="SELECT `Name`, `Origin` FROM $tbl_name";

$result=mysqli_query($conn, $sql) or trigger_error(mysql_error.$sql);

$row=mysqli_fetch_all($result, MYSQLI_ASSOC);

$arr = $row;
$group = 'Name';
$preserveGroupKey = false;
$preserveSubArrays = false;
$temp = array();
foreach($arr as $key => $value) {
    $groupValue = $value[$group];
    if(!$preserveGroupKey)
    {
        unset($arr[$key][$group]);
    }
    if(!array_key_exists($groupValue, $temp)) {
        $temp[$groupValue] = array();
    }

    if(!$preserveSubArrays){
        $data = count($arr[$key]) == 1? array_pop($arr[$key]) : $arr[$key];
    } else {
        $data = $arr[$key];
    }
    $temp[$groupValue][] = $data;
}

// var_dump($temp);

class BFS {
    private $graph;
    private $visited = [];
    private $queue = [];
    private $startNode;
    
    /*  */
    public function __construct($graph, $startNode)
    {
        $this->graph = $graph;
        $this->startNode = $startNode;
        $this->init();
        echo '<br>';
        $this->processHashTree();
    }
    
    Private function init()
    {
        foreach($this->graph as $key => $value)
        {
            $this->visited[$key] = 0;
        }
        print_r($this->visited);
    }
    
    private function processHashTree()
    {
        array_push($this->queue, $this->startNode);
        $this->visited[$this->startNode] = 1;
        while (count($this->queue)) {
            $currentNode = array_shift($this->queue);
            foreach($this->graph[$currentNode] as $key => $vertex){
                if(!$this->visited[$key] && $vertex == 1) {
                    $this->visited[$key] = 1;
                    array_push($this->queue, $key);
                }
            }
        }
    }
}

//$graph = $temp;
$graph = array(
    array(0, 1, 1, 0, 0, 0),
    array(1, 0, 0, 1, 0, 0),
    array(1, 0, 0, 1, 1, 1),
    array(0, 1, 1, 0, 1, 0),
    array(0, 0, 1, 1, 0, 1),
    array(0, 0, 1, 0, 1, 0),
);
$bfs = new BFS($graph, 2);

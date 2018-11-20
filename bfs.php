<?php
session_start();
require('firstimport.php');

$tbl_name="interlist";

mysqli_select_db($conn,"$db_name") or die("cannot select db");
$k=0;
$name1='SHATABDI EXP';
$k=2;
$name1=strtoupper($name1);

$tbl_name="train_list";
$sql="SELECT * FROM $tbl_name WHERE Number='$name1' or Name='$name1' ";
$result=mysqli_query($conn,$sql);

$row=mysqli_fetch_array($result);
var_dump($row);
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
    /*
    $graph = array(
                array(0, 1, 1, 0, 0, 0),
                array(1, 0, 0, 1, 0, 0),
                array(1, 0, 0, 1, 1, 1),
                array(0, 1, 1, 0, 1, 0),
                array(0, 0, 1, 1, 0, 1),
                array(0, 0, 1, 0, 1, 0),
             );
    $bfs = new BFS($graph, 2);
    */
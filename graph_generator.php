<?php
require_once("./libs/jpgraph-4.4.2/src/jpgraph.php");
require_once("./libs/jpgraph-4.4.2/src/jpgraph_line.php");
$graph = new Graph(330,250);
$graph->SetScale("textlin");

if(isset($_GET["graph_data"])) {
    $data = json_decode(urldecode($_GET["graph_data"]),true);
    unset($_GET["graph_data"]);

    $lineplot=new LinePlot(array_values($data));
    $graph->Add($lineplot);

    $graph->xaxis->SetTickLabels(array_keys($data));
    $graph->Stroke();
} else {
    //TODO: redirect to error page
    header("Location: ./index.php");
    exit();
}
/*
function generateGraph($data){
    $graph = new Graph(400,300);
    $graph->SetScale("textlin");

    $lineplot=new LinePlot(array_values($data));
    $graph->Add($lineplot);

    $graph->title->Set("Number of Subscribers Over the Last 5 Months");
    $graph->xaxis->SetTickLabels(array_keys($data));
    return $graph;
}*/

?>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// modifica esempio github


require '../vendor/autoload.php';

use Laudis\Neo4j\Authentication\Authenticate;
use Laudis\Neo4j\ClientBuilder;
use Laudis\Neo4j\Contracts\TransactionInterface;
use Laudis\Neo4j\Databags\Statement;


$corso = $_GET['corso'];
$ore = $_GET['ore'];
$cfu = $_GET['cfu'];

// ->withDriver('https', 'https://localhost:7473', Authenticate::basic('neo4j', 'neo4jneo4j')) // creates an http driver
// ->withDriver('neo4j', 'neo4j://neo4j.test.com?database=my-database', Authenticate::oidc('token')) // creates an auto routed driver with an OpenID Connect token
// ->withDriver('bolt', 'bolt+s://neo4j:neo4jneo4j@localhost:7687') // creates a bolt driver
$client = ClientBuilder::create()
    ->withDriver('bolt', 'bolt://@localhost:7687') // creates a bolt driver
    ->withDefaultDriver('bolt')
    ->build();

// print_r($client);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
  }
  .container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
  }
  .table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  .table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
  }
  .table tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  .table th {
    background-color: lightblue;
  }
</style>
</head>
<body>
  <div class="container">
    <p><a href="elenco_corsi.php">Torna all'elenco dei corsi</a></p>
    <h2>Corso: <?php echo $corso; ?></h2>
    <p>Ore previste: <?php echo $ore; ?></p>
    <p>Crediti Formativi: <?php echo $cfu; ?></p>
    <table class="table">
      <tr>
        <th colspan="2">Materiale disponibile</th>
      </tr>

<?php
 

// estrazione di tutti i records OK
$results = $client->writeTransaction(static function (TransactionInterface $tsx) {
    global $corso;

    $query = "match (c:Corso {nome: '" . $corso . "'})-[:HA_MATERIALE]->(m:Materiale) return m;";
    // echo $query;
    $results = $tsx->run($query);

    foreach ($results as $result) {
        // Returns a Node
        $materiale = $result->get('m');

        echo '<tr>';
        echo '<td>' . $materiale->getProperty('descrizione') . '</td>';
        echo '<td><a target="_blank" href="' . $materiale->getProperty('link') . '">LINK</a></td>';
        echo '</tr>';

    }

    return $results;
});

?>

    </table>
  </div>
</body>
</html>

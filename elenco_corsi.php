<?php
session_start();

require '../vendor/autoload.php';

use Laudis\Neo4j\Authentication\Authenticate;
use Laudis\Neo4j\ClientBuilder;
use Laudis\Neo4j\Contracts\TransactionInterface;
use Laudis\Neo4j\Databags\Statement;


$annocorso = $_SESSION['anno'];
// echo $_SESSION['anno'];

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
  .welcome {
    text-align: right;
  }
  .anno {
    text-align: right;
  }
  .titolo {
    text-align: center;
  }
  .table td.nomecorso {
    text-align: left;
    font-weight: bold;
  }
  .table td.docente {
    text-align: center;
  }
  .table td.ricevimento {
    font-size: 0.95em;
  }
</style>
</head>
<body>
  <div class="container">
    <p class="welcome">
      Benvenuto/a, <strong><?php echo $_SESSION['nome'] . ' ' . $_SESSION['cognome']; ?></strong> 
      (<a href="login.php">Esci</a>)
    </p>
    <p class="anno">
      Anno di corso: <?php echo $_SESSION['anno']; ?>
    </p>
  </div>
  <div class="container">
    <h2 class="titolo">Elenco dei corsi previsti per te</h2>
    <table class="table">
      <tr>
        <th>Corso</th>
        <th>Docente</th>
        <th>Ricevimento</th>
        <th>Dettagli</th>
      </tr>

<?php


// estrazione di tutti i records OK
$results = $client->writeTransaction(static function (TransactionInterface $tsx) {
    global $annocorso;

    // $query = "match (a:AnnoCorso {anno: '" . $annocorso . "'})-[:PREVEDE_CORSO]->(c:Corso) return c;";
    $query = "match (a:AnnoCorso {anno: '" . $annocorso . "'})-[:PREVEDE_CORSO]->(c:Corso)-[:HA_DOCENTE]->(d:Docente) return c, d;";
    // echo $query;
    $results = $tsx->run($query);

    foreach ($results as $result) {
        // Returns a Node
        $corso = $result->get('c');
        $docente = $result->get('d');

        echo '<tr>';
        echo '<td nowrap class="nomecorso">' . $corso->getProperty('nome') . '</td>';
        echo '<td class="docente">' . $docente->getProperty('nome') . '</td>';
        $ricevimento = $docente->getProperty('ricevimento');
        if (strpos($ricevimento, "http") === 0) {
          echo '<td class="ricevimento"><a target="_blank" href="' . $docente->getProperty('ricevimento') . '">Fissa un appuntamento</a></td>';
        } else {
            echo '<td class="ricevimento">' . $docente->getProperty('ricevimento') . '</td>';
        }
        echo '<td><a href="elenco_materiali.php?corso=' . $corso->getProperty('nome') . '&ore=' . $corso->getProperty('ore') . '&cfu=' . $corso->getProperty('cfu') . '">Consulta</a></td>';
        echo '</tr>';

    }

    return $results;
});

?>

    </table>
  </div>
</body>
</html>

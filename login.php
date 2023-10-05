<?php
session_start();

require '../vendor/autoload.php';

use Laudis\Neo4j\Authentication\Authenticate;
use Laudis\Neo4j\ClientBuilder;
use Laudis\Neo4j\Contracts\TransactionInterface;
use Laudis\Neo4j\Databags\Statement;

if (!isset($_POST['username'])) {
    unset($_SESSION['username']);
    unset($_SESSION['nome']);
    unset($_SESSION['cognome']);
    unset($_SESSION['anno']);
}

// Verifica se l'utente è già autenticato
if(isset($_SESSION['username'])) {
    header("Location: elenco_corsi.php");
    exit();
}

// Verifica il login
if(isset($_POST['login'])) {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Validazione dei dati
    $errors = [];

    if(empty($input_username)) {
        $errors[] = "Il campo Username è obbligatorio.";
    }

    if(empty($input_password)) {
        $errors[] = "Il campo Password è obbligatorio.";
    }

    if(count($errors) === 0) {
        // Connessione al database Neo4j
        $client = ClientBuilder::create()
            ->withDriver('bolt', 'bolt://@localhost:7687') // creates a bolt driver
            ->withDefaultDriver('bolt')
            ->build();

        // Esegui la query per verificare le credenziali
        $results = $client->writeTransaction(static function (TransactionInterface $tsx) {
            global $input_username;
            global $input_password;
            global $errors;

            $query = "match (s:Studente {username: '" . $input_username . "', password: '" . $input_password . "'}) return s;";

            // echo $query;
            $results = $tsx->run($query);
            // controlla il risultato
            if ($results->count() == 1) {
                // prende il primo elemento
                try {
                    $studente = $results->first()->get("s");
                    $_SESSION['username'] = $studente->getProperty('username');
                    $_SESSION['nome'] = $studente->getProperty('nome');
                    $_SESSION['cognome'] = $studente->getProperty('cognome');
                    $_SESSION['anno'] = $studente->getProperty('anno');
                    header("Location: elenco_corsi.php");
                    exit();
                }
                catch (Exception $e) {
                    $errors[] = "Credenziali non valide.";
                }
            }
            else {
                $errors[] = "Credenziali non valide.";
            }
            // fill an array with the results
            // foreach ($results as $result) {
            //     // Returns Students
            //     $materiale = $result->get('m');
        
            //     echo '<tr>';
            //     echo '<td>' . $materiale->getProperty('descrizione') . '</td>';
            //     echo '<td><a href="' . $materiale->getProperty('link') . '">LINK</a></td>';
            //     echo '</tr>';
        
            // }
        


            

            return $results;
        });

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pagina di Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form class="login-form" method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" name="login" value="Login">
        </form>
        <?php if(isset($errors) && count($errors) > 0) { ?>
            <div class="error-message">
                <ul>
                    <?php foreach($errors as $error) { ?>
                        <li><?php echo $error; ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</body>
</html>

<?php
// Specifica il percorso del file JSON da cui leggere i dati
$file_path = 'todo-list.json';

// Legge il contenuto del file JSON in una stringa
$json_string = file_get_contents($file_path);

// Decodifica la stringa JSON in un array PHP
$todoList = json_decode($json_string, true);

// Verifica se il metodo della richiesta HTTP è POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verifica se l'azione è impostata nella richiesta POST
    if (isset($_POST['action'])) {

        // Se l'azione è 'add' e il task è impostato
        if ($_POST['action'] == 'add' && isset($_POST['task'])) {

            // Crea un nuovo task
            $new_task = array(
                // L'ID del nuovo task è l'ID dell'ultimo task + 1
                'id' => end($todoList)['id'] + 1,
                // Il testo del task proviene dalla richiesta POST
                'task' => $_POST['task'],
                // Il task  è impostato come non completato
                'completed' => false
            );
            // Aggiunge il nuovo task all'elenco di task
            $todoList[] = $new_task;
        } 

        // Se l'azione è 'remove' e l'ID è impostato
        
        elseif ($_POST['action'] == 'remove' && isset($_POST['id'])) {
           
          // Scorre l'elenco di task
            foreach ($todoList as $i => $task) {
               
              // Se l'ID del task corrisponde all'ID nella richiesta POST e il task è completato
                if ($task['id'] == $_POST['id'] && $task['completed']) {
                    
                  // Rimuove il task dall'elenco
                    array_splice($todoList, $i, 1);
                    break;
                }
            }
        } 

        // Se l'azione è 'toggle' e l'ID e lo stato di completamento sono impostati

        elseif ($_POST['action'] == 'toggle' && isset($_POST['id']) && isset($_POST['completed'])) {

            // Scorre l'elenco di task
            foreach ($todoList as $i => $task) {
                
              // Se l'ID del task corrisponde all'ID nella richiesta POST
                if ($task['id'] == $_POST['id']) {
                    // Modifica lo stato di completamento del task
                    $todoList[$i]['completed'] = $_POST['completed'] == 'true' ? true : false;
                    break;
                }
            }
        }

        // Scrive l'elenco di task aggiornato nel file JSON
        file_put_contents($file_path, json_encode($todoList));
    }
}

// Imposta l'intestazione 'Content-Type' della risposta a 'application/json'
header('Content-Type: application/json');

// Invia l'elenco di task come JSON
echo json_encode($todoList);

?>

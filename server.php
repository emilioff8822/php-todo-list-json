<?php
// Specifico il percorso del file JSON da cui verranno letti i dati
$file_path = 'todo-list.json';

// Carico il contenuto del file "todo-list.json" e lo trasformo in un array PHP
$json_string = file_get_contents($file_path);
$todoList = json_decode($json_string, true);

// Controllo se sto ricevendo dati dal client tramite una richiesta POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Estraggo i dati inviati tramite la richiesta POST
    $data = json_decode(file_get_contents('php://input'), true);

    // Se i dati contengono un'azione
    if (isset($data['action'])) {
      
        // Se l'azione è 'add' e se è presente il campo 'task'
        if ($data['action'] == 'add' && isset($data['task'])) {
            // Creo una nuova attività
            $new_task = array(
                'id' => end($todoList)['id'] + 1,  // Assegno un ID incrementato rispetto all'ultimo ID esistente
                'task' => $data['task'],           // Assegno il testo del task
                'completed' => false                // Imposto lo stato del task come non completato
            );
            // Aggiungo la nuova attività alla lista
            $todoList[] = $new_task;
        } 

        // Se l'azione è 'remove' e se è presente il campo 'id'...
        elseif ($data['action'] == 'remove' && isset($data['id'])) {
            // Scorro tutta la lista di attività...
            foreach ($todoList as $i => $task) {
                // Se l'ID dell'attività corrente corrisponde all'ID ricevuto e il task è completato...
                if ($task['id'] == $data['id'] && $task['completed']) {
                    // Rimuovo l'attività dalla lista
                    array_splice($todoList, $i, 1);
                    break;  // Esco dal ciclo
                }
            }
        } 

        // Se l'azione è 'toggle' e se sono presenti i campi 'id' e 'completed'...
        elseif ($data['action'] == 'toggle' && isset($data['id']) && isset($data['completed'])) {
            // Scorro tutta la lista di attività...
            foreach ($todoList as $i => $task) {
                // Se l'ID dell'attività corrente corrisponde all'ID ricevuto...
                if ($task['id'] == $data['id']) {
                    // Modifico lo stato di completamento dell'attività
                    $todoList[$i]['completed'] = $data['completed'];
                    break;  // Esco dal ciclo
                }
            }
        }

        // Salvo la lista di attività aggiornata nel file JSON
        file_put_contents($file_path, json_encode($todoList));
    }
}

// Imposto il tipo di contenuto della risposta HTTP come JSON
header('Content-Type: application/json');

// Invio la lista di attività al client in formato JSON
echo json_encode($todoList);

?>

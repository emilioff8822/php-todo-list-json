PHP AXIOS

-All'inizio dello script PHP, carico il contenuto del file todo-list.json in una variabile $todoList. Questo file contiene la   lista di task

-Verifico se il metodo della richiesta è POST, cioè se il frontend sta cercando di modificare il  file JSON (aggiungere o rimuovere un task).
if ($_SERVER['REQUEST_METHOD'] == 'POST') 

-Prendo i dati inviati tramite la richiesta POST, li decodifico dal formato JSON e li memorizzo in una variabile $data.
$data = json_decode(file_get_contents('php://input'), true);

-Aggiunta di un nuovo task:
-Verifico se l'azione inviata dal frontend è 'add' e se è stata inviata una nuova task. Se è così, creo un nuovo task con un ID  daato dall'ID dell'ultimo task nella lista più uno e lo aggiungo alla fine della tua lista di task.


-Rimozione di un task:
Se l'azione inviata dal frontend è 'remove' e l'ID del task è specificato, cero questo task nella lista. Se lo trovo, lo rimuovo con array_splice

-salvo la lista aggiornata di task nel  file JSON tramite file put_contents

invio della risposta:

Infine, invio al frontend la lista aggiornata di task in formato JSON. Il frontend userà queste informazioni per aggiornare la vista dell'utente.
header('Content-Type: application/json');
echo json_encode($todoList);


_____________________________________________________

MAIN JS INDEX.PHP

  readlist() {...},
  addTask() {...},
  toggleTask(task) {...},
  removeTask(task) {...},

Ho usato come a lezione Readlist:
 invia una richiesta GET al server per ottenere la lista dei task correnti e assegna la risposta a this.tasks.

AddTask:
 verifica se newTask è una stringa non vuota, invia una richiesta POST al server per aggiungere il nuovo task successivamente, chiama readlist per aggiornare la lista dei task.

 ToggleTaskinvia una richiesta POST al server per cambiare lo stato di completamento di un task, pou chiama readlist per aggiornare la lista dei task.

 RemoveTask:
verifica se un task è stato completato. Se è così, invia una richiesta POST al server per rimuovere il task. dopo chiama readlist per aggiornare la lista dei task. Se il task non è stato completato, mostra un messaggio di errore
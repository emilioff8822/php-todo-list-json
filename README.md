PHP AXIOS
quando invio dati con FormData da JavaScript, PHP li tratta come se fossero stati inviati da un form HTML e li rende disponibili in $_POST.


-All'inizio dello script PHP, carico il contenuto del file todo-list.json in una variabile $todoList. Questo file contiene la   lista di task

-Verifico se il metodo della richiesta è POST, cioè se il frontend sta cercando di modificare il  file JSON (aggiungere o rimuovere un task).
if ($_SERVER['REQUEST_METHOD'] == 'POST') 

-Prendo i dati inviati tramite la richiesta POST, li decodifico dal formato JSON e li memorizzo in una variabile $data.

-Aggiunta di un nuovo task:
-Verifico se l'azione inviata dal frontend è 'add' e se è stata inviata una nuova task. Se è così, creo un nuovo task con un ID  daato dall'ID dell'ultimo task nella lista più uno e lo aggiungo alla fine della tua lista di task.


-Rimozione di un task:
Se l'azione inviata dal frontend è 'remove' e l'ID del task è specificato, cero questo task nella lista. Se lo trovo, lo rimuovo con array_splice

-salvo la lista aggiornata di task nel  file JSON tramite file put_contents

Per 'toggle', cambia lo stato 'completato' del task con l'ID specificato.
 
 
quindi server.php  controlla quale azione è stata richiesta (add, remove, toggle) e agisce di conseguenza. Per 'add', crea un nuovo task e lo aggiunge alla lista. Per 'remove', cerca il task con l'ID specificato e, se è contrassegnato come 'completato', lo rimuove. 
Per 'toggle', cambia lo stato 'completato' del task con l'ID specificato.
invio della risposta:


Infine, invio al frontend la lista aggiornata di task in formato JSON. Il frontend userà queste informazioni per aggiornare la vista dell'utente.
header('Content-Type: application/json');
echo json_encode($todoList);


_____________________________________________________

MAIN JS INDEX.PHP
ho usato questi metodi fondamentalmente:

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

-formData.append('action', 'add');, sto creando un campo chiamato 'action' e impostando il suo valore su 'add'per indicare l'azione che si desidera che il server esegua.
In questo caso specifico, 'add' indica al server che si desidera aggiungere una nuova attività. Quando il server riceve questa richiesta POST, controllerà il campo 'action' e, vedendo che è impostato su 'add', saprà che deve eseguire il codice per aggiungere una nuova attività.

________________
ESEMPIO

Supponiamo che l'utente inserisca "Fare la spesa" nel campo di input e prema il tasto Invio. main.js risponde al seguente modo:

newTask viene impostato su "Fare la spesa".
Viene invocata la funzione addTask.
addTask invia una richiesta POST al server con l'azione 'add' e il task "Fare la spesa".
Se la richiesta va a buon fine, newTask viene svuotato e readlist() viene invocato per aggiornare l'elenco dei task.


Supponiamo che l'utente voglia contrassegnare "Fare la spesa" come completato. Clicca sulla task e main.js agisce nel seguente modo:

toggleTask(task) viene invocato con il task "Fare la spesa" come argomento.
toggleTask invia una richiesta POST al server con l'azione 'toggle' e l'ID del task.
Se la richiesta va a buon fine, readlist() viene invocato per aggiornare l'elenco dei task.


Supponiamo che l'utente voglia rimuovere "Fare la spesa" dalla lista. Clicca sul pulsante 'x' e main.js agisce nel seguente modo:

removeTask(task) viene invocato con il task "Fare la spesa" come argomento.
Se il task è contrassegnato come completato, removeTask invia una richiesta POST al server con l'azione 'remove' e l'ID del task.
Se la richiesta va a buon fine, readlist() viene invocato per aggiornare l'elenco dei task.
Se il task non è contrassegnato come completato, errorMessage viene impostato su 'Impossibile eliminare task non contrassegnata come done.'
const { createApp } = Vue;

// Creazione di un'applicazione Vue
createApp({
  // Funzione che restituisce i dati dell'applicazione
  data() {
    return {
      // URL del file server PHP
      apiUrl: 'server.php',
      // Array per conservare le attività
      tasks: [],
      // Variabile per la nuova attività da aggiungere
      newTask: '',
      // Variabile per eventuali messaggi di errore
      errorMessage: ''
    };
  },

  methods: {
    // Metodo per leggere la lista delle attività dal server

    readlist() {
      // Eseguire una richiesta GET al server
      axios.get(this.apiUrl)
        // Quando la risposta è ricevuta
        .then(result => {
          // Aggiorna l'array delle attività con i dati ricevuti
          this.tasks = result.data;
        });
    },

    // Metodo per aggiungere una nuova attività
    addTask() {
      // Verifica se la nuova attività non è una stringa vuota
      if (this.newTask.trim() !== '') {
       
        // Crea un oggetto FormDa, quando invio dati con FormData da JavaScript, PHP li tratta come se fossero stati inviati da un form HTML e li rende disponibili in $_POST.
        let formData = new FormData();
        // Aggiunge la nuova attività e l'azione al FormData, tramite una coppia chiave valore. Creo  un campo chiamato 'action' e impostando il suo valore su 'add'. Quando il server riceve questa richiesta POST, controllerà il campo 'action' e, vedendo che è impostato su 'add', saprà che deve eseguire il codice per aggiungere una nuova attività.

        formData.append('task', this.newTask.trim());
        formData.append('action', 'add');

        // invia una richiesta POST al server
        axios.post(this.apiUrl, formData)
        // Quando la risposta è ricevuta
        .then(response => {
          // Pulisce la variabile per la nuova attività
          this.newTask = '';
          // Legge la lista delle attività dal server per aggiornare l'array delle attività
          this.readlist();
        })
        // Se c'è un errore, lo stampa nella console
        .catch(error => {
          console.error(error);
        });
      }
    },

    // Metodo per cambiare lo stato di una attività
    toggleTask(task) {
      // Crea un oggetto FormData
      let formData = new FormData();
      // Aggiunge l'ID dell'attività, il nuovo stato e l'azione al FormData
      formData.append('id', task.id);
      formData.append('completed', !task.completed);
      formData.append('action', 'toggle');

      // Invio una richiesta POST al server

      axios.post(this.apiUrl, formData)
      // Quando la risposta è ricevuta
      .then(response => {
        // Legge la lista delle attività dal server per aggiornare l'array delle attività
        this.readlist();
      })
      // Se c'è un errore, lo stampa nella console
      .catch(error => {
        console.error(error);
      });
    },

    // Metodo per rimuovere una attività
    removeTask(task) {
      // Verifica se l'attività è stata completata
      if (task.completed) {
        // Crea un oggetto FormData
        let formData = new FormData();
        // Aggiunge l'ID dell'attività e l'azione al FormData
        formData.append('id', task.id);
        formData.append('action', 'remove');

        // Invio una richiesta POST al server
        axios.post(this.apiUrl, formData)
         // Quando la risposta è ricevuta
         .then(response => {
          // Legge la lista delle attività dal server per aggiornare l'array delle attività
          this.readlist();
        })
        // Se c'è un errore, lo stampa nella console
        .catch(error => {
          console.error(error);
        });
      } else {

        // Se l'attività non è stata completata, mostra un messaggio di errore
        this.errorMessage = 'Impossibile eliminare task, non contrassegnato come done.';
      }
    }
  },

  mounted() {

    // Legge la lista delle attività dal server
    this.readlist();
  }
})
.mount('#app');



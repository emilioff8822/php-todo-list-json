// Importo la funzione 'createApp' dalla libreria Vue.
const { createApp } = Vue;

createApp({
  data() {
    return {
      // L'URL del mio server che gestisce le richieste per l'elenco dei task.
      apiUrl: 'server.php',

      // L'array che contiene l'elenco dei task.
      tasks: [],

      // La variabile per il nuovo task che sarà aggiunto.
      newTask: '',

      // Un messaggio di errore che può essere mostrato all'utente.
      errorMessage: ''
    };
  },

  methods: {

    // Questo metodo legge l'elenco dei task dal server.
    readlist() {
      // Effettuo una richiesta GET al mio server.
      axios.get(this.apiUrl)
        // Quando ricevo una risposta...
        .then(result => {
          // Aggiorno l'elenco dei task con i dati ricevuti dal server.
          this.tasks = result.data;
        });
    },

    // Questo metodo aggiunge un nuovo task.
    addTask() {
      // Controllo se il nuovo task non è vuoto.
      if (this.newTask.trim() !== '') {
        // Effettuo una richiesta POST al mio server per aggiungere il nuovo task.
        axios.post(this.apiUrl, {
          task: this.newTask.trim(),
          action: 'add'
        })
        // Quando ricevo una risposta...
        .then(response => {
          // Pulisco il campo del nuovo task.
          this.newTask = '';

          // Leggo di nuovo l'elenco dei task per aggiornare la lista.
          this.readlist();
        })
        // Se c'è un errore, lo stampo nella console.
        .catch(error => {
          console.error(error);
        });
      }
    },

    // Questo metodo cambia lo stato di un task da non completato a completato e viceversa.
    toggleTask(task) {
      // Effettuo una richiesta POST al mio server per cambiare lo stato del task.
      axios.post(this.apiUrl, {
        id: task.id,
        completed: !task.completed,
        action: 'toggle'
      })
      // Quando ricevo una risposta
      .then(response => {
        // Leggo di nuovo l'elenco dei task per aggiornare la lista.
        this.readlist();
      })
      // Se c'è un errore, lo stampo nella console.
      .catch(error => {
        console.error(error);
      });
    },

    // Questo metodo rimuove un task.
    removeTask(task) {
      // Controllo se il task è stato completato.
      if (task.completed) {
        // Effettuo una richiesta POST al mio server per rimuovere il task.
        axios.post(this.apiUrl, {
          id: task.id,
          action: 'remove'
        })
        // Quando ricevo una risposta
        .then(response => {
          // Leggo di nuovo l'elenco dei task per aggiornare la lista.
          this.readlist();
        })
        // Se c'è un errore, lo stampo nella console.
        .catch(error => {
          console.error(error);
        });
      } else {
        // Se il task non è stato completato, mostro un messaggio di errore.
        this.errorMessage = 'Impossibile eliminare task , non contrassegnato come done.';

      }
    }
  },

  mounted() {
    this.readlist();
  }
})

// collego  Vue all'elemento HTML con l'ID 'app'.
.mount('#app');

const { createApp } = Vue;

createApp({
  data() {
    return {
      apiUrl: 'server.php',
      tasks: [],
      newTask: '',
      errorMessage: ''
    };
  },
  methods: {
    readlist() {
      axios.get(this.apiUrl)
        .then(result => {
          this.tasks = result.data;
        });
    },
    addTask() {
      if (this.newTask.trim() !== '') {
        axios.post(this.apiUrl, {
          task: this.newTask.trim(),
          action: 'add'
        })
        .then(response => {
          this.newTask = '';
          this.readlist();
        })
        .catch(error => {
          console.error(error);
        });
      }
    },
    toggleTask(task) {
      axios.post(this.apiUrl, {
        id: task.id,
        completed: !task.completed,
        action: 'toggle'
      })
      .then(response => {
        this.readlist();
      })
      .catch(error => {
        console.error(error);
      });
    },
    removeTask(task) {
      if (task.completed) {
        axios.post(this.apiUrl, {
          id: task.id,
          action: 'remove'
        })
        .then(response => {
          this.readlist();
        })
        .catch(error => {
          console.error(error);
        });
      } else {
        this.errorMessage = 'Impossibile eliminare task non contrassegnata come done.';
      }
    }
  },
  mounted() {
    this.readlist();
  }
}).mount('#app');

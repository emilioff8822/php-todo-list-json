<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.js' integrity='sha512-w39cIBZHEf0ac8RERRGs+aTrQbBIpb+0qGsMCKfwvJSmN6YV8brsbYN1a/nTmuQgfrGyg7p3WI4HRu1rs3rLvw==' crossorigin='anonymous'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js' integrity='sha512-RjvSEaeDqPCfUVQ9kna2/2OqHz/7F04IOl1/66LmQjB/lOeAzwq7LrbTzDbz5cJzlPNJ5qteNtHR56XaJSTNWw==' crossorigin='anonymous'></script>

  <link rel="stylesheet" href="style.css">
  <title>Todo List</title>
</head>
<body>
  <div id="app">
    <!-- questo e' un campo input per aggiungere nuovi task. La variabile 'newTask' è definita in main.js e viene aggiornata in tempo reale grazie alla direttiva 'v-model'. Quando si preme invio (keyup.enter), il metodo 'addTask', definito nel file main.js, viene chiamato -->
    
    <input type="text" v-model="newTask" @keyup.enter="addTask" placeholder="Scrivi un task...">  

    <!-- Questo è il bottone per aggiungere un nuovo task. Quando viene cliccato (@click), il metodo 'addTask', definito nel file main.js, viene chiamato -->
    <button @click="addTask">Aggiungi</button>

    <!-- Questo è un elenco di task. Per ogni task nell'array 'tasks', definito in main.js, crea un elemento 'li' -->
    <ul>
      <!-- Per ogni task in 'tasks', genera un elemento 'li' -->
      <li v-for="(task, index) in tasks" :key="index">

        <!-- Quando si clicca su un task, il metodo 'toggleTask', definito in main.js, viene chiamato. Se il task è completato, la classe 'done' viene aggiunta a questo div grazie alla direttiva ':class' -->

        <div @click="toggleTask(task)" :class="{'done': task.completed }">
          <!-- Mostra il nome del task -->
          {{ task.task }}
        </div>

        <!-- Questo è il bottone per rimuovere un task. Quando viene cliccato, il metodo 'removeTask', definito nel file main.js, viene chiamato -->
        <button class="delete-btn" @click.stop="removeTask(task)">x</button>
      </li>
    </ul>

    <!-- Se non ci sono task, mostra questo messaggio -->
    <h2 v-if="tasks.length === 0"> Non ci sono task</h2>

    <!-- Se esiste un messaggio di errore, mostralo. La variabile 'errorMessage' è definita in main.js -->
<p v-if="errorMessage" :style="{ color: 'fuchsia', fontSize: '1.5em' }">{{ errorMessage }}</p>
  </div>


  <script src="main.js"></script>
</body>
</html>

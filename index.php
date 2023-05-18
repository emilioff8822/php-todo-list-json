<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.js' integrity='sha512-w39cIBZHEf0ac8RERRGs+aTrQbBIpb+0qGsMCKfwvJSmN6YV8brsbYN1a/nTmuQgfrGyg7p3WI4HRu1rs3rLvw==' crossorigin='anonymous'></script>
  
  
  <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js' integrity='sha512-RjvSEaeDqPCfUVQ9kna2/2OqHz/7F04IOl1/66LmQjB/lOeAzwq7LrbTzDbz5cJzlPNJ5qteNtHR56XaJSTNWw==' crossorigin='anonymous'></script>

  <link rel="stylesheet" href="style.css">

 
  <title>Document</title>
</head>
<body>
  <div id="app">

  <input type="text" v-model="newTask" @keyup.enter="addTask" placeholder="Scrivi un task...">  

<!-- Bottone per aggiungere un nuovo task -->
<button @click="addTask">Aggiungi</button>
<!-- Messaggio d'errore, se presente -->
<p class="error" v-if="errorMsg">{{errorMsg}}</p>

<!-- Lista dei task -->
<ul>
        <!-- Ciclo sui task presenti nell'array "tasks" -->

  <li v-for="(task, index) in tasks" :key="index">
    
    <div @click="task.done = !task.done" :class="{'done': task.done }">
      {{ task.text }}
    </div>
    
    <button class="delete-btn" @click.stop="removeTask(index)">x</button>
  </li>
</ul>
<!-- Messaggio visualizzato se non ci sono task -->
<h2 v-if="tasks.length === 0"> Non ci sono task</h2>


  </div>




<script src="main.js"></script>

</body>
</html>
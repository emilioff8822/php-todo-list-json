<?php
$todoList = [
  [
    'id' => 1,
    'task' => 'Fare la spesa',
    'completed' => false
  ],
  [
    'id' => 2,
    'task' => 'Studiare per l\'esame',
    'completed' => false
  ],
  [
    'id' => 3,
    'task' => 'Chiamare il dottore',
    'completed' => true
  ]
];
// encode converte un array php in una stringa JSON
$json_string = json_encode($todoList);

//put_contents scrive una stringa json in un file
file_put_contents('todo-list.json', $json_string);
?>

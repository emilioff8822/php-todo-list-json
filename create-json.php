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

$json_string = json_encode($todoList);
file_put_contents('todo-list.json', $json_string);
?>

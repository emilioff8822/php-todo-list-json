<?php
$team = [
  [ 
    'nome' => 'Mario',
    'cognome' => 'Rossi',
    'eta' => '18'
  ],
  [ 
    'nome' => 'Francesca',
    'cognome' => 'Bianchi',
    'eta' => '22'
  ],
  [ 
    'nome' => 'Luigi',
    'cognome' => 'Verdi',
    'eta' => '33'
  ]

  ];

  
  $json_string = json_encode($team);
  file_put_contents('json-team.json', $json_string);
  var_dump($json_string);

?>
<?php
$file_path = 'todo-list.json';
$json_string = file_get_contents($file_path);
$todoList = json_decode($json_string, true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['action'])) {
        if ($data['action'] == 'add' && isset($data['task'])) {
            $new_task = array(
                'id' => end($todoList)['id'] + 1,
                'task' => $data['task'],
                'completed' => false
            );
            $todoList[] = $new_task;
        } elseif ($data['action'] == 'remove' && isset($data['id'])) {
            foreach ($todoList as $i => $task) {
                if ($task['id'] == $data['id'] && $task['completed']) {
                    array_splice($todoList, $i, 1);
                    break;
                }
            }
        } elseif ($data['action'] == 'toggle' && isset($data['id']) && isset($data['completed'])) {
            foreach ($todoList as $i => $task) {
                if ($task['id'] == $data['id']) {
                    $todoList[$i]['completed'] = $data['completed'];
                    break;
                }
            }
        }

        file_put_contents($file_path, json_encode($todoList));
    }
}

header('Content-Type: application/json');
echo json_encode($todoList);
?>

<?php

class TodoListAPI {
    private $users = [
        ['id' => 1, 'name' => 'User1', 'token' => 'token123'],
        ['id' => 2, 'name' => 'User2', 'token' => 'token456']
    ];

    private $tasks = [];

    public function createTask($userId, $taskName, $image = null) {
        $user = $this->getUserById($userId);
        if (!$user) {
            return ['error' => 'User not found', 'status' => 404];
        }

        if ($this->userHasTaskInLastMinute($userId)) {
            return ['error' => 'One task per minute limit reached', 'status' => 429];
        }

        $task = [
            'id' => count($this->tasks) + 1,
            'name' => $taskName,
            'userId' => $userId,
            'completed' => false,
            'created_at' => time() // Set the creation time
        ];

        if ($image !== null) {
            $task['image'] = $this->handleImageUpload($image);
        }

        $this->tasks[] = $task;

        return ['data' => $task, 'status' => 201]; // 201 Created
    }

    public function updateTask($taskId, $taskName, $completed, $image = null) {
        $task = $this->getTaskById($taskId);
        if (!$task) {
            return ['error' => 'Task not found', 'status' => 404];
        }

        $task['name'] = $taskName;
        $task['completed'] = $completed;

        if ($image !== null) {
            $task['image'] = $this->handleImageUpload($image);
        }

        return ['data' => $task, 'status' => 200]; // 200 OK
    }

    public function deleteTask($taskId) {
        $index = array_search($taskId, array_column($this->tasks, 'id'));

        if ($index === false) {
            return ['error' => 'Task not found', 'status' => 404];
        }

        array_splice($this->tasks, $index, 1);

        return ['success' => true, 'status' => 204]; // 204 No Content
    }

    public function completeTask($taskId) {
        $task = $this->getTaskById($taskId);
        if (!$task) {
            return ['error' => 'Task not found', 'status' => 404];
        }

        $task['completed'] = true;

        return ['data' => $task, 'status' => 200]; // 200 OK
    }

    private function getUserById($userId) {
        return array_filter($this->users, function ($user) use ($userId) {
            return $user['id'] == $userId;
        })[0] ?? null;
    }

    private function getTaskById($taskId) {
        return array_filter($this->tasks, function ($task) use ($taskId) {
            return $task['id'] == $taskId;
        })[0] ?? null;
    }

    private function userHasTaskInLastMinute($userId) {
        $lastMinute = time() - 60;
        $userTasks = array_filter($this->tasks, function ($task) use ($userId, $lastMinute) {
            return $task['userId'] == $userId && $task['created_at'] > $lastMinute;
        });

        return count($userTasks) > 0;
    }

    private function handleImageUpload($image) {
        // Simulating a basic image upload process
        $uploadDir = 'uploads/';
        $imageName = uniqid('image_') . '.jpg';
        move_uploaded_file($image, $uploadDir . $imageName);

        return $uploadDir . $imageName;
    }
}

$todoListAPI = new TodoListAPI();

// Create a task
$result = $todoListAPI->createTask(1, 'Buy tools', 'desktop/image.jpg');
print_r($result);

// Update a task
$result = $todoListAPI->updateTask(1, 'Buy snacks', true, 'desktop/new/image.jpg');
print_r($result);

// Complete a task
$result = $todoListAPI->completeTask(1);
print_r($result);

// Delete a task
$result = $todoListAPI->deleteTask(1);
print_r($result);
<?php

class TodoListAPITest {
    private $todoListAPI;

    public function setUp(): void {
        $this->todoListAPI = new TodoListAPI();
    }

    public function testCreateTask() {
        $result = $this->todoListAPI->createTask(1, 'Buy tools', 'desktop/image.jpg');

        if (!array_key_exists('id', $result)) {
            throw new Exception('Task creation failed: Missing "id" key in result');
        }

        if ($result['name'] !== 'Buy tools') {
            throw new Exception('Task creation failed: Unexpected task name');
        }

        if ($result['completed'] !== false) {
            throw new Exception('Task creation failed: Task should not be completed');
        }
    }

    public function testUpdateTask() {
        $this->todoListAPI->createTask(1, 'Buy tools', 'desktop/image.jpg');
        $result = $this->todoListAPI->updateTask(1, 'Buy snacks', true, 'desktop/image.jpg');

        if ($result['name'] !== 'Buy snacks') {
            throw new Exception('Task update failed: Unexpected task name');
        }

        if ($result['completed'] !== true) {
            throw new Exception('Task update failed: Task should be completed');
        }
    }

    public function testCompleteTask() {
        $this->todoListAPI->createTask(1, 'Buy tools', 'desktop/new/image.jpg');
        $result = $this->todoListAPI->completeTask(1);

        if ($result['completed'] !== true) {
            throw new Exception('Task completion failed: Task should be completed');
        }
    }

    public function testDeleteTask() {
        $this->todoListAPI->createTask(1, 'Buy tools', 'desktop/new/image.jpg');
        $result = $this->todoListAPI->deleteTask(1);

        if ($result['success'] !== true) {
            throw new Exception('Task deletion failed: Deletion unsuccessful');
        }
    }

    public function testUserOneTaskPerMinuteLimit() {
        $this->todoListAPI->createTask(1, 'Task 1');

        $result = $this->todoListAPI->createTask(1, 'Task 2');

        if (!array_key_exists('error', $result) || $result['error'] !== 'One task per minute limit reached') {
            throw new Exception('User task limit failed: Limit not enforced');
        }
    }
}
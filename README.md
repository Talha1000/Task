Task 1: TodoListAPI
This is a simple Todo List API written in PHP, providing basic functionality for creating, updating, completing, and deleting tasks. The API supports task management for different users with a one-task-per-minute limit.

Features
Create Task: Allows users to create a new task with an optional image upload.
Update Task: Enables users to update the details of an existing task, including task name, completion status, and optional image upload.
Complete Task: Marks a task as completed.
Delete Task: Removes a task from the list.
Task Creation Limit: Enforces a one-task-per-minute limit for each user.
Installation
No specific installation is required. Simply include the TodoListAPI class in your PHP project.

Usage
1. Create an instance of the TodoListAPI class 
2. Use the provided methods to manage tasks

TodoListAPITest
The TodoListAPITest class provides unit tests for the TodoListAPI class. These tests cover task creation, updating, completion, deletion, and the user's one-task-per-minute limit.


Task 2: Factorial Calculator
This PHP script provides a simple factorial calculator through a web interface. It takes a non-negative integer as input and returns its factorial in JSON format.

Usage
To use the factorial calculator, make a GET request to the script with the 'n' parameter set to a non-negative integer. The script will respond with a JSON object containing the input number and its factorial.
The script defines a function calculateFactorial($n) that recursively calculates the factorial of a given non-negative integer. It includes input validation to ensure the provided parameter is a non-negative integer.

If the input is valid, the script returns a JSON response with the input number and its factorial. If the input is invalid, it returns a 400 Bad Request response with an error message.

Setup
Simply place the factorial.php file on a web server with PHP support. Make sure to check the server's PHP version compatibility.

API Endpoint
The API endpoint for the factorial calculator is factorial.php. It can access any HTTP client that supports GET requests.

Parameters
n: The non-negative integer for which the factorial is to be calculated.
Response
The script responds with a JSON object containing the input number and its factorial. In case of an error or invalid input, it returns a JSON object with an error message and a 400 Bad Request status.

Error Handling
If the 'n' parameter is missing, the script returns a 400 Bad Request response with an error message.
If the input is not a non-negative integer, the script returns a 400 Bad Request response with an error message.


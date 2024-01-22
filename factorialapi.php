<?php

function calculateFactorial($n) {
    if ($n === 0 || $n === 1) {
        return 1;
    } else {
        return $n * calculateFactorial($n - 1);
    }
}

if (isset($_GET['n'])) {

    $n = $_GET['n'];


    if (is_numeric($n) && $n >= 0 && is_int($n + 0)) {

        $result = calculateFactorial($n);


        $response = array(
            'input' => $n,
            'factorial' => $result,
        );

        header('Content-Type: application/json');


        echo json_encode($response);
    } else {

        header("HTTP/1.1 400 Bad Request");
        echo json_encode(array('error' => 'Invalid input. Please provide a non-negative integer.'));
    }
} else {

    header("HTTP/1.1 400 Bad Request");
    echo json_encode(array('error' => 'Missing parameter. Please provide the "n" parameter.'));
}
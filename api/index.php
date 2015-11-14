<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function() use ($app) {
    echo "Welcome to BMI Restful API";
});

$app->get('/bmi/height/:height/weight/:weight', function($height, $weight) use ($app) {
    
    $app->response()->header('Content-Type', 'application/json');
    
    $app->response()->setStatus(400);
    
    $result = getResult($weight, $height);
    
    echo json_encode($result);
});

function getResult($weight, $height) {
    
    //Calculate BMI
    $bmi = $weight / ($height * $height);
    
    //Give a description
    $description = getDescription($bmi);

    return array('bmiIndex'=>$bmi, 'description'=>$description);
}

function getDescription($bmi) {
    if($bmi <= 15) {
        return "very severely underweight";
    }
    else if($bmi > 15 && $bmi <= 16) {
        return "severely underweight";
    }
    else if($bmi > 16 && $bmi <= 18.5) {
        return "underweight";
    }
    else if($bmi > 18.5 && $bmi <= 25) {
        return"Healthy";
    }
    else if($bmi > 25 && $bmi <= 30) {
        return"overweight";
    }
    else if($bmi > 30 && $bmi <= 35) {
        return "obese class I";
    }
    else if($bmi > 35 && $bmi <= 40) {
        return "obese class II";
    }
    else {
        return "obese class III";
    }
}

$app->run();
?>
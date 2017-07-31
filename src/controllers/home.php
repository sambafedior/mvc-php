<?php
function hello($name, $age){

    echo getRenderedView("home/hello", [
       "name" => $name,
        "age" => $age
    ]);
}
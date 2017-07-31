<?php
$routes = [
    "/" => "home:index",
    "/ged/list" => "ged:list",
    "/hello/(\w+)/(\d+)" => "home:hello",
    "/catalogue/liste" => "catalogue:index",
    "/catalogue/par-auteur/(\w+)" => "catalogue:getBookByAuthor"
];

return $routes;
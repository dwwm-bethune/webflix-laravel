<?php

function hello($count = 1, $name) {
    return 'Hello '.$name;
}

hello(name: 'Fiorella');

function hello2($get) {
    return $get('Fiorella');
}

hello2(function ($name) {
    return 'Salut '.$name;
});

hello2(get: fn ($name) => 'Salut '.$name);

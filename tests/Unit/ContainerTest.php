<?php

use Core\Container;

test('it can resolve something out of the container', function () {
    //arrange the world 
    $container = new Container();
    $container->bind('foo', fn()=>'bar');
    //act
    $result = $container->resolve('foo');
    //assert or expect
    expect($result)->toEqual('bar');
});

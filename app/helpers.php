<?php

if (! function_exists('avatar')) {
    function avatar($userEntity)
    {
        return Avatar::create($userEntity->name)->toBase64();
    }
}

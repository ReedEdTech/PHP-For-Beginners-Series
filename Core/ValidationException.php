<?php

namespace Core;

class ValidationException extends \Exception {
    public readonly array $errors; //crazy workaround to get the form's errors
    public readonly array $old; //old form data

    //this is weird! 
    //using a static function that calls my own constructor
    public static function throw( $errors, $old ){
        //give birth to a ValidationException & store it
        $instance = new static;

        $instance->errors = $errors;
        $instance->old = $old;
        //now throw this exception that I just created
        throw $instance;
    }

}
<?php

namespace Http\Forms;
use Core\Validator;
use Core\ValidationException;

class LoginForm{
    protected $errors = [];
    //i also have an $attributes array because of the way we did the constructor parameter

    public function __construct( public array $attributes ){  
        //$attributes is an assoc array w/'email' & 'password' key/val pairs
        //public array trick = declared it as a public member variable??

        //As soon as you instantiate the LoginForm, you validate the inputs!
        //validate form inputs
        if( !Validator::email( $attributes['email'] ) )
            $this->errors['email'] = 'Please provide a valid email address';
        if( !Validator::string( $attributes['password'] , 5  ) )
            $this->errors['password'] = 'Please enter a valid password';

    }

    public static function validate( $attributes ){
        //when this STATIC function is called, we instantiate an instance of the class
        $instance = new static( $attributes ); //that (maybe) fills the errors array
        //dd($instance->errors);
        //let's throw an Exception if we had errors
        return $instance->failed() ? $instance->throw() : $instance;

        /* that return statement is a fancy way to do this
        if( $instance->failed() ){
            //throw new ValidationException(  ); 
            $instance->throw();   
        }

        // no errors?  return this insance of LoginForm
        return $instance;
        */
 
    }

    public function throw(){
        ValidationException::throw( $this->errors(), $this->attributes );
    }

    public function failed(){
        return count( $this->errors );
    }

    public function errors(){
        return $this->errors;
    }

    public function error($field, $message){
        $this->errors[$field] = $message;
        return $this;
    }

}
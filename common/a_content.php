<?php

namespace common;

abstract class a_content
{
    public function __construct(){
        session_start();
    }
    abstract function show_content(): void;
}
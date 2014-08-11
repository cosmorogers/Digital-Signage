<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 06/08/14
 * Time: 15:42
 */



abstract class AbstractWidget
{

    private $name;
    private $description;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function form($settings)
    {
        return '<form><fieldset></fieldset></form>';
    }

    abstract public function view($settings, Screen $screen);

    public function update($settings)
    {
        //Nothing to save
        return true;
    }

    public function scripts()
    {
        return array();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }
} 
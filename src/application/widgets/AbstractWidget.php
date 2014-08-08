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

    abstract public function form($settings);

    abstract public function view($settings);

    public function update($settings)
    {
        //Nothing to save
        return true;
    }

    public function scripts()
    {
        return '';
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
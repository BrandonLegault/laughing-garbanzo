<?php
declare(strict_types=1);
namespace App\Helpers;

class View
{
    private $data = [];
    private $file; // the file to render

    public function __construct($template)
    {
        try {
            $file = getcwd() . "\\App\\Views\\" . strtolower($template) . '.php';
            if (file_exists($file)) {
                $this->file = $file;
            } else {
                throw new \Exception('Template file ' . $template . ' was not found!');
            }
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function set($variable, $value)
    {
        $this->data[$variable] = $value;
    }

    public function render()
    {
        extract($this->data);
        if (isset($this->file)) {
            include $this->file;
        }
    }
}
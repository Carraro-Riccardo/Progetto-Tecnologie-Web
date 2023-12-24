<?php 

class PageBuilder {
    public static function build($name) {
        $name = basename($name, ".php");

        $page = file_get_contents("./html_pages/{$name}.html");
        return $page;
    }
}


?>
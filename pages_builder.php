<?php 

class PageBuilder {

    private static function removeCircularLinks(&$page, $name) : void {
		$to_find = '/<a href="' . $name . '\.php.*?"([^>]*?)>(.*?)<\/a>/s';
		$page = preg_replace($to_find, '<span class="active"${1}>${2}</span>' , $page);
	}


    public static function build($name) {
        $name = basename($name, ".php");

        $page_content = file_get_contents("./html_pages/{$name}.html");
        self::removeCircularLinks($page_content, $name);
        return $page_content;
    }
}


?>
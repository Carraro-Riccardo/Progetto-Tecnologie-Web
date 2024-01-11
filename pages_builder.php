<?php 

class PageBuilder {

    private static function removeCircularLinks(&$page, $name) : void {
		$to_find = '/<a href=".\/' . $name . '\.php.*?"([^>]*?)>(.*?)<\/a>/s';
		$page = preg_replace($to_find, '<span ${1}>${2}</span>' , $page);
	}


    public static function build($name) {
        $name = basename($name, ".php");

        $page_content = file_get_contents("./html_pages/{$name}.html");
        $footer = file_get_contents("./html_pages/componenti/footer.html");
        $navbar = file_get_contents("./html_pages/componenti/navbar-principale.html");
        $page_content = str_replace("@@navbar@@", $navbar, $page_content);
        self::removeCircularLinks($page_content, $name);
        $page_content = str_replace("@@footer@@", $footer, $page_content);
        return $page_content;
    }
}


?>
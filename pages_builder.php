<?php 

class PageBuilder {

    public static function removeAncorLinks(&$page, $name) : void {
        $to_find = '/<a href=".\/' . $name . '.*?"([^>]*?)>(.*?)<\/a>/s';
        $page = preg_replace($to_find, '<span ${1}>${2}</span>' , $page);
    }

    private static function removeCircularLinks(&$page, $name) : void {
		$to_find = '/<a href=".\/' . $name . '\.php.*?"([^>]*?)>(.*?)<\/a>/s';
		$page = preg_replace($to_find, '<span class="currentPage"${1}>${2}</span>' , $page);
	}


    public static function build($name) {
        $name = basename($name, ".php");

        $page_content = file_get_contents("./html_pages/{$name}.html");
        $footer = file_get_contents("./html_pages/componenti/footer.html");
        $navbar = file_get_contents("./html_pages/componenti/navbar-principale.html");
        $torna_su = file_get_contents("./html_pages/componenti/torna_su.html");
        $page_content = str_replace("@@navbar@@", $navbar, $page_content);
        self::removeCircularLinks($page_content, $name);
        if(isset($_SESSION["user_id"])){
            $page_content = str_replace("@@USER@@", $_SESSION['user_id'], $page_content);
            $page_content = str_replace("@@logout@@", "<li><a href='logout.php'><span lang='en'>Log out</span></a></li>", $page_content);
        }else{
            $page_content = str_replace("@@USER@@", "Login", $page_content);
            $page_content = str_replace("@@logout@@", "", $page_content);
        }

        if($name != "error404" && $name != "error500")
            $page_content = str_replace("</main>", $torna_su."\n</main>", $page_content);
        $page_content = str_replace("@@footer@@", $footer, $page_content);
        
        return $page_content;
    }
}


?>
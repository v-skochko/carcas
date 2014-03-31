<?php
$styles = array(
    "style.css"
);
$mincss = "";
foreach ($styles as $css) {
    $mincss .= file_get_contents($css);
}
$mincss = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $mincss);
$mincss = str_replace(': ', ':', $mincss);
$mincss = str_replace(array("\r\n",'    ','     '), '', $mincss);
$mincss = str_replace(';}','}', $mincss);
$modified = 0;
$offset = 60 * 60 * 24 * 7;
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $modified) {
    header("HTTP/1.0 304 Not Modified");
    header ('Cache-Control:');
} else {
    header ('Cache-Control: max-age=' . $offset);
    header ('Content-type: text/css; charset=UTF-8');
    header ('Pragma:');
    header ("Last-Modified: ".gmdate("D, d M Y H:i:s", $modified )." GMT");
    if(extension_loaded('zlib')){ob_start('ob_gzhandler');}
        ob_start("compress");
            echo $mincss;
        ob_end_flush();
    if(extension_loaded('zlib')){ob_end_flush();}
}
?>

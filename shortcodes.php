<?php
//about page
function grid_otc($attr,$content) {
    return '<div class="categories cfx">'.$content.'</div>';
}
add_shortcode('buttons', 'grid_otc');

//posts
function postrow($atts, $content) {
    extract(shortcode_atts(array(
        "title" => ''
    ), $atts));
    return '<div class="post"><h5>'.$title.'</h5><p>'.$content.'</p></div>';
}
add_shortcode('post', 'postrow');

//responsive columns wrapper
function cols_wrap($atts,$content){
extract(shortcode_atts(array(
        "num" => ''
    ), $atts));
    return '<div class="short_col'.$num.' cfx">'.do_shortcode(str_replace('<br />','', $content)).'</div>';
}
add_shortcode("cols","cols_wrap");

//simple column
function simple_col($atts,$content){
extract(shortcode_atts(array(
        "middle" => ''
    ), $atts));
    if(!empty($middle)){
        $class = ' class="middle"';
    }
    return '<div'.$class.'>'.do_shortcode($content).'</div>';
}
add_shortcode("col","simple_col");

//horizontal list
function horizontal($atts,$content){
    return '<div class="hori_list cfx">'.$content.'</div>';
}
add_shortcode("list","horizontal");

add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content){
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}

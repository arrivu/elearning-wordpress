<?php
function register_post_assets(){
    add_meta_box('featured-post', __('Featured Post'), 'add_featured_meta_box', 'post', 'advanced', 'high');
}
add_action('admin_init', 'register_post_assets', 1);

function add_featured_meta_box($post){
    $featured = get_post_meta($post->ID, '_featured-post', true);
    //echo $featured;
    if($featured=='1')
      $check="checked='checked'";
    else
      $check="";
    echo "<label for='_featured-post'>".__('Feature this post?', 'foobar')."</label>";
    //echo "<input type='checkbox' name='_featured-post' id='featured-post' value='1' ".checked(1, $featured)." />";
    echo "<input type='checkbox' name='_featured-post' id='featured-post' value='1' ".$check." />";
}

function save_featured_meta($post_id){
    // Do validation here for post_type, nonces, autosave, etc...
  //global $wpdb;
  //$featurepost=esc_attr($_REQUEST['_featured-post']);
  //$qry='insert into wp_postmeta(post_id,meta_key,meta_value) values("'.$post_id.'","_featured-post","'.$featurepost.'")';
  //$wpdb->query($qry);
    if (isset($_POST['_featured-post']))
       update_post_meta( $post_id, '_featured-post', esc_attr( $_POST['_featured-post'] ) );  
        //update_post_meta(esc_attr($post_id, '_featured-post', esc_attr($_POST['_featured-post']))); 
        // I like using _ before my custom fields, so they are only editable within my form rather than the normal custom fields UI
}
add_action('save_post', 'save_featured_meta');




function seo_meta() { echo '<meta name="title" content="'; 
          if (function_exists('is_tag') && is_tag()) {
             single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
          elseif (is_archive()) {
             wp_title(''); echo ' Archive - '; }
          elseif (is_search()) {
             echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
          elseif (!(is_404()) && (is_single()) || (is_page())) {
             wp_title(''); echo ' - '; }
          elseif (is_404()) {
             echo 'Not Found - '; }
          if (is_home()) {
             bloginfo('name'); echo ' - '; bloginfo('description'); }
          else {
              bloginfo('name'); }
          if ($paged>1) {
             echo ' - page '. $paged; }
       echo '" />';
       echo "\n";
  if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); 
 echo '<meta name="description" content="'; the_excerpt_rss(); echo '" />';
 endwhile; endif; elseif(is_home()) : 
 echo '<meta name="description" content="'; bloginfo('description'); echo '" />'; 
 endif; 
 echo "\n";
 csv_tags(); 
 echo "\n";
     echo '<title>';    
          if (function_exists('is_tag') && is_tag()) {
             single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
          elseif (is_archive()) {
             wp_title(''); echo ' Archive - '; }
          elseif (is_search()) {
             echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
          elseif (!(is_404()) && (is_single()) || (is_page())) {
             wp_title(''); echo ' - '; }
          elseif (is_404()) {
             echo 'Not Found - '; }
          if (is_home()) {
             bloginfo('name'); echo ' - '; bloginfo('description'); }
          else {
              bloginfo('name'); }
          if ($paged>1) {
             echo ' - page '. $paged; }
     echo '</title>';
}

function csv_tags() {
  $posttags = get_the_tags();
  foreach((array)$posttags as $tag) {
    $csv_tags .= $tag->name . ',';
  }
  echo '<meta name="keywords" content="'.$csv_tags.'" />';
}

/*******************************
 MENUS SUPPORT
********************************/
if ( function_exists( 'wp_nav_menu' ) ){
  if (function_exists('add_theme_support')) {
    add_theme_support('nav-menus');
    add_action( 'init', 'register_my_menus' );
    function register_my_menus() {
      register_nav_menus(
        array(
          'main-menu' => __( 'Main Menu' )
        )
      );
    }
  }
}
/* CallBack functions for menus in case of earlier than 3.0 Wordpress version or if no menu is set yet*/

function primarymenu(){ ?>
      <div id="mainMenu" class="ddsmoothmenu">
        <ul>
          <?php wp_list_pages('title_li='); ?>
          <?php wp_list_categories('hide_empty=1&exclude=1&title_li='); ?>
        </ul>
      </div>
<?php }

  // Add RSS links to <head> section
  automatic_feed_links();
  
  // Load jQuery
  if ( !is_admin() ) {
     wp_deregister_script('jquery');
     wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"), false);
     wp_enqueue_script('jquery');
  }
  
  // Clean up the <head>
  function removeHeadLinks() {
      remove_action('wp_head', 'rsd_link');
      remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
  // Declare sidebar widget zone
    if (function_exists('register_sidebar')) {
      register_sidebar(array(
        'name' => 'Sidebar Widgets',
        'id'   => 'sidebar-widgets',
        'description'   => 'These are widgets for the sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
      ));
    }
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
register_sidebar(array('name'=>'Blog Subcribe',));
register_sidebar(array('name'=>'Text_Above_Footer',));
register_sidebar(array('name'=>'Free Lesson Section',));
register_sidebar(array('name'=>'Featured Instructors Section',));
register_sidebar(array('name'=>'Featured Instructors Bottom',));
register_sidebar(array('name'=>'Testimonials',));
?>
<?php function _mam_paginate($numrows,$limit=10,$range=7) {
   $pagelinks = "<div class=\"pagelinks\">";
  // $currpage = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
    $currpage = get_bloginfo('url'). "?" . $_SERVER['QUERY_STRING'];
   if ($numrows > $limit) {
      if(isset($_GET['mypage'])){
         $mypage = $_GET['mypage'];
      } else {
         $mypage = 1;
      }
      $url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
      $pageID = url_to_postid($url[0]);
      $siteurl=get_site_url();
      $currpage=$siteurl."?page_id=".$pageID. "?mypage=" .$mypage;
      //$currpage = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
       //$currpage = get_bloginfo('url'). "?" . $_SERVER['QUERY_STRING'];
      $currpage = str_replace("?mypage=".$mypage,"",$currpage); // Use this for non-pretty permalink
      $currpage = str_replace("?mypage=".$mypage,"",$currpage); // Use this for pretty permalink
      if($mypage == 1){
         $pagelinks .= "<span class=\"pageprevdead\">&laquo PREV </span>";
      }else{
         $pageprev = $mypage - 1;
         $pagelinks .= "<a class=\"pageprevlink\" href=\"" . $currpage .
               "&mypage=" . $pageprev . "\">&laquo PREV </a>";
      }
      $numofpages = ceil($numrows / $limit);
      if ($range == "" or $range == 0) $range = 7;
      $lrange = max(1,$mypage-(($range-1)/2));
      $rrange = min($numofpages,$mypage+(($range-1)/2));
      if (($rrange - $lrange) < ($range - 1)) {
         if ($lrange == 1) {
            $rrange = min($lrange + ($range-1), $numofpages);
         } else {
            $lrange = max($rrange - ($range-1), 0);
         }
      }
      if ($lrange > 1) {
         $pagelinks .= "<a class=\"pagenumlink\" " .
            "href=\"" . $currpage . "&mypage=" . 1 . 
            "\"> [1] </a>";
         if ($lrange > 2) $pagelinks .= "&nbsp;...&nbsp;";
      } else {
         $pagelinks .= "&nbsp;&nbsp;";
      }
      for($i = 1; $i <= $numofpages; $i++){
         if ($i == $mypage) {
            $pagelinks .= "<span class=\"pagenumon\"> [$i] </span>";
         } else {
            if ($lrange <= $i and $i <= $rrange) {
               $pagelinks .= "<a class=\"pagenumlink\" " .
                        "href=\"" . $currpage . "&mypage=" . $i . 
                        "\"> [" . $i . "] </a>";
            }
         }
      }
      if ($rrange < $numofpages) {
         if ($rrange < $numofpages - 1) $pagelinks .= "&nbsp;...&nbsp;";
            $pagelinks .= "<a class=\"pagenumlink\" " .
               "href=\"" . $currpage . "&mypage=" . $numofpages . 
               "\"> [" . $numofpages . "] </a>";
      } else {
         $pagelinks .= "&nbsp;&nbsp;";
      }
      if(($numrows - ($limit * $mypage)) > 0){
         $pagenext = $mypage + 1;
         $pagelinks .= "<a class=\"pagenextlink\" href=\"" . $currpage .
                    "&mypage=" . $pagenext . "\"> NEXT &raquo;</a>";
      } else {
         $pagelinks .= "<span class=\"pagenextdead\"> NEXT &raquo;</span>";
      }

   }
$pagelinks .= "</div>";
return $pagelinks;
}
/*
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) {
    global $woocommerce;
 
    if ( !$order_id )
        return;
    $order = new WC_Order( $order_id );
    $order->update_status( 'completed' );
    $direct=ABSPATH;
global $wpdb;
require_once($direct."/course.php");
$course=new Course(); 
global $current_user;

$order_item_id="select order_item_id from wp_woocommerce_order_items where order_id=".$order_id;
$get_order_item_id=$wpdb->get_row($order_item_id);  

$product_ids="select meta_value from wp_woocommerce_order_itemmeta where meta_key='_product_id' and order_item_id=".$get_order_item_id->order_item_id;

$get_product_ids=$wpdb->get_row($product_ids);

$get_lmsid="select lms_id from wp_posts where ID=".$get_product_ids->meta_value;
$getlms=$wpdb->get_row($get_lmsid);
$get_userlmsid="select user_lms from wp_users where ID=".$current_user->ID;
$get_userlms=$wpdb->get_row($get_userlmsid);
$courses=$course->enroll_user($getlms->lms_id,$get_userlms->user_lms);


}
*/
function change_role_name() {
    global $wp_roles;

    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    //You can list all currently available roles like this...
    //$roles = $wp_roles->get_names();
    //print_r($roles);

    //You can replace "administrator" with any other role "editor", "author", "contributor" or "subscriber"...
    $wp_roles->roles['author']['name'] = 'Instructor';
    $wp_roles->role_names['author'] = 'Instructor';           
}
add_action('init', 'change_role_name');


?>
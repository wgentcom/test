<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<div id="main-content">
 <div class="articles">
  <h1>Статьи</h1>
<?
$Posts=get_posts(['posts_per_page' => $GLOBALS['wp_query']->post_count,	'orderby' => 'date', 'order' => 'DESC']);
foreach($Posts as $Post){ 
 $Author=get_user_by('id', $Post->post_author);
?>
  <div class="post announce">
   <a href="<?=q($Post->guid)?>"><?
 if( $thumb=get_the_post_thumbnail_url($Post->ID) ){?>
    <div class="post thumb" style="background-image:url(<?=q($thumb)?>);"></div><?	 
	}
?>
    <div class="post title"><?=$Post->post_title?></div>
    <div class="post excerpt"><?=$Post->post_excerpt?></div>
   </a>
   <div class="post voteauthor">
    <div class="post author"><span>Автор:</span> <?=$Author->display_name?></div>
    <div class="post vote">
     <div class="post button plus" rel="<?=$Post->ID?>"></div>
     <div class="post vote-value" id="val<?=$Post->ID?>">&nbsp;</div>
     <div class="post button minus" rel="<?=$Post->ID?>"></div>
    </div>
   </div>
  </div>

<?
} //foreach $Posts
?>

	<?php get_template_part( 'template-parts/pagination' ); ?>
 </div>
 <div class="sidebar">
	 Sidebar
	</div>
</div><!-- #site-content -->

<?php /* get_template_part( 'template-parts/footer-menus-widgets' ); */ ?>

<?php
get_footer();
?>
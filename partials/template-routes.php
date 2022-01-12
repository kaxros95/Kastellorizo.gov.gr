<?php
/*
*
*
* Template Name: Route Manager
*
*/
get_header(); ?>

<div class="container">
    <h2> <?php the_title(); ?> </h2>

    <?php the_content(); ?> 
    
</div>

<?php get_footer(); ?>

<style>
.container{
    justify-content:center;
    text-align:center;
}
.container h2{
    padding:2rem;
}
</style>
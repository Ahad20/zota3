<div class="post item-post single-related">   
    <figure class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
        <a href="<?php the_permalink(); ?>"  class="entry-image">
        <?php the_post_thumbnail( array(80, 80) ); ?>
        </a> 
    </figure>
    <div class="entry-header">

        <?php if ( get_the_title() ) : ?>
            <h3 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <ul class="entry-meta-list">
                <li class="entry-date"><?php echo zota_time_link(); ?></li>
                <li class="entry-author"> <?php echo get_the_author_posts_link(); ?></li>
            </ul>
        <?php endif; ?>
    </div>
</div>

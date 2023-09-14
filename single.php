<?php get_header(); ?>
  <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
    
    <article class="post">

      <div class="post__meta">
        <h2><?php the_title(); ?></h2>
        <h3 class="ref">
          Référence : <?php the_field('référence') ;?> <br>
        </h3>
        <h3>
            <?php 
                $taxonomy = 'categorie'; // Remplacez par le nom de la taxonomie que vous souhaitez afficher
                $terms = get_the_terms(get_the_ID(), $taxonomy);

                if ($terms && !is_wp_error($terms)) {
                    echo 'Catégories : ';
                    foreach ($terms as $term) {
                        echo '<a href="' . esc_url(get_term_link($term)) . '" class="therme">' . esc_html($term->name) . '</a> ';
                    }
            } ?>
        </h3>
        <h3>
            <?php $taxonomy = 'format'; // Remplacez par le nom de la taxonomie que vous souhaitez afficher
                $terms = get_the_terms(get_the_ID(), $taxonomy);

            if ($terms && !is_wp_error($terms)) {
                echo 'Formats : ';
                foreach ($terms as $term) {
                    echo '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a> ';
                }
            } ?>
        </h3>

        <h3>
            Type : <?php the_field('type') ;?> <br>
        </h3>
        <h3>
            Année : <?php the_field('annee') ;?> 
        </h3>
      </div>

      <?php the_post_thumbnail(); ?>
    </article>
    <div class="post-interesting">
        <div class="post-contact">
            <p>Cette photo vous intéresse ?</p>
            <button class="post-contact-button">Contact</button>
           <?php  
             get_template_part( 'template-parts/modal_single_post' );
             
            ?>

        </div>
        <div class="prochain">


        
        <?php


            $previous_post = get_previous_post();
            $next_post = get_next_post();

            if($next_post){
                the_post_navigation( array(

                    'next_text' => get_the_post_thumbnail($next_post->ID,'thumbnail'). "<img src='http://motaphoto.local/wp-content/uploads/2023/08/arrow_prev.png'>",
                    'prev_text' =>  "<img class='test' src='http://motaphoto.local/wp-content/uploads/2023/08/arrox-next.png'>",
    
                ) );
    
            }else{
 
                    the_post_navigation( array(
                        'prev_text' => get_the_post_thumbnail($previous_post->ID,'thumbnail'). "<img class='prev' src='http://motaphoto.local/wp-content/uploads/2023/08/arrox-next.png'>",
        
                    ) );
            }
        ?>

        </div>

    </div>

    <div class="post-loving">
        <h3>VOUS AIMEREZ AUSSI </h3>

        <div class="other_post">
        <?php  
            
            get_template_part( 'template-parts/photo_block' );

        
        ;?>

           
        </div>

        <div class="other_post_contact">
            <button class="bouton"> Toutes les photos </button>
        </div>
        
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>


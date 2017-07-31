<?php
    get_header();
    
    echo get_option('inn_temp_head');

    $catalogue_page_url	=	get_option('catalogue_page_url');
    $terms	=	get_terms('wpccategories');
    global $post;
	
    $terms1 = get_the_terms($post->id, 'wpccategories');
    $cat_url = '';
    $tname = '';
    
    if($terms1){
        foreach( $terms1 as $term1 ){
            $slug	= $term1->slug;
            $tname	=	$term1->name;
            $cat_url	=	get_site_url().'/?wpccategories=/'.$slug;
        };
    }

    if(is_single()){
        $pname	=   get_the_title();	
    }
                
    //echo '<div class="container"><div class="row"><div class="wp-catalogue-breadcrumb"> <a href="'.$catalogue_page_url.'">'.get_field('all_products','option').'</a> <i class="fa fa-arrow-right" aria-hidden="true"></i>
 //<a href="'.$cat_url.'">'.$tname.'</a> <i class="fa fa-arrow-right" aria-hidden="true"></i> ' . $pname . '</div>';
?>
    <div id="wpc-catalogue-wrapper">
    <?php
        global $post;
        $terms1 = get_the_terms($post->id, 'wpccategories');

        if($terms1 !=null){
                foreach( $terms1 as $term1 ){
                        $slug		= $term1->slug;
                        $term_id	= $term1->term_id;
                };
        }
        global $wpdb;	

        $args = array(
                'orderby' => 'term_order',
                'order' => 'ASC',
                'hide_empty' => true,
        );

        $terms	=	get_terms('wpccategories',$args);
        $count	=	count($terms);
	echo '<div id="wpc-col-1">
                <ul class="wpc-categories">';
                if($count>0){
                    echo '<li class="wpc-category"><a href="'. get_option('catalogue_page_url') .'">'.get_field('all_products','option').'</a></li>';

                    foreach($terms as $term){
                        if($term->slug==$slug){
                            $class  =	'active-wpc-cat';
                        }else{
                            $class  =	'';
                        }

                        echo '<li  class="wpc-category ' . $class . '"><a href="'.get_term_link($term->slug, 'wpccategories').'">'. $term->name .'</a></li>'; 	
                    }
                }else{
                        echo '<li  class="wpc-category"><a href="#">'.get_field('no_category','option').'</a></li>';	
                }
            echo '</ul>
            </div>';
	?>
        <!--/Left-menu-->
    	<!--col-2-->

        <div id="col-sm-10 col-sm-offset-2">
        <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
            
                    $img1   =   get_post_meta($post->ID,'product_img1_big',true);
                    $img2   =	get_post_meta($post->ID,'product_img2_big',true);
                    $img3   =	get_post_meta($post->ID,'product_img3_big',true);
                    
                    $thumb_img1   =     get_post_meta($post->ID,'product_img1_thumb',true);
                    $thumb_img2   =	get_post_meta($post->ID,'product_img2_thumb',true);
                    $thumb_img3   =	get_post_meta($post->ID,'product_img3_thumb',true);
        ?>	 
                    <div id="wpc-product-gallery">
                        <?php 
                            $img_height = get_option('image_height');
                            $img_width = get_option('image_width');
                        ?>
                        <div class="product-img-view" style="">
                            <img src="<?php echo $img1; ?>" alt="" id="img1" />
                            <img src="<?php echo $img2; ?>" alt="" id="img2" />
                            <img src="<?php echo $img3; ?>" alt="" id="img3" />
                        </div>

                        <div class="col-sm-4 wpc-product-img">
                         <h4 class="blue">
                        <?php echo get_field('product_details','option') ?>
                        </h4>
                        <article class="post">
                        <div class="entry-content"> 
                            <?php
                            the_content(); ?>
                            
                        </div>
                    </article>
                        <!--
                        <?php
                            if($thumb_img1):
                        ?>
                                <div class="new-prdct-img">
                                    <img src="<?php echo $thumb_img1; ?>" alt="" width="151" height="94" id="img1" />
                                </div>
                        <?php
                            endif;
                            if($thumb_img2):
                        ?>
                                <div class="new-prdct-img">
                                    <img src="<?php echo $thumb_img2; ?>" alt="" width="151" height="94" id="img2"/>
                                </div>
                        <?php
                            endif;
                            if($thumb_img3):
                        ?>
                                <div class="new-prdct-img">
                                    <img src="<?php echo $thumb_img3; ?>" alt="" width="151" height="94" id="img3"/>
                                </div>
                        <?php
                            endif;
                        ?>-->
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="col-sm-8 col-sm-offset-3">
                    <?php

                    // check if the repeater field has rows of data
                    if( have_rows('quality') ):

                        // loop through the rows of data
                        while ( have_rows('quality') ) : the_row();

                            // display a sub field value
                            echo '<img class="product-certification" src="'.get_sub_field('certifications').'"/>';

                        endwhile;

                    else :

                        // no rows found

                    endif;

                    ?>
                    </div>
                    <!--
                    <?php
                        $product_price = get_post_meta($post->ID, 'product_price', true);
                    ?>
                    <div class="col-sm-8 col-sm-offset-2"
                    <h4>
                        Product Details
                    <?php
                        if($product_price):
                    ?>
                            <span class="product-price">Price:
                                <span>
                                <?php echo $product_price; ?>
                                </span>
                            </span>
                    <?php
                        endif;
                    ?>
                    </h4>
                    
                    <article class="post">
                        <div class="entry-content"> 
                            <?php
                            //the_content(); ?>
							
                        </div>
                    </article>
                    </div> products
                    -->

        <?php
                endwhile;
            endif;
        ?>
        </div>
        <!--/col-2-->
        <div class="clear"></div>   
        </div> 
    </div> <!-- /row -->
    </div> <!-- /container-->
<?php
    echo get_option('inn_temp_foot');
    
    get_footer();
?>
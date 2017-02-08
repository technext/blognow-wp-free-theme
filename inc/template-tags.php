<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package blognow
 */

/**
 * Get Post Views.
 */
if ( ! function_exists( 'blognow_get_post_views' ) ) :

function blognow_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '<span class="view-count">0</span> View';
    }
    return '<span class="view-count">' . number_format($count) . '</span> ' . __('Views', 'blognow');
}

endif;

/**
 * Set Post Views.
 */
if ( ! function_exists( 'blognow_set_post_views' ) ) :

function blognow_set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

endif;

/**
 * Search Filter 
 */
if ( ! function_exists( 'blognow_search_filter' ) ) :

function blognow_search_filter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}

add_filter('pre_get_posts','blognow_search_filter');

endif;

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
if ( ! function_exists( 'blognow_custom_excerpt_length' ) ) :

function blognow_custom_excerpt_length( $length ) {
    return get_theme_mod('entry-excerpt-length', '20');
}
add_filter( 'excerpt_length', 'blognow_custom_excerpt_length', 999 );

endif;

/**
 * Customize excerpt more.
 */
if ( ! function_exists( 'blognow_excerpt_more' ) ) :

function blognow_excerpt_more( $more ) {
   return '... ';
}
add_filter( 'excerpt_more', 'blognow_excerpt_more' );

endif;

/**
 * Add custom meta box.
 */
if ( ! function_exists( 'blognow_add_custom_meta_box' ) ) :

function blognow_add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Post Options", "blognow_custom_meta_box_markup", "post", "side", "high", null);
}

add_action("add_meta_boxes", "blognow_add_custom_meta_box");

endif;
/**
 * Displaying fields in a custom meta box.
 */
if ( ! function_exists( 'blognow_custom_meta_box_markup' ) ) :

function blognow_custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
        <div>
            <label for="is_featured"><?php echo __('Featured this post on homepage', 'blognow'); ?> </label>
            <?php
                $checkbox_value = get_post_meta($object->ID, "is_featured", true);

                if($checkbox_value == "")
                {
                    ?>
                        <input name="is_featured" type="checkbox" value="true">
                    <?php
                }
                else if($checkbox_value == "true")
                {
                    ?>  
                        <input name="is_featured" type="checkbox" value="true" checked>
                    <?php
                }
            ?>
        </div>
    <?php  
}

endif;

/**
 * Storing Meta Data.
 */
if ( ! function_exists( 'blognow_save_custom_meta_box' ) ) :

function blognow_save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "post";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_text_value = "";
    $meta_box_textarea_value = "";
    $meta_box_checkbox_value = "";

    if(isset($_POST["is_featured"]))
    {
        $meta_box_checkbox_value = $_POST["is_featured"];
    }   
    update_post_meta($post_id, "is_featured", $meta_box_checkbox_value);
}

add_action("save_post", "blognow_save_custom_meta_box", 10, 3);

endif;

/**
 * Display the first (single) category of post.
 */
if ( ! function_exists( 'blognow_first_category' ) ) :
function blognow_first_category() {
    $category = get_the_category();
    if ($category) {
      echo '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'blognow' ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
    }    
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'blognow_categorized_blog' ) ) :

function blognow_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'blognow_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'blognow_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so blognow_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so blognow_categorized_blog should return false.
        return false;
    }
}

endif;

/**
 * Flush out the transients used in blognow_categorized_blog.
 */
if ( ! function_exists( 'blognow_category_transient_flusher' ) ) :

function blognow_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'blognow_categories' );
}
add_action( 'edit_category', 'blognow_category_transient_flusher' );
add_action( 'save_post',     'blognow_category_transient_flusher' );

endif;
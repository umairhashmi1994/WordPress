<?php 

/**
 * Slider ShortCode
 */

if( !function_exists('charitus_main_slider_shortcode') ){
	function charitus_main_slider_shortcode( $atts ) {

		extract( shortcode_atts(
			array(
				'post'  				=> -1,
				'order' 				=> 'ASC',
				'orderby' 				=> 'menu_order',
				'loop'					=> 'true',
				'autoplay'				=> 'true',
				'navigation'			=> 'true',
				'pagination'			=> 'true',
				'post_in_ids'			=> '',
				'post_not_in_ids'		=> '',
			), $atts )
		);

		$post_in_ids = ( $post_in_ids ? explode( ',', $post_in_ids ) : null );
		$post_not_in_ids = ( $post_not_in_ids ? explode( ',', $post_not_in_ids ) : null );

		$args = array(
			'post_type' 				=> 'charitus_slider', 
			'orderby' 					=> $orderby,
			'order' 					=> $order,
			'posts_per_page' 			=> $post,
			'post__in' 					=> $post_in_ids,
			'post__not_in' 				=> $post_not_in_ids,
			'meta_query' 				=> array( array( 'key' => '_thumbnail_id' ) ) 
	    );

		$wp_query = new WP_Query( $args );

		wp_enqueue_style('animate');

		ob_start();
		
		if ( $wp_query->have_posts() ): ?>

        	<div class="header-slider header-slider-preloader">
            	<div class="theme-main-slider animation-slides owl-carousel owl-theme" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-loop="<?php echo esc_attr( $loop ); ?>" data-navigation="<?php echo esc_attr( $navigation) ; ?>" data-pagination="<?php echo esc_attr( $pagination ); ?>" data-direction="<?php echo esc_attr( ( is_rtl() ? 'true' : 'false' ) ); ?>">
				
				<?php while ($wp_query->have_posts()) : $wp_query->the_post();

					global $post;
					$slider_btn_text      = charitus_get_post_meta( '_xt_sider_options', 'slider_btn_text', '', true, $post->ID );
					$slider_btn_url       = charitus_get_post_meta( '_xt_sider_options', 'slider_btn_url', '', true, $post->ID );					
					$slider_featured_img  = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array('1920','1280') );
					
					if( has_post_thumbnail() && get_the_post_thumbnail_url() ){
						$slider_img = $slider_featured_img[0];
					}else{
						$slider_img = 'http://placehold.it/1920x1280';
					}

				?>

	                <div style="background-image:url(<?php echo esc_url( $slider_img ); ?>)" class="item">
	                    <div class="slide-table">
	                        <div class="slide-tablecell">
	                            <div class="container">
	                                <div class="row">
	                                    <div class="col-md-7">
	                                        <div class="slide-text">
	                                           <?php the_title( '<h1>', '</h1>' ); ?>
	                                           	<?php the_content(); ?>
	                                           	<?php if( $slider_btn_text ): ?>
		                                            <div class="slide-buttons">
		                                                <a href="<?php echo esc_url( $slider_btn_url ); ?>" class="slide-btn btn btn-border btn-lg"><?php echo esc_html( $slider_btn_text ); ?></a>
		                                            </div>
	                                        	<?php endif; ?>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>

				<?php endwhile; ?>
				
				</div>
				<div class="slider_preloader">
	                <div class="slider_preloader_status">&nbsp;</div>
	            </div>
			</div>

		<?php

		endif;
		wp_reset_postdata();

		return ob_get_clean();
	}
}
add_shortcode( 'charitus_main_slider', 'charitus_main_slider_shortcode' );



/**
 * volunteers ShortCode
 */

if( !function_exists('charitus_volunteers_shortcode') ){
	function charitus_volunteers_shortcode( $atts ) {

		extract( shortcode_atts(
			array(
				'post'  				=> -1,
				'order' 				=> 'ASC',
				'orderby' 				=> 'menu_order',
				'column' 				=> 4,
			), $atts )
		);

		$args = array(
			'post_type' 				=> 'charitus_volanteers', 
			'orderby' 					=> $orderby,
			'order' 					=> $order,
			'posts_per_page' 			=> $post,
	    );

	    if( $column ){
			$column = 12/$column;
			$column = 'col-md-'.$column . ' col-sm-6';
		}

		$column = apply_filters( 'charitus_volunteers_grid_column', $column );

		$wp_query = new WP_Query( $args );

		ob_start();
		
		if ( $wp_query->have_posts() ): ?>
			<div class="ch-volanteer row">
					
				<?php while ($wp_query->have_posts()) : $wp_query->the_post();

					global $post;
					$volanteer_img = '';
					$volanteer_social_icons       = charitus_get_post_meta( '_xt_volanteer_options', 'volanteer_all_social_icons', '', false, $post->ID );
					$volanteer_featured_img       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array('600','600') ); 

					if( has_post_thumbnail() && get_the_post_thumbnail_url() ){
						$volanteer_img 	  = $volanteer_featured_img[0];
					}else{
						$volanteer_img 	  = get_template_directory_uri().'/assets/images/placeholder-volanteer.png';
					}
				?>

                <div class="<?php echo esc_attr( $column ); ?>">
                    <div class="vl-thumb">
                        <?php 
                        	if( $volanteer_img ){
                        		printf( '<img src="%s" alt="" class="img-responsive"/>', esc_url( $volanteer_img ) ); 
                        	}
                        ?>
                        <div class="vl-content center shadow">
                            <ul>
	                            <?php if( is_array( $volanteer_social_icons ) ) :

                                    foreach ( $volanteer_social_icons  as $key => $volanteer_social_icon ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $volanteer_social_icon['volanteer_social_icons_url'] ); ?>">
                                                <i class="<?php echo esc_html( $volanteer_social_icon['volanteer_social_icons'] ); ?>"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                            <?php the_title( '<h4>', '</h4>' ); ?>
                        </div>
                    </div> 
                </div>

				<?php endwhile; ?>

			</div>

		<?php

		endif;
		wp_reset_postdata();

		return ob_get_clean();
	}
}
add_shortcode( 'charitus_volunteer', 'charitus_volunteers_shortcode' );


/**
 * Testimonial ShortCode
 */

if( !function_exists('charitus_testimonial_shortcode') ){
	function charitus_testimonial_shortcode( $atts ) {

		extract( shortcode_atts(
			array(
				'post'  				=> -1,
				'order' 				=> 'ASC',
				'orderby' 				=> 'menu_order',
			), $atts )
		);

		$args = array(
			'post_type' 				=> 'charitus_testimonial', 
			'orderby' 					=> $orderby,
			'order' 					=> $order,
			'posts_per_page' 			=> $post,
	    );

		$wp_query = new WP_Query( $args );

		ob_start();
		
		if ( $wp_query->have_posts() ): ?>

			<div class="client-quates">
				<div class="ch-client-testimonial">
	                <div class="slider-content">
	                    <div class="carousel xt-carousel-fade slide" data-ride="carousel" id="quote-carousel">
	                        <div class="carousel-inner text-center">

							<?php 
							$x = 0;
							while ($wp_query->have_posts()) : $wp_query->the_post();
								global $post;
								$testi_designation      = charitus_get_post_meta( '_xt_testimonial_options', 'testimonial_designation', '', true, $post->ID );
								$x++;
							?>

	                            <div class="item <?php if( $x == 1 ){ echo 'active'; } ?>">
	                                <blockquote>
	                                    <div class="row">
	                                        <div class="">
	                                            <?php the_content(); ?>

	                                            <h3><?php echo esc_html(get_the_title( ) );  ?> <span><?php echo esc_html( $testi_designation ); ?></span></h3>
	                                        </div>
	                                    </div>
	                                </blockquote>
	                            </div>

							<?php endwhile;
							wp_reset_postdata();
							?>

							</div>
	                        <!-- Bottom Carousel Indicators -->
	                        <ol class="carousel-indicators">
	                        <?php 

	                        	$y = 0;
	                        	while ($wp_query->have_posts()) : $wp_query->the_post();
	                        	$testimonial_featured_img  = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array('600','600') ); 

								if( has_post_thumbnail() && get_the_post_thumbnail_url() ){
									$testimonial_img 	  = $testimonial_featured_img[0];
								}else{
									$testimonial_img 	  = 'http://placehold.it/600x600';
								}
	                        ?>
	                            <li data-target="#quote-carousel" data-slide-to="<?php echo $y; ?>" class="<?php if( $y == 0 ){ echo'active'; } ?>">
	                            	<img class="img-responsive " src="<?php echo esc_url( $testimonial_img ); ?>" alt="">
	                            </li>
	                        <?php 
	                        	$y++;
	                        	endwhile;
	                        	wp_reset_postdata();
							?> 
	                        </ol>
	                    </div>
	                </div>
	            </div>
	        </div>

		<?php

		endif;
		wp_reset_postdata();

		return ob_get_clean();
	}
}
add_shortcode( 'charitus_testimonial', 'charitus_testimonial_shortcode' );


/**
 * Gallery ShortCode
 */

if( !function_exists('charitus_gallery_shortcode') ){
	function charitus_gallery_shortcode( $atts ) {

		extract( shortcode_atts(
			array(
				'column' 				=> 3,
				'images'				=> '',
				'image_size_type'		=> 'default', // default / custom
				'image_width'			=> 640,
				'image_height'			=> 426,
				'show_title'			=> 'on',
				'show_description'		=> 'on',
			), $atts )
		);


	    if( $column ){
			$column = 12/$column;
			$column = 'col-md-'.$column . ' col-sm-6';
		}

		$column = apply_filters( 'charitus_gallery_grid_column', $column );

		if( $images && $images != '' ){
			$images = explode(',', $images);
		}

		ob_start();

		if( !empty( $images ) ):
			?>
				
	            <div class="row ch-grid project-gallery" id="project-gallery">

					<?php foreach ( $images as $image ): ?>

						<?php
							$attachment_title = $attachment_description = $attachment_image = '';
							$attachment_meta = charitus_wp_get_attachment( $image );
							$attachment_title = $attachment_meta['title'];
							$attachment_description = $attachment_meta['description'];

							if( $image_size_type == 'default' ){
								$attachment_image = wp_get_attachment_image( $image, apply_filters( 'charitus_gallery_image_size', 'charitus-blog-thumb' ) );
							}else{
								$attachment_image = charitus_get_aq_resize_thumbnail( $image_width, $image_height, $image, true, true );
							}
						?>

						<?php if( $attachment_image ): ?>
							<div class="ch-grid-item <?php echo esc_attr( $column ); ?>">
			                    <figure>
			                        <?php echo $attachment_image;?>
			                        <figcaption>
			                            <span class="icon flaticon-signs"></span>

			                            <?php
			                            	if( $attachment_title && $show_title == 'on' ){
			                            		printf( '<h4 class="ch-gallery-title">%s</h4>', $attachment_title );
			                            	}
			                            ?>

			                            <?php 
			                            	if ( $attachment_description && $show_description == 'on' ){
			                            		printf( '<span class="ch-gallery-sub-title">%s</span>', $attachment_description );
			                            	}
			                            ?>

			                            <a href="<?php echo esc_url( wp_get_attachment_url( $image ) ); ?>" <?php echo ( $attachment_title && $show_title == 'on' ? 'title="'. esc_html( $attachment_title ) .'"' : '' ); ?> data-rel="lightcase:charitusGallery:slideshow" class="view-project-detail"></a>

			                        </figcaption>
			                    </figure>
			                </div>
		            	<?php endif; ?>

					<?php endforeach; ?>

	            </div>

			<?php
		endif;

		return ob_get_clean();
	}
}
add_shortcode( 'charitus_gallery', 'charitus_gallery_shortcode' );



/**
 * Donate ShortCode
 */

if( !function_exists('charitus_donate_shortcode') ){
	function charitus_donate_shortcode($atts){
		extract(shortcode_atts(array(
			'icon_type'	          => 'icon',
			'icon'	              => '',
			'charitus_flaticon'	  => '',
			'title'	              => '',
			'donate_content'	  => '',
			'content_word_count'  => '5',
			'btn_text'	          => '',
			'btn_url'	          => ''
	    ), $atts));


		switch ($icon_type) {
			case 'icon':
				$icon = $icon;
				break;

			case 'charitus_flaticon':
				$icon = $charitus_flaticon;
				break;		
			
			default:
				$icon = $icon;
				break;
		}

		ob_start();

	?>

        <div class="each-features">
            <div class="features-inner">
                <div class="each-details center">
                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                    <h3><?php echo esc_html( $title ); ?></h3>
                    <p><?php echo esc_html( wp_trim_words( $donate_content, $content_word_count, '&hellip;' ) ); ?></p>
                </div>
                <div class="features-content">
                    <h3 class="title"><?php echo esc_html( $title ); ?></h3>
                    <p class="date"> <?php echo esc_html( $donate_content ); ?> </p>
                    <a href="<?php echo esc_url( $btn_url ); ?>" class="btn btn-lg btn-fill"><?php echo esc_html( $btn_text ); ?></a>
                </div>
            </div>
        </div>

		<?php
	    return ob_get_clean();
	}
}
add_shortcode( 'charitus_features', 'charitus_donate_shortcode' );


/**
 * Call To Action ShortCode
 */

if( !function_exists('charitus_call_to_action_shortcode') ){
	function charitus_call_to_action_shortcode($atts){
		extract(shortcode_atts(array(
			'title'	              => '',
			'action_content'	  => '',
			'btn_text'	          => '',
			'btn_url'	          => ''
	    ), $atts));

		ob_start();

	?>

        <div class="table-display ch-call-to-action-wrapper">
            <div class="ch-call-to-action col-md-8 col-sm-12 col-xs-12">
                <h3><?php echo esc_html( $title ); ?></h3>
                <p><?php echo esc_html( $action_content ); ?></p>
            </div>
            <div class="ch-call-to-action-btn col-md-4 col-sm-12 col-xs-12">
                <a href="<?php echo esc_url( $btn_url ); ?>" class="btn pull-right btn-fill abc btn-lg"><?php echo esc_html( $btn_text ); ?></a>
            </div>
        </div>


		<?php
	    return ob_get_clean();
	}
}
add_shortcode( 'charitus_call_to_action', 'charitus_call_to_action_shortcode' );

/**
 * Volunteer Call To Action ShortCode
 */

if( !function_exists('charitus_volunteer_call_to_action_shortcode') ){
	function charitus_volunteer_call_to_action_shortcode($atts){
		extract(shortcode_atts(array(
			'title'	              => '',
			'action_content'	  => '',
			'btn_text'	          => '',
			'btn_url'	          => '',
	    ), $atts));

		ob_start();

	?>
        <div class="charitus-join-us">
            <h3><?php echo esc_html( $title ); ?></h3>
            <p><?php echo esc_html( $action_content ); ?></p>
             <div class="join-btn">
                <a href="<?php echo esc_url( $btn_url ); ?>" class="btn btn-fill btn-lg"><?php echo esc_html( $btn_text ); ?></a>
            </div>
        </div>

	<?php
    	return ob_get_clean();
	}
}
add_shortcode( 'volunteer_call_to_action', 'charitus_volunteer_call_to_action_shortcode' );



/**
 * Feature 2
 */

if( !function_exists('charitus_feature_2_shortcode') ){
	function charitus_feature_2_shortcode($atts){
		extract(shortcode_atts(array(
			'icon_type'	          => 'icon',
			'icon'	              => '',
			'charitus_flaticon'	  => '',
			'title'	              => '',
			'action_content'	  => '',
			'btn_text'	          => '',
			'btn_url'	          => '',
	    ), $atts));

	    switch ($icon_type) {
			case 'icon':
				$icon = $icon;
				break;

			case 'charitus_flaticon':
				$icon = $charitus_flaticon;
				break;		
			
			default:
				$icon = $icon;
				break;
		}

		ob_start();

	?>

        <div class="ch-mission-item">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3 mission-icon">
                    <i class="fa main-color <?php echo esc_attr( $icon ); ?>"></i>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9 padding-left-o">
                    <h4 class="margin-top-o"><?php echo esc_html( $title ); ?></h4>
                    <p><?php echo esc_html( $action_content ); ?></p>
                    <a href="<?php echo esc_url( $btn_url ); ?>" class="main-color"><?php echo esc_html( $btn_text ); ?></a>
                </div>
            </div>
        </div>

		<?php
	    return ob_get_clean();
	}
}
add_shortcode( 'charitus_mission', 'charitus_feature_2_shortcode' );


/**
 * Stats ShortCode
 */

if( !function_exists('charitus_stats_shortcode') ){
	function charitus_stats_shortcode($atts){
		extract(shortcode_atts(array(
			'icon_type'	          => 'icon',
			'icon'	              => '',
			'charitus_flaticon'	  => '',
			'title'	              => '',
			'number'	          => ''
	    ), $atts));

	    switch ($icon_type) {
			case 'icon':
				$icon = $icon;
				break;

			case 'charitus_flaticon':
				$icon = $charitus_flaticon;
				break;		
			
			default:
				$icon = $icon;
				break;
		}

		ob_start();

	?>

	<div class="ch-fame">
		<div class="fame-item">
		    <div class="vl-icon">
		        <i class="<?php echo esc_attr( $icon ); ?>"></i>
		        <h3 class="number aw"><?php echo esc_html( $number ); ?></h3>
		        <span class="text"><?php echo esc_html( $title ); ?></span>
		    </div>
		</div>
	</div>

		<?php
	    return ob_get_clean();
	}
}
add_shortcode( 'charitus_stats', 'charitus_stats_shortcode' );

/**
 * Client Logo ShortCode
 */

if( !function_exists('charitus_client_logo_shortcode') ){
	function charitus_client_logo_shortcode($atts){
		extract(shortcode_atts(array(
			'image_size_type'	=> 'default', // default / custom
			'image_width'		=> 300,
			'image_height'		=> 200,
			'logo_images'		=> ''
	    ), $atts));

	    if( $logo_images && function_exists('vc_param_group_parse_atts') ){
	    	$logo_images = vc_param_group_parse_atts( $logo_images );
	    }

		ob_start();

		if( $logo_images && !empty($logo_images) ):
			?>
				<div class="ch-client">
			        <div class="ch-client-logos">
			            <ul>
			                <?php foreach ($logo_images as $logo_image):?>
								<li>
									<?php
										if ( array_key_exists( 'logo_img', $logo_image ) ): 

											if( array_key_exists( 'logo_url', $logo_image ) ){
												echo '<a href="'. esc_url( $logo_image['logo_url'] ) .'">';
											}

											if( $image_size_type == 'default' ){
												echo wp_get_attachment_image( $logo_image['logo_img'], 'full' );
											}else{
												echo charitus_get_aq_resize_thumbnail( $image_width, $image_height, $logo_image['logo_img'], true, true );
											}

											if( array_key_exists( 'logo_url', $logo_image ) ){
												echo '</a>';
											}

										endif;
									?>
								</li>
							<?php endforeach; ?>
			            </ul>
			        </div>
				</div>
			<?php
		endif;
	    return ob_get_clean();
	}
}
add_shortcode( 'charitus_client_logo', 'charitus_client_logo_shortcode' );


/**
 * Section Title ShortCode
 */

if( !function_exists( 'charitus_section_title_shortcode' ) ){
	function charitus_section_title_shortcode( $atts ){

		extract(shortcode_atts(array(
			'title_first_part'	  => '',
			'title_second_part'	  => '',
			'charitus_subtitle'   => '',
			'title_align'   	  => 'center',
			'margin_bottom'   	  => 'medium', // small medium large
	    ), $atts));

		ob_start();
	?>

        <div class="section-title <?php echo esc_attr( 'text-' . $title_align ); ?> <?php echo esc_attr( 'section-title-margin-bottom-' . $margin_bottom ); ?>">
            <?php 
            	if( $title_first_part || $title_second_part ){
            		if( $title_second_part == '' ){
            			printf( '<h2>%s</h2>', $title_first_part );
            		}else{
            			printf( '<h2>%s <span>%s</span></h2>', esc_html( $title_first_part ), esc_html( $title_second_part ) );
            		}
            	}

	            if ( $charitus_subtitle ){
	            	echo wpautop( esc_html( $charitus_subtitle ) );
	            }	
            ?>
        </div>

		<?php

	    return ob_get_clean();
	}
}
add_shortcode( 'charitus_section_title', 'charitus_section_title_shortcode' );


/**
 * Contact Icon ShortCode
 */

if( !function_exists( 'charitus_contact_icon_shortcode' ) ){
	function charitus_contact_icon_shortcode( $atts ){
		extract(shortcode_atts(array(
			'icon'	              => '',
			'title'	              => '',
			'action_content'	          => ''
	    ), $atts));

		ob_start();

	?>		
        <div class="ch-contact-content contact-item">
            <div class="row">
                <div class="col-md-3 col-sm-12 icon ">
                    <i class="fa main-color <?php echo esc_attr( $icon ); ?>"></i>
                </div>
                <div class="col-md-9 col-sm-12 padding-left-o">
                    <h4 class="margin-top-o"><?php echo esc_html( $title ); ?></h4>
                    <p class="main-color"><?php echo esc_html( $action_content ); ?></p>
                </div>
            </div>
        </div>

		<?php
	    return ob_get_clean();
	}
}
add_shortcode( 'contact_icon_scode', 'charitus_contact_icon_shortcode' );



/**
 * Donation CAUSES ShortCode
 */


if ( class_exists( 'Charitable' ) ){
	add_shortcode( 'charitus_donation_causes', 'charitus_donation_causes_shortcode' );

	if( !function_exists('charitus_donation_causes_shortcode') ){
		function charitus_donation_causes_shortcode( $atts ){
			extract(shortcode_atts(array(
				'post'  				=> -1,
				'order' 				=> 'ASC',
				'orderby' 				=> 'date',
				'autoplay'				=> 'false',
				'items'					=> 3,
				'desktopsmall'			=> 3,
				'tablet'				=> 2,
				'mobile'				=> 1,
				'navigation'			=> 'true',
				'pagination'			=> 'false',
				'loop'					=> 'true',
				'column'				=> 3,
				'causes_categories'		=> '', // comma separated categories id
				'causes_tags'			=> '', // comma separated tags id
				'post_in'				=> '', // comma separated causes ids
				'post_not_in'			=> '', // comma separated causes ids to exclude
				'type'					=> 'grid', // grid, slider, list
				'image_size_type'		=> 'default', // default / custom
				'image_width'			=> 450,
				'image_height'			=> 450,
				'donate_btn'			=> 'on',
				'cause_excerpt'			=> 'on',
				'cause_stats'			=> 'on',
				'cause_progress_bar'	=> 'on',
				'excerpt_length'		=> 20,
				'creator'          		=> '',
				'include_inactive' 		=> false

		    ), $atts));

			$post_in = ( $post_in ? explode( ',', $post_in ) : null );
			$post_not_in = ( $post_not_in ? explode( ',', $post_not_in ) : null );

			$args = array( 
				'post_type' 				=> 'campaign', 
				'orderby' 					=> $orderby,
				'order' 					=> $order,
				'posts_per_page' 			=> $post,
				'post__in' 					=> $post_in,
				'post__not_in' 				=> $post_not_in,
			);


			// only form selected causes categories
			if( $causes_categories && $causes_categories != '' ){
				$causes_categories = explode(',', $causes_categories);
				$args['tax_query'][] = array(
					'taxonomy' 	=> 'campaign_category',
			        'field'    	=> 'id',
					'terms'    	=> $causes_categories,
			        'operator' 	=> 'IN' 
				);
			}

			// only form selected causes tags
			if( $causes_tags && $causes_tags != '' ){
				$causes_tags = explode(',', $causes_tags);
				$args['tax_query'][] = array(
					'taxonomy' 	=> 'campaign_tag',
			        'field'    	=> 'id',
					'terms'    	=> $causes_tags,
			        'operator' 	=> 'IN' 
				);
			}

			// only form selected author
			if( $creator && $creator != '' ){
				$args['author'] = $creator;
			}

			/* Only include active campaigns if flag is set */
			if ( ! $include_inactive ) {
				$args['meta_query'] = array(
					'relation' => 'OR',
					array(
						'key'       => '_campaign_end_date',
						'value'     => date( 'Y-m-d H:i:s' ),
						'compare'   => '>=',
						'type'      => 'datetime',
					),
					array(
						'key'       => '_campaign_end_date',
						'value'     => 0,
						'compare'   => '=',
					),
				);
			}

			$wp_query = new WP_Query( $args );

			$row = ( $type == 'grid' ? ' row' : '' );

			if($column){
				$column = 12/$column;
				$column = 'col-lg-'.$column . ' col-md-4 col-sm-6';
			}

			$column = ( $type == 'grid' ? apply_filters( 'charitus_causes_grid_column', $column ) : '' );

			ob_start();

			if ( $wp_query->have_posts() ): ?>

				<div class="charitus-donation-causes charitus-donation-causes-<?php echo esc_attr( $type.$row ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-items="<?php echo esc_attr( $items ); ?>" data-desktopsmall="<?php echo esc_attr( $desktopsmall ); ?>" data-tablet="<?php echo esc_attr( $tablet ); ?>" data-mobile="<?php echo esc_attr( $mobile ); ?>" data-navigation="<?php echo esc_attr( $navigation) ; ?>" data-pagination="<?php echo esc_attr( $pagination ); ?>" data-loop="<?php echo esc_attr( $loop ); ?>" data-direction="<?php echo esc_attr( ( is_rtl() ? 'true' : 'false' ) ); ?>">

					<?php while ($wp_query->have_posts()) : $wp_query->the_post();?>

						<?php 
							global $post;
							$campaign = charitable_get_campaign( get_the_ID() );
						?>

						<div <?php post_class( array( 'charitus-donation-cause-item', 'ch-causes', $column ) ) ?>>
							<div class="cause-inner clearfix">
								<?php if( has_post_thumbnail() ):?>
									<?php if( $type == 'list'): ?>
										<div class="col-md-6 padding-o">
									<?php endif; ?>
			                        	<a href="<?php esc_url( the_permalink() ); ?>">
											<?php
												if( $image_size_type == 'default' ){
													the_post_thumbnail( apply_filters( 'charitus_causes_image_size', 'charitus-campaign-thumb-grid' ), array( 'alt' => esc_attr( get_the_title() ) ) );
												}else{
													echo charitus_get_aq_resize_thumbnail( $image_width, $image_height, get_post_thumbnail_id(), true, true );
												}
											?>
										</a>
									<?php if( $type == 'list'): ?>
										</div>
									<?php endif; ?>
		                        <?php endif;?>

		                        <?php if( $type == 'list'): ?>
									<div class="col-md-6 padding-o">
								<?php endif; ?>
		                        <div class="cause-inner-content">
		                            <h3>
										<a href="<?php esc_url( the_permalink() ) ?>"><?php the_title(); ?></a>
									</h3>	

		                            <?php 
			                            if( $cause_stats == 'on' ){
			                            	echo charitus_charitable_template_campaign_loop_donation_stats( $campaign );
			                            }
		                            ?>

		                            <?php 
			                            if( $cause_progress_bar == 'on' ){
			                            	charitus_charitable_template_campaign_progress_bar( $campaign );
			                            }
		                            ?>

		                            <?php 
		                            	if( $cause_excerpt == 'on' ){
		                            		echo wpautop( wp_trim_words( get_the_excerpt(), $excerpt_length ) );
		                           		}

		                           		if( $donate_btn == 'on' ){
		                            		charitable_template_campaign_loop_donate_link( $campaign, array() );
		                            		if( $campaign->has_ended() ){
		                            			printf( '<a class="btn btn-border btn-lg" href="%s">%s</a>', esc_url(get_the_permalink()), esc_html( charitus_cs_get_option( 'donate_button_text_expired', esc_html__( 'Details', 'charitus' ) ) ) );
		                            		}
			                            }
		                            ?>
		                        </div>
		                        <?php if( $type == 'list'): ?>
									</div>
								<?php endif; ?>
		                    </div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php
			endif;
			wp_reset_postdata();
			return ob_get_clean();
		}
	}
}



/**
 * Events Shortcode
 */

if( charitus_plugin_active( 'the-events-calendar/the-events-calendar.php' ) ){
	add_shortcode( 'charitus_events', 'charitus_events_shortcode_function' );

	if( !function_exists('charitus_events_shortcode_function') ){
		function charitus_events_shortcode_function( $atts ){
			extract(shortcode_atts(array(
				'x_class'  			=> '',
				'type'				=> 'grid', // grid, slider
				'image_size_type'	=> 'default', // default / custom
				'image_width'		=> 450,
				'image_height'		=> 450,
				'column'			=> 3,
				'event_categories'	=> '', // comma separated categories id
				'event_ids'			=> '', // comma separated events ids
				'not_in'			=> '', // comma separated events ids to exclude
				'post'  			=> -1,
				'order' 			=> 'ASC',
				'orderby' 			=> 'menu_order',
				'autoplay'			=> 'true',
				'items'				=> 3,
				'desktopsmall'		=> 3,
				'tablet'			=> 2,
				'mobile'			=> 1,
				'loop'				=> 'true',
				'navigation'		=> 'true',
				'pagination'		=> 'false',
				'show_cost'			=> 'on',
				'show_details_btn'	=> 'on',
				'show_excerpt'		=> 'on',
				'details_btn_text'	=> esc_html__( 'Details', 'charitus' ),
		    ), $atts));

			$event_ids = ( $event_ids ? explode( ',', $event_ids ) : null );
			$not_in = ( $not_in ? explode( ',', $not_in ) : null );

			$args = array( 
				'post_type' 				=> 'tribe_events', 
				'orderby' 					=> $orderby,
				'order' 					=> $order,
				'posts_per_page' 			=> $post,
				'post__in' 					=> $event_ids,
				'post__not_in' 				=> $not_in,
			);

			// only form selected event categories
			if( $event_categories && $event_categories != '' ){
				$event_categories = explode(',', $event_categories);
				$args['tax_query'][] = array(
					'taxonomy' 	=> 'tribe_events_cat',
			        'field'    	=> 'id',
					'terms'    	=> $event_categories,
			        'operator' 	=> 'IN' 
				);
			}

			$row = ( $type == 'grid' ? ' row' : '' );
			
			if( $column ){
				$column = 12/$column;
				$column = 'col-lg-'.$column . ' col-md-4 col-sm-6';
			}

			$column = ( $type == 'grid' ? apply_filters( 'charitus_event_grid_column', $column ) : '' );

			$wp_query = new WP_Query( $args );

			ob_start();
				if ( $wp_query->have_posts() ){
					?>
						<div class="ch-event charitus-event-<?php echo esc_attr( $type.$row ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-items="<?php echo esc_attr( $items ); ?>" data-desktopsmall="<?php echo esc_attr( $desktopsmall ); ?>" data-tablet="<?php echo esc_attr( $tablet ); ?>" data-mobile="<?php echo esc_attr( $mobile ); ?>" data-navigation="<?php echo esc_attr( $navigation) ; ?>" data-pagination="<?php echo esc_attr( $pagination ); ?>" data-loop="<?php echo esc_attr( $loop ); ?>" data-direction="<?php echo esc_attr( ( is_rtl() ? 'true' : 'false' ) ); ?>">

							<?php while ($wp_query->have_posts()) : $wp_query->the_post();?>

								<div <?php post_class( array( 'charitus-event-item', $column ) ); ?>>
									<figure class="event-inner">

										<?php if( has_post_thumbnail() && get_the_post_thumbnail_url() ): ?>
											<div class="event-banner">
												<a href="<?php esc_url( the_permalink() ); ?>">
													<?php
														if( $image_size_type == 'default' ){
															the_post_thumbnail( apply_filters( 'charitus_event_image_size', 'charitus-campaign-thumb-grid' ), array( 'alt' => esc_attr( get_the_title() ) ) );
														}else{
															echo charitus_get_aq_resize_thumbnail( $image_width, $image_height, get_post_thumbnail_id(), true, true );
														}
													?>

													<?php if ( tribe_get_cost() && $show_cost == 'on' ) : ?>
														<span class="charitus-event-price"><?php echo tribe_get_cost( null, true ) ?></span>
													<?php endif; ?>
												</a>								
											</div>
										<?php endif; ?>

										<figcaption class="event-content">

											<h3 class="charitus-event-title">
												<a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>
											</h3>

											<?php echo tribe_events_event_schedule_details( get_the_ID(), '<div class="schedule">', '</div>' ); ?>

											<?php if( $show_excerpt == 'on' ): ?>
												<div class="charitus-event-excerpt">
													<?php esc_html( the_excerpt() ); ?>
												</div>
											<?php endif; ?>

											<?php if ( $show_details_btn == 'on' ) : ?>
												<a class="btn btn-border btn-lg" href="<?php esc_url( the_permalink() ); ?>"><?php echo esc_html( $details_btn_text ); ?></a>
											<?php endif; ?>
										</figcaption>

									</figure>
								</div>

							<?php endwhile; ?>	

						</div>
					<?php
				}
			wp_reset_postdata();
		    return ob_get_clean();
		}
	}
}


/**
 * Campaign Search
 */

if ( class_exists( 'Charitable' ) ){
	add_shortcode( 'charitus_campaign_search', 'charitus_campaign_search' );

	if( !function_exists('charitus_campaign_search') ){
		function charitus_campaign_search( $atts ){
			extract(shortcode_atts(array(
				'placeholder'  					=> esc_html__( 'Search...', 'charitus' ),
				'before_search_title'  			=> esc_html__( 'Search Campaigns', 'charitus' ),
				'before_search_subtitle'  		=> '',
				'before_search_img'  			=> '',
				'after_search_stats'  			=> 'on',
				'show_campaign_count'  			=> 'on',
				'show_campaign_donated_amount'  => 'on',
				'show_campaign_donors_count'  	=> 'on',
				'x_class'  						=> '',
		    ), $atts));

		    $campaigns_count = Charitable_Campaigns::query( array( 'posts_per_page' => -1, 'fields' => 'ids' ) )->found_posts;
			$campaigns_text  = 1 == $campaigns_count ? esc_html__( 'Campaign', 'charitus' ) : esc_html__( 'Campaigns', 'charitus' );
			$donated_amount = charitable_format_money( charitable_get_table( 'campaign_donations' )->get_total(), 0 );
			$donors_count = charitable_get_table( 'donors' )->count_donors_with_donations();
			$donors_text  = 1 == $donors_count ? esc_html__( 'Donor', 'charitus' ) : esc_html__( 'Donors', 'charitus' );

			if( $before_search_img ){
				$before_search_img = wp_get_attachment_image( $before_search_img, 'full' );
			}

			add_action( 'wp_footer', 'charitus_ajax_course_search_base' );
			
		    ob_start();
		    ?>
				<div class="ch-campaign-search<?php echo esc_attr( $x_class ? ' '.$x_class : '' ); ?>">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<?php echo ( $before_search_img ? '<div class="ch-search-logo">'.$before_search_img.'</div>' : '' ); ?>
							<?php echo ( $before_search_title ? '<h2>'. esc_html( $before_search_title ) .'</h2>' : '' ); ?>
							<?php echo ( $before_search_subtitle ? '<h4>'. esc_html( $before_search_subtitle ) .'</h4>' : '' ); ?>
						</div>
					</div>
					<form role="search" action="<?php echo esc_url( site_url('/') ); ?>" method="get" id="searchform">
						<fieldset>
							<div class="input-group">
								<?php if( is_search() ):?>
									<input class="form-control ch-campaign-search-field" type="text" name="s" value="<?php echo esc_attr(apply_filters('the_search_query', get_search_query())); ?>"/>
								<?php else:?>
									<input class="form-control ch-campaign-search-field" type="text" name="s" placeholder="<?php echo esc_attr( $placeholder ); ?>"/>
								<?php endif;?>
								<input type="hidden" name="post_type" value="campaign" />
								<span class="input-group-btn">
									<button type="submit" id="ch-campaign-search-btn" class="btn btn-fill btn-lg"><i class="fa fa-search" aria-hidden="true"></i></button>
								</span>
							</div>
						</fieldset>
					</form>
					<div class="ch-campaign-ajax-search-result-area"><div class="ch-campaign-ajax-search-result-inner shadow"></div></div>
					<?php if( $after_search_stats == 'on' ): ?>
						<ul class="ch-campaign-search-donation-stats">
								<?php 
									if( $show_campaign_count == 'on' ){
										printf( '<li><i class="fa flaticon-graphic"></i><span class="ch-campaign-count">%d</span> %s</li>', $campaigns_count, $campaigns_text );
									}
									if( $show_campaign_donated_amount == 'on' ){
										printf( '<li><i class="fa flaticon-money"></i><span class="ch-campaign-donated-amount">%s</span> %s</li>', $donated_amount, esc_html__( 'Donated', 'charitus' ) );
									}
									if( $show_campaign_donors_count == 'on' ){
										printf( '<li><i class="fa flaticon-profile"></i><span class="ch-campaign-donors-count">%s</span> %s</li>', $donors_count, $donors_text );
									}
								?>
						</ul>

					<?php endif; ?>
				</div>
		    <?php
		    return ob_get_clean();
		}
	}

}

/**
 * Campaign Search Process
 */

add_action('wp_ajax_nopriv_charitus_ajax_campaign_search','charitus_ajax_campaign_search');
add_action('wp_ajax_charitus_ajax_campaign_search','charitus_ajax_campaign_search');

if(!function_exists('charitus_ajax_campaign_search')){
	function charitus_ajax_campaign_search(){
		$args = array (
			'post_type' 		=> 'campaign',
			'post_status' 		=> 'publish',
			'order' 			=> 'DESC',
			'orderby' 			=> 'date',
			's' 				=> $_POST['term'],
			'posts_per_page' 	=> apply_filters( 'charitus_campaign_search_number_of_post', 10 ),
		);
		 
		$query = new WP_Query( $args );
		 
		if($query->have_posts()){
			echo '<ul>';
				while ($query->have_posts()) {
					$query->the_post();
					printf( '<li><a href="%s">%s</a></li>', esc_url( get_the_permalink() ), esc_html( get_the_title() ) );
				}
			echo '</ul>';
		}else{
			printf( '<li><a href="#">%s</a></li>', esc_html__( 'No result found.', 'charitus' ) );
		}

		wp_reset_postdata();
		exit;
	}
}

/**
 * Define home url for ajax course search
 */

if(!function_exists('charitus_ajax_course_search_base')){
	function charitus_ajax_course_search_base(){
		?>
			<script type="text/javascript">var ep_home_url = "<?php echo esc_url( home_url() ) ?>";</script>
		<?php
	}
}


/**
 * Donate ShortCode
 */

if ( class_exists( 'Charitable' ) ){
	add_shortcode( 'charitus_donation_stats', 'charitus_donation_stats_shortcode' );

	if( !function_exists('charitus_donation_stats_shortcode') ){
		function charitus_donation_stats_shortcode($atts){
			extract(shortcode_atts(array(
				'column'  						=> 3,
				'show_campaign_count'  			=> 'on',
				'show_campaign_donated_amount'  => 'on',
				'show_campaign_donors_count'  	=> 'on',
				'campaigns_text_singular'  		=> esc_html__( 'Campaign', 'charitus' ),
				'campaigns_text_plural'  		=> esc_html__( 'Campaigns', 'charitus' ),
				'donor_text_singular'  			=> esc_html__( 'Donor', 'charitus' ),
				'donor_text_plural'  			=> esc_html__( 'Donors', 'charitus' ),
				'donated_text'  				=> esc_html__( 'Donated', 'charitus' ),
		    ), $atts));

		    $campaigns_count = Charitable_Campaigns::query( array( 'posts_per_page' => -1, 'fields' => 'ids' ) )->found_posts;
			$campaigns_text  = 1 == $campaigns_count ? $campaigns_text_singular : $campaigns_text_plural;
			$donated_amount = charitable_format_money( charitable_get_table( 'campaign_donations' )->get_total(), 0 );
			$donors_count = charitable_get_table( 'donors' )->count_donors_with_donations();
			$donors_text  = 1 == $donors_count ? $donor_text_singular : $donor_text_plural;


			if( $column ){
				$column = 12/$column;
				$column = 'col-md-'.$column . ' col-sm-4 ch-donation-stats-item-column';
			}

			$column = apply_filters( 'charitus_donation_stats_grid_column', $column );

			ob_start();

		?>	
			<div class="charitus-donation-stats">
				<div class="row">
			        <?php 
						if( $show_campaign_count == 'on' ){
							printf( '<div class="%s"><div class="ch-donation-stats-item shadow"><i class="fa flaticon-graphic"></i><span class="ch-campaign-count ch-campaign-stats-count">%d</span><span class="ch-campaign-stats-text">%s</span></div></div>', esc_attr($column), $campaigns_count, $campaigns_text );
						}
						if( $show_campaign_donated_amount == 'on' ){
							printf( '<div class="%s"><div class="ch-donation-stats-item shadow"><i class="fa flaticon-money"></i><span class="ch-campaign-donated-amount ch-campaign-stats-count">%s</span><span class="ch-campaign-stats-text">%s</span></div></div>', esc_attr($column), $donated_amount, $donated_text );
						}
						if( $show_campaign_donors_count == 'on' ){
							printf( '<div class="%s"><div class="ch-donation-stats-item shadow"><i class="fa flaticon-profile"></i><span class="ch-campaign-donors-count ch-campaign-stats-count">%s</span><span class="ch-campaign-stats-text">%s</span></div></div>', esc_attr($column), $donors_count, $donors_text );
						}
					?>
		        </div>
	        </div>

			<?php
		    return ob_get_clean();
		}
	}
}
<?php
/**
 * Plugin Name:   Sponsored By
 * Plugin URI:    https://psycharmor.org
 * Description:   Adds a course author widget that displays the name of the Subject Matter Expert.
 * Version:       1.0
 * Author:        Amy Singleton
 * Author URI:    https://psycharmor.org
 */

class sponsored_by_Widget extends WP_Widget {


  // Set up the widget name and description.
  public function __construct() {
    $widget_options = array( 'classname' => 'sponsored_by_widget', 'description' => 'Add the Course Sponsor to the sidebar' );
    parent::__construct( 'sponsored_by_widget', 'Sponsored By', $widget_options );
  }
  // Create the widget output.
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    if ( isset( $instance[ 'sponsor_img' ] ) ) {
      $sponsor_img = $instance[ 'sponsor_img' ];
    }
    else {
      $sponsor_img = __( 'Sponsored By', 'sponsored_by_widget' );
    }
    
    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>
    <div class="sponsor col-sm-12">
        <p class="sponsor light-font">Sponsored by</p>
    </div>
    <div class="sponsor-img col-sm-12">
        <img src="<?php echo esc_url($sponsor_img) ?>" alt="sponsored by logo image"/>
    </div>
    <?php echo $args['after_widget'];
  }

  
  // Create the admin area widget settings form.
  public function form( $instance ) {
   
  $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
  $sponsor_img = ! empty( $instance['sponsor_img'] ) ? $instance['sponsor_img'] : ''; ?>
    <p class="">
      <label class="" for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
      <input class="" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p class="">
      <label class="" for="<?php echo $this->get_field_id( 'sponsor_img' ); ?>">Enter the image url:</label>
      <input class="" type="text" id="<?php echo $this->get_field_id( 'sponsor_img' ); ?>" name="<?php echo $this->get_field_name( 'sponsor_img' ); ?>" value="<?php echo esc_attr( $sponsor_img ); ?>" />
    </p>
  <?php 
     //Sponsored By Back End Styles
    //wp_enqueue_style( 'subject-matter-expert-widget-styles', get_stylesheet_directory_uri() . '/css/subject-matter-expert-widget.css', '20180504', true );
  }


  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    $instance[ 'sponsor_img' ] = strip_tags( $new_instance[ 'sponsor_img' ] );
    return $instance;
  }

}

// Register the widget.
function learnarmor_child_register_sponsored_by_widget() { 
  register_widget( 'sponsored_by_Widget' );
}
add_action( 'widgets_init', 'learnarmor_child_register_sponsored_by_widget' );

?>
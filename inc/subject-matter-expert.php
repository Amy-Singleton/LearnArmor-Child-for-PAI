<?php
/**
 * Plugin Name:   Subject Matter Expert
 * Plugin URI:    https://psycharmor.org
 * Description:   Adds a course author widget that displays the name of the Subject Matter Expert.
 * Version:       1.0
 * Author:        Amy Singleton
 * Author URI:    https://psycharmor.org
 */

class subject_matter_expert_Widget extends WP_Widget {


  // Set up the widget name and description.
  public function __construct() {
    $widget_options = array( 'classname' => 'subject_matter_expert_widget', 'description' => 'Add Subject Matter Expert information to the sidebar' );
    parent::__construct( 'subject_matter_expert_widget', 'Subject Matter Expert', $widget_options );
  }


  // Create the widget output.
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $author = get_the_author_meta();
    $author_nickname = get_the_author_meta('nickname');
    //$author_first_name = get_the_author_meta('first_name');
    //$author_last_name = get_the_author_meta('last_name');
    $author_img =  get_avatar( get_the_author_meta( 'ID' ), 100 );
    
    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>
    <div class="sme col-sm-9">
        <p class="sme light-font">Subject Matter Expert</p>
        <p class="sme light-font"><?php echo $author_nickname ?></p>
    </div>
    <div class="sme-author-img col-sm-3">
        <?php echo $author_img ?>
    </div>
    <?php echo $args['after_widget'];
  }

  
  // Create the admin area widget settings form.
  public function form( $instance ) {
   
    $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
    <p class="">
      <label class="" for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
      <input class="" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p><?php
     //Subject Matter Expert Backend Styles
    wp_enqueue_style( 'subject-matter-expert-widget-styles', get_stylesheet_directory_uri() . '/css/subject-matter-expert-widget.css', '20180504', true );
  }


  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    return $instance;
  }

}

// Register the widget.
function learnarmor_child_register_subject_matter_expert_widget() { 
  register_widget( 'subject_matter_expert_Widget' );
}
add_action( 'widgets_init', 'learnarmor_child_register_subject_matter_expert_widget' );

?>
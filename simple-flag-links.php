<?php
/**
 * Plugin Name: Simple Flag Links
 * Description: This plugin adds a widget where you can add a flag + a link on the page.
 * Version: 1.0.9
 * Author: Hanning Høegh - Better Collective
 * License: GPL2
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 */


//Plugin Update Checker
require 'plugin-update-checker/plugin-update-checker.php';
$className = PucFactory::getLatestClassVersion('PucGitHubChecker');
$myUpdateChecker = new $className(
    'https://github.com/SmileyJoey/simple-flag-links/',
    __FILE__,
    'master'
);


class Simple_Flag_Links_Widget extends WP_Widget {

	/**
	 * Default widget values.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Default widget profile values.
	 *
	 * @var array
	 */
	protected $profiles;

	/**
	 * Constructor method.
	 *
	 * Set some global values and create widget.
	 */
	function __construct() {

		/**
		 * Default widget option values.
		 */
		$this->defaults = apply_filters( 'simple_flag_links_styles', array(
			'title'                  => 'Visit us in another language',
			'title_color'            => '#000',
			'title_size'	         => 32,
			'new_window'             => 1,
			'flag_type'				 => 'round',
			'flag_size'              => 150,
			'alignment'              => 'aligncenter',
			'hover_effect'		     => 'hvr-float-shadow',
			'australia'              => '',
			'brazil'                 => '',
			'canada'                 => '',
			'denmark'                => '',
			'germany'                => '',
			'hongkong'               => '',
			'india'                  => '',
			'italy'                  => '',
			'japan'                  => '',
			'nigeria'                => '',
			'norway'                 => '',
			'poland'                 => '',
			'spain'                  => '',
			'sweden'                 => '',
			'turkey'                 => '',
			'unitedkingdom'          => '',
			'finland'                => '',
			'russia'				 => '',
			'serbia'				 => '',
			'france'				 => '',
			'tunisia'				 => '',
			'albania'				 => '',
			'czechrepublic'		     => '',
			'china'				     => '',
			'thailand'				 => '',
			'indonesia'				 => '',
			'ireland'				 => '',
		) );


		/**
		 * Flag profile choices.
		 */
		$this->profiles = apply_filters( 'simple_flag_default_profiles', array(
			'australia' => array(
				'label'   => __( 'Australia URI', 'ssiw' ),
				'pattern' => '<li class="flag-australia-%s %s"><a href="%s" %s></a></li>',
			),
			'brazil' => array(
				'label'   => __( 'Brazil URI', 'ssiw' ),
				'pattern' => '<li class="flag-brazil-%s %s"><a href="%s" %s></a></li>',
			),
			'canada' => array(
				'label'   => __( 'Canada URI', 'ssiw' ),
				'pattern' => '<li class="flag-canada-%s %s"><a href="%s" %s></a></li>',
			),
			'denmark' => array(
				'label'   => __( 'Denmark URI', 'ssiw' ),
				'pattern' => '<li class="flag-denmark-%s %s"><a href="%s" %s></a></li>',
			),
			'germany' => array(
				'label'   => __( 'Germany URI', 'ssiw' ),
				'pattern' => '<li class="flag-germany-%s %s"><a href="%s" %s></a></li>',
			),
			'hongkong' => array(
				'label'   => __( 'Hongkong URI', 'ssiw' ),
				'pattern' => '<li class="flag-hongkong-%s %s"><a href="%s" %s></a></li>',
			),
			'india' => array(
				'label'   => __( 'India URI', 'ssiw' ),
				'pattern' => '<li class="flag-india-%s %s"><a href="%s" %s></a></li>',
			),
			'italy' => array(
				'label'   => __( 'Italy URI', 'ssiw' ),
				'pattern' => '<li class="flag-italy-%s %s"><a href="%s" %s></a></li>',
			),
			'japan' => array(
				'label'   => __( 'Japan URI', 'ssiw' ),
				'pattern' => '<li class="flag-japan-%s %s"><a href="%s" %s></a></li>',
			),
			'nigeria' => array(
				'label'   => __( 'Nigeria URI', 'ssiw' ),
				'pattern' => '<li class="flag-nigeria-%s %s"><a href="%s" %s></a></li>',
			),
			'norway' => array(
				'label'   => __( 'Norway URI', 'ssiw' ),
				'pattern' => '<li class="flag-norway-%s %s"><a href="%s" %s></a></li>',
			),
			'poland' => array(
				'label'   => __( 'Poland URI', 'ssiw' ),
				'pattern' => '<li class="flag-poland-%s %s"><a href="%s" %s></a></li>',
			),
			'spain' => array(
				'label'   => __( 'Spain URI', 'ssiw' ),
				'pattern' => '<li class="flag-spain-%s %s"><a href="%s" %s></a></li>',
			),
			'sweden' => array(
				'label'   => __( 'Sweden URI', 'ssiw' ),
				'pattern' => '<li class="flag-sweden-%s %s"><a href="%s" %s></a></li>',
			),
			'turkey' => array(
				'label'   => __( 'Turkey URI', 'ssiw' ),
				'pattern' => '<li class="flag-turkey-%s %s"><a href="%s" %s></a></li>',
			),
			'unitedkingdom' => array(
				'label'   => __( 'United Kingdom URI', 'ssiw' ),
				'pattern' => '<li class="flag-unitedkingdom-%s %s"><a href="%s" %s></a></li>',
			),
			'finland' => array(
				'label'   => __( 'Finland URI', 'ssiw' ),
				'pattern' => '<li class="flag-finland-%s %s"><a href="%s" %s></a></li>',
			),
			'russia' => array(
				'label'   => __( 'Russia URI', 'ssiw' ),
				'pattern' => '<li class="flag-russia-%s %s"><a href="%s" %s></a></li>',
			),
			'serbia' => array(
				'label'   => __( 'Serbia URI', 'ssiw' ),
				'pattern' => '<li class="flag-serbia-%s %s"><a href="%s" %s></a></li>',
			),
			'france' => array(
				'label'   => __( 'France URI', 'ssiw' ),
				'pattern' => '<li class="flag-france-%s %s"><a href="%s" %s></a></li>',
			),
			'tunisia' => array(
				'label'   => __( 'Tunisia URI', 'ssiw' ),
				'pattern' => '<li class="flag-tunisia-%s %s"><a href="%s" %s></a></li>',
			),
			'albania' => array(
				'label'   => __( 'Albania URI', 'ssiw' ),
				'pattern' => '<li class="flag-albania-%s %s"><a href="%s" %s></a></li>',
			),
			'czechrepublic' => array(
				'label'   => __( 'Czech Republic URI', 'ssiw' ),
				'pattern' => '<li class="flag-czechrepublic-%s %s"><a href="%s" %s></a></li>',
			),
			'china' => array(
				'label'   => __( 'China URI', 'ssiw' ),
				'pattern' => '<li class="flag-china-%s %s"><a href="%s" %s></a></li>',
			),
			'thailand' => array(
				'label'   => __( 'Thailand URI', 'ssiw' ),
				'pattern' => '<li class="flag-thailand-%s %s"><a href="%s" %s></a></li>',
			),
			'indonesia' => array(
				'label'   => __( 'Indonesia URI', 'ssiw' ),
				'pattern' => '<li class="flag-indonesia-%s %s"><a href="%s" %s></a></li>',
			),
			'cyprus' => array(
				'label'   => __( 'Cyprus URI', 'ssiw' ),
				'pattern' => '<li class="flag-cyprus-%s %s"><a href="%s" %s></a></li>',
			),
			'cotedivoire' => array(
				'label'   => __( 'Cote d´Ivoire URI', 'ssiw' ),
				'pattern' => '<li class="flag-cotedivoire-%s %s"><a href="%s" %s></a></li>',
			),
			'uae' => array(
				'label'   => __( 'United Arab Emirates URI', 'ssiw' ),
				'pattern' => '<li class="flag-uae-%s %s"><a href="%s" %s></a></li>',
			),
			'ireland' => array(
				'label'   => __( 'Ireland URI', 'ssiw' ),
				'pattern' => '<li class="flag-ireland-%s %s"><a href="%s" %s></a></li>',
			),
		) );

		$widget_ops = array(
			'classname'   => 'simple-flag-links',
			'description' => __( 'Displays simple flag icons.', 'ssiw' ),
		);

		$control_ops = array(
			'id_base' => 'simple-flag-links',
		);

		parent::__construct( 'simple-flag-links', __( 'Simple Flag Links', 'ssiw' ), $widget_ops, $control_ops );

		/** Enqueue icon font */
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ) );

		/** Load CSS in <head> */
		add_action( 'wp_head', array( $this, 'css' ) );

		/** Load color picker */
		add_action( 'admin_enqueue_scripts', array( $this, 'load_color_picker' ) );
		add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );

	}



	/**
	 * Color Picker.
	 *
	 * Enqueue the color picker script.
	 *
	 */
	function load_color_picker( $hook ) {
		if( 'widgets.php' != $hook )
			return;
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'underscore' );
	}

	/**
	 * Print scripts.
	 *
	 * Reference https://core.trac.wordpress.org/attachment/ticket/25809/color-picker-widget.php
	 *
	 */
	function print_scripts() {
		?>
		<script>
			( function( $ ){
				function initColorPicker( widget ) {
					widget.find( '.ssiw-color-picker' ).wpColorPicker( {
						change: function ( event ) {
							var $picker = $( this );
							_.throttle(setTimeout(function () {
								$picker.trigger( 'change' );
							}, 5), 250);
						},
						width: 235,
					});
				}

				function onFormUpdate( event, widget ) {
					initColorPicker( widget );
				}

				$( document ).on( 'widget-added widget-updated', onFormUpdate );

				$( document ).ready( function() {
					$( '#widgets-right .widget:has(.ssiw-color-picker)' ).each( function () {
						initColorPicker( $( this ) );
					} );
				} );
			}( jQuery ) );
		</script>
		<?php
	}

	/**
	 * Widget Form.
	 *
	 * Outputs the widget form that allows users to control the output of the widget.
	 *
	 */
	function form( $instance ) {

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Heading Title:', 'simple-flag-links' ); ?></label> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php _e( 'Title Color:', 'simple-flag-links' ); ?></label><br /> <input id="<?php echo $this->get_field_id( 'title_color' ); ?>" name="<?php echo $this->get_field_name( 'title_color' ); ?>" type="text" class="ssiw-color-picker" data-default-color="<?php echo esc_attr( $this->defaults['title_color'] ); ?>" value="<?php echo esc_attr( $instance['title_color'] ); ?>" size="6" /></p>

		<p><label><input id="<?php echo $this->get_field_id( 'new_window' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="1" <?php checked( 1, $instance['new_window'] ); ?>/> <?php esc_html_e( 'Open links in new window?', 'simple-flag-links' ); ?></label></p>

		<p><label style="margin-right: 12.4%;" for="<?php echo $this->get_field_id( 'title_size' ); ?>"><?php _e( 'Title Size', 'simple-flag-links' ); ?>:</label> <input id="<?php echo $this->get_field_id( 'title_size' ); ?>" name="<?php echo $this->get_field_name( 'title_size' ); ?>" type="text" value="<?php echo esc_attr( $instance['title_size'] ); ?>" size="3" />px</p>

		<p>
			<label style="margin-right: 11.4%;" for="<?php echo $this->get_field_id( 'flag_type' ); ?>"><?php _e( 'Flag Type', 'simple-flag-links' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'flag_type' ); ?>" name="<?php echo $this->get_field_name( 'flag_type' ); ?>">
				<option value="round" <?php selected( 'round', $instance['flag_type'] ) ?>><?php _e( 'Round', 'simple-flag-links' ); ?></option>
				<option value="square-flat" <?php selected( 'square-flat', $instance['flag_type'] ) ?>><?php _e( 'Square Flat', 'simple-flag-links' ); ?></option>
				<option value="square-shiny" <?php selected( 'square-shiny', $instance['flag_type'] ) ?>><?php _e( 'Square Shiny', 'simple-flag-links' ); ?></option>
			</select>
		</p>

		<p><label style="margin-right: 12.6%;" for="<?php echo $this->get_field_id( 'flag_size' ); ?>"><?php _e( 'Flag Size', 'simple-flag-links' ); ?>:</label> <input id="<?php echo $this->get_field_id( 'flag_size' ); ?>" name="<?php echo $this->get_field_name( 'flag_size' ); ?>" type="text" value="<?php echo esc_attr( $instance['flag_size'] ); ?>" size="3" />px</p>

		<p>
			<label style="margin-right: 3%;" for="<?php echo $this->get_field_id( 'alignment' ); ?>"><?php _e( 'Flag Alignment', 'simple-flag-links' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'alignment' ); ?>" name="<?php echo $this->get_field_name( 'alignment' ); ?>">
				<option value="alignleft" <?php selected( 'alignleft', $instance['alignment'] ) ?>><?php _e( 'Align Left', 'simple-flag-links' ); ?></option>
				<option value="aligncenter" <?php selected( 'aligncenter', $instance['alignment'] ) ?>><?php _e( 'Align Center', 'simple-flag-links' ); ?></option>
				<option value="alignright" <?php selected( 'alignright', $instance['alignment'] ) ?>><?php _e( 'Align Right', 'simple-flag-links' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'hover_effect' ); ?>"><?php _e( 'Flag Hover Effect', 'simple-flag-links' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'hover_effect' ); ?>" name="<?php echo $this->get_field_name( 'hover_effect' ); ?>">
				<option value="hvr-float-shadow" <?php selected( 'hvr-float-shadow', $instance['hover_effect'] ) ?>><?php _e( '2D: Float Shadow', 'simple-flag-links' ); ?></option>
				<option value="hvr-grow" <?php selected( 'hvr-grow', $instance['hover_effect'] ) ?>><?php _e( '2D: Grow', 'simple-flag-links' ); ?></option>
				<option value="hvr-shrink" <?php selected( 'hvr-shrink', $instance['hover_effect'] ) ?>><?php _e( '2D: Shrink', 'simple-flag-links' ); ?></option>
				<option value="hvr-pulse" <?php selected( 'hvr-pulse', $instance['hover_effect'] ) ?>><?php _e( '2D: Pulse', 'simple-flag-links' ); ?></option>
				<option value="hvr-pulse-grow" <?php selected( 'hvr-pulse-grow', $instance['hover_effect'] ) ?>><?php _e( '2D: Pulse Grow', 'simple-flag-links' ); ?></option>
				<option value="hvr-pulse-shrink" <?php selected( 'hvr-pulse-shrink', $instance['hover_effect'] ) ?>><?php _e( '2D: Pulse Shrink', 'simple-flag-links' ); ?></option>
				<option value="hvr-push" <?php selected( 'hvr-push', $instance['hover_effect'] ) ?>><?php _e( '2D: Push', 'simple-flag-links' ); ?></option>
				<option value="hvr-pop" <?php selected( 'hvr-pop', $instance['hover_effect'] ) ?>><?php _e( '2D: Pop', 'simple-flag-links' ); ?></option>
				<option value="hvr-bounce-in" <?php selected( 'hvr-bounce-in', $instance['hover_effect'] ) ?>><?php _e( '2D: Bounce In', 'simple-flag-links' ); ?></option>
				<option value="hvr-bounce-out" <?php selected( 'hvr-bounce-out', $instance['hover_effect'] ) ?>><?php _e( '2D: Bounce Out', 'simple-flag-links' ); ?></option>
				<option value="hvr-rotate" <?php selected( 'hvr-rotate', $instance['hover_effect'] ) ?>><?php _e( '2D: Rotate', 'simple-flag-links' ); ?></option>
				<option value="hvr-grow-rotate" <?php selected( 'hvr-grow-rotate', $instance['hover_effect'] ) ?>><?php _e( '2D: Grow Rotate', 'simple-flag-links' ); ?></option>
				<option value="hvr-float" <?php selected( 'hvr-float', $instance['hover_effect'] ) ?>><?php _e( '2D: Float', 'simple-flag-links' ); ?></option>
				<option value="hvr-sink" <?php selected( 'hvr-sink', $instance['hover_effect'] ) ?>><?php _e( '2D: Sink', 'simple-flag-links' ); ?></option>
				<option value="hvr-bob" <?php selected( 'hvr-bob', $instance['hover_effect'] ) ?>><?php _e( '2D: Bob', 'simple-flag-links' ); ?></option>
				<option value="hvr-hang" <?php selected( 'hvr-hang', $instance['hover_effect'] ) ?>><?php _e( '2D: Hang', 'simple-flag-links' ); ?></option>
				<option value="hvr-skew" <?php selected( 'hvr-skew', $instance['hover_effect'] ) ?>><?php _e( '2D: Skew', 'simple-flag-links' ); ?></option>
				<option value="hvr-skew-forward" <?php selected( 'hvr-skew-forward', $instance['hover_effect'] ) ?>><?php _e( '2D: Skew Forward', 'simple-flag-links' ); ?></option>
				<option value="hvr-skew-backward" <?php selected( 'hvr-skew-backward', $instance['hover_effect'] ) ?>><?php _e( '2D: Skew Backward', 'simple-flag-links' ); ?></option>
				<option value="hvr-wobble-horizontal" <?php selected( 'hvr-wobble-horizontal', $instance['hover_effect'] ) ?>><?php _e( '2D: Wobble Horizontal', 'simple-flag-links' ); ?></option>
				<option value="hvr-wobble-vertical" <?php selected( 'hvr-wobble-vertical', $instance['hover_effect'] ) ?>><?php _e( '2D: Wobble Vertical', 'simple-flag-links' ); ?></option>
				<option value="hvr-wobble-to-bottom-right" <?php selected( 'hvr-wobble-to-bottom-right', $instance['hover_effect'] ) ?>><?php _e( '2D: Wobble To Bottom Right', 'simple-flag-links' ); ?></option>
				<option value="hvr-wobble-to-top-right" <?php selected( 'hvr-wobble-to-top-right', $instance['hover_effect'] ) ?>><?php _e( '2D: Wobble To Top Right', 'simple-flag-links' ); ?></option>
				<option value="hvr-wobble-top" <?php selected( 'hvr-wobble-top', $instance['hover_effect'] ) ?>><?php _e( '2D: Wobble-top', 'simple-flag-links' ); ?></option>
				<option value="hvr-wobble-bottom" <?php selected( 'hvr-wobble-bottom', $instance['hover_effect'] ) ?>><?php _e( '2D: Wobble Bottom', 'simple-flag-links' ); ?></option>
				<option value="hvr-wobble-skew" <?php selected( 'hvr-wobble-skew', $instance['hover_effect'] ) ?>><?php _e( '2D: Wobble Skew', 'simple-flag-links' ); ?></option>
				<option value="hvr-buzz" <?php selected( 'hvr-buzz', $instance['hover_effect'] ) ?>><?php _e( '2D: Buzz', 'simple-flag-links' ); ?></option>
				<option value="hvr-buzz-out" <?php selected( 'hvr-buzz-out', $instance['hover_effect'] ) ?>><?php _e( '2D: Buzz Out', 'simple-flag-links' ); ?></option>
				<option value="hvr-shadow" <?php selected( 'hvr-shadow', $instance['hover_effect'] ) ?>><?php _e( 'Shadow: Shadow', 'simple-flag-links' ); ?></option>
				<option value="hvr-grow-shadow" <?php selected( 'hvr-grow-shadow', $instance['hover_effect'] ) ?>><?php _e( 'Shadow: Grow Shadow', 'simple-flag-links' ); ?></option>
				<option value="hvr-float-shadow" <?php selected( 'hvr-float-shadow', $instance['hover_effect'] ) ?>><?php _e( 'Shadow: Float Shadow', 'simple-flag-links' ); ?></option>
			</select>
		</p>


		<hr style="background: #ccc; border: 0; height: 1px; margin: 20px 0;" />


		<?php
		foreach ( (array) $this->profiles as $profile => $data ) {

			printf( '<p><label for="%s">%s:</label></p>', esc_attr( $this->get_field_id( $profile ) ), esc_attr( $data['label'] ) );
			printf( '<p><input type="text" id="%s" name="%s" value="%s" class="widefat" />', esc_attr( $this->get_field_id( $profile ) ), esc_attr( $this->get_field_name( $profile ) ), esc_url( $instance[$profile] ) );
			printf( '</p>' );

		}

	}

	/**
	 * Form validation and sanitization.
	 *
	 * Runs when you save the widget form. Allows you to validate or sanitize widget options before they are saved.
	 *
	 */
	function update( $newinstance, $oldinstance ) {

		foreach ( $newinstance as $key => $value ) {

			/** Validate hex code colors */
			if ( strpos( $key, '_color' ) && 0 == preg_match( '/^#(([a-fA-F0-9]{3}$)|([a-fA-F0-9]{6}$))/', $value ) ) {
				$newinstance[$key] = $oldinstance[$key];
			}

			/** Sanitize Profile URIs */
			elseif ( array_key_exists( $key, (array) $this->profiles ) ) {
				$newinstance[$key] = esc_url( $newinstance[$key] );
			}

		}

		return $newinstance;

	}

	/**
	 * Widget Output.
	 *
	 * Outputs the actual widget on the front-end based on the widget options the user selected.
	 *
	 */
	function widget( $args, $instance ) {

		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;

			if ( ! empty( $instance['title'] ) )
				echo $before_title . apply_filters( 'widget_title test', $instance['title'], $instance, $this->id_base ) . $after_title;

			$output = '';

			$flag_type = $instance['flag_type'];

			$hover_effect = $instance['hover_effect'];

			$new_window = $instance['new_window'] ? 'target="_blank"' : '';

			$profiles = (array) $this->profiles;

			foreach ( $profiles as $profile => $data ) {

				if ( empty( $instance[ $profile ] ) )
					continue;
				else
					$output .= sprintf( $data['pattern'], $flag_type, $hover_effect, esc_url($instance[$profile] ), $new_window );

			}

			if ( $output )
				printf( '<ul class="%s">%s</ul>', $instance['alignment'], $output );

		echo $after_widget;

	}

	function enqueue_css() {
		$cssfile = apply_filters( 'simple_flag_links_default_css', plugin_dir_url( __FILE__ ) . 'css/style.css' );
    	wp_enqueue_style( 'hover-min', '//cdnjs.cloudflare.com/ajax/libs/hover.css/2.0.2/css/hover-min.css#asyncload', false, null);
		wp_enqueue_style( 'simple-flag-links-font', esc_url( $cssfile ), array(), '1.0.12', 'all' );
	}

	/**
	 * Custom CSS.
	 *
	 * Outputs custom CSS to control the look of the icons.
	 */
	function css() {

		/** Pull widget settings, merge with defaults */
		$all_instances = $this->get_settings();
		if ( ! isset( $this->number ) || ! isset( $all_instances[$this->number] ) ) {
			return;
		}

		$instance = wp_parse_args( $all_instances[$this->number], $this->defaults );

		$flag_size = round( (int) $instance['flag_size'] / 2 );
		$title_size = round( (int) $instance['title_size']);

		/** The CSS to output */
		$css = '
		.simple-flag-links ul li a,
		.simple-flag-links ul li a:hover {
			width: ' . $flag_size . 'px;
			height: ' . $flag_size . 'px;
		}

		.simple-flag-links > div > h4{
		    color: '. $instance['title_color'] .' !important;
		    font-size: '. $title_size .'px !important;
		}';


		/** Minify a bit */
		$css = str_replace( "\t", '', $css );
		$css = str_replace( array( "\n", "\r" ), ' ', $css );

		/** Echo the CSS */
		echo '<style type="text/css" media="screen">' . $css . '</style>';

	}

}

$hej = "hej2";

/**
 * Widget Registration.
 *
 * Register Simple Flag Links widget.
 *
 */
function ssiw_load_widget() {

	register_widget( 'Simple_Flag_Links_Widget' );

}
add_action( 'widgets_init', 'ssiw_load_widget' );

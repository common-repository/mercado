<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/includes
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwmer_Mercado_Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $rtwmer_actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $rtwmer_actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $rtwmer_filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $rtwmer_filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->rtwmer_actions = array();
		$this->rtwmer_filters = array();

	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $rtwmer_hook             The name of the WordPress action that is being registered.
	 * @param    object               $rtwmer_component        A reference to the instance of the object on which the action is defined.
	 * @param    string               $rtwmer_callback         The name of the function definition on the $rtwmer_component.
	 * @param    int                  $rtwmer_priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $rtwmer_accepted_args    Optional. The number of arguments that should be passed to the $rtwmer_callback. Default is 1.
	 */
	public function rtwmer_add_action( $rtwmer_hook, $rtwmer_component, $rtwmer_callback, $rtwmer_priority = 10, $rtwmer_accepted_args = 1 ) {
		$this->rtwmer_actions = $this->rtwmer_add( $this->rtwmer_actions, $rtwmer_hook, $rtwmer_component, $rtwmer_callback, $rtwmer_priority, $rtwmer_accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 * 
	 * @since    1.0.0
	 * @param    string               $rtwmer_hook             The name of the WordPress filter that is being registered.
	 * @param    object               $rtwmer_component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $rtwmer_callback         The name of the function definition on the $rtwmer_component.
	 * @param    int                  $rtwmer_priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $rtwmer_accepted_args    Optional. The number of arguments that should be passed to the $rtwmer_callback. Default is 1
	 */
	public function rtwmer_add_filter( $rtwmer_hook, $rtwmer_component, $rtwmer_callback, $rtwmer_priority = 10, $rtwmer_accepted_args = 1 ) {
		$this->rtwmer_filters = $this->rtwmer_add( $this->rtwmer_filters, $rtwmer_hook, $rtwmer_component, $rtwmer_callback, $rtwmer_priority, $rtwmer_accepted_args );
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $rtwmer_hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string               $rtwmer_hook             The name of the WordPress filter that is being registered.
	 * @param    object               $rtwmer_component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $rtwmer_callback         The name of the function definition on the $component.
	 * @param    int                  $rtwmer_priority         The priority at which the function should be fired.
	 * @param    int                  $rtwmer_accepted_args    The number of arguments that should be passed to the $rtwmer_callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function rtwmer_add( $rtwmer_hooks, $rtwmer_hook, $rtwmer_component, $rtwmer_callback, $rtwmer_priority, $rtwmer_accepted_args ) {

		$rtwmer_hooks[] = array(
			'hook'          => $rtwmer_hook,
			'component'     => $rtwmer_component,
			'callback'      => $rtwmer_callback,
			'priority'      => $rtwmer_priority,
			'accepted_args' => $rtwmer_accepted_args
		);

		return $rtwmer_hooks;

	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function rtwmer_run() {

		foreach ( $this->rtwmer_filters as $rtwmer_hook ) {
			add_filter( $rtwmer_hook['hook'], array( $rtwmer_hook['component'], $rtwmer_hook['callback'] ), $rtwmer_hook['priority'], $rtwmer_hook['accepted_args'] );
		}

		foreach ( $this->rtwmer_actions as $rtwmer_hook ) {
			add_action( $rtwmer_hook['hook'], array( $rtwmer_hook['component'], $rtwmer_hook['callback'] ), $rtwmer_hook['priority'], $rtwmer_hook['accepted_args'] );
		}
		
	}

}

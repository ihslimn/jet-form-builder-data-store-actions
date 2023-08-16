<?php

namespace JFB_Clear_Data_Store_Action\Jet_Form_Builder\Actions;

use JFB_Clear_Data_Store_Action\Plugin;
use Jet_Form_Builder\Actions\Manager;
use Jet_Form_Builder\Actions\Types\Base as ActionBase;
use Jet_Form_Builder\Actions\Action_Handler;

class Clear_Data_Store extends ActionBase {

	public static function register() {
		$self = new self();

		add_action(
			'jet-form-builder/actions/register',
			array( $self, 'register_action' )
		);
		add_action(
			'jet-form-builder/editor-assets/before',
			array( $self, 'editor_assets' )
		);
	}

	public function register_action( Manager $manager ) {
		$manager->register_action_type( $this );
	}

	/**
	 * @return string
	 */
	public function get_id() {
		return 'clear_data_store';
	}

	/**
	 * @return string
	 */
	public function get_name() {
		return __( 'Clear Data Store', 'jet-forms-addon-boilerplate-simple' );
	}

	/**
	 * @return string
	 */
	public function self_script_name() {
		return 'JFBClearDataStore';
	}

	/**
	 * @return string[]
	 */
	public function editor_labels() {
		return array(
			'store_slug' => 'Data Store slug',
		);
	}

	/**
	 * @return string[]
	 */
	public function visible_attributes_for_gateway_editor() {
		return array( 'store_slug' );
	}

	/**
	 * @param array $request
	 * @param Action_Handler $handler
	 *
	 * @return void
	 */
	public function do_action( array $request, Action_Handler $handler ) {
		
		if ( ! jet_engine()->modules->is_module_active( 'data-stores' ) ) {
			return;
		}

		$store_slug = $this->settings['store_slug'] ?? '';

		if ( ! $store_slug ) {
			return;
		}

		$store = \Jet_Engine\Modules\Data_Stores\Module::instance()->stores->get_store( $store_slug );

		if ( ! $store ) {
			return;
		}

		$type = $store->get_type()->type_id();

		if ( $type === 'local-storage' ) {
			$this->add_store_to_response( $store_slug );
		} else {
			
			$store_items = $store->get_store();
		
			foreach ( $store_items as $item_id ) {
				$store->get_type()->remove( $store_slug, $item_id );
			}

			if ( jet_fb_handler()->is_ajax() ) {
				$this->add_store_to_response( $store_slug );
			}

		}

	}

	public function add_store_to_response( $store_slug ) {

		$stores = jet_fb_handler()->response_data['clear_data_store'] ?? '';

		if ( empty( $stores ) ) {
			jet_fb_handler()->response_data['clear_data_store'] = $store_slug;
		} else {
			jet_fb_handler()->response_data['clear_data_store'] .= ',' . $store_slug;
		}

	}

	public function editor_assets() {
		wp_enqueue_script(
			Plugin::instance()->slug . '-editor',
			Plugin::instance()->plugin_url( 'assets/js/builder.editor.js' ),
			array(),
			Plugin::instance()->get_version(),
			true
		);
	}
}
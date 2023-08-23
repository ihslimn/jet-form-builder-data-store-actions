( function( $ ) {

	"use strict";

	$( document ).on( 'jet-form-builder/ajax/on-success', handleAjaxSubmit );

	$( document ).ready( handleReloadSubmit );

	function handleReloadSubmit() {

		if ( ! window.location?.search ) {
			return;
		}

		const params = new URLSearchParams( window.location.search ),
		      stores = params.get('clear_data_store')?.split( ',' );

		clearStores( stores );

	}

	function handleAjaxSubmit( event, response ) {

		if ( ! response.clear_data_store ) {
			return;
		}

		const stores = response.clear_data_store.split( ',' );

		clearStores( stores );

		updateListings( response );

	}

	function updateListings( response ) {

		if ( ! response.updated_listings?.length ) {
			return;
		}

		response.updated_listings.forEach( function( listing_id ) {

			const $this = $( '#' + listing_id ),
			      nav   = $this.find('.jet-listing-grid__items').data( 'nav' );

			console.log( $this, nav );

			if ( ! nav ) {
				return;
			}

			const query = nav.query;
	
			let args = {
				handler:'get_listing',
				container:$this.find('.elementor-widget-container'),
				masonry:false,
				slider:false,
				append:false,
				query: query,
				widgetSettings: nav.widget_settings,
			};

			window.JetEngine.ajaxGetListing( args, function( response ) {
				let $container = $this.children('.elementor-widget-container' ),
				    $result = '';
				$result = $( response.data.html );
				if ( ! $result ) {
					return;
				}
				$container.html( $result );
				window.JetEngine.widgetListingGrid( $this );
				window.JetEngine.initElementsHandlers( $container );
			} );

		} );

	}

	function clearStores( stores ) {

		if ( ! stores?.length ) {
			return;
		}

		stores.forEach( function( slug ) {

			const completeSlug = 'jet_engine_store_' + slug;

			if ( window.localStorage.getItem( completeSlug ) ) {
				window.localStorage.removeItem( completeSlug );
			}

			$( '.jet-add-to-store[data-store="' + slug + '"]' ).each( function() {
				JetEngine.switchDataStoreStatus( $( this ), true );
			} );

			$( '.jet-data-store-link.jet-remove-from-store[data-store="' + slug + '"]' ).each( function() {
				JetEngine.switchDataStoreStatus( $( this ), true );
			} );

			$( 'span.jet-engine-data-store-count[data-store="' + slug + '"]' ).text( '0' );

		} );

	}

}( jQuery ) );
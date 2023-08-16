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

	}

	function clearStores( stores ) {

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
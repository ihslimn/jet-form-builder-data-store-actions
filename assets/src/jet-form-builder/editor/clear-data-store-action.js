const {
		  TextControl,
	  } = wp.components;

const {
		  addAction,
	  } = JetFBActions;

addAction( 'clear_data_store', function ClearDataStoreAction( {
											   settings,
											   label,
											   onChangeSetting,
										   } ) {

	return <>
		<TextControl
			label={ label( 'store_slug' ) }
			value={ settings.store_slug }
			onChange={ newVal => onChangeSetting( newVal, 'store_slug' ) }
		/>
		<TextControl
			label={ label( 'updated_listings' ) }
			value={ settings.updated_listings }
			onChange={ newVal => onChangeSetting( newVal, 'updated_listings' ) }
		/>
	</>;
} );

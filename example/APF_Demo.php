<?php
class APF_Demo extends AdminPageFramework {

	public function start_APF_Demo() {	// start_{extended class name} - this method gets automatically triggered at the end of the class constructor.
		
		/*
		 * ( Optional ) Register custom field types.
		 */			
		/* 1. Include the file that defines the custom field type. */
		$aFiles = array(
			dirname( APFDEMO_FILE ) . '/third-party/date-time-custom-field-types/DateCustomFieldType.php',
			dirname( APFDEMO_FILE ) . '/third-party/date-time-custom-field-types/TimeCustomFieldType.php',
			dirname( APFDEMO_FILE ) . '/third-party/date-time-custom-field-types/DateTimeCustomFieldType.php',
			dirname( APFDEMO_FILE ) . '/third-party/dial-custom-field-type/DialCustomFieldType.php',
			dirname( APFDEMO_FILE ) . '/third-party/font-custom-field-type/FontCustomFieldType.php',
			dirname( APFDEMO_FILE ) . '/third-party/sample-custom-field-type/SampleCustomFieldType.php',
			dirname( APFDEMO_FILE ) . '/third-party/revealer-custom-field-type/RevealerCustomFieldType.php',
			dirname( APFDEMO_FILE ) . '/third-party/grid-custom-field-type/GridCustomFieldType.php',
			dirname( APFDEMO_FILE ) . '/third-party/autocomplete-custom-field-type/AutocompleteCustomFieldType.php',			
		);
		foreach( $aFiles as $sFilePath )
			if ( file_exists( $sFilePath ) ) include_once( $sFilePath );
					
		/* 2. Instantiate the classes  */
		$sClassName = get_class( $this );
		new DateCustomFieldType( $sClassName );
		new TimeCustomFieldType( $sClassName );
		new DateTimeCustomFieldType( $sClassName );
		new DialCustomFieldType( $sClassName );
		new FontCustomFieldType( $sClassName );
		new SampleCustomFieldType( $sClassName );
		new RevealerCustomFieldType( $sClassName );
		new GridCustomFieldType( $sClassName );
		new AutocompleteCustomFieldType( $sClassName );

	}

	/*
	 *	( Required ) In the setUp() method, you will define how the pages and the form elements should be composed.
	 */
	public function setUp() {	// this method automatically gets triggered with the wp_loaded hook. 

		/* ( optional ) this can be set via the constructor. For available values, see https://codex.wordpress.org/Roles_and_Capabilities */
		$this->setCapability( 'read' );
		
		/* ( required ) Set the root page */
		$this->setRootMenuPageBySlug( 'edit.php?post_type=apf_posts' );	
		
		/* ( required ) Add sub-menu items (pages or links) */
		$this->addSubMenuItems(	
			/* 	Example
			  for sub-menu pages, e.g.
			  	'title'	=>	'Your Page Title',
				'page_slug'	=>	'your_page_slug',		// avoid hyphen(dash), dots, and white spaces
				'screen_icon'	=>	'edit',				// for WordPress v3.7.x or below
				'capability'	=>	'manage-options',
				'order'	=>	10,
				
			  for sub-menu links, e.g.
				'title'	=>	'Google',
				'href'	=>	'http://www.google.com',
				
			*/
			array(
				'title'	=>	__( 'Built-in Field Types', 'admin-page-framework-demo' ),
				'page_slug'	=>	'apf_builtin_field_types',
				'screen_icon'	=>	'options-general',	// one of the screen type from the below can be used.
				/*	Screen Types (for WordPress v3.7.x or below) :
					'edit', 'post', 'index', 'media', 'upload', 'link-manager', 'link', 'link-category', 
					'edit-pages', 'page', 'edit-comments', 'themes', 'plugins', 'users', 'profile', 
					'user-edit', 'tools', 'admin', 'options-general', 'ms-admin', 'generic',		 
				*/							
				'order'	=>	1,	// ( optional ) - if you don't set this, an index will be assigned internally in the added order
			),
			array(
				'title'	=>	__( 'Custom Field Types', 'admin-page-framework-demo' ),
				'page_slug'	=>	'apf_custom_field_types',
				'screen_icon'	=>	'options-general',
				'order'	=>	2,	// ( optional )
			)
		);
		
		/*
		 * ( optional ) Add in-page tabs - In Admin Page Framework, there are two kinds of tabs: page-heading tabs and in-page tabs.
		 * Page-heading tabs show the titles of sub-page items which belong to the set root page. 
		 * In-page tabs show tabs that you define to be embedded within an individual page.
		 */
		$this->addInPageTabs(
			/*
			 * In-page tabs to display built-in field types
			 * */
			'apf_builtin_field_types',	// set the target page slug so that the 'page_slug' key can be omitted from the next continuing in-page tab arrays.
			array(
				'tab_slug'	=>	'textfields',	// avoid hyphen(dash), dots, and white spaces
				'title'		=>	__( 'Text', 'admin-page-framework-demo' ),
				'order'		=>	1,		// ( optional ) - if you don't set this, an index will be assigned internally in the added order
			),		
			array(
				'tab_slug'	=>	'selectors',
				'title'		=>	__( 'Selectors', 'admin-page-framework-demo' ),
			),					
			array(
				'tab_slug'	=>	'files',
				'title'		=>	__( 'Files', 'admin-page-framework-demo' ),
			),
			array(
				'tab_slug'	=>	'checklist',
				'title'		=>	__( 'Checklist', 'admin-page-framework-demo' ),
			),					
			array(
				'tab_slug'	=>	'misc',
				'title'		=>	__( 'MISC', 'admin-page-framework-demo' ),	
			),		
			array(
				'tab_slug'	=>	'verification',
				'title'		=>	__( 'Verification', 'admin-page-framework-demo' ),	
			),
			array(
				'tab_slug'	=>	'mixed_types',
				'title'		=>	__( 'Mixed', 'admin-page-framework-demo' ),	
			),
			array(
				'tab_slug'	=>	'sections',
				'title'		=>	__( 'Sections', 'admin-page-framework-demo' ),	
			),
			array(
				'tab_slug'	=>	'callbacks',
				'title'		=>	__( 'Callbacks', 'admin-page-framework-demo' ),	
			),			
			array()
		);
		$this->addInPageTabs(	// ( optional )
			/*
			 * Page-heading tabs for custom field types
			 */
			'apf_custom_field_types',	// target page slug
			array(
				'tab_slug'	=>	'geometry',
				'title'		=>	__( 'Geometry', 'admin-page-framework-demo' ),	
			),
			array(
				'tab_slug'	=>	'date',
				'title'		=>	__( 'Date & Time', 'admin-page-framework-demo' ),	
			),
			array(
				'tab_slug'	=>	'dial',
				'title'		=>	__( 'Dials', 'admin-page-framework-demo' ),	
			),
			array(
				'tab_slug'	=>	'font',
				'title'		=>	__( 'Fonts', 'admin-page-framework-demo' ),	
			),
			array(
				'tab_slug'	=>	'sample',
				'title'		=>	__( 'Sample', 'admin-page-framework-demo' ),	
			),
			array(
				'tab_slug'	=>	'revealer',
				'title'		=>	__( 'Revealer', 'admin-page-framework-demo' ),	
			),
			array(
				'tab_slug'	=>	'grid',
				'title'		=>	__( 'Grid', 'admin-page-framework-demo' ),	
			),
			array(
				'tab_slug'	=>	'autocomplete',
				'title'		=>	__( 'Autocomplete', 'admin-page-framework-demo' ),	
			),
			array()			
		);
		
		/* ( optional ) Determine the page style */
		$this->setPageHeadingTabsVisibility( false );	// disables the page heading tabs by passing false.
		$this->setInPageTabTag( 'h2' );		// sets the tag used for in-page tabs
		
		/* 
		 * ( optional ) Enqueue styles  
		 * $this->enqueueStyle(  'stylesheet url/path' , 'page slug (optional)', 'tab slug (optional)', 'custom argument array(optional)' );
		 * */
		$sStyleHandle = $this->enqueueStyle(  dirname( APFDEMO_FILE ) . '/asset/css/code.css', 'apf_manage_options' );	// a path can be used
			
		/*
		 * ( optional )Enqueue scripts
		 * $this->enqueueScript(  'script url/path' , 'page slug (optional)', 'tab slug (optional)', 'custom argument array(optional)' );
		 */
		$this->enqueueScript(  
			plugins_url( 'asset/js/test.js' , APFDEMO_FILE ),	// source url or path
			'apf_read_me', 	// page slug
			'', 	// tab slug
			array(
				'handle_id'	=>	'my_script',	// this handle ID also is used as the object name for the translation array below.
				'translation'	=>	array( 
					'a'	=>	'hello world!',
					'style_handle_id'	=>	$sStyleHandle,	// check the enqueued style handle ID here.
				),
			)
		);
			
		/*
		 * ( optional ) Contextual help pane
		 */
		$this->addHelpTab( 
			array(
				'page_slug'					=>	'apf_builtin_field_types',	// ( mandatory )
				// 'page_tab_slug'			=>	null,	// ( optional )
				'help_tab_title'			=>	'Admin Page Framework',
				'help_tab_id'				=>	'admin_page_framework',	// ( mandatory )
				'help_tab_content'			=>	__( 'This contextual help text can be set with the <code>addHelpTab()</code> method.', 'admin-page-framework' ),
				'help_tab_sidebar_content'	=>	__( 'This is placed in the sidebar of the help pane.', 'admin-page-framework' ),
			)
		);
		
		/*
		 * ( optional ) Create a form - To create a form in Admin Page Framework, you need two kinds of components: sections and fields.
		 * A section groups fields and fields belong to a section. So a section needs to be created prior to fields.
		 * Use the addSettingSections() method to create sections and use the addSettingFields() method to create fields.
		 */
		/* Add setting sections */
		$this->addSettingSections(	
			'apf_builtin_field_types',	// the target page slug
			array(
				'section_id'		=>	'text_fields',	// avoid hyphen(dash), dots, and white spaces
				// 'page_slug'		=>	'apf_builtin_field_types',	// <-- the method remembers the last used page slug and the tab slug so they can be omitted from the second parameter.
				'tab_slug'		=>	'textfields',
				'title'			=>	__( 'Text Fields', 'admin-page-framework-demo' ),
				'description'	=>	__( 'These are text type fields.', 'admin-page-framework-demo' ),	// ( optional )
				'order'			=>	10,	// ( optional ) - if you don't set this, an index will be assigned internally in the added order
			),	
			array(
				'section_id'	=>	'selectors',
				'tab_slug'		=>	'selectors',
				'title'			=>	__( 'Selectors and Checkboxes', 'admin-page-framework-demo' ),
				'description'	=>	__( 'These are selector type options such as dropdown lists, radio buttons, and checkboxes', 'admin-page-framework-demo' ),
			),
			array(
				'section_id'	=>	'sizes',
				// 'tab_slug'		=>	'selectors',	// <-- similar to the page slug, if the tab slug is the same as the previous one, it can be omitted.
				'title'			=>	__( 'Sizes', 'admin-page-framework-demo' ),
			),			
			array(
				'section_id'	=>	'image_select',
				'tab_slug'		=>	'files',	// the target tab slug wil lbe renewed 
				'title'			=>	__( 'Image Selector', 'admin-page-framework-demo' ),
				'description'	=>	__( 'Set an image url with jQuwey based image selector.', 'admin-page-framework-demo' ),
			),
			array(
				'section_id'	=>	'color_picker',
				'tab_slug'		=>	'misc',
				'title'			=>	__( 'Colors', 'admin-page-framework-demo' ),
			),
			array(
				'section_id'	=>	'media_upload',
				'tab_slug'		=>	'files',
				'title'			=>	__( 'Media Uploader', 'admin-page-framework-demo' ),
				'description'	=>	__( 'Upload binary files in addition to images.', 'admin-page-framework-demo' ),
			),
			array(
				'section_id'	=>	'checklists',
				'tab_slug'		=>	'checklist',
				'title'			=>	__( 'Checklists', 'admin-page-framework-demo' ),
				'description'	=>	__( 'Post type and taxonomy checklists ( custom checkbox ).', 'admin-page-framework-demo' ),
			),	
			array(
				'section_id'	=>	'hidden_field',
				'tab_slug'		=>	'misc',
				'title'			=>	__( 'Hidden Fields', 'admin-page-framework-demo' ),
				'description'	=>	__( 'These are hidden fields.', 'admin-page-framework-demo' ),
			),			
			array(
				'section_id'	=>	'file_uploads',
				'tab_slug'		=>	'files',
				'title'			=>	__( 'File Uploads', 'admin-page-framework-demo' ),
				'description'	=>	__( 'These are upload fields. Check the <code>$_FILES</code> variable in the validation callback method that indicates the temporary location of the uploaded files.', 'admin-page-framework-demo' ),
			),			
			array(
				'section_id'	=>	'submit_buttons',
				'tab_slug'		=>	'misc',
				'title'			=>	__( 'Submit Buttons', 'admin-page-framework-demo' ),
				'description'	=>	__( 'These are custom submit buttons.', 'admin-page-framework-demo' ),
			),			
			array(
				'section_id'	=>	'verification',
				'tab_slug'		=>	'verification',
				'title'			=>	__( 'Verify Submitted Data', 'admin-page-framework-demo' ),
				'description'	=>	__( 'Show error messages when the user submits improper option value.', 'admin-page-framework-demo' ),
			),
			array(
				'section_id'	=>	'mixed_types',
				'tab_slug'		=>	'mixed_types',
				'title'			=>	__( 'Mixed Field Types', 'admin-page-framework-demo' ),
				'description'	=>	__( 'As of v3, it is possible to mix field types in one field on a per-ID basis.', 'admin-page-framework-demo' ),
			),
			array(
				'section_id'	=>	'section_title_field_type',
				'tab_slug'		=>	'sections',
				'title'			=>	__( 'Section Title', 'admin-page-framework-demo' ),
				'description'	=>	__( 'The <code>section_title</code> field type will be placed in the position of the section title if set. If not set, the set section title will be placed. Only one <code>section_title</code> field is allowed per section.', 'admin-page-framework-demo' ),
			),			
			array(
				'section_id'	=>	'repeatable_sections',
				'tab_slug'		=>	'sections',
				'title'			=>	__( 'Repeatable Sections', 'admin-page-framework-demo' ),
				'description'	=>	__( 'As of v3, it is possible to repeat sections.', 'admin-page-framework-demo' ),
				'repeatable'	=>	true,	// this makes the section repeatable
			),
			array(
				'section_id'	=>	'tabbed_sections_a',
				'section_tab_slug'	=>	'tabbed_sections',
				'title'			=>	__( 'Section Tab A', 'admin-page-framework-demo' ),
				'description'	=>	__( 'This is the first item of the tabbed section.', 'admin-page-framework-demo' ),
			),
			array(
				'section_id'	=>	'tabbed_sections_b',
				'title'			=>	__( 'Section Tab B', 'admin-page-framework-demo' ),
				'description'	=>	__( 'This is the second item of the tabbed section.', 'admin-page-framework-demo' ),
			),		
			array(
				'section_id'	=>	'repeatable_tabbed_sections',
				'tab_slug'		=>	'sections',
				'section_tab_slug'	=>	'repeatable_tabbes_sections',
				'title'			=>	__( 'Repeatable', 'admin-page-framework-demo' ),
				'description'	=>	__( 'It is possible to tab repeatable sections.', 'admin-page-framework-demo' ),
				'repeatable'	=>	true,	// this makes the section repeatable
			),			
			array(
				'section_tab_slug'	=>	'',	// reset the target section tab slug for the next call.
				
			),
			array(
				'section_id'	=>	'callbacks',
				'tab_slug'		=>	'callbacks',
				'title'			=>	__( 'Using Callbacks', 'admin-page-framework-demo' ),
				'description'	=>	__( 'These fields are (re)defined with callbacks.', 'admin-page-framework-demo' )
					. ' ' . __( 'This is useful when you need to pass dynamic data to a field definition array that should only be performed in the page that displays the field.', 'admin-page-framework-demo' )
					. ' ' . __( 'By default, the <code>setUp()</code> method is triggered in all admin pages. So if you do a heavy task during the method, it affects the page load of other pages. This solves such problems.', 'admin-page-framework-demo' ),
			),	
			array()
		);
		$this->addSettingSections(	
			array(
				'section_id'	=>	'geometry',
				'page_slug'		=>	'apf_custom_field_types',	// renew the target page slug
				'tab_slug'		=>	'geometry',	
				'title'			=>	__( 'Geometry Custom Field Type', 'admin-page-framework-demo' ),
				'description'	=>	__( 'This is a custom field type defined externally.', 'admin-page-framework-demo' ),
			),	
			array(
				'section_id'	=>	'date_pickers',
				'tab_slug'		=>	'date',
				'title'			=>	__( 'Date Custom Field Type', 'admin-page-framework' ),
				'description'	=>	__( 'These are date and time pickers.', 'admin-page-framework-demo' ),
			),
			array(
				'section_id'	=>	'dial',
				'tab_slug'		=>	'dial',
				'title'			=>	__( 'Dial Custom Field Type', 'admin-page-framework-demo' ),
			),
			array(
				'section_id'	=>	'font',
				'tab_slug'		=>	'font',
				'title'			=>	__( 'Font Custom Field Type', 'admin-page-framework-demo' ),
				'description'	=>	__( 'This is still experimental.', 'admin-page-framework-demo' ),				
			),
			array(
				'section_id'	=>	'sample',
				'tab_slug'		=>	'sample',
				'title'			=>	__( 'Sample Custom Field Type', 'admin-page-framework-demo' ),
				'description'	=>	__( 'This is just an example of creating a custom field type with Admin Page Framework.', 'admin-page-framework-demo' ),				
			),			
			array(
				'section_id'	=>	'revealer',
				'tab_slug'		=>	'revealer',
				'title'			=>	__( 'Revealer Custom Field Type', 'admin-page-framework-demo' ),
				'description'	=>	__( 'When the user selects an item from the selector, it reveals one of the predefined fields.', 'admin-page-framework-demo' ),				
			),	
			array(
				'section_id'	=>	'grid',
				'tab_slug'		=>	'grid',
				'title'			=>	__( 'Grid Custom Field Type', 'admin-page-framework-demo' ),
				'description'	=>	__( 'This field will save the grid positions of the widgets.', 'admin-page-framework-demo' ),				
			),
			array(
				'section_id'	=>	'autocomplete',
				'tab_slug'		=>	'autocomplete',
				'title'			=>	__( 'Autocomplete Custom Field Type', 'admin-page-framework-demo' ),
				'description'	=>	__( 'This field will show predefined list when the user type something on the input field.', 'admin-page-framework-demo' ),				
			),				
			array()
		);

		/* Add setting fields */
		/*
		 * Text input - text, password, number, textarea, rich text editor
		 */
		$this->addSettingFields(
			'text_fields',
			array(	// Single text field
				'field_id'	=>	'text',
				// 'section_id'	=>	'text_fields',	// can be omitted as it is set previously
				'title'	=>	__( 'Text', 'admin-page-framework-demo' ),
				'description'	=>	__( 'Type something here. This text is inserted with the <code>description</code> key in the field definition array.', 'admin-page-framework-demo' ),
				'help'	=>	__( 'This is a text field and typed text will be saved. This text is inserted with the <code>help</code> key in the field definition array.', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'order'	=>	1,	// ( optional )
				'default'	=>	123456,
				'attributes'	=>	array(
					'size'	=>	40,
				),
			),	
			array(	// Password Field
				'field_id'	=>	'password',
				'title'	=>	__( 'Password', 'admin-page-framework-demo' ),
				'tip'	=>	__( 'This input will be masked.', 'admin-page-framework-demo' ),
				'type'	=>	'password',
				'help'	=>	__( 'This is a password type field; the user\'s entered input will be masked.', 'admin-page-framework-demo' ),	//'
				'attributes'	=>	array(
					'size'	=>	20,
				),
				'description'	=>	__( 'The entered characters will be masked.', 'admin-page-framework-demo' ),
			),		
			array(	// Read-only
				'field_id'	=>	'read_only_text',
				'title'	=>	__( 'Read Only', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'attributes'	=>	array(
					'size'	=>	20,
					'readonly'	=>	'ReadOnly',
					// 'disabled'	=>	'Disabled',		// disabled can be specified like so
				),
				'value'	=>	__( 'This is a read-only value.', 'admin-page-framework-demo' ),
				'description'	=>	__( 'The attribute can be set with the <code>attributes</code> key.', 'admin-page-framework-demo' ),
			),			
			array(	// Number Field
				'field_id'	=>	'number',
				'title'	=>	__( 'Number', 'admin-page-framework-demo' ),
				'type'	=>	'number',
			),					
			array(	// Multiple text fields
				'field_id'	=>	'text_multiple',
				'title'	=>	__( 'Multiple Text Fields', 'admin-page-framework-demo' ),
				'help'	=>	__( 'Multiple text fields can be passed by setting an array to the label key.', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'default'	=>	'Hello World',
				'label'	=>	'First Item: ',
				'attributes'	=>	array(
					'size'	=>	20,				
				),
				'delimiter'	=>	'<br />',
				array(
					'default'	=>	'Foo bar',
					'label'	=>	'Second Item: ',
					'attributes'	=>	array(
						'size'	=>	40,
					)
				),
				array(
					'default'	=>	'Yes, we can',
					'label'	=>	'Third Item: ',
					'attributes'	=>	array(
						'size'	=>	60,
					)
				),				
				'description'	=>	__( 'These are multiple text fields. To include multiple input fields associated with one field ID, use the numeric keys in the field definition array.', 'admin-page-framework-demo' ),
			),		
			array(	// Repeatable text fields
				'field_id'	=>	'text_repeatable',
				'title'	=>	__( 'Repeatable Text Fields', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'default'	=>	'a',
				'repeatable'	=>	array(
					'max'	=>	10,
					'min'	=>	3,
				),
				'description'	=>	__( 'Press + / - to add / remove the fields. To enable the repeatable fields functionality, set the <code>repeatable</code> key to true.', 'admin-page-framework-demo' )
					. __( 'To set maximum and minimum numbers of fields, set the <code>max</code> and <code>min</code> keys in the repeatable field setting array.' ),
			),		
			array(	// Sortable text fields
				'field_id'	=>	'text_sortable',
				'title'	=>	__( 'Sortable Text Fields', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'default'	=>	'a',
				'label'	=>	__( 'Sortable Item', 'admin-page-framework-demo' ),
				'sortable'	=>	true,
				'description'	=>	__( 'Drag and drop the fields to change the order.', 'admin-page-framework-demo' ),
				array(
					'default'	=>	'b',
				),
				array(
					'default'	=>	'c',
				),				
				array(
					'label'	=>	__( 'Disabled Item', 'admin-page-framework-demo' ),
					'default'	=>	'd',
					'attributes'	=>	array(
						'disabled'	=> 'Disabled',
					),
				),								
				'delimiter'	=> '<br />',
			),	
			array(	// Sortable + Repeatable text fields
				'field_id'	=>	'text_repeatable_and_sortable',
				'title'	=>	__( 'Repeatable & Sortable', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'repeatable'	=>	true,
				'sortable'	=>	true,
			),				
			array(	// Text Area
				'field_id'	=>	'textarea',
				'title'	=>	__( 'Single Text Area', 'admin-page-framework-demo' ),
				'description'	=>	__( 'Type a text string here.', 'admin-page-framework-demo' ),
				'type'	=>	'textarea',
				'default'	=>	__( 'Hello World! This is set as the default string.', 'admin-page-framework-demo' ),
				'attributes'	=>	array(
					'rows'	=>	6,
					'cols'	=>	60,
				),
			),
			array(	// Repeatable Text Areas
				'field_id'	=>	'textarea_repeatable',
				'title'	=>	__( 'Repeatable Text Areas', 'admin-page-framework-demo' ),
				'type'	=>	'textarea',
				'repeatable'	=>	array(
					'max'	=>	20,
					'min'	=>	2,
				),
				'attributes'	=>	array(
					'rows'	=>	3,
					'cols'	=>	60,
				),
				'description'	=>	__( 'Currently the repeatable field functionality is not supported for the rich text editor.', 'admin-page-framework-demo' ),
			),			
			array(	// Sortable Text Areas
				'field_id'	=>	'textarea_sortable',
				'title'	=>	__( 'Sortable', 'admin-page-framework-demo' ),
				'type'	=>	'textarea',
				'sortable'	=>	true,
				'label'	=>	__( 'Sortable Item', 'admin-page-framework-demo' ),
				array(),	// the second item
				array(),	// the third item
			),				
			array(	// Rich Text Editors
				'field_id'	=>	'rich_textarea',
				'title'	=>	__( 'Rich Text Area', 'admin-page-framework-demo' ),
				'type'	=>	'textarea',
				'rich'	=>	true,	// just pass non empty value to enable the rich editor.
				'attributes'	=>	array(
					'field'	=>	array(
						'style'	=>	'width: 100%;'	// since the rich editor does not accept the cols attribute, set the width by inline-style.
					),
				),
				array(
					// pass the setting array to customize the editor. For the setting argument, see http://codex.wordpress.org/Function_Reference/wp_editor.
					'rich'	=>	array( 
						'media_buttons'	=>	false, 
						'tinymce'	=>	false
					),	
				),
			),			
			array(	// Multiple text areas
				'field_id'	=>	'textarea_multiple',
				'title'	=>	__( 'Multiple Text Areas', 'admin-page-framework-demo' ),
				'description'	=>	__( 'These are multiple text areas.', 'admin-page-framework-demo' ),
				'type'	=>	'textarea',
				'label'	=>	__( 'First Text Area: ', 'admin-page-framework-demo' ),
				'default'	=>	__( 'The first default text.', 'admin-page-framework-demo' ),
				'delimiter'	=>	'<br />',
				'attributes'	=>	array(
					'rows'	=>	5,
					'cols'	=>	60,
				),
				array(
					'label'	=>	__( 'Second Text Area: ', 'admin-page-framework-demo' ),
					'default'	=>	__( 'The second default text. See the background color is different from the others. This is done with the attributes key.', 'admin-page-framework-demo' ),
					'attributes'	=>	array(
						'rows'	=>	3,
						'cols'	=>	40,
						'style'	=>	'background-color: #F0F8FA;'	// this changes the style of the textarea tag.
					),					
				),
				array(
					'label'	=>	__( 'Third Text Area: ', 'admin-page-framework-demo' ),
					'default'	=>	__( 'The third default text.', 'admin-page-framework-demo' ),
					'attributes'	=>	array(
						'rows'	=>	2,
						'cols'	=>	20,
					),									
				),	
			)
		);
		
		/*
		 * Selectors - dropdown (pulldown) list, checkbox, radio buttons, size selector
		 */
		$this->addSettingFields(
			array(	// Single Drop-down List
				'field_id'	=>	'select',
				'section_id'	=>	'selectors',	// reset the target section ID 
				'title'	=>	__( 'Dropdown List', 'admin-page-framework-demo' ),
				'type'	=>	'select',
				'help'	=>	__( 'This is the <em>select</em> field type.', 'admin-page-framework-demo' ),
				'default'	=>	2,	// the index key of the label array below which yields 'Yellow'.
				'label'	=>	array( 
					0	=>	'Red',		
					1	=>	'Blue',
					2	=>	'Yellow',
					3	=>	'Orange',
				),
				'description'	=>	__( 'The key of the array of the <code>label</code> element serves as the value of the option tag which will be sent to the form and saved in the database.', 'admin-page-framework-demo' )
					. ' ' . __( 'So when you specify the default value with the <code>default</code> or <code>value</code> element, specify the KEY.', 'admin-page-framework-demo' ),
			),	
			array(	// Single Drop-down List with Multiple Options
				'field_id'	=>	'select_multiple_options',
				// 'section_id'	=>	'selectors',	// <-- this can be omitted since it is set in the previous field array
				'title'	=>	__( 'Dropdown List with Multiple Options', 'admin-page-framework-demo' ),
				'help'	=>	__( 'This is the <em>select</em> field type with multiple elements.', 'admin-page-framework' ),
				'type'	=>	'select',
				'is_multiple'	=>	true,
				'default'	=>	3,	// note that PHP array indices are zero-base, meaning the index count starts from 0 (not 1). 3 here means the fourth item of the array..
				'size'	=>	10,	
				'label'	=>	array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'November', 'October', 'December' ),
				'description'	=>	__( 'Use <code>is_multiple</code> key to enable multiple selections.' ),
			),	
			array(	// Single Drop-down List with Multiple Options
				'field_id'	=>	'select_multiple_groups',
				'title'	=>	__( 'Dropdown List with Groups', 'admin-page-framework-demo' ),
				'type'	=>	'select',
				'default'	=>	'b',
				'label'	=>	array( 	
					'alphabets'	=>	array( 	// each key must be unique throughout this 'label' element array.
						'a'	=>	'a', 	
						'b'	=>	'b', 
						'c'	=>	'c',
					),
					'numbers'	=>	array( 
						0	=>	'0',
						1	=>	'1',
						2	=>	'2', 
					),
				),
				'attributes'	=>	array(	// the 'attributes' element of the select field type has three keys: select, 'option', and 'optgroup'.
					'select'	=>	array(
						'style'	=>	"width: 200px;",
					),
					'option'	=>	array(
						1		=>	array(
							'disabled'	=>	'Disabled',
							'style'		=>	'background-color: #ECECEC; color: #888;',
						),
					),
					'optgroup'	=>	array(
						'style'	=>	'background-color: #DDD',
					)
				),
				'description'	=>	__( 'To create grouped options, pass arrays with the key of the group label and pass the options as an array inside them.', 'admin-page-framework-demo' )
					. ' ' . __( 'To style the pulldown(dropdown) list, use the <code>attributes</code> key. For the <code>select</code> field type, it has three major keys, <code>select</code>, <code>option</code>, and <code>optgroup</code>, representing the tag names.', 'admin-page-framework-demo' ),

			),				
			array(	// Drop-down Lists with Mixed Types
				'field_id'	=>	'select_multiple_fields',
				'title'	=>	__( 'Multiple Dropdown Lists Fields', 'admin-page-framework-demo' ),
				'description'	=>	__( 'These are multiple sets of drop down list.', 'admin-page-framework-demo' ),
				'type'	=>	'select',
				'label'	=>	array( 'dark', 'light' ),
				'default'	=>	1,
				'attributes'	=>	array(	
					'select'	=>	array(
						'size'	=>	1,
					),
					'field'	=>	array(
						'style'	=>	'display: inline; clear: none',	// this makes the field element inline, which means next fields continues from the right end of the field, not from the new line.
					),
				),
				array(
					'label'	=>	array( 'river', 'mountain', 'sky', ),
					'default'	=>	2,
				),
				array(
					'label'	=>	array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ),
					'default'	=>	array( 3, 4 ),		// 'default'	=> '', will select none
					'attributes'	=>	array(
						'select'	=>	array(
							'size'	=>	5,
							'multiple'	=>	'multiple',	// instead of 'is_multiple'	=>	true, it is possible by setting it by the attribute key.
						),
					)					
				),
			),					
			array(	// Repeatable Drop-down List
				'field_id'	=>	'select_repeatable',
				'title'	=>	__( 'Repeatable Dropdown List', 'admin-page-framework-demo' ),
				'type'	=>	'select',
				'repeatable'	=>	true,
				'description'	=>	__( 'To enable repeatable fields, set the <code>repeatable</code> key to true.', 'admin-page-framework-demo' ),
				'default'	=>	'y',
				'label'	=>	array( 
					'x'	=>	'X',
					'y'	=>	'Y',		
					'z'	=>	'Z',		
				),
			),		
			array(	// Sortable Drop-down List
				'field_id'	=>	'select_sortable',
				'title'	=>	__( 'Sortable', 'admin-page-framework-demo' ),
				'type'	=>	'select',
				'sortable'	=>	true,
				'default'	=>	'iii',
				'before_label'	=> 
					"<span style='vertical-align:baseline; min-width: 140px; display:inline-block; margin-top: 0.5em; padding-bottom: 0.2em;'>" 
						. __( 'Sortable Item', 'admin-page-framework-demo' ) 
					. "</span>",
				'label'	=>	array( 
					'i'	=>	'I',
					'ii'	=>	'II',	
					'iii'	=>	'III',		
					'iiv'	=>	'IIV',		
				),
				array(),	// the second item	
				array(),	// the third item
				array(),	// the forth item
			),					
			array(	// Single set of radio buttons
				'field_id'	=>	'radio',
				'title'	=>	__( 'Radio Button', 'admin-page-framework-demo' ),
				'type'	=>	'radio',
				'label'	=>	array( 'a'	=>	'Apple', 'b'	=>	'Banana ( this option is disabled. )', 'c'	=>	'Cherry' ),
				'default'	=>	'c',	// yields Cherry; its key is specified.
				'after_label'	=>	'<br />',
				'attributes'	=>	array(
					'b'	=>	array(
						'disabled'	=>	'Disabled',
					),
				),
				'description'	=>	__( 'Use the <code>after_input</code> key to insert <code>&lt;br /&gt;</code> after each sub-field.', 'admin-page-framework-demo' )
					. ' ' . __( 'To disable elements(or apply different attributes) on an individual element basis, use the <code>attributes</code> key and create the element whose key name is the radio input element value.', 'admin-page-framework-demo' ),
				
			),
			array(	// Multiple sets of radio buttons
				'field_id'	=>	'radio_multiple',
				'title'	=>	__( 'Multiple Sets of Radio Buttons', 'admin-page-framework-demo' ),
				'description'	=>	__( 'Multiple sets of radio buttons. The horizontal line is set with the <code>delimiter</code> key.', 'admin-page-framework-demo' ),
				'type'	=>	'radio',
				'delimiter'	=>	'<hr />',
				'default'	=>	2,
				'label'	=>	array( 1 =>	'one', 2 =>	'two' ),
				'attributes'	=> array(
					'field'	=>	array(
						'style'	=>	'width: 100%;',
					),
				),
				array(
					'default'	=>	4,
					'label'	=>	array( 3 =>	'three', 4 =>	'four', 5 =>	'five' ),
				),
				array(
					'default'	=>	8,
					'label'	=>	array( 6 =>	'six', 7 =>	'seven', 8 =>	'eight', 9 =>	'nine' ),
				),
			),	
			array(	// Repeatable radio buttons
				'field_id'	=>	'radio_repeatable',
				'title'	=>	__( 'Repeatable Radio Buttons', 'admin-page-framework-demo' ),
				'type'	=>	'radio',
				'label'	=>	array( 1 =>	'On', 0 =>	'Off' ),
				'default'	=>	1,	// set the key of the label array
				'repeatable'	=>	true,
			),	
			array(	// Sortable radio buttons
				'field_id'	=>	'radio_sortable',
				'title'	=>	__( 'Sortable', 'admin-page-framework-demo' ),
				'type'	=>	'radio',
				'label'	=>	array( 1 =>	'On', 0 =>	'Off' ),
				'default'	=>	1,	// set the key of the label array
				'sortable'	=>	true,
				array(),	// the second item
				array(),	// the third item
				array(),	// the fourth item
			),			
			array(	// Single checkbox item - set a check box item to the 'label' element.
				'field_id'	=>	'checkbox',
				'title'	=>	__( 'Single Checkbox', 'admin-page-framework-demo' ),
				'tip'	=>	__( 'The description key can be omitted though.', 'admin-page-framework-demo' ),
				'description'	=>	__( 'Check box\'s label can be a string, not an array.', 'admin-page-framework-demo' ),	//' syntax fixer
				'type'	=>	'checkbox',
				'label'	=>	__( 'Check me.', 'admin-page-framework-demo' ),
				'default'	=>	false,
			),	
			array(	// Multiple checkbox items - for multiple checkbox items, set an array to the 'label' element.
				'field_id'	=>	'checkbox_multiple_items',
				'title'	=>	__( 'Multiple Checkbox Items', 'admin-page-framework-demo' ),
				'type'	=>	'checkbox',
				'label'	=>	array( 
					'moon'	=>	__( 'Moon', 'admin-page-framework-demo' ),
					'earth'	=>	__( 'Earth (this option is disabled.)', 'admin-page-framework-demo' ),
					'sun'	=>	__( 'Sun', 'admin-page-framework-demo' ),
					'mars'	=>	__( 'Mars', 'admin-page-framework-demo' ),
				),
				'default'	=>	array( 
					'moon'	=>	true, 
					'earth'	=>	false, 
					'sun'	=>	true, 
					'mars'	=>	false,
				),
				'attributes'	=>	array(
					'earth'	=>	array(
						'disabled'	=>	'Disabled',
					),
				),
				'description'	=>	__( 'It is possible to disable checkbox items on an individual basis.', 'admin-page-framework-demo' ),
				'after_label'	=>	'<br />',
			),
			array(	// Multiple sets of checkbox fields
				'field_id'	=>	'checkbox_multiple_fields',
				'title'	=>	__( 'Multiple Sets of Checkboxes', 'admin-page-framework-demo' ),
				'type'	=>	'checkbox',
				'label'	=>	array( 'a'	=>	'A', 'b'	=>	'B', 'c'	=>	'C' ),
				'default'	=>	array( 'a'	=>	false, 'b'	=>	true, 'c'	=>	false ),
				'delimiter'	=>	'<hr />',
				'attributes'	=> array(
					'field'	=>	array(
						'style'	=>	'width: 100%;',
					),
				),				
				array(
					'label'	=>	array( 'd'	=>	'D', 'e'	=>	'E', 'f'	=>	'F' ),
					'default'	=>	array( 'd'	=>	true, 'e'	=>	false, 'f'	=>	false ),
				),
				array(
					'label'	=>	array( 'g'	=>	'G', 'h'	=>	'H', 'i'	=>	'I' ),
					'default'	=>	array( 'g'	=>	false, 'h'	=>	false, 'i'	=>	true ),
				),				
				'description'	=>	__( 'To create multiple fields for one field ID, use the numeric keys in the field definition array.', 'admin-page-framework-demo' ),
			),
			array(	// Repeatable check boxes
				'field_id'	=>	'checkbox_repeatable_fields',
				'title'	=>	__( 'Repeatable Checkboxes', 'admin-page-framework-demo' ),
				'type'	=>	'checkbox',
				'label'	=>	array( 'x', 'y', 'z' ),
				'repeatable'	=>	true,
			),
			array(	// sortable check boxes
				'field_id'	=>	'checkbox_sortable_fields',
				'title'	=>	__( 'Sortable', 'admin-page-framework-demo' ),
				'type'	=>	'checkbox',
				'label'	=>	array( 'x', 'y', 'z' ),
				'sortable'	=>	true,
				array(),	// the second item
				array(),	// the third item
				array(),	// the fourth item
			),			
			array(	// Size
				'field_id'		=>	'size_field',
				'section_id'	=>	'sizes',	// changes the target section ID
				'title'			=>	__( 'Size', 'admin-page-framework-demo' ),
				'help'			=>	$sDescription = __( 'In order to set a default value for the size field type, an array with the \'size\' and the \'unit\' keys needs to be passed.', 'admin-page-framework-demo' ),
				'description'	=>	__( 'The default units are the lengths for CSS.', 'admin-page-framework-demo' ) 
					. ' ' . $sDescription,
				'type'			=>	'size',
				'default'		=>	array( 
					'size'	=>	5, 
					'unit'	=>	'%' 
				),
			),		
			array(	// Size with custom units
				'field_id'		=>	'size_custom_unit_field',
				'title'			=>	__( 'Size with Custom Units', 'admin-page-framework-demo' ),
				'help'			=>	$sDescription = __( 'The units can be specified so it can be quantity, length, or capacity etc.', 'admin-page-framework-demo' ),
				'description'	=>	$sDescription,
				'type'			=>	'size',
				'units'	=>	array(
					'grain'	=>	__( 'grains', 'admin-page-framework-demo' ),
					'dram'	=>	__( 'drams', 'admin-page-framework-demo' ),
					'ounce'	=>	__( 'ounces', 'admin-page-framework-demo' ),
					'pounds'	=>	__( 'pounds', 'admin-page-framework-demo' ),
				),
				'default'		=>	array( 
					'size'	=>	200,
					'unit'	=>	'ounce' 
				),
			),	
			array(	// Size with custom attributes
				'field_id'		=>	'size_field_custom_attributes',
				'title'			=>	__( 'Size with Custom Attributes', 'admin-page-framework-demo' ),
				'type'			=>	'size',
				'units'	=>	array(	// Pass the group label as the key of an option array.
					__( 'Metric Unit System', 'admin-page-framework' )	=>	array( 	// each key must be unique throughout this 'label' element array.
						'mm'	=>	'mm (' . __( 'millimetre', 'admin-page-framework' ) . ')', 
						'cm'	=>	'cm (' . __( 'centmeter', 'admin-page-framework' ) . ')', 
						'm'	=>	'm (' . __( 'meter', 'admin-page-framework' ) . ')', 
						'km'	=>	'km (' . __( 'kilometer', 'admin-page-framework' ) . ')', 
					),
					__( 'Imperial and US Unit System', 'admin-page-framework' )	=>	array( 
						'in'	=>	'in (' . __( 'inch', 'admin-page-framework' ) . ')', 
						'ft'	=>	'ft (' . __( 'foot', 'admin-page-framework' ) . ')', 
						'yd'	=>	'yd (' . __( 'yard', 'admin-page-framework' ) . ')', 
						'ml'	=>	'ml (' . __( 'mile', 'admin-page-framework' ) . ')', 
					),			
					__( 'Astronomical Units', 'admin-page-framework' )	=>	array( 
						'au'	=>	'au (' . __( 'astronomical unit', 'admin-page-framework' ) . ')', 
						'ly'	=>	'ly (' . __( 'light year', 'admin-page-framework' ) . ')', 
						'pc'	=>	'pc (' . __( 'parsec', 'admin-page-framework' ) . ')', 
					),			
				),
				'default'		=>	array( 
					'size'	=>	15.2, 
					'unit'	=>	'ft' 
				),
				'attributes'	=> array(	// the size field type has four initial keys: size, option, optgroup.
					'size'	=>	array(
						'style'	=>	'background-color: #FAF0F0;',
						'step'	=>	0.1,
					),
					'unit'	=>	array(
						'style'	=>	'background-color: #F0FAF4',
					),
					'option'	=>	array(
						'cm'	=>	array(	// applies only to the 'cm' element of the option elements
							'disabled'	=>	'Disabled',
							'class'	=>	'disabled',
						),
						'style'	=>	'background-color: #F7EFFF',	// applies to all the option elements
					),
					'optgroup'	=> array(
						'style'	=>	'background-color: #EFEFEF',
						__( 'Astronomical Units', 'admin-page-framework' )	=> array(
							'disabled' => 'Disabled',
						),
					),
				),
				'description'	=>	__( 'The <code>size</code> field type has four initial keys in the <code>attributes</code> array element: <code>size</code>, <code>unit</code>, <code>optgroup</code>, and <code>option</code>.', 'admin-page-framework-demo' ),
			),
			array(	// Multiple Size Fields
				'field_id'	=>	'sizes_field',
				'title'	=>	__( 'Multiple Sizes', 'admin-page-framework-demo' ),
				'type'	=>	'size',
				'label'	=>	__( 'Weight', 'admin-page-framework-demo' ),
				'units'	=>	array( 'mg'=>'mg', 'g'=>'g', 'kg'=>'kg' ),
				'default'	=>	array( 'size'	=>	15, 'unit'	=>	'g' ),
				'delimiter'	=>	'<hr />',
				array(
					'label'	=>	__( 'Length', 'admin-page-framework-demo' ),
					'units'	=> array( 'cm'=>'cm', 'mm'=>'mm', 'm'=>'m' ),
					'default'	=>	array( 'size'	=>	100, 'unit'	=>	'mm' ),
				),
				array(
					'label'	=>	__( 'File Size', 'admin-page-framework-demo' ),
					'units'	=>	array( 'b'=>'b', 'kb'=>'kb', 'mb'=>'mb', 'gb'	=>	'gb', 'tb'	=>	'tb' ),
					'default'	=>	array( 'size'	=>	30, 'unit'	=>	'mb' ),
				),				
			),
			array(	// Repeatable Size Fields
				'field_id'		=>	'size_repeatable_fields',
				'title'			=>	__( 'Repeatable Size Fields', 'admin-page-framework-demo' ),
				'type'			=>	'size',
				'repeatable'	=>	true,
			),
			array(	// Sortable Size Fields
				'field_id'		=>	'size_sortable_fields',
				'title'			=>	__( 'Sortable', 'admin-page-framework-demo' ),
				'type'			=>	'size',
				'sortable'	=>	true,
				array(),	// the second item
				array(),	// the third item
				array(),	// the fourth item
			)			
		);
		
		/*
		 * Files - media, image, and uploader
		 */
		$this->addSettingFields(			
			array( // Image Selector
				'field_id'	=>	'image_select_field',
				'section_id'	=>	'image_select',
				'title'	=>	__( 'Select an Image', 'admin-page-framework-demo' ),
				'type'	=>	'image',
				'label'	=>	__( 'First Image', 'admin-page-framework-demo' ),
				// 'default'	=>	admin_url( 'images/wordpress-logo.png' ), 
				'default'	=>	 plugins_url( 'asset/image/wordpress-logo-2x.png' , APFDEMO_FILE ),
				'allow_external_source'	=>	false,
				'attributes'	=> array(
					'preview'	=> array(
						'style'	=> 'max-width:400px;'	// determines the size of the preview image.	// margin-left: auto; margin-right: auto; will make the image in the center.
					),
				),
				array(
					'label'	=>	__( 'Second Image', 'admin-page-framework-demo' ),
					'default'	=> '',
					'allow_external_source'	=>	true,
					'attributes'	=> array(
						'input'		=> array(
							'style'	=> 'background-color: #F5FFDF',
						),
						'button'	=> array(
							'style'	=> 'background-color: #E1FCD2',
						),
					),					
				),
				array(
					'label'	=>	__( 'Third Image', 'admin-page-framework-demo' ),
					'default'	=> '',
				),		
				'description'	=>	__( 'See the button and the input colors of the second item are different. This is done by setting the attributes individually.', 'admin-page-framework-demo' ),
			),		
			array( // Image selector with additional capturing attributes
				'field_id'	=>	'image_with_attributes',
				'section_id'	=>	'image_select',
				'title'	=>	__( 'Save Image Attributes', 'admin-page-framework-demo' ),
				'type'	=>	'image',
				'attributes_to_store'	=>	array( 'alt', 'id', 'title', 'caption', 'width', 'height', 'align', 'link' ),	// some attributes cannot be captured with external URLs and the old media uploader.
			),					
			array(	// Repeatable Image Fields
				'field_id'	=>	'image_select_field_repeater',
				'title'	=>	__( 'Repeatable Image Fields', 'admin-page-framework-demo' ),
				'type'	=>	'image',
				'repeatable'	=>	true,
				'attributes'	=> array(
					'preview'	=> array(
						'style'	=> 'max-width: 300px;'
					),
				),	
				'description'	=> __( 'In repeatable fields, you can select multiple items at once.', 'admin-page-framework-demo' ),
			),
			array(	// Sortable Image Fields
				'field_id'	=>	'image_select_field_sortable',
				'title'	=>	__( 'Sortable Image Fields', 'admin-page-framework-demo' ),
				'type'	=>	'image',
				'sortable'	=>	true,
				'attributes'	=> array(
					'preview'	=> array(
						'style'	=> 'max-width: 200px;'
					),
				),	
				array(),	// the second item
				array(),	// the third item
				'description'	=> __( 'Image fields can be sortable. This may be useful when you need to let the user set an order of images.', 'admin-page-framework-demo' ),
			),			
			array(	// Repeatable & Sortable Image Fields
				'field_id'	=>	'image_select_field_repeatable_and_sortable',
				'title'	=>	__( 'Repeatable & Sortable Images', 'admin-page-framework-demo' ),
				'type'	=>	'image',
				'repeatable'	=>	true,
				'sortable'	=>	true,
				'attributes'	=> array(
					'preview'	=> array(
						'style'	=> 'max-width: 200px;'
					),
				),	
			),					
			array( // Media File
				'field_id'	=>	'media_field',
				'section_id'	=>	'media_upload',
				'title'	=>	__( 'Media File', 'admin-page-framework-demo' ),
				'type'	=>	'media',
				'allow_external_source'	=>	false,
			),	
			array( // Media File with Attributes
				'field_id'	=>	'media_with_attributes',
				'title'	=>	__( 'Media File with Attributes', 'admin-page-framework-demo' ),
				'type'	=>	'media',
				'attributes_to_store'	=>	array( 'id', 'caption', 'description' ),
			),				
			array( // Repeatable Media Files
				'field_id'	=>	'media_repeatable_fields',
				'title'	=>	__( 'Repeatable Media Files', 'admin-page-framework-demo' ),
				'type'	=>	'media',
				'repeatable'	=>	true,
			),				
			array( // Sortable Media Files
				'field_id'	=>	'media_sortable_fields',
				'title'	=>	__( 'Sortable Media Files', 'admin-page-framework-demo' ),
				'type'	=>	'media',
				'sortable'	=>	true,
				array(),	// the second item
				array(),	// the third item.
			),			
			array( // Single File Upload Field
				'field_id'	=>	'file_single',
				'section_id'	=>	'file_uploads',
				'title'	=>	__( 'Single File Upload', 'admin-page-framework-demo' ),
				'type'	=>	'file',
				'label'	=>	'Select the file:',
			),					
			array( // Multiple File Upload Fields
				'field_id'	=>	'file_multiple',
				'title'	=>	__( 'Multiple File Uploads', 'admin-page-framework-demo' ),
				'type'	=>	'file',
				'label'	=>	__( 'First File', 'admin-page-framework-demo' ),
				'delimiter'	=>	'<br />',
				array(
					'label'	=>	__( 'Second File', 'admin-page-framework-demo' ),
				),
				array(
					'label'	=>	__( 'Third File', 'admin-page-framework-demo' ),
				),				
			),			
			array( // Single File Upload Field
				'field_id'	=>	'file_repeatable',
				'title'	=>	__( 'Repeatable File Uploads', 'admin-page-framework-demo' ),
				'type'	=>	'file',
				'repeatable'	=>	true,
			),
			array()
		);
		
		/*
		 * Check lists
		 */
		$this->addSettingFields(			
			array(
				'field_id'	=>	'post_type_checklist',
				'section_id'	=>	'checklists',
				'title'	=>	__( 'Post Types', 'admin-page-framework-demo' ),
				'type'	=>	'posttype',
			),		
			array(
				'field_id'	=>	'post_type_multiple_checklists',
				'title'	=>	__( 'Multiple Post Type Check lists', 'admin-page-framework-demo' ),
				'type'	=>	'posttype',
				'before_field'	=>	'<p style="clear: both; font-weight: bold;">' . __( 'For A', 'admin-page-framework-demo' ) . '</p>',
				array(
					'before_field'	=>	'<p style="clear: both; font-weight: bold;">' . __( 'For B', 'admin-page-framework-demo' ) . '</p>',
				),
				array(
					'before_field'	=>	'<p style="clear: both; font-weight: bold;">' . __( 'For C', 'admin-page-framework-demo' ) . '</p>',
				),
				'attributes'	=>	array(
					'field'	=>	array(
						'style'	=>	'margin-bottom: 1em;',
					)
				),
			),					
			array(
				'field_id'	=>	'post_type_checklist_repeatable',
				'title'	=>	__( 'Repeatable Post Type Fields', 'admin-page-framework-demo' ),
				'type'	=>	'posttype',
				'repeatable'	=> true,
				'delimiter'	=> '<hr />',
			),					
			array(
				'field_id'	=>	'taxonomy_checklist',
				'title'	=>	__( 'Taxonomy Checklist', 'admin-page-framework-demo' ),
				'type'	=>	'taxonomy',
				'height'	=>	'200px',	// ( optional )
				'taxonomy_slugs'	=>	array( 'category', 'post_tag' ),
			),				
			array(
				'field_id'	=>	'taxonomy_checklist_all',
				'title'	=>	__( 'All Taxonomies', 'admin-page-framework-demo' ),
				'type'	=>	'taxonomy',
				'taxonomy_slugs'	=>	$aTaxnomies = get_taxonomies( '', 'names' ),
			),
			array(
				'field_id'	=>	'taxonomy_multiple_checklists',
				'title'	=>	__( 'Multiple Taxonomy Fields', 'admin-page-framework-demo' ),
				'type'	=>	'taxonomy',
				'taxonomy_slugs'	=>	$aTaxnomies,
				'before_field'	=>	'<p style="clear:both; font-weight: bold;">' . __( 'For I', 'admin-page-framework-demo' ) . '</p>',
				array(  
					'before_field'	=>	'<p style="clear:both; font-weight: bold;">' . __( 'For II', 'admin-page-framework-demo' ) . '</p>',
				),
				array(  
					'before_field'	=>	'<p style="clear:both; font-weight: bold;">' . __( 'For III', 'admin-page-framework-demo' ) . '</p>',
				),				
			),
			array(
				'field_id'	=>	'taxonomy_checklist_repeatable',
				'title'	=>	__( 'Repeatable Taxonomy Fields', 'admin-page-framework-demo' ),
				'type'	=>	'taxonomy',
				'repeatable'	=> true,
				'taxonomy_slugs'	=>	$aTaxnomies,
			),
			array()
		);
		
		/*
		 * MISC fields
		 */
		$this->addSettingFields(			
			array( // Color Picker
				'field_id'	=>	'color_picker_field',
				'section_id'	=>	'color_picker',
				'title'	=>	__( 'Color Picker', 'admin-page-framework-demo' ),
				'type'	=>	'color',
			),					
			array( // Multiple Color Pickers
				'field_id'	=>	'multiple_color_picker_field',
				'title'	=>	__( 'Multiple Color Pickers', 'admin-page-framework-demo' ),
				'type'	=>	'color',
				'label'	=>	__( 'First Color', 'admin-page-framework-demo' ),
				'delimiter'	=>	'<br />',
				array(
					'label'	=>	__( 'Second Color', 'admin-page-framework-demo' ),
				),
				array(
					'label'	=>	__( 'Third Color', 'admin-page-framework-demo' ),
				),				
			),				
			array( // Repeatable Color Pickers
				'field_id'	=>	'color_picker_repeatable_field',
				'title'	=>	__( 'Repeatable Color Picker Fields', 'admin-page-framework-demo' ),
				'type'	=>	'color',
				'repeatable'	=>	true,
			),										
			array( // Single Hidden Field
				'field_id'	=>	'hidden_single',
				'section_id'	=>	'hidden_field',
				'title'	=>	__( 'Single Hidden Field', 'admin-page-framework-demo' ),
				'type'	=>	'hidden',
				'default'	=>	__( 'Test value', 'admin-page-framework-demo' ),
				'label'	=>	__( 'Test label', 'admin-page-framework-demo' ),
			),
			array( // Single Hidden Field
				'field_id'	=>	'hidden_repeatable',
				'title'	=>	__( 'Repeatable Hidden Fields', 'admin-page-framework-demo' ),
				'type'	=>	'hidden',
				'value'	=>	'HIIDENVALUE',
				'label'	=>	__( 'Repeat Me', 'admin-page-framework-demo' ),
				'repeatable'	=> true,
			),			
			array( // Multiple Hidden Fields
				'field_id'	=>	'hidden_miltiple',
				'title'	=>	'Multiple Hidden Field',
				'type'	=>	'hidden',
				'label'	=>	__( 'Hidden Field 1', 'admin-page-framework-demo' ),
				'default'	=>	'a',
				array(
					'label'	=>	__( 'Hidden Field 2', 'admin-page-framework-demo' ),
					'default'	=>	'b',
				),
				array(
					'label'	=>	__( 'Hidden Field 3', 'admin-page-framework-demo' ),
					'default'	=>	'c',
				),
				'sortable'	=>	true,
			),							
			array(	// Default Submit Button
				'field_id'	=>	'submit_button_field',
				'section_id'	=>	'submit_buttons',
				'title'	=>	__( 'Submit Button', 'admin-page-framework-demo' ),
				'type'	=>	'submit',
				'description'	=>	__( 'This is the default submit button.', 'admin-page-framework-demo' ),
			),		
			array( // Submit button as a link
				'field_id'	=>	'submit_button_link',
				'type'	=>	'submit',
				'title'	=>	__( 'Link Button', 'admin-page-framework-demo' ),
				'description'	=>	__( 'These buttons serve as a hyper link. Set the url to the <code>href</code> key to enable this option.', 'admin-page-framework-demo' ),
				'label'	=>	__( 'Google', 'admin-page-framework-demo' ),
				'href'	=>	'http://www.google.com',
				'attributes'	=>	array(
					'class'	=>	'button button-secondary',				
					'title'	=>	__( 'Go to Google!', 'admin-page-framework-demo' ),
					'style'	=>	'background-color: #C1DCFA;',
					'field'	=>	array(
						'style'	=>	'display: inline; clear: none;',
					),
				),
				array(
					'label'	=>	__( 'Yahoo', 'admin-page-framework-demo' ),
					'href'	=>	'http://www.yahoo.com',
					'attributes'	=>	array(
						'class'	=>	'button button-secondary',			
						'title'	=>	__( 'Go to Yahoo!', 'admin-page-framework-demo' ),
						'style'	=>	'background-color: #C8AEFF;',
					),
				),
				array(
					'label'	=>	__( 'Bing', 'admin-page-framework-demo' ),
					'href'	=>	'http://www.bing.com',
					'attributes'	=>	array(
						'class'	=>	'button button-secondary',			
						'title'	=>	__( 'Go to Bing!', 'admin-page-framework-demo' ),
						'style'	=>	'background-color: #FFE5AE;',
					),			
				),				
			),			
			array( // Submit button as a redirect
				'field_id'	=>	'submit_button_redirect',
				'title'	=>	__( 'Redirect Button', 'admin-page-framework-demo' ),
				'type'	=>	'submit',
				'description'	=>	sprintf( __( 'Unlike the above link buttons, this button saves the options and then redirects to: <code>%1$s</code>', 'admin-page-framework-demo' ), admin_url() )
					. ' ' . __( 'To enable this functionality, set the url to the <code>redirect_url</code> key in the field definition array.', 'admin-page-framework-demo' ),
				'label'	=>	__( 'Dashboard', 'admin-page-framework-demo' ),
				'redirect_url'	=>	admin_url(),
				'attributes'	=>	array(
					'class'	=>	'button button-secondary',
				),
			),
			array( // Reset Submit button
				'field_id'	=>	'submit_button_reset',
				'title'	=>	__( 'Reset Button', 'admin-page-framework-demo' ),
				'type'	=>	'submit',
				'label'	=>	__( 'Reset', 'admin-page-framework-demo' ),
				'reset'	=>	true,
				'attributes'	=>	array(
					'class'	=>	'button button-secondary',
				),
				'description'	=>	__( 'If you press this button, a confirmation message will appear and then if you press it again, it resets the option.', 'admin-page-framework-demo' ),
			),
			array()
		);
		$this->addSettingFields(			
			array(
				'field_id'	=>	'verify_text_field',
				'section_id'	=>	'verification',
				'title'	=>	__( 'Verify Text Input', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'description'	=>	__( 'Enter a non numeric value here.', 'admin-page-framework-demo' ),
			),
			array(
				'field_id'	=>	'verify_text_field_submit',	// this submit field ID can be used in a validation callback method
				'type'	=>	'submit',		
				'label'	=>	__( 'Verify', 'admin-page-framework-demo' ),
			)
		);	
		$this->addSettingFields(			
			array(
				'field_id'	=>	'mixed_fields',
				'section_id'	=>	'mixed_types',
				'title'	=>	__( 'Text and Hidden', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'default'	=>	'abc',
				array(
					'type'	=>	'hidden',
					'value'	=>	'xyz',
				),
				'attributes'	=>	array(
					'field'	=>	array(
						'style'	=>	'display: inline; clear:none;'	// since the rich editor does not accept the cols attribute, set the width by inline-style.
					),
				),				
				'description'	=> __( 'A hidden field is embedded. This is useful when you need to embed extra information to be sent with the visible elements.', 'admin-page-framework-demo' ),
			),		
			array()
		);	
		$this->addSettingFields(
			array(
				'section_id'	=>	'section_title_field_type',
				'field_id'	=>	'section_title_field',
				'type'	=>	'section_title',
				'label'	=>	'<h3>' . __( 'Section Name', 'admin-page-framework-demo' ) . '</h3>',
				'attributes'	=>	array(
					'size'	=>	30,
				),
			)
		);
		$this->addSettingFields(	
			'repeatable_sections',
			array(
				'field_id'	=>	'text_field_in_repeatable_sections',
				'title'	=>	__( 'Text', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'default'	=>	'xyz',
			),
			array(
				'field_id'	=>	'repeatable_field_in_repeatable_sections',
				'title'	=>	__( 'Repeatable Field', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'repeatable'	=> true,
			),			
			array(
				'field_id'	=>	'color_in_repeatable_sections',
				'title'	=>	__( 'Color', 'admin-page-framework-demo' ),
				'type'	=>	'color',
			),
			array(
				'field_id'	=>	'radio_in_repeatable_sections',
				'title'	=>	__( 'Radio', 'admin-page-framework-demo' ),
				'type'	=>	'radio',
				'default'	=>	'b',
				'label'	=>	array(
					'a'	=> 'A',
					'b'	=> 'B',
					'c'	=> 'c',				
				),
			),				
			array()
		);			
		$this->addSettingFields(			
			array(
				'section_id'	=>	'tabbed_sections_a',
				'field_id'	=>	'text_field_in_tabbed_section',
				'title'	=>	__( 'Text', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'default'	=>	'xyz',
			),
			array(
				'field_id'	=>	'repeatable_field_in_tabbed_sections',
				'title'	=>	__( 'Repeatable Field', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'repeatable'	=> true,
			),			
			array(
				'section_id'	=>	'tabbed_sections_b',
				'field_id'	=>	'size_in_tabbed_sections',
				'title'	=>	__( 'Size', 'admin-page-framework-demo' ),
				'type'	=>	'size',
			),
			array(
				'field_id'	=>	'select_in_tabbed_sections',
				'title'	=>	__( 'Select', 'admin-page-framework-demo' ),
				'type'	=>	'select',
				'default'	=>	'b',
				'label'	=>	array(
					'a'	=> 'A',
					'b'	=> 'B',
					'c'	=> 'c',				
				),
			),			
			array()
		);		
		$this->addSettingFields(
			'repeatable_tabbed_sections',
 			array(
				'section_id'	=>	'repeatable_tabbed_sections',
				'field_id'	=>	'tab_title',
				'type'	=>	'section_title',
				'label'	=>	__( 'Name', 'admin-page-framework-demo' ),
				'attributes'	=>	array(
					'size'	=>	10,
					// 'type'	=> 'number',	// change the input type 
				),
			),
			array(
				'field_id'	=>	'text_field_in_tabbed_section_in_repeatable_sections',
				'title'	=>	__( 'Text', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'default'	=>	'xyz',
			),
			array(
				'field_id'	=>	'repeatable_field_in_tabbed_sections_in_repetable_sections',
				'title'	=>	__( 'Repeatable Field', 'admin-page-framework-demo' ),
				'type'	=>	'text',
				'repeatable'	=> true,
			),			
			array(
				'field_id'	=>	'size_in_tabbed_sections_in_repeatable_sections',
				'title'	=>	__( 'Size', 'admin-page-framework-demo' ),
				'type'	=>	'size',
			),
			array(
				'field_id'	=>	'select_in_tabbed_sections_in_repeatable_sections',
				'title'	=>	__( 'Select', 'admin-page-framework-demo' ),
				'type'	=>	'select',
				'default'	=>	'b',
				'label'	=>	array(
					'a'	=> 'A',
					'b'	=> 'B',
					'c'	=> 'c',				
				),
			),		
			array(
				'field_id'	=>	'color_in_tabbed_sections_in_repeatable_sections',
				'title'	=>	__( 'Color', 'admin-page-framework-demo' ),
				'type'	=>	'color',
				'repeatable'	=>	true,
				'sortable'	=>	true,
			), 
			array(
				'field_id'	=>	'image_in_tabbed_sections_in_repeatable_sections',
				'title'	=>	__( 'Image', 'admin-page-framework-demo' ),
				'type'	=>	'image',
				'repeatable'	=>	true,
				'sortable'	=>	true,
				'attributes'	=>	array(
					'style'	=>	'max-width:300px;',
				),
			),
			array(
				'field_id'	=>	'media_in_tabbed_sections_in_repeatable_sections',
				'title'	=>	__( 'Media', 'admin-page-framework-demo' ),
				'type'	=>	'media',
				'repeatable'	=>	true,
				'sortable'	=>	true,
			),				
			array()
		);		
	
		/**
		 * Fields to be defined with callback methods - pass only the required keys: 'field_id', 'section_id', and the 'type'.
		 */
		$this->addSettingFields(
			array(
				'field_id'	=>	'callback_example',
				'section_id'	=>	'callbacks',
				'type'	=>	'select',
			),
			array(
				'field_id'	=>	'apf_post_titles',
				'section_id'	=>	'callbacks',
				'type'	=>	'select',
			),				
			array()
		);
		
		/*
		 * Custom Field Types - in order to use these types, those custom field types must be registered. 
		 * The way to register a field type is demonstrated in the start_{extended class name} callback function.
		 */
		$this->addSettingFields(			
			array(
				'field_id'	=>	'geometrical_coordinates',
				'section_id'	=>	'geometry',
				'title'	=>	__( 'Geometrical Coordinates', 'admin-page-framework-demo' ),
				'type'	=>	'geometry',
				'description'	=>	__( 'Get the coordinates from the map.', 'admin-page-framework-demo' ),
				'default'	=>	array(
					'latitude'	=>	20,
					'longitude'	=>	20,
				),
			)
		);
		$this->addSettingFields(
			array(	// Single date picker
				'field_id'	=>	'date',
				'section_id'	=>	'date_pickers',
				'title'	=>	__( 'Date', 'admin-page-framework-demo' ),
				'type'	=>	'date',
			),		
			array(	// Multiple date pickers
				'field_id'	=>	'dates',
				'title'	=>	__( 'Dates', 'admin-page-framework-demo' ),
				'type'	=>	'date',
				'label'	=>	__( 'Start Date: ', 'amin-page-framework-demo' ),
				'date_format'	=>	'yy-mm-dd',	// yy/mm/dd is the default format.
				'delimiter'	=>	'&nbsp;&nbsp;&nbsp;&nbsp;',
				array( 
					'label'	=>	__( 'End Date: ', 'amin-page-framework-demo' ), 
				),
			),	
			array(	// Repeatable date picker fields
				'field_id'	=>	'date_repeatable',
				'type'	=>	'date',
				'title'	=>	__( 'Repeatable', 'admin-page-framework-demo' ),
				'repeatable'	=> true,
			),			
			array(	// Sortable date picker fields
				'field_id'	=>	'date_sortable',
				'type'	=>	'date',
				'title'	=>	__( 'Sortable', 'admin-page-framework-demo' ),
				'sortable'	=> true,
				array(),	// the second item
				array(),	// the third item
			),				
			array(	// Single time picker
				'field_id'	=>	'time',
				'type'	=>	'time',
				'title'	=>	__( 'Time', 'admin-page-framework-demo' ),
				'time_format'	=>	'H:mm',	// H:mm is the default format.
			),
			array(	// Repeatable time picker fields
				'field_id'	=>	'time_repeatable',
				'type'	=>	'time',
				'title'	=>	__( 'Repeatable Time Fields', 'admin-page-framework-demo' ),
				'repeatable'	=> true,
			),
			array(	// Sortable tune picker fields
				'field_id'	=>	'time_sortable',
				'type'	=>	'time',
				'title'	=>	__( 'Sortable', 'admin-page-framework-demo' ),
				'sortable'	=> true,
				array(),	// the second item
				array(),	// the third item
			),				
			array(	// Single date time picker
				'field_id'	=>	'date_time',
				'type'	=>	'date_time',
				'title'	=>	__( 'Date & Time', 'admin-page-framework-demo' ),
				'date_format'	=>	'yy-mm-dd',	// yy/mm/dd is the default format.
				'time_format'	=>	'H:mm',	// H:mm is the default format.
			),		
			array(	// Multiple date time pickers
				'field_id'	=>	'dates_time_multiple',
				'type'	=>	'date_time',
				'title'	=>	__( 'Multiple Date and Time', 'admin-page-framework-demo' ),
				'description'	=>	__( 'With different time formats', 'admin-page-framework-demo' ),
				'label'	=>	__( 'Default', 'amin-page-framework-demo' ), 
				'time_format'	=>	'H:mm',
				'date_format'	=>	'yy-mm-dd',	// yy/mm/dd is the default format.
				'delimiter'	=>	'<br />',				
				array(
					'label'	=>	__( 'AM PM', 'amin-page-framework-demo' ), 
					'time_format'	=>	'hh:mm tt',
				),
				array(
					'label'	=>	__( 'Time Zone', 'amin-page-framework-demo' ), 
					'time_format'	=>	'hh:mm tt z',
				),	
			),
			array(	// Single date time picker
				'field_id'	=>	'date_time_repeatable',
				'type'	=>	'date_time',
				'title'	=>	__( 'Repeatable Date & Time Fields', 'admin-page-framework-demo' ),
				'repeatable'	=> true,
			),	
			array(	// Sortable date_time picker fields
				'field_id'	=>	'date_time_sortable',
				'type'	=>	'date_time',
				'title'	=>	__( 'Sortable', 'admin-page-framework-demo' ),
				'sortable'	=> true,
				array(),	// the second item
				array(),	// the third item
			),
			array()
		);
		$this->addSettingFields(			
			array(
				'field_id'	=>	'dials',
				'section_id'	=>	'dial',
				'title'	=>	__( 'Multiple Dials', 'admin-page-framework-demo' ),
				'type'	=>	'dial',
				'label'	=>	__( 'Default', 'admin-page-framework-demo' ),
				'attributes'	=>	array(	
					'field'	=>	array(
						'style'	=>	'display: inline; clear: none',	// this makes the field element inline, which means next fields continues from the right end of the field, not from the new line.
					),
				),
				array(					
					'label'	=>	__( 'Disable display input', 'admin-page-framework-demo' ),
					'attributes'	=>	array(
						// For details, see https://github.com/aterrien/jQuery-Knob
						'data-width'	=>	100,
						'data-displayInput'	=> 'false',
					),
				),				
				array(					
					'label'	=>	__( 'Cursor mode', 'admin-page-framework-demo' ),
					'attributes'	=>	array(
						'data-width'	=>	150,
						'data-cursor'	=>	'true',
						'data-thickness'	=>	'.3', 
						'data-fgColor'	=>	'#222222',					
					),
				),
				array(
					'label'	=>	__( 'Display previous value (effect)', 'admin-page-framework-demo' ),
					'attributes'	=>	array(
						'data-width'	=>	200,
						'data-min'	=>	-100, 
						'data-displayPrevious'	=>	'true', // a boolean value also needs to be passed as string
					),					
				),
				array(
					'label'	=>	__( 'Angle offset', 'admin-page-framework-demo' ),				
					'attributes'	=>	array(
						'data-angleOffset'	=>	90,
						'data-linecap'	=>	'round',
					),										
				),
				array(
					'label'	=>	__( 'Angle offset and arc', 'admin-page-framework-demo' ),
					'attributes'	=>	array(
						'data-fgColor'	=>	'#66CC66',
						'data-angleOffset'	=>	-125,
						'data-angleArc'	=>	250,
					),										
				),
				array(
					'label'	=>	__( '5-digit values, step 1000', 'admin-page-framework-demo' ),
					'attributes'	=>	array(
						'data-step'	=>	1000,
						'data-min'	=>	-15000,
						'data-max'	=>	15000,
						'data-displayPrevious'	=>	true,
					),										
				),

			),
			array(
				'field_id'	=>	'dial_big',
				'title'	=>	__( 'Big', 'admin-page-framework-demo' ),
				'type'	=>	'dial',
				'attributes'	=>	array(
					'data-width'	=>	400,
					'data-height'	=>	400,
				),
			),
			array(
				'field_id'	=>	'dial_repeatable',
				'title'	=>	__( 'Repeatable', 'admin-page-framework-demo' ),
				'type'	=>	'dial',
				'repeatable'	=>	true,
			),
			array(
				'field_id'	=>	'dial_sortable',
				'title'	=>	__( 'Sortable', 'admin-page-framework-demo' ),
				'type'	=>	'dial',
				'sortable'	=>	true,
				'attributes'	=>	array(	
					'field'	=>	array(
						'style'	=>	'display: inline; clear: none',	// this makes the field element inline, which means next fields continues from the right end of the field, not from the new line.
					),
					'data-width'	=>	100,
					'data-height'	=> 	100,
				),				
				array(),	// the second item
				array(),	// the third item
				array(),	// the fourth item
			)			
		);
		$this->addSettingFields(			
			array(
				'field_id'	=>	'font_field',
				'section_id'	=>	'font',
				'title'	=>	__( 'Font Upload', 'admin-page-framework-demo' ),
				'type'	=>	'font',
				'description'	=>	__( 'Set the URL of the font.', 'admin-page-framework-demo' ),
			),
			array(
				'field_id'	=>	'font_field_repeatable',
				'title'	=>	__( 'Repeatable', 'admin-page-framework-demo' ),
				'type'	=>	'font',
				'repeatable'	=>	 true,
			),			
			array(
				'field_id'	=>	'font_field_sortable',
				'title'	=>	__( 'Sortable', 'admin-page-framework-demo' ),
				'type'	=>	'font',
				'sortable'	=>	 true,
				array(),	// second
				array(),	// third
			),			
			array()
		);
		$this->addSettingFields(
			array(
				'field_id'	=>	'sample_field',
				'section_id'	=>	'sample',
				'type'	=>	'sample',
				'title'	=>	__( 'Sample', 'admin-page-framework-demo' ),
				'description'	=>	__( 'This sample custom field demonstrates how to display a certain element after selecting a radio button.', 'admin-page-framework-demo' ),
				// 'default'	=> 'red',
				'label'	=>	array(
					'red'	=> __( 'Red', 'admin-page-framework-demo' ),
					'blue'	=> __( 'Blue', 'admin-page-framework-demo' ),
					'green'	=> __( 'Green', 'admin-page-framework-demo' ),
				),
				'reveal'	=> array(	// the field type specific key. This is defined in the
					'red' => '<p style="color:red;">' . __( 'You selected red!', 'admin-page-framework-demo' ) . '</p>',
					'blue' => '<p style="color:blue;">' . __( 'You selected blue!', 'admin-page-framework-demo' ) . '</p>',
					'green' => '<p style="color:green;">' . __( 'You selected green!', 'admin-page-framework-demo' ) . '</p>',
				),
			),
			array(
				'field_id'	=>	'sample_field_repeatable',
				'type'	=>	'sample',
				'title'	=>	__( 'Sample', 'admin-page-framework-demo' ),
				// 'default'	=> 'red',
				'label'	=>	array(
					'red'	=> __( 'Red', 'admin-page-framework-demo' ),
					'blue'	=> __( 'Blue', 'admin-page-framework-demo' ),
					'green'	=> __( 'Green', 'admin-page-framework-demo' ),
				),
				'reveal'	=> array(	// the field type specific key. This is defined in the
					'red' => '<p style="color:red;">' . __( 'You selected red!', 'admin-page-framework-demo' ) . '</p>',
					'blue' => '<p style="color:blue;">' . __( 'You selected blue!', 'admin-page-framework-demo' ) . '</p>',
					'green' => '<p style="color:green;">' . __( 'You selected green!', 'admin-page-framework-demo' ) . '</p>',
				),
				'repeatable'	=> true,
			)	
		);
		$this->addSettingFields(
			array(
				'field_id'	=>	'revealer_field_by_id',
				'section_id'	=>	'revealer',
				'type'	=>	'revealer',			
				'title'	=>	__( 'Reveal Hidden Fields' ),
				'value'	=>	'undefined',	// always set the 'Select a Field' label.
				'label'	=>	array(	// the keys represent the selector to reveal, in this case, their tag id : #fieldrow-{field id}
					'undefined'	=> __( '-- Select a Field --', 'admin-page-framework-demo' ),		
					'#fieldrow-revealer_revealer_field_option_a'	=> __( 'Option A', 'admin-page-framework-demo' ),		
					'#fieldrow-revealer_revealer_field_option_b, #fieldrow-revealer_revealer_field_option_c'	=> __( 'Option B and C', 'admin-page-framework-demo' ),
				),
				'description'	=>	__( 'Specify the selectors to reveal in the label keys in the field definition array.', 'admin-page-framework-demo' ),
			),
			array(
				'field_id'	=>	'revealer_field_option_a',
				'section_id'	=>	'revealer',
				'type'	=>	'textarea',		
				'default'	=>	__( 'Hi there!', 'admin-page-framework-demo' ),
				'hidden'	=> true,
			),
			array(
				'field_id'	=>	'revealer_field_option_b',				
				'section_id'	=>	'revealer',
				'type'	=>	'password',		
				'description'	=>	__( 'Type a password.', 'admin-page-framework-demo' ),			
				'hidden'	=> true,
			),
			array(
				'field_id'	=>	'revealer_field_option_c',
				'section_id'	=>	'revealer',
				'type'	=>	'text',		
				'description'	=>	__( 'Type text.', 'admin-page-framework-demo' ),			
				'hidden'	=> true,
			)
		);
		$this->addSettingFields(
			array(
				'field_id'	=>	'grid_field',				
				'section_id'	=>	'grid',
				'type'	=>	'grid',		
				'description'	=>	__( 'Move the widgets.', 'admin-page-framework-demo' ),	
				'show_title_column'	=> false,	// this removes the title column of the field output
				'grid_options' => array(
					'resize' => array(
						'enabled'	=>	false,
					),
				),
				'default'	=>	array(	// '[{"id":"","col":1,"row":1,"size_y":1,"size_x":1},{"id":"","col":1,"row":2,"size_y":1,"size_x":1}]',
					array( 
						'col'	=>	1,
						'row'	=>	1,
						'size_y'	=>	1,
						'size_x'	=>	1,
					),
					array(
						'col'	=>	2,
						'row'	=>	2,
						'size_y'	=>	1,
						'size_x'	=>	1,					
					),
				),
			),
			array(
				'field_id'	=>	'grid_field2',				
				'description'	=>	__( 'Widgets can be expanded.', 'admin-page-framework-demo' ),	
				'type'	=>	'grid',		
				'grid_options' => array(
					'resize' => array(
						'enabled'	=>	true,
					),
				),
				'show_title_column'	=> false,	
				'default'	=>	array(	
					array( 
						'col'	=>	1,
						'row'	=>	1,
						'size_y'	=>	2,
						'size_x'	=>	1,
					),
					array(
						'col'	=>	2,
						'row'	=>	1,
						'size_y'	=>	1,
						'size_x'	=>	2,					
					),
					array(
						'col'	=>	4,
						'row'	=>	1,
						'size_y'	=>	1,
						'size_x'	=>	2,					
					),					
				),
			),	
			array(
				'field_id'	=>	'grid_field3',
				'type'	=>	'grid',		
				'description'	=>	__( 'The base size can be different.', 'admin-page-framework-demo' ),	
				'grid_options' => array(
					'resize' => array(
						'enabled'	=>	true,
					),
					'widget_margins' => array( 10, 10 ),
					'widget_base_dimensions' => array( 100, 100 ),					
				),
				'show_title_column'	=> false,	
				'default'	=>	array(	
					array( 
						'col'	=>	1,
						'row'	=>	1,
						'size_y'	=>	1,
						'size_x'	=>	1,
					),			
				),
			),				
			array()
		);
		$this->addSettingFields(
			// The settings are the same as the tokeninput jQuery plugin.
			// see: http://loopj.com/jquery-tokeninput/
			// For the first parameter, use the 'settings' key and the second parameter, use the 'settings2'.
			array(
				'section_id'	=>	'autocomplete',
				'type'	=>	'autocomplete',		
				'field_id'	=>	'autocomplete_field',
				'title'		=>	__( 'Default', 'admin-page-framework-demo' ),
				'description'	=>	__( 'By default, all the post titles will be fetched in the background and will pop up.', 'admin-page-framework-demo' ),	
			),
			array(
				'section_id'	=>	'autocomplete',
				'type'	=>	'autocomplete',		
				'field_id'	=>	'autocomplete_local_data',
				'title'		=>	__( 'Local Data', 'admin-page-framework-demo' ),
				'settings'	=>	array(
					array( 'id' => 7, 'name' => 'Ruby' ),
					array( 'id' => 11, 'name' => 'Python' ),
					array( 'id' => 13, 'name' => 'JavaScript' ),
					array( 'id' => 17, 'name' => 'ActionScript' ),
					array( 'id' => 19, 'name' => 'Scheme' ),
					array( 'id' => 23, 'name' => 'Lisp' ),
					array( 'id' => 29, 'name' => 'C#' ),
					array( 'id' => 31, 'name' => 'Fortran' ),
					array( 'id' => 37, 'name' => 'Visual Basic' ),
					array( 'id' => 41, 'name' => 'C' ),
					array( 'id' => 43, 'name' => 'C++' ),
					array( 'id' => 47, 'name' => 'Java' ),
				),
				'settings2'	=> array(
					'theme'	=>	'mac',
					'hintText'	=>	__( 'Type a programming language.', 'admin-page-framework-demo' ),
					'prePopulate' => array(
						array( 'id' => 3, 'name' => 'PHP' ),
						array( 'id' => 5, 'name' => 'APS' ),
					)					
				),
				'description'	=>	__( 'Predefined items are Ruby, Python, JavaScript, ActionScript, Scheme, Lisp, C#, Fortran, Vidual Basic, C, C++, Java.', 'admin-page-framework-demo' ),	
			),
			array(
				'section_id'	=>	'autocomplete',
				'type'	=>	'autocomplete',		
				'field_id'	=>	'autocomplete_custom_post_type',
				'title'		=>	__( 'Custom Post Type', 'admin-page-framework-demo' ),
				'settings'	=> add_query_arg( array( 'request' => 'autocomplete', 'post_type' => 'apf_posts' ) + $_GET, admin_url( AdminPageFramework_WPUtility::getPageNow() ) ),
				'settings2'	=>	array(	// equivalent to the second parameter of the tokenInput() method
					'tokenLimit'		=>	5,
					'preventDuplicates'	=>	true,
					'theme'				=>	'facebook',	
					'searchDelay'		=>	50,	// 50 milliseconds. Default: 300
				),
				'description'	=>	__( 'To set a custom post type, you need to compose the query url. This field is for the titles of this demo plugin\'s custom post type.', 'admin-page-framework-demo' ),	//' syntax fixer
			),
			array(
				'section_id'	=>	'autocomplete',
				'type'	=>	'autocomplete',		
				'field_id'	=>	'autocomplete_repeatable_field',
				'title'		=>	__( 'Repeatable', 'admin-page-framework-demo' ),
				'repeatable'	=> true,
			),
			array()
		);

		/*
		 * ( optional ) Add links in the plugin listing table. ( .../wp-admin/plugins.php )
		 */
 		$this->addLinkToPluginDescription( 
			"<a href='http://www.google.com'>Google</a>",
			"<a href='http://www.yahoo.com'>Yahoo!</a>",
			"<a href='http://en.michaeluno.jp'>miunosoft</a>",
			"<a href='https://github.com/michaeluno/admin-page-framework' title='Contribute to the GitHub repository!' >Repository</a>"
		);
		$this->addLinkToPluginTitle(
			"<a href='http://www.wordpress.org'>WordPress</a>"
		);
		
		$this->setPluginSettingsLinkLabel( __( 'Built-in Field Types', 'admin-page-framework-demo' ) );

    }
		
	/*
	 * Built-in Field Types Page
	 * */
	public function do_apf_builtin_field_types() {	// do_{page slug}
		submit_button();
	}
	
	/*
	 * Custom Field Types Page
	 * */
	public function do_apf_custom_field_types() {	// do_{page slug}
		submit_button();
	}
	
	/*
	 * Field callback methods - for field definitions that require heavy tasks should be defined with the callback methods.
	 */
	public function field_definition_APF_DEMO_callbacks_callback_example( $aField ) {	// field_definition_{instantiated class name}_{section id}_{field_id}
		
		$aField['title'] = __( 'Post Titles', 'admin-page-framework-demo' );
		$aField['description'] = __( "This description is inserted with the callback method: <code>" . __METHOD__ . "</code>", 'admin-page-framework-demo' );
		$aField['label'] = $this->_getPostTitles();
		return $aField;
		
	}
	public function field_definition_APF_DEMO_callbacks_apf_post_titles( $aField ) {	// field_definition_{instantiated class name}_{section id}_{field_id}
		
		$aField['title'] = __( 'APF Custom Post Titles', 'admin-page-framework-demo' );
		$aField['label'] = $this->_getPostTitles( 'apf_posts' );
		return $aField;
		
	}	
		private function _getPostTitles( $sPostTypeSlug='post' ) {
			
			$_aArgs = array(
				'post_type' => $sPostTypeSlug,
			);
			$_oResults = new WP_Query( $_aArgs );
			$_aPostTitles = array();
			foreach( $_oResults->posts as $_iIndex => $_oPost ) {
				$_aPostTitles[ $_oPost->ID ] = $_oPost->post_title;
			}
			return $_aPostTitles;
			
		}
	

	/*
	 * Validation Callbacks
	 * */
	public function validation_APF_Demo_verification_verify_text_field( $sNewInput, $sOldInput ) {	// validation_{extended class name}_{section id}_{field id}
	
		/* 1. Set a flag. */
		$_bVerified = true;
		
		/* 2. Prepare an error array.
		 	We store values that have an error in an array and pass it to the setFieldErrors() method.
			It internally stores the error array in a temporary area of the database called transient.
			The used name of the transient is a md5 hash of 'instantiated class name' + '_' + 'page slug'. 
			The library class will search for this transient when it renders the form fields 
			and if it is found, it will display the error message set in the field array. 	
		*/
		$_aErrors = array();

		/* 3. Check if the submitted value meets your criteria. As an example, here a numeric value is expected. */
		if ( ! is_numeric( $sNewInput ) ) {
			
			// $variable[ 'sectioni_id' ]['field_id']
			$_aErrors['verification']['verify_text_field'] = __( 'The value must be numeric:', 'admin-page-framework-demo' ) . ' ' . $sNewInput;
			$_bVerified = false;
					
		}
		
		/* 4. An invalid value is found. */
		if ( ! $_bVerified ) {
		
			/* 4-1. Set the error array for the input fields. */
			$this->setFieldErrors( $_aErrors );		
			$this->setSettingNotice( __( 'There was something wrong with your input.', 'admin-page-framework-demo' ) );
			return $sOldInput;
			
		}
				
		return $sNewInput;		
		
	}
	public function validation_apf_builtin_field_types_files( $aInput, $aOldPageOptions ) {	// validation_{page slug}_{tab slug}

		/* Display the uploaded file information. */
		$aFileErrors = array();
		$aFileErrors[] = $_FILES[ $this->oProp->sOptionKey ]['error']['file_uploads']['file_single'];
		$aFileErrors[] = $_FILES[ $this->oProp->sOptionKey ]['error']['file_uploads']['file_multiple'][0];
		$aFileErrors[] = $_FILES[ $this->oProp->sOptionKey ]['error']['file_uploads']['file_multiple'][1];
		$aFileErrors[] = $_FILES[ $this->oProp->sOptionKey ]['error']['file_uploads']['file_multiple'][2];
		foreach( $_FILES[ $this->oProp->sOptionKey ]['error']['file_uploads']['file_repeatable'] as $aFile )
			$aFileErrors[] = $aFile;
			
		if ( in_array( 0, $aFileErrors ) ) 
			$this->setSettingNotice( __( '<h3>File(s) Uploaded</h3>', 'admin-page-framework-demo' ) . $this->oDebug->getArray( $_FILES ), 'updated' );
		
		return $aInput;
		
	}
	
	/*
	 * Custom field types - This is another way to register a custom field type. 
	 * This method gets fired when the framework tries to define field types. 
	 */
 	public function field_types_APF_Demo( $aFieldTypeDefinitions ) {	// field_types_{extended class name}
				
		/* 1. Include the file that defines the custom field type. 
		 This class should extend the predefined abstract class that the library prepares already with necessary methods. */
		$sFilePath = dirname( APFDEMO_FILE ) . '/third-party/geometry-custom-field-type/GeometryCustomFieldType.php';
		if ( file_exists( $sFilePath ) ) include_once( $sFilePath );
		
		/* 2. Instantiate the class - use the getDefinitionArray() method to get the field type definition array.
		 Then assign it to the filtering array with the key of the field type slug. */
		$oFieldType = new GeometryCustomFieldType( 'APF_Demo' );
		$aFieldTypeDefinitions['geometry'] = $oFieldType->getDefinitionArray();
		
		/* 3. Return the modified array. */
		return $aFieldTypeDefinitions;
		
	} 
	
}
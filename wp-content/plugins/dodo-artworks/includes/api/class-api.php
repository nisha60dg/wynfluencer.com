<?php

class DODO_ARTWORKS_RESTAPI {

    /**
	 * The MYTEMP_WP Assessments handler instance variable
	 *
	 * @access public
	 * @since  1.0
	 * @var    DODO_Shows_API
	 */
    public $shows;
    
	/**
	 * The MYTEMP_WP APIs handler instance variable
	 *
	 * @access public
	 * @since  1.0
	 * @var    DODO_Artists_API
	 */
    public $artists;
	
	/**
	 * The MyTemperament_Participant_API Participant APIs handler instance variable
	 *
	 * @access public
	 * @since  1.0
	 * @var    DODO_Openings_API
	 */
	public $openings;
	
	/**
	 * The MyTemperament_Participant_Sessions_API Participant APIs handler instance variable
	 *
	 * @access public
	 * @since  1.0
	 * @var    DODO_Artworks_API
	 */
	public $artworks;
    
    public function __construct() {
        $this->setup_api_objects();
       
    }


    /**
	 * Setup all objects
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function setup_api_objects() {

        $this->shows       = new DODO_Shows_API;
        $this->openings    = new DODO_Openings_API;
        $this->artists     = new DODO_Artists_API;
        $this->artworks    = new DODO_Artworks_API;
        // $this->openings->getOpenings(['show' => 'twelve-one']); 
    }


}

?>
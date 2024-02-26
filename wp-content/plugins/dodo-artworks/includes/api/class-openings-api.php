<?php

/**
 * Class DODO_Openings_API
 *
 * 
 */
class DODO_Openings_API extends DODO_ARTWORKS_CURL {

    private $errors;

    /**
	 * Object type to query for.
	 *
	 * @access public
	 * @since  1.0
	 * @var    string
	 */
    public $service = 'openings';
    
    /**
	 * Object type to query for.
	 *
	 * @access public
	 * @since  1.0
	 * @var    string
	 */
	public $api_version = 'twenty-twenty-one-child/v2/';

    /**
	 * Object type to query for.
	 *
	 * @access public
	 * @since  1.0
	 * @var    string
	 */
    public function getOpenings( $data = []){

		$this->errors = array();

		$args = $this->default_args();

        $args = wp_parse_args($args, array ( 
                'query_string' => $data
            )
        );
		
        return $this->_get($args);
	}

    /**
	 * Object type to query for.
	 *
	 * @access public
	 * @since  1.0
	 * @var    string
	 */
    public function getOpening($opening_name = ''){

        if(empty($opening_name))
            return false;

		$this->errors = array();

		$args = $this->default_args();

        $args = wp_parse_args($args, array ( 
                'query_string' => $opening_name
            )
        );

        return $this->_get($args);        
	}

    /**
	 * Object type to query for.
	 *
	 * @access public
	 * @since  1.0
	 * @var    string
	 */
    public function default_args(){
        return array(
            'service'  =>  $this->api_version.$this->service,
        );
    }

}
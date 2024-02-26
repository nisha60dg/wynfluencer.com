<?php

/**
 * Class DODO_Shows_API
 *
 * 
 */
class DODO_Shows_API extends DODO_ARTWORKS_CURL {

    private $errors;

    /**
	 * Object type to query for.
	 *
	 * @access public
	 * @since  1.0
	 * @var    string
	 */
    public $service = 'shows';
    
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
    public function getShows($data = []){

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
    public function getShow($show_name = ''){

        if(empty($show_name))
            return false;

		$this->errors = array();

		$args = $this->default_args();

        $args = wp_parse_args($args, array ( 
                'query_string' => $show_name
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
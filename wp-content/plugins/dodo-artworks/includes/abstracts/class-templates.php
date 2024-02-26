<?php

class DODO_Artwork_Templates {

	/**
	 * Returns the path to the MyTemperament templates directory
	 *
	 * @since 1.0
	 * @return string
	 */
	public function get_templates_dir() {
		return DODO_ARTWORKS_DIR . 'templates';
	}

	/**
	 * Returns the URL to the MyTemperament templates directory
	 *
	 * @since 1.0
	 * @return string
	 */
	public function get_templates_url() {
		return DODO_ARTWORKS_URL . 'templates';
	}

	/**
	 * Returns the URL to the theme's MyTemperament templates directory
	 *
	 * @since 1.0
	 * @return string
	 */
	public function get_theme_template_dir_name() {
		return apply_filters( 'dodo_theme_template_dir_name', 'wp-temperament-assessment' );
	}

	/**
	 * Retrieves a template part
	 *
	 * @since 1.0
	 *
	 *
	 * @param string $slug
	 * @param string $name Optional. Default null
	 * @param bool   $load
	 *
	 * @return string
	 *
	 * @uses locate_template()
	 * @uses load_template()
	 * @uses get_template_part()
	 */
	public function get_template_part( $slug, $name = null, $load = true ) {

		// Log a warning when the defunct 'get_template_part_{$slug}' hook has callbacks registered against it.
		if ( has_action( 'get_template_part_' . $slug ) ) {
			//my_temperament()->utils->log( sprintf( 'Warning: As of MyTemperament 2.2.17, the \'get_template_part_%1$s\' hook has been renamed to \'dodo_get_template_part_%1$s\' when used with MyTemperament templates.', $slug ) );
		}

		/**
		 * Fires when executing the requested template code for a given template part.
		 *
		 * The dynamic portion of the hook name, `$slug`, refers to the template part slug.
		 *
		 * @since 1.0    As 'get_template_part_$slug'
		 * @since 1.0 Renamed to 'dodo_get_template_part_$slug' to avoid potential conflicts
		 *
		 * @param string $slug The slug of the template part.
		 * @param string $name The name of the template part.
		 */
		do_action( 'dodo_get_template_part_' . $slug, $slug, $name );

		// Setup possible parts
		$templates = array();

		if ( isset( $name ) ) {
			$templates[] = $slug . '-' . $name . '.php';
		}

		$templates[] = $slug . '.php';

		/**
		 * Filters the MyTemperament templates for a given $slug and/or $name combination.
		 *
		 * @since 1.0    As 'get_template_part'
		 * @since 1.0 Renamed to 'dodo_get_template_part' to avoid a core conflict
		 *
		 * @param string $templates The list of possible template parts.
		 * @param string $slug      The slug of the template part.
		 * @param string $name      The name of the template part.
		 */
		$templates = apply_filters( 'dodo_get_template_part', $templates, $slug, $name );

		// Return the part that is found
		return $this->locate_template( $templates, $load, false );
	}

	/**
	 * Retrieve the name of the highest priority template file that exists.
	 *
	 * Searches in the STYLESHEETPATH before TEMPLATEPATH so that themes which
	 * inherit from a parent theme can just overload one file. If the template is
	 * not found in either of those, it looks in the theme-compat folder last.
	 *
	 *
	 * @since 1.0
	 *
	 * @param string|array $template_names Template file(s) to search for, in order.
	 * @param bool $load If true the template file will be loaded if it is found.
	 * @param bool $require_once Whether to require_once or require. Default true.
	 *   Has no effect if $load is false.
	 * @return string The template filename if one is located.
	 */
	public function locate_template( $template_names, $load = false, $require_once = true ) {
		// No file found yet
		$located = false;

		// Try to find a template file
		foreach ( (array) $template_names as $template_name ) {

			// Continue if template is empty
			if ( empty( $template_name ) )
				continue;

			// Trim off any slashes from the template name
			$template_name = ltrim( $template_name, '/' );

			// try locating this template file by looping through the template paths
			foreach( $this->get_theme_template_paths() as $template_path ) {
				if( file_exists( $template_path . $template_name ) ) {
					$located = $template_path . $template_name;
					break;
				}
			}
		}

		if ( ( true == $load ) && ! empty( $located ) )
			load_template( $located, $require_once );

		return $located;
	}

	/**
	 * Returns a list of paths to check for template locations
	 *
	 * @since 1.0
	 * @return mixed|void
	 */
	public function get_theme_template_paths() {

		$template_dir = $this->get_theme_template_dir_name();

		$file_paths = array(
			1 => trailingslashit( get_stylesheet_directory() ) . $template_dir,
			10 => trailingslashit( get_template_directory() ) . $template_dir,
			100 => $this->get_templates_dir()
		);

		$file_paths = apply_filters( 'dodo_template_paths', $file_paths );

		// sort the file paths based on priority
		ksort( $file_paths, SORT_NUMERIC );

		return array_map( 'trailingslashit', $file_paths );
	}

}

<?php
  
$plugin_info = array(
  'pi_name' => 'Clean_css_identifier',
  'pi_version' => '0.1',
  'pi_author' => 'Andy Hebrank',
  'pi_description' => 'Wrap drupal_clean_css_identifer',
  'pi_usage' => Clean_css_identifier::usage()
);

class Clean_css_identifier
{
	var $return_data = "";

	function drupal_clean_css_identifier($identifier, $filter = array(' ' => '-', '_' => '-', '/' => '-', '[' => '-', ']' => '')) {
	  // By default, we filter using Drupal's coding standards.
	  $identifier = strtr($identifier, $filter);

	  // Valid characters in a CSS identifier are:
	  // - the hyphen (U+002D)
	  // - a-z (U+0030 - U+0039)
	  // - A-Z (U+0041 - U+005A)
	  // - the underscore (U+005F)
	  // - 0-9 (U+0061 - U+007A)
	  // - ISO 10646 characters U+00A1 and higher
	  // We strip out any character not in the above list.
	  $identifier = preg_replace('/[^\x{002D}\x{0030}-\x{0039}\x{0041}-\x{005A}\x{005F}\x{0061}-\x{007A}\x{00A1}-\x{FFFF}]/u', '', $identifier);

	  return $identifier;
	}

	function Clean_css_identifier()
	{
		global $TMPL;
		$version = "";
		if ( $TMPL )
		{
			$version = "1";
		}
		else
		{
			$version = "2";
		}
		if ($version == "2")
		{
			$this->EE =& get_instance();
			$TMPL = $this->EE->TMPL;
		}

		$this->return_data = strtolower($this->drupal_clean_css_identifier($TMPL->tagdata));

	}

	//  Plugin Usage
	// ----------------------------------------

	// This function describes how the plugin is used.
	//  Make sure and use output buffering

	function usage()
	{
		ob_start();
		?>Just wrap some text to get a css safe identifier.
		<?php
		$buffer = ob_get_contents();

		ob_end_clean();

		return $buffer;
	}
	// END
}
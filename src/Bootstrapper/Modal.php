<?php
namespace Bootstrapper;

use \HTML;

/**
 * Modal for creating Twitter Bootstrap Modal.
 *
 * @category   HTML/UI
 * @package    Enhanced Laravel Twitter Bootstrap Bundle
 * @author     Pasquale Vazzana - <pasqualevazzana@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       https://github.com/Pasvaz/bootstrapper
 *
 * @see        https://github.com/Pasvaz/bootstrapper
 */
class Modal
{
	/**
	 * @var string
	 */
	private $name = 'myModal';
	
	/**
	 * @var string
	 */
	private $data_remote = null;
	
	/**
	 * @var array
	 */
	private $headers = array();
	
	/**
	 * @var array
	 */
	private $bodies = array();
	
	/**
	 * @var array
	 */
	private $footers = array();
	
	/**
	 * The current Modal's attributes
	 *
	 * @var array
	 */
	private $attributes  = array();

	/**
	 * Whether the current Modal should use the close button
	 *
	 * @var boolean
	 */
	public $autoclose   = true;

	/**
	 * Whether the current Modal should add a close button on the Footer
	 *
	 * @var boolean
	 */
	public $autofooter   = true;

	/**
	 * Create a new Modal instance.
	 *
	 * @param string $name       The name of Modal to create
	 * @param array $attributes An array of attributes for the current Modal
	 *
	 * @return Modal
	 */
	public static function create($name = null, $attributes = null)
	{
		// Fetch current instance
		$instance = new Modal;

		if (!is_null($name) && is_string($name)) {
			$instance->name = $name;
		}

		if (is_null($attributes) || !is_array($attributes)) {
			$attributes = array();
		}
		//data-remote="/mmfansler/aQ3Ge/show/"

		$defaultAttributes['class'] = 'modal hide fade';
		$defaultAttributes['tabindex'] = '-1';
		$defaultAttributes['role'] = 'dialog';
		$defaultAttributes['aria-labelledby'] = $instance->name;
		$defaultAttributes['aria-hidden'] = 'true';

		if (!is_null($attributes)) 
			$instance->attributes = array_merge($defaultAttributes, $attributes);

		return $instance;
	}

	/**
	 * Add elements or strings to the current Modal Header
	 *
	 * @param mixed $header      An array of items or a string
	 * @return Modal
	 */
	public function with_data_remote($remote_url)
	{
		if (is_string($remote_url)) 
			$this->attributes['data-remote'] = $remote_url;

		return $this;
	}

	/**
	 * Add elements or strings to the current Modal Header
	 *
	 * @param mixed $header      An array of items or a string
	 * @return Modal
	 */
	public function with_header($header)
	{
			if (is_string($header) and strpos($header, '<')!=='0')
			$header = '<H3>' . $header . '<H3>';
		$this->headers = (array)$header;
		return $this;
	}

	/**
	 * Add elements to the current Modal Header
	 *
	 * @param array $header      An array of items
	 * @return Modal
	 */
	public function add_headers($header)
	{
		if (is_string($header)) 
			$this->headers[] = $header;

		return $this;
	}

	/**
	 * Add elements or strings to the current Modal body
	 *
	 * @param mixed $body      An array of items or a string
	 * @return Modal
	 */
	public function with_body($body)
	{
		$this->bodies = (array)$body;
		return $this;
	}

	/**
	 * Add elements to the current Modal Header
	 *
	 * @param array $header      An array of items
	 * @return Modal
	 */
	public function add_body($body)
	{
		if (is_string($body)) 
			$this->bodies[] = $body;

		return $this;
	}

	/**
	 * Add array or strings to the current Modal Footer
	 *
	 * @param mixed $footer      An array of items or a string
	 * @return Modal
	 */
	public function with_footer($footer)
	{
		$this->footers = (array)$footer;
		return $this;
	}

	/**
	 * Add elements to the current Modal footer
	 *
	 * @param array $footer      An array of items
	 * @return Modal
	 */
	public function add_footers($footers)
	{
		if (is_string($footer)) 
			$this->footers[] = $footer;

		return $this;
	}

	/**
	 * Prints out the current Modal in case it doesn't do it automatically
	 *
	 * @return string A Modal
	 */
	public function get()
	{
		return static::__toString();
	}

	/**
	 * Create a simple button that launches the Modal.show()
	 *
	 * @param string $button_text       The button's text
	 * @param array $attributes         An array of attributes for the current button
	 * @return string                   A button to use as launcher
	 */
	public function get_launch_button($button_text, $attributes = null)
	{
		$defaultAttributes = array(
			'class'=>"btn", 
			'role'=>"button", 
			'type'=>"button", 
			'data-toggle'=>"modal", 
			'data-target'=>"#".$this->name
			);
		if (is_array($attributes)) {
			$defaultAttributes = array_merge($defaultAttributes, $attributes);
		}
		$html  = '<button'.HTML::attributes($defaultAttributes).'>'.$button_text.'</button>';
		return $html;
	}

	/**
	 * Create a simple <anchor> that launches the Modal.show()
	 *
	 * @param string $button_text       The anchor's text
	 * @param array $attributes         An array of attributes for the current anchor
	 * @return string                   An anchor to use as launcher
	 */
	public function get_launch_anchor($a_text, $attributes = null)
	{
		$defaultAttributes = array(
			'role'=>"button", 
			'data-toggle'=>"modal", 
			'data-target'=>"#".$this->name
			);
		if (is_array($attributes)) {
			$defaultAttributes = array_merge($defaultAttributes, $attributes);
		}

		$html  = '<a href="#"'.HTML::attributes($defaultAttributes).'>'.$a_text.'</a>';
		return $html;
	}

	/**
	 * get the attributes for launcher
	 *
	 * @param array $attributes         An array of attributes for the current anchor
	 * @return array                   An anchor to use as launcher
	 */
	public function get_launcher_attributes($attributes = null)
	{
		$defaultAttributes = array();
		$defaultAttributes['role'] = "button";
		$defaultAttributes['data-toggle'] = "modal";
		$defaultAttributes['data-target'] = '#'.$this->name;
		if (is_array($attributes)) {
			$defaultAttributes += $attributes;
		}
		return $defaultAttributes;
	}

	/**
	 * Writes the current Modal
	 *
	 * @return string A Bootstrap Modal
	 */
	public function __toString()
	{
		// Open Modal containers
		$html  = '<div id="'.$this->name.'"'.HTML::attributes($this->attributes).'>';

		$html .= '<div class="modal-header">';
		if ($this->autoclose) {
			$html .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
		}
		if ($this->headers)
			$html .= implode(PHP_EOL, $this->headers);
		$html .= '</div>';

		$html .= '<div class="modal-body">';
		if ($this->bodies)
			$html .= implode(PHP_EOL, $this->bodies);
		$html .= '</div>';

		$hasfooter = true;
		$footerdiv = '<div class="modal-footer">';
		if ($this->footers)
			$footerdiv .= implode(PHP_EOL, $this->footers);
		else if ($this->autofooter)
				$footerdiv .= '<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>';
		else
			$hasfooter = false;
		$footerdiv .= '</div>';
		
		if ($hasfooter) $html .= $footerdiv;

		// Close Modal containers
		$html .= '</div>';

		return $html;
	}
}

<?php
namespace Bootstrapper;

/*  USAGE
{{Form::control_group(Form::label('birthDate', 'Birth Date'), Form::append(Bootstrapper\Editable::create('birthDate')->get_as_input(), '<i class="icon-calendar"></i>'))}}
{{Form::control_group(Form::label('birthDate', 'Birth Date'), Form::append(Bootstrapper\Editable::create('birthDate')->with_language('it')->with_options("startView:2,other:1")->get_as_input(), '<i class="icon-calendar"></i>'))}}

{{Bootstrapper\Editable::create('birthDate2')->get_as_group('Date as group', 'birthDateValue2')}}

{{Form::control_group(Form::label('birthDate3', 'Birth Date'), Form::append(Form::text('birthDate3'), Bootstrapper\Editable::create('birthDateIcon')->get_as_icon()))}}
*/

/**
 * Editable for creating Twitter Bootstrap Editable.
 *
 * @category   HTML/UI
 * @package    Enhanced Laravel Twitter Bootstrap Bundle
 * @author     Pasquale Vazzana - <pasqualevazzana@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       https://github.com/Pasvaz/bootstrapper
 *
 * @see        https://github.com/Pasvaz/bootstrapper
 */
class Editable
{
    const INLINE_MODE = 'inline';
    const POPUP_MODE = 'popup';

	private static $editable_mode = Editable::POPUP_MODE;

	/**
	 * Set the editable default mode
	 *
	 * @param string $mode       The name of Editable to create
	 *
	 * @return void
	 */
	public static function set_mode($mode = null)
	{
		if (!is_null($mode) and is_string($mode))
			$editable_mode = $mode;

		Javascripter::add_js_snippet('$.fn.editable.defaults.mode = "'.$editable_mode.'";');
		static::load_assets();
	}

	private static function load_assets()
	{
		$loaded = array_key_exists('script', \Asset::container('bootstrapper-dynamic')->bundle('bootstrapper')->assets)
			and array_key_exists('editable-js', \Asset::container('bootstrapper-dynamic')->bundle('bootstrapper')->assets['script']);
		if (!$loaded)
		{
			\Asset::container('bootstrapper-dynamic')
			->bundle('bootstrapper')
			->add('bootstrap-editable',           'css/bootstrap-editable.css')
			->add('bootstrap-editable-js',        'js/bootstrap-editable.js');
		}
	}

	/**
	 * Create a new Editable instance.
	 *
	 * @param string $name       The name of Editable to create
	 * @param array $options An array of options for the current Editable
	 *
	 * @return void
	 */
	public static function create($name = null, $selector = null, $options = null)
	{
		if (is_null($options) or !is_array($options))
		{
			$options = array();
		}

		if (!is_null($selector) and is_string($selector))
		{
			$options['selector'] = $selector;
		}

		$opt = '';
		foreach ($options as $key => $value) {
			$opt .="$key: $value,";
		}
		if ($opt) $opt = '{'.rtrim($opt, ',').'}';
		Javascripter::add_js_snippet(sprintf('$("#%s").editable(%s);', $name, $opt));

		static::load_assets();
	}
}

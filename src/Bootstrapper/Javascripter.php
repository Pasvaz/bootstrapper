<?php
namespace Bootstrapper;

use \HTML;

/**
 * Helper that injects the javascript necessary to run the elements for this session
 *
 * @category   HTML/UI
 * @package    Enhanced Laravel Twitter Bootstrap Bundle
 * @author     Pasquale Vazzana - <pasqualevazzana@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       https://github.com/Pasvaz/bootstrapper
 *
 * @see        https://github.com/Pasvaz/bootstrapper
 */
class Javascripter
{

    /**
     * @var array 	Javascript code queue
     */
    static private $injector = array();

    /**
     * @var array   Javascript script queue
     */
    static private $file_injector = array();

    /**
     * add a Javascript snipper into the queue
     */
    public static function add_js_snippet($jscode)
    {
        if ($jscode == null || is_null($jscode)) return;

        if (is_string($jscode)) {
        	if (in_array($jscode, static::$injector))
        		return;
        	else
        		static::$injector[] = $jscode;
        }
        else if (is_array($jscode)) {
        	static::$injector += $jscode;
        }
    }

    /**
     * add a Javascript script to the page
     */
    public static function add_js_script($jsscript)
    {
        if ($jsscript == null || is_null($jsscript)) return;

        if (is_string($jsscript)) {
            if (in_array($jsscript, static::$file_injector))
                return;
            else
                static::$file_injector[] = $jsscript;
        }
        else if (is_array($jsscript)) {
            static::$file_injector += $jsscript;
        }
    }

    /**
     * create the javascript snippet
     * @return string 	The Javascript code
     */
    public static function write_javascript($empty = false)
    {
        $js_code  = PHP_EOL;

        if (!empty(static::$file_injector)) {
            foreach (static::$file_injector as $jsscript) {
                if (is_string($jsscript))
                    $js_code .= '<script type="text/javascript" src="'.$jsscript.'"></script>'.PHP_EOL;
            }
        }

        $js_code .= '<script type="text/javascript">'.PHP_EOL;
        $js_code .= '$(document).ready(function (){'.PHP_EOL;

        if (!empty(static::$injector)) {
            foreach (static::$injector as $snippet) {
        		if (is_string($snippet))
                	$js_code .= $snippet.PHP_EOL;
            }
        }

        $js_code .= '});</script>'.PHP_EOL;

		if ($empty) static::$injector = array();
        return $js_code;
    }
}
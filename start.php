<?php

/**
 * Bootstrapper for creating Twitter Bootstrap markup.
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Pasquale Vazzana - <pasqualevazzana@gmail.com>
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see        http://twitter.github.com/bootstrap/
 */

// Autoload Boostrapper
Autoloader::namespaces(
    array('Bootstrapper' => Bundle::path('bootstrapper') . 'src' .DS. 'Bootstrapper')
);

// Define main assets
Asset::container('bootstrapper')
    ->bundle('bootstrapper')
    ->add('bootstrap',            'css/bootstrap.min.css')
    ->add('font-awesome',         'css/font-awesome.css')
    ->add('nav-fix',              'css/nav-fix.css')
    ->add('bootstrap-responsive', 'css/bootstrap-responsive.min.css')
    ->add('jquery',               'js/jquery-1.8.3.min.js')
    ->add('bootstrap-js',         'js/bootstrap.min.js', 'jquery');

// Define unminified version of the assets
Asset::container('bootstrapper-unminified')
    ->bundle('bootstrapper')
    ->add('bootstrap',            'css/bootstrap.css')
    ->add('font-awesome',         'css/font-awesome.css')
    ->add('nav-fix',              'css/nav-fix.css')
    ->add('bootstrap-responsive', 'css/bootstrap-responsive.css')
    ->add('jquery',               'js/jquery-1.8.3.js')
    ->add('bootstrap-js',         'js/bootstrap.js', 'jquery');

/**
 * Define datepicker
 *
 * You don't need to manually add this to your pages
 * When you use Datepicker.create it takes care of it
 *
 */
Asset::container('bootstrapper-datepicker')
    ->bundle('bootstrapper')
    ->add('datepicker',           'css/datepicker.css')
    ->add('datepicker-js',        'js/bootstrap-datepicker.js');

Asset::container('bootstrapper-gallery')
	->bundle('bootstrapper')
	->add('bootstrap-gallery-css',	'css/bootstrap-image-gallery.min.css')
    ->add('load-image',				'js/load-image.min.js')
	->add('bootstrap-gallery',		'js/bootstrap-image-gallery.min.js');

// Define editable
Asset::container('bootstrapper-x-editable')
    ->bundle('bootstrapper')
    ->add('bootstrap-editable',           'css/bootstrap-editable.css')
    ->add('bootstrap-editable-js',        'js/bootstrap-editable.js');

// Prevent the need for modifying config/application.php
// $custom_aliases = array(
//     'Alert'          => 'Bootstrapper\\Alert',
//     'Badge'          => 'Bootstrapper\\Badge',
//     'Breadcrumb'     => 'Bootstrapper\\Breadcrumb',
//     'Button'         => 'Bootstrapper\\Button',
//     'ButtonGroup'    => 'Bootstrapper\\ButtonGroup',
//     'ButtonToolbar'  => 'Bootstrapper\\ButtonToolbar',
//     'Carousel'       => 'Bootstrapper\\Carousel',
//     'DropdownButton' => 'Bootstrapper\\DropdownButton',
//     'Form'           => 'Bootstrapper\\Form',
//     'Helpers'        => 'Bootstrapper\\Helpers',
//     'Icon'           => 'Bootstrapper\\Icon',
//     'Image'          => 'Bootstrapper\\Image',
//     'Label'          => 'Bootstrapper\\Label',
//     'MediaObject'    => 'Bootstrapper\\MediaObject',
//     'Navbar'         => 'Bootstrapper\\Navbar',
//     'Navigation'     => 'Bootstrapper\\Navigation',
//     'Paginator'      => 'Bootstrapper\\Paginator',
//     'Progress'       => 'Bootstrapper\\Progress',
//     'Tabbable'       => 'Bootstrapper\\Tabbable',
//     'Table'          => 'Bootstrapper\\Table',
//     'Thumbnail'      => 'Bootstrapper\\Thumbnail',
//     'Typeahead'      => 'Bootstrapper\\Typeahead',
//     'Typography'     => 'Bootstrapper\\Typography',
// );

// $laravel_aliases = Laravel\Autoloader::$aliases;
// Laravel\Autoloader::$aliases = array_merge($laravel_aliases, $custom_aliases);

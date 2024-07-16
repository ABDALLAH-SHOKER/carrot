<?php
/**
 * TCPDF - PHP class for PDF
 *
 * @package    TCPDF
 * @version    6.4.0
 * @author     Nicola Asuni
 * @copyright  Copyright (c) 2002-2020 Nicola Asuni - Tecnick.com LTD
 * @license    http://www.gnu.org/copyleft/lesser.html LGPL
 * @link       https://tcpdf.org/
 *
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU Lesser General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 * TCPDF is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along with TCPDF.  If not, see <http://www.gnu.org/licenses/>.
 */

// Check TCPDF version.
define('TCPDF_VERSION', '6.4.0');
define('TCPDF_PARSER_VERSION', '1.0.0');

// Check PHP version.
if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    die('TCPDF requires PHP version 5.5 or higher.');
}

// Autoload TCPDF dependencies using Composer.
if (!@include_once __DIR__ . '/vendor/autoload.php') {
    die('TCPDF: Unable to autoload dependencies using Composer autoloader.');
}

// Check if TCPDF_COLORS is defined.
if (!defined('TCPDF_COLORS')) {
    define('TCPDF_COLORS', false);
}

// TCPDF configuration
if (!defined('K_TCPDF_EXTERNAL_CONFIG')) {
    define('K_TCPDF_EXTERNAL_CONFIG', false);
}

if (!defined('K_PATH_MAIN')) {
    define('K_PATH_MAIN', __DIR__ . DIRECTORY_SEPARATOR);
}

if (!defined('K_PATH_URL')) {
    define('K_PATH_URL', '');
}

if (!defined('K_PATH_FONTS')) {
    define('K_PATH_FONTS', K_PATH_MAIN . 'fonts' . DIRECTORY_SEPARATOR);
}

if (!defined('K_PATH_CACHE')) {
    define('K_PATH_CACHE', K_PATH_MAIN . 'cache' . DIRECTORY_SEPARATOR);
}

if (!defined('K_PATH_IMAGES')) {
    define('K_PATH_IMAGES', K_PATH_MAIN . 'images' . DIRECTORY_SEPARATOR);
}

if (!defined('K_BLANK_IMAGE')) {
    define('K_BLANK_IMAGE', '_blank.png');
}

if (!defined('PDF_PAGE_FORMAT')) {
    define('PDF_PAGE_FORMAT', 'A4');
}

if (!defined('PDF_PAGE_ORIENTATION')) {
    define('PDF_PAGE_ORIENTATION', 'P');
}

if (!defined('PDF_CREATOR')) {
    define('PDF_CREATOR', 'TCPDF');
}

if (!defined('PDF_AUTHOR')) {
    define('PDF_AUTHOR', 'TCPDF');
}

if (!defined('PDF_HEADER_TITLE')) {
    define('PDF_HEADER_TITLE', '');
}

if (!defined('PDF_HEADER_STRING')) {
    define('PDF_HEADER_STRING', '');
}

if (!defined('PDF_UNIT')) {
    define('PDF_UNIT', 'mm');
}

if (!defined('PDF_MARGIN_HEADER')) {
    define('PDF_MARGIN_HEADER', 5);
}

if (!defined('PDF_MARGIN_FOOTER')) {
    define('PDF_MARGIN_FOOTER', 10);
}

if (!defined('PDF_MARGIN_TOP')) {
    define('PDF_MARGIN_TOP', 27);
}

if (!defined('PDF_MARGIN_BOTTOM')) {
    define('PDF_MARGIN_BOTTOM', 25);
}

if (!defined('PDF_MARGIN_LEFT')) {
    define('PDF_MARGIN_LEFT', 15);
}

if (!defined('PDF_MARGIN_RIGHT')) {
    define('PDF_MARGIN_RIGHT', 15);
}

if (!defined('PDF_FONT_NAME_MAIN')) {
    define('PDF_FONT_NAME_MAIN', 'helvetica');
}

if (!defined('PDF_FONT_SIZE_MAIN')) {
    define('PDF_FONT_SIZE_MAIN', 10);
}

if (!defined('PDF_FONT_NAME_DATA')) {
    define('PDF_FONT_NAME_DATA', 'helvetica');
}

if (!defined('PDF_FONT_SIZE_DATA')) {
    define('PDF_FONT_SIZE_DATA', 8);
}

if (!defined('PDF_FONT_MONOSPACED')) {
    define('PDF_FONT_MONOSPACED', 'courier');
}

if (!defined('PDF_IMAGE_SCALE_RATIO')) {
    define('PDF_IMAGE_SCALE_RATIO', 1.25);
}

if (!defined('HEAD_MAGNIFICATION')) {
    define('HEAD_MAGNIFICATION', 1.1);
}

if (!defined('K_CELL_HEIGHT_RATIO')) {
    define('K_CELL_HEIGHT_RATIO', 1.25);
}

if (!defined('K_TITLE_MAGNIFICATION')) {
    define('K_TITLE_MAGNIFICATION', 1.3);
}

if (!defined('K_SMALL_RATIO')) {
    define('K_SMALL_RATIO', 0.66666666666667);
}

if (!defined('K_THAI_TOPCHARS')) {
    define('K_THAI_TOPCHARS', true);
}

if (!defined('K_TCPDF_CALLS_IN_HTML')) {
    define('K_TCPDF_CALLS_IN_HTML', false);
}

if (!defined('K_TCPDF_THROW_EXCEPTION_ERROR')) {
    define('K_TCPDF_THROW_EXCEPTION_ERROR', false);
}

if (!defined('K_LANGUAGE')) {
    define('K_LANGUAGE', 'en');
}

// Load configuration files
require_once(__DIR__ . '/config/lang/eng.php');
require_once(__DIR__ . '/config/tcpdf_config.php');

// TCPDF class
require_once(__DIR__ . '/tcpdf/tcpdf.php');

// TCPDF fonts definition
require_once(__DIR__ . '/config/tcpdf_fonts.php');

// TCPDF static methods
require_once(__DIR__ . '/include/tcpdf_static.php');

// End of TCPDF configuration
?>

<?php
/**
 * TCPDF include file for TCPDF inclusions and setup.
 *
 * @package    TCPDF
 * @subpackage include
 * @author     Nicola Asuni
 * @since      2004-10-27
 * @version    6.4.0
 * @copyright  Copyright (c) 2002-2020 Nicola Asuni - Tecnick.com LTD
 *
 * === BEGIN LICENSE ===
 *
 * GNU Lesser General Public License
 * More information can be found at <http://www.gnu.org/licenses/lgpl-3.0.html>
 *
 * TCPDF is free software: you can redistribute it and/or modify it under the terms of the
 * GNU Lesser General Public License as published by the Free Software Foundation,
 * either version 3 of the License, or (at your option) any later version.
 *
 * TCPDF is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with TCPDF. If not, see <http://www.gnu.org/licenses/>.
 *
 * See LICENSE.TXT file for more information.
 *
 * === END LICENSE ===
 */

/**
 * Include the TCPDF class.
 */
require_once('tcpdf.php');

/**
 * Include the TCPDF configuration file.
 */
require_once('config/tcpdf_config.php');

/**
 * Include the TCPDF fonts configuration file.
 */
require_once('config/tcpdf_fonts.php');

/**
 * Include the TCPDF barcode library.
 */
require_once('include/tcpdf_barcode_2d.php');

/**
 * Include the TCPDF barcode write library.
 */
require_once('include/tcpdf_barcode.php');

/**
 * Include the TCPDF unicode utilities.
 */
require_once('include/tcpdf_static.php');

/**
 * Include the TCPDF fonts utilities.
 */
require_once('include/tcpdf_font_data.php');
require_once('include/tcpdf_font.php');

/**
 * Include the TCPDF PNG alpha channel library.
 */
require_once('include/png_alpha.php');

/**
 * Include the TCPDF text utilities.
 */
require_once('include/tcpdf_text.php');

/**
 * Include the TCPDF glyph utilities.
 */
require_once('include/tcpdf_glyph.php');

/**
 * Include the TCPDF font subsetting library.
 */
require_once('include/tcpdf_fontsubset.php');

/**
 * Include the TCPDF color utilities.
 */
require_once('include/tcpdf_colors.php');

/**
 * Include the TCPDF image utilities.
 */
require_once('include/tcpdf_images.php');

/**
 * Include the TCPDF template processing library.
 */
require_once('include/tcpdf_templates.php');

/**
 * Include the TCPDF parser utilities.
 */
require_once('include/tcpdf_parser.php');

/**
 * Include the TCPDF parser barcode library.
 */
require_once('include/tcpdf_parser_barcode.php');

/**
 * Include the TCPDF unicode data library.
 */
require_once('include/tcpdf_unicode_data.php');

/**
 * Include the TCPDF unicode CJK decomposition data library.
 */
require_once('include/tcpdf_unicode_cjk.php');

/**
 * Include the TCPDF utilities.
 */
require_once('include/tcpdf_tools.php');

/**
 * Include the TCPDF methods.
 */
require_once('methods/tcpdf_methods.php');

/**
 * Include the TCPDF JPEG image class.
 */
require_once('include/jpeg_quality.php');

/**
 * Include the TCPDF SVG class.
 */
require_once('include/svg.php');

/**
 * Include the TCPDF barcode class.
 */
require_once('include/barcode.php');

/**
 * Include the TCPDF barcode 1D class.
 */
require_once('include/barcode_1d.php');

/**
 * Include the TCPDF barcode 2D class.
 */
require_once('include/barcode_2d.php');

/**
 * Include the TCPDF TCPDF2DBarcode class.
 */
require_once('include/barcode_2d.php');

/**
 * Include the TCPDF write barcode class.
 */
require_once('include/barcode_write.php');

/**
 * Include the TCPDF QRcode class.
 */
require_once('include/qrcode.php');

/**
 * Include the TCPDF qrcode writer class.
 */
require_once('include/qrcode_2d.php');

/**
 * Include the TCPDF barcode class.
 */
require_once('include/barcode_class.php');

/**
 * Include the TCPDF pdf417 class.
 */
require_once('include/pdf417_class.php');

/**
 * Include the TCPDF tag library.
 */
require_once('include/tcpdf_tags.php');

/**
 * Include the TCPDF cache class.
 */
require_once('include/tcpdf_cache.php');

/**
 * Include the TCPDF cache class.
 */
require_once('include/tcpdf_mcrypt.php');

<?php defined('BASEPATH') OR exit('No direct script access allowed');

//require_once APPPATH.'third_party/dompdf/autoload.inc.php';
require_once(APPPATH.'third_party\dompdf2\dompdf_config.inc.php');

class Pdf extends DOMPDF
{
	public function exportPDF($html,$filename)
	{
	    $domdpf = new DOMPDF();
	    $domdpf -> load_html($html);
	    $domdpf -> set_paper('A4','Landscape');
	    $domdpf ->render();
	    $domdpf ->stream($filename);
	}
}
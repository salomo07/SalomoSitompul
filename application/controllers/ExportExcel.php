<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExportExcel extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library('excel');
        $this->load->model('m_BC');
        $this->load->model('m_mutasi');
    }
    function exportPreviewTransaksi()
    {
        $jenis= $this->input->post('jenis');
        $priode= $this->input->post('priode');
        $bcTerpilih= $this->input->post('bcTerpilih');
        $bcTerpilih= json_decode($bcTerpilih);//print_r($bcTerpilih);
        if($jenis!=''&&$priode!=''&&$bcTerpilih!='')
        {
            $this->session->set_userdata('dataJenisReport',$jenis);
            $this->session->set_userdata('dataPriodeReport',$priode);
            $this->session->set_userdata('dataBCTerpilih',$bcTerpilih);      
        }
        $jenis=$this->session->userdata('dataJenisReport');
        $priode=$this->session->userdata('dataPriodeReport');
        $bcTerpilih=$this->session->userdata('dataBCTerpilih');
        
        $xxx='';
        if(strpos(strtoupper($jenis), 'IN') !== false || strpos(strtoupper($jenis), 'FTZ') !== false)
        {$xxx='PEMASUKAN';}
        elseif(strpos(strtoupper($jenis), 'OUT') !== false)
        {$xxx='PENGELUARAN';}
        $obj = new Excel();
        $objPHPExcel= $obj->setActiveSheetIndex(0);

        $objPHPExcel->mergeCells('B2:G5')->setCellValue('B2', "LAPORAN ".$xxx." BARANG PER DOKUMEN PABEAN\nKAWASAN BERIKAT PT.PULAU SAMBU GUNTUNG\n     PERIODE : ".$priode);
        $objPHPExcel->getStyle("B2:G5")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getStyle("B2:G5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getStyle("B2:G5")->getFont()->setBold(true);
        $objPHPExcel->getStyle('B2')->getAlignment()->setWrapText(true);

        $objPHPExcel->mergeCells('A7:A9')->setCellValue('A7', 'NO');
        $objPHPExcel->mergeCells('B7:B9')->setCellValue('B7', 'JENIS DOKUMEN'); 
        $objPHPExcel->mergeCells('C7:D8')->setCellValue('C7', 'DOKUMEN PABEAN');
        $objPHPExcel->mergeCells('E7:F8')->setCellValue('E7', 'INVOICE');
        $objPHPExcel->mergeCells('G7:H8')->setCellValue('G7', 'BL/AWB');
        $objPHPExcel->mergeCells('I7:J8')->setCellValue('I7', "BUKTI PENERIMAAN\nBARANG");
        $objPHPExcel->mergeCells('K7:K9')->setCellValue('K7', "PEMASOK/PENGIRIM");
        $objPHPExcel->mergeCells('L7:L9')->setCellValue('L7', "NOMOR\nSERI\nBARANG");
        $objPHPExcel->mergeCells('M7:M9')->setCellValue('M7', "NAMA BARANG");
        $objPHPExcel->mergeCells('N7:N9')->setCellValue('N7', "KODE HS");
        $objPHPExcel->mergeCells('O7:O9')->setCellValue('O7', "TARIF");
        $objPHPExcel->mergeCells('P7:P9')->setCellValue('P7', "SATUAN");
        $objPHPExcel->mergeCells('Q7:Q9')->setCellValue('Q7', "JUMLAH");
        $objPHPExcel->mergeCells('R7:R9')->setCellValue('R7', "VALAS");
        $objPHPExcel->mergeCells('S7:S9')->setCellValue('S7', "CIF");
        $objPHPExcel->mergeCells('T7:T9')->setCellValue('T7', "NILAI\nPABEAN/ \nPENYERAHAN");
        $objPHPExcel->mergeCells('U7:U9')->setCellValue('U7', "TOTAL,BM\nCUKAI+PDRI\nBAYAR");
        $objPHPExcel->mergeCells('V7:V9')->setCellValue('V7', "TOTAL,BM\nCUKAI+PDRI\nBEBAS");
        $objPHPExcel->mergeCells('W7:W9')->setCellValue('W7', "KETERANGAN");
        $objPHPExcel->setCellValue('C9', 'NOMOR');$objPHPExcel->setCellValue('D9', 'TANGGAL');
        $objPHPExcel->setCellValue('E9', 'NOMOR');$objPHPExcel->setCellValue('F9', 'TANGGAL');
        $objPHPExcel->setCellValue('G9', 'NOMOR');$objPHPExcel->setCellValue('H9', 'TANGGAL');
        $objPHPExcel->setCellValue('I9', 'NOMOR');$objPHPExcel->setCellValue('J9', 'TANGGAL');
        $nourut=1;$index=10;

        $borderall = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderRight =array('borders' => array('right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderLeftRight =array('borders' => array('left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderOutline =array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

        $headerStyle = new PHPExcel_Style();
        $headerStyle->applyFromArray(array
        ('fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('argb' => 'FFFFFFFF')
        ),
        'font' => array(
            'bold' => true),
        'numberformat' => array(
            'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'wrap' => true
        ),
            )
        );

        foreach ($bcTerpilih as $key => $value) 
        {            
            $xxx=$this->m_BC->getBCbyID($value->IdBC);//print_r($xxx);
            $jenis='';
            if(strpos(strtoupper($xxx->JenisBC), 'IN') !== false){$jenis= str_replace('IN', ' ',$xxx->JenisBC);$jenis=substr_replace($jenis, '.', 4, 0);}
            if(strpos(strtoupper($xxx->JenisBC), 'OUT') !== false){$jenis= str_replace('OUT', ' ',$xxx->JenisBC);$jenis=substr_replace($jenis, '.', 4, 0);}
            if(strpos(strtoupper($xxx->JenisBC), 'FTZ') !== false){$jenis=substr_replace($jenis, ' ', 3, 0);}


            $jumlahz='';if($xxx->Qty!=null||$xxx->Qty!=''){$jumlahz=number_format($xxx->Qty, 4, ',', '.');}
            $cifz='';if($xxx->CIF!=null||$xxx->CIF!=''){$cifz=number_format($xxx->CIF, 2, ',', '.');}
            $tot='';if($xxx->Total!=null||$xxx->Total!=''){$tot=number_format($xxx->Total, 2, ',', '.');}
            $bayar='';if($xxx->PDRIBayar!=null||$xxx->PDRIBayar!=''){$bayar=number_format($xxx->PDRIBayar, 2, ',', '.');}
            $bebas='';if($xxx->PDRIBebas!=null||$xxx->PDRIBebas!=''){$bebas=number_format($xxx->PDRIBebas, 2, ',', '.');}

            $objPHPExcel->setCellValue('A'.$index, $nourut);
            $objPHPExcel->setCellValue('B'.$index, $jenis);
            $objPHPExcel->setCellValue('C'.$index, $xxx->NoPabean);
            $objPHPExcel->setCellValue('D'.$index,str_replace(' ', '', $xxx->TanggalPabean));
            $objPHPExcel->setCellValue('E'.$index, $xxx->NoInvoice);
            $objPHPExcel->setCellValue('F'.$index,str_replace(' ', '', $xxx->TanggalInvoice));
            $objPHPExcel->setCellValue('G'.$index, $xxx->NoBL);
            $objPHPExcel->setCellValue('H'.$index,str_replace(' ', '', $xxx->TanggalBL));
            $objPHPExcel->setCellValue('I'.$index, $xxx->NoNota);
            $objPHPExcel->setCellValue('J'.$index,str_replace(' ', '', $xxx->TanggalNota));
            $objPHPExcel->setCellValue('K'.$index, $xxx->Pemasok);
            $objPHPExcel->setCellValue('L'.$index, $xxx->KodeBarang);
            $objPHPExcel->setCellValue('M'.$index, $xxx->NamaBarang);
            $objPHPExcel->setCellValue('N'.$index, $xxx->KodeHS);
            $objPHPExcel->setCellValue('O'.$index, $xxx->Tarif);
            $objPHPExcel->setCellValue('P'.$index, $xxx->Sat);
            $objPHPExcel->setCellValue('Q'.$index, $jumlahz);
            $objPHPExcel->setCellValue('R'.$index, $xxx->Valas);
            $objPHPExcel->setCellValue('S'.$index, $cifz);
            $objPHPExcel->setCellValue('T'.$index, $tot);
            $objPHPExcel->setCellValue('U'.$index, $bayar);
            $objPHPExcel->setCellValue('V'.$index, $bebas);
            $nourut++;$index++;
        }

        $objPHPExcel->getStyle('I7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('L7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('T7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('U7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('V7')->getAlignment()->setWrapText(true);

        $objPHPExcel->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getColumnDimension('E')->setWidth(10);
        $objPHPExcel->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getColumnDimension('I')->setWidth(13);
        $objPHPExcel->getColumnDimension('J')->setWidth(13);
        $objPHPExcel->getColumnDimension('K')->setWidth(27.5);
        $objPHPExcel->getColumnDimension('L')->setWidth(14);        
        $objPHPExcel->getColumnDimension('M')->setWidth(28);
        $objPHPExcel->getColumnDimension('T')->setWidth(18);
        $objPHPExcel->getColumnDimension('U')->setWidth(18);
        $objPHPExcel->getColumnDimension('V')->setWidth(18);
        $objPHPExcel->getColumnDimension('W')->setWidth(18);

        $objPHPExcel->getStyle("A7:W9")->getFont()->setBold(true);
        $objPHPExcel->getStyle('A7:W9')->applyFromArray($borderall);
        $objPHPExcel->getStyle('A10:A'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('B10:B'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('C10:C'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('D10:D'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('E10:E'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('F10:F'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('G10:G'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('H10:H'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('I10:I'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('J10:J'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('K10:K'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('L10:L'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('M10:M'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('N10:N'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('O10:O'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('P10:P'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('Q10:Q'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('R10:R'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('S10:S'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('T10:T'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('U10:U'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('V10:V'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('W10:W'.($index-1))->applyFromArray($borderOutline);

        $objPHPExcel->getStyle("A7:W9")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getStyle("A7:W9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        header('Content-Type: text/html; charset=utf-8');
        header('Content-type: application/vnd.ms-excel');
        $filename='Preview '.$jenis.' ('.$priode.').xls';
        header('Content-Disposition: attachment;filename='.$filename);
        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }
    function exportApproveTransaksi()
    {
        $jenis= $this->input->post('jenis');
        $priode= $this->input->post('priode');
        $bcTerpilih= $this->input->post('bcTerpilih');
        $deptname= $this->input->post('deptname');
        $bcTerpilih= json_decode($bcTerpilih);
        if($jenis!=''&&$priode!=''&&$bcTerpilih!='')
        {
            $this->session->set_userdata('dataJenisReport',$jenis);
            $this->session->set_userdata('dataPriodeReport',$priode);
            $this->session->set_userdata('dataBCTerpilih',$bcTerpilih);      
        }
        $jenis=$this->session->userdata('dataJenisReport');
        $priode=$this->session->userdata('dataPriodeReport');
        $bcTerpilih=$this->session->userdata('dataBCTerpilih');
        
        $xxx='';
        if(strpos(strtoupper($jenis), 'IN') !== false || strpos(strtoupper($jenis), 'FTZ') !== false)
        {$xxx='PEMASUKAN';}
        elseif(strpos(strtoupper($jenis), 'OUT') !== false)
        {$xxx='PENGELUARAN';}
        $obj = new Excel();
        $objPHPExcel= $obj->setActiveSheetIndex(0);

        $objPHPExcel->mergeCells('B2:G5')->setCellValue('B2', "LAPORAN ".$xxx." BARANG PER DOKUMEN PABEAN\nKAWASAN BERIKAT PT.PULAU SAMBU GUNTUNG\n     PERIODE : ".$priode);
        $objPHPExcel->getStyle("B2:G5")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getStyle("B2:G5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getStyle("B2:G5")->getFont()->setBold(true);
        $objPHPExcel->getStyle('B2')->getAlignment()->setWrapText(true);

        $objPHPExcel->mergeCells('A7:A9')->setCellValue('A7', 'NO');
        $objPHPExcel->mergeCells('B7:B9')->setCellValue('B7', 'JENIS DOKUMEN'); 
        $objPHPExcel->mergeCells('C7:D8')->setCellValue('C7', 'DOKUMEN PABEAN');
        $objPHPExcel->mergeCells('E7:F8')->setCellValue('E7', 'INVOICE');
        $objPHPExcel->mergeCells('G7:H8')->setCellValue('G7', 'BL/AWB');
        $objPHPExcel->mergeCells('I7:J8')->setCellValue('I7', "BUKTI PENERIMAAN\nBARANG");
        $objPHPExcel->mergeCells('K7:K9')->setCellValue('K7', "PEMASOK/PENGIRIM");
        $objPHPExcel->mergeCells('L7:L9')->setCellValue('L7', "NOMOR\nSERI\nBARANG");
        $objPHPExcel->mergeCells('M7:M9')->setCellValue('M7', "NAMA BARANG");
        $objPHPExcel->mergeCells('N7:N9')->setCellValue('N7', "KODE HS");
        $objPHPExcel->mergeCells('O7:O9')->setCellValue('O7', "TARIF");
        $objPHPExcel->mergeCells('P7:P9')->setCellValue('P7', "SATUAN");
        $objPHPExcel->mergeCells('Q7:Q9')->setCellValue('Q7', "JUMLAH");
        $objPHPExcel->mergeCells('R7:R9')->setCellValue('R7', "VALAS");
        $objPHPExcel->mergeCells('S7:S9')->setCellValue('S7', "CIF");
        $objPHPExcel->mergeCells('T7:T9')->setCellValue('T7', "NILAI\nPABEAN/ \nPENYERAHAN");
        $objPHPExcel->mergeCells('U7:U9')->setCellValue('U7', "TOTAL,BM\nCUKAI+PDRI\nBAYAR");
        $objPHPExcel->mergeCells('V7:V9')->setCellValue('V7', "TOTAL,BM\nCUKAI+PDRI\nBEBAS");
        $objPHPExcel->mergeCells('W7:W9')->setCellValue('W7', "KETERANGAN");
        $objPHPExcel->setCellValue('C9', 'NOMOR');$objPHPExcel->setCellValue('D9', 'TANGGAL');
        $objPHPExcel->setCellValue('E9', 'NOMOR');$objPHPExcel->setCellValue('F9', 'TANGGAL');
        $objPHPExcel->setCellValue('G9', 'NOMOR');$objPHPExcel->setCellValue('H9', 'TANGGAL');
        $objPHPExcel->setCellValue('I9', 'NOMOR');$objPHPExcel->setCellValue('J9', 'TANGGAL');
        $nourut=1;$index=10;

        $borderall = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderRight =array('borders' => array('right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderLeftRight =array('borders' => array('left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderOutline =array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

        $headerStyle = new PHPExcel_Style();
        $headerStyle->applyFromArray(array
        ('fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('argb' => 'FFFFFFFF')
        ),
        'font' => array(
            'bold' => true),
        'numberformat' => array(
            'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'wrap' => true
        ),
            )
        );

        foreach ($bcTerpilih as $key => $value) 
        {
            
            $xxx=$this->m_BC->getBCbyID($value->IdBC);//print_r($xxx);
            $jenis='';
            if(strpos(strtoupper($xxx->JenisBC), 'IN') !== false){$jenis= str_replace('IN', ' ',$xxx->JenisBC);$jenis=substr_replace($jenis, '.', 4, 0);}
            if(strpos(strtoupper($xxx->JenisBC), 'OUT') !== false){$jenis= str_replace('OUT', ' ',$xxx->JenisBC);$jenis=substr_replace($jenis, '.', 4, 0);}
            if(strpos(strtoupper($xxx->JenisBC), 'FTZ') !== false){$jenis=substr_replace($jenis, ' ', 3, 0);}


            $jumlahz='';if($xxx->Qty!=null||$xxx->Qty!=''){$jumlahz=number_format($xxx->Qty, 4, ',', '.');}
            $cifz='';if($xxx->CIF!=null||$xxx->CIF!=''){$cifz=number_format($xxx->CIF, 2, ',', '.');}
            $tot='';if($xxx->Total!=null||$xxx->Total!=''){$tot=number_format($xxx->Total, 2, ',', '.');}
            $bayar='';if($xxx->PDRIBayar!=null||$xxx->PDRIBayar!=''){$bayar=number_format($xxx->PDRIBayar, 2, ',', '.');}
            $bebas='';if($xxx->PDRIBebas!=null||$xxx->PDRIBebas!=''){$bebas=number_format($xxx->PDRIBebas, 2, ',', '.');}

            $objPHPExcel->setCellValue('A'.$index, $nourut);
            $objPHPExcel->setCellValue('B'.$index, $jenis);
            $objPHPExcel->setCellValue('C'.$index, $xxx->NoPabean);
            $objPHPExcel->setCellValue('D'.$index,str_replace(' ', '', $xxx->TanggalPabean));
            $objPHPExcel->setCellValue('E'.$index, $xxx->NoInvoice);
            $objPHPExcel->setCellValue('F'.$index,str_replace(' ', '', $xxx->TanggalInvoice));
            $objPHPExcel->setCellValue('G'.$index, $xxx->NoBL);
            $objPHPExcel->setCellValue('H'.$index,str_replace(' ', '', $xxx->TanggalBL));
            $objPHPExcel->setCellValue('I'.$index, $xxx->NoNota);
            $objPHPExcel->setCellValue('J'.$index,str_replace(' ', '', $xxx->TanggalNota));
            $objPHPExcel->setCellValue('K'.$index, $xxx->Pemasok);
            $objPHPExcel->setCellValue('L'.$index, $xxx->KodeBarang);
            $objPHPExcel->setCellValue('M'.$index, $xxx->NamaBarang);
            $objPHPExcel->setCellValue('N'.$index, $xxx->KodeHS);
            $objPHPExcel->setCellValue('O'.$index, $xxx->Tarif);
            $objPHPExcel->setCellValue('P'.$index, $xxx->Sat);
            $objPHPExcel->setCellValue('Q'.$index, $jumlahz);
            $objPHPExcel->setCellValue('R'.$index, $xxx->Valas);
            $objPHPExcel->setCellValue('S'.$index, $cifz);
            $objPHPExcel->setCellValue('T'.$index, $tot);
            $objPHPExcel->setCellValue('U'.$index, $bayar);
            $objPHPExcel->setCellValue('V'.$index, $bebas);
            $nourut++;$index++;
        }

        $objPHPExcel->getStyle('I7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('L7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('T7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('U7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('V7')->getAlignment()->setWrapText(true);

        $objPHPExcel->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getColumnDimension('E')->setWidth(10);
        $objPHPExcel->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getColumnDimension('I')->setWidth(13);
        $objPHPExcel->getColumnDimension('J')->setWidth(13);
        $objPHPExcel->getColumnDimension('K')->setWidth(27.5);
        $objPHPExcel->getColumnDimension('L')->setWidth(14);        
        $objPHPExcel->getColumnDimension('M')->setWidth(28);
        $objPHPExcel->getColumnDimension('T')->setWidth(18);
        $objPHPExcel->getColumnDimension('U')->setWidth(18);
        $objPHPExcel->getColumnDimension('V')->setWidth(18);
        $objPHPExcel->getColumnDimension('W')->setWidth(18);

        $objPHPExcel->getStyle("A7:W9")->getFont()->setBold(true);
        $objPHPExcel->getStyle('A7:W9')->applyFromArray($borderall);
        $objPHPExcel->getStyle('A10:A'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('B10:B'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('C10:C'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('D10:D'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('E10:E'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('F10:F'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('G10:G'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('H10:H'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('I10:I'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('J10:J'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('K10:K'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('L10:L'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('M10:M'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('N10:N'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('O10:O'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('P10:P'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('Q10:Q'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('R10:R'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('S10:S'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('T10:T'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('U10:U'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('V10:V'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('W10:W'.($index-1))->applyFromArray($borderOutline);

        $objPHPExcel->getStyle("A7:W9")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getStyle("A7:W9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        header('Content-Type: text/html; charset=utf-8');
        header('Content-type: application/vnd.ms-excel');
        $filename='Laporan Approval '.$deptname.' '.$jenis.' ('.$priode.').xls';
        header('Content-Disposition: attachment;filename='.$filename);
        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }
    function exportReportMutasi()
    {
        $jenis= $this->input->post('jenis');
        $start= $this->input->post('start');
        $end= $this->input->post('end');
        $mutasiTerpilih= $this->input->post('mutasiTerpilih');//print_r($mutasiTerpilih);

        $obj = new Excel();
        $objPHPExcel= $obj->setActiveSheetIndex(0);

        if($mutasiTerpilih!='')
        {
            $this->session->set_userdata('dataJenisReport',$jenis);
            $this->session->set_userdata('dataStartReport',$start);
            $this->session->set_userdata('dataEndReport',$end);
            $this->session->set_userdata('dataMutasiTerpilih',$mutasiTerpilih);      
        }
        $jenis=$this->session->userdata('dataJenisReport');
        $start=$this->session->userdata('dataStartReport');
        $end=$this->session->userdata('dataEndReport');
        $mutasiTerpilih=$this->session->userdata('dataMutasiTerpilih');//print_r($mutasiTerpilih);

        $objPHPExcel->setCellValue('A7', 'No');
        $objPHPExcel->setCellValue('B7', 'Kode Barang');
        $objPHPExcel->setCellValue('C7', 'Nama Barang');
        $objPHPExcel->setCellValue('D7', 'Satuan');
        $objPHPExcel->setCellValue('E7', 'Saldo Awal');
        $objPHPExcel->setCellValue('F7', 'Pemasukan');
        $objPHPExcel->setCellValue('G7', 'Pengeluaran');
        $objPHPExcel->setCellValue('H7', 'Penyesuaian');
        $objPHPExcel->setCellValue('I7', 'Saldo Akhir');
        $objPHPExcel->setCellValue('J7', 'Stock Opname');
        $objPHPExcel->setCellValue('K7', 'Selisih');
        $objPHPExcel->setCellValue('L7', 'Keterangan');

        $borderall = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderRight =array('borders' => array('right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderLeftRight =array('borders' => array('left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderOutline =array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

        $headerStyle = new PHPExcel_Style();
        $headerStyle->applyFromArray(array
        ('fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('argb' => 'FFFFFFFF')
        ),
        'font' => array(
            'bold' => true),
        'numberformat' => array(
            'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'wrap' => true
        ),
            )
        );
        $index=8;$nourut=1;
        foreach ($mutasiTerpilih as $key => $value) 
        {
            $objPHPExcel->setCellValue('A'.$index, $nourut);
            $objPHPExcel->setCellValue('B'.$index, $value['Kode']);
            $objPHPExcel->setCellValue('C'.$index, $value['Nama']);
            $objPHPExcel->setCellValue('D'.$index, $value['Sat']);
            $objPHPExcel->setCellValue('E'.$index, $value['SaldoAwal']);
            $objPHPExcel->setCellValue('F'.$index, $value['Pemasukan']);
            $objPHPExcel->setCellValue('G'.$index, $value['Pengeluaran']);
            $objPHPExcel->setCellValue('H'.$index, $value['Penyesuaian']);
            $objPHPExcel->setCellValue('I'.$index, $value['SaldoAkhir']);
            $objPHPExcel->setCellValue('J'.$index, $value['StockOpname']);
            $objPHPExcel->setCellValue('K'.$index, $value['Selisih']);
            $objPHPExcel->setCellValue('L'.$index, $value['Ket']);
            $index++;$nourut++;
        }

        $objPHPExcel->getStyle('A7:L7')->applyFromArray($borderall);
        $objPHPExcel->getStyle("A7:L7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getStyle('A8:A'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('B8:B'.($index-1))->applyFromArray($borderOutline);$objPHPExcel->getColumnDimension('B')->setWidth(12);
        $objPHPExcel->getStyle('C8:C'.($index-1))->applyFromArray($borderOutline);$objPHPExcel->getColumnDimension('C')->setWidth(107);
        $objPHPExcel->getStyle('D8:D'.($index-1))->applyFromArray($borderOutline);$objPHPExcel->getColumnDimension('D')->setWidth(6);
        $objPHPExcel->getStyle('E8:E'.($index-1))->applyFromArray($borderOutline);$objPHPExcel->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getStyle('F8:F'.($index-1))->applyFromArray($borderOutline);$objPHPExcel->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getStyle('G8:G'.($index-1))->applyFromArray($borderOutline);$objPHPExcel->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getStyle('H8:H'.($index-1))->applyFromArray($borderOutline);$objPHPExcel->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getStyle('I8:I'.($index-1))->applyFromArray($borderOutline);$objPHPExcel->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getStyle('J8:J'.($index-1))->applyFromArray($borderOutline);$objPHPExcel->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getStyle('K8:K'.($index-1))->applyFromArray($borderOutline);$objPHPExcel->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getStyle('L8:L'.($index-1))->applyFromArray($borderOutline);$objPHPExcel->getColumnDimension('L')->setWidth(10);
        header('Content-Type: text/html; charset=utf-8');
        header('Content-type: application/vnd.ms-excel');
        $filename='Laporan '.$jenis.' ('.$start.'-'.$end.').xls'; //echo "$filename";
        header('Content-Disposition: attachment;filename='.$filename);
        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }
    function exportReportTransaksi()
    {
        $jenis= $this->input->post('jenis');
        $priode= $this->input->post('priode');
        $bcTerpilih= $this->input->post('bcTerpilih');
        $bcTerpilih= json_decode($bcTerpilih);
        if($jenis!=''&&$priode!=''&&$bcTerpilih!='')
        {
            $this->session->set_userdata('dataJenisReport',$jenis);
            $this->session->set_userdata('dataPriodeReport',$priode);
            $this->session->set_userdata('dataBCTerpilih',$bcTerpilih);      
        }
        $jenis=$this->session->userdata('dataJenisReport');
        $priode=$this->session->userdata('dataPriodeReport');
        $bcTerpilih=$this->session->userdata('dataBCTerpilih');
        
        $xxx='';
        if(strpos(strtoupper($jenis), 'IN') !== false || strpos(strtoupper($jenis), 'FTZ') !== false)
        {$xxx='PEMASUKAN';}
        elseif(strpos(strtoupper($jenis), 'OUT') !== false)
        {$xxx='PENGELUARAN';}
        $obj = new Excel();
        $objPHPExcel= $obj->setActiveSheetIndex(0);

        $objPHPExcel->mergeCells('B2:G5')->setCellValue('B2', "LAPORAN ".$xxx." BARANG PER DOKUMEN PABEAN\nKAWASAN BERIKAT PT.PULAU SAMBU GUNTUNG\n     PERIODE : ".$priode);
        $objPHPExcel->getStyle("B2:G5")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getStyle("B2:G5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getStyle("B2:G5")->getFont()->setBold(true);
        $objPHPExcel->getStyle('B2')->getAlignment()->setWrapText(true);

        $objPHPExcel->mergeCells('A7:A9')->setCellValue('A7', 'NO');
        $objPHPExcel->mergeCells('B7:B9')->setCellValue('B7', 'JENIS DOKUMEN'); 
        $objPHPExcel->mergeCells('C7:D8')->setCellValue('C7', 'DOKUMEN PABEAN');
        $objPHPExcel->mergeCells('E7:F8')->setCellValue('E7', 'INVOICE');
        $objPHPExcel->mergeCells('G7:H8')->setCellValue('G7', 'BL/AWB');
        $objPHPExcel->mergeCells('I7:J8')->setCellValue('I7', "BUKTI PENERIMAAN\nBARANG");
        $objPHPExcel->mergeCells('K7:K9')->setCellValue('K7', "PEMASOK/PENGIRIM");
        $objPHPExcel->mergeCells('L7:L9')->setCellValue('L7', "NOMOR\nSERI\nBARANG");
        $objPHPExcel->mergeCells('M7:M9')->setCellValue('M7', "NAMA BARANG");$objPHPExcel->getColumnDimension('M')->setWidth("110");
        $objPHPExcel->mergeCells('N7:N9')->setCellValue('N7', "KODE HS");
        $objPHPExcel->mergeCells('O7:O9')->setCellValue('O7', "TARIF");
        $objPHPExcel->mergeCells('P7:P9')->setCellValue('P7', "SATUAN");
        $objPHPExcel->mergeCells('Q7:Q9')->setCellValue('Q7', "JUMLAH");
        $objPHPExcel->mergeCells('R7:R9')->setCellValue('R7', "VALAS");
        $objPHPExcel->mergeCells('S7:S9')->setCellValue('S7', "CIF");
        $objPHPExcel->mergeCells('T7:T9')->setCellValue('T7', "NILAI\nPABEAN/ \nPENYERAHAN");
        $objPHPExcel->mergeCells('U7:U9')->setCellValue('U7', "TOTAL,BM\nCUKAI+PDRI\nBAYAR");
        $objPHPExcel->mergeCells('V7:V9')->setCellValue('V7', "TOTAL,BM\nCUKAI+PDRI\nBEBAS");
        $objPHPExcel->mergeCells('W7:W9')->setCellValue('W7', "KETERANGAN");
        $objPHPExcel->setCellValue('C9', 'NOMOR');$objPHPExcel->setCellValue('D9', 'TANGGAL');
        $objPHPExcel->setCellValue('E9', 'NOMOR');$objPHPExcel->setCellValue('F9', 'TANGGAL');
        $objPHPExcel->setCellValue('G9', 'NOMOR');$objPHPExcel->setCellValue('H9', 'TANGGAL');
        $objPHPExcel->setCellValue('I9', 'NOMOR');$objPHPExcel->setCellValue('J9', 'TANGGAL');
        $nourut=1;$index=10;

        $borderall = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderRight =array('borders' => array('right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderLeftRight =array('borders' => array('left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $borderOutline =array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

        $headerStyle = new PHPExcel_Style();
        $headerStyle->applyFromArray(array
        ('fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('argb' => 'FFFFFFFF')
        ),
        'font' => array(
            'bold' => true),
        'numberformat' => array(
            'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'wrap' => true
        ),
            )
        );

        foreach ($bcTerpilih as $key => $value) 
        {
            
            //$xxx=$this->m_BC->getBCbyID($value->IdBC);
            $xxx=$this->m_BC->getBCbyBTB($value->BTBId);
            $jenis='';
            if(strpos(strtoupper($xxx->JenisBC), 'IN') !== false){$jenis= str_replace('IN', ' ',$xxx->JenisBC);$jenis=substr_replace($jenis, '.', 4, 0);}
            if(strpos(strtoupper($xxx->JenisBC), 'OUT') !== false){$jenis= str_replace('OUT', ' ',$xxx->JenisBC);$jenis=substr_replace($jenis, '.', 4, 0);}
            if(strpos(strtoupper($xxx->JenisBC), 'FTZ') !== false){$jenis=substr_replace($xxx->JenisBC, ' ', 3, 0);}


            $jumlahz='';if($xxx->Qty!=null||$xxx->Qty!=''){$jumlahz=number_format($xxx->Qty, 4, ',', '.');}
            $cifz='';if($xxx->CIF!=null||$xxx->CIF!=''){$cifz=number_format($xxx->CIF, 2, ',', '.');}
            $tot='';if($xxx->Total!=null||$xxx->Total!=''){$tot=number_format($xxx->Total, 2, ',', '.');}
            $bayar='';if($xxx->PDRIBayar!=null||$xxx->PDRIBayar!=''){$bayar=number_format($xxx->PDRIBayar, 2, ',', '.');}
            $bebas='';if($xxx->PDRIBebas!=null||$xxx->PDRIBebas!=''){$bebas=number_format($xxx->PDRIBebas, 2, ',', '.');}

            $objPHPExcel->setCellValue('A'.$index, $nourut);
            $objPHPExcel->setCellValue('B'.$index, $jenis);
            $objPHPExcel->setCellValue('C'.$index, $xxx->NoPabean);
            $objPHPExcel->setCellValue('D'.$index,str_replace(' ', '', $xxx->TanggalPabean));
            $objPHPExcel->setCellValue('E'.$index, $xxx->NoInvoice);
            $objPHPExcel->setCellValue('F'.$index,str_replace(' ', '', $xxx->TanggalInvoice));
            $objPHPExcel->setCellValue('G'.$index, $xxx->NoBL);
            $objPHPExcel->setCellValue('H'.$index,str_replace(' ', '', $xxx->TanggalBL));
            $objPHPExcel->setCellValue('I'.$index, $xxx->NoNota);
            $objPHPExcel->setCellValue('J'.$index,str_replace(' ', '', $xxx->TanggalNota));
            $objPHPExcel->setCellValue('K'.$index, $xxx->Pemasok);
            $objPHPExcel->setCellValue('L'.$index, $xxx->KodeBarang);
            $objPHPExcel->setCellValue('M'.$index, str_replace('&quot', '"', $xxx->NamaBarang));
            $objPHPExcel->setCellValue('N'.$index, $xxx->KodeHS);
            $objPHPExcel->setCellValue('O'.$index, $xxx->Tarif);
            $objPHPExcel->setCellValue('P'.$index, $xxx->Sat);
            $objPHPExcel->setCellValue('Q'.$index, $jumlahz);
            $objPHPExcel->setCellValue('R'.$index, $xxx->Valas);
            $objPHPExcel->setCellValue('S'.$index, $cifz);
            $objPHPExcel->setCellValue('T'.$index, $tot);
            $objPHPExcel->setCellValue('U'.$index, $bayar);
            $objPHPExcel->setCellValue('V'.$index, $bebas);
            $nourut++;$index++;
        }

        $objPHPExcel->getStyle('I7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('L7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('T7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('U7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getStyle('V7')->getAlignment()->setWrapText(true);

        $objPHPExcel->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getColumnDimension('E')->setWidth(10);
        $objPHPExcel->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getColumnDimension('I')->setWidth(13);
        $objPHPExcel->getColumnDimension('J')->setWidth(13);
        $objPHPExcel->getColumnDimension('K')->setWidth(27.5);
        $objPHPExcel->getColumnDimension('L')->setWidth(14);        
        $objPHPExcel->getColumnDimension('M')->setWidth(28);
        $objPHPExcel->getColumnDimension('T')->setWidth(18);
        $objPHPExcel->getColumnDimension('U')->setWidth(18);
        $objPHPExcel->getColumnDimension('V')->setWidth(18);
        $objPHPExcel->getColumnDimension('W')->setWidth(18);

        $objPHPExcel->getStyle("A7:W9")->getFont()->setBold(true);
        $objPHPExcel->getStyle('A7:W9')->applyFromArray($borderall);
        $objPHPExcel->getStyle('A10:A'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('B10:B'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('C10:C'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('D10:D'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('E10:E'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('F10:F'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('G10:G'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('H10:H'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('I10:I'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('J10:J'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('K10:K'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('L10:L'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('M10:M'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('N10:N'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('O10:O'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('P10:P'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('Q10:Q'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('R10:R'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('S10:S'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('T10:T'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('U10:U'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('V10:V'.($index-1))->applyFromArray($borderOutline);
        $objPHPExcel->getStyle('W10:W'.($index-1))->applyFromArray($borderOutline);

        $objPHPExcel->getStyle("A7:W9")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getStyle("A7:W9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        header('Content-Type: text/html; charset=utf-8');
        header('Content-type: application/vnd.ms-excel');
        $filename='Laporan '.$jenis.' ('.$priode.').xls';
        header('Content-Disposition: attachment;filename='.$filename);
        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }

}

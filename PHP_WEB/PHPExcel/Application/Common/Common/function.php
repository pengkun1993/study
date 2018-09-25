<?php  
	/**
	 * 导入excel文件
	 * @param  string $file excel文件路径
	 * @return array        excel文件内容数组
	 */
	function import_excel($file){
	    // 判断文件是什么格式
	    $type = pathinfo($file);
	    $type = strtolower($type["extension"]);
	    $type=$type==='csv' ? $type : 'Excel5';
	    ini_set('max_execution_time', '0');
	    Vendor('PHPExcel.PHPExcel');
	    // 判断使用哪种格式
	    $objReader = \PHPExcel_IOFactory::createReader($type);
	    $objPHPExcel = $objReader->load($file); 
	    $sheet = $objPHPExcel->getSheet(0); 
	    // 取得总行数 
	    $highestRow = $sheet->getHighestRow();     
	    // 取得总列数      
	    $highestColumn = $sheet->getHighestColumn(); 
	    //循环读取excel文件,读取一条,插入一条
	    $data=array();
	    //从第一行开始读取数据
	    for($j=1;$j<=$highestRow;$j++){
	        //从A列读取数据
	        for($k='A';$k<=$highestColumn;$k++){
	            // 读取单元格
	            $data[$j][]=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
	        } 
	    }  
	    return $data;
	}
	/**
	 * 数组转xls格式的excel文件
	 * @param  array  $data      需要生成excel文件的数组
	 * @param  string $filename  生成的excel文件名
	 */
	function create_xls($data,$filename='simple.xls'){
	    ini_set('max_execution_time', '0');
	    Vendor('PHPExcel.PHPExcel');
	    $filename=str_replace('.xls', '', $filename).'.xls';
	    $phpexcel = new PHPExcel();
	    $phpexcel->getProperties()
	        ->setCreator("Maarten Balliauw")
	        ->setLastModifiedBy("Maarten Balliauw")
	        ->setTitle("Office 2007 XLSX Test Document")
	        ->setSubject("Office 2007 XLSX Test Document")
	        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
	        ->setKeywords("office 2007 openxml php")
	        ->setCategory("Test result file");
	    $phpexcel->getActiveSheet()->fromArray($data);
	    $phpexcel->getActiveSheet()->setTitle('Sheet1');
	    $phpexcel->setActiveSheetIndex(0);
	    header('Content-Type: application/vnd.ms-excel');
	    header("Content-Disposition: attachment;filename=$filename");
	    header('Cache-Control: max-age=0');
	    header('Cache-Control: max-age=1');
	    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	    header ('Pragma: public'); // HTTP/1.0
	    $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
	    $objwriter->save('php://output');
	    exit;
	}
?>
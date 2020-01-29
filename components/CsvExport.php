<?php

namespace app\components;

class CsvExport
{
	public function generateCsv($data=[], $total=[], $filename='', $delimiter=',', $header=[])
	{
		if (count($data) >= 10000) {
			throw new \yii\web\HttpException(400, 'Unable to export data greather than 10.000 records.');
		}
		if (empty($data)) {
			$data[0] = array_fill_keys(array_keys($header), '');
		}
		if (empty($delimiter))
			$delimiter = ',';
		$tmpheader = array();
		$head = false;
		$f = fopen('php://memory', 'w');
		$_SERVER['HTTP_X_REQUESTED_WITH'] = "XMLHttpRequest";
		if (empty($filename))
			$filename = 'filenamenotset-'.date('Y-m-d H:i:s').'csv';

		$arrayPrint = array_keys($data);
		if (empty($arrayPrint))
			$arrayPrint = [];

		if(!empty($data)){
			$tmpheader = $header;
			$header = array_keys($header);

			foreach ($data as $key => $val) {
				if(!$head){
					fputcsv($f, array_values($tmpheader), $delimiter);
					$head = true;
				}
				foreach ($val as $key => $value) {
					 if(!in_array($key, $arrayPrint))
						unset($val[$key]);
				}
				$arraymap = array_map(function($a) use($val, $arrayPrint) {
						// if($a == 'status_debet'){
						// 	return $val[$a] == 1 ? "Sudah" : "Belum";
						// }
						if(is_numeric($val[$a])){
							return "=\"{$val[$a]}\"";
						}
						// if($a == 'date_debet'){
						// 	return $val[$a] == NULL ? "" : $val[$a];
						// }
						// jika data kosong
						if (empty($val[$a])) {
							return ' ';
						}
						return $val[$a];
					},$header);
				if(!empty($tmpheader)){
					fputcsv($f, $arraymap, $delimiter);
				}
			}

			foreach ($total as $t => $val){
				if(!in_array($t, $arrayPrint)) {
					unset($total[$t]);
					continue;
				}
				// if($t == 'client_name'){
				// 	$total['client_name'] = "Total";
				// }
				if(is_numeric($val)) {
					$total[$t] = "=\"$val\"";
				}
				// Jika total kosong
				else {
					$total[$t] = " ";
				}
			}            
			// header('Content-Type: text/plain'); var_dump($total); exit;
			fputcsv($f, $total, $delimiter);
			fseek($f, 0);
			header("Content-Type: application/csv");
			header('Content-Disposition: attachement; filename="' . $filename . '";');
			header("Cache-Control: no-cache, must-revalidate");
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			/** Send file to browser for download */
			fpassthru($f);
			exit;
		}
	}
}
<?php

class DownloaderController extends Controller
{
	public function actionIndex($type,$file)
	{
		if (!isset($type) || empty($type)) throw new CHttpException(404);
		if (!isset($file) || empty($file)) throw new CHttpException(404);

		switch ($type)
		{
			case 'pdf' :
			{
				$filename = CHtml::encode($file).'.pdf';
				if (!is_file('download/'.$filename)) throw new CHttpException(404);
				header("Content-Type: application/octet-stream");
				header("Content-Disposition: attachment; filename=".urlencode($filename));
				header("Content-Type: application/octet-stream");
				header("Content-Type: application/download");
				header("Content-Description: File Transfer");
				header("Content-Length: ".filesize('download/'.$filename));
				flush();
				$fp = fopen('download/'.$filename, "r");
				while (!feof($fp))
				{
					echo fread($fp, 65536);
					flush();
				}
				fclose($fp);
				break;
			}
			default :
				throw new CHttpException(404);
		}
	}
}
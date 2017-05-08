<?
	if(isset($_GET["list_files"])){
		$files = array();
		foreach(glob('files/*.*') as $file){
			array_push($file, basename($file));
		}
		header('Content-type: application/json');
		echo json_encode($files);
	}
?>
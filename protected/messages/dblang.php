<?php
// CREATE TABLE SourceMessage
// (
// 	id INTEGER PRIMARY KEY,
// 	category VARCHAR(32),
// 	message TEXT
// );
// CREATE TABLE Message
// (
// 	id INTEGER,
// 	language VARCHAR(16),
// 	translation TEXT,
// 	PRIMARY KEY (id, language),
// 	CONSTRAINT FK_Message_SourceMessage FOREIGN KEY (id)
// 		REFERENCES SourceMessage (id) ON DELETE CASCADE ON UPDATE RESTRICT
// );

// public 
function getTransFileTests()
{
	return array(
		array('csv', 'CsvFileLoader'),
		array('ini', 'IniFileLoader'),
		array('mo', 'MoFileLoader'),
		array('po', 'PoFileLoader'),
		array('php', 'PhpFileLoader'),
		array('ts', 'QtFileLoader'),
		array('xlf', 'XliffFileLoader'),
		array('yml', 'YamlFileLoader'),
		array('json', 'JsonFileLoader'),
	);
}
// Yii
// abstract class CGettextFile extends CComponent
// abstract class CMessageSource extends CApplicationComponent
// class CGettextMoFile extends CGettextFile
// class CGettextPoFile extends CGettextFile
// class CPhpMessageSource extends CMessageSource

// Symfony
    /**
     * Gets the public 'translation.loader.mo' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\MoFileLoader
     */
	// protected 
	function getTranslation_Loader_MoService()
    {
        return $this->services['translation.loader.mo'] = new \Symfony\Component\Translation\Loader\MoFileLoader();
    }

    /**
     * Gets the public 'translation.loader.php' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\PhpFileLoader
     */
	// protected 
	function getTranslation_Loader_PhpService()
    {
        return $this->services['translation.loader.php'] = new \Symfony\Component\Translation\Loader\PhpFileLoader();
    }

    /**
     * Gets the public 'translation.loader.po' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\PoFileLoader
     */
	// protected 
	function getTranslation_Loader_PoService()
    {
        return $this->services['translation.loader.po'] = new \Symfony\Component\Translation\Loader\PoFileLoader();
    }
// echo "<pre>";
// // print_r($assoc);
// // print_r($assoc['xliff'][0]['value']['file'][0]['value']['body'][0]['value']['trans-unit']);
// print_r([$assoc['http_error.suggestion'],$assoc2['http_error.suggestion']]);
// echo "</pre>";
// exit();

// // $file = './protected/data/translations/validators.ru.xlf';
// $file = './protected/data/translations/messages.ru.xlf';
// // $xmlStr = file_get_contents($file);
// $assoc2 = include('./protected/messages/en/messages.php');

// function objectsIntoArray($arrObjData, $arrSkipIndices = array())
// {
// 	$arrData = array();
	
// 	// if input is object, convert into array
// 	if (is_object($arrObjData)) {
// 		$arrObjData = get_object_vars($arrObjData);
// 	}

// 	if (is_array($arrObjData)) {
// 		foreach ($arrObjData as $index => $value) {
// 			if (is_object($value) || is_array($value)) {
// 				$value = objectsIntoArray($value, $arrSkipIndices); // recursive call
// 			}
// 			if (in_array($index, $arrSkipIndices)) {
// 				continue;
// 			}
// 			$arrData[$index] = $value;
// 		}
// 	}
// 	return $arrData;
// }
// $xmlUrl = $file; // XML feed file/URL
// $xmlStr = file_get_contents($xmlUrl);
// $xmlObj = simplexml_load_string($xmlStr);

// $arrXml = objectsIntoArray($xmlObj, ['@attributes']);
// // print_r($arrXml['file']['body']['trans-unit']);
// foreach ($arrXml['file']['body']['trans-unit'] as $_k => $_v) {
// 	$assoc[$_v['source']] = $_v['target'];
// }

?>
<?php
// $this->beginWidget('CTextHighlighter', ['language'=>'xml']);
// // $this->beginWidget('CHtmlPurifier');
// include('./protected/data/translations/validators.ru.xlf');

// // // $data = $this->beginWidget('CTextHighlighter');
// // require_once (Yii::getPathOfAlias('system.vendors.TextHighlighter.Text.Highlighter.Generator').'.php');
// // $generator = new Text_Highlighter_Generator('php.xml');
// // $generator->generate();
// // // $generator->saveCode('PHP.php');

// // echo "<pre>";
// // print_r($generator);
// // echo "</pre>";
// // exit();
// $this->endWidget() 
?>
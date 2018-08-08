<?php
$file = './protected/data/translations/validators.en.xlf';
function xml2assoc($xml)
{
	$assoc = null;
	while ($xml->read()) {
		switch ($xml->nodeType) {
			case XMLReader::END_ELEMENT:
				return $assoc;
			case XMLReader::ELEMENT:
				$assoc[$xml->name][] = ['value' => $xml->isEmptyElement ? '' : xml2assoc($xml)];
				if ($xml->hasAttributes) {
					$el = &$assoc[$xml->name][count($assoc[$xml->name]) - 1];
					while ($xml->moveToNextAttribute()) $el['attributes'][$xml->name] = $xml->value;
				}
				break;
			case XMLReader::TEXT:
			case XMLReader::CDATA:
				$assoc .= $xml->value;
		}
	}
	return $assoc;
}


$xml = new XMLReader();
$xml->open($file);
$arrXml = xml2assoc($xml);
$xml->close();
foreach ($arrXml['xliff'][0]['value']['file'][0]['value']['body'][0]['value']['trans-unit'] as $_k => $_v) {
	$assoc[$_v['value']['source'][0]['value']] = $_v['value']['target'][0]['value'];
}

return $assoc;
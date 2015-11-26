<?php
	
	function write(XMLWriter $xml, $response){
		foreach($response as $key => $value){
			if(is_array($value)){
				if (strpos($key, 'idade') !== false)
					$key = 'idade';
				$xml->startElement($key);
				write($xml, $value);
				$xml->endElement();
				continue;
			}
			if (strpos($key, 'uf-') !== false)
				$key = 'uf';
			$xml->writeElement($key, $value);
		}
}

	function criaXML($response){
		$xml = new XmlWriter();
		$xml->openMemory();
		$xml->startDocument('1.0', 'UTF-8');
		$xml->startElement('bvs');

		write($xml, $response);

		$xml->endElement();
		header ("Content-Type:text/xml");
		echo $xml->outputMemory(true);
		die;
	}
?>
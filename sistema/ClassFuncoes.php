<?php
class Funcoes
{
	
	//Fun��o para gravar valores monet�rios formatados.
	//**************************************************************************************
	public function MascaraValorGravar($strValor)
	//function MascaraValorGravar($strValor)
	{
		//private $returnValor = $strValor;
		$returnValor = $strValor;
		
		$returnValor = str_replace(".", "", $returnValor);
		$returnValor = str_replace(",", "", $returnValor);
		
		return $returnValor;
	}
	//**************************************************************************************
}

?>
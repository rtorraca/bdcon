<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $pageSite->cphTitle; ?></title>
    
	<?php require_once "../CodigoAcompanhamento.php";?>
    
    <?php //Favicon - 16x16 | 32x32 | 64x64 (pixels).?>
    <link rel="bookmark" href="../favicon.ico" />
    <link rel="icon" type="image/x-icon" href="../favicon.ico" />
    <link rel="icon" type="image/gif" href="../animated_favicon1.gif" />
    <link rel="icon" type="image/png" href="../favicon.png" />
    <link rel="Shortcut Icon" type="image/vnd.microsoft.icon" href="../favicon.ico" />
    
    <?php echo $pageSite->cphHead; ?>
    	
	<?php
    //<meta http-equiv="cache-control" content="max-age=0" />
    //<meta http-equiv="cache-control" content="no-cache" />
    //<meta http-equiv="expires" content="0" />
    //<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    //<meta http-equiv="pragma" content="no-cache" />
    ?>    
    
    <meta name="Author" content="<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeDesenvolvedor'], "IncludeConfig"); ?>" />
    <meta name="Designer" content="<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeDesenvolvedor'], "IncludeConfig"); ?>" />
    <meta name="copyright" content="<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configAnoCopiright'], "IncludeConfig"); ?>, <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>" />
    <meta name="rating" content="general" /><?php //general | mature | restricted | 14 years?>
    <?php
		/*
        <!--meta name="expires" content="never" /--><!--ex: 28 June 2003-->
        <!--meta name="distribution" content="global" /--><!--ex: global | local | IU -->
		*/
    ?>
    <meta name="robots" content="index,follow" />
    <?php
		/*
        ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â» index,follow 
        Esta opÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â§ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o faz com que a pÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡gina que contenha esta meta tag e as urls referenciadas nelas, sejam indexadas pelos buscadores. 
        ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â» noindex,follow 
        Com esta, vocÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âª indexa, somente, as urls referenciadas na pÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡gina, nÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o indexando ela prÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³pria. 
        ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â» index,nofollow 
        O contrÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡rio da anterior. Somente a pÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡gina que contÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â©m esta meta tag serÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡ indexada, fazendo com que as urls referenciadas nela nÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o sejam indexadas. 
        ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â» noindex,nofollow 
        NÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o indexa nenhuma das pÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡ginas, nem as urls referenciadas e nem ela prÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³pria. (*) 
        ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â» noarchive 
        Esta opÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â§ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o faz com que os buscadores nÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o armazenem uma cÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³pia do seu site em cache. Sua utilizaÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â§ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o requer um pouco de cuidado, pois uma vantagem em nÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o utilizÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡-la, ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â© que caso seu site fique fora do ar por algum problema, ele ainda continuarÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡ sendo indexado, mas caso escolha utilizÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡-la, automaticamente ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â© retirado. Vemos isso vÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡rias vezes no Google, por exemplo, que pÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡ginas continuam indexadas e quando clicamos, dÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡ o famoso erro 404. 
		*/
    ?>
    <meta name="Language" content="portuguese" />

    <?php
		/*
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		*/
    ?>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <?php
		/*
        pt-br: PortuguÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªs do Brasil; 
        en: InglÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªs 
        es: Espanhol 
        <meta http-equiv="content-language" content="pt-br, en-US, fr" />
		*/
    ?>
    <meta http-equiv="content-language" content="pt-br" />
    <meta http-equiv="pragma" content="no-cache" />
    
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="EstilosLayout.css" rel="stylesheet" type="text/css" />
    <link href="EstilosSite.css" rel="stylesheet" type="text/css" />

	<?php //Arquivos para a biblioteca JS e JQuery. ?>
	<?php require_once "IncludeJavaScriptHead.php"; ?>
    
    <style type="text/css">
	
    </style>
</head>
<body>

    <div style="position: relative; display: block; width: 1000px; margin-right: auto; margin-left: auto;">
        <div style="display: none;">
        <?php //ConteÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âºdo - inÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â­cio.?>
            <?php echo $pageSite->cphTituloLinkAtual; ?>
        <?php //ConteÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âºdo - fim.?>
        </div>
        
        
		<?php //ConteÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âºdo - inÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â­cio.?>
            <?php echo $pageSite->cphConteudoPrincipal; ?>
        <?php //ConteÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âºdo - fim.?>
    </div>

</body>
</html>
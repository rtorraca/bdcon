//function pageLoad() {
//Sys.Application.add_init(function () {
//$(document).ready(function () {    
    $(function() {
        //Fun��o Gen�rica (PT)
	    //**************************************************************************************
	    //if (strDatapickerGenericoPtCampos){
	    if (typeof(strDatapickerGenericoPtCampos) !== 'undefined'){
		    //Defini��o dos capos indicado no frontend.
		    var arrDatapickerGenericoPtCampos = strDatapickerGenericoPtCampos.split(";"); 
		    //Loop para criar as fun��es para diferentes campos.
		    for (var i = 0; i < arrDatapickerGenericoPtCampos.length; i++) {
			    $(arrDatapickerGenericoPtCampos[i]).datepicker({
				    dateFormat: "dd/mm/yy",
				    changeYear: true,
				    dayNames: ["Domingo", "Segunda", "Ter�a", "Quarta", "Quinta", "Sexta", "S�bado"],
				    dayNamesMin: ["Do", "Se", "Te", "Qa", "Qi", "Sx", "S�"],
				    dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "S�b"],
				    monthNames: ["Janeiro","Fevereiro","Mar�o","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
				    numberOfMonths: [1, 1], //N�mero de meses ao mostrar de uma vez no calend�rio [n�mero de linhas, n�mero de meses].
				    //yearRange: "1910:2020",
				    minDate: new Date(1910, 1 - 1, 1),
				    maxDate: "+1m +10w",
				    showAnim: "fold", //show (default).
				    firstDay: 0 //Qual dia que come�a o calend�rio.
			    });
			    //Teste.
			    //document.write(arrDatapickerGenericoPtCampos[i] + "<br>")
		    }
	    } 
	    //**************************************************************************************


	    //Fun��o Gen�rica (EN)
	    //**************************************************************************************
	    if (typeof(strDatapickerGenericoEnCampos) !== 'undefined'){
		    //Defini��o dos capos indicado no frontend.
		    var arrDatapickerGenericoEnCampos = strDatapickerGenericoEnCampos.split(";"); 
		    //Loop para criar as fun��es para diferentes campos.
		    for (var i = 0; i < arrDatapickerGenericoEnCampos.length; i++) {
			    $(arrDatapickerGenericoEnCampos[i]).datepicker({
				    dateFormat: "mm/dd/yy",
				    changeYear: true,
				    dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Satarday"],
				    dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
				    dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
				    monthNames: ["January","Fabuary","March","April","May","June","July","August","September","October","November","December"],
				    numberOfMonths: [1, 1], //N�mero de meses ao mostrar de uma vez no calend�rio [n�mero de linhas, n�mero de meses].
				    //yearRange: "1910:2020",
				    minDate: new Date(1910, 1 - 1, 1),
				    maxDate: "+1m +10w",
				    showAnim: "fold", //show (default).
				    firstDay: 0 //Qual dia que come�a o calend�rio.
			    });
		    }
	    }
        //**************************************************************************************



        //Fun��o Agenda (sem data limite a frente) (PT)
        //**************************************************************************************
        //if (strDatapickerGenericoPtCampos){
        if (typeof (strDatapickerAgendaPtCampos) !== 'undefined') {
            //Defini��o dos capos indicado no frontend.
            var arrDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos.split(";");
            //Loop para criar as fun��es para diferentes campos.
            for (var i = 0; i < arrDatapickerAgendaPtCampos.length; i++) {
                $(arrDatapickerAgendaPtCampos[i]).datepicker({
                    dateFormat: "dd/mm/yy",
                    changeYear: true,
                    dayNames: ["Domingo", "Segunda", "Ter�a", "Quarta", "Quinta", "Sexta", "S�bado"],
                    dayNamesMin: ["Do", "Se", "Te", "Qa", "Qi", "Sx", "S�"],
                    dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "S�b"],
                    monthNames: ["Janeiro", "Fevereiro", "Mar�o", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                    numberOfMonths: [1, 1], //N�mero de meses ao mostrar de uma vez no calend�rio [n�mero de linhas, n�mero de meses].
                    //yearRange: "1910:2020",
                    minDate: new Date(1910, 1 - 1, 1),
                    //maxDate: "+1m +10w",
                    showAnim: "fold", //show (default).
                    firstDay: 0 //Qual dia que come�a o calend�rio.
                });
                //Teste.
                //document.write(arrDatapickerGenericoPtCampos[i] + "<br>")
            }
        }
        //**************************************************************************************


        //Fun��o Gen�rica (EN)
        //**************************************************************************************
        if (typeof (strDatapickerAgendaEnCampos) !== 'undefined') {
            //Defini��o dos capos indicado no frontend.
            var arrDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos.split(";");
            //Loop para criar as fun��es para diferentes campos.
            for (var i = 0; i < arrDatapickerAgendaEnCampos.length; i++) {
                $(arrDatapickerAgendaEnCampos[i]).datepicker({
                    dateFormat: "mm/dd/yy",
                    changeYear: true,
                    dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Satarday"],
                    dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                    dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    monthNames: ["January", "Fabuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    numberOfMonths: [1, 1], //N�mero de meses ao mostrar de uma vez no calend�rio [n�mero de linhas, n�mero de meses].
                    //yearRange: "1910:2020",
                    minDate: new Date(1910, 1 - 1, 1),
                    //maxDate: "+1m +10w",
                    showAnim: "fold", //show (default).
                    firstDay: 0 //Qual dia que come�a o calend�rio.
                });
            }
        }
        //**************************************************************************************



        //Fun��o Gen�rica (PT)
        //**************************************************************************************
        //if (strDatapickerGenericoPtCampos){
        if (typeof (strDatapickerNascimentoPtCampos) !== 'undefined') {
            //Defini��o dos capos indicado no frontend.
            var arrDatapickerNascimentoPtCampos = strDatapickerNascimentoPtCampos.split(";");
            //Loop para criar as fun��es para diferentes campos.
            for (var i = 0; i < arrDatapickerNascimentoPtCampos.length; i++) {
                $(arrDatapickerNascimentoPtCampos[i]).datepicker({
                    dateFormat: "dd/mm/yy",
                    changeYear: true,
                    dayNames: ["Domingo", "Segunda", "Ter�a", "Quarta", "Quinta", "Sexta", "S�bado"],
                    dayNamesMin: ["Do", "Se", "Te", "Qa", "Qi", "Sx", "S�"],
                    dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "S�b"],
                    monthNames: ["Janeiro", "Fevereiro", "Mar�o", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                    numberOfMonths: [1, 1], //N�mero de meses ao mostrar de uma vez no calend�rio [n�mero de linhas, n�mero de meses].
                    //yearRange: "1900:2020",
                    yearRange: "1900:" + new Date().getFullYear(),
                    minDate: new Date(1900, 1 - 1, 1),
                    maxDate: "+1m +10w",
                    showAnim: "fold", //show (default).
                    firstDay: 0 //Qual dia que come�a o calend�rio.
                });
                //Teste.
                //document.write(arrDatapickerGenericoPtCampos[i] + "<br>")
            }
        }
        //**************************************************************************************


        //Fun��o Gen�rica (EN)
        //**************************************************************************************
        if (typeof (strDatapickerNascimentoEnCampos) !== 'undefined') {
            //Defini��o dos capos indicado no frontend.
            var arrDatapickerNascimentoEnCampos = strDatapickerNascimentoEnCampos.split(";");
            //Loop para criar as fun��es para diferentes campos.
            for (var i = 0; i < arrDatapickerNascimentoEnCampos.length; i++) {
                $(arrDatapickeNascimentoEnCampos[i]).datepicker({
                    dateFormat: "mm/dd/yy",
                    changeYear: true,
                    dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Satarday"],
                    dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                    dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    monthNames: ["January", "Fabuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    numberOfMonths: [1, 1], //N�mero de meses ao mostrar de uma vez no calend�rio [n�mero de linhas, n�mero de meses].
                    //yearRange: "1900:2020",
                    yearRange: "1900:" + new Date().getFullYear(),
                    minDate: new Date(1900, 1 - 1, 1),
                    maxDate: "+1m +10w",
                    showAnim: "fold", //show (default).
                    firstDay: 0 //Qual dia que come�a o calend�rio.
                });
            }
        }
        //**************************************************************************************

    });

//});
//});
//}
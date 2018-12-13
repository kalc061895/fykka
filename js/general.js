function loading(op){
	if(op=="open"){
		$('#modalLoad').modal('show');
	}
	else if(op=="close"){
		$('#modalLoad').modal('hide');
	}
}
function cargar_en(url){
				$.post(url,function(data){
					$("#body_main").html(data);
				});
}

function validar(obj){
	res=0;
	$(obj).find(":input").each(function(){
		if($(this).attr("tipo")=="texto"){
			mayuscula(this);
			res=res+validar_texto(this);
		}
		else if($(this).attr("tipo")=="dni"){
			mayuscula(this);
			res=res+validar_dni(this);
		}
		else if($(this).attr("tipo")=="email"){
			//mayuscula(this);
			res=res+validar_email(this);
		}
		else if($(this).attr("tipo")=="celular"){
			mayuscula(this);
			res=res+validar_celular(this);
		}
		else if($(this).attr("tipo")=="entero"){
			mayuscula(this);
			res=res+validar_entero(this);
		}
		else if($(this).attr("tipo")=="lista"){
			res=res+validar_lista(this);
		}
		else if($(this).attr("tipo")=="fecha"){
			res=res+validar_fecha(this);
		}
		else if($(this).attr("tipo")=="imagen"){
			res=res+validar_texto(this);
		}
		else if($(this).attr("tipo")=="user"){
			res=res+validar_texto(this);
		}
		else if($(this).attr("tipo")=="monto"){
			res=res+validar_texto(this);
		}
		else if($(this).attr('tipo')=='hora'){
			res=res+validar_hora(this);
		}
		else if($(this).attr('tipo')=='real'){
			res=res+validar_real(this);
		}
		else if($(this).attr('tipo')=='horometro'){
			res=res+validar_real(this);
		}

	});
	return res;
}
function desac_form(obj){
	res=0;
	$(obj).find(":input").each(function(){
		$(this).attr("disabled")="disabled";
	});
	return res;
}
function mayuscula(obj){
	$(obj).val($(obj).val().toUpperCase());
}
function error(obj){
	$(obj).attr("title","xxx");
	$(obj).css("background-color","#d15b47");
	$(obj).css("z-index","0");
	$(obj).css("color","#fff");
	$(obj).attr.webkit-input-placeholder("color","#ffffff;");
	
	return 1;
}
function noerror(obj){
	$(obj).css("background-color","#ffffff");
	$(obj).css("color","#696969");
	return 0;
}
function validar_texto(obj){
	if($(obj).val()=="" || $.trim($(obj).val())==""){
		return error(obj);
	}
	else{
		return noerror(obj);
	}
}
function validar_lista(obj){
	if($(obj).val()==""){
		return error(obj);
	}
	else{
		return noerror(obj);
	}
}
function validar_entero(obj){
	numero=$(obj).val();
	alphanume=false;
	for(i=0;i<numero.length;i++){
		if(numero[i]<'0' || numero[i]>'9'){
			alphanume=true;
		}
	}
	if(numero=="" || alphanume==true){
		return error(obj);
	}
	else{
		return noerror(obj);
	}
}
function validar_real(obj){
	numero=$(obj).val();
	puntos=0;
	alphanume=false;
	for(i=0;i<numero.length;i++){
		if(numero[i]=='.'){
			puntos++;
		}
		else if(numero[i]<'0' || numero[i]>'9'){
			alphanume=true;
		}
	}
	if(numero=="" || numero[0]=='.' || puntos>1 || alphanume==true || numero[numero.length-1]=='.'){
		return error(obj);
	}
	else{	
		return noerror(obj);
	}
}
function validar_dni(obj){
	dni=$(obj).val();
	alphanume=false;
	for(i=0;i<dni.length;i++){
		if(dni[i]<'0' || dni[i]>'9'){
			alphanume=true;
		}
	}
	if(dni=="-"){
		return noerror(obj);
	}
	if(dni.length==8 && alphanume==false){
		return noerror(obj);
	}
	else {
		return error(obj);
	}
}
function validar_fecha(obj){
	fecha=$(obj).val();
	alphanume=false;
	guiones=0;
	error1=true;
	for(i=0;i<fecha.length;i++){
		if(fecha[i]!='-'){
			if(fecha[i]<'0'){
				alphanume=true;
			}
			else if(fecha[i]>'9'){
				alphanume=true;
			}
		}
		else{
			guiones++;
		}
	}
	if(fecha.length>8){
		if(fecha[4]=="-" || fecha[7]=="-"){
			error1=false;
		}
	}
	else{
		error1=true;
	}
	if(alphanume==false && error1==false && guiones==2){
		return noerror(obj);
	}
	else {
		return error(obj);
	}
}
function validar_hora(obj){
	hora=$(obj).val();
	alphanume=false;
	puntos=0;
	error1=true;
	for(i=0;i<hora.length;i++){
		if(hora[i]!=':'){
			if(hora[i]<'0'){
				alphanume=true;
			}
			else if(hora[i]>'9'){
				alphanume=true;
			}
		}
		else{
			puntos++;
		}
	}
	if(hora.length<6){
		error1=false;
	}
	else{
		error1=true;
	}
	if(alphanume==false && error1==false && (puntos==1 || puntos ==2) ){
		return noerror(obj);
	}
	else {
		return error(obj);
	}
}
function validar_mac(obj){
	hora=$(obj).val();
	alphanume=false;
	puntos=0;
	error1=true;
	for(i=0;i<hora.length;i++){
		//if(hora[i]!=':')
		{
			if((hora[i]>='a' && hora[i]<='f') || (hora[i]>='A' && hora[i]<='F') || (hora[i]>='0' && hora[i]<='9')){//F0:E1D2:C3:B4:A5
			}
			else{
				alphanume=true;
			}
		}
		/*else{
			puntos++;
		}*/
	}
	if(hora.length<12){
		error1=true;
	}
	else{
		error1=false;
	}
	if(alphanume==false && error1==false /*&& puntos==5*/){
		return noerror(obj);
	}
	else {
		return error(obj);
	}
}
function validar_ip(obj){
	hora=$(obj).val();
	alphanume=false;
	puntos=0;
	error1=true;
	for(i=0;i<hora.length;i++){
		if(hora[i]!='.'){
			if(hora[i]<'0'){
				alphanume=true;
			}
			else if(hora[i]>'9'){
				alphanume=true;
			}
		}
		else{
			puntos++;
		}
	}
	if(hora.length>6){
		error1=false;
	}
	else{
		error1=true;
	}
	if(hora[hora.length-1]=="."){
		error1=true;
	}	
	if(alphanume==false && error1==false && puntos==3){
		return noerror(obj);
	}
	else {
		return error(obj);
	}
}
function validar_email(obj){
	email=$(obj).val();
	arroba=-1;
	punto=-1;
	for(i=0;i<email.length;i++){
		if(email[i]=='@'){
			arroba=i;
		}
		if(email[i]=='.' && arroba>0){
			punto=i;
		}
	}
	if(email=="-"){
		return noerror(obj);
	}
	if(arroba>0 && punto>0 && punto>arroba && arroba+1!=punto){
		return noerror(obj);
	}
	else {
		return error(obj);
	}
}
function validar_celular(obj){
	cell=$(obj).val();
	alphanume=false;
	for(i=0;i<cell.length;i++){
		if(cell[i]<'0' || cell[i]>'9'){
			alphanume=true;
		}
	}
	if(cell=="-"){
		return noerror(obj);
	}
	if(cell.length==9 && alphanume==false){
		return noerror(obj);
	}
	else{
		return error(obj);
	}
}
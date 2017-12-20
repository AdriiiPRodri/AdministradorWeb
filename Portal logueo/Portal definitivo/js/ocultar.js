
function abrir(numero)
{
	var capas = ["1","2","3","4","5","6","7"];
	for(i=0; i<capas.length; i++)
	{
		if(document.getElementById(capas[i]) != null)
			document.getElementById(capas[i]).style.display = "none";
	}
 
	if(document.getElementById(numero) != null)
		document.getElementById(numero).style.display = "block";
};
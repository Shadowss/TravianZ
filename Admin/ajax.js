var http_request = false;

function macheRequest(url, id)
{

	http_request = false;

	if (window.XMLHttpRequest)
	{ // Mozilla, Safari,...
		http_request = new XMLHttpRequest();
		if (http_request.overrideMimeType)
		{
			http_request.overrideMimeType('text/xml');
			// zu dieser Zeile siehe weiter unten
		}
	}
	else if (window.ActiveXObject)
	{ // IE
		try
		{
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
			}
		}
	}

	if (!http_request)
	{
		alert('Ende :( Kann keine XMLHTTP-Instanz erzeugen');
		return false;
	}
	http_request.onreadystatechange = function()
	{
		alertInhalt2(id);
	};
	http_request.open('GET', url, true);
	http_request.send(null);

}

function alertInhalt2(id)
{

	if (http_request.readyState == 4)
	{
		if (http_request.status == 200)
		{
			// alert(http_request.responseText);
			myElement = document.getElementById(id);
			if (myElement != null)
			{
				myElement.innerHTML = http_request.responseText;
			}

		}
		else
		{
			alert('Bei dem Request ist ein Problem aufgetreten.');
		}
	}

}
## Check if there is Google Map; if yes change with OpenStreetMap
https://leaflet-extras.github.io/leaflet-providers/preview/

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 24,
    attribution:
      '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

	L.tileLayer(
		'https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png',
		{
			maxZoom: 24,
			attribution:
				'&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
		}
	).addTo(mymap);

## If there is the plugin Altuofianco, remove it

## Check if there is Googe Analytics Tracking code; if yes, find it and remove it - Use developer tools - Network - search for Collect

## Install Matomo Analytics - Ethical Stats. Powerful Insights, with the setting attached
- scoatem pluginul matomo si inlocuim cu cod in header plus adaugam in matomo.atf.care
- http://matomo.atf.care/
- user atf
- pass Bludelego2022!
- in meniu alegem all website
- add a new website
- denumirea url fara https apoi link de la site
- codul de adaugat il gasiti in tracking code
- pluginul matomo de dezinstalat!!!!
- siteurile care sunt subdomenii cu altuofianco.com nu le puneti matomo!!!! sunt inca in dezvoltare nu sunt finisate

## Change privacy policy page (table with cookies);
<table>
<tbody>
<tr>
<th>Nome</th>
<th>Scopo</th>
<th>Scadenza</th>
<th>Tipo</th>
<th>Parte</th>
</tr>
<tr>
<td>cookie_notice_accepted</td>
<td>Registra se l'utente ha o meno visualizzato il coookie banner in modo da non mostrarlo nuovamente ad ogni visualizzazione di pagina</td>
<td>Persistente</td>
<td>HTTP Cookie - Tecnico</td>
<td>Prima parte</td>
</tr>
<tr>
<td>wp_lang</td>
<td>Memorizza le preferenze sulla lingua</td>
<td>Sessione</td>
<td>HTTP Cookie - Tecnico</td>
<td>Prima parte</td>
</tr>
<tr>
<td>wordpress_test_cookie</td>
<td>Verifica se il browser accetta i cookie</td>
<td>Sessione</td>
<td>HTTP Cookie - Tecnico</td>
<td>Prima parte</td>
</tr>
</tbody>
</table>



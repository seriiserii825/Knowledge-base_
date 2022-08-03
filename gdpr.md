## Check if there is Google Map; if yes change with OpenStreetMap
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 24,
    attribution:
      '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

## If there is the plugin Altuofianco, remove it

## Check if there is Googe Analytics Tracking code; if yes, find it and remove it - Use developer tools - Network - search for Collect

## Install Matomo Analytics - Ethical Stats. Powerful Insights, with the setting attached
- Gets started → Enable Tracking now
- Settings -> Tab Tracking
    a) Add tracking code --> Default Tracking
    b) Disable cookie: check it
    c) Enable ecommerce: Uncheck it
- Settings > Matomo Admin
  - Privacy
    - Rendi anonimi
      Rendi anonimi gli (check)
      Machera completamente (check)
      Usa anchi gli indirizzo (Si)
      Sostituici ID (Check)

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



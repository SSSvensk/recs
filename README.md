# recs

Recommender Systems 2018 - Course Recommender

PHP:n suorittaminen:
1. Lataa ja asenna XAMPP (https://www.apachefriends.org/index.html)
2. Kun asennettu, avaa XAMPP Control Panel, ja käynnistä Apache
3. Avaa selain ja kirjoittamalla osoiteriville localhost:[XAMPP:in näyttämä portti] (Yleensä portti on valmiiksi määritelty 8080 tai 80, niin kirjoita se)
4. Pitäisi tulla Apachen oletusetusivu näkyville, mikä tarkoittaa, että serveri pyörii onnistuneesti.

Open data:
https://opendata.uta.fi:8443/apiman-gateway/UTA/opintojaksot/1.0?apikey=[PERSONAL_API_KEY]

Data sisältää yli 2400 kurssia. Datan hakemiseen käytetään curl-funktioita PHP:ssa, ja json_decode-funktiolla datasta saadaan JSON-array. Datasta haetaan kursseja kuten yleensä arraysta käyttämällä numeroituja indeksejä. Arrayn sisältämät kurssit itse ovat objekteja ja koostuu avain-arvo pareista, joista arvon saa luettua käyttämällä avainta.
Esimerkiksi: $json[0] palauttaa objektin 
{"id":38294,
"unit":"TUTKI",
"code":"TAYJ11",
"name":"Philosophy of Science",
...}
Vastaavasti unit-attribuutin saa laittamalla unit-avaimen uusien hakasulkeiden sisään: $json[0]["unit"], joka palauttaa arvon "TUTKI".

Stored data:

* Course name
* Course code
* Course subject
* Course ECTS
* Course language
* Keywords
* Student data
* Course participation

Algoritmit:
User-based, content-based

Käyttöliittymä:
Further discussion needed

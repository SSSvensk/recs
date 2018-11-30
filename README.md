# recs

Recommender Systems 2018 - Course Recommender
ttt
PHP:n suorittaminen:
1. Lataa ja asenna XAMPP (https://www.apachefriends.org/index.html)
2. Kun asennettu, avaa XAMPP Control Panel, ja käynnistä Apache
3. Avaa selain ja kirjoittamalla osoiteriville localhost:[XAMPP:in näyttämä portti] (Yleensä portti on valmiiksi määritelty 8080 tai 80, niin kirjoita se)
4. Pitäisi tulla Apachen oletusetusivu näkyville, mikä tarkoittaa, että serveri pyörii onnistuneesti.
5. Aseta php.ini-tiedostosta max_execution_time 30 -> 300.

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
* Course id
* Course code
* Course subject
* Course ECTS
* Course language
* Course periods
* Keyword
* Keyword id
* Keywords - course
* Student name
* Student number
* Course participation

SELECT * FROM keyword;
+----+------------------------+
| id | word                   |
+----+------------------------+
|  1 | Programming            |
|  2 | Java                   |
|  3 | WWW                    |
|  4 | statistics             |
|  5 | spss                   |
|  6 | probabilities          |
|  7 | regression             |
|  8 | data mining            |
|  9 | clustering             |
| 10 | data structures        |
| 11 | graphs                 |
| 12 | trees                  |
| 13 | object-oriented        |
| 14 | interactive technology |
| 15 | users                  |
| 16 | design                 |
| 17 | jola                   |
| 18 | data bases             |
| 19 | sql                    |
| 20 | er                     |
| 21 | information systems    |
| 22 | uml                    |
| 23 | user scenarios         |
| 24 | user interfaces        |
| 25 | thesis                 |
+----+------------------------+

Tällä hetkellä näyttää tuolta noi keywordit.

SQL-kysely laskemaan avainsanojen merkityksen:
SELECT keyword.word, COUNT(*) as importance FROM course, attends, student, includes, keyword WHERE student.number = 98607 AND student.number = attends.stnumb AND attends.coursecode = course.code AND course.code = includes.ccode AND includes.kid = keyword.id GROUP BY keyword.word ORDER BY importance DESC;

Käyttöliittymä:
Further discussion needed

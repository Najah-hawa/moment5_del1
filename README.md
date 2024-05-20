# Hej!
## Kort beskrivning av moment 5 del 1 i kursen Webbutveckling III
Momentet gåt ut på att skapa en webb-applikation för att hantera en lista av de kurser som jag har läst i programmet Webutveckling.

### första del av moment 5-del1

I det första delen skpade jag en webbtjänst för att hantera information om kurser . Den information lagras är:
Kurskod - exempelvis "dt173g"
Kursnamn - exempelvis "Webbutveckling III"
Progression - vanligtvis A eller B
Kursplan - en webblänk som länkar till kursplanen, exempelvis https://www.miun.se/utbildning/kurser/Sok-kursplan/kursplan/?kursplanid=21873
#### krav för denna del i moment är:
1.  webbtjänsten ska presenteras i JSON-format.
2. Implementerat CRUD (Create Read Update Delete) som använder följande verb: GET, POST, PUT och DELETE.
#### arbetsgång:
1. jag skapade en fil som heter read och i denna finns det headers för att berätta om vad ska hända. jag vill att alla domän ska komma till webbtjänsten och skicka methods GET, POST, PUT och DELETE, och jag vill att data ska skickas i json format. 
2. sedan började jag med switch där jag kontrollera vad ska man göra. om det GET method som man anropar så körs det en funktion för att läsa lista av dem kurser som finns registerad i databasen. dessutom går det att läsa en särskild kurs och då skickar man id för kursen som man vill läsa. skickar man method POST så lägger man en ny kurs i databasen. är det method PUT så uppdaterar man en befintlig kurs och lägger nya värden. sist är det method DELETE och då raderar man en kurs som finns i databasen genom att ange kursens id. 
3. jag skapade en install fil där jag skapar en ansslutning till databasen och skapar en tabell manuell och lägger lite värden i tabellen. 
4. jag skapade en class för att hantera de olika funktioner som ska köras när man använder något method.



## URI's (webblänkar) för att använda CRUD.
i localhost är min url: "http://localhost/php-api/cources/read.php";
i miun är min url: 
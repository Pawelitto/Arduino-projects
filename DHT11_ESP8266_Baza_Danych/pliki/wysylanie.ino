#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <DHT.h>

const char *ssid = "";  // Nazwa sieci do której podłącza się esp8266
const char *password = "";  // Hasło sieci

const char *host = "/post-esp-data.php";   //https://youtube.com strony lub adres IP serwera

#define DHTPIN 5

#define DHTTYPE    DHT11
DHT dht(DHTPIN, DHTTYPE);



//=======================================================================
//                    Konfigurowanie danych początkowych
//=======================================================================

void setup() {
  dht.begin();
  delay(1000);
  Serial.begin(115200);
  WiFi.mode(WIFI_OFF);        
  delay(1000);
  WiFi.mode(WIFI_STA);        
  
  WiFi.begin(ssid, password);     // Połączenie esp8266 do routera
  Serial.println("");

  Serial.print("Connecting");
  
  // Czekanie na połączenie
  while (WiFi.status() != WL_CONNECTED) {
    
    delay(500);
    Serial.print(".");
  }

  
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  //Adres IP routera
}

//=======================================================================
//                    Główny program w pętli
//=======================================================================

void loop() {

  HTTPClient http;    //Deklaracja obiektu klasy HTTPClient
  WiFiClient client;

  String zbieranie_danych, glowny_link;
  
  String nazwa_czujnika = "DHT11";
  String lokacja_umieszczenia_czujnika = "Pokoj";
  
  
  String api = "kluczapibezpiecznypok";

  //tworzenie linku do wstawiania danych w bazie
  zbieranie_danych = "?api_key=" + api + "&sensor=" + nazwa_czujnika + "&location=" + lokacja_umieszczenia_czujnika + "&value1=" + float(dht.readTemperature()); 
  glowny_link = host + zbieranie_danych;
  
  http.begin(client, glowny_link);      // Opisanie zapytania 
  
  int httpCode = http.GET();            // Wysłanie zapytania
  String payload = http.getString();    // Odbiór danych powrotnych

  Serial.println(httpCode);   //Wyświetlanie kodu powrotnego
  Serial.println(payload); 

  http.end();  //Zamknięcie połączenia
  
  
  delay(900000);  //Częstotliwość wysyłania danych
}

//=======================================================================

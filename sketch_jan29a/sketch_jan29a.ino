#include <RBD_Timer.h>
#include <RBD_Button.h>
#include <ESP8266WiFi.h>

#include <Wire.h> 
#include <LiquidCrystal_I2C.h>

// Set the LCD address to 0x27 for a 16 chars and 2 line display
LiquidCrystal_I2C lcd(0x27, 16, 2);

#ifndef STASSID
#define STASSID "PAP"
#define STAPSK  "pap13789"
#endif

String question1 = "Hrana?";
String question2 = "Cijena?";
String question3 = "Usluga?";

String reply1 = "Uzas";
String reply2 = "Nije dobro";
String reply3 = "OK";
String reply4 = "Solidno";
String reply5 = "Genijalno";

int q1ValueToSend = 0;
int q2ValueToSend = 0;
int q3ValueToSend = 0;


const char* ssid     = STASSID;
const char* password = STAPSK;

const char* host = "iotrisevi.herokuapp.com";
const uint16_t port = 80;
String PATH_NAME   = "/insert-response.php";

String HTTP_METHOD = "GET";


RBD::Button button(12);

void setup() {
  Serial.begin(115200);

  lcd.begin();
  lcd.backlight();

  // We start by connecting to a WiFi network

  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  /* Explicitly set the ESP8266 to be a WiFi-client, otherwise, it by default,
     would try to act as both a client and an access-point and could cause
     network-issues with your other WiFi-devices on your WiFi-network. */
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {

lcd.setCursor(0,0);
lcd.print(question1);
while(true)
{
  delay(50);
  int q1Value = analogRead(A0);
  lcd.setCursor(0,1);
  lcd.print(q1Value);
  if(button.onPressed()) {
    q1ValueToSend = q1Value; 
    break;    
  }
}

lcd.setCursor(0,0);
lcd.print(question2);
while(true)
{
  delay(50);
  int q2Value = analogRead(A0);
  lcd.setCursor(0,1);
  lcd.print(q2Value);
  if(button.onPressed()) {
    q2ValueToSend = q2Value; 
    break;    
  }
}

lcd.setCursor(0,0);
lcd.print(question3);
while(true)
{
  delay(50);
  int q3Value = analogRead(A0);
  lcd.setCursor(0,1);
  lcd.print(q3Value);
  if(button.onPressed()) {
    q3ValueToSend = q3Value; 
    break;    
  }
}

sendData(q1ValueToSend,q2ValueToSend,q3ValueToSend);


}

void sendData(int q1ValueToSend, int q2ValueToSend, int q3ValueToSend){
  
  Serial.print("connecting to ");
  Serial.print(host);
  Serial.print(':');
  Serial.println(port);

  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  if (!client.connect(host, port)) {
    Serial.println("connection failed");
    delay(5000);
    return;
  }

  // This will send a string to the server
  Serial.println("sending data to server");
  //String queryString = "?q1=29.1&q2=55&q3=2.525";
  if (client.connected()) {
    client.println(HTTP_METHOD + " " + PATH_NAME + 
    "?q1="+String(q1ValueToSend)
    +"&q2="+String(q2ValueToSend)
    +"&q3="+String(q3ValueToSend) 
    + " HTTP/1.1");
    client.println("Host: " + String(host));
    client.println("Connection: close");
    client.println(); // end HTTP header
  }

  // wait for data to be available
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      delay(60000);
      return;
    }
  }
/*
  // Read all the lines of the reply from server and print them to Serial
  Serial.println("receiving from remote server");
  // not testing 'client.connected()' since we do not need to send data here
  while (client.available()) {
    char ch = static_cast<char>(client.read());
    Serial.print(ch);
  }*/

  // Close the connection
  Serial.println();
  Serial.println("closing connection");
  client.stop();

}

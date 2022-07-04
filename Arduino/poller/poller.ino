#include <RBD_Timer.h>
#include <RBD_Button.h>
#include <ESP8266WiFi.h>

#include <Wire.h> 
#include <LCD_I2C.h>

LCD_I2C lcd(0x27, 16, 2);

#ifndef STASSID
#define STASSID "Soric WiFi"
#define STAPSK  "pitajrobija11"
#endif

const char* ssid     = STASSID;
const char* password = STAPSK;
int    HTTP_PORT   = 80;
String HTTP_METHOD = "GET"; // or POST
char   HOST_NAME[] = "iotrisevi.herokuapp.com";
String GET_POLL_PATH_NAME   = "/get-currentpoll.php";


RBD::Button buttonNext(12);
RBD::Button buttonBack(14);

String questions[50];
int numQuestions = 0;
String buffer = "";
bool firstStringSplitMarkerRead = false;

void setup() {
  Serial.begin(115200);
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
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
  lcd.begin();
  lcd.backlight();
  lcd.clear();
  delay(5000);


  lcd.home();
}

void loop() {

  if(buttonNext.onPressed()) {
    getQuestions();    
    }
  
}

void getQuestions(){
    WiFiClient client;

  if (client.connect(HOST_NAME, HTTP_PORT)) {
    Serial.println("Connected to server");
    client.println(HTTP_METHOD + " " + GET_POLL_PATH_NAME + " HTTP/1.1");
    client.println("Host: " + String(HOST_NAME));
    client.println("Connection: close");
    client.println(); // end HTTP header

    while(client.connected()) {
      if(client.available()){
        // read an incoming byte from the server and print it to serial monitor:
        char c = client.read();
        Serial.print(c);
      }
    }
    
    client.stop();
    Serial.println();
    Serial.println("disconnected");
  } else {// if not connected:
    Serial.println("connection failed");
  }
}

#include <RBD_Timer.h>
#include <RBD_Button.h>
#include <ESP8266WiFi.h>

#include <Wire.h> 
#include <LCD_I2C.h>

// Set the LCD address to 0x27 for a 16 chars and 2 line display
LCD_I2C lcd(0x27, 16, 2);

#ifndef STASSID
#define STASSID "Soric WiFi"
#define STAPSK  "pitajrobija11"
#endif

String question1 = "Hrana?";
String question2 = "Cijena?";
String question3 = "Usluga?";

String questions [] = {question1,question2,question3};

String replies1 [] = {"Uzas","Lose","OK","Dobro","Izvrsno"};
String replies2 [] = {"Jako losa","Losa","OK","Dobra","Izvrsna"};
String replies3 [] = {"Uzasna","Losa","OK","Dobra","Izvrsna"};
String * replies [] = {replies1, replies2, replies3};

int qValues [] = {0,0,0};

const char* ssid     = STASSID;
const char* password = STAPSK;

const char* host = "iotrisevi.herokuapp.com";
const uint16_t port = 80;
String PATH_NAME   = "/insert-response.php";

String HTTP_METHOD = "GET";


RBD::Button button(12);
RBD::Button buttonBack(14);


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

pollQuestions(1);
sendData(qValues);
lcd.clear();
lcd.home();
lcd.print("Hvala!");
delay(3599);

}

void pollQuestion(int qNumber)
{
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print(questions[qNumber-1]);
  int qValue = map(analogRead(A0), 0, 1024, 1, 5);
  lcd.setCursor(0,1);
  lcd.print(replies[qNumber-1][qValue-1]);
  while(true)
  {
    delay(50);
    if(qValue!= map(analogRead(A0), 0, 1024, 1, 5))
    {
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print(questions[qNumber-1]);
      
      qValue = map(analogRead(A0), 0, 1024, 1, 5);
      lcd.setCursor(0,1);
      lcd.print(replies[qNumber-1][qValue-1]);
    }
    if(button.onPressed()) {
      qValues[qNumber-1] = qValue; 
      break;    
    }
    if(buttonBack.onPressed()&&qNumber!=1) {
      pollQuestions(qNumber-1);
      break;    
    }
  }
}

void pollQuestions(int startingQ)
{
  int i = startingQ;
  do
  {
    pollQuestion(i);
    i++;
  }while(i!=4);
}

void sendData(int * qValues){
  
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
    "?q1="+String(qValues[0])
    +"&q2="+String(qValues[1])
    +"&q3="+String(qValues[2]) 
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

#include <RBD_Timer.h>

#include <RBD_Button.h>

#include <ESP8266WiFi.h>

#include <Wire.h>

#include <LCD_I2C.h>

LCD_I2C lcd(0x27, 16, 2);

#ifndef STASSID
#define STASSID "Soric WiFi"
#define STAPSK "pitajrobija11"
#endif

const char * ssid = STASSID;
const char * password = STAPSK;
int HTTP_PORT = 80;
String HTTP_METHOD = "GET"; // or POST
char HOST_NAME[] = "iotrisevi.herokuapp.com";
String GET_POLL_PATH_NAME = "/get-currentpoll.php";
String INSERT_REPLY_PATH_NAME = "/insert-response.php";

RBD::Button buttonNext(12);
RBD::Button buttonBack(14);

String buffer = "";
int numOfQuestions = 0;
String questions[30];
int replies[30];
int currentPollID;

void setup() {
  lcd.begin();
  lcd.backlight();
  Serial.begin(115200);
  Serial.println();
  Serial.println();
  
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Connecting...");
  
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

  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("WiFi connected!");

  delay(1000);

}

void loop() {
  getQuestions();
  pollQuestions(1);
  sendData();
}

void getQuestions() {
  WiFiClient client;

  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Getting Q's...");

  if (client.connect(HOST_NAME, HTTP_PORT)) {
    Serial.println(" ");
    Serial.println("Connected to server");
    client.println("POST /get-currentpoll.php HTTP/1.1");
    client.println("Host: iotrisevi.herokuapp.com");
    client.println("User-Agent: arduino-wifi");
    client.println("Connection: close");
    client.println();

    while (client.connected()) {
      if (client.available()) {
        // read an incoming byte from the server and print it to serial monitor:
        buffer = client.readString();
        Serial.print(buffer);
      }
    }
    // the server's disconnected, stop the client:
    client.stop();
    Serial.println(" ");
    Serial.println("disconnected");
  } else { // if not connected:
    Serial.println("connection failed");
  }

  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Q's recieved!");
  
  numOfQuestions = getNumberOfQuestions(buffer);
  Serial.println(numOfQuestions);

  currentPollID = getValue(buffer,'|',1).toInt();

  for(int i = 1; i < numOfQuestions+1; i++){
    questions[i] = getValue(buffer,'|',i+1);
    Serial.println(questions[i]);
  }
}

String getValue(String data, char separator, int index) {
  int found = 0;
  int strIndex[] = {
    0,
    -1
  };
  int maxIndex = data.length() - 1;

  for (int i = 0; i <= maxIndex && found <= index; i++) {
    if (data.charAt(i) == separator || i == maxIndex) {
      found++;
      strIndex[0] = strIndex[1] + 1;
      strIndex[1] = (i == maxIndex) ? i + 1 : i;
    }
  }

  return found > index ? data.substring(strIndex[0], strIndex[1]) : "";
}

int getNumberOfQuestions(String buffer) {
  int numSeparators = 0;
  for (auto x: buffer) {
    if (x == '|') {
      numSeparators++;
    }
  }

  return numSeparators - 2;
}

void pollQuestions(int qNumber)
{
  if(qNumber > numOfQuestions) return;
  
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print(questions[qNumber-1]);
  int qValue = map(analogRead(A0), 0, 1024, 1, 6);
  lcd.setCursor(8,1);
  lcd.print(qValue);
  while(true)
  {
    delay(50);
    if(qValue!= map(analogRead(A0), 0, 1024, 1, 6))
    {
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print(questions[qNumber-1]);
      
      qValue = map(analogRead(A0), 0, 1024, 1, 6);
      lcd.setCursor(8,1);
      lcd.print(qValue);
    }
    if(buttonNext.onPressed()) {
      replies[qNumber-1] = qValue;
      pollQuestions(qNumber+1); 
      return;   
    }
    if(buttonBack.onPressed()&&qNumber!=1) {
      pollQuestions(qNumber-1);
      break;    
    }
  }
}

void sendData(){

  
  
  Serial.print("connecting to ");
  Serial.print(HOST_NAME);
  Serial.print(':');
  Serial.println(HTTP_PORT);

  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Sending...");

  Serial.println(repliesToString());

 WiFiClient client;

  if (client.connect(HOST_NAME, HTTP_PORT)) {
    Serial.println(" ");
    Serial.println("Connected to server");
    client.println("POST /insert-response.php?values="+repliesToString()+" HTTP/1.1");
    client.println("Host: iotrisevi.herokuapp.com");
    client.println("User-Agent: arduino-wifi");
    client.println("Connection: close");
    client.println();


    client.stop();
    Serial.println(" ");
    Serial.println("disconnected");
  } else { // if not connected:
    Serial.println("connection failed");
  }


  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Thank you!");
  lcd.setCursor(0,1);
  lcd.print("Reply submitted");

}

String repliesToString()
{
  String reply ="";
  for(int i=0; i<numOfQuestions ;i++)
  {
    reply+=(String)replies[i];
    reply+="|";     
  }
  return reply;
}

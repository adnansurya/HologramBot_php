
#include <WiFi.h>
#include <HTTPClient.h>
#include <MFRC522.h>
#include <Arduino_JSON.h>

#define SS_PIN 21
#define RST_PIN 34

#define ledMerah 12
#define ledKuning 14
#define ledHijau 27

MFRC522 mfrc522(SS_PIN, RST_PIN);  

const char* ssid = "HOLOGRAM2";
const char* password = "untukapa?";

//Your Domain name with URL path or IP address with path
const char* serverName = "http://betaku.000webhostapp.com/hologramBot/absen.php?card=";




void setup() {
  Serial.begin(115200);

  pinMode(ledMerah, OUTPUT);
  pinMode(ledKuning, OUTPUT);
  pinMode(ledHijau, OUTPUT);
  
  SPI.begin();      // Initiate  SPI bus
  mfrc522.PCD_Init();   // Initiate MFRC522
  
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  
  Serial.println(WiFi.localIP()); 
  digitalWrite(ledMerah, HIGH);
  digitalWrite(ledKuning, HIGH);
  digitalWrite(ledHijau, HIGH);
  delay(2000);
    

}
String responseText;
void loop() {
  //Send an HTTP POST request every 10 minutes
  digitalWrite(ledMerah, LOW);
  digitalWrite(ledKuning, LOW);
  digitalWrite(ledHijau, LOW);
  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    return;
  }
  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    return;
  }
  //Show UID on serial monitor
//  Serial.print("UID tag :");
  String content= "";
  String uid = "";
  byte letter;
  for (byte i = 0; i < mfrc522.uid.size; i++) 
  {
     content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : "-"));
     content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }

  
  content.toUpperCase();
  uid = content.substring(1);
  Serial.println(uid);
   digitalWrite(ledMerah, HIGH);
  digitalWrite(ledKuning, HIGH);
  digitalWrite(ledHijau, HIGH);
  delay(1000);
   digitalWrite(ledMerah, LOW);
  digitalWrite(ledKuning, LOW);
  digitalWrite(ledHijau, LOW);
 
  responseText =  httpGETRequest(serverName + uid);
  Serial.println(responseText);

  JSONVar myObject = JSON.parse(responseText);
 

  // JSON.typeof(jsonVar) can be used to get the type of the var
  if (JSON.typeof(myObject) == "undefined") {
    Serial.println("Parsing input failed!");
    return;
  }
    JSONVar result = myObject["result"];
    String resultRes;
    result.printTo(resultRes);
  
  Serial.print("JSON object = ");
  Serial.println(myObject);
   delay(1000);
  
   Serial.print("JSON result = ");
  Serial.println(resultRes);
  if(resultRes == "HADIR"){
    digitalWrite(ledHijau, HIGH);      
  }else if(resultRes == "KELUAR"){
   digitalWrite(ledKuning, HIGH);     
  }else{
   digitalWrite(ledMerah, HIGH);   
  }
  delay(3000);
}
String httpGETRequest(String serverName) {
  HTTPClient http;
    
  // Your IP address with path or Domain name with URL path 
  http.begin(serverName);
  
  // Send HTTP POST request
  int httpResponseCode = http.GET();
  
  String payload = "{}"; 
  
  if (httpResponseCode>0) {
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);
    payload = http.getString();
  }
  else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
    digitalWrite(ledMerah, HIGH);
    delay(3000);
    
  }
  // Free resources
  http.end();

  return payload;
}




#include <WiFi.h>
#include <HTTPClient.h>
#include <MFRC522.h>
#include <ArduinoJson.h>


#define SS_PIN 21
#define RST_PIN 34

#define ledKuning 12
#define ledMerah 14
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
  
  int str_len = responseText.length() + 1; 
  char res_array[str_len];
  responseText.toCharArray(res_array, str_len);

  DynamicJsonDocument doc(1024);
  deserializeJson(doc, res_array);
  JsonObject obj = doc.as<JsonObject>();

  String hasil = obj["result"];
  String toneName = obj["data"]["tone"]["ringtone_name"];
  if(toneName ==  "null"){
    toneName = "unknown";  
  }

  if(hasil == "HADIR"){
    digitalWrite(ledHijau, HIGH);  
  }else if(hasil == "KELUAR"){
    digitalWrite(ledKuning, HIGH);
  }else if(hasil == "UNKNOWN"){
    digitalWrite(ledMerah, HIGH);
  }

  Serial.println(hasil + "/" + toneName);

  
  
  
  
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
    for(int i=0; i<3; i++){
      digitalWrite(ledMerah, HIGH);
      delay(500);
      digitalWrite(ledMerah, LOW);
      delay(500);  
    } 
    
    
    
  }
  // Free resources
  http.end();

  return payload;
}

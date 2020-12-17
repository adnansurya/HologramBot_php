
#include <WiFi.h>
#include <HTTPClient.h>
#include <MFRC522.h>

#define SS_PIN 21
#define RST_PIN 34

#define ledMerah 12
#define ledKuning 14
#define ledHijau 27

MFRC522 mfrc522(SS_PIN, RST_PIN);  

const char* ssid = "HOLOGRAM2";
const char* password = "untukapa?";

//Your Domain name with URL path or IP address with path
const char* serverName = "http://betaku.000webhostapp.com/hologramBot/absen.php";



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
  sendPost(uid);
 delay(1000);
  
}

void sendPost(String cardId){
  if(WiFi.status()== WL_CONNECTED){
      HTTPClient http;
      
      // Your Domain name with URL path or IP address with path
      http.begin(serverName);

      // Specify content-type header
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");
      // Data to send with HTTP POST
      String httpRequestData = "card="+cardId;           
      // Send HTTP POST request
      int httpResponseCode = http.POST(httpRequestData);
      
     
     
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
        
      // Free resources
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }  
  
}

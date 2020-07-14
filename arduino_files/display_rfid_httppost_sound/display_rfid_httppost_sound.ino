
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <SoftwareSerial.h>
#include <DFMiniMp3.h>

// implement a notification class,
// its member methods will get called 

#define SS_PIN D8
#define RST_PIN D3
#define SCREEN_WIDTH 128 // OLED display width, in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels
//
class Mp3Notify
{
public:
  static void PrintlnSourceAction(DfMp3_PlaySources source, const char* action)
  {
    if (source & DfMp3_PlaySources_Sd) 
    {
        Serial.print("SD Card, ");
    }
    if (source & DfMp3_PlaySources_Usb) 
    {
        Serial.print("USB Disk, ");
    }
    if (source & DfMp3_PlaySources_Flash) 
    {
        Serial.print("Flash, ");
    }
    Serial.println(action);
  }
  static void OnError(uint16_t errorCode)
  {
    // see DfMp3_Error for code meaning
    Serial.println();
    Serial.print("Com Error ");
    Serial.println(errorCode);
  }
  static void OnPlayFinished(DfMp3_PlaySources source, uint16_t track)
  {
    Serial.print("Play finished for #");
    Serial.println(track);  
  }
  static void OnPlaySourceOnline(DfMp3_PlaySources source)
  {
    PrintlnSourceAction(source, "online");
  }
  static void OnPlaySourceInserted(DfMp3_PlaySources source)
  {
    PrintlnSourceAction(source, "inserted");
  }
  static void OnPlaySourceRemoved(DfMp3_PlaySources source)
  {
    PrintlnSourceAction(source, "removed");
  }
};




/* Set these to your desired credentials. */
const char *ssid = "HOLOGRAM2";  //ENTER YOUR WIFI SETTINGS
const char *password = "untukapa?";

//Web/Server address to read/write from 
const char *host = "betaku.000webhostapp.com";
const int httpsPort = 443;  //HTTPS= 443 and HTTP = 80

//SHA1 finger print of certificate use web browser to view and copy
const char fingerprint[] PROGMEM = "5B FB D1 D4 49 D3 0F A9 C6 40 03 34 BA E0 24 05 AA D2 E2 01";




DFMiniMp3<HardwareSerial, Mp3Notify> mp3(Serial);
// Declaration for an SSD1306 display connected to I2C (SDA, SCL pins)
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);
MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance.

void setup() {
//  Serial.begin(9600);/

    
 if(!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) { // Address 0x3D for 128x64
//    Serial.println(F("SSD1306 allocation failed"));/
    for(;;);
  }

  mp3.begin();
    uint16_t volume = mp3.getVolume();
     mp3.setVolume(40);
     uint16_t count = mp3.getTotalTrackCount(DfMp3_PlaySource_Sd); 

  SPI.begin();      // Initiate  SPI bus
  mfrc522.PCD_Init();   // Initiate MFRC522
  Serial.println("Approximate your card to the reader...");
  Serial.println();
  

  

  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);        //Only Station No AP, This line hides the viewing of ESP as wifi hotspot
  
  WiFi.begin(ssid, password);     //Connect to your WiFi router
//  Serial.println("");/
  display.clearDisplay();
  display.setTextColor(WHITE);
  display.setTextSize(1);
  display.setCursor(10, 10);
  display.print("Connecting");
 
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    display.print(".");
     display.display(); 
  }

  //If connection successful show IP address in serial monitor
//  Serial.println("");/
  display.clearDisplay();
  display.setTextSize(1);
  display.setCursor(0, 10);
  display.print("Connected to ");
  display.println(ssid);
  display.display();
  delay(2500); 
  display.println("IP address: ");
  display.println(WiFi.localIP());  //IP address assigned to your ESP
  display.display();
  delay(2500); 
  display.clearDisplay();
  mp3.playMp3FolderTrack(1); 
  display.setTextSize(2);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  // Display static text
  display.println("SILAHKAN");
  display.println("TAP KARTU ANDA");
  display.display(); 
      
  
}

void loop() {

  display.clearDisplay();

  display.setTextSize(2);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  // Display static text
  display.println("SILAHKAN");
  display.println("TAP KARTU ANDA");
  display.display();

  // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    return;
  }
  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    return;
  }

//  Serial.print("UID tag :");/
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
 
//  Serial.println(uid);/

  
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  display.println("ID Kartu : ");
  display.setCursor(0, 20);
  display.println(uid);
  display.setCursor(0, 33);
  display.setTextSize(1);
  display.println("Mengirim Data...");  
  
  display.display();
  sendPostData(uid); 
  
}


void sendPostData(String card){
  card.trim();  
  WiFiClientSecure httpsClient;    //Declare object of class WiFiClient

//  Serial.println(host);/

//  Serial.printf("Using fingerprint '%s'\n", fingerprint);/
  httpsClient.setFingerprint(fingerprint);
  httpsClient.setTimeout(15000); // 15 Seconds
  delay(1000);
  
//  Serial.print("HTTPS Connecting");/
  int r=0; //retry counter
  while((!httpsClient.connect(host, httpsPort)) && (r < 30)){
      delay(100);
      Serial.print(".");
      r++;
  }
  if(r==30) {
//    Serial.println("Connection failed");/
    mp3.playMp3FolderTrack(4); 
    display.setCursor(0, 43);
    display.setTextSize(1);
    display.println("Koneksi Gagal!");  
    
    display.display();
  }
  else {
//    Serial.println("Connected to web");/
  }
  
  String getData, Link, reqData, dataLength;
  
  //POST Data
  Link = "/hologramBot/absen.php";
  reqData = "card="+card;
  dataLength = String(reqData.length());

//  Serial.print("requesting URL: ");/
//  Serial.println(host);/

  httpsClient.print(String("POST ") + Link + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded"+ "\r\n" +
               "Content-Length: "+ dataLength + "\r\n\r\n" +
                reqData + "\r\n" +
               "Connection: close\r\n\r\n");

//  Serial.println("request sent");/
                  
  while (httpsClient.connected()) {
    String line = httpsClient.readStringUntil('\n');
    
    if (line == "\r") {
//      Serial.println("headers received");/
      break;
    }
  }

//  Serial.println("reply was:");/
//  Serial.println("==========");/
  String line;
  display.setCursor(0, 43);
  display.setTextSize(2);
  while(httpsClient.available()){        
    line = httpsClient.readStringUntil('\n');  //Read Line by Line
    line.trim();
    if(line == "HADIR"){
       mp3.playMp3FolderTrack(2);
       
        display.println(line);
       display.display(); 
    }else if(line == "KELUAR"){
       mp3.playMp3FolderTrack(3); 
       display.println(line);
       display.display(); 
    }else if(line == "ERROR"){
       mp3.playMp3FolderTrack(4);  
       display.println(line);
       display.display();  
    }
    
//    Serial.println(line); //Print response/
  }
//  Serial.println("==========");
//  Serial.println("closing connection");  
//  Serial.println("Connection failed");

display.setCursor(0, 43);
  display.setTextSize(2);
  display.println("OK");
     display.display();
     


  
  delay(2000);
    
}



#include <WiFi.h>
#include <WiFiClientSecure.h>
#include <UniversalTelegramBot.h>
#include "soc/soc.h"
#include "soc/rtc_cntl_reg.h"
#include "esp_camera.h"

//CAMERA_MODEL_AI_THINKER
#define PWDN_GPIO_NUM     32
#define RESET_GPIO_NUM    -1
#define XCLK_GPIO_NUM      0
#define SIOD_GPIO_NUM     26
#define SIOC_GPIO_NUM     27
#define Y9_GPIO_NUM       35
#define Y8_GPIO_NUM       34
#define Y7_GPIO_NUM       39
#define Y6_GPIO_NUM       36
#define Y5_GPIO_NUM       21
#define Y4_GPIO_NUM       19
#define Y3_GPIO_NUM       18
#define Y2_GPIO_NUM        5
#define VSYNC_GPIO_NUM    25
#define HREF_GPIO_NUM     23
#define PCLK_GPIO_NUM     22

const unsigned long BOT_MTBS = 1000; // mean time between scan messages

const char* ssid     = "HOLOGRAM2";   //WIFI SSID
const char* password = "untukapa?";   //WIFI password
String token = "1564078066:AAHpbk7ryIumTCBIhMsxz4tvXF62KEEEDLk";
String hologram_id = "-1001195370799";
String adnan_id = "108488036";

int gpioPIR = 13;   //PIR Motion Sensor
WiFiClientSecure secured_client;
UniversalTelegramBot bot(token, secured_client);
unsigned long bot_lasttime;          // last time messages' scan has been done
bool Start = false;

String chat_id;
int inputSignal = 0;

void handleNewMessages(int numNewMessages)
{
  Serial.println("handleNewMessages");
  Serial.println(String(numNewMessages));

  for (int i = 0; i < numNewMessages; i++)
  {
    chat_id = bot.messages[i].chat_id;
    String text = bot.messages[i].text;

    String from_name = bot.messages[i].from_name;
    if (from_name == "")
      from_name = "Guest";

   
      
  
       if (text == "/capture" || text == "/capture@holocambot") {
         ledcAttachPin(4, 3);
          ledcSetup(3, 5000, 8);
           ledcWrite(3,10);
    
          bot.sendMessage(chat_id, "Mengambil gambar...");
          Serial.println("ambil gambar");
          alerts2Telegram(token, chat_id);
//          delay(3000);
           ledcWrite(3,0);
            ledcDetachPin(3);
        
      }
      
    }

    
  }



void setup()
{
  WRITE_PERI_REG(RTC_CNTL_BROWN_OUT_REG, 0);
  
  Serial.begin(115200);
  delay(10);
  WiFi.mode(WIFI_STA);
  Serial.println("");
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);  
   secured_client.setCACert(TELEGRAM_CERTIFICATE_ROOT); 
  long int StartTime=millis();
  while (WiFi.status() != WL_CONNECTED) 
  {
    delay(500);
    if ((StartTime+10000) < millis()) break;
  } 

  Serial.println("");
  Serial.println("STAIP address: ");
  Serial.println(WiFi.localIP());
  Serial.println("");

  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("Reset");
    
    ledcAttachPin(4, 3);
    ledcSetup(3, 5000, 8);
    ledcWrite(3,10);
    delay(200);
    ledcWrite(3,0);
    delay(200);    
    ledcDetachPin(3);
    delay(1000);
    ESP.restart();
  }
  else 
  {
    ledcAttachPin(4, 3);
    ledcSetup(3, 5000, 8);
    for (int i=0;i<5;i++) {
      ledcWrite(3,10);
      delay(200);
      ledcWrite(3,0);
      delay(200);    
    }
    ledcDetachPin(3);      
  }

 

  camera_config_t config;
  config.ledc_channel = LEDC_CHANNEL_0;
  config.ledc_timer = LEDC_TIMER_0;
  config.pin_d0 = Y2_GPIO_NUM;
  config.pin_d1 = Y3_GPIO_NUM;
  config.pin_d2 = Y4_GPIO_NUM;
  config.pin_d3 = Y5_GPIO_NUM;
  config.pin_d4 = Y6_GPIO_NUM;
  config.pin_d5 = Y7_GPIO_NUM;
  config.pin_d6 = Y8_GPIO_NUM;
  config.pin_d7 = Y9_GPIO_NUM;
  config.pin_xclk = XCLK_GPIO_NUM;
  config.pin_pclk = PCLK_GPIO_NUM;
  config.pin_vsync = VSYNC_GPIO_NUM;
  config.pin_href = HREF_GPIO_NUM;
  config.pin_sscb_sda = SIOD_GPIO_NUM;
  config.pin_sscb_scl = SIOC_GPIO_NUM;
  config.pin_pwdn = PWDN_GPIO_NUM;
  config.pin_reset = RESET_GPIO_NUM;
  config.xclk_freq_hz = 20000000;
  config.pixel_format = PIXFORMAT_JPEG;

  if(psramFound())
{
    config.frame_size = FRAMESIZE_VGA;
    config.jpeg_quality = 10;  //0-63 lower number means higher quality
    config.fb_count = 2;
  } 
else 
{
    config.frame_size = FRAMESIZE_QQVGA;
    config.jpeg_quality = 12;  //0-63 lower number means higher quality
    config.fb_count = 1;
  }
  
  // camera init
  esp_err_t err = esp_camera_init(&config);
  if (err != ESP_OK) 
{
    Serial.printf("Camera init failed with error 0x%x", err);
    delay(1000);
    ESP.restart();
  }

sensor_t * s = esp_camera_sensor_get();
 s->set_framesize(s, FRAMESIZE_XGA); 

   Serial.print("Retrieving time: ");
  configTime(0, 0, "pool.ntp.org"); // get UTC time via NTP
  time_t now = time(nullptr);
  while (now < 24 * 3600)
  {
    Serial.print(".");
    delay(100);
    now = time(nullptr);
  }
  Serial.println(now);

  inputSignal = 0;
  chat_id = hologram_id;
  delay(1000);

}

void loop()
{
 
//  pinMode(gpioPIR, INPUT_PULLUP);
//  int v = digitalRead(gpioPIR);
//  Serial.println(v);
//  if (v==1)
//  {
//    alerts2Telegram(token, chat_id);
//    delay(10000); 
//  }
//  delay(1000);  
 
 if (millis() - bot_lasttime > BOT_MTBS)
  {       
    

Serial.println("Movement : " + String(inputSignal));



       
       pinMode(gpioPIR, INPUT_PULLUP);
 inputSignal = digitalRead(gpioPIR);       
    if (inputSignal==1)
    {
        ledcAttachPin(4, 3);
          ledcSetup(3, 5000, 8);
           ledcWrite(3,10);
     
      alerts2Telegram(token, chat_id);
//       delay(3000);
       ledcWrite(3,0);
            ledcDetachPin(3);
    }
  
 
 int numNewMessages = bot.getUpdates(bot.last_message_received + 1);
    

    while (numNewMessages)
    {
      Serial.println("got response");
      handleNewMessages(numNewMessages);
      numNewMessages = bot.getUpdates(bot.last_message_received + 1);
    }
   
    bot_lasttime = millis();
  }

  
//delay(500);

  
  
}

String alerts2Telegram(String token, String chat_id) 
{
  const char* myDomain = "api.telegram.org";
  String getAll="", getBody = "";

  camera_fb_t * fb = NULL;
  fb = esp_camera_fb_get();  
  if(!fb) 
{
    Serial.println("Camera capture failed");
    delay(1000);
    ESP.restart();
    return "Camera capture failed";
  }  
  

WiFiClientSecure client_tcp;
  
  if (client_tcp.connect(myDomain, 443)) 
{
    Serial.println("Connected to " + String(myDomain));
    
    String head = "--India\r\nContent-Disposition: form-data; name=\"chat_id\"; \r\n\r\n" + chat_id + "\r\n--India\r\nContent-Disposition: form-data; name=\"photo\"; filename=\"esp32-cam.jpg\"\r\nContent-Type: image/jpeg\r\n\r\n";
    String tail = "\r\n--India--\r\n";

    uint16_t imageLen = fb->len;
    uint16_t extraLen = head.length() + tail.length();
    uint16_t totalLen = imageLen + extraLen;
  
    client_tcp.println("POST /bot"+token+"/sendPhoto HTTP/1.1");
    client_tcp.println("Host: " + String(myDomain));
    client_tcp.println("Content-Length: " + String(totalLen));
    client_tcp.println("Content-Type: multipart/form-data; boundary=India");
    client_tcp.println();
    client_tcp.print(head);
  
    uint8_t *fbBuf = fb->buf;
    size_t fbLen = fb->len;


    for (size_t n=0;n<fbLen;n=n+1024)
 {

      if (n+1024<fbLen) 
{
        client_tcp.write(fbBuf, 1024);
        fbBuf += 1024;
      }
      else if (fbLen%1024>0) 
{
        size_t remainder = fbLen%1024;
        client_tcp.write(fbBuf, remainder);
      }
    }  
    
    client_tcp.print(tail);
    
    esp_camera_fb_return(fb);
    
    int waitTime = 10000;   // timeout 10 seconds
    long startTime = millis();
    boolean state = false;
    
    while ((startTime + waitTime) > millis())
    {
      Serial.print(".");
      delay(100);      
      while (client_tcp.available()) 
      {
          char c = client_tcp.read();
          if (c == '\n') 
          {
            if (getAll.length()==0) state=true; 
            getAll = "";
          } 
          else if (c != '\r')
            getAll += String(c);
          if (state==true) getBody += String(c);
          startTime = millis();
       }
       if (getBody.length()>0) break;
    }
    client_tcp.stop();
    Serial.println(getBody);
  }
  else {
    getBody = "Connection to telegram failed.";
    Serial.println("Connection to telegram failed.");
   bot.sendMessage(chat_id, "Gagal mengirim gambar");
  }

  if(chat_id != hologram_id){
          
      if (client_tcp.connect(myDomain, 443)){
            Serial.println("Connected to " + String(myDomain));
            
            String head = "--India\r\nContent-Disposition: form-data; name=\"chat_id\"; \r\n\r\n" + adnan_id + "\r\n--India\r\nContent-Disposition: form-data; name=\"photo\"; filename=\"esp32-cam.jpg\"\r\nContent-Type: image/jpeg\r\n\r\n";
            String tail = "\r\n--India--\r\n";
        
            uint16_t imageLen = fb->len;
            uint16_t extraLen = head.length() + tail.length();
            uint16_t totalLen = imageLen + extraLen;
          
            client_tcp.println("POST /bot"+token+"/sendPhoto HTTP/1.1");
            client_tcp.println("Host: " + String(myDomain));
            client_tcp.println("Content-Length: " + String(totalLen));
            client_tcp.println("Content-Type: multipart/form-data; boundary=India");
            client_tcp.println();
            client_tcp.print(head);
          
            uint8_t *fbBuf = fb->buf;
            size_t fbLen = fb->len;
        
        
            for (size_t n=0;n<fbLen;n=n+1024)
         {
        
              if (n+1024<fbLen) 
        {
                client_tcp.write(fbBuf, 1024);
                fbBuf += 1024;
              }
              else if (fbLen%1024>0) 
        {
                size_t remainder = fbLen%1024;
                client_tcp.write(fbBuf, remainder);
              }
            }  
            
            client_tcp.print(tail);
            
            esp_camera_fb_return(fb);
            
            int waitTime = 10000;   // timeout 10 seconds
            long startTime = millis();
            boolean state = false;
            
            while ((startTime + waitTime) > millis())
            {
              Serial.print(".");
              delay(100);      
              while (client_tcp.available()) 
              {
                  char c = client_tcp.read();
                  if (c == '\n') 
                  {
                    if (getAll.length()==0) state=true; 
                    getAll = "";
                  } 
                  else if (c != '\r')
                    getAll += String(c);
                  if (state==true) getBody += String(c);
                  startTime = millis();
               }
               if (getBody.length()>0) break;
            }
            client_tcp.stop();
            Serial.println(getBody);
          }
          else {
            getBody = "Connection to telegram failed.";
            Serial.println("Connection to telegram failed.");
           bot.sendMessage(adnan_id, "Gagal mengirim gambar duplikat");
          }  
  }
  
  return getBody;
}


#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <Adafruit_MLX90614.h>



#define SCREEN_WIDTH 128 // OLED display width, in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels

// Declaration for an SSD1306 display connected to I2C (SDA, SCL pins)
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);
Adafruit_MLX90614 mlx = Adafruit_MLX90614();

void setup() {
  Serial.begin(9600);
  mlx.begin(); 

  if(!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) { // Address 0x3D for 128x64
    Serial.println(F("SSD1306 allocation failed"));
    for(;;);
  }
  delay(2000);
  display.clearDisplay();

  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  // Display static text
  display.println("Initializing...");
  display.display(); 
}

void loop() {
  display.clearDisplay();
  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 0);
  // Display dynamic text
  display.println("Suhu Ruangan :"); 
  display.setTextSize(2);
  display.println(mlx.readAmbientTempC()); 
  display.setTextSize(1);
  display.println("\nSuhu Objek :"); 
  display.setTextSize(2);
  display.print(mlx.readObjectTempC()); 
  display.println(" *C");
  
//  display.print("Ambient = "); 
//  display.print(mlx.readAmbientTempF()); 
//  display.print("*F\nObject = "); 
//  display.print(mlx.readObjectTempF()); 
//  display.println("*F");

  display.display();


  Serial.print(mlx.readAmbientTempC());
  Serial.print("|");
  Serial.println(mlx.readObjectTempC());
  delay(500); 
  
}

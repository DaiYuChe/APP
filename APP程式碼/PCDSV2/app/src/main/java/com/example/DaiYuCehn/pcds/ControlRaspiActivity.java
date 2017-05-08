package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/8/10.
 */
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class ControlRaspiActivity extends Activity {


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_control_raspi);
    }

    public void buzzer(View view){
        startActivity(new Intent(this, ControlRaspiBuzzer.class));
    }

    public void SystemState(View view){
        startActivity(new Intent(this, ControlSystemState.class));
    }
    public void takePicture(View view){
        startActivity(new Intent(this, ImmediateImage.class));
    }
    public void control_led(View view){
        startActivity(new Intent(this, ControlLED.class));
    }
    public void playMusic(View view){
        startActivity(new Intent(this, PlayMusic.class));
    }
}

package com.example.user01.pcds;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;

/**
 * Created by user01 on 2016/5/25.
 */
public class SplashActivity extends Activity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        // TODO Auto-generated method stub
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);
        new Thread(new Runnable(){
            @Override
            public void run() {
                // TODO Auto-generated method stub
                try {
                    Thread.sleep(3000);
                    startActivity(new Intent().setClass(SplashActivity.this, MainActivity.class));
                    SplashActivity.this.finish();
                } catch (InterruptedException e) {
                    // TODO Auto-generated catch block
                    e.printStackTrace();
                }
            }
        }).start();
    }
}

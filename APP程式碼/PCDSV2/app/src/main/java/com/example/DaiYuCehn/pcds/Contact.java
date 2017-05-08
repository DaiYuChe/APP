package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/8/10.
 */
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

public class Contact extends AppCompatActivity {

    TextView tv1;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_contact);
        setTitle("聯絡資訊");
        tv1 = (TextView) findViewById(R.id.contactMe);
        tv1.setText("作者: 戴宇辰\n系級: 資工4A\n電話: 0909805676\nE-mail: tony7962845@yahoo.com.tw\n\n歡迎洽詢 :)\n");
    }
}

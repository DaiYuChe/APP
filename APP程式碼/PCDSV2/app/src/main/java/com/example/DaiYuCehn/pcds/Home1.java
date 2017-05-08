package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/8/2.
 */
 
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

public class Home1 extends AppCompatActivity {
    String use, pass, Err, show;
    TextView err, showTV;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home1);

        showTV = (TextView) findViewById(R.id.tv);
        err = (TextView) findViewById(R.id.err);

        use = getIntent().getStringExtra("use");
        pass = getIntent().getStringExtra("pass");
        show = getIntent().getStringExtra("use");
        Err = getIntent().getStringExtra("err");

        // Toast.makeText(this, "登入成功", Toast.LENGTH_SHORT).show();
        showTV.setText("歡迎來到 " + show + " ROOT介面");

        err.setText(Err);
    }
}

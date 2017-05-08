package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/8/21.
 */
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

public class Introduction extends AppCompatActivity {

    TextView tv;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_introduction);
        setTitle("系統簡述");
        tv = (TextView) findViewById(R.id.aboutTV);
        tv.setText(
                "  本系統經實測結果，在意圖者接近電腦2公尺感測範圍內，在1秒內發出警報聲，接著啟動高亮度LED燈光與相機連續拍照，並保存於遠端資料庫，同時在5秒內傳送警告訊息及企圖者照片到使用者手機，使用者可經由APP介面，發送語音警告，達到立即預警及防患功效。\n");
    }
}

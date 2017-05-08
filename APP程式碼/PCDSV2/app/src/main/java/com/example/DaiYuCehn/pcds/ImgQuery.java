package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/8/23.
 */
 
import android.app.Activity;
import android.app.DownloadManager;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.Matrix;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import com.squareup.picasso.Picasso;

import java.net.URI;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.protocol.HTTP;
import org.apache.http.util.EntityUtils;
import org.w3c.dom.Text;


import android.app.Activity;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.View;
import android.widget.*;  //加入widget類別

public class ImgQuery extends Activity {
    EditText ed1;
    ImageView imgShow;
    String getEd1;
    TextView tv;

    EditText edtYear;
    EditText edtMonth;
    EditText edtDate;
    TextView tv1;

    private String url = "http://203.72.0.26/~nhu1403/APP_QueryImg.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_img_query);

        ed1 = (EditText) findViewById(R.id.edtPic);
        tv = (TextView) findViewById(R.id.showImgName);
        imgShow = (ImageView) findViewById(R.id.imgView);

        tv1 = (TextView)findViewById(R.id.responseTV);
        edtYear = (EditText)findViewById(R.id.edtYear);
        edtMonth = (EditText)findViewById(R.id.edtMonth);
        edtDate = (EditText)findViewById(R.id.edtDate);

    }

    public void img_select(View view){
        getEd1 = ed1.getText().toString();
        if(imgShow != null || imgShow.getDrawable() != null) {
            Picasso.with(getApplicationContext()).load("http://203.72.0.26/~nhu1403/nhu1403-" + getEd1 + ".jpg").into(imgShow);
            tv.setText("nhu1403-" + getEd1 + ".jpg");
        }
        else{
            Toast.makeText(this, "無此圖片!", Toast.LENGTH_SHORT).show();
        }
    }
    int i = 0;
    public void partQuery(View view){
        HttpThread myThread = new HttpThread();
        //設定變數值
        myThread.year = edtYear.getText().toString();
        myThread.month = edtMonth.getText().toString();
        myThread.date = edtDate.getText().toString();
        myThread.Url = url;
        //開始執行緒
        myThread.start();


    }
    int j = 0;
    public void Querry_next(View view){
        String[] tokens = tv1.getText().toString().split("nhu1403 .jpg");
        for(String token:tokens) {
            j++;
        }

            Picasso.with(getApplicationContext()).load("http://203.72.0.26/~nhu1403/nhu1403-" + tokens + ".jpg").into(imgShow);

    }

    public void query_previous(View view){

    }
    int count = 0;
    //必須利用Handler來改變主執行緒的UI值
    private Handler mHandler = new Handler() {
        public void handleMessage(Message msg) {
            super.handleMessage(msg);
            count++;
            //msg.getData會傳回Bundle，Bundle類別可以由getString(<KEY_NAME>)取出指定KEY_NAME的值
            tv1.setText(msg.getData().getString("response"));
        }
    };

    //宣告一個新的類別並擴充Thread
    class HttpThread extends Thread {

        //宣告變數並指定預設值
        public String year = "NoData" ;
        public String month = "Nodata" ;
        public String date = "Nodata" ;
        public String Url = "http://203.72.0.26/~nhu1403/APP_QueryImg.php";

        @Override
        public void run() {
            // TODO Auto-generated method stub
            super.run();

            //宣告一個新的Bundle物件，Bundle可以在多個執行緒之間傳遞訊息
            Bundle myBundle = new Bundle();

            try {
                HttpClient client = new DefaultHttpClient();
                URI website = new URI(this.Url);

                //指定POST模式
                HttpPost request = new HttpPost();

                //POST傳值必須將key、值加入List<NameValuePair>
                List<NameValuePair> parmas = new ArrayList<NameValuePair>();

                //逐一增加POST所需的Key、值
                parmas.add(new BasicNameValuePair("year",this.year));
                parmas.add(new BasicNameValuePair("month",this.month));
                parmas.add(new BasicNameValuePair("date",this.date));

                //宣告UrlEncodedFormEntity來編碼POST，指定使用UTF-8
                UrlEncodedFormEntity env = new UrlEncodedFormEntity(parmas,HTTP.UTF_8);
                request.setURI(website);

                //設定POST的List
                request.setEntity(env);

                HttpResponse response = client.execute(request);
                HttpEntity resEntity = response.getEntity();
                if(resEntity != null){
                    myBundle.putString("response",EntityUtils.toString(resEntity));
                }else{
                    myBundle.putString("response","Nothing");
                }

                Message msg = new Message();
                msg.setData(myBundle);
                mHandler.sendMessage(msg);

            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }
}

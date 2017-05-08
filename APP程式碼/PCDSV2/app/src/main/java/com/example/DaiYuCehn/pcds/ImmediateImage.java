package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/8/22.
 */
 
import java.net.Socket;
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


import android.app.Activity;
import android.app.DownloadManager;
import android.content.Context;
import android.net.Uri;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.support.v4.widget.SwipeRefreshLayout;
import android.view.View;
import android.widget.*;  //加入widget類別
import com.squareup.picasso.Picasso;


public class ImmediateImage extends Activity {

    TextView tv1;
    Context ctx;
    DownloadManager downloadManager;

    private String uri = "http://203.72.0.26/~nhu1403/APP_takePic.php";

    ImageView imageView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_immediate_image);
        tv1 = (TextView)findViewById(R.id.imgTV1);
        imageView = (ImageView)findViewById(R.id.iv);
        //Picasso.with(getApplicationContext()).load("http://203.72.0.26/~nhu1403/Test_Image-1.jpg").into(imageView);

    }
    int i = 1;
    Socket socket;
    public void Img_next(View view){
        tv1 = (TextView) findViewById(R.id.imgTV1);
        Picasso.with(getApplicationContext()).load("http://203.72.0.26/~nhu1403/Test_Image-1.jpg").into(imageView);
       //tv1.setText("Test_Image-1.jpg");


    }
    public void Download(View view){
        downloadManager = (DownloadManager) getSystemService(Context.DOWNLOAD_SERVICE);
        Uri uri = Uri.parse("http://203.72.0.26/~nhu1403/Test_Image-1.jpg");
        DownloadManager.Request request = new DownloadManager.Request(uri);
        request.setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED);
        downloadManager.enqueue(request);
    }

    public void Img_previous(View view){
        tv1 = (TextView) findViewById(R.id.imgTV1);

        if(imageView == null || imageView.getDrawable() == null){
            Toast.makeText(this, "沒有圖片了", Toast.LENGTH_LONG).show();
            i = 0;
            Picasso.with(getApplicationContext()).load("http://203.72.0.26/~nhu1403/Test_Image-" + (--i) + ".jpg").into(imageView);
            tv1.setText("Test_Image-" + (i) + ".jpg");
        }
        else {
            Picasso.with(getApplicationContext()).load("http://203.72.0.26/~nhu1403/Test_Image-" + (--i) + ".jpg").into(imageView);
            tv1.setText("Test_Image-" + (i) + ".jpg");
        }
    }
    //必須利用Handler來改變主執行緒的UI值
    private Handler mHandler = new Handler() {
        public void handleMessage(Message msg) {
            super.handleMessage(msg);
            //msg.getData會傳回Bundle，Bundle類別可以由getString(<KEY_NAME>)取出指定KEY_NAME的值
            tv1.setText(msg.getData().getString("response"));
        }
    };

    //按鈕的Click事件
    public void takeOne(View v) {
        //產生新的HttpThread物件
        HttpThread myThread = new HttpThread();
        //設定變數值
        myThread.takeImg = "0100000";
        //myThread.stopTake = "000";
        myThread.Url = uri.toString();
        //開始執行緒
        myThread.start();
    }

    public void stopTake(View view){
        //產生新的HttpThread物件
        HttpThread myThread = new HttpThread();
        //設定變數值
        myThread.takeImg = "0000000";
        //myThread.stopTake = "000";
        myThread.Url = uri.toString();
        //開始執行緒
        myThread.start();
        finish();
        startActivity(getIntent());
    }

    //宣告一個新的類別並擴充Thread
    class HttpThread extends Thread {

        //宣告變數並指定預設值
        public String takeImg = "NoData" ;
        //public String stopTake = "Nodata" ;
        public String Url = "http://203.72.0.26/~nhu1403/APP_takePic.php";

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
                parmas.add(new BasicNameValuePair("takeImg",this.takeImg));
                //parmas.add(new BasicNameValuePair("stopTake",this.stopTake));

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

package com.example.user01.pcds;
/**
 * Created by DaiYuChen on 2016/8/20.
 */
 
import android.support.v4.app.Fragment;
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


import android.app.Activity;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.View;
import android.widget.*;  //加入widget類別

public class LoadingImage extends Activity {

        ImageView ivImageFromUrl;
        TextView tv1, tv2;
        int count = 0;
        DownloadManager downloadManager;
        private String uri = "http://203.72.0.26/~nhu1403/getImageTime.php";
        Button b1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_loading_image);
        tv2 = (TextView)findViewById(R.id.tv2);

        ivImageFromUrl = (ImageView)findViewById(R.id.iv_image_from_url);
        Picasso.with(getApplicationContext()).load("http://203.72.0.26/~nhu1403/nhu1403-1.jpg").into(ivImageFromUrl);
    }
    int i = 1;
    public void next(View view){
        tv1 = (TextView) findViewById(R.id.tv1);
        //產生新的HttpThread物件
        HttpThread myThread = new HttpThread();
        //設定變數值
        //myThread.MyMessage=ed2.getText().toString();
        myThread.Url = uri.toString();
        //開始執行緒
        b1 = (Button) findViewById(R.id.downloadImg);
        if(ivImageFromUrl == null || ivImageFromUrl.getDrawable() == null){
            Toast.makeText(this, "沒有圖片了", Toast.LENGTH_LONG).show();
            i = 0;
            Picasso.with(getApplicationContext()).load("http://203.72.0.26/~nhu1403/nhu1403-" + (++i) + ".jpg").into(ivImageFromUrl);
            tv1.setText("nhu1403-" + (i) + ".jpg");
            myThread.ImageName = tv1.getText().toString();
            myThread.start();
            b1.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    downloadManager = (DownloadManager) getSystemService(Context.DOWNLOAD_SERVICE);
                    Uri uri = Uri.parse("http://203.72.0.26/~nhu1403/nhu1403-" + i + ".jpg");
                    DownloadManager.Request request = new DownloadManager.Request(uri);
                    request.setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED);
                    downloadManager.enqueue(request);
                }
            });
        }
        else {
            Picasso.with(getApplicationContext()).load("http://203.72.0.26/~nhu1403/nhu1403-" + (++i) + ".jpg").into(ivImageFromUrl);
            tv1.setText("nhu1403-" + (i) + ".jpg");
            myThread.ImageName = tv1.getText().toString();
            myThread.start();
            b1.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    downloadManager = (DownloadManager) getSystemService(Context.DOWNLOAD_SERVICE);
                    Uri uri = Uri.parse("http://203.72.0.26/~nhu1403/nhu1403-" + i + ".jpg");
                    DownloadManager.Request request = new DownloadManager.Request(uri);
                    request.setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED);
                    downloadManager.enqueue(request);
                }
            });

        }
    }
    public void previous(View view){
        tv1 = (TextView) findViewById(R.id.tv1);
        //產生新的HttpThread物件
        HttpThread myThread = new HttpThread();
        //設定變數值
        myThread.Url = uri.toString();
        //開始執行緒
        if(ivImageFromUrl == null || ivImageFromUrl.getDrawable() == null){
            Toast.makeText(this, "沒有圖片了", Toast.LENGTH_LONG).show();
            i = 0;
            Picasso.with(getApplicationContext()).load("http://203.72.0.26/~nhu1403/nhu1403-" + (--i) + ".jpg").into(ivImageFromUrl);
            tv1.setText("nhu1403-" + (i) + ".jpg");
            myThread.ImageName = tv1.getText().toString();
            myThread.start();
        }
        else {
            Picasso.with(getApplicationContext()).load("http://203.72.0.26/~nhu1403/nhu1403-" + (--i) + ".jpg").into(ivImageFromUrl);
            tv1.setText("nhu1403-" + (i) + ".jpg");
            myThread.ImageName = tv1.getText().toString();
            myThread.start();
        }
    }

    public void ImgBigger(View view){
        //imageView轉Bitmap
        ivImageFromUrl.buildDrawingCache();
        Bitmap bmp=ivImageFromUrl.getDrawingCache();

        //轉換為圖片指定大小
        //獲得圖片的寬高
        int width = bmp.getWidth();
        int height = bmp.getHeight();

        //放大為1.2倍
        float scaleWidth = (float) 2;
        float scaleHeight = (float) 2;

        // 取得想要缩放的matrix參數
        Matrix matrix = new Matrix();
        matrix.postScale(scaleWidth, scaleHeight);
        // 得到新的圖片
        Bitmap newbm = Bitmap.createBitmap(bmp, 0, 0, width, height, matrix,true);

        //重新載入 imageView
        ivImageFromUrl.setImageBitmap(newbm);
    }

    public void ImgQuery(View view){
        startActivity(new Intent(this, ImgQuery.class));
    }

    public void ImgSmaller(View view){
        //imageView轉Bitmap
        ivImageFromUrl.buildDrawingCache();
        Bitmap bmp=ivImageFromUrl.getDrawingCache();

        //轉換為圖片指定大小
        //獲得圖片的寬高
        int width = bmp.getWidth();
        int height = bmp.getHeight();
        // 設置想要的大小
        int newWidth = 640;
        int newHeight = 480;
        // 計算缩放比例
        float scaleWidth = ((float) newWidth) / width;
        float scaleHeight = ((float) newHeight) / height;
        // 取得想要缩放的matrix參數
        Matrix matrix = new Matrix();
        matrix.postScale(scaleWidth, scaleHeight);
        // 得到新的圖片
        Bitmap newbm = Bitmap.createBitmap(bmp, 0, 0, width, height, matrix,true);

        //重新載入 imageView
        ivImageFromUrl.setImageBitmap(newbm);
    }

    //必須利用Handler來改變主執行緒的UI值
    private Handler mHandler = new Handler() {
        public void handleMessage(Message msg) {
            super.handleMessage(msg);
            //msg.getData會傳回Bundle，Bundle類別可以由getString(<KEY_NAME>)取出指定KEY_NAME的值
            tv2.setText(msg.getData().getString("response"));
        }
    };


    //宣告一個新的類別並擴充Thread
    class HttpThread extends Thread {

        //宣告變數並指定預設值
        public String ImageName = "NoData" ;
        //public String MyMessage = "Nodata" ;
        public String Url = "http://203.72.0.26/~nhu1403/getImageTime.php";

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
                parmas.add(new BasicNameValuePair("ImageName",this.ImageName));
                //parmas.add(new BasicNameValuePair("MyMessage",this.MyMessage));

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

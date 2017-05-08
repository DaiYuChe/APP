package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/5/20.
 */
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.Snackbar;
import android.view.KeyEvent;
import android.view.View;
import android.widget.EditText;
import org.json.JSONException;
import org.json.JSONObject;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

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


public class MainActivity extends Activity {

    EditText use, pass;
    String Name, Password;
    String NAME, PASSWORD;
    ProgressDialog progressDialog;

    static Activity activityA;
    final View view = null;
    Context ctx=this;

    TextView tv1;

    private String url = "http://203.72.0.26/~nhu1403/APP_login1.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        setTitle("個人電腦防衛系統");
        tv1 = (TextView) findViewById(R.id.mainTV);
        use = (EditText) findViewById(R.id.main_name);
        pass = (EditText) findViewById(R.id.main_password);
        ConnectInternet();
        activityA = this;
        initializer();
    }

    private void ConnectInternet() {
        ConnectivityManager CM = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo info = CM.getActiveNetworkInfo();
        try {
            if (info.isConnected() == true) {
                Toast.makeText(ctx, "處理中...請稍後....!", Toast.LENGTH_SHORT).show();
            } else {
                Toast.makeText(ctx, "尚未連接網路!", Toast.LENGTH_SHORT).show();
            }
        }catch (NullPointerException e){
            Toast.makeText(ctx, "尚未連接網路網路!", Toast.LENGTH_SHORT).show();
            e.printStackTrace();
        }
    }


    private void initializer() {
        progressDialog = new ProgressDialog(this);
    }

    public void main_register(View v){
        startActivity(new Intent(this, Register.class));
    }

    public void main_login(View v){

        Name = use.getText().toString();
        Password = pass.getText().toString();

        HttpThread myThread = new HttpThread();
        //設定變數值
        myThread.userName = Name;
        myThread.passWord = Password;
        myThread.Url = url;
        //開始執行緒
        myThread.start();

        if(Name.isEmpty() == false && Password.isEmpty() == false) {
            BackGround b = new BackGround();
            b.execute(Name, Password);
        }
        else if(Name.isEmpty() == true && Password.isEmpty() == false || Name.trim().equals("")){
            Snackbar snackbar = Snackbar.make(v, "請輸入使用者名稱", Snackbar.LENGTH_SHORT).setAction("Action", null);
            v = snackbar.getView();
            v.setBackgroundColor(Color.LTGRAY);
            snackbar.show();
        }
        else if(Password.isEmpty() == true && Name.isEmpty() == false || Password.trim().equals("")){
            Snackbar snackbar = Snackbar.make(v, "請輸入密碼", Snackbar.LENGTH_SHORT).setAction("Action", null);
            v = snackbar.getView();
            v.setBackgroundColor(Color.LTGRAY);
            snackbar.show();
        }
        else if(Password.isEmpty() == true && Name.isEmpty() == true || Name.trim().equals("") || Password.trim().equals("")){
            Snackbar snackbar = Snackbar.make(v, "請輸入使用者名稱與密碼", Snackbar.LENGTH_SHORT).setAction("Action", null);
            v = snackbar.getView();
            v.setBackgroundColor(Color.LTGRAY);
            snackbar.show();
        }
        else if(Password.toString().equals(" ") || Name.toString().equals(" ") || Name.trim().equals("") || Password.trim().equals("")){
            Snackbar snackbar = Snackbar.make(v, "輸入錯誤", Snackbar.LENGTH_SHORT).setAction("Action", null);
            v = snackbar.getView();
            v.setBackgroundColor(Color.LTGRAY);
            snackbar.show();
        }
    }
    class BackGround extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog.setMessage("載入中.........");
            progressDialog.setCancelable(false);
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... params) {
            String use = params[0];
            String pass = params[1];
            String data = "";
            int tmp;

            try {
                URL url = new URL("http://203.72.0.26/~nhu1403/APP_login1.php");
                String urlParams = "use=" + use + "&pass=" + pass;

                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                httpURLConnection.setDoOutput(true);
                OutputStream os = httpURLConnection.getOutputStream();
                os.write(urlParams.getBytes());
                os.flush();
                os.close();

                InputStream is = httpURLConnection.getInputStream();
                while ((tmp = is.read()) != -1) {
                    data += (char) tmp;
                }

                is.close();
                httpURLConnection.disconnect();

                return data;
            } catch (MalformedURLException e) {
                e.printStackTrace();
                return "Exception: " + e.getMessage();
            } catch (IOException e) {
                e.printStackTrace();
                return "Exception: " + e.getMessage();
            }
        }

        @Override
        protected void onPostExecute(String s) {
            if(progressDialog.isShowing()){
                progressDialog.dismiss();
            }
            //View view = null;
            String err = null;
            try {
                JSONObject root = new JSONObject(s);
                JSONObject user_data = root.getJSONObject("user_data");
                NAME = user_data.getString("use");
                PASSWORD = user_data.getString("pass");

                if((Name.equals(NAME)  && Password.equals(PASSWORD)) && Name.equals("nhu1403") && Password.equals("XWXKM188")){
                    /*Intent i = new Intent(ctx, Home.class);
                    i.putExtra("use", NAME);
                    i.putExtra("pass", PASSWORD);
                    i.putExtra("err", err);
                    startActivity(i);*/
                   // Intent i = new Intent(ctx, RootHome_Menu.class);
                    Intent i = new Intent(ctx, RootHome_Menu.class);
                    i.putExtra("use", NAME);
                    i.putExtra("pass", PASSWORD);
                    startActivity(i);


                }

                else if(Name.equals(NAME) && Password.equals(PASSWORD)){
                    Intent i = new Intent(ctx, GeneralHome_Menu.class);
                    i.putExtra("use", NAME);
                    i.putExtra("pass", PASSWORD);
                    //i.putExtra("err", err);
                    startActivity(i);
                }


                else{
                    System.out.println("無此用戶!!");
                    Snackbar.make(view, "無此用戶", Snackbar.LENGTH_SHORT).show();
                    MainActivity.this.finish();
                    startActivity(new Intent(ctx, MainActivity.class));
                }


            } catch (JSONException e) {
                e.printStackTrace();
                err = "Exception: " + e.getMessage();
            }
        }
    }
    //必須利用Handler來改變主執行緒的UI值
    private Handler mHandler = new Handler() {
        public void handleMessage(Message msg) {
            super.handleMessage(msg);
            //msg.getData會傳回Bundle，Bundle類別可以由getString(<KEY_NAME>)取出指定KEY_NAME的值
            tv1.setText(msg.getData().getString("response"));
            //Toast.makeText(ctx, tv1.getText().toString(), Toast.LENGTH_SHORT).show();
        }
    };

    //宣告一個新的類別並擴充Thread
    class HttpThread extends Thread {

        //宣告變數並指定預設值
        public String userName = "NoData" ;
        public String passWord = "Nodata" ;
        public String Url = "http://203.72.0.26/~nhu1403/APP_login1.php";

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
                parmas.add(new BasicNameValuePair("userName",this.userName));
                parmas.add(new BasicNameValuePair("passWord",this.passWord));

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

    public void forgetPass(View view) {
        startActivity(new Intent(this, ForgotPassword.class));
    }
    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {

        if (keyCode == KeyEvent.KEYCODE_BACK) {
            new AlertDialog.Builder(this)
                    .setTitle("確認")
                    .setMessage("是否離開?")
                    .setPositiveButton("確定", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            MainActivity.this.finish();
                        }
                    })
                    .setNegativeButton("取消", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                        }
                    })
                    .show();
        }
        return true;
    }

}

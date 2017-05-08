package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/5/25.
 */
 
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.Snackbar;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
public class Register extends Activity {

    EditText use, pass;
    String Name, Password;
    String NAME, PASSWORD;
    Context ctx=this;
    View view;
    ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        use = (EditText) findViewById(R.id.register_name);
        pass = (EditText) findViewById(R.id.register_password);
        initializer();
    }

    private void initializer() {
        progressDialog = new ProgressDialog(this);
    }

    public void register_register(View v){
        Name = use.getText().toString();
        Password = pass.getText().toString();

        if(Name.isEmpty() == false && Password.isEmpty() == false) {

            BackGround b = new BackGround();
            b.execute(Name, Password);
            //Toast.makeText(ctx, "註冊成功", Toast.LENGTH_LONG).show();
            finish();
            //startActivity(new Intent(ctx,MainActivity.class));
        }
        else if(Name.isEmpty() == true && Password.isEmpty() == false || Name.trim().equals("")){
            Snackbar snackbar = Snackbar.make(v, "請輸入姓名", Snackbar.LENGTH_SHORT).setAction("Action", null);
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
            Snackbar snackbar = Snackbar.make(v, "請輸入姓名與密碼", Snackbar.LENGTH_SHORT).setAction("Action", null);
            v = snackbar.getView();
            v.setBackgroundColor(Color.LTGRAY);
            snackbar.show();
        }
        else if(Password.toString().equals(" ") || Name.toString().equals(" ") || Name.trim().equals("") || Password.trim().equals("")){
            Snackbar snackbar = Snackbar.make(v, "請勿輸入空白字元", Snackbar.LENGTH_SHORT).setAction("Action", null);
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
            String data= "" ;
            int tmp;

            try {
                URL url = new URL("http://203.72.0.26/~nhu1403/APP_Register1.php");
                String urlParams = "use="+use+"&pass="+pass;

                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                httpURLConnection.setDoOutput(true);
                OutputStream os = httpURLConnection.getOutputStream();
                os.write(urlParams.getBytes());
                os.flush();
                os.close();
                InputStream is = httpURLConnection.getInputStream();
                while((tmp=is.read())!=-1){
                    data+= (char)tmp;
                }
                is.close();
                httpURLConnection.disconnect();

                return data;

            } catch (MalformedURLException e) {
                e.printStackTrace();
                return "Exception: "+e.getMessage();
            } catch (IOException e) {
                e.printStackTrace();
                return "Exception: "+e.getMessage();
            }
        }

        @Override
        protected void onPostExecute(String s) {
            if(progressDialog.isShowing()){
                progressDialog.dismiss();
            }
            //View view = null;
            try {
                if (s.equals("")) {
                    s = "Data saved successfully.";

                }
                Toast.makeText(ctx, s, Toast.LENGTH_LONG).show();
                JSONObject root = new JSONObject(s);
                JSONObject user_data = root.getJSONObject("user_data");
                NAME = user_data.getString("use");
                PASSWORD = user_data.getString("pass");

                if (Name.toString().equals(NAME) && Password.toString().equals(PASSWORD)) {
                    System.out.println("已有此用戶，請重新註冊!!!");
                    Snackbar.make(view, "已有此用戶，請重新註冊!!!", Snackbar.LENGTH_SHORT).show();
                    Register.this.finish();

                }
                else if(Name.toString().equals(NAME) && Password.toString().equals(PASSWORD) == false){
                    System.out.println("此帳號已用過，請重新註冊!!");
                    Snackbar.make(view, "此帳號已用過，請重新註冊!!", Snackbar.LENGTH_SHORT).show();
                    Register.this.finish();

                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
}

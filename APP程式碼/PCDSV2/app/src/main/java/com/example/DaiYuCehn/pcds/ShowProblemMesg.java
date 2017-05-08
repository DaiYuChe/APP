package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/9/2.
 */
 
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class ShowProblemMesg extends Activity {

    String JSON_STRING;
    static Activity showdbActivity;
    // ListView listView;
    String url = "http://203.72.0.26/~nhu1403/APP_ShowProblemMessage.php";
    ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_show_problem_mesg);

        showdbActivity = this;
        initializer();

    }

    private void initializer() {
        progressDialog = new ProgressDialog(this);
    }

    public void ShowProData(View view){
        new BackgroundTask().execute();

    }

    class BackgroundTask extends AsyncTask<Void,Void,String> {

        String json_url;

        @Override
        protected void onPreExecute() {
            json_url = "http://203.72.0.26/~nhu1403/APP_ShowProblemMessage.php";
            progressDialog.setMessage("載入中.........");
            progressDialog.setCancelable(false);
            progressDialog.show();
        }

        @Override
        protected String doInBackground(Void... params) {
            try {
                URL url = new URL(json_url);
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
                StringBuilder stringBuilder = new StringBuilder();
                while ((JSON_STRING = bufferedReader.readLine()) != null) {

                    stringBuilder.append(JSON_STRING + "\n");

                }

                bufferedReader.close();
                inputStream.close();
                httpURLConnection.disconnect();

                return stringBuilder.toString().trim();

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);
        }

        @Override
        protected void onPostExecute(String result) {
            if(progressDialog.isShowing()){
                progressDialog.dismiss();
            }
            TextView textView = (TextView) findViewById(R.id.textview);
            textView.setText(result);

        }
    }
}

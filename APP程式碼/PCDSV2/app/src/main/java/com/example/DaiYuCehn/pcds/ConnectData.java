package com.example.user01.pcds;

import android.app.Activity;
import android.content.Context;
import android.widget.Toast;

/**
 * Created by user01 on 2016/5/27.
 */
public class ConnectData extends Connect{

    String URL = "http://203.72.0.26/~nhu1403/APP_server.php";
    String url = "";
    String response = "";


    public String showData(){
        try {
            url = URL + "?choice=view";
            System.out.println("URL Show Data : " + url);
            response = call(url);

        } catch (Exception e) {
        }
        return response;
    }

    public String insertData(String know, String time) {
        try {
            url = URL + "?choice=insert&know=" + know + "&time=" + time;
            System.out.println("URL Insert Data : " + url);
            response = call(url);
        } catch (Exception e) {
        }
        return response;
    }

    public String getDataById(int no) {
        try {
            url = URL + "?choice=get_data_by_id&no=" + no;
            System.out.println("URL Insert Data : " + url);
            response = call(url);
        } catch (Exception e) {
        }
        return response;
    }

    public String updateData(String no, String know, String time) {
        try {
            url = URL + "?choice=update&no=" + no + "&know=" + know + "&time=" + time;
            System.out.println("URL Insert Data : " + url);
            response = call(url);
        } catch (Exception e) {
        }
        return response;
    }

    public String deleteData(int no) {
        try {
            url = URL + "?choice=delete&no=" + no;
            System.out.println("URL delete Data : " + url);
            response = call(url);
        } catch (Exception e) {
        }
        return response;
    }
}

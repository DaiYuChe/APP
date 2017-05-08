package com.example.user01.pcds;

/**
 * Created by user01 on 2016/5/27.
 */
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;

public class Connect {

    public String call(String url) {
        int BUFFER_SIZE = 9999;
        InputStream inputStream = null;
        try {
            inputStream = OpenHttpConnection(url);
        } catch (IOException e) {
            e.printStackTrace();
            return "";
        }
        InputStreamReader isr = new InputStreamReader(inputStream);
        int charRead;
        String str = "";
        char[] inputBuffer = new char[BUFFER_SIZE];
        try {
            while ((charRead = isr.read(inputBuffer)) > 0) {
                String readString = String.copyValueOf(inputBuffer, 0, charRead);
                str += readString;
                inputBuffer = new char[BUFFER_SIZE];
            }
            inputStream.close();
        } catch (IOException e) {
            // Handle Exception
            e.printStackTrace();
            return "";
        }
        return str;
    }

    private InputStream OpenHttpConnection(String url) throws IOException {
        InputStream inputStream = null;
        int response = -1;
        URL url1 = new URL(url);
        URLConnection conn = url1.openConnection();
        if (!(conn instanceof HttpURLConnection))
            throw new IOException("Not An Http Connection");
        try {
            HttpURLConnection httpURLConnection = (HttpURLConnection) conn;
            httpURLConnection.setAllowUserInteraction(false);
            httpURLConnection.setInstanceFollowRedirects(true);
            httpURLConnection.setRequestMethod("GET");
            httpURLConnection.connect();
            response = httpURLConnection.getResponseCode();
            if (response == HttpURLConnection.HTTP_OK) {
                inputStream = httpURLConnection.getInputStream();
            }
        } catch (Exception e) {
            throw new IOException("Error connecting2");
        }
        return inputStream;
    }

}

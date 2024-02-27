package com.example.onlineattendance;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class NameRetrieval {

    public static String retrieveName(String rollNo) {
        String result = "";
        try {
            URL url = new URL("http://192.168.82.81/website/login/appStudName.php");
            HttpURLConnection urlConnection = (HttpURLConnection) url.openConnection();

            try {
                // Set the connection properties
                urlConnection.setRequestMethod("POST");
                urlConnection.setDoOutput(true);

                // Prepare the data to be sent
                String postData = URLEncoder.encode("rollNo", "UTF-8") + "=" + URLEncoder.encode(rollNo, "UTF-8");

                // Send the POST data
                DataOutputStream outputStream = new DataOutputStream(urlConnection.getOutputStream());
                outputStream.writeBytes(postData);
                outputStream.flush();
                outputStream.close();

                // Read the response from the server
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(urlConnection.getInputStream()));
                String line;
                while ((line = bufferedReader.readLine()) != null) {
                    result += line;
                }
                bufferedReader.close();
            } finally {
                urlConnection.disconnect();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        return result;
    }
}

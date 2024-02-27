package com.example.onlineattendance;

import android.content.Intent;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button loginButton = findViewById(R.id.buttonLogin);

        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                EditText rollNoEditText = findViewById(R.id.editTextRollNo);
                EditText passwordEditText = findViewById(R.id.editTextPassword);

                String rollNo = rollNoEditText.getText().toString();
                String password = passwordEditText.getText().toString();

                new LoginAsyncTask().execute(rollNo, password);
            }
        });
    }

    private class LoginAsyncTask extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... params) {
            String rollNo = params[0];
            String password = params[1];

            try {
                URL url = new URL("http://192.168.82.81/website/login/appConn.php");
                HttpURLConnection urlConnection = (HttpURLConnection) url.openConnection();

                try {
                    urlConnection.setRequestMethod("POST");
                    urlConnection.setDoOutput(true);

                    OutputStream os = urlConnection.getOutputStream();
                    BufferedWriter writer = new BufferedWriter(new OutputStreamWriter(os, "UTF-8"));
                    String data = URLEncoder.encode("rollNo", "UTF-8") + "=" + URLEncoder.encode(rollNo, "UTF-8") + "&" +
                            URLEncoder.encode("password", "UTF-8") + "=" + URLEncoder.encode(password, "UTF-8");
                    writer.write(data);
                    writer.flush();
                    writer.close();
                    os.close();

                    // Get the response from the server
                    InputStream inputStream = urlConnection.getInputStream();
                    BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "UTF-8"));
                    String line;
                    StringBuilder result = new StringBuilder();
                    while ((line = bufferedReader.readLine()) != null) {
                        result.append(line);
                    }
                    bufferedReader.close();
                    inputStream.close();

                    return result.toString();

                } finally {
                    urlConnection.disconnect();
                }

            } catch (IOException e) {
                e.printStackTrace();
                Log.e("LoginAsyncTask", "Error during network request", e);
                return "network_error"; // Update the return value to indicate a network error
            }
        }

        @Override
        protected void onPostExecute(String result) {
            // Process the server response
            if (result != null) {
                switch (result) {
                    case "success":
                        // Login successful, navigate to the next activity
                        Toast.makeText(MainActivity.this, "Success Login", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(MainActivity.this, StudentDashActivity.class);
                        EditText rollNoEditText = findViewById(R.id.editTextRollNo);
                        String rollNo = rollNoEditText.getText().toString(); // Replace with the actual roll number you want to pass
                        intent.putExtra("ROLL_NUMBER", rollNo);
                        startActivity(intent);
                        break;
                    case "failure":
                        // Incorrect password, show a toast message
                        Toast.makeText(MainActivity.this, "Invalid password", Toast.LENGTH_SHORT).show();
                        break;
                    case "user_not_found":
                        // User not found, show a toast message
                        Toast.makeText(MainActivity.this, "User not found", Toast.LENGTH_SHORT).show();
                        break;
                    case "error":
                        // Some other error occurred, show a toast message
                        Toast.makeText(MainActivity.this, "Error occurred", Toast.LENGTH_SHORT).show();
                        break;
                    default:
                        // Log unknown response for further investigation
                        Log.e("LoginAsyncTask", "Unknown server response: " + result);
                        break;
                }
            } else {
                // Handle the case where the result is null (an error occurred)
                Toast.makeText(MainActivity.this, "Error occurred", Toast.LENGTH_SHORT).show();
            }
        }
    }


    public void openLink(View view) {
        String url = "http://192.168.82.81/website/login/Student/login.php";  // Replace with your desired URL
        Intent intent = new Intent(Intent.ACTION_VIEW);
        intent.setData(Uri.parse(url));
        startActivity(intent);
    }

}

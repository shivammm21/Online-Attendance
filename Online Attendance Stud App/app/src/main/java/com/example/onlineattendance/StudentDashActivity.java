package com.example.onlineattendance;

// In StudentDashActivity.java
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
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
import java.net.URL;
import java.net.URLEncoder;

public class StudentDashActivity extends AppCompatActivity {
    private RelativeLayout relLayout;
    private ImageView tickImageView;

    private TextView timerTextView;
    private CountDownTimer countDownTimer;
    private TextView loginText;

    private class GetNameTask extends AsyncTask<Void, Void, String> {
        @Override
        protected String doInBackground(Void... voids) {
            Intent intent = getIntent();
            String roll = intent.getStringExtra("ROLL_NUMBER");
            return NameRetrieval.retrieveName(roll); // Use the method from the previous response
        }

        @Override
        protected void onPostExecute(String name) {
            String greetingMessage = "Hello " + name;
            loginText.setText(greetingMessage);
        }
    }
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_student_dash);

        EditText editTextOTP = findViewById(R.id.editTextOTP);
        Button buttonPresent = findViewById(R.id.buttonPresent);
        Button buttonLogout = findViewById(R.id.buttonLogout);
        timerTextView = findViewById(R.id.timerTextView);
        loginText = findViewById(R.id.loginText);


        relLayout = findViewById(R.id.relLayout);
        tickImageView = new ImageView(this);

        long initialTime = 10000;
        new GetNameTask().execute();


        countDownTimer = new CountDownTimer(initialTime, 1000) {
            @Override
            public void onTick(long millisUntilFinished) {
                // Update the timer TextView every second
                timerTextView.setText(millisUntilFinished / 1000 + " seconds");
            }

            @Override
            public void onFinish() {
                // Timer has reached 0, navigate to the main page
                goToMainPage();
            }
        };
        countDownTimer.start();



        buttonPresent.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                EditText editTextOTP = findViewById(R.id.editTextOTP);
                String enteredOTP = editTextOTP.getText().toString();

                // You may need to replace the URL with the correct path to your PHP script
                String validateOTPEndpoint = "http://192.168.82.81/website/login/appCheck.php";

                new ValidateOTPTask().execute(enteredOTP, validateOTPEndpoint);
            }
        });

        buttonLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(StudentDashActivity.this, MainActivity.class);
                startActivity(intent);
                finish();
            }
        });
    }

    private class ValidateOTPTask extends AsyncTask<String, Void, String> implements com.example.onlineattendance.ValidateOTPTask {
        @Override
        protected String doInBackground(String... params) {
            String enteredOTP = params[0];
            String validateOTPEndpoint = params[1];

            try {
                URL url = new URL(validateOTPEndpoint);
                HttpURLConnection urlConnection = (HttpURLConnection) url.openConnection();

                try {
                    urlConnection.setRequestMethod("POST");
                    urlConnection.setDoOutput(true);

                    OutputStream os = urlConnection.getOutputStream();
                    BufferedWriter writer = new BufferedWriter(new OutputStreamWriter(os, "UTF-8"));
                    Intent intent = getIntent();
                    if (intent.hasExtra("ROLL_NUMBER")) {
                        String rollNo = intent.getStringExtra("ROLL_NUMBER");


                    String data = URLEncoder.encode("rollNo", "UTF-8") + "=" + URLEncoder.encode(rollNo, "UTF-8") + "&" + URLEncoder.encode("enteredOTP", "UTF-8") + "=" + URLEncoder.encode(enteredOTP, "UTF-8");
                    writer.write(data);
                    writer.flush();
                    writer.close();
                    os.close();
                    }

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
                return null;
            }
        }

        @Override
        protected void onPostExecute(String result) {
            if (result != null) {
                switch (result) {
                    case "correct":
                        Toast.makeText(StudentDashActivity.this, "Correct OTP", Toast.LENGTH_SHORT).show();
                        break;
                    case "incorrect":
                        Toast.makeText(StudentDashActivity.this, "Incorrect OTP", Toast.LENGTH_SHORT).show();
                        break;
                    default:
                        Toast.makeText(StudentDashActivity.this, "Connection Lost", Toast.LENGTH_SHORT).show();
                        break;
                }
            } else {
                Toast.makeText(StudentDashActivity.this, "Error occurred", Toast.LENGTH_SHORT).show();
            }
        }
    }
    private void goToMainPage() {
        // Create an Intent to start the main page activity
        Intent intent = new Intent(this, MainActivity.class);
        startActivity(intent);

        finish();
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        // Cancel the timer to avoid memory leaks
        if (countDownTimer != null) {
            countDownTimer.cancel();
        }
    }
    


}


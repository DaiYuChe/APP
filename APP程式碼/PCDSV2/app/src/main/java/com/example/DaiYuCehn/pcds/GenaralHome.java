package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/7/22.
 */
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

public class GenaralHome extends Activity {

    String use, pass, Err, show;
    TextView err, showTV;
    ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_genaral_home);

        showTV = (TextView) findViewById(R.id.tv);

        use = getIntent().getStringExtra("use");
        pass = getIntent().getStringExtra("pass");
        show = getIntent().getStringExtra("use");
        // Toast.makeText(this, "登入成功", Toast.LENGTH_SHORT).show();
        showTV.setText("歡迎來到  " + show + "  個人紀錄");
        initializer();
    }
    private void initializer() {
        progressDialog = new ProgressDialog(this);
    }

    public void showPersonData(View view){
        Intent i = new Intent(this, ShowDBdata.class);
        i.putExtra("use", use);
        i.putExtra("pass", pass);
        startActivity(i);
    }

    public void general_modifyAccount(View view){
        Intent i = new Intent(this, ModifyAcccountChooser.class);
        i.putExtra("use", use);
        i.putExtra("pass", pass);
        startActivity(i);
    }

    public void problemReturn(View view){
        Intent i = new Intent(this, ProblemReturn.class);
        i.putExtra("use", use);
        i.putExtra("pass", pass);
        startActivity(i);
    }

    public void DBlogOut(final View view){
        new AlertDialog.Builder(this)
                .setTitle("確認")
                .setMessage("是否登出?")
                .setPositiveButton("確定", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        GenaralHome.this.finish();
                        if (!MainActivity.activityA.isFinishing()) {
                            MainActivity.activityA.finish();
                        }
                        startActivity(new Intent(getApplicationContext(), MainActivity.class));
                        Toast.makeText(getApplicationContext(), "登出成功!", Toast.LENGTH_SHORT).show();

                    }
                })
                .setNegativeButton("取消", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                    }
                })
                .show();
    }

    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {

        if (keyCode == KeyEvent.KEYCODE_BACK) {
            new AlertDialog.Builder(this)
                    .setTitle("確認")
                    .setMessage("是否離開程式?")
                    .setPositiveButton("確定", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            GenaralHome.this.finish();
                            if (!MainActivity.activityA.isFinishing()) {
                                MainActivity.activityA.finish();
                            }

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

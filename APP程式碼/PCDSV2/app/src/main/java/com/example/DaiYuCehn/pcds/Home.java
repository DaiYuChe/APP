package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/8/2.
 */
 
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.app.Activity;
import android.support.design.widget.Snackbar;
import android.view.KeyEvent;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

public class Home extends Activity {

    String use, pass, Err, show;
    TextView  err, showTV;
    final View view = null;
    static Activity HomeActivity;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        HomeActivity = this;

        showTV = (TextView) findViewById(R.id.tv);
        err = (TextView) findViewById(R.id.err);

        use = getIntent().getStringExtra("use");
        pass = getIntent().getStringExtra("pass");
        show = getIntent().getStringExtra("use");
        Err = getIntent().getStringExtra("err");

       // Toast.makeText(this, "登入成功", Toast.LENGTH_SHORT).show();
        showTV.setText("歡迎來到 " + show + " ROOT介面");
        err.setText(Err);

    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()){
            case R.id.about:
                Toast.makeText(getApplicationContext(), "程式開發中..." , Toast.LENGTH_LONG).show();
                return true;
            case R.id.logout:
                Home.this.finish();
                if (!MainActivity.activityA.isFinishing()) {
                    MainActivity.activityA.finish();
                }

                startActivity(new Intent(getApplicationContext(), MainActivity.class));
                Toast.makeText(getApplicationContext(), "登出成功!", Toast.LENGTH_SHORT).show();
                return true;
        }
        return super.onOptionsItemSelected(item);
    }

    public void showProblem(View view){
        startActivity(new Intent(this, ShowProblemMesg.class));
    }

    public void RaspiControl(View view){
        startActivity(new Intent(this, ControlRaspiActivity.class));
    }

    public void ShowData(View view){
        Intent i = new Intent(this, GetDataActivity.class);
        i.putExtra("use", use);
        i.putExtra("pass", pass);
        startActivity(i);
    }

    public void ShowSenssorRecords(View v){
        startActivity(new Intent(getApplicationContext(), SenssorRecords.class));
    }

    public void HomeShowImage(View view){
        startActivity(new Intent(this, LoadingImage.class));
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
                            Home.this.finish();
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
    public void bt_modifyAccount(View view){
        Intent i = new Intent(this, ModifyAcccountChooser.class);
        i.putExtra("use", use);
        i.putExtra("pass", pass);
        startActivity(i);
    }

    public void logOut(final View view){
        new AlertDialog.Builder(this)
                .setTitle("確認")
                .setMessage("是否登出?")
                .setPositiveButton("確定", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        Home.this.finish();
                        if (!MainActivity.activityA.isFinishing()) {
                            MainActivity.activityA.finish();
                        }
                        startActivity(new Intent(getApplicationContext(), MainActivity.class));
                        Snackbar.make(view, "登出成功!", Snackbar.LENGTH_SHORT).show();

                    }
                })
                .setNegativeButton("取消", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                    }
                })
                .show();
    }

}

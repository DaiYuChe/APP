package com.example.user01.pcds;

/**
 * Created by DaiYuChen on 2016/8/2.
 */
 
import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.view.KeyEvent;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.Toast;

public class RootHome_Menu extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    String use, pass;
    static Activity HomeActivity;
    final View view = null;
    TextView tv1;
    @SuppressWarnings("deprecation")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_root_home__menu);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        use = getIntent().getStringExtra("use");
        pass = getIntent().getStringExtra("pass");
        setTitle("主選單");
        HomeActivity = this;
        tv1 = (TextView) findViewById(R.id.intro);
        tv1.setText("功能介紹:\n1. 顯示資料庫資料\n2. 顯示圖片\n3. 顯示感測器紀錄\n4. 控制樹苺派\n5. 顯示回報紀錄\n6. 修改名稱/密碼\n");

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.root_home__menu, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.LOGOUT) {
            RootHome_Menu.this.finish();
            if (!MainActivity.activityA.isFinishing()) {
                MainActivity.activityA.finish();
            }
            startActivity(new Intent(getApplicationContext(), MainActivity.class));
            Toast.makeText(this, "登出成功!", Toast.LENGTH_SHORT).show();
            return true;
        }
        else if(id == R.id.about){
            startActivity(new Intent(this, Introduction.class));
        }
        else if(id == R.id.contactMe){
            startActivity(new Intent(this, Contact.class));
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.showPic) {
            startActivity(new Intent(this, LoadingImage.class));
        } else if (id == R.id.Control_Raspi) {
            startActivity(new Intent(this, ControlRaspiActivity.class));
        } else if (id == R.id.ShowData) {
            Intent i = new Intent(this, GetDataActivity.class);
            i.putExtra("use", use);
            i.putExtra("pass", pass);
            startActivity(i);
        } else if (id == R.id.showProblem) {
            startActivity(new Intent(this, ShowProblemMesg.class));
        } else if (id == R.id.bt_modifyAccount) {
            Intent i = new Intent(this, ModifyAcccountChooser.class);
            i.putExtra("use", use);
            i.putExtra("pass", pass);
            startActivity(i);
        } else if (id == R.id.ShowSenssorRecords) {
            startActivity(new Intent(getApplicationContext(), SenssorRecords.class));
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
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
                            RootHome_Menu.this.finish();
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

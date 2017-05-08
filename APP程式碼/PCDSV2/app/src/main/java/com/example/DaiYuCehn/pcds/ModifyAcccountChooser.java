package com.example.user01.pcds;
/**
 * Created by DaiYuChen on 2016/5/26.
 */
import android.app.Activity;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;

public class ModifyAcccountChooser extends Activity {

    String use, pass;
    static Activity modifyAcccountChooserActivity;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_modify_acccount_chooser);
        modifyAcccountChooserActivity = this;
        use = getIntent().getStringExtra("use");
        pass = getIntent().getStringExtra("pass");
    }
    //onClick
    public void modifyPassword(View view){
        Intent i = new Intent(this, ModifyAccountPassword.class);
        i.putExtra("use", use);
        i.putExtra("pass", pass);
        startActivity(i);
    }

    public void modifyName(View view){
        Intent i = new Intent(this, ModifyAccountUsername.class);
        i.putExtra("use", use);
        i.putExtra("pass", pass);
        startActivity(i);
    }
}

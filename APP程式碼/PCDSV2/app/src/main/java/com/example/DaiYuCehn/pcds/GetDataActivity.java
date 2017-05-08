package com.example.user01.pcds;
/**
 * Created by DaiYuChen on 2016/8/24.
 */
 
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.graphics.Color;
import android.support.v4.view.ViewPager.LayoutParams;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;

public class GetDataActivity extends Activity implements OnClickListener {

    ConnectData connectData = new ConnectData();
    TableLayout tabelData;

    Button buttonData;
    ArrayList<Button> buttonEdit = new ArrayList<Button>();
    ArrayList<Button> buttonDelete = new ArrayList<Button>();

    JSONArray arrayData;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_get_data);

        if (android.os.Build.VERSION.SDK_INT > 9) {
            StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder()
                    .permitAll().build();
            StrictMode.setThreadPolicy(policy);
        }

        tabelData = (TableLayout) findViewById(R.id.tableData);
        buttonData = (Button) findViewById(R.id.buttonAddData);
        buttonData.setOnClickListener(this);

        TableRow barisTabel = new TableRow(this);
        barisTabel.setBackgroundColor(Color.CYAN);

        TextView viewHeaderId = new TextView(this);
        TextView viewHeaderKnow = new TextView(this);
        TextView viewHeaderTime = new TextView(this);
        TextView viewHeaderAction = new TextView(this);

        viewHeaderId.setText("編號");
        viewHeaderKnow.setText("使用者名稱");
        viewHeaderTime.setText("時間");
        viewHeaderAction.setText("狀態");

        viewHeaderId.setPadding(5, 1, 5, 1);
        viewHeaderKnow.setPadding(5, 1, 5, 1);
        viewHeaderTime.setPadding(5, 1, 5, 1);
        viewHeaderAction.setPadding(5, 1, 5, 1);

        barisTabel.addView(viewHeaderId);
        barisTabel.addView(viewHeaderKnow);
        barisTabel.addView(viewHeaderTime);
        barisTabel.addView(viewHeaderAction);

        tabelData.addView(barisTabel, new TableLayout.LayoutParams(LayoutParams.WRAP_CONTENT,
                LayoutParams.WRAP_CONTENT));

        try {

            arrayData = new JSONArray(connectData.showData());

            for (int i = 0; i < arrayData.length(); i++) {
                JSONObject jsonChildNode = arrayData.getJSONObject(i);
                String know = jsonChildNode.optString("know");
                String time = jsonChildNode.optString("time");
                String no = jsonChildNode.optString("no");

                System.out.println("Know :" + know);
                System.out.println("Tine :" + time);
                System.out.println("No :" + no);

                barisTabel = new TableRow(this);

                if (i % 2 == 0) {
                    barisTabel.setBackgroundColor(Color.LTGRAY);
                }

                TextView viewId = new TextView(this);
                viewId.setText(no);
                viewId.setPadding(5, 1, 5, 1);
                barisTabel.addView(viewId);

                TextView viewKnow = new TextView(this);
                viewKnow.setText(know);
                viewKnow.setPadding(5, 1, 5, 1);
                barisTabel.addView(viewKnow);

                TextView viewTime = new TextView(this);
                viewTime.setText(time);
                viewTime.setPadding(5, 1, 5, 1);
                barisTabel.addView(viewTime);

                buttonEdit.add(i, new Button(this));
                buttonEdit.get(i).setId(Integer.parseInt(no));
                buttonEdit.get(i).setTag("Edit");
                buttonEdit.get(i).setText("編輯");
                buttonEdit.get(i).setOnClickListener(this);
                barisTabel.addView(buttonEdit.get(i));

                buttonDelete.add(i, new Button(this));
                buttonDelete.get(i).setId(Integer.parseInt(no));
                buttonDelete.get(i).setTag("Delete");
                buttonDelete.get(i).setText("刪除");
                buttonDelete.get(i).setOnClickListener(this);
                barisTabel.addView(buttonDelete.get(i));

                tabelData.addView(barisTabel, new TableLayout.LayoutParams(LayoutParams.MATCH_PARENT,
                        LayoutParams.MATCH_PARENT));
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public void onClick(View view) {

        if (view.getId() == R.id.buttonAddData) {
            // Toast.makeText(MainActivity.this, "Button Tambah Data",
            // Toast.LENGTH_SHORT).show();
            addData();
        } else {

            for (int i = 0; i < buttonEdit.size(); i++) {
                if (view.getId() == buttonEdit.get(i).getId() && view.getTag().toString().trim().equals("Edit")) {
                    Toast.makeText(GetDataActivity.this, "Edit : " +
                            buttonEdit.get(i).getId(), Toast.LENGTH_SHORT).show();
                    int id = buttonEdit.get(i).getId();
                    getDataByID(id);

                }
                else if (view.getId() == buttonDelete.get(i).getId() && view.getTag().toString().trim().equals("Delete")) {
                    Toast.makeText(GetDataActivity.this, "Delete : " +
                            buttonDelete.get(i).getId(), Toast.LENGTH_SHORT).show();
                    int id = buttonDelete.get(i).getId();
                    deleteData(id);

                }
            }
        }
    }

    public void deleteData(final int no) {
        new AlertDialog.Builder(this)
                .setTitle("確認")
                .setMessage("是否刪除?")
                .setPositiveButton("確定", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        connectData.deleteData(no);
  /* restart acrtivity */
                        finish();
                        startActivity(getIntent());
                    }
                })
                .setNegativeButton("取消", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.cancel();
                    }
                })
                .show();

       /* connectData.deleteData(no);
                    finish();
                     startActivity(getIntent());*/
    }

    public void getDataByID(int id) {

        String knowEdit = null, timeEdit = null;
        JSONArray arrayPersonal;
        try {
            arrayPersonal = new JSONArray(connectData.getDataById(id));
            for (int i = 0; i < arrayPersonal.length(); i++) {
                JSONObject jsonChildNode = arrayPersonal.getJSONObject(i);
                knowEdit = jsonChildNode.optString("know");
                timeEdit = jsonChildNode.optString("time");
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }

        LinearLayout layoutInput = new LinearLayout(this);
        layoutInput.setOrientation(LinearLayout.VERTICAL);


        final TextView viewId = new TextView(this);
        viewId.setText(String.valueOf(id));
        viewId.setTextColor(Color.TRANSPARENT);
        layoutInput.addView(viewId);

        final EditText editKnow = new EditText(this);
        editKnow.setText(knowEdit);
        layoutInput.addView(editKnow);

        final EditText editTime = new EditText(this);
        editTime.setText(timeEdit);
        //layoutInput.addView(editTime);

        AlertDialog.Builder builderEditData = new AlertDialog.Builder(this);
        builderEditData.setTitle("修改資料");
        builderEditData.setView(layoutInput);
        builderEditData.setPositiveButton("修改", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                String know = editKnow.getText().toString();
                String time = editTime.getText().toString();

                System.out.println("Know : " + know + " Time : " + time);

                String data = connectData.updateData(viewId.getText().toString(), editKnow.getText().toString(),
                        editTime.getText().toString());

                Toast.makeText(GetDataActivity.this, data, Toast.LENGTH_SHORT).show();
    /* restart acrtivity */
                finish();
                startActivity(getIntent());
            }

        });

        builderEditData.setNegativeButton("取消", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.cancel();
            }
        });
        builderEditData.show();

    }

    public void addData() {

        LinearLayout layoutInput = new LinearLayout(this);
        layoutInput.setOrientation(LinearLayout.VERTICAL);

        final EditText editKnow = new EditText(this);
        editKnow.setHint("請輸入名稱");
        layoutInput.addView(editKnow);

        final EditText editTime = new EditText(this);
        editTime.setHint("請輸入時間");
        //layoutInput.addView(editTime);

        AlertDialog.Builder builderInsertData = new AlertDialog.Builder(this);
        builderInsertData.setTitle("新增資料");
        builderInsertData.setView(layoutInput);
        builderInsertData.setPositiveButton("新增", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                String know = editKnow.getText().toString();
                String time = editTime.getText().toString();

                System.out.println("Name : " + know + " Time : " + time);

                if (!know.equals("") || !know.equals(" ") || editTime.getText().toString() != "" || editTime.getText().toString() != "") {
                    String data = connectData.insertData(know, time);
                    Toast.makeText(GetDataActivity.this, data, Toast.LENGTH_SHORT).show();
                    /* restart acrtivity */
                    finish();
                    startActivity(getIntent());
                } else {
                    Toast.makeText(GetDataActivity.this, "請輸入名稱", Toast.LENGTH_SHORT).show();
                }
            }

        });

        builderInsertData.setNegativeButton("取消", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.cancel();
            }
        });
        builderInsertData.show();
    }

}

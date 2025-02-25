package com.dantsu.kedaimungil;

import static android.content.ContentValues.TAG;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.net.Uri;
import android.net.http.SslError;
import android.os.Build;
import android.os.Bundle;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.Gravity;
import android.view.KeyEvent;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;
import android.webkit.JavascriptInterface;
import android.webkit.SslErrorHandler;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.dantsu.escposprinter.connection.DeviceConnection;
import com.dantsu.escposprinter.connection.bluetooth.BluetoothConnection;
import com.dantsu.escposprinter.connection.bluetooth.BluetoothPrintersConnections;
import com.dantsu.escposprinter.textparser.PrinterTextParserImg;
import com.dantsu.agensinarexpress.async.AsyncBluetoothEscPosPrint;
import com.dantsu.agensinarexpress.async.AsyncEscPosPrint;
import com.dantsu.agensinarexpress.async.AsyncEscPosPrinter;

import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Date;

public class MainActivity extends AppCompatActivity {

    WebView myWebView;
    ProgressBar progressBar;
    private Button button;
    private Button buttonLabel;
    private Button button_cari;
    private Button reload;

    String no_resi, nama_barang, harga_dasar, satuan, jumlah,potongan, total_harga, jumlah_diskon,diskon,pembayaran,total_harganya,total_jumlah,pembuat;

    @SuppressLint("SetJavaScriptEnabled")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        myWebView = (WebView) findViewById(R.id.webview);
        progressBar = findViewById(R.id.progress_circular);
        reload = findViewById(R.id.accessibility_custom_action_0);
        button = findViewById(R.id.button_bluetooth);
        reload.setVisibility(View.INVISIBLE);
        button.setVisibility(View.INVISIBLE);
        buttonLabel = findViewById(R.id.button_label);
        buttonLabel.setVisibility(View.INVISIBLE);
        button_cari = findViewById(R.id.button_bluetooth_browse);
        button_cari.setVisibility(View.INVISIBLE);

        WebSettings webSettings = myWebView.getSettings();
        webSettings.setJavaScriptEnabled(true);
        myWebView.addJavascriptInterface(new WebAppInterface(this), "Android");
        webSettings.setLoadsImagesAutomatically(true);
        webSettings.setAllowContentAccess(true);
        webSettings.setDomStorageEnabled(true);
        webSettings.setJavaScriptCanOpenWindowsAutomatically(true);
        myWebView.setWebChromeClient(new WebChromeClient());
        //myWebView.getWebChromeClient();
        webSettings.setMixedContentMode(0);
        myWebView.setLayerType(View.LAYER_TYPE_HARDWARE, null);

        myWebView.setWebViewClient(new MyWebViewClient());
        myWebView.loadUrl("http://192.168.0.188/mungil");

        //binding = ActivityMainBinding.inflate(getLayoutInflater());


        Button button = (Button) this.findViewById(R.id.button_bluetooth_browse);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                browseBluetoothDevice();
            }
        });
        button = (Button) findViewById(R.id.button_bluetooth);
        //button.setVisibility(View.INVISIBLE);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                printBluetooth();
            }
        });
        buttonLabel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                printBluetoothLabel();
            }
        });

        //buttonLabel = (Button) findViewById(R.id.button_label);

        button = reload;
        //button.setVisibility(View.INVISIBLE);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                myWebView.loadUrl("http://192.168.0.188/mungil");
            }
        });
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.KITKAT) {

            getWindow().setFlags(WindowManager.LayoutParams.FLAG_LAYOUT_NO_LIMITS,
                    WindowManager.LayoutParams.FLAG_LAYOUT_NO_LIMITS);
        }
        Window window = getWindow();
        WindowManager.LayoutParams winParams = window.getAttributes();
        winParams.flags &= ~WindowManager.LayoutParams.FLAG_TRANSLUCENT_STATUS;
        window.setAttributes(winParams);
        window.getDecorView().setSystemUiVisibility(View.SYSTEM_UI_FLAG_LAYOUT_STABLE | View.SYSTEM_UI_FLAG_LAYOUT_FULLSCREEN
                | View.SYSTEM_UI_FLAG_HIDE_NAVIGATION
                | View.SYSTEM_UI_FLAG_LAYOUT_FULLSCREEN
                | View.SYSTEM_UI_FLAG_LIGHT_STATUS_BAR
                | View.SYSTEM_UI_FLAG_LIGHT_NAVIGATION_BAR
                | View.SYSTEM_UI_FLAG_IMMERSIVE
                | View.SYSTEM_UI_FLAG_IMMERSIVE_STICKY

        );

    }
    public class WebAppInterface {
        Context mContext;

        /** Instantiate the interface and set the context */
        WebAppInterface(Context c) {
            mContext = c;
        }

        /** Show a toast from the web page */
        @JavascriptInterface
        public void cari_data(String toast)
        {

            String spURL="http://192.168.0.188/mungil/androInput/cari_cetak.php?id_penjualan="+toast;
            StringRequest stringRequest = new StringRequest(Request.Method.POST, spURL,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {
                                JSONObject jobj = new JSONObject(response);
                                String resi = jobj.getString("id_penjualan");
                                no_resi=resi;
                                String nama_barang_a = jobj.getString("nama_barang");
                                nama_barang = nama_barang_a;
                                String harga_dasar_a = jobj.getString("harga_dasar");
                                harga_dasar = harga_dasar_a;
                                String satuan_a = jobj.getString("satuan");
                                satuan = satuan_a;
                                String jumlah_a = jobj.getString("jumlah");
                                jumlah = jumlah_a;
                                String potongan_a = jobj.getString("potongan");
                                potongan = potongan_a;
                                String total_harga_a = jobj.getString("total_harga");
                                total_harga = total_harga_a;
                                String jumlah_diskon_a = jobj.getString("jumlah_diskon");
                                jumlah_diskon = jumlah_diskon_a;
                                String diskon_a = jobj.getString("diskon");
                                diskon = diskon_a;
                                String pembayaran_a = jobj.getString("pembayaran");
                                pembayaran = pembayaran_a;
                                String total_harganya_a = jobj.getString("total_harganya");
                                total_harganya = total_harganya_a;
                                String total_jumlah_a = jobj.getString("total_jumlah");
                                total_jumlah = total_jumlah_a;
                                String tgl_buat = jobj.getString("tgl_buat");
                                tgl_buat = tgl_buat;
                                String pembuatnye = jobj.getString("pembuat");
                                pembuat = pembuatnye;
                                printBluetoothLabel();
                                //printBluetooth();
                                //button.setVisibility(View.VISIBLE);
                                //printQrCode();
                            }catch (JSONException e) {
                                e.printStackTrace();
                            }

                        }
                    },
                    new Response.ErrorListener(){
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(MainActivity.this, error.toString().trim(), Toast.LENGTH_SHORT).show();
                        }
                    });
            RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
            requestQueue.add(stringRequest);
        }
        @JavascriptInterface
        public void cari_data2(String toast)
        {

            String spURL="http://202.150.131.144/she/androInput/cari_cetak.php?id_kirim="+toast;
            StringRequest stringRequest = new StringRequest(Request.Method.POST, spURL,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {
                                JSONObject jobj = new JSONObject(response);
                                String resi = jobj.getString("id_penjualan");
                                no_resi=resi;
                                String nama_barang_a = jobj.getString("nama_barang");
                                nama_barang = nama_barang_a;
                                String harga_dasar_a = jobj.getString("harga_dasar");
                                harga_dasar = harga_dasar_a;
                                String satuan_a = jobj.getString("satuan");
                                satuan = satuan_a;
                                String jumlah_a = jobj.getString("jumlah");
                                jumlah = jumlah_a;
                                String potongan_a = jobj.getString("potongan");
                                potongan = potongan_a;
                                String total_harga_a = jobj.getString("total_harga");
                                total_harga = total_harga_a;
                                String jumlah_diskon_a = jobj.getString("jumlah_diskon");
                                jumlah_diskon = jumlah_diskon_a;
                                String diskon_a = jobj.getString("diskon");
                                diskon = diskon_a;
                                String pembayaran_a = jobj.getString("pembayaran");
                                pembayaran = pembayaran_a;
                                String total_harganya_a = jobj.getString("total_harganya");
                                total_harganya = total_harganya_a;
                                String total_jumlah_a = jobj.getString("total_jumlah");
                                total_jumlah = total_jumlah_a;
                                String tgl_buat = jobj.getString("tgl_buat");
                                tgl_buat = tgl_buat;
                                String pembuatnye = jobj.getString("pembuat");
                                pembuat = pembuatnye;
                                printBluetoothLabel();
                                //button.setVisibility(View.VISIBLE);
                                //printQrCode();
                            }catch (JSONException e) {
                                e.printStackTrace();
                            }

                        }
                    },
                    new Response.ErrorListener(){
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(MainActivity.this, error.toString().trim(), Toast.LENGTH_SHORT).show();
                        }
                    });
            RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
            requestQueue.add(stringRequest);
        }

    }
    private class MyWebViewClient extends WebViewClient {
        public boolean shouldOverrideUrlLoading(WebView view, String url) {

            reload.setVisibility(View.INVISIBLE);
            Log.d(TAG, url);
            view.loadUrl(url);
            Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse(url));
            intent.putExtra(Intent.EXTRA_TEXT, url);


            intent.setData(Uri.parse(url));
            //System.out.println(Uri.parse(url));
            String data = intent.getDataString();
            String[] hasil = data.split("=");
            for (String item : hasil)
            {
                System.out.println("status= " + item);
                String status = item;
                //button.setVisibility(View.VISIBLE);
                if (status.equals("cetak")){
                    //printBluetooth();browseBluetoothDevice();
                }
                if (status.equals("printer")){
                    browseBluetoothDevice();
                }
                if (status.equals("cetak_label")){
                    //browseBluetoothDevice();
                }
            }
            return true;
        }

        @Override
        public void onReceivedError(WebView view, int errorCode, String description, String failingUrl) {
            Toast.makeText(getApplicationContext(), "Tidak Ada Koneksi Internet", Toast.LENGTH_LONG).show();
            myWebView.loadUrl("file:///android_asset/lost.html");
            reload.setVisibility(View.VISIBLE);
        }

        @Override
        public void onReceivedSslError(WebView view, SslErrorHandler handler, SslError error) {
            super.onReceivedSslError(view, handler, error);
            handler.cancel();
        }

        @Override
        public void onPageStarted(WebView view, String url, Bitmap favicon) {
            super.onPageStarted(view, url, favicon);
            progressBar.setVisibility(View.VISIBLE);
        }

        @Override
        public void onPageFinished(WebView view, String url) {
            super.onPageFinished(view, url);
            progressBar.setVisibility(View.GONE);
        }
    }


    /*==============================================================================================
    ======================================BLUETOOTH PART============================================
    ==============================================================================================*/

    public static final int PERMISSION_BLUETOOTH = 1;
    public static final int PERMISSION_BLUETOOTH_ADMIN = 2;
    public static final int PERMISSION_BLUETOOTH_CONNECT = 3;
    public static final int PERMISSION_BLUETOOTH_SCAN = 4;

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
            switch (requestCode) {
                case MainActivity.PERMISSION_BLUETOOTH:
                case MainActivity.PERMISSION_BLUETOOTH_ADMIN:
                case MainActivity.PERMISSION_BLUETOOTH_CONNECT:
                case MainActivity.PERMISSION_BLUETOOTH_SCAN:
                    this.printBluetooth();
                    break;
            }
        }
    }

    private BluetoothConnection selectedDevice;

    public void browseBluetoothDevice() {
        final BluetoothConnection[] bluetoothDevicesList = (new BluetoothPrintersConnections()).getList();

        if (bluetoothDevicesList != null) {
            final String[] items = new String[bluetoothDevicesList.length + 1];
            items[0] = "Printer Utama";
            int i = 0;
            for (BluetoothConnection device : bluetoothDevicesList) {
                items[++i] = device.getDevice().getName();
            }

            AlertDialog.Builder alertDialog = new AlertDialog.Builder(MainActivity.this);
            alertDialog.setTitle("Pemilihan Printer Bluetooth");
            alertDialog.setItems(items, new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialogInterface, int i) {
                    int index = i - 1;
                    if (index == -1) {
                        selectedDevice = null;
                    } else {
                        selectedDevice = bluetoothDevicesList[index];
                    }
                    Button button = (Button) findViewById(R.id.button_bluetooth_browse);
                    //Toast.makeText(getApplicationContext(), "Terkoneksi dengan printer", Toast.LENGTH_LONG).show();

                    View v = View.inflate(MainActivity.this, R.layout.toast_printer, (ViewGroup) findViewById(R.id.toast_printer));
                    Toast toast = new Toast(MainActivity.this);
                    toast.setGravity(Gravity.CENTER, 0, 0);
                    toast.setDuration(Toast.LENGTH_SHORT);
                    toast.setView(v);
                    toast.show();
                    button.setText(items[i]);
                }
            });

            AlertDialog alert = alertDialog.create();
            alert.setCanceledOnTouchOutside(false);
            alert.show();

        }
    }

    public void printBluetooth() {
        if (ContextCompat.checkSelfPermission(this, Manifest.permission.BLUETOOTH) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.BLUETOOTH}, MainActivity.PERMISSION_BLUETOOTH);
        } else if (ContextCompat.checkSelfPermission(this, Manifest.permission.BLUETOOTH_ADMIN) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.BLUETOOTH_ADMIN}, MainActivity.PERMISSION_BLUETOOTH_ADMIN);
        } else if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.S && ContextCompat.checkSelfPermission(this, Manifest.permission.BLUETOOTH_CONNECT) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.BLUETOOTH_CONNECT}, MainActivity.PERMISSION_BLUETOOTH_CONNECT);
        } else if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.S && ContextCompat.checkSelfPermission(this, Manifest.permission.BLUETOOTH_SCAN) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.BLUETOOTH_SCAN}, MainActivity.PERMISSION_BLUETOOTH_SCAN);
        } else {
            new AsyncBluetoothEscPosPrint(
                    this,
                    new AsyncEscPosPrint.OnPrintFinished() {
                        @Override
                        public void onError(AsyncEscPosPrinter asyncEscPosPrinter, int codeException) {
                            Log.e("Async.OnPrintFinished", "AsyncEscPosPrint.OnPrintFinished : An error occurred !");
                        }

                        @Override
                        public void onSuccess(AsyncEscPosPrinter asyncEscPosPrinter) {
                            Log.i("Async.OnPrintFinished", "AsyncEscPosPrint.OnPrintFinished : Print is finished !");
                        }
                    }
            )
                    .execute(this.getAsyncEscPosPrinter(selectedDevice));
        }
    }


    /**
     * Asynchronous printing
     */
    @SuppressLint("SimpleDateFormat")
    public AsyncEscPosPrinter getAsyncEscPosPrinter(DeviceConnection printerConnection) {
        SimpleDateFormat format = new SimpleDateFormat("dd-MM-yyyy ' ' HH:mm:ss");
        AsyncEscPosPrinter printer = new AsyncEscPosPrinter(printerConnection, 203, 48f, 32);
        return printer.addTextToPrint(
                "[C]<img>" + PrinterTextParserImg.bitmapToHexadecimalString(printer,
                        this.getApplicationContext().getResources().getDrawableForDensity(R.drawable.top, DisplayMetrics.DENSITY_MEDIUM)) + "</img>\n" +
                        "[L]\n" +
                        "[L]<u type='double'>" + format.format(new Date()) + "</u>\n" +
                        "[L]<font size='medium'>RESI   "+no_resi+"</font>\n" +
                        "[L]Pengirim    : "+ nama_barang + "\n" +
                        "[L]Penerima    : "+ harga_dasar + "[R]Tlp : "+ harga_dasar + "\n" +
                        "[L]Asal        : "+ satuan +"\n" +
                        "[L]Tujuan      : "+ jumlah + "\n" +
                        "[C]______________________________________________\n" +
                        "[L]<font size='5'>Barang  : <b><u>"+nama_barang+"</u></b></font>\n" +
                        "[L]Jumlah      : " +jumlah+" Jml/Kg    "+jumlah+" Colli"+"\n" +
                        "[L]Bea Extra   : "+diskon+"\n" +
                        "[L]Biaya       : "+diskon+"\n" +
                        "[L]Asuransi    : "+total_harganya+" / "+total_harganya+"\n" +
                        "[R]<b>Dibayarkan  :"+total_jumlah+"</b>\n" +
                        "[L]Status&Ket  : "+total_jumlah+"\n" +
                        "[L]Status Bayar: "+pembayaran+"\n" +
                        "[L]Petugas     :"+pembuat+" [R]   ("+ pembuat + ")\n" +
                        "[L]<qrcode size='30'>"+no_resi+"</qrcode>\n"+
                        "[C]==============================================\n" +
                        "[L]\n\n"

        );
    }

    public void printBluetoothLabel() {
        if (ContextCompat.checkSelfPermission(this, Manifest.permission.BLUETOOTH) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.BLUETOOTH}, MainActivity.PERMISSION_BLUETOOTH);
        } else if (ContextCompat.checkSelfPermission(this, Manifest.permission.BLUETOOTH_ADMIN) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.BLUETOOTH_ADMIN}, MainActivity.PERMISSION_BLUETOOTH_ADMIN);
        } else if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.S && ContextCompat.checkSelfPermission(this, Manifest.permission.BLUETOOTH_CONNECT) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.BLUETOOTH_CONNECT}, MainActivity.PERMISSION_BLUETOOTH_CONNECT);
        } else if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.S && ContextCompat.checkSelfPermission(this, Manifest.permission.BLUETOOTH_SCAN) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.BLUETOOTH_SCAN}, MainActivity.PERMISSION_BLUETOOTH_SCAN);
        } else {
            new AsyncBluetoothEscPosPrint(
                    this,
                    new AsyncEscPosPrint.OnPrintFinished() {
                        @Override
                        public void onError(AsyncEscPosPrinter asyncEscPosPrinter, int codeException) {
                            Log.e("Async.OnPrintFinished", "AsyncEscPosPrint.OnPrintFinished : An error occurred !");
                        }

                        @Override
                        public void onSuccess(AsyncEscPosPrinter asyncEscPosPrinter) {
                            Log.i("Async.OnPrintFinished", "AsyncEscPosPrint.OnPrintFinished : Print is finished !");
                        }
                    }
            )
                    .execute(this.getAsyncEscPosPrinter2(selectedDevice));
        }
    }


    /**
     * Asynchronous printing
     */
    @SuppressLint("SimpleDateFormat")
    public AsyncEscPosPrinter getAsyncEscPosPrinter2(DeviceConnection printerConnection) {
        SimpleDateFormat format = new SimpleDateFormat("dd-MM-yyyy ' ' HH:mm:ss");
        AsyncEscPosPrinter printer = new AsyncEscPosPrinter(printerConnection, 203, 70f, 32);
        return printer.addTextToPrint(
                "[C]<img>" + PrinterTextParserImg.bitmapToHexadecimalString(printer,
                        this.getApplicationContext().getResources().getDrawableForDensity(R.drawable.top, DisplayMetrics.DENSITY_MEDIUM)) + "</img>\n" +
                        "[C]<qrcode size='35'>"+no_resi+"</qrcode>\n"+
                        "[C]<font size='10'><b><u>         "+no_resi+"</u></b></font>\n" +
                        "[L]<u type='double'>" + format.format(new Date()) + "</u>\n" +
                        "[L]Pengirim    : "+ no_resi + "\n" +
                        "[L]Penerima    : "+ no_resi + "[R]Tlp: "+ no_resi + "\n" +
                        "[L]Asal        : "+ no_resi +"\n" +
                        "[L]Tujuan      : "+ no_resi + "\n" +
                        "[C]______________________________________________\n" +
                        "[L]<font size='5'>Barang  : <b><u>"+nama_barang+"</u></b></font>\n" +
                        "[L]Jumlah      : " +no_resi+" Jml/Kg    "+no_resi+" Colli"+"\n"
        );
    }

    //batas
    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        // Check if the key event was the Back button and if there's history
        if ((keyCode == KeyEvent.KEYCODE_BACK) && myWebView.canGoBack()) {
            myWebView.goBack();
            button.setVisibility(View.INVISIBLE);
            buttonLabel.setVisibility(View.INVISIBLE);
            return true;
        }
        // If it wasn't the Back key or there's no web page history, bubble up to the default
        // system behavior (probably exit the activity)
        return super.onKeyDown(keyCode, event);
    }

}

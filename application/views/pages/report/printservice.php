<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title;?></title>
        <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
                margin-top : -10px;
            }

            #table td,  {
                
                border: none;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left; 
                color: black; 
                padding: 8px;
                border-top : 1px solid;
                border-bottom : 1px solid;
                border-left: none;
                border-left: none;
            }
        </style>
    </head><body>
       <!--   <table width="100%" align="center">
                <tr>
                        <td><img src="assets/img/logo/logo.png" width="90" height="120"></td>
                        <td  width="100%"align="left">
                        <center>
                            <font  size="4">PEMERINTAH KABUPATEN CIAMIS</font><br>
                            <font size="5"><b>DINAS KESEHATAN</b></font><br>
                            <font size="2">Jln. Mr. IwaKusumasomantriNo. 12 Tlp. (0265) 771139</font><br>
                            <font size="2">Faximile : (0265) 773828 E-mail : dinkesciamis@ymail.comWebsite : dinkes.ciamiskab.go.id</font><br>
                            <font size="4"><i>CIAMIS</i></font>
                        </center>
                        </td><br>
                        <hr>
                </tr>
                <tr>
                        <td></td>
                        <td align="right"><b>Kode Pos 46211</b></td>
                </tr>

        </table> -->
          <table > 
                <tr>
                    <td ><h5 style="text-align:left; margin-bottom: 0px;margin-top: 0px;width: 70px;">&nbsp; </h5></td>
                    <td ><h5 style="text-align:left; margin-bottom: 0px;margin-top: 0px;">&nbsp;</h5></td>
                    <td ><h5 style="text-align:right; margin-bottom: 0px;margin-top: 0px;width: 80px;"></h5></td>

                    <td><h5 style="text-align:right; margin-top: 0px;margin-bottom: 0px;width: 750px;"> </h5></td>
                    <td><h5 style="text-align:left; margin-top: 0px;margin-bottom: 0px;">Date</h5></td>
                    <td><h5 style="text-align:left; margin-top: 0px;margin-bottom: 0px;">:</h5></td>
                    <td><h5 style="text-align:right; margin-top: 0px;margin-bottom: 0px;margin-left: 25px;width: 132px"><?php echo format_indo(date("Y-m-d"));?></h5></td>
                    
                    
                </tr>
                <tr> 
                        <td><h5 style="text-align:left; margin-top: 0px;margin-bottom: 0px;">&nbsp;</h5></td>
                        <td><h5 style="text-align:left; margin-top: 0px;margin-bottom: 0px;">&nbsp;</h5></td>
                        <td><h5 style="text-align:right; margin-top: 0px;margin-bottom: 0px;">&nbsp;</h5></td>
                        <td><h5 style="text-align:right; margin-top: 0px;margin-bottom: 0px;">&nbsp;</h5></td>

                        <td><h5 style="text-align:left; margin-top: 0px;margin-bottom: 0px;">Time</h5></td>
                        <td><h5 style="text-align:left; margin-top: 0px;margin-bottom: 0px;">:</h5></td>
                        <td><h5 style="text-align:right; margin-top: 0px;margin-bottom: 0px;"><?=$time;?></h5></td> 
                </tr>

            </table>
              <h3 style="padding-bottom: 0px;text-align: center;font-weight: bold;font-size:25px;"><?= $title;?> </h3>

            <h4 style="margin-top: 0px;text-align: center;font-size: 15px;"><?= $subtitle?> </h4>
        <table id="table">
                <tr>
                    <th>No Service</th> 
                    <th>Tanggal</th> 
                    <th>Nama Pelanggan</th>
                    <th>Merk Laptop</th>
                    <th>Telepon(Whatsapp)</th>  
                    <th>Keluhan</th>  
                    <th>Status</th>
                </tr>
                <?php
                $no=1;
                foreach($service as $data){
                if($data->status=="1"){
                    $st = "Unit Masuk";
                }if($data->status=="2"){
                    $st = "Diagnosis";
                }if($data->status=="3"){
                    $st = "Persiapan";
                }if($data->status=="4"){
                    $st = "Pengerjaan";
                }if($data->status=="5"){
                    $st = "Selesai";
                }
                ?>
                <tr> 
                    <td style="width:15%"><?php echo $data->nomorservice ?></td>
                    <td style="width:15%"><?php echo format_indo(date('Y-m-d', strtotime($data->tanggalservice)));?></td>
                    <td style="width:20%"><?php echo $data->namapelanggan ?></td>
                    <td style="width:13%"><?php echo $data->merklaptop ?></td>
                    <td style="width:13%"><?php echo $data->telepon?> </td>
                    <td style="width:20%"><?php echo $data->keluhan?> </td>
                     <?php if ($st == "Unit Masuk") { ?>
                                       <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="10%"><?php echo $st ?></td>
                                    <?php }
                                    if ($st == "Diagnosis") { ?>
                                       <td style="vertical-align: top;border-top: 1px solid #e3e6f0;color:orange" width="10%"><?php echo $st ?></td>
                                    <?php }
                                    if ($st == "Persiapan") { ?>
                                       <td style="vertical-align: top;border-top: 1px solid #e3e6f0;color:yellow" width="10%"><?php echo $st ?></td>
                                    <?php }
                                    if ($st == "Pengerjaan") { ?>
                                       <td style="vertical-align: top;border-top: 1px solid #e3e6f0;color:blue" width="10%"><?php echo $st ?></td>
                                    <?php }
                                    if ($st == "Selesai") { ?>
                                       <td style="vertical-align: top;border-top: 1px solid #e3e6f0;color:green" width="10%"><?php echo $st ?></td>
                                    <?php }  ?>
                </tr>
                <?php 
                $no++;
                } 
                ?>
           </table>


        <?php foreach($totaldata as $jml){?>
        <table style="margin-bottom: 0px;margin-top: 20px;">
            <tr>
                <td  style="padding-bottom: 5px;"><b>Keterangan</b></td>
            </tr>
            <tr>
                <td  width="168">Jumlah Data Service</td>
                <td width="564">: <?= $jml->jumlahservice ?></td>
            </tr>
        </table>
        <?php } ?>

        <?php foreach($totaldataunitmasuk as $jml){?>
        <table style="margin-bottom: 0px;margin-top: 0px;">
            <tr>
                <td>Jumlah Data Service (Unit Masuk)</td>
                <td width="564">: <?= $jml->jumlahunitmasuk ?></td>
            </tr>
        </table>
        <?php } ?>
 
        <?php foreach($totaldatadiagnosis as $jml){?>
        <table style="margin-bottom: 0px;margin-top: 0px;">
            <tr>
                <td width="168">Jumlah Data Service (Diagnosis)</td>
                <td width="564">: <?= $jml->jumlahdiagnosis ?></td>
            </tr>
        </table>
        <?php } ?>

        <?php foreach($totaldatapersiapan as $jml){?>
        <table style="margin-bottom: 0px;margin-top: 0px;">
            <tr>
                <td width="168">Jumlah Data Service (Persiapan)</td>
                <td >: <?= $jml->jumlahpersiapan ?></td>
            </tr>
        </table>
        <?php } ?>

        <?php foreach($totaldatapengerjaan as $jml){?>
        <table style="margin-bottom: 0px;margin-top: 0px;">
            <tr>
                <td width="168">Jumlah Data Service (Pengerjaan)</td>
                <td >: <?= $jml->jumlahpengerjaan ?></td>
            </tr>
        </table>
        <?php } ?>

        <?php foreach($totaldataselesai as $jml){?>
        <table style="margin-bottom: 0px;margin-top: 0px;">
            <tr>
                <td width="168">Jumlah Data Service (Selesai)</td>
                <td >: <?= $jml->jumlahselesai ?></td>
            </tr>
        </table>
        <?php } ?>
         
    </body></html>
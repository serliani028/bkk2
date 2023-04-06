<html>
    <head></head>
    <body>
        <!--<div class="">-->
            <img style="background-color:#D83030;padding:5px" src="https://smk.cybersjob.com/assets/front/images/site-logo.png" class="logo-text" alt="" height="40px;">
        <!--</div>-->
        <br>
        <br>
        <h1 style="text-align:center"><b>PSIKOGRAM PESERTA</b></h1>
        <hr>
        <br>
        <h3><b>DATA DIRI PESERTA</b></h3>
        <!--<br>-->
        <table style="border:1px solid black" width="100%">
            <tr>
                <td style="border-right:1px solid black;border-bottom:1px solid black;font-size:15px;padding:5px">Nama Peserta</td>
                <td style="font-size:15px;border-bottom:1px solid black"> : <b><?=$candidate->first_name;?></b></td>
            </tr>
            <tr>
                <td style="border-right:1px solid black;border-bottom:1px solid black;font-size:15px;padding:5px">Alamat</td>
                <td style="font-size:15px;border-bottom:1px solid black"> : <b><?=$candidate->address;?></b></td>
            </tr>
            <tr>
                <td style="border-right:1px solid black;border-bottom:1px solid black;font-size:15px;padding:5px">Email</td>
                <td style="font-size:15px;border-bottom:1px solid black"> : <b><?=$candidate->email;?></b></td>
            </tr>
            <tr>
                <td style="border-right:1px solid black;border-bottom:1px solid black;font-size:15px;padding:5px">No.Telp</td>
                <td style="font-size:15px;border-bottom:1px solid black"> : <b><?=$candidate->phone1;?></b></td>
            </tr>
            <tr>
                <td style="border-right:1px solid black;font-size:15px;padding:5px">Instansi</td>
                <td style="font-size:15px;"> : <b><?=strtoupper($candidate->nama);?></b></td>
            </tr>
            
        </table>
        <br>
        <h3><b>HASIL PSIKOGRAM</b></h3>
        <!--<br>-->
        <table width="100%" style="border:1px solid black">
           <thead>
               <tr style="text-align:center;font-size:20px" height="50px">
                   <td style="border:1px solid black" width="5%" rowspan="2"><b>No.</b></td>
                   <td style="border:1px solid black;text-align:left;" rowspan="2" width="50%"><b> &nbsp;&nbsp;Aspek / Kriteria Penilaian</b></td>
                   <!--<td style="border:1px solid black" width="7%" rowspan="2"><b>STD</b></td>-->
                   <td style="border:1px solid black" width="30%" colspan="5" ><b>Poin Peserta</b></td>
                   <!--<td>Nilai</td>-->
               </tr>
               <tr style="text-align:center">
                   
                   <td style="border:1px solid black" width="6%">1</td>
                   <td style="border:1px solid black" width="6%">2</td>
                   <td style="border:1px solid black" width="6%">3</td>
                   <td style="border:1px solid black" width="6%">4</td>
                   <td style="border:1px solid black" width="6%">5</td>
                   
               </tr>
           </thead>
            <tbody>
                <?php $no = 1;  foreach ($nilai as $key => $value): ?>
                <tr style="text-align:center;font-size:18px" height="30px">
                <td style="border:1px solid black"><?=$no++;?></td>
                <td style="border:1px solid black;text-align:left"> &nbsp;&nbsp;<?=$value->pola;?></td>
                <!--<td style="border:1px solid black;text-align:center"> &nbsp;&nbsp; <b><?=$value->grey;?> Poin </b></td>-->
                <td style="border:1px solid black">
                <?php if($value->nilai == 1){?>
                <img src="https://smk.cybersjob.com/assets/front/images/check.png" height="20px;">
                <?php }?>
                </td>
                <td style="border:1px solid black">
                <?php if($value->nilai == 2){?>
                <img src="https://smk.cybersjob.com/assets/front/images/check.png" height="20px;">
                <?php }?>
                </td>
                <td style="border:1px solid black">
                <?php if($value->nilai == 3){?>
                <img src="https://smk.cybersjob.com/assets/front/images/check.png" height="20px;">
                <?php }?>
                </td>
                <td style="border:1px solid black">
                <?php if($value->nilai == 4){?>
                <img src="https://smk.cybersjob.com/assets/front/images/check.png" height="20px;">
                <?php }?>
                </td>
                <td style="border:1px solid black">
                <?php if($value->nilai == 5){?>
                <img src="https://smk.cybersjob.com/assets/front/images/check.png" height="20px;">
                <?php }?>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <b style="font-size:19px">Catatan Peserta : </b>
        <br>
        <br>
        <div style="border:1px solid black;padding:10px;font-size:17px">
            <?=$candidate->narasi_psiko?>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div style="vertical-align:bottom;text-align:right">
        <img src="https://smk.cybersjob.com/assets/front/images/site-logo.png" class="logo-text" alt="" height="40px;"><br>
        <b>TalentHub.cybers.id</b>
        </div>
    </body>
</html>
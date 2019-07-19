<?php

  //shif for key and iteration
  function shift($array) {
    $sz=count($array);
    $temp=$array[0];
    for($i=0;$i<$sz-1;$i++) {
        $array[$i]=$array[$i+1];
    }
    $array[$sz-1]=$temp;
    
    return $array;
  }

  /**
   * Metode untuk mengubah huruf menjadi bilangan biner
   *
   * @param string $m
   * @return biner $bin
   */
  function covert($m){
    // Mengubah karakter menjadi bilangan ASCII
    for($i=0; $i<strlen($m); $i++) {
      $ascii[$i] = ord($m[$i]);
    }

    // Mengubah bilangan ASCII menjadi Hexadecimal
    for($i=0; $i<count($ascii); $i++) {
      $hex[$i] = dechex($ascii[$i]);
    }

    // Inisialisasi variabel
    $bin = NULL;

    // Mengubah bilangan Hexadecimal menjadi bilangan biner
    for($i=0; $i<count($hex); $i++) {
      $len = strlen(base_convert($hex[$i],16,2));
        
      for($j=0; $j<8-$len; $j++) {
        $bin .= "0";
      }
      
      $bin .= base_convert($hex[$i],16,2);
    }

    return $bin;
  }

  function selectionTable($Er, $sele) {
    $ret = NULL;
    for($i=0; $i < count($sele); $i++) {
      $ret .= $Er[$sele[$i]-1];
    }

    return $ret;
  }

  function xorFun($param1, $param2) {
    $ret = NULL;

    for($i=0; $i<strlen($param1); $i++)
    {
      $ret .=$param1[$i]!= $param2[$i]?'1':'0';
    }
  
    return $ret;
  }

  function sBoxes($param) {
    $ret = NULL;
    // S1
    $s1 = "14 4 13 1 2 15 11 8 3 10 6 12 5 9 0 7 0 15 7 4 14 2 13 1 10 6 12 11 9 5 3 8 4 1 14 8 13 6 2 11 15 12 9 7 3 10 5 0 15 12 8 2 4 9 1 7 5 11 3 14 10 0 6 13";
    $s1 = explode( " ", $s1);
    $s1 =  array_chunk($s1, 16);

    // S2
    $s2 = "15 1 8 14 6 11 3 4 9 7 2 13 12 0 5 10 3 13 4 7 15 2 8 14 12 0 1 10 6 9 11 5 0 14 7 11 10 4 13 1 5 8 12 6 9 3 2 15 13 8 10 1 3 15 4 2 11 6 7 12 0 5 14 9";
    $s2 = explode( " ", $s2);
    $s2 =  array_chunk($s2, 16);

    // S3
    $s3 = "10 0 9 14 6 3 15 5 1 13 12 7 11 4 2 8 13 7 0 9 3 4 6 10 2 8 5 14 12 11 15 1 13 6 4 9 8 15 3 0 11 1 2 12 5 10 14 7 1 10 13 0 6 9 8 7 4 15 14 3 11 5 2 12";
    $s3 = explode( " ", $s3);
    $s3 =  array_chunk($s3, 16);

    // S4
    $s4 = "7 13 14 3 0 6 9 10 1 2 8 5 11 12 4 15 13 8 11 5 6 15 0 3 4 7 2 12 1 10 14 9 10 6 9 0 12 11 7 13 15 1 3 14 5 2 8 4 3 15 0 6 10 1 13 8 9 4 5 11 12 7 2 14";
    $s4 = explode( " ", $s4);
    $s4 = array_chunk($s4, 16);

    // S5
    $s5 = "2 12 4 1 7 10 11 6 8 5 3 15 13 0 14 9 14 11 2 12 4 7 13 1 5 0 15 10 3 9 8 6 4 2 1 11 10 13 7 8 15 9 12 5 6 3 0 14 11 8 12 7 1 14 2 13 6 15 0 9 10 4 5 3";
    $s5 = explode( " ", $s5);
    $s5 =  array_chunk($s5, 16);

    // S6
    $s6 = "12 1 10 15 9 2 6 8 0 13 3 4 14 7 5 11 10 15 4 2 7 12 9 5 6 1 13 14 0 11 3 8 9 14 15 5 2 8 12 3 7 0 4 10 1 13 11 6 4 3 2 12 9 5 15 10 11 14 1 7 6 0 8 13";
    $s6 = explode( " ", $s6);
    $s6 =  array_chunk($s6, 16);

    // S7
    $s7 = "4 11 2 14 15 0 8 13 3 12 9 7 5 10 6 1 13 0 11 7 4 9 1 10 14 3 5 12 2 15 8 6 1 4 11 13 12 3 7 14 10 15 6 8 0 5 9 2 6 11 13 8 1 4 10 7 9 5 0 15 14 2 3 12";
    $s7 = explode( " ", $s7);
    $s7 = array_chunk($s7, 16);

    // S8
    $s8 = "13 2 8 4 6 15 11 1 10 9 3 14 5 0 12 7 1 15 13 8 10 3 7 4 12 5 6 11 0 14 9 2 7 11 4 1 9 12 14 2 0 6 10 13 15 3 5 8 2 1 14 7 4 10 8 13 15 12 9 0 3 5 6 11";
    $s8 = explode( " ", $s8);
    $s8 = array_chunk($s8, 16);
    
    
    for($i=0;$i<48;$i+=6) {   
      $row = NULL;
      $col = NULL;
      
      $row .= $param[$i];
      $row .= $param[$i+5];
      
      for($j=$i+1; $j<=$i+4; $j++) {
        $col.=$param[$j];
      }

      $row = bindec($row);
      $col = bindec($col);
        
      $current=NULL;
      switch ($i) {
        case 0:
          $current = intval($s1[$row][$col]);
          break;
        case 6:
          $current = intval($s2[$row][$col]);
          break;
        case 12:
          $current = intval($s3[$row][$col]);
          break;
        case 18:
          $current = intval($s4[$row][$col]);
          break;
        case 24:
          $current = intval($s5[$row][$col]);
          break;
        case 30:
          $current = intval($s6[$row][$col]);
          break;
        case 36:
          $current = intval($s7[$row][$col]);
          break;
        default:
          $current = intval($s8[$row][$col]);
          break;
      }
         
      $current = decbin($current);
      $temp = NULL;
      for($k=0; $k<(4-strlen($current)); $k++) {
        $temp .= "0"; 
      }

      $current = $temp.$current;
      $ret .= $current;
    }
    return $ret;
  }

  if(isset($_POST) && $_POST["text"] != NULL && $_POST["key"]) {
    if (strlen($_POST["text"]) != 8 && strlen($_POST["key"]) != 8) {
      echo "<script>
        alert('Panjang plaintext atau key harus 8.');
        location.href='index.php';
      </script>";
    }

    $k = $_POST["key"];

    $bin = covert($k);

    // echo "Key_POST dalam bilangan biner : </br>";

    // foreach (str_split($k) as $data) {
        // echo $bin;
    // }
    
    $pc1 = array(
      57,49,41,33,25,17,9,
      1,58,50,42,34,26,18,
      10,2,59,51,43,35,27,
      19,11,3,60,52,44,36,
      63,55,47,39,31,23,15,
      7,62,54,46,38,30,22,
      14,6,61,53,45,37,29,
      21,13,5,28,20,12,4
    );

    $key = str_split($bin);
    for($i=0; $i< count($pc1); $i++)
    {
      $newkey[] = $key[$pc1[$i]-1];
      if($i<28) {
        $c0[]=$key[$pc1[$i]-1];
      } else {
        $d0[]=$key[$pc1[$i]-1];
      }
    }
    // echo "<br/> Setelah PC1 <br>".implode($newkey)."<br/><br/>";
    for($i=0; $i<3; $i++) {       
      if($i==0) {
        $C[] = shift($c0);
        $D[] = shift($d0);
      } else if($i==1||$i==8||$i==15) {
        $C[] = shift($C[count($C)-1]);
        $D[] = shift($D[count($D)-1]);
      } else {
        $x = shift($C[count($C)-1]);
        $C[] = shift($x);
        
        $x = shift($D[count($D)-1]);
        $D[] = shift($x);
      }
      $K[]= implode($C[$i]).implode($D[$i]);
    }

    //     echo "C0 and D0<br>";
    //     var_dump(implode($C[0]));
    //     echo "<br>";
    //     var_dump(implode($D[0]));
    // echo "<br>CnDn";
    // echo "<pre>";
    // var_dump($K);
    // echo "</pre>";
    $pc2 = "14 17 11 24 1 5 3 28 15 6 21 10 23 19 12 4 26 8 16 7 27 20 13 2 41 52 31 37 47 55 30 40 51 45 33 48 44 49 39 56 34 53 46 42 50 36 29 32";
    $pc2 = explode(" ", $pc2);
    for($i=0; $i<3 ;$i++) {
      for($j=0; $j<count($pc2); $j++) {
        $NK[$i][$j]= $K[$i][intval($pc2[$j])-1];
      }
      $K[$i]=  implode($NK[$i]);
    }

    // echo "<br><br>key after pc2 </br>";
    // echo "<pre>";
    // var_dump($K);   
    // echo "</pre>";
    //code her for message

    $m = $_POST["text"];
    $mbin = covert($m);
    $ip = "58 50 42 34 26 18 10 2 60 52 44 36 28 20 12 4 62 54 46 38 30 22 14 6 64 56 48 40 32 24 16 8 57 49 41 33 25 17 9 1 59 51 43 35 27 19 11 3 61 53 45 37 29 21 13 5 63 55 47 39 31 23 15 7";
    $ip = explode(' ',$ip);

    $newm = NULL;
    $L0 = NULL;
    $R0 =NULL;

    for($i=0;$i<count($ip);$i++) {
      $newm.=$mbin[intval($ip[$i])-1];
      if($i< count($ip)/2) {
        $L0.=$mbin[intval($ip[$i])-1];
      } else {
       $R0.=$mbin[intval($ip[$i])-1];
     }
    }
    // echo "<br/>message <br/>$mbin<br/> ";
    // echo "<br/>message  after applying ip<br/>$newm<br/> ";
    // echo "<br/>L0 --- $L0<br/>R0 ---  $R0<br/> ";
    $sele = array(
      32,1,2,3,4,5,
      4,5,6,7,8,9,
      8,9,10,11,12,13,
      12,13,14,15,16,17,
      16,17,18,19,20,21,
      20,21,22,23,24,25,
      24,25,26,27,28,29,
      28,29,30,31,32,1
    );
     
    //permutaion array
    $P = "16 7 20 21 29 12 28 17 1 15 23 26 5 18 31 10 2 8 24 14 32 27 3 9 19 13 30 6 22 11 4 25";
    $P = explode(" ", $P);
     
    $L = array($L0);
    $R = array($R0);
    for($i=0; $i<3; $i++) {
      $L[] = $R[$i] ;
      $Er = $R[$i];
      $Er = selectionTable($Er,$sele);
      $KER = xorFun($Er,$K[$i]);
      $sbox = sBoxes($KER);
      $permu = selectionTable($sbox, $P);
      $R[] =  xorFun($permu, $L[$i]);
      $full[] = $R[$i+1].$L[$i+1];
    }
     // echo " L <br/>";
     // var_dump($L);
     // echo " R <br/>";
     // var_dump($R);
    $ip = "40 8 48 16 56 24 64 32 39 7 47 15 55 23 63 31 38 6 46 14 54 22 62 30 37 5 45 13 53 21 61 29 36 4 44 12 52 20 60 28 35 3 43 11 51 19 59 27 34 2 42 10 50 18 58 26 33 1 41 9 49 17 57 25";
    $ip = explode(" ", $ip);
    $ipRev = selectionTable($full[2], $ip);
        // echo "message after ip -1 --- $ipRev<br/>";
    $E = NULL;
    $AS = NULL;
    for($i=0; $i<strlen($ipRev); $i+=4) {
      $x = substr($ipRev, $i,4);
      $E .= $f = dechex(bindec($x));  
    }

    for($i=0;$i<strlen($ipRev);$i+=8) {
      $y=  substr($ipRev, $i,8);
      $AS.=chr(bindec($y));
    }

    $enc_result = str_split($E, 2);

    echo "Plaintext : " . $_POST['text'] . "<br>";
    echo "Key : " . $_POST['key'] . "<br>";
    echo "Hasil enkripsi : " . implode(" ", $enc_result) . "<br>";
    echo "Pesan enkripsi : " . $AS;
  } else {
    echo "<script>
        alert('Plaintext atau key harus diisi.');
        location.href='index.php';
      </script>";
  }

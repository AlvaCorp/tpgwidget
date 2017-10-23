<?php

require __DIR__.'/../../tpgdata/apikey.php';
$file = 'http://prod.ivtr-od.tpg.ch/v1/GetDisruptions.xml?key='.$key;
$disruptions = simplexml_load_file($file);

if (!$disruptions) {
	$serveurTPGIndisponible = true;
}

$whiteTextLines = [
    '1', '3', '4', '5', '6', '7', '8', '9', '10', '11', '14', '15', '18', '21', '22', '23', '25',
    '31', '32', '33', '35', '36', '41', '44', '46', '47', '51', '52', '54', '56',
    'A', 'C', 'E', 'J', 'L', 'U', 'P', 'S', 'TO', 'TT', 'V', 'W', 'X',
    'G+', '5+', 'V+', 'C+',
    'NA', 'NC', 'ND', 'NE', 'NO', 'NP', 'NS', 'NT', 'NV'
];
$allLines = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "14", "15", "18", "19", "21", "22", "23", "25", "28", "31", "32", "33", "34", "35", "36", "41", "42", "43", "44", "45", "46", "47", "51", "53", "54", "56", "57", "61", "A", "B", "C", "D", "DN", "E", "F", "G", "K", "L", "M", "NA", "NC", "ND", "NE", "NJ", "NK", "NM", "NO", "NP", "NS", "NT", "O", "S", "T", "TO", "TT", "V", "W", "X", "Y", "Z", "J", "P"];

$perturbations = 0;
foreach ($disruptions->disruptions->disruption as $disruption) {
    if (in_array($disruption->lineCode, $toutesLesLignes)) { ?>
    <div class="card">
      <div class="card-content">
        <div class="card-content-inner">
              <div class="perturbation-header">
                  <?
                      $perturbations++;
                      echo '<span class="picto-ligne ';
                      echo 'l'.$disruption->lineCode.' ';
                      echo 's'.$disruption->lineCode.' ';

                      if(in_array($disruption->lineCode, $lignesAvecTexteBlanc)){
                          echo 'w';
                      }

                      echo '">'.$disruption->lineCode;
                      echo '</span>';
                  ?>
                  <header><?=$disruption->nature?></header>
                  <?
                      if($disruption->place != ""){
                          echo '<small>'.$disruption->place.'</small>';
                      } else {
                          echo "&nbsp;";
                      }
                  ?>
              </div>
              <p><?= $disruption->consequence ?></p>
        </div>
      </div>
    </div>
<? }
} if (!$perturbations) { ?>
    <div class="card">
      <div class="card-content">
        <div class="card-content-inner">
            <div class="graym">
                <span class="smileyBien"></span>
                <h2>Aucune perturbation sur le réseau !</h2>
            </div>
        </div>
      </div>
    </div>
<? } ?>

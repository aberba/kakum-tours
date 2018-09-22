<?php

class Gallery {
      private $videos_table = "videos";
      private $photos_table = "photos";
      private $docs_table   = "docs";

      public function fetchAll() {
          global $Database;

          $dphotos = $Database->query("SELECT * FROM ". $this->photos_table ." WHERE publish = '1' ORDER BY date_added DESC");
          $dvideos = $Database->query("SELECT * FROM ". $this->videos_table ." WHERE publish = '1' ORDER BY date_added DESC");
          $ddocs   = $Database->query("SELECT * FROM ". $this->docs_table ." WHERE publish = '1' ORDER BY date_added DESC");

          $videos = array();
          $photos = array();
          $docs   = array();
          $final_output = array();

          while ($r2 = $Database->fetch_data($dphotos)) {
              $photos[] = $r2;
          }

          while ($r1 = $Database->fetch_data($dvideos)) {
              $videos[] = $r1;
          }


          while ($r3 = $Database->fetch_data($ddocs)) {
              $docs[] = $r3;
          }


          $final_output['videos'] = $videos;
          $final_output['photos'] = $photos;
          $final_output['docs']   = $docs;
          return $final_output;
      }
}

$Gallery = new Gallery();
?>
<?php
require_once("conn.php");

function __($input){
    return htmlspecialchars($input, ENT_QUOTES);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/6168440589.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css"></link>
    
    <title>Project 1: Cars in Stock Checker</title>
  </head>
  <body>
  
    <div class="container py-5">
      <h3>Cars</h3>
      <hr>

      <div class="row">
        <div class="col-12">
          <form class="input-group" id="search-form">
            <div class="input-group-prepend">
              <select class="custom-select"  id="year-select">
                <option selected value="0">Year</option>
                
                <?php
                for($i = 1950; $i <= intval(date("Y")); $i++) {
                  echo "<option value='$i'>$i</option>";
                }
                ?>

              </select>
            </div>
            <input type="search" name="search" placeholder="Enter Car Make or Model" class="form-control" id="search-model">
            <input type="search" name="search" placeholder="Enter Nickname" class="form-control" id="search-nickname">
            <div class="input-group-append">
              <button class="btn btn-primary form-control" type="submit">
                <i class="fas fa-search text-white"></i>
              </button>
            </div>
          </form>
        </div>
      </div>

      <table class="table">
          <thead>
              <th>Make</th>
              <th>Model</th>
              <th>Year</th>
              <th>Nickname</th>
          </thead>
          <tbody id="search-results">

          <?php

          $sql = "SELECT * FROM cars";
          $results = $db->query($sql);

          while($row = $results->fetch_assoc()){
              echo "<tr>";
                  echo "<td>" . __($row["make"]) . "</td>";
                  echo "<td>" . __($row["model"]) . "</td>";
                  echo "<td>" . __($row["year"]) . "</td>";
                  echo "<td>" . __($row["nickname"]) . "</td>";
              echo "</tr>";
          }
          
          ?>

          </tbody>
      </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
  </body>
</html>
<?php
if (isset($_POST["view"])) {
   include("init.php");
   if ($_POST["view"] != '') {
      $update_query = "UPDATE vendas SET notificacao = 1 WHERE notificacao = 0";
      mysqli_query($connect, $update_query);
   }
   $query = "SELECT * FROM vendas ORDER BY id DESC LIMIT 5";
   $result = mysqli_query($connect, $query);
   $output = '';

   if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_array($result)) {
         $output .= '
     <a href="#" class="dropdown-item">
         <h6 class="fw-normal mb-0">' . $row["nome"] . '</h6>
     </a>
     <hr class="dropdown-divider">
     ';
      }
   } else {
      $output .= '<h6 class="p-3 mb-0 text-center">Nenhuma notificação encontrada.</h6>';
   }

   $query_1 = "SELECT * FROM vendas WHERE notificacao = 0";
   $result_1 = mysqli_query($connect, $query_1);
   $count = mysqli_num_rows($result_1);
   $data = array(
      'notification'   => $output,
      'unseen_notification' => $count
   );
   echo json_encode($data);
}

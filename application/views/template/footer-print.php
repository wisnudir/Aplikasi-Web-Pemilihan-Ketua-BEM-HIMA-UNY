        <hr><footer style="text-align: center">
          Lembar ini dicetak pada:<br>
          <?php 
          date_default_timezone_set('Asia/Jakarta');
          $tgl_sekarang = date('Y-m-j');
          $jam_sekarang = date('H:i:s');
          echo $tgl_sekarang," pukul ",$jam_sekarang;
          ?>
        </footer>
        <script>window.print()</script>
    </body>
</html>

     <script src="assets/jquery-3.2.1.min.js"></script>
     <script src="assets/jquery.validate.min.js"></script>
     <script src="assets/additional-methods.min.js"></script>
     <script src="assets/sweetalert.min.js"></script>
     <script src="assets/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.js"></script>
    <script src="assets/js/dataTables.responsive.js"></script>   
    <script class="reload" src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/Chart.min.js"></script>
    <script src="assets/chartScript.js"></script>
	<script src="assets/validation.js"></script>

    <script type="text/javascript">
      var data=<?= json_encode($data)?>;
      var tool={
        nam:[],
        cost:[]
      };
      var len=data.length;

      for (var i=0; i<len; i++){
        // console.log(data[i]);
              tool.nam.push(data[i].namba);
            
              tool.cost.push(data[i].cost);
      }
      console.log(tool);

      var ctx= document.getElementById("chartMy").getContext('2d');

      var data={
        labels : ["1st","sec","3rd","4th","5th"],
        datasets:[
        {
            label: "Cost of tools",
            data: tool.cost,
            backgroundColor: "green",
            borderColor: "lightgreen",
            fill: false,
            lineTension: 0,
            pointRadius:5
        },
        {
            label: "Number of tools",
            data: tool.nam,
            backgroundColor: "blue",
            borderColor: "lightblue",
            fill: false,
            lineTension: 0,
            pointRadius:5
        }
        ]
      }
      var chart=new Chart(ctx, {
        type:"line",
        data:data,
        option: {}
      });
    </script>
     <?php include 'feed.php';?>
      <?php include 'adjustVar.php';?>
<footer id="footer">
    <p>Copyright &copy; www.lasittea.com 2018</p>
</footer>

    
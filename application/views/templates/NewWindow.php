<!DOCTYPE html>
<html>
<body>

<p><?php echo $Mensaje?></p>

<button onclick="myFunction()">Ver</button>

<script>
function myFunction() {
  window.open("<?php echo site_url().$URL;?>");
}
</script>

</body>
</html>

<footer class="main-footer">
  <strong id="copy">Copyright © Beautysoft. </strong>
</footer>

<script>
   var copy = document.getElementById("copy"),
       year = new Date().getFullYear();
       text = copy.innerText
  copy.innerText =  text + year;
</script>
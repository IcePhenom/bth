<nav class="vmenu">
  <ul <?php if(isset($p)) echo "id='".strip_tags($p)."'"; ?>>
    <li><h4>Framsida administration</h4>
      <ul>
        <li id="front-init"><a href="?p=init">Status</a>
        <li id="front-update"><a href="?p=update">Uppdatera framsida</a>
      </ul>
  </ul>
</nav>

<nav class="vmenu">
  <ul <?php if(isset($p)) echo "id='".strip_tags($p)."'"; ?>>
    <li><h4>Blokket administration</h4>
      <ul>
        <li id="data-init"><a href="?p=init">Initiera</a>
        <li id="data-add"><a href="?p=create">Lägg till data</a>
        <li id="data-update"><a href="?p=update">Uppdatera data</a>
        <li id="data-delete"><a href="?p=delete">Ta bort data</a>
      </ul>
  </ul>
</nav>

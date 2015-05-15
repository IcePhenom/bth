<nav class="vmenu">
  <ul <?php if(isset($p)) echo "id='".strip_tags($p)."'"; ?>>
    <li><h4>Objekt administration</h4>
      <ul>
        <li id="object-init"><a href="?p=init">Status</a>
        <li id="object-update"><a href="?p=update">Uppdatera objekt</a>
        <li id="object-add"><a href="?p=create">Lägg till objekt</a>
        <li id="object-delete"><a href="?p=delete">Ta bort objekt</a>
        <li id="object-readall"><a href="?p=read-all">Visa objekt</a>
      </ul>
  </ul>
</nav>

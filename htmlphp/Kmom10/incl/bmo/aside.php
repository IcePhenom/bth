<nav class="vmenu">
  <ul <?php if(isset($p)) echo "id='".strip_tags($p)."'"; ?>>
    <li><h4>Artikel administration</h4>
      <ul>
        <li id="article-init"><a href="?p=init">Status</a>
        <li id="article-update"><a href="?p=update">Uppdatera artikel</a>
        <li id="article-add"><a href="?p=create">Lägg till artikel</a>
        <li id="article-delete"><a href="?p=delete">Ta bort artikel</a>
        <li id="article-readall"><a href="?p=read-all">Visa artiklar</a>
      </ul>
  </ul>
</nav>

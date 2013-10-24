<div class="navigation">
    <ul id="menu">
        <li><a href="#" id="addBook">Add Book</a></li>
        <li><a href="#" id="addAuthor">Add Author</a></li>
        <li><a href="index.php?sort=<?= $sortFix ?>">Sort</a></li>
    </ul>
    <form action="index.php" method="POST">
        <input type="submit" name="postSearch" value="Search Book" id="postSearch"/>
        <input type="text" name="searchKey" id="searchKey"/>
    </form>
</div>
<?php 
$pdo = new PDO('sqlite:chinook.db');
$sql = '
select 
tracks.Name as trackName, 
artists.Name as artistName, 
albums.Title as albumName, 
tracks.UnitPrice as price
from tracks
inner join albums
on albums.AlbumId = tracks.AlbumId
inner join artists
on artists.ArtistId = albums.ArtistId
inner join genres
on genres.GenreId = tracks.GenreId
where genres.Name = ?
';
$statement = $pdo->prepare($sql);
$statement->bindParam(1, $_GET['genre']);
$statement->execute();
$tracks = $statement->fetchAll(PDO::FETCH_OBJ);
// echo $_GET['genre'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tracks</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
</head>

<body>
    <table class='table'>
        <tr>
            <th>Title</th>
            <th>Artist</th>
            <th>Album</th>
            <th>Price</th>
        </tr>
        <?php foreach($tracks as $track) : ?>
        <tr>
            <td>
                <?php echo $track->trackName ?>
            </td>
            <td>
                <?php echo $track->artistName ?>
            </td>
            <td>
                <?php echo $track->albumName ?>
            </td>
            <td>
                <?php echo $track->price ?>
            </td>
        </tr>
        <?php endforeach ?>
    </table>
</body>

</html>

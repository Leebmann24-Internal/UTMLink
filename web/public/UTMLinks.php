<html lang="de">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>URL-Creator</title>
</head>
<body>
    <img alt="Leebmann" src ="https://www.leebmann.de/wp-content/uploads/2020/10/Header-Willkommen-1080x146px-10.2020.jpg">
    <div class="container-fluid">
        <div class="div2">
            <label for="myInput"></label>
            <input id="myInput" type="text" placeholder="Search..">
            <a href="./" id="showLinks" class="btn btn-primary">TinyUrl Gen</a>
            <table class="table">

                <thead class="thead-dark">

                    <tr>
                        <th>Quelle</th>
                        <th>Medium</th>
                        <th>Kampagne</th>
                        <th>Content</th>
                        <th>Term</th>
                        <th>Tiny Url</th>
                        <th>Löschen</th>
                    </tr>
                </thead>
                <tbody id="myTable">

                    <?php
                    require_once("./Models/Tinyurl.php");

                    $tinyUrls = new TinyUrl();
                   $tinyUrlData = $tinyUrls->showTiny();
                   foreach ($tinyUrlData as $tinyInfo){
                       ?>
                           <form method="post">
                    <tr>
                        <td><?PHP echo $tinyInfo[0]; ?></td>
                        <td><?PHP echo $tinyInfo[1]; ?></td>
                        <td><?PHP echo $tinyInfo[2]; ?></td>
                         <td><?PHP echo $tinyInfo[3]; ?></td>
                        <td><?PHP echo $tinyInfo[4]; ?></td>
                         <td><a href="<?PHP echo $tinyInfo[5]; ?>" target="_blank"><?PHP echo $tinyInfo[5]; ?></a></td>
                        <td><input class="btn btn-primary" type="submit" id="delete" value="Löschen" >
                    </tr>
                   <input type='hidden' name='test' id='test' value='".<?PHP $tinyInfo[5]; ?>."'  >
                           </form>
                   <?php
                   }
                   if (!empty($_POST['test'])) {
                       $tinyUrl= $tinyInfo[5];
                       $tinyUrls->deleteTiny($tinyUrl);

                   }

                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="Main.js">
</script>
<style>
    body {
        background: #f2f2f2;
    }

    #showLinks {
        float: right;
        width: 20%;
    }

    .thead-dark {
        background-color:#313131;
        color: whitesmoke;
    }

    .div2 {
        width: 51%;
        margin: auto;
        padding: 25px;
        border:  solid ghostwhite;
    }

    img {
        display: flex;
        margin-left: auto;
        margin-right: auto;
        border: 2px solid grey;
        width: 50%;
        margin-top: 0;
    }
</style>
</html>
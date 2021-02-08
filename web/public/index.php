<html lang="de">
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>URL-Creator</title>
</head>

<body>
    <img alt="Leebmann" src ="https://www.leebmann.de/wp-content/uploads/2020/10/Header-Willkommen-1080x146px-10.2020.jpg">

    <div class="container-fluid">
        <form method="post">
            <a href="./UTMLinks.php" id="showLinks" class="btn btn-primary">Zeige Links </a>
            <h3 id="h3">Trage bitte die Nötigen Daten ein</h3>

            <span>*</span>
            <label for="url">URL <small>(https://...)</small></label>
                 <input class="form-control" type="text" required placeholder="https://www.example.de/" id="url" name="url"
                        value="<?PHP if(isset($_POST['url'])){echo $_POST['url'];}?>"><br>
            <span>*</span>
            <label for ="source">Quelle<small>(newsletter etc.)</small></label>
                 <input class="form-control" type="text" required placeholder="newsletter..." id="source" name="source"
                        value="<?PHP if(isset($_POST['source'])){echo $_POST['source'];}?>"><br>
            <span>*</span>
            <label for ="medium">Versandmedium <small>(z.b. E-Mail)</small></label>
                 <input class="form-control" type ="text" required placeholder="Marketing medium.." id="medium" name="medium"
                        value="<?PHP if(isset($_POST['medium'])){echo $_POST['medium'];}?>"><br>
            <span>*</span>
            <label for ="campaign">Kampagne</label>
                 <input class="form-control" type ="text" required placeholder="Produkt, promo code.." id="campaign" name="campaign"
                        value="<?PHP if(isset($_POST['campaign'])){echo $_POST['campaign'];}?>"><br>
            <span>*</span>
            <label for ="content">Content</label>
                <input class="form-control" required type ="text" placeholder="..." id="content" name="content"
                       value="<?PHP if(isset($_POST['content'])){echo $_POST['content'];}?>"><br>

            <label for ="term">Term</label>
                <input class="form-control" type ="text" placeholder="Keywords.." id="term" name="term"
                       value="<?PHP if(isset($_POST['term'])){echo $_POST['term'];}?>"><br>

            <input type="hidden" value="<?php
                if (isset($_POST['url'])){
                    require_once('./Models/TinyUrl.php');

                    $buildUrl = new TinyUrl();
                    echo file_get_contents('http://tinyurl.com/api-create.php?url=' .$buildUrl->generateUrl(
                            $_POST['url'],$_POST['source'],$_POST['medium'],$_POST['campaign'],$_POST['term'],
                            $_POST['content']));
                }
            ?>" id="tiny" name="tiny">
            <label id="labeltextarea">
                Tiny URL :
            <textarea id="secarea" class="form-control" rows="3" readonly=""><?php
               if (isset($_POST['url'])){
                    require_once('./Models/TinyUrl.php');

                    $buildUrl = new TinyUrl();
                    echo file_get_contents('http://tinyurl.com/api-create.php?url=' .$buildUrl->generateUrl(
                            $_POST['url'],$_POST['source'],$_POST['medium'],
                            $_POST['campaign'],$_POST['term'],$_POST['content']));
                }
                ?>
            </textarea>
                <input class="btn btn-primary" type="submit" value="Link erzeugen" id ="btn" name="button1">
            </label>
            <label  id="labeltextarea2">
                    URL :
                <textarea id="firstarea" class="form-control" rows="3"  readonly="" >
                    <?php
                        if (isset($_POST['url']))
                        {
                            require_once('./Models/TinyUrl.php');
                            $safeurl = new TinyUrl();
                            echo $safeurl->generateUrl( $_POST['url'],$_POST['source'],$_POST['medium'],
                                                        $_POST['campaign'],$_POST['term'],$_POST['content']);
                        } else {
                           echo "Mehr angaben benötigt";
                        }
                    ?>
                </textarea>
                <input class="btn btn-primary" type="submit" value="Link Speichern" id="btn2" name="button2">
                <?php
                if (array_key_exists('button2', $_POST)) {
                    if (!empty($_POST['tiny'])) {
                        require_once ('./Models/TinyUrl.php');
                        $safeTinyUrl= new TinyUrl();
                        $safeTinyUrl->saveTinyUrl($_POST['url'],$_POST['source'],$_POST['medium'],$_POST['campaign'],
                                                  $_POST['term'],$_POST['content'],$_POST['tiny']);
                    }
                }
                ?>
            </label>
        </form>
    </div>
</body>
<style>
    body {
        background: #f2f2f2;
    }

    #showLinks {
        float: right;
        width: 20%;
    }

    #medium,#source,#campaign,#url,#term,#content {
        width: 60%;
    }

    span {
        color: #ff0000;
    }

    #labeltextarea {
        width: 30%;
    }

    #labeltextarea2 {
        width: 30%;
    }
    form {
        width: 51%;
        margin: auto;
        padding: 25px;
        border:  solid ghostwhite;
    }

    #btn2,#btn {
    margin-top: 2%;
    }

    p {
        margin-top: 25px;
        margin-bottom: 25px;
    }

    h3 {
        padding: 25px;
        padding-left: 0;
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
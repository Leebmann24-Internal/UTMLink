<?php
    require('Database.php');

Class TinyUrl  {

    function getUrl ()
    {

        $url = $_POST['url'];
        $source = $_POST['source'];
        $medium = $_POST['medium'];
        $campaign = $_POST['campaign'];
        $term = $_POST['term'];
        $content = $_POST['content'];
        $tiny = $_POST['tiny'];


        if (array_key_exists('button1',$_POST)) {
            $link = '';
            if ($url && $url != '') {
                $link .= $url;
            }
            if ($source && $source != '') {
                $link .= '/?utm_source=' . $source;
            }
            if ($medium && $medium != '') {
                $link .= '&utm_medium=' . $medium;
            }
            if ($campaign && $campaign != '') {
                $link .= '&utm_campaign=' . $campaign;
            }
            if ($term && $term != '') {
                $link .= '&utm_term=' . $term;
            }
            if ($content && $content != '') {
                $link .= '&utm_content=' . $content;
            } return $link;
        }
        elseif (array_key_exists('button2',$_POST)) {
            if (!empty($tiny)) {
                $saveTiny = new Database();
                $saveTiny->saveTinyUrl($url, $source, $medium, $campaign, $term, $content, $tiny);

                return "Erfolgreich Gespeichert";
            }
            else {
                return 'Fehler'; }
        }

        return 'Fehler';
    }

    function saveTiny($url, $source, $medium, $campaign, $term, $content, $tiny)
    {
        $sql = "INSERT INTO UTMLinks (url,`source` , medium, campaign, term, content, tiny) VALUES ('$url','$source','$medium', '$campaign', '$term', '$content', '$tiny')";
        $this->pdo->exec($sql);
        return TRUE;
    }

    function showTiny()
    {
        $tinyUrlData = [];
        $sql="SELECT * FROM UTMLinks";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $tinyUrlData[] =[$row['source'],$row['medium'],$row['campaign'],$row['content'],$row['term'],$row['tiny']];

        } return $tinyUrlData;
    }
    
    function deleteTiny($tiny)
    {
        try {
            $sql = "DELETE FROM UTMLinks WHERE tiny='$tiny'";
            $this->pdo->exec($sql);
            return 'Tiny-Url erfolgreich gelöscht';
        } catch (Exception $e) {
            return 'Tiny-Url konnte nicht gelöscht werden. Fehler:'. $e->getMessage();
        }
    }
}

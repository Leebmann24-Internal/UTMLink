<?php
require('Database.php');

Class TinyUrl  {

    private $pdo;

    function __construct()
    {
        $dbh = new Database();
        $this->pdo = $dbh->pdo;
    }

    function generateUrl ($url,$source,$medium,$campaign,$term,$content)
    {

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
            }
            return $link;
        }
        return 'Fehler';
    }

    function saveTinyUrl($url, $source, $medium, $campaign, $term, $content, $tiny)
    {
        try {
        $sql = "INSERT  INTO UTMLinks (url,`source` , medium, campaign, term, content, tiny) VALUES (
                                      '$url','$source','$medium', '$campaign', '$term', '$content', '$tiny')";
        $this->pdo->exec($sql);
        return TRUE;
        } catch (Exception $e) {
            return 'Tiny-Url konnte nicht gespeichert werden. Fehler:'. $e->getMessage();
        }
    }

    function showTinyUrl()
    {
        $tinyUrlData = [];
        try {
        $stmt= $this->pdo->prepare("SELECT * FROM UTMLinks");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $tinyUrlData[] =[$row['source'],$row['medium'],$row['campaign'],$row['content'],$row['term'],$row['tiny']];
        }
        return $tinyUrlData;
        } catch (Exception $e) {
            return 'Tiny-Url konnte nicht gelöscht werden. Fehler:'. $e->getMessage();
        }
    }
    
    function deleteTinyUrl($tiny)
    {
        try {
            $this->pdo->exec("DELETE FROM UTMLinks WHERE tiny='$tiny'");
            return 'Tiny-Url erfolgreich gelöscht';
        } catch (Exception $e) {
            return 'Tiny-Url konnte nicht gelöscht werden. Fehler:'. $e->getMessage();
        }
    }
}

<?php
require('Database.php');

Class TinyUrl  {

    private $pdo;

    function __construct()
    {
        $dbh = new Database();
        $this->pdo = $dbh->pdo;
    }

    function generateUrl(string $url, string $source, string $medium, string $campaign,string $term, string $content): string
    {

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

    function saveTinyUrl(string $url, string $source, string $medium, string $campaign, string $term, string $content, string $tinyUrl): bool
    {
        try {
            $sql = "INSERT  INTO UTMLinks (url,`source` , medium, campaign, term, content, tiny) 
                    VALUES ('$url','$source','$medium', '$campaign', '$term', '$content', '$tinyUrl')";
            $this->pdo->exec($sql);

            echo "<br>Erfolgreich Gespeichert";
            return TRUE;
        } catch (Exception $e) {
            echo 'Tiny-Url konnte nicht gespeichert werden. Fehler:'. $e->getMessage();
            return FALSE;
        }
    }

    function showTinyUrls(): array
    {
        $tinyUrlData = [];
        try {
            $stmt= $this->pdo->prepare("SELECT * FROM UTMLinks");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $tinyUrlData[] = [$row['source'],$row['medium'],$row['campaign'],$row['content'],$row['term'],$row['tiny']];
            }
            return $tinyUrlData;
        } catch (Exception $e) {
            die('Tiny-Url konnte nicht gelöscht werden. Fehler:'. $e->getMessage());
        }
    }
    
    function deleteTinyUrl($tinyUrl): bool
    {
        try {
            $this->pdo->exec("DELETE FROM UTMLinks WHERE tiny='$tinyUrl'");
            echo 'Tiny-Url erfolgreich gelöscht';
            return TRUE;
        } catch (Exception $e) {
            echo 'Tiny-Url konnte nicht gelöscht werden. Fehler:'. $e->getMessage();
            return FALSE;
        }
    }
}

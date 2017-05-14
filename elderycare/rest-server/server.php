<?php
require '../cfg.php';
function deliverResponse($status, $status_message, $data)
{
    header("Content-Type:application/json");
    header("HTTP/1.1 $status $status_message");
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;

    $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
    echo $json_response;
}

if(isset($_GET['photos'])) {
    function generateSQL()
    {
        $DISPLAY_COUNT = 9;
        if(isset($_GET['p']) && (int)$_GET['p'] > 0)
        {
            $currentPage = (int)$_GET['p'];
        } else {
            $currentPage = 0;
        }

        $limitStart = $currentPage * $DISPLAY_COUNT;
        $limitEnd = $DISPLAY_COUNT;

        $sqlWhereClause = '';
        if(isset($_GET['filter'])){
            $filterBy = $_GET['filter'];
            mysql_query('SET NAMES UTF8');
            $result = mysql_query('SELECT category_id FROM photos WHERE category_id="'.$filterBy.'"');
            if(mysql_num_rows($result) > 0){
                $sqlWhereClause = ' WHERE category_id="'.$filterBy.'"';
            } else {
                $sqlWhereClause = '';
            }
        }

        $sql = 'SELECT * FROM photos'.$sqlWhereClause.' LIMIT '.$limitStart.', '.$limitEnd;
        return $sql;
    }

    function getDataFromDatabase($sql){
        $photos = array();
        mysql_query('SET NAMES UTF8');
        $result = mysql_query($sql);
        $rowsCount = mysql_num_rows($result);
        $currentPhoto = 1;
        while( $row = mysql_fetch_assoc($result)){
            $currCols[] = $row;
            if($rowsCount % 3 != 0){
                if($currentPhoto >= $rowsCount){
                    $photos['rows'][]['cols'] = $currCols;
                    $currCols = [];
                }
            }
            else if($currentPhoto % 3 == 0){
                $photos['rows'][]['cols'] = $currCols;
                $currCols = [];
            }
            $currentPhoto++;
        }
        return $photos;
    }

    $sql = generateSQL();
    $data = getDataFromDatabase($sql);

    deliverResponse(200, "Succ Get Photos", $data);
}

if(isset($_GET['categories'])){

    function getAllCategories($sql){
        $categories = array();
        mysql_query('SET NAMES UTF8');
        $result = mysql_query($sql);
        while( $row = mysql_fetch_assoc($result)){
            $currCols[] = $row;
            $categories['categories'] = $currCols;
        }
        return $categories;
    }

    $sql = 'SELECT category_id, name FROM categories';
    $data = getAllCategories($sql);

    deliverResponse(200, "Successfuly get all categories", $data);
}
?>
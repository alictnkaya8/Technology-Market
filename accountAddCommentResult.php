<?php

if(isset($_SESSION['user'])){

    if(isset($_GET["productId"])){
        $incomingProductId = filterVariable($_GET["productId"]);
    } else {
        $incomingProductId = "";
    }
    if(isset($_POST["point"])){
        $inComingPoint = filterVariable($_POST["point"]);
    } else {
        $inComingPoint = "";
    }
    if(isset($_POST["comment"])){
        $inComingComment = filterVariable($_POST["comment"]);
    } else {
        $inComingComment = "";
    }

    if(!empty($incomingProductId) and !empty($inComingPoint) and !empty($inComingComment)){

        $addCommentQuery =  $db->prepare("INSERT INTO comments (productId, userId, point, comment, commentDate, commentIpAddress) VALUES (?, ?, ?, ?, ?, ?)");
        $addCommentQuery->execute([$incomingProductId, $userID, $inComingPoint, $inComingComment, $timeStamp, $IPAddress]);
        $commentCount = $addCommentQuery->rowCount();

        if($commentCount > 0){

            $productUpdateQuery =  $db->prepare("UPDATE products SET numberOfComments = numberOfComments + 1, totalCommentPoints = totalCommentPoints + ? WHERE id = ? LIMIT 1");
            $productUpdateQuery->execute([$inComingPoint, $incomingProductId]);
            $productUpdateCount = $productUpdateQuery->rowCount();

            if($productUpdateCount > 0){
                header("Location:index.php?pageNo=77");
                exit();
            } else {
                header("Location:index.php?pageNo=78");
                exit();
            }
        } else {
            header("Location:index.php?pageNo=78");
            exit();
        }
    } else {
        header("Location:index.php?pageNo=79");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>
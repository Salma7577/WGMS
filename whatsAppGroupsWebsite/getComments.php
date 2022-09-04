<?php
include('Connection.php');
$groupID = $_POST["groupID"];
$sql = "SELECT * FROM comments where groupID  = " . $groupID;
$result = mysqli_query($conn, $sql);
if(isset($_COOKIE["id"])){
$sqlUser = "select Role from user where id =".$_COOKIE["id"];
$userQueryResult = (mysqli_query($conn, $sqlUser)->fetch_assoc())["Role"];
if($userQueryResult==1){
    $label = "بلغ";
    $dirTo="CfileComplaint.php";
}
else{
    $label = "حذف";
    $dirTo="DeleteComment.php";
}}
while ($row = $result->fetch_assoc()) {
    $commentId=$row["Cid"];
    $comment=$row['message'];
    echo "<div class='comment'>";
    if (isset($_COOKIE["username"])  )
        echo '<div class="dots" onclick="this.classList.toggle(' . "'active'" . '); "  style="right: unset;" >
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="shadow cut" style="    height: 75px;    width: 104px;"></div>
                <div class="containerd cut" style="width: 71px;    height: 57px;">
                    <div class="drop cut2"></div>
                </div>
                <div class="list" style="    width: 25px;     top: 29px;">
                    <ul>
                        <li id="fileComplaint">
                           <form action="'.$dirTo.'" method="post">
                             <input type="hidden" name="Comment" value='. "'$comment'" .'>
                             <input type="hidden" name="groupID" value='. "'$groupID'" .'>
                             <input type="hidden" name="commentId" value='. "'$commentId'" .'>
                           <button type="submit" style="text-decoration: none;     background: none; 
                           box-shadow: 0px 0px 0px transparent; border: 0px solid transparent; text-shadow: 0px 0px 0px transparent;">'.$label.'</button>
                           </form> 
                        </li>

                    </ul>
                </div>
                <div class="dot"></div>
            </div>
            <div class="cursor"
                 onclick="document.querySelector(' . "'.dots'" . ').classList.toggle(' . "'active'" . ');"></div>';


    echo "<div class='commentUserName'>" . $row['username'] . "</div>";

    echo "<div><p class='commentText'>" . $row['message'] . "</p></div>";
    $nonCheckedStars = 5 - $row["rating"];
    $remainStars = 5;
    echo '<div class="rating">';
    while ($nonCheckedStars != 0) {
        echo '<span class="star"> </span>';
        $nonCheckedStars--;
        $remainStars--;
    }
    while ($remainStars != 0) {
        echo '<span class="CheckedStar"> </span>';
        $remainStars--;
    }
    echo '</div></div>';
}
?>



